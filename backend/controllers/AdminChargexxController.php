<?php

namespace backend\controllers;

use backend\models\AdminFund;
use backend\models\AdminMember;
use Yii;
use backend\models\AdminChargexx;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\helps\ExportExcelController;
use backend\models\AdminUserRole;
use backend\models\AdminUser;

/**
 * AdminChargexxController implements the CRUD actions for AdminChargexx model.
 */
class AdminChargexxController extends Controller
{
    /**
     * @inheritdoc
     */
    public $state = [1 => '未审核', 2 => '审核通过', 3 => '审核不通过'];
    public $layout = "lte_main";
    public $admin_id;
    public $role_id;
    public $admin_user;

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

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->admin_id = yii::$app->session['__id'];
        //根据管理员id判断管理员的角色，超级管理员role_id为1
        $this->role_id = AdminUserRole::findOne(['user_id'=>yii::$app->session['__id']])->role_id;
        $this->admin_user = AdminUser::findOne(['id'=>yii::$app->session['__id']]);

    }

    /**
     * Lists all AdminChargexx models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( !in_array($this->role_id, [1,2,5,6]) ) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $query = AdminChargexx::find()->joinWith('member');
        $static = AdminChargexx::find()->joinWith('member');

        $search = Yii::$app->request->get('query');
        // var_dump($search);
        $query=$this->condition($query,$search);
        $static=$this->condition($query,$search);
        $sum=$static->sum('admin_chargexx.money');
        
        //如果是代理商，只能看到自己推荐的会员列表
        if($this->role_id == 2) {
            //自己的邀请码
            $vatation_code = $this->admin_user->vatation_code;
            $query = $query->andWhere(['admin_member.vatation_code2'=>$vatation_code]);
        }

       /* $state = Yii::$app->request->get('state');
        if(!(!isset($state)&&empty($state))) {
            $query = $query->andWhere(['state'=>$state]);
            $querys['state'] = $state;
        }*/
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('id desc')
            ->all();
        return $this->render('index', [
            'model' => $products,
            'sum' => $sum,
            'pages' => $pagination,
            'state'=>$this->state,
            'query' => $search,
            'role_id' => $this->role_id,
        ]);
    }

    /**
     * Displays a single AdminChargexx model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if( !in_array($this->role_id, [1,2,5,6]) ) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $model = $this->findModel($id);
        //如果是代理商并且该会员不是此管理员的
        if( ($this->role_id == 2) && (AdminMember::findOne(['id'=>$model->users_id])->vatation_code2 != $this->admin_user->vatation_code)) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $model->users_id = AdminMember::findOne(['id'=>$model->users_id])->usersname;
        return $this->render('view', [
            'model' => $model,
        ]);

    }

    /**
     * Creates a new AdminChargexx model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        if( !in_array($this->role_id, [1,6]) ) {
//            yii::$app->getSession()->setFlash('error', '没有该权限');
//            echo "<script>window.history.go(-1)</script>";exit;
//        }
        $model = new AdminChargexx();
        if (Yii::$app->request->isPost) {
            $info = $_POST;

            $user_id = AdminMember::find()->andwhere(['usersname'=>$info['usersname'],'realname'=>$info['realname']])
                ->andWhere(['bank_tel'=>$info['bank_tel']])->asArray()->one();
            if(!$user_id){
                return $this->createMsg('用户未找到', $info);
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->users_id = $user_id['id'];
            $model->dates = time();
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function createMsg($msg, $user_info)
    {
        return $this->redirect(['create', 'msg' => $msg, 'user_info' => $user_info]);
    }

    /**
     * Updates an existing AdminChargexx model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if( !in_array($this->role_id, [1,6]) ) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $model = $this->findModel($id);
        /*//如果不是超级管理员并且该会员不是此管理员的
        if( ($this->role_id != 1) && (AdminMember::findOne(['id'=>$model->users_id])->vatation_code2 != $this->admin_user->vatation_code)) {
            return $this->actionIndex();
        }*/
        //如果不是超级管理员
        /*if( $this->role_id != 1) {
            return $this->actionIndex();
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminChargexx model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if( !in_array($this->role_id, [1,6]) ) {
            return 800;
        }
        $model = $this->findModel($id);
        //如果不是超级管理员并且该会员不是此管理员的
        if( ($this->role_id != 1) && (AdminMember::findOne(['id'=>$model->users_id])->vatation_code2 != $this->admin_user->vatation_code)) {
            return $this->actionIndex();
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDelrecord(array $ids)
    {
        if( !in_array($this->role_id, [1,6]) ) {
            return 800;
        }
        if (count($ids) > 0) {
            $c = AdminChargexx::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminChargexx model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminChargexx the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminChargexx::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChangeState()
    {
        if( !in_array($this->role_id, [1,6]) ) {
            return 800;
        }
        $state =Yii::$app->request->get('state');
        $id = Yii::$app->request->get('id');
        $model = AdminChargexx::findOne($id);
        $user_id = $model->users_id;
        $model->state = $state;
        $member = AdminMember::findOne(['id'=>$user_id]);
        $member->money += $model->money;
        $found = new AdminFund();
        $found->user_id = $model->users_id;
        $found->amount = $model->money;
        $found->order_id = $model->id;
        $found->title = '线下充值' . $model->money . '元';
        $found->created_time = time();
        //开启事物
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $member->save(false);
            $model->save(false);
            $found->save();
            //提交
            $transaction->commit();
            return 100;exit;
        } catch (Exception $e) {
            //捕获错误
            $transaction->rollback();
        }
    }
    /*
     * 导出数据
     * */

    public function actionExport()
    {
        if( !in_array($this->role_id, [1,6]) ) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $arr_state = [0=>'未审核',1=>'通过',2=>'未通过'];
        $excel = new ExportExcelController();
        $search = Yii::$app->request->get('query');
        $query = AdminChargexx::find()->joinWith('member');
        $model=$this->condition($query,$search)->asArray()->all();
        $data[] = ['序号','会员号','金额/$','备注','充值时间','流水号','ip','支付方式','状态'];
        foreach ($model as $k=> $arr) {
            $data[$k+1] = $arr;
            $data[$k+1]['dates'] = date('Y-m-d H:i:s',$arr['dates']);
            $data[$k+1]['users_id'] = $arr['member']['usersname'];
            $data[$k+1]['state'] = $arr_state[$arr['state']];
            unset($data[$k+1]['member']);
            unset($data[$k+1]['img_url']);
        }
        $filename = '线上充值记录'.date('Ymd',time());
        $excel->download($data, $filename);
        //echo "<script>history.go(-1)</script>";

    }

    protected function condition($query,$search)
    {
        if (count($search) > 0) {
            $state = $search['state']-1;
            $user_id = $search['users_id'];
            $b_time = $search['b_time'];
            $e_time = $search['e_time'];
            //$time = $querys['time'];
            if($state>=0) {
                $query = $query->andWhere(['admin_chargexx.state'=>$state]);
            }
            if($user_id) {
                $query = $query->andWhere(['like','usersname',$user_id]);
            }
            if($b_time) {
                $query = $query->andWhere(['>=','admin_chargexx.dates',$b_time]);
            }
            if($e_time) {
                $query = $query->andWhere(['<=','admin_chargexx.dates',$e_time]);
            }
        }
        return $query;
    }
}