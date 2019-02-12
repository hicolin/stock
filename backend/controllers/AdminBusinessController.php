<?php

namespace backend\controllers;

use backend\models\AdminMember;
use backend\models\AdminTongji;
use backend\models\AdminUser;
use backend\models\AdminUserpeoduct;
use backend\models\AdminUserRole;
use Yii;
use backend\models\AdminBusiness;
use common\helps\ExportExcelController;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\models\Common;
use common\models\Excel;

/**
 * AdminBusinessController implements the CRUD actions for AdminBusiness model.
 */
class AdminBusinessController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "lte_main";

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminBusiness models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminBusiness::find();
        $querys = Yii::$app->request->get('query');
        if (count($querys) > 0) {
            $condition = "";
            $parame = array();
            foreach ($querys as $key => $value) {
                $value = trim($value);
                if (empty($value) == false) {
                    $parame[":{$key}"] = $value;
                    if (empty($condition) == true) {
                        $condition = " {$key}=:{$key} ";
                    } else {
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if (count($parame) > 0) {
                $query = $query->where($condition, $parame);
            }
        }
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'model' => $products,
            'pages' => $pagination,
            'query' => $querys
        ]);
    }

    /**
     * 读取excel数据
     * @return int
     */
    public function actionImport()
    {
        $path = Yii::$app->request->get('path');
        $root = Yii::getAlias('@root');
        $data = Excel::getExcelData($root . '/' . $path);
        // var_dump($data);exit;
        foreach ($data as $k => $list) {
            $business = AdminBusiness::find()->andWhere(['entrust' => $list[2]])->andWhere(['success_account' => $list[3]])->one();
            $member = AdminMember::findOne(['xgj_name' => $list[0]]);
            if (empty($business) && $member) {
                $model[$k]['account'] = $list[0];
                $model[$k]['date'] = $list[1];
                $model[$k]['entrust'] = $list[2];
                $model[$k]['success_account'] = $list[3];
                $model[$k]['request'] = $list[4];
                $model[$k]['exchange'] = $list[5];
                $model[$k]['contract'] = $list[6];
                $model[$k]['is_buy'] = $list[7];
                $model[$k]['is_open'] = $list[8];
                $model[$k]['insure'] = $list[9];
                $model[$k]['deal_price'] = $list[10];
                $model[$k]['deal_num'] = $list[11];
                $model[$k]['deal_money'] = $list[12];
                $model[$k]['actual_date'] = $list[13];
                $model[$k]['actual_his'] = gmdate('H:i:s', intval(($list[14] - 25569) * 3600 * 24));
                $model[$k]['z_account'] = $list[15] ? $list[15]:0;;
                $model[$k]['system'] = $list[16] ? $list[16] : 0;;
                $model[$k]['service'] = $list[17] ? $list[17] : 0;
                $model[$k]['float_yk'] = $list[18] ? $list[18] : 0;;
                $model[$k]['close_yk'] = $list[19] ? $list[19] : 0;;
                $model[$k]['jc_service'] = $list[20] ? $list[20] : 0;
                $model[$k]['add_time'] = time();
            }
        }
        $num = Yii::$app->db->createCommand()->batchInsert('admin_business', ['account', 'date', 'entrust', 'success_account', 'request', 'exchange', 'contract', 'is_buy', 'is_open', 'insure', 'deal_price', 'deal_num', 'deal_money', 'actual_date', 'actual_his', 'z_account', 'system', 'service', 'float_yk', 'close_yk', 'jc_service', 'add_time'], $model)->execute();
        file_put_contents(time() . '.txt', time());
        if ($num) {
            return json_encode(['status' => 200]);
            exit;
        } else {
            return json_encode(['status' => 500]);
            exit;
        }
    }

    public function actionCommission()
    {
        $business = AdminBusiness::find()->where(['is_fy' => 0])->all();
        if ($business) {
            foreach ($business as $list) {
                $member = AdminMember::find()->where(['xgj_name' => $list['account']])->asArray()->one();
                $ids = AdminUser::getAllAgentParent($member['pid']);
                $p_role = AdminUserRole::findOne(['user_id' => $member['pid']])->role_id;
                if ($p_role == 2) {
                    array_unshift($ids, $member['pid']);//向数组头部插入元素  所有上级
                }
                $money = $list['service'] - $list['jc_service'];
                $cj = 0;
                if (!empty($ids)) {
                    foreach ($ids as $z => $v) {
                        $rate = AdminUser::findOne($v)->rate;
                        $user_p = AdminUserpeoduct::findOne(['uid' => $v]);
                        $commission_money = $user_p->commission_member + $money * ($rate - $cj) / 100;
                        $user_p->commission_member = $commission_money;
                        $fy = new AdminTongji();
                        $fy->xgj_id = $list['account'];
                        $fy->jy_time = time();
                        $fy->uid = $v;
                        $fy->entrust = $list['entrust'];
                        $fy->deal_num = $list['success_account'];
                        $fy->request_num = $list['request'];
                        $fy->bourse = $list['exchange'];
                        $fy->contract = $list['contract'];
                        $fy->amount = $list['deal_num'];
                        $fy->sj_time = $list['actual_date'];
                        $fy->cj_time = $list['actual_his'];
                        $fy->charge = $list['service'];
                        $fy->pc_yingkui = $list['close_yk'];
                        $fy->commission_money = $money * ($rate - $cj) / 100;
                        $list->is_fy = 1;
                        $tran = Yii::$app->db->beginTransaction();
                        try {
                            $list->save(false);
                            $user_p->save(false);
                            $fy->save(false);
                            $tran->commit();
                        } catch (Exception $e) {
                            $tran->rollBack();
                        }
                        $cj = $rate;
                    }
                }
            }
            return $this->redirect(['admin-business/index']);
        }
        return $this->redirect(['admin-business/index']);

    }


    
 protected function condition($query,$search)
    {
        if (count($search) > 0) {
            $account = $search['account'];
            $date = $search['date'];
            if ($account) {
                $query = $query->andWhere(['like', 'account', $account]);
            }
            if ($date) {
                $query = $query->andWhere(['like', 'date', $date]);
            }
            
            
        }
        return $query;
    }


    //导出数据
    public function actionExport()
    {
         
          // if( !in_array($this->role_id, [1,6]) ) {
        //     yii::$app->getSession()->setFlash('error', '没有该权限');
        //     echo "<script>window.history.go(-1)</script>";exit;
        // }
        $excel = new ExportExcelController();
        $search = Yii::$app->request->get('query');
        $model = $this->condition(AdminBusiness::find(),$search)->asArray()->all();
        //$model = AdminCharge::find()->joinWith('member')->asArray()->all();
        $data[] = ['ID', '子帐号', '交易日', '成交号', '请求号', '是否返佣'];
        foreach ($model as $k=> $arr) {

            $data[$k+1]['id'] = $arr['id'];
            $data[$k+1]['account'] = $arr['account'];
            $data[$k+1]['date'] = $arr['date'];
            $data[$k+1]['success_account'] = $arr['success_account'];
            $data[$k+1]['request'] = $arr['request'];
            $data[$k+1]['is_fy'] = $arr['is_fy'];
        }
        $filename = '交易列表'.date('Ymd',time());
        $excel->download($data, $filename);
        //echo "<script>history.go(-1)</script>";



//         $modelLabel = new AdminBusiness();
//         $field = [];
//         $data = [];
//         $key_arr = ['account', 'date', 'entrust', 'success_account', 'request', 'exchange', 'contract', 'is_buy', 'is_buy', 'insure', 'deal_price'
//             , 'deal_num', 'deal_money', 'actual_date', 'actual_his', 'z_account', 'system', 'service', 'float_yk', 'close_yk', 'jc_service'];
//         foreach ($key_arr as $k1 => $v) {
//             $field[$k1]['key'] = $v;
//             $field[$k1]['name'] = $modelLabel->getAttributeLabel($v);
//         }
//         $query = AdminBusiness::find();
//         $querys = Yii::$app->request->get('query');
//         if (count($querys) > 0) {
//             $condition = "";
//             $parame = array();
//             foreach ($querys as $key => $value) {
//                 $value = trim($value);
//                 if (empty($value) == false) {
//                     $parame[":{$key}"] = $value;
//                     if (empty($condition) == true) {
//                         $condition = " {$key}=:{$key} ";
//                     } else {
//                         $condition = $condition . " AND {$key}=:{$key} ";
//                     }
//                 }
//             }
//             if (count($parame) > 0) {
//                 $query = $query->where($condition, $parame);
//             }
//         }
//         $model = $query->all();
// //        $model = $this->condition($query,$search)->all();
//         foreach ($model as $k => $list) {
//             foreach ($list as $key => $val) {
//                 if (in_array($key, $key_arr)) {
//                     $data[$k][$key] = $val;
//                 }
//             }
//         }
//         Excel::createExcelFromData($field, $data, date('Ymd') . 'apply.xls');
    }

    /**
     * Displays a single AdminBusiness model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new AdminBusiness model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminBusiness();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminBusiness model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminBusiness model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDelrecord(array $ids)
    {
        if (count($ids) > 0) {
            $c = AdminBusiness::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminBusiness model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminBusiness the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminBusiness::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
