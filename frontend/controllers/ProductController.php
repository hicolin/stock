<?php
namespace frontend\controllers;
use backend\controllers\AdminOrderController;
use backend\models\AdminCat;
use backend\models\AdminMember;
use backend\models\AdminProduct;
use backend\models\AdminOrder;
use common\helps\Tools;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AdminRegions;
use frontend\controllers\MemberController;
use backend\models\AdminDummyOrder;
use frontend\controllers\Ucpaas;
/**
 * Site controller
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "main";
    public $defaultAction='index';
    public $enableCsrfValidation = false ;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    //
    public function actionIndex()
    {


    }
    /*
     * 国际期货
     * */
    public function actionNation()
    {
        $user_id=Yii::$app->session['userid'];
        if($user_id) {
            $onelist = AdminMember::find()->where(array('id'=>"$user_id"))->one();
        } else {
            $onelist = '';
        }


        //假人订单
        $dummy_order = AdminDummyOrder::find()->limit(10)->orderBy('money desc,profit_money desc')->asArray()->all();
        $cid = Yii::$app->request->get('cid');
        $id = Yii::$app->request->get('id');
        $id = 5;
        if($id){
            $title = AdminProduct::findOne(['id'=>$id])->title;
        }else {
            $title = AdminProduct::find()->orderBy('id desc')->andWhere(['cat_id'=>$cid])->one()->title;
            $id = AdminProduct::find()->orderBy('id desc')->andwhere(['cat_id'=>$cid])->one()->id;
        }
        $this->getView()->title = $title.'-'.Tools::getSetting('网站名称');
        $cat = AdminCat::getCatsByCatId($cid);
        $products = AdminProduct::find()->orderBy('id desc')->where(['cat_id'=>$cid])->all();
        $product = AdminProduct::findOne(['id'=>$id]);
        if($cid==5) {
            $view = "nation-syn";
            //国际综合版
        } else {
            //国际合约版
            $view = "domestic-contract";
        }

        return $this->render($view,[
            'cat'=>$cat,
            'cid'=>$cid,
            'id'=>$id,
            'product'=>$product,
            'products'=>$products,
            'title'=>$title,
            'dummy_order'=>$dummy_order,
            'onelist'=>$onelist,
        ]);
    }

    /*
     * 提交订单
     * */
    public function actionSubOrder()
    {
        //检查用户是否登录
        if(Yii::$app->session['islogin']){
            $user_id=Yii::$app->session['userid'];
            $onelist = AdminMember::find()->where(array('id'=>"$user_id"))->one();
            if(!$onelist) {
                //去登录
                echo -1;exit;
            }
        }
        else{
            //去登录
            echo -1;exit;
        }

        //身份判断
        if($this->actionValidateMember() != 100) {
            return $this->actionValidateMember();exit;
        }
        $id = yii::$app->request->post('id');
        $num = intval(yii::$app->request->post('num'));
        $hand = intval(yii::$app->request->post('hand')?:0);
        $loss_line = AdminProduct::findOne(['id'=>$id])->loss_line;
        //判断用户的余额
        //$member=Yii::$app->runAction('member/validate-user-money',['order_money'=>$num]);
        $validate_money = json_decode(Yii::$app->runAction('member/validate-user-money',['order_money'=>$num]),true);
        if($validate_money['state']!=100){
            return $validate_money['state'];exit;
        }
        //验证申请的产品是不是已经在操盘中
        $is_caopan = AdminOrder::find()->andWhere(['and',"user_id=$user_id","goods_id=$id"])->andWhere(['in','status',[0,2,4,6]])->one();
        if($is_caopan) {
            return 800;
        }
        //管理费
        $manage_money = Tools::getSetting(21);
        //分险保证金减去管理费
        //$num = $num-$manage_money;
        $order = new AdminOrder();
        $order->goods_id = $id;
        $order->user_id = $onelist->id;
        //订单编号
        $order->order_sn = AdminOrderController::getOrderSn();
        //几手
        $order->order_hander = $hand;
        //风险保证金
        $order->order_deposit = $num;
        //配资金额
        $order->order_money = floatval($hand * $num);
        //总操盘资金
        //$order->order_amount = floatval($num+$hand*$num);
        $order->order_amount = floatval($num*11);
        //亏损平仓线
        //$order->order_pingcang = floatval($num*$loss_line/100+$hand*$num);
        $order->order_pingcang = floatval($num*$loss_line/100);
        //账户管理费
        //$order->order_account = Tools::getSetting(21);
        $order->order_account = 0;
        //手续费
        $order->order_charge = 0;
        $order->created_time = time();
        $order->begin_time = time();
        $order->end_time = time();
        if($this->actionDealMemberMoney($order)==100){
            //发送短信提醒
            //$this->actionSetMessage('18714837256','140326');
            return 100;
        }else {
            return 400;
        }
    }

    /*
     * 国际综合授信版订单处理
     * */
    public function actionDealNation()
    {

    }


    /*
     * 前台提交订单扣除账户余额
     * */
    public function actionDealMemberMoney($order)
    {
        $user_id = Yii::$app->session['userid'];
        $member = AdminMember::findOne(['id'=>$user_id]);
        //分险保证金+管理费
        $member_money = $order->order_deposit+$order->order_account;
        $member->money = $member->money-$member_money;
        //$member->money = $member->money-$order_money;
        //开启事物
        $transaction = Yii::$app->db->beginTransaction();
        if ($member->validate() && $order->validate()) {
            try {
                $member->save();
                $order->save();
                //提交
                $transaction->commit();
                return 100;exit;
            } catch (Exception $e) {
                //捕获错误
                $transaction->rollback();
            }
        }else{
            return 400;exit;
        }

    }

    /*
     * 身份验证
     * */
    protected function actionValidateMember()
    {
        $user_id = Yii::$app->session['userid'];
        $member = AdminMember::findOne(['id'=>$user_id]);
        if($member->state!=3) {
            //没有实名认证
            return 500;exit;
        }
        if(!$member->bankid) {
            //没有绑定银行卡
            return 600;exit;
        }
        if(!$member->tx_pwd) {
            //没有提现密码
            return 700;exit;
        }
        return 100;

    }

    /*
     * 国内期货
     * */
    public function actionDomestic()
    {
        //return $this->render('domestic');
    }

    /*
     * 提交订单成功后发送短信发送短信
     * */
    public function actionSetMessage($tel='',$templateId='')
    {
        ini_set('date.timezone','Asia/Shanghai');
        header("Content-type:text/html; charset=UTF-8");
        $options['accountsid']='e63c8240d2cd14d4609a9ccd1f7efed2';
        $options['token']='57f20a4587761dc0ddd035132b314876';
        $ucpass = new Ucpaas($options);
        $appId = "037c812e751e445ea35482a1e98a8a2d";
        $templateId = $templateId;
        $user_id = Yii::$app->session['userid'];
        $member = AdminMember::findOne(['id'=>$user_id]);
        $param=$member->xgj_name.','.$member->xgj_pwd;
        $ucpass->templateSMS($appId,$tel,$templateId,$param);
    }



}
