<?php

namespace backend\controllers;

use backend\models\AdminAccount;
use backend\models\AdminFund;
use backend\models\AdminMember;
use backend\models\AdminPayType;
use common\helps\Tools;
use Yii;
use backend\models\AdminTixian;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\helps\ExportExcelController;
use backend\models\AdminUserRole;
use backend\models\AdminUser;

/**
 * AdminTixianController implements the CRUD actions for AdminTixian model.
 */
class AdminTixianController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "lte_main";
    public $admin_id;
    public $role_id;
    public $admin_user;
    public $code = [];

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
        error_reporting(0);
        parent::init(); // TODO: Change the autogenerated stub
        $this->admin_id = yii::$app->session['__id'];
        //根据管理员id判断管理员的角色，超级管理员role_id为1
        $this->role_id = AdminUserRole::findOne(['user_id'=>yii::$app->session['__id']])->role_id;
        $this->admin_user = AdminUser::findOne(['id'=>yii::$app->session['__id']]);

    }

    /**
     * Lists all AdminTixian models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( !in_array($this->role_id, [1,2,5,6]) ) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $query = AdminTixian::find()->joinWith('member');
        $static = AdminTixian::find()->joinWith('member');
        $querys = Yii::$app->request->get('query');

        $query = $this->condition($query,$querys);
        $static = $this->condition($static,$querys);

        //如果是代理商，只能看到自己推荐的会员列表
        if($this->role_id == 2) {
            $this->code = [];
            //下级代理的会员也要显示
            $admin_user = AdminUser::find()->where(['in','vatation_code2',$this->admin_user->vatation_code])->all();
            if($admin_user){
                $this->getAgentMember($admin_user);
            }
            $this->code[] = $this->admin_user->vatation_code;

            //自己的邀请码
            //$vatation_code = $this->admin_user->vatation_code;
            //$query = $query->andWhere(['admin_member.vatation_code2'=>$vatation_code]);
            $query = $query->andWhere(['in','admin_member.vatation_code2',$this->code]);
        }
        $sum = $static->select('sum(admin_tixian.money) as money,sum(admin_tixian.k_money) as k_money,sum(admin_tixian.z_money) as z_money,')->Asarray()->one();
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['state'=>SORT_ASC,'dates'=>SORT_DESC])
            ->all();
            // var_dump($products);exit;
        return $this->render('index', [
            'model' => $products,
            'pages' => $pagination,
            'query' => $querys,
            'sum' => $sum,
            'role_id' => $this->role_id,
        ]);
    }

    /**
     * Displays a single AdminTixian model.
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
        $xgj_name = AdminMember::findOne(['id'=>$model->users_id])->xgj_name;
        $realname = AdminMember::findOne(['id'=>$model->users_id])->realname;
        $model->users_id = AdminMember::findOne(['id'=>$model->users_id])->usersname;
        $payType = AdminPayType::find()->where(['state'=>1])->all();
        return $this->render('view', [
            'model' => $model,
            'xgj_name' => $xgj_name,
            'realname' => $realname,
            'payType' => $payType,
            'role_id'=>$this->role_id,
        ]);

    }

    /**
     * Creates a new AdminTixian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //如果不是超级管理员
        if( !in_array($this->role_id, [1,6]) ) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $model = new AdminTixian();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminTixian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //如果不是超级管理员
        if( !in_array($this->role_id, [1,6]) ) {
            yii::$app->getSession()->setFlash('error', '没有该权限');
            echo "<script>window.history.go(-1)</script>";exit;
        }
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminTixian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //如果不是超级管理员
        if( !in_array($this->role_id, [1,6]) ) {
            return 800;
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
            $c = AdminTixian::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminTixian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminTixian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminTixian::findOne($id)) !== null) {
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
        $state = intval($state);
        $id = Yii::$app->request->get('id');
        $model = AdminTixian::findOne($id);
        $tx_state = $model->state;
        $model->state = $state;
        $user_id = $model->users_id;
        //审核通过
        if($state==1) {
            $service_money = Yii::$app->request->get('service_money');
            $model->service_money = $service_money;
            if($model->save(false)) {
                return 100;
            }
        } else if($state==2) {
            if($tx_state != 0){
                return 400;
            }
            //审核不通过，返回钱到用户余额中去
            $reason = Yii::$app->request->get('reason');
            $model->reason = $reason;
            $member = AdminMember::findOne(['id'=>$user_id]);
            $member->money += $model->money;
            $found = new AdminFund();
            $found->user_id = $member->id;
            $found->order_id = $model->id;
            $found->created_time = time();
            $found->amount =  $model->money;
            $found->money = $member->money;
            $found->title = "提现失败退还" .  $model->money . '元';
            //开启事物
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $member->save(false);
                $model->save(false);
                $found->save(false);
                //提交
                $transaction->commit();
                return 100;
            } catch (Exception $e) {
                //捕获错误
                $transaction->rollback();
            }
        }
    }
    /**
     * 搜索条件
     * @param $query
     * @param $search
     * @return mixed
     */
    protected function condition($query,$querys)
    {
        if (count($querys) > 0) {
            $state = $querys['state'];
            $user_id = $querys['users_id'];
            $realname = $querys['realname'];
            $xgj_name = $querys['xgj_name'];
            $b_time = $querys['b_time'];
            $e_time = $querys['e_time'];
            //$time = $querys['time'];
            if($state>=0) {
                $query = $query->andWhere(['admin_tixian.state'=>$state]);
            }
            if($user_id) {
                $query = $query->andWhere(['like','usersname',$user_id]);
            }
            if($realname) {
                $query = $query->andWhere(['like','realname',$realname]);
            }
            if($xgj_name) {
                $query = $query->andWhere(['like','xgj_name',$xgj_name]);
            }
            if($b_time) {
                $query = $query->andWhere(['>=','admin_tixian.dates',$b_time]);
            }
            if($e_time) {
                $query = $query->andWhere(['<=','admin_tixian.dates',$e_time]);
            }

        }
        return $query;
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
        $query = AdminTixian::find()->joinWith('member');
        $model = $this->condition($query,$search)->asArray()->all();
        $data[] = ['交易账号','金额','提现当前权益','提现可用资金','银行','卡号','状态','申请时间'];
        foreach ($model as $k=> $arr) {
            $data[$k+1]['xgj_name'] = $arr['member']['xgj_name'];
            $data[$k+1]['money'] = $arr['money'];
            $data[$k+1]['z_money'] = $arr['z_money'];
            $data[$k+1]['k_money'] = $arr['k_money'];
            $data[$k+1]['bank_id'] = $arr['bank_id'];
            $data[$k+1]['bank_code'] = $arr['bank_code'];
            $data[$k+1]['state'] = $arr_state[$arr['state']];
            $data[$k+1]['dates'] = date('Y-m-d H:i:s',$arr['dates']);
            unset($data[$k+1]['member']);
        }
        $filename = '提现记录'.date('Ymd',time());
        $excel->download($data, $filename);
        //echo "<script>history.go(-1)</script>";

    }

    /*
    * f访问接口
    * */
    public function actionHttp($url)
    {
        //$url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=dsf1110011001&sapass=967865&account=1110011108&amount=100&credit=0&currency=USD&remark=自动';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($curl);
        $arr = explode(' ',$data);
        return $arr[1];
        //Array ( [0] => HTTP/1.0 [1] => 200 [2] => OK version="1.0" [4] => encoding="GB2312" [5] =>  0 成功 5 )
    }

    /*
     * 返回代理下面代理的邀请码
     * 代理的代理。。。
     * $model
     * */
    protected function getAgentMember($model)
    {
        //获取其下面的代理
        //$admin_user = AdminUser::find()->where(['vatation_code2'=>$vatation_code])->all();
        $arr = [];
        foreach ($model as $key=> $list) {
            if($list->vatation_code) {
                //返回下面的代理的邀请码
                $this->code[] = $list->vatation_code;
                $arr[] = $list->vatation_code;
            }
        }
        $next_model = AdminUser::find()->where(['in','vatation_code2',$arr])->all();
        //如果存在下级代理
        if($next_model){
            $this->getAgentMember($next_model);
        }
        return $this->code;
    }
}
