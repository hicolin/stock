<?php

namespace frontend\controllers;

use backend\models\AdminAddBond;
use backend\models\AdminChargexx;
use backend\models\AdminDeposit;
use backend\models\AdminOrder;
use backend\models\AdminRegions;
use backend\models\AdminTixian;
use backend\models\AdminTiying;
use backend\models\AdminCharge;
use common\helps\Tools;
use common\models\Common;
use common\models\Zg;
use yii\base\Exception;
use yii\data\Pagination;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AdminMember;
use backend\models\AdminHousekeeper;
use frontend\controllers\UcpaasController;
use common\utils\CommonFun;
use yii\web\NotFoundHttpException;
use backend\controllers\PublicController;
use frontend\controllers\CommonController;
use frontend\controllers\TestController;
use frontend\controllers\IndexController;
use backend\models\AdminAccount;
use backend\models\AdminBankCard;
use backend\models\AdminUser;
use backend\models\AdminPayType;
use backend\models\AdminSetting;
use common\models\PublicFunction;
use backend\models\AdminContent;

/**
 * Site controller
 */
class MemberController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "main";
    public $defaultAction = 'index';
    public $enableCsrfValidation = false;
    public $pageSize;
    public $onelist;
    public $user_id;
    public $recharge_order_id;
    public $recharge_type;
    public $xgj_info;

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

    public function init()
    {

        $id = Yii::$app->session->get('user_id');
        $url = Yii::$app->urlManager->createUrl('/register/login');
        if (empty($id)) {
            return $this->redirect([$url, 'sign' => 1]);
            Yii::$app->end();
        } else {
            $onelist = AdminMember::findOne($id);
            if ($onelist) {
                $this->onelist = $onelist;
                $this->user_id = $id;
            } else {
                $this->unsetSession();
                return $this->redirect([$url, 'sign' => 1]);
                Yii::$app->end();
            }
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    protected function unsetSession()
    {
        Yii::$app->session['user_id'] = '';
        Yii::$app->session['tel'] = '';
        unset(Yii::$app->session['access']);
        unset(Yii::$app->session['openid']);
        unset(Yii::$app->session['islogin']);
        unset(Yii::$app->session['userid']);
        unset(Yii::$app->session['qqlogin']);
        unset(Yii::$app->session['access_token']);
        unset(Yii::$app->session['openid']);
        unset(Yii::$app->session['wxlogin']);
    }

    /*
     * 会员信息
     * */
    public function actionIndex()
    {

        $uid = $this->user_id;
        $member = AdminMember::findOne($uid);
        return $this->render('index', [
            'member' => $member

        ]);

    }

    /**
     * 资金详情
     * @return string
     */
    public function actionCapitalDetails()
    {
        return $this->render('capital_details');
    }

    /**
     * 安全信息
     * @return string
     */
    public function actionSecurity()
    {
        header("Content-type:text/html;charset=utf-8");
        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);

        return $this->render('security', [
            'member' => $member,

        ]);
    }
    /**
     * 开户1
     */
    public function actionKh()
    {
//       $this ->layout = false;
        $uid = $this->user_id;
        $member = AdminMember::findOne($uid);
        $state = $member->state;
        if($state!=3){
            $this->redirect(['member/security']);
        }
        if($member->isopen==1){
            $this->redirect(['member/security']);
        }
        return $this->render('kh1');
    }

    /**
     * 开户2
     */
    public function actionKh2()
    {
        $uid = $this->user_id;
        $member = AdminMember::findOne($uid);
        if($member->isopen==1){
            $this->redirect(['member/security']);
        }
        $cj = rand(50,99);
        if($cj<60){
            $tt = '01';
        }elseif($cj>=60 && $cj<75){
            $tt = '02';
        }else{
            $tt= '03';
        }
        return $this->render('kh2',[
            'cj'=>$cj,
            'tt'=>$tt,
        ]);
    }
    /***
     * 开户成功发送账号
     */
    public function actionKh3()
    {

    }
    // 实名认证操作

    public function actionRz()
    {
        include dirname(__FILE__) . '/' . '../../bankcard4.php';
        $name = Yii::$app->request->post('name');
        $idcard = Yii::$app->request->post('idno');
        $bankcard = Yii::$app->request->post('bankcard');
        $mobile = Yii::$app->request->post('mobile');
        $bankname = Yii::$app->request->post('bankname');

        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);
        if ($member->email == '') {
            return 500;
        }

        if ($member->state != 3) {
            $backresult = bankcard($bankcard, $idcard, $name, $mobile);
            $backresults = json_decode($backresult, true);
           
            if ($backresults['code'] == 0 && $backresults['message'] == '成功') {
                $member->bank_name = $bankname;
                $member->realname = $name;
                $member->cartid = $idcard;
                $member->bankid = $bankcard;
                $member->bank_tel = $mobile;
                $member->state = 3;
                if ($member->save(false)) {
                    return 100;
                } else {
                    return 200;
                }
            } else {
                return 400;
            }
        } else {
            return 300;
        }

    }

    function SendEmails($email = '', $xgj_name = '', $xgj_pwd = '')
    {
        // $address=Yii::$app->request->post('email');
        $address = $email;
        // $title=Yii::$app->request->post('title');
        $title = '信管家';
        $content = '您的信管家账号为' . $xgj_name . ',密码为' . $xgj_pwd;
        $mail = Yii::$app->mailer->compose();
        $mail->setTo("$address");
        $mail->setSubject("$title");
        $mail->setHtmlBody("$content");
        if ($mail->send()) {
            return 100;
        } else {
            return 200;
        }

    }

    // 修改密码
    public function actionChangepass()
    {
        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);
        $oldPassWord = Yii::$app->request->post('oldPassWord');
        $newpwd1 = Yii::$app->request->post('newpwd1');
        $newpwd2 = Yii::$app->request->post('newpwd2');
        if (Yii::$app->getSecurity()->validatePassword($oldPassWord, $member->userspwd)) {
            if ($newpwd1 == $newpwd2) {
                $member->userspwd = Yii::$app->getSecurity()->generatePasswordHash($newpwd1);
                if ($member->save(false)) {
                    return 100;
                } else {
                    return 200;
                }
            } else {
                return 300;
            }
        } else {
            return 400;
        }

    }

    // 设置提现密码

    public function actionSetpass()
    {
        $uid = Yii::$app->session->get('user_id');
        $settradepass2 = Yii::$app->request->post('settradepass2');
        $settradepass1 = Yii::$app->request->post('settradepass1');
        $member = AdminMember::findOne($uid);
        if ($settradepass2 == $settradepass1) {
            $member->tx_pwd = Yii::$app->getSecurity()->generatePasswordHash($settradepass1);
            if ($member->save(false)) {
                return 100;
            } else {
                return 200;
            }
        } else {

            return 300;
        }

    }


    //修改密码 
    public function actionChangetpass()
    {
        $uid = Yii::$app->session->get('user_id');
        $loginpass = Yii::$app->request->post('loginpass');
//        $tradepassidno = Yii::$app->request->post('tradepassidno');
        $tradepass1 = Yii::$app->request->post('tradepass1');
        $tradepass2 = Yii::$app->request->post('tradepass2');
        $member = AdminMember::findOne($uid);
        if (Yii::$app->getSecurity()->validatePassword($loginpass, $member->userspwd)) {

//            if ($member->bankid != $tradepassidno) {
//                return 500;
//            }
            if ($tradepass1 == $tradepass2) {
                $member->tx_pwd = Yii::$app->getSecurity()->generatePasswordHash($tradepass1);
                if ($member->save(false)) {
                    return 100;
                } else {
                    return 200;
                }
            } else {
                return 300;
            }
        } else {
            return 400;
        }

    }

    //发送邮件 旧的
    public function actionSendEmail2()
    {
        // $address=Yii::$app->request->post('email');
        $address = Yii::$app->request->post('sendemail');

        // $title=Yii::$app->request->post('title');
        $title = '绑定邮箱';
        $code = rand(100000, 999999);
        Yii::$app->session['secode'] = $code;
        Yii::$app->session['semail'] = $address;
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('2885135623@qq.com');
        $mail->setSubject('绑定邮箱');
        $mail->setHtmlBody('200001');
        if ($mail->send()) {
            return 100;
        } else {
            return 200;
        }

    }

    //发送邮件 新的
    public function actionSendEmail()
    {
        $address = Yii::$app->request->post('sendemail');
        $subject = '掌期金服';
        $message = rand(10000,99999);
        $result = PublicFunction::sendmailer($address, $subject, $message);
        Yii::$app->session['secode']=$message;
        Yii::$app->session['semail']=$address;
        if ($result == 100) {
            return 100;
        } else {
            return 200;
        }
    }

    //绑定邮箱
    public function actionBangemail()
    {
        $uid = Yii::$app->session->get('user_id');
        $secode = Yii::$app->session->get('secode');
        $semail = Yii::$app->session->get('semail');
        $sendemail = Yii::$app->request->post('sendemail');
        $emailyzm = Yii::$app->request->post('emailyzm');
        $member = AdminMember::findOne($uid);
        if (isset($member->email) && !empty($member->email)) {
            return 200;
        }
        if ($secode != $emailyzm || $semail != $sendemail) {
            return 300;
        } else {
            $member->email = $sendemail;
            if ($member->save(false)) {
                return 100;
            }

        }


    }

    // 原邮箱验证获取验证码
    public function actionMailcode1()
    {
        $mailcode1 = Yii::$app->request->post('mailcode1');//当前邮箱
        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);
        $email = $member->email;
        $secode = Yii::$app->session->get('secode');
        $emailcode4 = Yii::$app->request->post('emailcode4');//邮箱验证码
        if ($secode != $emailcode4 || $mailcode1 != $email) {
            return 200;
        } else {
            return 100;
        }


    }


    public function actionMailcode2()
    {
        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);
        $mailcode2 = Yii::$app->request->post('mailcode2');//新邮箱
        $semail = Yii::$app->session->get('semail');
        $secode = Yii::$app->session->get('secode');
        $emailcode5 = Yii::$app->request->post('emailcode5');//邮箱验证码
        if ($secode != $emailcode5 || $mailcode2 != $semail) {
            return 200;
        } else {
            $member->email = $mailcode2;
            if ($member->save(false)) {

                return 100;
            }

        }
    }

    /*
        个人信息页面
    */


    /*
     * 提现
     * */
    public function actionTixian()
    {
        $id = Yii::$app->session['userid'];
        $user_info = AdminMember::find()->where(['id' => $id])->one();
        return $this->render('tixian', [
            'onelist' => $user_info,
            'xgj_info' => $this->xgj_info,
        ]);
    }

    /*
     * 根据状态查询订单信息
     * $where 条件
     * */
    public function addMoney($where = [])
    {
        $query = AdminOrder::find()->with('product')
            ->with('addBond')
            ->orderBy('admin_order.created_time DESC')
            ->andwhere(['admin_order.user_id' => $this->user_id])
            ->andWhere($where);
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => $this->pageSize,
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $order = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->andwhere($where)
            ->all();

        foreach ($order as $k => &$list) {
            $add_money = 0;
            foreach ($list['addBond'] as $arr1) {
                $add_money += $arr1['deposit_amout'];
            }
            $list['add_money'] = $add_money;
        }
        unset($list);
        $arr['order'] = $order;
        $arr['pages'] = $pagination;
        return $arr;
    }

    /*
     * 账户安全
     * */
    public function actionSafe()
    {
        //地区省
        $province = AdminRegions::find()->where(['level' => 1])->all();
        //根据省获取市的列表
        $city = '';
        //区
        $area = '';
        if ($this->onelist->bank_province && $this->onelist->bank_city) {
            $city = $this->actionGetCity($this->onelist->bank_province, $this->onelist->bank_city);
        }
        if ($this->onelist->city) {
            $area = $this->actionGetArea($this->onelist->city, $this->onelist->area);
        }
        $card_file = json_decode($this->onelist->cartfiles, true);
        $this->getView()->title = '账户安全-' . Tools::getSetting('5');
        $deal_tel = $this->dealTel($this->onelist->tel);
        return $this->render('safe', [
            'onelist' => $this->onelist,
            'deal_tel' => $deal_tel,
            'card_file' => $card_file,
            'province' => $province,
            'city' => $city,
            'area' => $area,
        ]);
    }

    /*
     * 绑定地址
     * */
    public function actionBindAddress()
    {
        $province = yii::$app->request->post('province');
        $city = yii::$app->request->post('city');
        $area = yii::$app->request->post('area');
        $address = yii::$app->request->post('address');
        if ($province && $city && $area && $address) {
            $model = $this->findModel($this->onelist->id);
            $model->province = $province;
            $model->city = $city;
            $model->area = $area;
            $model->address = $address;
            if ($model->save()) {
                return 100;
            }
        } else {
            return 200;
        }
    }


    /*
     * 操盘方案
     * */
    public function actionPlan()
    {
        $this->getView()->title = '操盘方案-' . Tools::getSetting('5');
        $this->pageSize = 10;
        //当前方案明细,即订单状态为已通过
        $order = $this->addMoney(['>', 'status', 1]);
        return $this->render('plan', [
            'user' => $this->onelist,
            'order' => $order['order'],
            'pages' => $order['pages'],
        ]);
    }

    /*
     * 终止方案记录
     * */
    public function actionEndPlanRecord()
    {
        $this->getView()->title = '终止方案记录-' . Tools::getSetting('5');
        $this->pageSize = 10;
        //终止方案记录,即订单状态为已终止和已平仓
        $order = $this->addMoney(['in', 'status', [3, 5]]);
        return $this->render('end-plan-record', [
            'user' => $this->onelist,
            'order' => $order['order'],
            'pages' => $order['pages'],
        ]);
    }

    /*
     * 追加保证金记录
     * */
    public function actionAddBondRecord()
    {
        $this->getView()->title = '追加保证金记录-' . Tools::getSetting('5');
        $query = AdminAddBond::find()->with('order')->orderBy('admin_add_bond.created_time DESC');
        $begin_time = strtotime(yii::$app->request->get('begin_time'));
        $end_time = strtotime(yii::$app->request->get('end_time'));
        $query = $query->andWhere(['admin_add_bond.user_id' => $this->user_id]);
        if ($begin_time) {
            $query = $query->andWhere(['>=', 'admin_add_bond.created_time', $begin_time]);
        }
        if ($end_time) {
            $query = $query->andWhere(['<=', 'admin_add_bond.created_time', $end_time]);
        }

        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        //当前方案明细,即订单状态为已通过
        $order = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->andWhere(['status' => 1])
            ->all();

        return $this->render('add-bond-record', [
            'order' => $order,
            'pages' => $pagination,
        ]);
    }

    /*
     * 账户充值
     * */
    public function actionRecharge()
    {
        $money = yii::$app->request->get('money') ?: '';
        $this->getView()->title = '账户充值-' . Tools::getSetting('5');
        // $recharge_type = ['0501'=>'支付宝','0503'=>'微信','3'=>'网银支付'];
        //第三方支付
        $member = AdminMember::findOne($this->user_id);
        $recharge_type = AdminPayType::find()->all();
        if (Yii::$app->request->post()) {
            $recharge_money = Yii::$app->request->post('ordermoney');
            $type = Yii::$app->request->post('changetype');
            if (!$type) {
               return 200;
            }
            if (!$recharge_money) {
                return 300;
            }
            //生成订单
            $charge = new AdminCharge();
            $charge->users_id = $this->user_id;
            $charge->money = $recharge_money;
            $charge->title = '用户充值';
            $charge->dates = time();
            $charge->pay_ordersid = $this->payOrdersId();
            $charge->ip = CommonFun::getClientIp();
            $charge->pay_type = $type;
            $charge->state = 0;
            //$this->onelist->money +=$recharge_money;
            if ($charge->save(false)) {
                $this->recharge_order_id = $charge->id;
                $this->recharge_type = $type;
                $msg['type'] = $type;
                $msg['order_id'] = $charge->id;
                $msg['recharge_money'] = $recharge_money;
                $msg['status'] = 600;
               /* return 1;*/
            } else {
                $msg['status'] = 400;
            }
            return json_encode($msg);
        }
        $bank_open = Common::getSysInfo(65);
        return $this->render('recharge', [
            'onelist' => $this->onelist,
            'recharge_type' => $recharge_type,
            'recharge_order_type' => $this->recharge_type,
            'recharge_order_id' => $this->recharge_order_id,
            'money' => $money,
            'member'=>$member,
            'open'=>$bank_open,
        ]);
    }

    /*
     * 生成流水号
     * */
    protected function payOrdersId()
    {
        return date('Ymd', time()) . substr(uniqid(microtime(true), true), 0, 20) * 10000;
    }

    /*
     * 确认订单页面
     * */
    public function actionRechargeOrder()
    {
        $recharge_type = ['0' => '请选择', '0501' => '支付宝', '0503' => '微信', '3' => '网银支付'];
        $order_id = yii::$app->request->get('order_id');
        if ($order_id) {
            $type_info = ['支付宝' => '0501', '微信' => '0503', '网银支付' => 3];
            $order_info = AdminCharge::findOne(['id' => $order_id]);
            if ($order_info->state == 1) {
                yii::$app->getSession()->setFlash('error', '该订单已支付');
                echo "<script>window.history.go(-1)</script>";
                exit;
            }
            $type = $type_info[$order_info->pay_type];
            $this->recharge_order_id = $order_info->id;
            $this->recharge_type = $type;
            return $this->render('recharge-order', [
                'onelist' => $this->onelist,
                'recharge_order_type' => $type,
                'recharge_order_id' => $order_info->id,
                'type' => $recharge_type[$type],
                'recharge_money' => $order_info->money,
            ]);
        }
        if (Yii::$app->request->post()) {
            $recharge_money = floatval(Yii::$app->request->post('recharge_money'));
            $type = Yii::$app->request->post('recharge_type');
            if (!$type) {
                yii::$app->getSession()->setFlash('error', '订单为空');
                echo "<script>window.history.go(-1)</script>";
                exit;
            }
            if (!$recharge_money) {
                yii::$app->getSession()->setFlash('error', '金额为空');
                echo "<script>window.history.go(-1)</script>";
                exit;
            }

            //生成订单
            $charge = new AdminCharge();
            $charge->users_id = $this->user_id;
            $charge->money = $recharge_money;
            $charge->title = '用户充值';
            $charge->dates = time();
            $charge->pay_ordersid = $this->payOrdersId();
            $charge->ip = CommonFun::getClientIp();
            $charge->pay_type = $recharge_type[$type];
            $charge->state = 0;
            if ($charge->save()) {
                $this->recharge_order_id = $charge->id;
                $this->recharge_type = $type;
                return $this->render('recharge-order', [
                    'onelist' => $this->onelist,
                    'recharge_order_type' => $type,
                    'recharge_order_id' => $charge->id,
                    'type' => $recharge_type[$type],
                    'recharge_money' => $recharge_money,
                ]);
            } else {
                echo "保存失败";
                exit;
            }
        }
    }

    /*
     * 支付页面
     * */
    public function actionRechargePay()
    {
        $order_id = yii::$app->request->post('order_id');
        $type = yii::$app->request->post('type');
        $charge = AdminCharge::findOne(['id' => $order_id]);
        $data = array("order_sn" => $order_id, "total_amount" => $charge - money);
        $result = TestController::actionShunfuPay($data, $type, '', '');
        return ($result['data']['qrCodeImg']);

    }

    /*
     * 银行转账
     * */
    public function actionBankGiro()
    {
        $this->getView()->title = '银行转账-'.Tools::getSetting('5');
        $setting = AdminSetting::findOne(65);
        if (Yii::$app->request->post()) {
            $money = intval(Yii::$app->request->post('money'));
            $orders_id = Yii::$app->request->post('orders_id');
            $bank_name = Yii::$app->request->post('bank_name');
            $img_url = $this->actionUpload($_FILES['img_url']);
            $title = Yii::$app->request->post('title');

            if($money==0 || !$orders_id || !$bank_name || !$img_url || !$title) {
                yii::$app->getSession()->setFlash('error', '请填写完整信息');
                echo "<script>window.history.go(-1)</script>";exit;
            }
            $model = new AdminChargexx();
            $model->users_id = $this->user_id;
            $model->money = $money;
            $model->title = $title;
            $model->pay_ordersid = $orders_id;
            $model->pay_type = $bank_name;
            $model->state = 0;
            $model->img_url = $img_url;
            $model->ip = CommonFun::getClientIp();
            $model->dates = time();
            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', '提交成功，请等待审核！');
                return $this->redirect(['member/bank-giro']);exit;
            } else {
                Yii::$app->getSession()->setFlash('error', '提交失败');
                return $this->redirect(['member/bank-giro']);exit;
            }

        } else{
            return $this->render('bank_giro',[
                'open'=>$setting['val'],
            ]);
        }


    }

    /*
     * 银行转账ajax提交
     * */
    public function actionBankGiroSub()
    {
        echo 44;
    }

    /*
     * 充值记录
     * */
    public function actionRechargeRecord()
    {
        $this->getView()->title = '充值记录-' . Tools::getSetting('5');
        $state = ['未支付', '已成功', '支付失败'];
        //1是线上，2是线下
        $charge_type = Yii::$app->request->get('charge_type') ?: 1;
        $where = [];
        $begin_time = strtotime(Yii::$app->request->get('begin_time'));
        $end_time = strtotime(yii::$app->request->get('end_time'));
        $query = AdminCharge::find()->orderBy('dates DESC,state ASC')->andwhere(['users_id' => $this->user_id]);
        $queryxx = AdminChargexx::find()->orderBy('dates DESC,state ASC')->andwhere(['users_id' => $this->user_id]);
        if ($begin_time) {
            $query = $query->andWhere(['>=', 'dates', $begin_time]);
            $queryxx = $queryxx->andWhere(['>=', 'dates', $begin_time]);
        }
        if ($end_time) {
            $query = $query->andWhere(['<=', 'dates', $end_time]);
            $queryxx = $queryxx->andWhere(['<=', 'dates', $end_time]);
        }
        $charge = $this->dealCharge($query, $where);
        $chargexx = $this->dealCharge($queryxx, $where);
        $model = $charge_type == 1 ? $charge : $chargexx;
        $bank_open = Common::getSysInfo(65);
        return $this->render('recharge_list', [
            'onelist' => $this->onelist,
            'model' => $model['charge'],
            'pages' => $model['page'],
            'charge_type' => $charge_type,
            'state' => $state,
            'open'=>$bank_open,
            'xgj_info' => $this->xgj_info,
        ]);

    }
    /**
     * 转账记录
     */
    public function actionBankRecord()
    {
        $this->getView()->title = '充值记录-' . Tools::getSetting('5');
        $state = ['未支付', '已成功', '支付失败'];
        //1是线上，2是线下
        $charge_type = Yii::$app->request->get('charge_type') ?: 1;
        $where = [];
        $begin_time = strtotime(Yii::$app->request->get('begin_time'));
        $end_time = strtotime(yii::$app->request->get('end_time'));
        $query = AdminCharge::find()->orderBy('dates DESC,state ASC')->andwhere(['users_id' => $this->user_id]);
        $queryxx = AdminChargexx::find()->orderBy('dates DESC,state ASC')->andwhere(['users_id' => $this->user_id]);
        if ($begin_time) {
            $query = $query->andWhere(['>=', 'dates', $begin_time]);
            $queryxx = $queryxx->andWhere(['>=', 'dates', $begin_time]);
        }
        if ($end_time) {
            $query = $query->andWhere(['<=', 'dates', $end_time]);
            $queryxx = $queryxx->andWhere(['<=', 'dates', $end_time]);
        }
        $charge = $this->dealCharge($query, $where);
        $chargexx = $this->dealCharge($queryxx, $where);
        $model = $charge_type == 0 ? $charge : $chargexx;
        return $this->render('bank_list', [
            'onelist' => $this->onelist,
            'model' => $model['charge'],
            'pages' => $model['page'],
            'charge_type' => $charge_type,
            'state' => $state,
            'xgj_info' => $this->xgj_info,
        ]);
    }
    /**
     * 提款记录
     * @param $query
     * @param array $where
     * @return mixed
     */

    /*
     * 处理充值记录
     * */
    protected function dealCharge($query, $where = [])
    {
        $this->pageSize = 10;
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => $this->pageSize,
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $charge = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $info['charge'] = $charge;
        $info['page'] = $pagination;
        return $info;
    }

    /*
     * 提款
     * 账户提现
     * */
  /* public function actionWithdraw()
    {
        $this->getView()->title = '账户提现-' . Tools::getSetting('5');
        if (Yii::$app->request->post()) {
            $money = yii::$app->request->post('money');
            $money = abs($money);
            $bank_code = yii::$app->request->post('bank_code');
            $tx_pwd = yii::$app->request->post('tx_pwd');
            //判断时间，在周一的6点十分到周六的四点 是可以充值的
            $beginThisweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('y'));
            //星期一六点十分的时间戳
            $be_time = $beginThisweek + 7 * 3600 + 10 * 60;
            $end_day_of_week = mktime(0, 0, 0, date('m'), date('d') - date('w') + 6, date('y'));
            $e_time = $end_day_of_week + 4.5 * 3600;
            if (!(time() > $be_time && time() < $e_time)) {
                return 900;
            } else if (floatval($money * Tools::getSetting(22) - 2) <= 0) {
                //提现的金额必须大于手续费
                return 2;
            } else if (!$this->onelist->tx_pwd) {
                return 11;
            } else if ($money == 0) {
                return 200;
            } else if (round($this->xgj_info->Available, 2) != round($this->xgj_info->Balance, 2)) {
                return 600;
            } else if ($money > $this->xgj_info->Available) {
                return 300;
            } else if ($bank_code != $this->onelist->bankid) {
                return 400;
            } else if (!Yii::$app->security->validatePassword($tx_pwd, $this->onelist->tx_pwd)) {
                return 500;
            }
            //生成提现记录,对金额处理
            return $this->detailTixian($money, $bank_code);
        } else {
            return $this->render('withdraw', [
                'onelist' => $this->onelist,
            ]);
        }
    }*/

    public function actionWithdraw()
    {
        $this->getView()->title = '账户提现-' . Tools::getSetting('5');
        $service_money = Tools::getSetting('26');  //手续费
        if (Yii::$app->request->post()) {

            $money = yii::$app->request->post('money');
            $money = abs($money);
//            $bank_code = yii::$app->request->post('bank_code');
            $tel = yii::$app->request->post('tel');
            $tx_pwd = yii::$app->request->post('tx_pwd');
            $pwd= AdminMember::findOne($this->user_id);

            //判断时间，在周一的6点十分到周六的四点 是可以充值的
//            $beginThisweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('y'));
//            //星期一六点十分的时间戳
//            $be_time = $beginThisweek + 7 * 3600 + 10 * 60;
//            $end_day_of_week = mktime(0, 0, 0, date('m'), date('d') - date('w') + 6, date('y'));
//            $e_time = $end_day_of_week + 4.5 * 3600;
//            if (!(time() > $be_time && time() < $e_time)) {
//                return 900;
//            }
             if (!$this->onelist->tx_pwd) {
                 //密码
                return 11;
            } else if (($money  - $service_money) <= 0) {
                //提现的金额必须大于手续费
                return 2;
            } else if (!$tel) {
                return 22;
            } else if ($money == 0) {
                return 200;
            }  else if ($money > $this->onelist->money - $service_money) {
                return 300;
            }

            //生成提现记录,对金额处理


            /*$totalmoney -= $money;*/
            if(Yii::$app->security->validatePassword($tx_pwd, $pwd->tx_pwd)){
                $province = Yii::$app->request->post('province');
                $city = Yii::$app->request->post('city');
                $model = new AdminTixian();
                $model ->users_id = $this->user_id;
                $model ->money  =$money;
                $model ->dates = time();
                $model ->service_money = $service_money;
                $model ->ip = CommonFun::getClientIp();
                $model ->bank_id = Yii::$app->request->post('addBankCode');
                $model ->bank_code = Yii::$app->request->post('code');
                $model ->bank_branch = Yii::$app->request->post('branch');
                $model ->province = AdminRegions::getRegionName($province);
                $model ->city = AdminRegions::getRegionName($city);
                $model ->tel = Yii::$app->request->post('tel');
                $model ->order_id = Common::getOrderSn();;
                $model ->name = Yii::$app->request->post('name');

                $this->onelist->money -=$money+$service_money;
                if($this->onelist -> save(false) && $model->save(false))
                {
                    return 666;
                }

            }else{
                return 100;
            }




        }
        $province = AdminRegions::getProvince();
        $city = AdminRegions::getRegion(1);

            return $this->render('withdraw', [
                'onelist' => $this->onelist,
                'service_money'=>$service_money,
                'province'=>$province,
                'city'=>$city,

            ]);


    }


    //省市联动
    public function actionGetcity1()
    {
        $provice_id = isset($_GET['provice_id']) ? $_GET['provice_id'] : 1;
        $provice = AdminRegions::find()->where(array('level' => 2, 'parent_id' => $provice_id))->all();
        $arr_provice = array();
        foreach ($provice as $val) {
            $arr_provice[$val->id] = $val->name;
        }
        //对获取到的地区数组转JSON格式
        header('Content-type: application/json');
        echo json_encode($arr_provice);
        exit();
    }
    /*
     * 处理提现
     * */
    protected function detailTixian($money, $bank_code)
    {
        $tixian = new AdminTixian();
        $tixian->users_id = $this->user_id;
        $tixian->money = floatval($money * Tools::getSetting(22) - 2);
        $tixian->z_money = $this->xgj_info->Balance;
        $tixian->k_money = $this->xgj_info->Available;
        $tixian->title = '用户提现';
        $tixian->dates = time();
        $tixian->ip = CommonFun::getClientIp();
        $tixian->bank_id = $this->onelist->bankcode;
        $tixian->bank_code = $this->onelist->bankid;
        $tixian->state = 0;
        $member = AdminMember::findOne(['id' => $this->user_id]);
        //$member->money -= $money;
        if ($tixian->validate()) {
            $account = AdminAccount::findOne($member->account_id);
            $account_pass = PublicController::decrypt($account->pass);
            $url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=' . $account->account . '&sapass=' . $account_pass . '&account=' . $member->xgj_name . '&amount=' . -$money . '&credit=0&currency=USD&remark=自动';
            if ($this->actionHttp($url) == 200) {
                //提交
                //$member->save();
                if ($tixian->save()) {
                    return 100;
                } else {
                    $url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=' . $account->account . '&sapass=' . $account_pass . '&account=' . $member->xgj_name . '&amount=' . $money . '&credit=0&currency=USD&remark=自动';
                    $this->actionHttp($url);
                    return 600;
                }
            }
        }

        //开启事物
        /*$transaction = Yii::$app->db->beginTransaction();
        if ($tixian->validate()) {
            try {
                $url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=dsf1110011001&sapass=967865&account='.$member->xgj_name.'&amount='.-$money.'&credit=0&currency=USD&remark=自动';
                if($this->actionHttp($url)==200) {
                    //提交
                    //$member->save();
                    $tixian->save();
                    $transaction->commit();
                    return 100;
                }
            } catch (Exception $e) {
                //捕获错误
                //返还钱到信管家
                $url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=dsf1110011001&sapass=967865&account='.$member->xgj_name.'&amount='.$money.'&credit=0&currency=USD&remark=自动';
                $this->actionHttp($url);
                $transaction->rollback();
            }
        }else{
            return 600;exit;
        }*/

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
        $arr = explode(' ', $data);
        return $arr[1];
    }

    /*
     * 提现记录
     * */
    public function actionWithdrawRecord()
    {
        $this->getView()->title = '提现记录-' . Tools::getSetting('5');
        $this->pageSize = 10;
        $query = AdminTixian::find()->andWhere(['users_id' => $this->onelist->id]);
        $begin_time = strtotime(Yii::$app->request->get('begin_time'));
        $end_time = strtotime(Yii::$app->request->get('end_time'));
        if ($begin_time) {
            $query = $query->andWhere(['>=', 'dates', $begin_time]);
        }
        if ($end_time) {
            $query = $query->andWhere(['<=', 'dates', $end_time]);
        }

        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => $this->pageSize,
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("id DESC")
            ->all();
        return $this->render('withdraw_list', [
            'pages' => $pagination,
            'model' => $list,
            'onelist' => $this->onelist,
            'xgj_info' => $this->xgj_info,
        ]);
    }

    /*
     * 银行卡管理
     * */
    public function actionBankCardManage()
    {


        return $this->render('bank-card-manage', [

            'onelist' => $this->onelist,

        ]);
    }

    /*
     * 推广赚钱
     * */
    public function actionPromote()
    {
        $this->getView()->title = '推广赚钱-' . Tools::getSetting('5');
        //查找下级用户
        $n_member = AdminMember::find()->andWhere(['vatation_code2' => $this->onelist->vatation_code])->all();
        $n_id = [];
        foreach ($n_member as $arr) {
            $n_id[] = $arr->id;
        }
        //查询我的下线通过审核的订单
        $n_order = AdminOrder::find()->andWhere(['in', 'user_id', $n_id])->andWhere(['>', 'status', 1])->all();
        //我的佣金
        $commission = 0;
        foreach ($n_order as $arr1) {
            $commission += $arr1->order_deposit;
        }
        //总推广佣金
        $commission = number_format($commission * Tools::getSetting(23) / 100, 2);
        //当前可提现的佣金
        $info['commission'] = number_format($this->onelist->promote_money, 2);
        //已通过的订单
        $info['num_ok'] = count($n_order);
        //下级用户数
        $info['user'] = count($n_member);
        //审核未通过的订单
        $info['num_no'] = count(AdminOrder::find()->andWhere(['status' => 0])->all());

        return $this->render('promote', [
            'onelist' => $this->onelist,
            'info' => $info,
        ]);
    }

    /*
    * $url 链接地址
    * $size 二维码大小
    * $margin 外边距
    * 生成二维码
    * */
    public function actionQrcode($url = '', $size = 4, $margin = 1)
    {
        //$url = $url?:Yii::$app->urlManager->createAbsoluteUrl(['user/register','vatation_code'=>$this->onelist->vatation_code]);
        //引入二维码生成类
        $url = yii::$app->request->get('url');
        $mchNo = yii::$app->request->get('mchNo');
        $order_sn = yii::$app->request->get('order_sn');
        $sign = yii::$app->request->get('sign');
        $timeStamp = yii::$app->request->get('timeStamp');
        $amount = yii::$app->request->get('amount');
        $url .= '&order_sn=' . $order_sn;
        $url .= '&sign=' . $sign;
        $url .= '&timeStamp=' . $timeStamp;
        $url .= '&amount=' . $amount;
        //        var_dump($url);exit;
        //$url = "http://pay.shunfu-pay.cn/shunfupay-admin/api/pay/unifyCode.html?mchNo=SZSF001-0000007&order_sn=2169&sign=a8f496eea7eb7d599867d0bfe7147073&timeStamp=1505354042&amount=0.01";
        require ROOT . '/phpqrcode/qrlib.php';
        //设置 header 头,直接输出图片
        Yii::$app->response->headers->set('Content-Type', 'image/png');
        //根据参数生成二维码 , 将其第二个参数值设为 false ,也就是不输出图片文件
        \QRcode::png($url, false, "L", $size, $margin);
        die();
    }

    /*
   * 推广记录
   * */
    public function actionPromoteRecord()
    {
        $this->getView()->title = '推广记录-' . Tools::getSetting('5');
        //查找下级用户
        $n_member = AdminMember::find()->andWhere(['vatation_code2' => $this->onelist->vatation_code])->all();
        $n_id = [];
        foreach ($n_member as $arr) {
            $n_id[] = $arr->id;
        }
        //查询我的下线通过审核的订单
        $query = AdminOrder::find()->joinWith('member')->andWhere(['in', 'admin_order.user_id', $n_id])->andWhere(['>', 'admin_order.status', 1]);
        $begin_time = strtotime(yii::$app->request->get('begin_time'));
        $end_time = strtotime(yii::$app->request->get('end_time'));
        if ($begin_time) {
            $query = $query->andWhere(['>=', 'created_time', $begin_time]);
        }
        if ($end_time) {
            $query = $query->andWhere(['<=', 'created_time', $end_time]);
        }

        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $n_order = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("id DESC")
            ->all();


        //$n_order = AdminOrder::find()->andWhere(['in','user_id',$n_id])->andWhere(['>','status',1])->all();
        return $this->render('promote-record', [
            'onelist' => $this->onelist,
            'model' => $n_order,
            'pages' => $pagination,
        ]);
    }

    //我要提盈
    public function actionProfit()
    {
        $this->getView()->title = '我要提盈-'.Tools::getSetting('5');
        $order_list = AdminOrder::find()->andWhere(['status'=>5])->all();
        if (Yii::$app->request->post()) {

            $money = floatval(yii::$app->request->post('ty_money'));
            $order_id = yii::$app->request->post('order_id');
           
            $model = AdminOrder::findOne(['order_id'=>$order_id]);
            if($model->profit == 0) {
                return 200;
            } else if($model->profit < $money) {
                return 300;
            } else if($money==0) {
                return 400;
            }
            //生成提现记录,对金额处理
            return $this->detailTiying($money, $order_id);
        } else {
            return $this->render('profit',[
                'order_list'=>$order_list,
            ]);
        }

    }

    /*
     * 处理提盈
     * */
    protected function detailTiying($money, $order_id)
    {
        $model = AdminOrder::findOne(['order_id' => $order_id]);
        $model->profit -= $money;
        $tiying = new AdminTiying();
        $tiying->users_id = $this->user_id;
        $tiying->money = $money;
        $tiying->title = '用户提盈';
        $tiying->dates = time();
        $tiying->ip = CommonFun::getClientIp();
        $tiying->bank_id = $this->onelist->bankcode;
        $tiying->bank_code = $this->onelist->bankid;
        $tiying->hsname = $model->order_sn;
        $tiying->state = 0;
        $member = AdminMember::findOne(['id' => $this->user_id]);
        $member->profit_money -= $money;

        //开启事物
        $transaction = Yii::$app->db->beginTransaction();
        if ($member->validate() && $tiying->validate() && $model->validate()) {
            try {
                $member->save();
                $tiying->save();
                $model->save();
                //提交
                $transaction->commit();
                return 100;
                exit;
            } catch (Exception $e) {
                //捕获错误
                $transaction->rollback();
            }
        } else {
            return 600;
            exit;
        }
    }

    /**
     * 个人信息
     * @return string
     */
    public function actionUser()
    {
        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);

        $region = new AdminRegions();
        $province = AdminRegions::find()->where(['id' => $member->province])->one();
        $city = AdminRegions::find()->where(['id' => $member->city])->one();
        $user_info= AdminUser::findOne($member->pid);
//         echo "<pre/>"; print_r($user_info);exit;
        return $this->render('user', [
            'province' => $province->name,
            'city' => $city->name,
            'member' => $member,
            'uname'=>$user_info->uname,//真实姓名
        ]);
    }

    /**
     * 修改个人信息
     * @return string
     */
    public function actionModifyUser()
    {
        $region = new AdminRegions();
        $province = AdminRegions::find()->where(['level' => 1])->all();
        $category = AdminRegions::find()->all();
        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);
        $city = AdminRegions::find()->where(['id' => $member->city])->all();

        if (Yii::$app->request->post()) {

            $member->nickname = Yii::$app->request->post('nickname');
            $member->head_img =Yii::$app->request->post('img9');
            $member->sex = Yii::$app->request->post('sex');
            $member->edu = Yii::$app->request->post('edu');
            $member->province = Yii::$app->request->post('c1');
            $member->city = Yii::$app->request->post('c2');
            $member->marry = Yii::$app->request->post('marry');
            $member->address = Yii::$app->request->post('address');
            if (empty($member->email)) {
                $member->email = Yii::$app->request->post('email');
            } else {

                $member->email = $member->email;
            }

            if ($member->save(false)) {
                echo "<script>window.location.href='user'</script>";
                exit;
            }
            return $this->render('modify_user', [
                'member' => $member,
                'province' => $province,
                'city' => $city,

            ]);

        } else {
            return $this->render('modify_user', [
                'member' => $member,
                'province' => $province,
                'city' => $city,
            ]);
        }

    }

    /*
     * 根据省id获取市的信息
     * */
    public function actionGetCity($provine = '', $city_id = '')
    {
        $id = $provine ?: Yii::$app->request->post('id');
        $uid = Yii::$app->session->get('user_id');
        $member = AdminMember::findOne($uid);
        $city = AdminRegions::find()->where(['parent_id' => $id])->all();
        $arr = "<option value='0'>--请选择--</option>";
        foreach ($city as $list) {
            if ($list->id == $member->city) {
                $selected = "selected";
            } else {
                $selected = '';
            }
            $arr .= "<option " . $selected . " value='" . $list->id . "' >$list->name</option>";
        }
        return $arr;
    }

    /*
     * 根据id获取区的信息
     * */
    public function actionGetArea($city_id = '', $area_id = '')
    {
        $id = $city_id ?: yii::$app->request->post('id');
        $city = AdminRegions::find()->where(['parent_id' => $id])->all();
        $arr = "<option value='0'>--请选择--</option>";
        foreach ($city as $list) {
            if ($list->id == $this->onelist->area) {
                $selected = "selected";
            } else {
                $selected = '';
            }
            $arr .= "<option " . $selected . " value='" . $list->id . "' >$list->name</option>";
        }
        return $arr;
    }
    // public function actionUpdateUser()
    // {
    //     return $this->render('modify_user');
    // }

    //提盈记录
    public function actionProfitRecord()
    {
        $this->getView()->title = '提盈记录-' . Tools::getSetting('5');
        $query = AdminTiying::find();
        $begin_time = strtotime(yii::$app->request->get('begin_time'));
        $end_time = strtotime(yii::$app->request->get('end_time'));
        if ($begin_time) {
            $query = $query->andWhere(['>=', 'dates', $begin_time]);
        }
        if ($end_time) {
            $query = $query->andWhere(['<=', 'dates', $end_time]);
        }

        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("id DESC")
            ->all();

        return $this->render('profit-record', [
            'pages' => $pagination,
            'model' => $list,
        ]);
    }

    /**
     * 我的配资
     * @return \yii\web\Response
     */
    public function actionWithCapital()
    {
        return $this->render('with-capital');
    }

    /*
     * 退出
     * */
    public function actionOut()
    {
        unset(Yii::$app->session['access']);
        unset(Yii::$app->session['openid']);
        unset(Yii::$app->session['islogin']);
        unset(Yii::$app->session['userid']);
        unset(Yii::$app->session['qqlogin']);
        unset(Yii::$app->session['access_token']);
        unset(Yii::$app->session['openid']);
        unset(Yii::$app->session['wxlogin']);
        // Yii::$app->runController('index/index');
        return $this->redirect(['index/index']);
        // Url::toRoute('/index/index');
    }


    /*
     * 根据id获取用户当前信息
     * */
    protected function findModel($id)
    {
        if (($model = AdminMember::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
     * 处理手机号
     * */
    protected function dealTel($tel)
    {
        return substr_replace($tel, '********', 3, 8);
    }

    /*
     * 改变订单状态
     * */

    public function actionChangeStatus()
    {
        //$user_id = Yii::$app->session['userid'];
        $order_id = yii::$app->request->post('order_id');
        $status = yii::$app->request->post('status');
        $model = AdminOrder::findOne($order_id);
        $model->status = $status;
        if ($model->save()) {
            return 1;
            exit;
        }

    }

    /*
     * 修改提现密码
     * */
    public function actionChangeTxPwd()
    {
        $pwd1 = yii::$app->request->post('tx_pwd1');
        $pwd2 = yii::$app->request->post('tx_pwd2');
        $vercode = yii::$app->request->post('vercode');
        if (empty(Yii::$app->session['validate'])) {
            //验证码不正确
            echo 3;
            exit;
        } else if (!empty(Yii::$app->session['validate']) && Yii::$app->session['validate'] != $vercode) {
            echo 3;
            exit;
        }
        if ($pwd1 != $pwd2) {
            //两次密码不一样
            echo 1;
        } else {
            $model = AdminMember::findOne(['id' => $this->user_id]);
            $model->tx_pwd = Yii::$app->security->generatePasswordHash($pwd1);
            if ($model->save(false)) {
                //修改成功
                echo 4;
                exit;
            } else {
                //修改失败
                echo 2;
                exit;
            }
        }
    }

    /*
     * 修改密码前根据会员id验证旧密码
     * */
    public function actionValidateOldPwd()
    {
        $old_password = Yii::$app->request->post('old_pwd');
        $onelist = $this->onelist;
        $hash_password = $onelist['userspwd'];
        $bool = Yii::$app->security->validatePassword($old_password, $hash_password);
        if (empty($bool)) {
            echo 200;
            exit;
        } else {
            echo 100;
            exit;
        }
    }

    /*
     * 修改登录密码
     * */
    public function actionChangePwd()
    {
        $old_password = Yii::$app->request->post('old_pwd');
        $new_m1 = Yii::$app->request->post('new_m1');
        $new_m2 = Yii::$app->request->post('new_m2');
        $onelist = $this->onelist;
        $hash_password = $onelist['userspwd'];
        $bool = Yii::$app->security->validatePassword($old_password, $hash_password);
        if (empty($bool)) {
            //旧密码不正确
            echo 200;
            exit;
        }
        if ($new_m1 != $new_m2) {
            //两次密码不同
            echo 300;
            exit;
        }
        $model = AdminMember::findOne(['id' => $this->user_id]);
        $model->userspwd = Yii::$app->security->generatePasswordHash($new_m1);
        if ($model->save()) {
            echo 100;
            exit;
        } else {
            //修改失败
            echo 400;
            exit;
        }

    }


    //设置登录密码
    public function actionSetpwd()
    {
        $setpwd = Yii::$app->request->post('setpwd');
        $resetpwd = Yii::$app->request->post('resetpwd');
        if ($setpwd == $resetpwd) {
            $model = AdminMember::findOne(['id' => $this->user_id]);
            $model->userspwd = Yii::$app->security->generatePasswordHash($setpwd);
            if ($model->save()) {
                echo "success";
                exit();
            } else {
                echo "密码设置失败";
                exit();
            }
        } else {
            echo "两次密码输入不一致";
            exit();
        }

    }

    /*
     * 修改绑定的手机号
     * */
    public function actionChangeTel()
    {
        $tel = yii::$app->request->post('tel');
        $vercode = yii::$app->request->post('vercode');
        if (($vercode != Yii::$app->session['validate']) || !Yii::$app->session['validate']) {
            //验证码不正确
            echo 300;
            exit;
        }
        if ($tel != Yii::$app->session['code_tel']) {
            //不是当前手机号
            echo 400;
            exit;
        }
        $model = AdminMember::findOne(['id' => $this->user_id]);
        $model->tel = $tel;
        if ($model->save()) {
            echo 100;
            exit;
        } else {
            //修改失败
            echo 200;
            exit;
        }
    }


    //设置手机号
    public function actionSettingtel()
    {
        $tel = yii::$app->request->post('tel');
        $vercode = yii::$app->request->post('vercode');
        if (($vercode != Yii::$app->session['validate']) || !Yii::$app->session['validate']) {
            //验证码不正确
            echo 300;
            exit;
        } else {
            $model = AdminMember::findOne(['id' => $this->user_id]);
            $model->tel = $tel;
            if ($model->save()) {
                echo 100;
                exit;
            } else {
                echo 200;
                exit;
            }
        }

    }


    /*
     * 实名认证
     * */
    public function actionCertification()
    {
        $model = AdminMember::findOne(['id' => $this->user_id]);
        $name = yii::$app->request->post('real_name');
        $id_card = yii::$app->request->post('id_card');
        $card_zm = yii::$app->request->post('card_zm');
        $card_fm = yii::$app->request->post('card_fm');
        $card_case = yii::$app->request->post('card_case');
        $is = $this->actionIsIdCard($id_card);
        if ($is == 200) {
            return 200;
        }
        if ($card_zm && $name && $id_card && $card_fm) {
            $arr['zm'] = $card_zm;
            $arr['fm'] = $card_fm;
            //$arr['case'] = $card_case;
            $model->realname = $name;
            $model->cartid = $id_card;
            $model->cartfiles = json_encode($arr);
            if ($model->bankid) {
                $model->state = 2;
                $model->is_top = 1;
            }


            if ($model->save()) {
                return 100;
                //Yii::$app->getSession()->setFlash('success', '保存成功');
            } else {
                //echo 111;exit;
                return 300;
                //Yii::$app->getSession()->setFlash('error', '保存失败');
            }
        } else {
            // echo 222;exit;
            return 300;
            //Yii::$app->getSession()->setFlash('error', '保存失败');
        }
        // return $this->redirect(['member/safe']);

    }

    /*
     * 上传图片
     * */
    public function actionUpload($file = '')
    {
        $file = $file ?: $_FILES['file'];
        $uploaddir = 'uploads/file/';
        $info = pathinfo($file['name'], PATHINFO_EXTENSION);
        $dir = $uploaddir . date('Ymd') . rand(10000, 99999) . '.' . $info;
        if (move_uploaded_file($file['tmp_name'], $dir)) {
            $re['dir'] = '/' . $dir;
            $re['msg'] = "上传成功";
            $re['status'] = 200;
            return $re['dir'];
        } else {
            $re['msg'] = "上传失败";
            echo $re['msg'];
            exit;
        }
    }

    /*
     * 检查身份证号是否已绑定账户
     * */

    public function actionIsIdCard($id_card = '')
    {
        if ($id_card == '') {
            $id_card = yii::$app->request->post('card_id');
        }
        //$is = AdminMember::find()->andWhere(['cartid'=>$id_card])->andWhere(['<>','id',$this->user_id])->one();
        if ($this->onelist->cartid) {
            $is = AdminMember::find()->andWhere(['cartid' => $id_card])->andWhere(['<>', 'id', $this->user_id])->one();
        } else {
            $is = AdminMember::find()->andWhere(['cartid' => $id_card])->one();
        }

        if ($is) {
            //身份证号已绑定了账号
            return 200;
            exit;
        } else {
            return 100;
        }
    }

    /*
     * 绑定银行卡
     * */
    public function actionBindBank()
    {
        $bank_id = yii::$app->request->post('bank_id');
        $bank_name = yii::$app->request->post('bank_name');
        $bank_province = yii::$app->request->post('bank_province');
        $bank_city = yii::$app->request->post('bank_city');
        $bank_address = yii::$app->request->post('bank_address');
        $bankname = yii::$app->request->post('bankname');
        $bank_pic = yii::$app->request->post('bank_pic');
        if (!is_numeric($bank_id)) {
            //银行卡号不正确
            echo 200;
            exit;
        }
        if (!preg_match('/[\x{4e00}-\x{9fff}]/u', $bank_name)) {
            //银行名称不正确
            echo 300;
            exit;
        }
        if (!($bank_province && $bank_city && $bank_address)) {
            return 500;
        }
        if ($bankname != $this->onelist->realname) {
            return 600;
        }
        $model = AdminMember::findOne(['id' => $this->user_id]);
        $model->bankid = $bank_id;
        $model->bankcode = $bank_name;
        $model->bank_province = $bank_province;
        $model->bank_city = $bank_city;
        $model->bankaddress = $bank_address;
        $model->bank_name = $bankname;
        $model->bank_pic = $bank_pic;
        if ($model->cartid) {
            $model->state = 2;
            $model->is_top = 1;
        }


        if ($model->save()) {
            echo 100;
            exit;
        } else {
            //保存失败
            echo 400;
            exit;
        }
    }

    /*
     * 修改头像
     * */
    public function actionChangeHeadImg()
    {
        //$head_img = $this->actionUpload($_FILES['head_img']);
        $head_img = yii::$app->request->post('head_img');
        $model = AdminMember::findOne(['id' => $this->user_id]);
        $model->head_img = $head_img;
        if ($model->save()) {
            return 100;
        }
    }
    /*
    * 入金
    * */
    public function actionZgRecharge(){
        $money = Yii::$app->request->post('money');
        $pwd = Yii::$app->request->post('payPwd');
        $type = Yii::$app->request->post('type'); //1入金 2 出金
            if(!Yii::$app->security->validatePassword($pwd, $this->onelist->tx_pwd)){
                return json_encode(['status'=>200,'msg'=>'密码错误']);
            }else if($type == 1){
                if($money > $this->onelist->money){
                    return json_encode(['status'=>200,'msg'=>'用户余额不足']);
                }
            }

        $zg = new Zg();
        if($type == 1){
            $money = abs(floatval($money));
        }else{
            $money = -abs(floatval($money));
        }
        if(!$this->onelist->xgj_name){
            return json_encode(['status'=>200,'msg'=>'您还未绑定信管家账号']);
        }
        $result = $zg->actionDeposit($this->onelist->xgj_name,$money);
        if($result['status'] == 200){
            return json_encode(['status'=>200,'msg'=>$result['msg']]);
        }else{
            $user = AdminMember::findOne($this->user_id);
            $user->money -= $money;
            $deposit = New AdminDeposit();
            $deposit->uid = $this->user_id;
            $deposit->money = abs($money);
            $deposit->time = time();
            $deposit->type = $type;
            $transaction = Yii::$app->db->beginTransaction();
                try {
                    $user->save();
                    $deposit->save();
                    //提交
                    $transaction->commit();
                    return json_encode(['status'=>100,'msg'=>'成功']);
                } catch (Exception $e) {
                    //捕获错误
                    $transaction->rollback();
                    return json_encode(['status'=>200,'msg'=>'失败']);
                }
        }
    }

    /*
     * 验证订单是否存在
     * */
    public function actionValidateOrderId($order_id = '')
    {
        if (!$order_id) {
            $order_id = yii::$app->request->post('order_id');
        }
        $model = AdminOrder::find()->andWhere(['user_id' => $this->user_id])->andWhere(['order_id' => $order_id])->one();
        $msg = [];
        if ($model) {
            $msg['state'] = 100;
            $msg['order_id'] = $order_id;
            return json_encode($msg);
        } else {
            $msg['state'] = 500;
            $msg['order_id'] = '';
            return json_encode($msg);
        }
    }

    /*
         * 验证用户账户余额
         * */
    public function actionValidateUserMoney($order_money = 0)
    {
        $zh_money = $this->xgj_info->Available;
        if ($order_money == 0) {
            //用户充值的钱
            $order_money = intval(yii::$app->request->post('order_money'));
        }
        //转换成人民币
        $order_money = $order_money * Tools::getSetting(22);
        //账户余额
        $money = AdminMember::findOne(['id' => $this->user_id])->money;
        $msg = [];
        if ($money == 0) {
            //账户余额为0
            $msg['state'] = 200;
            $msg['money'] = $money;
            return json_encode($msg);
            exit;
        } else if ($money < $order_money) {
            //充值的钱大于账户余额
            $msg['state'] = 300;
            $msg['money'] = $money;
            return json_encode($msg);
            exit;
        } else {
            $msg['state'] = 100;
            $msg['money'] = $money;
            return json_encode($msg);
            exit;
        }
    }

    /*
     * 追加保证金
     * */
    public function actionAddBond()
    {
        $order_id = $bank_id = yii::$app->request->post('order_id');
        $order_money = $bank_id = yii::$app->request->post('order_money');
        $des = yii::$app->request->post('des');
        $order_msg = json_decode($this->actionValidateOrderId($order_id), true);
        if ($order_msg['state'] == 500) {
            //订单不存在
            return $order_msg['state'];
            exit;
        }
        $msg = json_decode($this->actionValidateUserMoney($order_money), true);
        if ($msg['state'] == 200) {
            //账户余额为0
            return 200;
            exit;
        } else if ($msg['state'] == 300) {
            //充值的钱大于账户余额
            return 300;
            exit;
        }
        //处理金额
        return $this->actionDealAddBond($order_msg, $order_money, $des);
    }

    /*
     * 追加金额事物
     * */
    public function actionDealAddBond($order_msg, $order_money, $des)
    {
        $member = AdminMember::findOne(['id' => $this->user_id]);
        $member->money = $member->money - $order_money;
        $add_bond = new AdminAddBond();
        $add_bond->user_id = $this->user_id;
        $add_bond->order_id = $order_msg['order_id'];
        $add_bond->deposit_amout = $order_money;
        $add_bond->description = $des;
        $add_bond->status = 1;
        $add_bond->created_time = time();
        //开启事物
        $transaction = Yii::$app->db->beginTransaction();
        if ($member->validate() && $add_bond->validate()) {
            try {
                $member->save();
                $add_bond->save();
                //提交
                $transaction->commit();
                return 100;
                exit;
            } catch (Exception $e) {
                //捕获错误
                $transaction->rollback();
            }
        } else {
            return 400;
            exit;
        }

    }

    /*
     * 计算总览
     * */
    public function actionDealAllMoneyInfo()
    {
        $order = AdminOrder::find()->andWhere(['user_id' => $this->user_id])->all();
        $member = AdminMember::findOne(['id' => $this->user_id]);
        //总资产
        $all_money = 0;
        //配资授信
        $money = 0;
        //风险保证金
        $deposit = 0;
        //冻结金额,包括配资金额
        $freeze = 0;
        //净资产
        $assets = 0;
        foreach ($order as $arr) {
            $all_money += ($arr->order_deposit + $arr->order_money);
            $money += $arr->order_money;
            $deposit += $arr->order_deposit;
            $assets += ($arr->order_deposit - $arr->loss / Tools::getSetting(22));
        }
        $all_money += ($member->money + $member->profit_money) / Tools::getSetting(22);
        $assets += ($member->money + $member->profit_money) / Tools::getSetting(22);
        //计算分险保证金,操盘中，即订单状态为2,4,6
        $order2 = AdminOrder::find()->andWhere(['user_id' => $this->user_id])->andWhere(['in', 'status', [2, 4, 6]])->all();
        foreach ($order2 as $arr) {
            $freeze += ($arr->order_deposit + $arr->order_money);
        }
        $money_info['all_money'] = number_format($all_money, 2);
        $money_info['money'] = number_format($money, 2);
        $money_info['deposit'] = number_format($deposit, 2);
        $money_info['freeze'] = number_format($freeze, 2);
        $money_info['assets'] = number_format($assets, 2);
        return $money_info;
    }

    /*
     * 开户
     * */
    public function actionOpenAccount()
    {
        $model = AdminMember::findOne(['id' => $this->user_id]);
        if($model->isopen==1){
            return $this->render('kh3',[
                'member'=>$model,
            ]);
        }
        $account = AdminHousekeeper::find()->where(['states'=>0])->one();
        //echo $_SERVER['HTTP_HOST'];exit;
        if($account){
            $zg = new Zg();
            $kh = $zg->actionCreateAccount($account->xgj_name);
            if($kh['code']==0){
                $model->xgj_name = $kh['account'];
                $model->xgj_pwd = $kh['pwd'];
                $model->isopen = 1;
                $account->states = 1;
                $account->xgj_pwd = $kh['pwd'];
                $account->uid = $this->user_id;
                $account->agentid = $model->pid;
                $trans = Yii::$app->db->beginTransaction();
                try{
                    $model->save(false);
                    $account->save(false);
                    $trans->commit();
                    return $this->render('kh3',[
                        'member'=>$model,
                    ]);
                }catch(Exception $e){
                    $trans->rollBack();
                    yii::$app->getSession()->setFlash('error', '请联系客服进行客户，或者稍后重试');
                    echo "<script>window.history.go(-1)</script>";
                    exit();
                }

            }else{
                yii::$app->getSession()->setFlash('error', $kh['msg']);
                echo "<script>window.history.go(-1)</script>";
                exit();
            }

        }else{
            yii::$app->getSession()->setFlash('error', '请联系客服进行客户，或者稍后重试');
            echo "<script>window.history.go(-1)</script>";
            exit();
        }
    }

    /*
    * 随机获取一名管家并修改其状态
    * */
    public function actionRandomgj()
    {
        //$list = AdminHousekeeper::find()->where(array('states' => 0))->all();
        $one = AdminHousekeeper::findOne(['states' => 0]);
        if ($one) {
            /*foreach ($list as $k => $v) {
                $ids[] = $v['xgj_id'];
            }*/
            //$rand_key = array_rand($ids, 1);
            return $one->xgj_id;
        } else {
            yii::$app->getSession()->setFlash('error', '请稍后再试');
            echo "<script>window.history.go(-1)</script>";
            exit();
        }
    }

    /*
     * 判断是否完成支付
     * */
    public function actionIsPay()
    {
        if (Yii::$app->request->post()) {
            $order_id = yii::$app->request->post('order_id');
            $charge = AdminCharge::findOne(['id' => $order_id]);
            if ($charge->state == 1) {
                return 100;
            }
        }
    }

    /*
     *
     * 判断身份证信息和银行卡信息，都存在的话返回状态发送短信
     * */
    public function actionValidateCardBank()
    {
        if ($this->onelist->cartid && $this->onelist->bankid) {
            return 100;
        } else {
            return 200;
        }
    }

    /*
     * 点击支付
     * */
    public function actionOrderPay()
    {
        //判断时间，在周一的6点十分到周六的四点 是可以充值的
        $beginThisweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('y'));
        //星期一六点十分的时间戳
        $be_time = $beginThisweek + 7 * 3600 + 10 * 60;
        $end_day_of_week = mktime(0, 0, 0, date('m'), date('d') - date('w') + 6, date('y'));
        $e_time = $end_day_of_week + 4.5 * 3600;
        if (!(time() > $be_time && time() < $e_time)) {
            return 900;
        }
        $recharge_type = ['0501' => '支付宝', '0503' => '微信', '3' => '网银支付'];
        $money = (Yii::$app->request->post('money'));
        $type = Yii::$app->request->post('type');
        if ($this->onelist->state != 3) {
            return 400;
        }
        if (!$type) {
            return 200;
        }
        if (!$money) {
            return 300;
        }

        //生成订单
        $charge = new AdminCharge();
        $charge->users_id = $this->user_id;
        $charge->money = $money;
        $charge->fee_money = $money * Tools::getSetting(37) / 100;
        $charge->title = '用户充值';
        $charge->dates = time();
        $charge->pay_ordersid = $this->payOrdersId();
        $charge->ip = CommonFun::getClientIp();
        $charge->pay_type = $recharge_type[$type];
        $charge->state = 0;
        if ($charge->save()) {
            $order_id = $charge->id;
            $total_amount = intval(($money - $money * Tools::getSetting(37) / 100) * 100) / 100;
            $data = array("order_sn" => $order_id, "total_amount" => $money);
            $file = "qrdd.txt";
            file_put_contents($file, $data['order_sn'] . ',' . $data['total_amount'] . ',' . date('YmdH:i:s'));
            $result = TestController::actionShunfuPay($data, $type, '', '');
            $ss = [];
            $ss['img'] = $result['data']['qrCodeImg'];
            $ss['order_id'] = $order_id;
            $ss['type'] = $recharge_type[$type];
            $ss['money'] = $money;
            return (json_encode($ss));
        } else {
            return 400;
        }
    }

    /*
     * 获取用户信息
     * */
    public function actionGetInfo()
    {
        $id = Yii::$app->session['userid'];
        $onelist = AdminMember::find()->where(array('id' => "$id"))->asArray()->one();
        return json_encode($onelist);
    }

    /*
     * 网银支付
     * */
    public function actionTest()
    {
        var_dump(yii::$app->request->post('inst_code'));
        exit;
    }

    /*
    * 点击支付
    * */
    public function actionBankPay()
    {
        //判断时间，在周一的6点十分到周六的四点 是可以充值的
        $beginThisweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('y'));
        //星期一六点十分的时间戳
        $be_time = $beginThisweek + 7 * 3600 + 10 * 60;
        $end_day_of_week = mktime(0, 0, 0, date('m'), date('d') - date('w') + 6, date('y'));
        $e_time = $end_day_of_week + 4.5 * 3600;
        if (!(time() > $be_time && time() < $e_time)) {
            yii::$app->getSession()->setFlash('error', '充值的时间段为周一的六点十分到周六的四点');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }
        $recharge_type = ['0501' => '支付宝', '0503' => '微信', '3' => '网银支付'];
        $money = floatval(Yii::$app->request->get('money'));
        $type = intval(Yii::$app->request->get('type'));
        if ($this->onelist->state != 3) {
            yii::$app->getSession()->setFlash('error', '请认证');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }
        if (!$type) {
            yii::$app->getSession()->setFlash('error', '请选择支付方式');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }
        if (!$money) {
            yii::$app->getSession()->setFlash('error', '请填写支付金额');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }
        if ($money < 0) {
            yii::$app->getSession()->setFlash('error', '请填写正确的支付金额');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }

        //生成订单
        $charge = new AdminCharge();
        $charge->users_id = $this->user_id;
        $charge->money = $money;
        $charge->fee_money = $money * Tools::getSetting(37) / 100;
        $charge->title = '用户充值';
        $charge->dates = time();
        $charge->pay_ordersid = $this->payOrdersId();
        $charge->ip = CommonFun::getClientIp();
        $charge->pay_type = $recharge_type[$type];
        $charge->state = 0;
        if ($charge->save()) {
            /*$arr['ip'] = CommonFun::getClientIp();
            $arr['money'] = $money;
            $arr['order_no'] = $charge->id;
            return json_encode($arr);exit;*/

            return $this->render('bank', [
                'xgj_info' => $this->xgj_info,
                'onelist' => $this->onelist,
                'order_no' => $charge->id,
                'money' => $money,
                'buyer_ip' => CommonFun::getClientIp(),
            ]);
        } else {
            yii::$app->getSession()->setFlash('error', '确认订单失败');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }
    }

    /*
     * 网银支付
     * */
    public function actionBank()
    {
        $order_id = yii::$app->request->get('order_id');
        $charge = AdminCharge::findOne(['id' => $order_id]);
        if (!$charge) {
            yii::$app->getSession()->setFlash('error', '该订单不存在');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }
        if ($charge->state == 1) {
            yii::$app->getSession()->setFlash('error', '该订单已经支付');
            echo "<script>window.history.go(-1)</script>";
            exit;
        }
        return $this->render('bank', [
            'xgj_info' => $this->xgj_info,
            'onelist' => $this->onelist,
            'order_no' => $charge->id,
            'money' => $charge->money,
            'buyer_ip' => CommonFun::getClientIp(),
        ]);
    }

    /*
     * 前台银联支付成功页面
     * */
    public function actionBankPayOk()
    {
        $file = "success.txt";
        file_put_contents($file, '银联测试1' . date('Ymd H:i:s'));
        $verifyResult = "false";
        $key = "FlIG2WvbeEb4d5N";//密钥
        $signMessage = "";
        $signMessage .= $this->isEmpty($_REQUEST["Name"]) ? "" : $_REQUEST["Name"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["Version"]) ? "" : $_REQUEST["Version"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["Charset"]) ? "" : $_REQUEST["Charset"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TraceNo"]) ? "" : $_REQUEST["TraceNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["MsgSender"]) ? "" : $_REQUEST["MsgSender"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["SendTime"]) ? "" : $_REQUEST["SendTime"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["InstCode"]) ? "" : $_REQUEST["InstCode"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["OrderNo"]) ? "" : $_REQUEST["OrderNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["OrderAmount"]) ? "" : $_REQUEST["OrderAmount"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransNo"]) ? "" : $_REQUEST["TransNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransAmount"]) ? "" : $_REQUEST["TransAmount"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransStatus"]) ? "" : $_REQUEST["TransStatus"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransType"]) ? "" : $_REQUEST["TransType"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransTime"]) ? "" : $_REQUEST["TransTime"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["MerchantNo"]) ? "" : $_REQUEST["MerchantNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["ErrorCode"]) ? "" : $_REQUEST["ErrorCode"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["ErrorMsg"]) ? "" : $_REQUEST["ErrorMsg"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["Ext1"]) ? "" : $_REQUEST["Ext1"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["SignType"]) ? "" : $_REQUEST["SignType"] . "|";
        $signMessage .= $key;

        $signMsg = strtoupper(md5($signMessage));
        $org_signMsg = $_REQUEST["SignMsg"];

        if (isset($org_signMsg) && strcasecmp($signMsg, $org_signMsg) === 0) {
            $verifyResult = "true";
        }
        $file = "success.txt";

        file_put_contents($file, '银联测试2' . date('Ymd H:i:s'));
        $SignMsgMerchant = $signMsg;

        //echo "比对结果:" . $verifyResult. "****<br/>";
        if (isset($verifyResult) && strcasecmp($verifyResult, "true") === 0) {
            $file = "success.txt";
            file_put_contents($file, '银联测试3' . date('Ymd H:i:s'));
            //echo "签名验证成功#######<br/>";
            $transStatus = $_REQUEST["TransStatus"];
            if (isset($transStatus) && strcasecmp(trim($transStatus), "01") === 0) {
                $file = "success.txt";
                file_put_contents($file, $_REQUEST['TransAmount'] . date('Ymd H:i:s'));
                yii::$app->getSession()->setFlash('success', '充值完成');
                $url = Url::toRoute('member/index');
                $this->redirect($url);
            } else {
                //echo "更新订单失败";
            }
        }
    }

    /*
    *
    * */
    public function isEmpty($var)
    {
        if (isset($var) && $var != "") {
            return false;
        } else {
            return true;
        }
    }
//交易账号
    public function actionTrading()
    {
        $uid=$this->user_id;
        $member = AdminMember::findone($uid);
        $zg = new Zg();
        $ql = $zg->actionQueryAccount($member->xgj_name);
        $Balance = $ql['Balance'];//当前权益
        $noticeOne = AdminContent::find()->where(['sortid'=>11])->orderBy('addtime desc')->one();
        $deposit = AdminDeposit::find()->where(['uid'=>$this->user_id])->orderBy('time desc')->all();
        return $this->render('trading', [
            'money'=>$member->money,
            'user_name'=>$member->xgj_name,
            'user_pwd'=>$member->xgj_pwd,
            'noticeOne'=>$noticeOne,
            'balance'=>$Balance,
            'deposit'=>$deposit
        ]);
    }
    //图片上传
    public function actionUpload1()
    {
        $member = AdminMember::findone($this->user_id);
        $file=is_file("/www/wwwroot/www.zjdt666.com".$member->head_img);
        $uploaddir = 'backend/web/plugins/uploads/';
        $info=pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
        $dir=$uploaddir .date('Ymd').rand(10000,99999).'.'.$info;
//        var_dump($info);exit;
//
//        if(!is_dir($uploaddir .date('Ymd'))){
//            if(!mkdir($uploaddir .date('Ymd'),0777,true)){
//                exit("无法建立保存图片的目录！");
//            }
//        }
        $size = $_FILES['img']['size'];
        if($size>(6000*1024)){
            $re['msg']="图片大小不超过6M";
            echo json_encode($re);exit;
        }
//        if($file){
//            if(!unlink($member->head_img)){
//                $re['msg']="请重新上传";
//                echo json_encode($re);exit;
//            }else{
                if (move_uploaded_file($_FILES['img']['tmp_name'],$dir)) {
                    $re['dir']='/'.$dir;
                    $member->head_img=$re['dir'];
                    $member->save();
                    $re['msg']="上传成功";
                    $re['status']=200;
                    echo json_encode($re);
                }else {
                    $re['msg']="上传失败";
                    echo json_encode($re);
                }
//            }
//        }
    }
}
