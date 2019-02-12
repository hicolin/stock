<?php

namespace frontend\controllers;


use backend\models\AdminCommission;
use backend\models\AdminContent;

use backend\models\AdminTixian;

use backend\models\AdminUser;
use backend\models\AdminUserpeoduct;
use common\models\Tdx;

use yii\helpers\Url;

use Yii;

use yii\web\Controller;

use yii\filters\VerbFilter;

use yii\filters\AccessControl;

use backend\models\AdminRegions;

use backend\models\AdminPayType;

use common\models\Common;

use backend\models\AdminStocks;

use backend\models\AdminMember;
use backend\models\AdminFund;

use backend\models\AdminOrder;

use backend\models\AdminWarning;

use backend\models\AdminOption;

use common\helps\Tools;

use yii\data\Pagination;

use backend\models\AdminCharge;

use backend\models\AdminChargexx;

use backend\models\AdminSetting;

use common\utils\CommonFun;

use frontend\controllers\TestController;

use yii\web\UploadedFile;

use backend\models\AdminAccount;

use backend\controllers\PublicController;


/**
 * Site controller
 */
class UserController extends Controller

{

    /**
     * @inheritdoc
     */

    public $defaultAction = 'index';
    public $status = [-1 => '委托卖出', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销', '4' => '已报'];
    public $enableCsrfValidation = false;

    public $member;

    public $user_id;

    public function behaviors()
    {
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
        $url = Yii::$app->urlManager->createUrl('/index/login');
        if (empty($id)) {
            return $this->redirect([$url, 'sign' => 1]);
            Yii::$app->end();
        } else {
            $onelist = AdminMember::findOne($id);
            if ($onelist) {
                $this->member = $onelist;
                $this->user_id = $id;
            } else {
                $this->unsetSession();
                return $this->redirect([$url, 'sign' => 1]);
                Yii::$app->end();
            }
        }
    }

    /**
     * 我的实盘
     */
    public function actionStock()
    {
        $this->getView()->title = Common::getSysInfo(5) . '-我的操盘';
        $state = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $id = Yii::$app->request->get('id');
        $user_id = Yii::$app->session['id'];
        $myorders = AdminStocks::find()->joinWith('option', 'AdminOption.goods_id = AdminStocks.id')->select(['admin_stocks.id', 'admin_stocks.cid', 'admin_stocks.code', 'admin_stocks.name'])->where(['admin_option.user_id' => $user_id])->limit(10)->orderBy('id desc')->asArray()->all();
        foreach ($myorders as $k => $value) {
            if ($value['cid'] == 118) {
                $marketlist .= 'sh' . $value['code'] . ',';
            } else {
                $marketlist .= 'sz' . $value['code'] . ',';
            }
        }
        $users_tel = Yii::$app->session['tel'];
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

        $onestock = AdminStocks::find()->where(['id' => $id])->one();
        if ($onestock->cid == 118) {
            $new_code = sh . $onestock->code;
        } else {
            $new_code = sz . $onestock->code;
        }
        //卖出
        $time = mktime('0', '0', '0', date('m'), date('d'), date('y'));
        $salelist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 1])->andWhere(['<', 'created_time', $time])->orderBy('created_time desc')->asArray()->all();
        // var_dump($salelist);exit;
        //可撤单
        $chedanlist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 4])->orderBy('created_time desc')->asArray()->all();
        //持仓  //当前策略
        $holdinglist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 1])->orderBy('created_time desc')->asArray()->all();
//        echo '<pre>';
//        print_r($holdinglist);exit;
        //今日委托
        $todayapply = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['between', 'created_time', mktime(0, 0, 0, date('m'), date('d'), date('Y')), mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1])->orderBy('created_time desc')->asArray()->all();
        //今日成交
        $todaydone = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['in', 'status', [1, 2]])->andWhere(['between', 'created_time', mktime(0, 0, 0, date('m'), date('d'), date('Y')), mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1])->orderBy('created_time desc')->asArray()->all();
        //历史委托
        $applylist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 0])->orderBy('created_time desc')->asArray()->all();
        //历史成交
        $donelist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['in', 'status', [1, 2]])->orderBy('created_time desc')->asArray()->all();
        //平仓记录
        $finishlist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 2])->orderBy('created_time desc')->asArray()->all();
        //冻结资金
        $dj_m = AdminTixian::find()->where(['users_id' => $this->user_id])->andWhere(['state' => 0])->select('sum(money) as money')->asArray()->one();
        //持仓盈亏
        $profit = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->andWhere(['status' => 1])->select('sum(profit) as profit')->asArray()->one();
        //证券市值
        $holdings = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->andWhere(['status' => 1])->all();
        //保证金
        $bzj_m = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->andWhere(['status' => 1])->select('sum(total) as total')->asArray()->one();
        //print_r($bzj_m);
        //动态资产 信用权益
        $dt_m = floatval($onelist->money) + floatval($bzj_m['total']) * 12.5 / 100 + floatval($profit['profit']) + floatval($dj_m['money']);
        foreach ($holdings as $m => $n) {

            $code .= $n['goods_code'] . ',';
            $arr_hander[] = $n['order_hander'];
        }
        $codes = array('list' => $code);
        $res = Common::getGp($codes);
        $resarr = $res['data'];
        foreach ($resarr as $q => $w) {
            $arr_price[] = floatval($w['new_price']);
        }
        $z = 0;
        foreach ($arr_hander as $k => $val) {
            $z += $val * $arr_price[$k];
        }
        $Sj = mktime(9, 15, 0);
        $Sj2 = mktime(11, 30, 0);
        $Sj3 = mktime(13, 0, 0);
        $Sj4 = mktime(14, 55, 0);
        $week = date('w');
        if (($week != 6 && $week != 0) && (($Sj < time() && time() < $Sj2) || ($Sj3 < time() && time() < $Sj4))) {
            $jy = 'y';
        } else {
            $jy = 'n';
        }
        $time = mktime(0, 0, 0, date('m'), date('d'), date('y'));//当天凌晨
        $jS = AdminOrder::find()->andWhere(['status' => 1, 'user_id' => Yii::$app->session['user_id']])->andWhere(['<', 'begin_time', $time])->select('sum(day_dy) as dy, sum(day_yk) as yk')->asArray()->one();
        if ($jS['yk'] > 0) {
            $syBzj = $onelist->money - $jS['dy'];
        } else {
            //$syBzj = $onelist->money - $jS['dy'] + $jS['yk'];
            $syBzj = $onelist->money - $jS['dy'];
        }
        $d_code = '';//用于计算市值
        foreach ($holdinglist as $k => $value) {
            $d_code .= $value['goods_code'] . ',';
        }
//        echo '<pre>';
//        print_r($this->member);exit;
        return $this->render('stock', [
            'member' => $this->member,
            'onestock' => $onestock,
            'new_code' => $new_code,
            'salelist' => $salelist,
            'chedanlist' => $chedanlist,
            'holdinglist' => $holdinglist,
            'todayapply' => $todayapply,
            'todaydone' => $todaydone,
            'applylist' => $applylist,
            'donelist' => $donelist,
            'finishlist' => $finishlist,
            'myorders' => $myorders,
            'marketlist' => $marketlist,
            'state' => $state,
            'dj_m' => $dj_m,
            'dt_m' => $dt_m,
            'profit' => $profit,
            'z' => $z,
            'jy' => $jy,
            'jS' => $jS,
            'syBzj' => $syBzj,
            'lcTime' => $time,
            'status' => $this->status,
            'd_code' => $d_code,
        ]);
    }

    /**
     * 卖出
     * @return string
     */
    public function actionSaleholding()
    {
//        $tdx = new Tdx();
        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post('id');
            $stock_code = Yii::$app->request->post('stock_code');
            $stock_name = Yii::$app->request->post('name');
            $price = floatval(Yii::$app->request->post('decl_price'));
            $quantity = intval(Yii::$app->request->post('decl_num'));
            $ordersale = AdminOrder::findone($id);
            if($quantity>$ordersale->order_hander){
                return json_encode(array('status' => '300', 'info' => '卖出数量有误'));
            }
            $fund = new AdminFund;
            $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
//            $orderCate = 1;
//            $priceCate = 0;
//            $stockCode = $stock_code;
//            $res = $tdx->SendOrder($orderCate, $priceCate, $stockCode, $price, $quantity);
            file_put_contents('1130.txt', json_encode($res));
            file_put_contents('1131.txt', json_encode($res['data']));
            if ($res == 'Operation timed out after 30001 milliseconds with 0 bytes received') {
                return json_encode(array('status' => '800', 'info' => '系统超时,请稍后测试'));
            }
//            if (!$res['success']) {
            if (false) {
                //失败的情况
                return json_encode(array('status' => '300', 'info' => $res['msg']));
            } else {
                //成功的情况
                // $sale_money=$res['data']['headers'][4];//假定
                $sale_money = $price;//假定
                $ordersale->end_time = time();
                $ordersale->sale_money = $ordersale->sale_money . '+' . $sale_money;//卖出价格
                $ordersale->sale_hander += $quantity;//卖出数量
                $ordersale->s_hand = $ordersale->s_hand . '+' . $quantity;//卖出数量
                if ($ordersale->order_hander != $quantity) {
                    $ordersale->status = 5;
                } else {
                    $ordersale->status = 5;
                }
                $bzj1 = $quantity * $ordersale->order_ly_money / $ordersale->order_hander;
                $bzj2 = $quantity * $ordersale->zj_bzj / $ordersale->order_hander;
                $ordersale->order_ly_money -= $bzj1;
                $ordersale->zj_bzj -= $bzj2;
                $bzj = $bzj1 + $bzj2;
                $ordersale->left_hander = $ordersale->order_hander - $quantity;//剩余数量
                $ordersale->order_hander -= $quantity;//剩余数量
                $new_money = $sale_money * $quantity;//卖出时的总价
                $yq_money = $quantity * $ordersale->order_my_money;
                $ordersale->sale_total = $new_money;
                //$ordersale->mc_orderNo = $ordersale->mc_orderNo . ',' . $res['data']['order']['orderNo'];//卖出时的委托单号
//                $ordersale->mc_orderNo = $res['data']['order']['orderNo'];//卖出时的委托单号
                $chajia = $new_money - $yq_money;
                $ordersale->mc_yk = $ordersale->mc_yk + $chajia;
                $ordersale->mc_ly_bzj = $bzj1;
                $ordersale->mc_zj_bzj = $bzj2;
                $ordersale->mc_chajia = $chajia;
                $memberMoney = $bzj + $chajia;
                //$onelist->money += $memberMoney;
//                $fund->user_id = Yii::$app->session['id'];
//                $fund->order_id = $ordersale->id;
//                $fund->created_time = time();
//                $fund->amount = $memberMoney;
//                $fund->money = $onelist->money;
//                $fund->title = "pc卖出(" . $stockCode . $stock_name . '退还保证金' . $bzj1 . '+退还追加保证金' . $bzj2 . '+差价' . $chajia . ")";
                $tran = Yii::$app->db->beginTransaction();
                try {
                    $ordersale->save(false);
                    //$onelist->save(false);
                    //$fund->save(false);
                    $tran->commit();
                    file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s', time()) . 'pc主动卖出成功，订单号：' . $ordersale->id . PHP_EOL, FILE_APPEND);
                    return json_encode(array('status' => '100', 'info' => '卖出成功'));
                } catch (\Exception $e) {
                    $tran->rollBack();
                    file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s', time()) . 'pc主动卖出失败，订单号：' . $ordersale->id . PHP_EOL, FILE_APPEND);
                    return json_encode(array('status' => '200', 'info' => '卖出失败'));
                }
            }
        }
    }

    public function actionSell()
    {
        $id = (int)Yii::$app->request->get('id');
        $model = AdminOrder::find()->where(['id' => $id])->asArray()->one();
        return json_encode($model);
//        $result = unserialize($model->result);
//        $tdx = new Tdx();
//        $orderCate = 1;
//        $priceCate = 0;
//        $stockCode = $result['stockCode'];
//        $data = array('list'=>$model->goods_code);
//        $res = Common::getGp($data);
//        $result = $res['data']['0'];
//        //当前市值
//        $price = $result['new_price'];
//        $quantity = $model->order_hander;
//        $resz = $tdx->SendOrder($orderCate, $priceCate, $stockCode, $price, $quantity);
//        if($resz['success']){
//            return json_encode();
//        }
    }

    public function actionOpt_ajax()
    {
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        $money = $onelist->money;
        $ratev = AdminSetting::findOne(71);
        $rate = floatval($ratev['val']);
        $post = Yii::$app->request->post();
        $z = 0.0048 * $rate + 1;

        if ($post) {
            $weituo = floatval($post['now']);
            $gushu = $money * $rate / $z / $weituo;
            return $gushu;
        }
    }

    public function actionSale()
    {
        $this->getView()->title = Common::getSysInfo(5) . '-我的实盘';
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        // $todayapply = AdminOrder::find()->where(['user_id'=>Yii::$app->session['id']])->andWhere(['status'=>0])->andWhere(['between','created_time',mktime(0,0,0,date('m'),date('d'),date('Y')),mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1])->orderBy('created_time desc')->asArray()->all();

        $id = Yii::$app->request->get('id');

        $users_tel = Yii::$app->session['tel'];

        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

        $onestock = AdminStocks::find()->where(['id' => $id])->one();


        return $this->render('sale', [

            'member' => $this->member,
            'onestock' => $onestock,
            // 'todayapply' => $todayapply,
            'status' => $status,

        ]);
    }

    public function actionIndex()
    {
        $this->getView()->title = Common::getSysInfo(5) . '-我的实盘';
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        //冻结资金
        $dj_m = AdminTixian::find()->where(['users_id' => $this->user_id])->andWhere(['state' => 0])->select('sum(money) as money')->asArray()->one();
        //持仓盈亏
        $profit = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->andWhere(['status' => 1])->select('sum(profit) as profit')->asArray()->one();
        //证券市值
        $holdings = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->andWhere(['status' => 1])->all();
        //保证金
        $bzj_m = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->select('sum(total) as total')->asArray()->one();
        //动态资产
        $dt_m = floatval($onelist->money) + floatval($bzj_m['total']) * 12.5 / 100 + floatval($profit['profit']) + floatval($dj_m['money']);
        foreach ($holdings as $m => $n) {

            $code .= $n['goods_code'] . ',';
            $arr_hander[] = $n['order_hander'];
        }
        $codes = array('list' => $code);
        $res = Common::getGp($codes);
        $resarr = $res['data'];
        foreach ($resarr as $q => $w) {
            $arr_price[] = floatval($w['new_price']);
        }
        $z = 0;
        foreach ($arr_hander as $k => $val) {
            $z += $val * $arr_price[$k];
        }
        return $this->render('index', [
            'member' => $this->member,
            'dt_m' => $dt_m,
            'z' => $z,
        ]);

    }


    public function actionLogout()
    {
        $this->unsetSession();
        return $this->redirect(['index/login']);
    }

    //退出登录
    protected function unsetSession()
    {
        unset(Yii::$app->session['access']);
        unset(Yii::$app->session['id']);
        unset(Yii::$app->session['_flash']);
        unset(Yii::$app->session['_returnUrl']);
        unset(Yii::$app->session['username']);
        unset(Yii::$app->session['nickname']);
        unset(Yii::$app->session['tel']);
        unset(Yii::$app->session['openid']);
        unset(Yii::$app->session['islogin']);
        unset(Yii::$app->session['userid']);
        unset(Yii::$app->session['qqlogin']);
        unset(Yii::$app->session['access_token']);
        unset(Yii::$app->session['openid']);
        unset(Yii::$app->session['wxlogin']);
        unset(Yii::$app->session['user_id']);
    }


    /**
     * 充值
     * @return int|string
     */
    public function actionRechargeMoney()
    {
        // echo 111;exit;
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        $paytype = AdminPayType::find()->where(['status' => 1])->asArray()->all();
        $xs_sum = AdminCharge::find()->where(['state' => 1])->andWhere(['users_id' => Yii::$app->session['user_id']])->select('sum(money) as money')->asArray()->one();
        $xx_sum = AdminChargexx::find()->where(['state' => 1])->andWhere(['users_id' => Yii::$app->session['user_id']])->select('sum(money) as money')->asArray()->one();
        $sum = $xs_sum['money'] + $xx_sum['money'];
        $post = yii::$app->request->post();
        if ($post) {
            // var_dump($post);exit;
            $amount = $post['amount'];
            $cardpass = $post['cardpass'];
            $pay_type = $post['pay_type'];
            if (Yii::$app->security->validatePassword($cardpass, $onelist->tx_pwd)) {
                $model = new AdminCharge();
                $model->users_id = Yii::$app->session['user_id'];
                $model->money = $amount;
                $model->pay_type = $pay_type;
                $model->dates = time();
                // $model ->service_money = $service_money;
                $model->ip = CommonFun::getClientIp();
                $model->state = 0;
                $model->status = 1;
                $model->pay_ordersid = date('Ymdhms', time()) . rand(000000000, 99999999);
                $model->title = "充值";
                // $onelist->money += $amount;
                if ($onelist->save() && $model->save()) {
                    return 100;
                    exit;
                } else {
                    var_dump($model->errors);
                    return 300;
                    exit;
                }
            }
        }
        $this->getView()->title = Common::getSysInfo(5) . '-我要充值';
        return $this->render("recharge", [
            'member' => $this->member,
            'paytype' => $paytype,
            'sum' => $sum,
        ]);
    }

    /**
     * 线下支付
     * @return string
     */
    public function actionLineRecharge()
    {
        if (Yii::$app->request->isAjax) {
            $money = Common::filter(Yii::$app->request->get('money'));
            $title = Common::filter(Yii::$app->request->get('remark'));
            $img = Common::filter(Yii::$app->request->get('pz'));
            $chargexx = new AdminChargexx();
            $chargexx->users_id = $this->user_id;
            $chargexx->title = $title;
            $chargexx->img_url = $img;
            $chargexx->money = $money;
            $chargexx->ip = Yii::$app->request->userIP;
            $chargexx->dates = time();
            if ($chargexx->save()) {
                return json_encode(['status' => 'y', 'info' => '成功']);
            } else {
                return json_encode(['status' => 'n', 'info' => '提交失败，请稍后重试']);
            }
        }
        $sum = AdminCharge::find()->where(['state' => 1])->andWhere(['users_id' => Yii::$app->session['user_id']])->select('sum(money) as money')->asArray()->one();
        return $this->render("line-recharge", [
            'member' => $this->member,
            'sum' => $sum,
        ]);
    }


    /**
     * 扫码支付
     * @return string
     */
    public function actionSaoRecharge()
    {
        if (Yii::$app->request->isAjax) {
            $money = Common::filter(Yii::$app->request->get('money'));
            $title = Common::filter(Yii::$app->request->get('remark'));
            $img = Common::filter(Yii::$app->request->get('pz'));
            $chargexx = new AdminChargexx();
            $chargexx->users_id = $this->user_id;
            $chargexx->title = $title;
            $chargexx->img_url = $img;
            $chargexx->money = $money;
            $chargexx->ip = Yii::$app->request->userIP;
            $chargexx->dates = time();
            if ($chargexx->save()) {
                return json_encode(['status' => 'y', 'info' => '成功']);
            } else {
                return json_encode(['status' => 'n', 'info' => '提交失败，请稍后重试']);
            }
        }
        $sum = AdminCharge::find()->where(['state' => 1])->andWhere(['users_id' => Yii::$app->session['user_id']])->select('sum(money) as money')->asArray()->one();
        return $this->render("sao-recharge", [
            'member' => $this->member,
            'sum' => $sum,
        ]);
    }


    //提现页面

    public function actionWithdrawMoney()
    {
        $onelist = $this->member;
        $sum = AdminTixian::find()->where(['state' => 1])->andWhere(['users_id' => Yii::$app->session['user_id']])->select('sum(money) as money')->asArray()->one();
        $post = yii::$app->request->post();
        if ($post) {
            $cardname = $post['cardname'];
            $cardid = $post['cardid'];
            $amount = $post['amount'];
            $cardpass = $post['cardpass'];
            if (Yii::$app->security->validatePassword($cardpass, $onelist->tx_pwd)) {
                $model = new AdminTixian();
                $model->users_id = Yii::$app->session['user_id'];
                $model->money = $amount;
                $model->dates = time();
                $model->ip = CommonFun::getClientIp();
                $model->bank_code = $cardid;
                $model->bank_id = $onelist->bankcode;
                $model->state = 0;
                $model->title = "提现";
                $model->name = $cardname;
                $onelist->money -= $amount;
                $found = new AdminFund();
                $found->user_id = $onelist->id;
                $found->order_id = time();
                $found->created_time = time();
                $found->amount = $amount;
                $found->money = $onelist->money;
                $found->title = "PC用户提现" . $amount . '元';
                $tran = Yii::$app->db->beginTransaction();
                try {
                    $onelist->save();
                    $model->save();
                    $found->save(false);
                    $tran->commit();
                    return 100;
                } catch (\Exception $e) {
                    $tran->rollBack();
                    return 300;
                }
            } else {
                return 200;
            }
        }
        $this->getView()->title = Common::getSysInfo(5) . '-我要提现';
        return $this->render("withdraw", [
            'onelist' => $onelist,
            'sum' => $sum
        ]);
    }


    public function actionRcord()
    {
        $state_charge = [0 => '未支付', 1 => '支付成功', 2 => '支付失败'];
        $state_tixian = [0 => '未审核', 1 => '审核通过', 2 => '审核未通过'];

        $user_id = Yii::$app->session['id'];
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        $tixian = AdminTixian::find()->where(['users_id' => $user_id])->orderBy('dates desc')->all();
        $charge = AdminCharge::find()->where(['users_id' => $user_id])->all();
        return $this->render('rcord', [
            'tixian' => $tixian,
            'charge' => $charge,
            'onelist' => $onelist,
            'state_charge' => $state_charge,
            'state_tixian' => $state_tixian,
        ]);

    }

    //提现记录
    public function actionWithdraw()
    {

        $user_id = Yii::$app->session['id'];

        $tixian = AdminTixian::find()->where(['users_id' => $user_id])->orderBy('dates desc')->all();

        return $this->render('withdraw', ['tixian' => $tixian]);

    }

    //充值记录
    public function actionRecharge()
    {

        $user_id = Yii::$app->session['id'];

        $charge = AdminCharge::find()->where(['users_id' => $user_id])->all();

        // var_dump($charge);

        return $this->render('recharge', ['charge' => $charge]);

    }

    public function actionDetails()
    {

        return $this->render('details');

    }


    //个人中心安全页面
    public function actionSafe()
    {

        $state = [0 => '未认证', 1 => '已认证'];

        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

        return $this->render('safe', ['onelist' => $onelist, 'state' => $state]);

    }


    //持仓页面
    public function actionInfo()
    {

        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];

        $orderlist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->orderBy('status asc', 'created_time desc')->asArray()->all();

        $applylist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andFilterWhere(['status' => 0])->orderBy('created_time desc')->asArray()->all();

        $holdinglist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andFilterWhere(['status' => 1])->orderBy('created_time desc')->asArray()->all();

        $finishlist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andFilterWhere(['status' => 2])->orderBy('created_time desc')->asArray()->all();

        return $this->render('info', [

            'orderlist' => $orderlist,

            'applylist' => $applylist,

            'holdinglist' => $holdinglist,

            'finishlist' => $finishlist,

            'status' => $status

        ]);

    }

    //撤单
    public function actionChedan()
    {
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $chedanlist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 3])->orderBy('created_time desc')->asArray()->all();

        return $this->render('stock', [
            'chedanlist' => $chedanlist,
            'status' => $status,
        ]);

    }

    //持仓
    public function actionHolding()
    {
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $holdinglist = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 1])->orderBy('created_time desc')->asArray()->all();
        return $this->render('stock', [
            'holdinglist' => $holdinglist,
            'status' => $status,
        ]);

    }

    //当日委托
    public function actionTodayApply()
    {
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $todayapply = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 0])->andWhere(['between', 'created_time', mktime(0, 0, 0, date('m'), date('d'), date('Y')), mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1])->orderBy('created_time desc')->asArray()->all();
        return $this->render('stock', [
            'todayapply' => $todayapply,
            'status' => $status,
        ]);

    }

    //当日成交
    public function actionTodayDone()
    {
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $todaydone = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->andWhere(['in', 'status', [1, 2]])->andWhere(['between', 'created_time', mktime(0, 0, 0, date('m'), date('d'), date('Y')), mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1])->orderBy('created_time desc')->asArray()->all();
        return $this->render('stock', [
            'todaydone' => $todaydone,
            'status' => $status,
        ]);

    }

    //历史委托
    public function actionApply()
    {
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $query = AdminOrder::find();
        $search = yii::$app->request->get();
        $stime = explode('-', $search['stime']);
        $etime = explode('-', $search['etime']);
        $stime2 = mktime(0, 0, 0, $stime[1], $stime[2], $stime[0]);
        $etime2 = mktime(23, 59, 59, $etime[1], $etime[2], $etime[0]);
        if ($search) {
            $query = $query->where(['between', 'created_time', $stime2, $etime2]);
        }
        $applylist = $query->andWhere(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 0])->orderBy('created_time desc')->asArray()->all();
        return $this->render('apply', [
            'applylist' => $applylist,
            'status' => $status,
            'search' => $search,
        ]);

    }

    //历史成交
    public function actionDone()
    {
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $query = AdminOrder::find();
        $search = yii::$app->request->get();
        $stime = explode('-', $search['stime']);
        $etime = explode('-', $search['etime']);
        $stime2 = mktime(0, 0, 0, $stime[1], $stime[2], $stime[0]);
        $etime2 = mktime(23, 59, 59, $etime[1], $etime[2], $etime[0]);
        if ($search) {
            $query = $query->where(['between', 'created_time', $stime2, $etime2]);
        }
        $donelist = $query->andWhere(['user_id' => Yii::$app->session['id']])->andWhere(['in', 'status', [1, 2]])->orderBy('created_time desc')->asArray()->all();
        return $this->render('done', [
            'donelist' => $donelist,
            'status' => $status,
            'search' => $search,
        ]);

    }

    //平仓记录
    public function actionFinish()
    {
        $status = [-1 => '委托卖出中', 0 => '申请中', 1 => '持仓中', 2 => '已结算', 3 => '已撤销'];
        $query = AdminOrder::find();
        $search = yii::$app->request->get();
        $stime = explode('-', $search['stime']);
        $etime = explode('-', $search['etime']);
        $stime2 = mktime(0, 0, 0, $stime[1], $stime[2], $stime[0]);
        $etime2 = mktime(23, 59, 59, $etime[1], $etime[2], $etime[0]);
        if ($search) {
            $query = $query->where(['between', 'created_time', $stime2, $etime2]);
        }
        $finishlist = $query->andWhere(['user_id' => Yii::$app->session['id']])->andWhere(['status' => 2])->orderBy('created_time desc')->asArray()->all();
        return $this->render('finish', [
            'finishlist' => $finishlist,
            'status' => $status,
            'search' => $search,
        ]);

    }


    // 获取现价
    public function actionGetPrice()
    {
        $order = AdminOrder::find()->where(['user_id' => Yii::$app->session['id']])->orderBy('status asc', 'created_time desc')->all();

        if ($order) {
            $arr = array();
            foreach ($order as $list) {
                $stock = AdminStocks::findone(['code' => $list->goods_code]);
                if ($stock->cid == 118) {
                    $cid = 'sh' . $stock->code;
                } else {
                    $cid = 'sz' . $stock->code;
                }
                $arr[] = $cid;
            }
        }
        $stock = Common::getNow($arr);
        return json_encode($stock['data']);


    }

    //撤销申请
    public function actionWithdrawOrder()
    {
        $post = yii::$app->request->post();
        $model = AdminMember::findOne(['id' => Yii::$app->session['id']]);
        $order = AdminOrder::find()->where(['id' => $post['id']])->one();
        $pay_money = $order->pay_money;
        $model->money += $pay_money;
        $order->status = 3;
        if ($order->save() && $model->save()) {
            return 100;
            exit;
        } else {
            return 200;
            exit;
        }

    }

    //卖出
    public function actionSaleOut()
    {
        $post = yii::$app->request->post();
        $order = AdminOrder::find()->where(['id' => $post['id']])->one();
        $order->status = -1;
        if ($order->save()) {
            return 100;
            exit;
        } else {
            return 200;
            exit;
        }

    }


    //footer信息
    public function actionService()
    {

        $qq = Tools::getSetting('10');//公司客服qq

        $phone = Tools::getSetting('9');//公司400电话

        return $this->render('service', ['qq' => $qq, 'phone' => $phone]);

    }


    //上传头像页面

    public function actionFitHeaderimg()
    {

        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

        return $this->render('fit-headerimg', ['onelist' => $onelist]);

    }

    //手机绑定页面

    public function actionBindPhone()
    {

        $this->getView()->title = '编辑绑定手机-' . Tools::getSetting('5');

        // $onelist = AdminMember::find()->where(['usersname'=>Yii::$app->session['username']])->one();

        // $tel = $this->dealTel($onelist->tel);

        if (yii::$app->request->post()) {

            $data = yii::$app->request->post();

            if (!preg_match('/^1[34578]\d{9}$/', $data['tel'])) {

                //新手机号格式不正确

                return 300;

            } else if ($this->actionRegcode($data['tel'], $data['code']) != 100) {

                //新手机验证码不正确

                return 400;

            } else {

                $model = AdminMember::findOne(['id' => Yii::$app->session['id']]);

                $model->tel = $data['tel'];

                $model->usersname = $data['tel'];

                if ($model->save()) {

                    return 100;

                } else {

                    return 500;

                }

            }

        }

        return $this->render("bind-phone");

    }

    //实名认证页面

    public function actionCertification()
    {

        $this->getView()->title = '实名认证-' . Tools::getSetting('5');
        //地区省
        $province = AdminRegions::find()->where(['level' => 1])->all();
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        //根据省获取市的列表
        $city = "<option value='0'>--市--</option>";
        if ($onelist->bank_province && $onelist->bank_city) {
            $city = $this->actionGetCity($onelist->bank_province, $onelist->bank_city);
        }
        if (yii::$app->request->post()) {
            $data = yii::$app->request->post();
            if (!preg_match('/[\x{4e00}-\x{9fff}]/u', $data['bank_account_name'])) {
                //真实姓名不正确
                return json_encode(array('status' => 'n', 'info' => '真实姓名不正确'));
            } else if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $data['id_card'])) {
                //身份证号不正确
                return json_encode(array('status' => 'n', 'info' => '身份证号不正确'));
            } else if (!is_numeric($data['bank_card'])) {
                //银行卡号
                return json_encode(array('status' => 'n', 'info' => '银行卡号不正确'));
            } else if (!$data['bank_id']) {
                //银行名称
                return json_encode(array('status' => 'n', 'info' => '银行名称不能为空'));
            } else if (!intval($data['province'])) {
                //开户行省
                return json_encode(array('status' => 'n', 'info' => '开户行省不能为空'));
            } else if (!intval($data['city'])) {
                //开户行市
                return json_encode(array('status' => 'n', 'info' => '开户行市不能为空'));
            } else if (!$data['bank_branch']) {
                //开户行分行
                return json_encode(array('status' => 'n', 'info' => '开户行分行不能为空'));
            } else if (!$data['mobile_phone']) {
                //开户行分行
                return json_encode(array('status' => 'n', 'info' => '绑定银行卡手机号不能为空'));
            } else {
                $bankResult = Common::bankcard($data['mobile_phone'], $data['bank_card'], $data['id_card'], $data['bank_account_name']);
                if ($bankResult['code'] == 0 && $bankResult['message'] == '成功' && $bankResult['result']['res'] == 1) {
                    $model = AdminMember::findOne(['id' => $onelist->id]);
                    $model->realname = $data['bank_account_name'];
                    $model->cartid = $data['id_card'];
                    $model->bankcode = $data['bank_id'];
                    $model->bankid = $data['bank_card'];
                    $model->bank_province = $data['province'];
                    $model->bank_city = $data['city'];
                    $model->bankaddress = $data['bank_branch'];
                    $model->bank_tel = $data['mobile_phone'];
                    $model->state = 1;
                    if ($model->save()) {
                        return json_encode(array('status' => 'y', 'info' => '认证成功'));
                    }
                } else {
                    return json_encode(array('status' => 'n', 'info' => '认证失败，请重新填写！'));
                }

            }
            return 100;
        }
        return $this->render('bind', [
            'member' => $onelist,
            'province' => $province,
            'city' => $city,
        ]);

    }

    //登陆密码修改页面

    public function actionRevisepassword()
    {
        $this->getView()->title = '密码设置-' . Tools::getSetting('5');
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        if (yii::$app->request->post()) {
            // var_dump(yii::$app->request->post());exit;
            $old_pwd = yii::$app->request->post('old_pwd');

            $pwd1 = yii::$app->request->post('pwd1');

            $pwd2 = yii::$app->request->post('pwd2');

            $bool = Yii::$app->security->validatePassword($old_pwd, $onelist->userspwd);

            if (strlen($pwd1) < 6 || strlen($pwd1) > 18) {

                //密码长度不正确

                return 200;

            } else if ($pwd1 != $pwd2) {

                //两次密码不一样

                return 300;

            } else if (!$bool) {

                //旧密码不正确

                return 400;

            } else {

                $model = AdminMember::findOne(['id' => $onelist->id]);

                $model->userspwd = Yii::$app->security->generatePasswordHash($pwd1);

                if ($model->save()) {

                    return 100;

                } else {

                    return 500;

                }

            }

        }

        return $this->render("pwd");

    }

    //资金密码设置页面

    public function actionBankrollPassword()
    {

        $this->getView()->title = '编辑提现密码-' . Tools::getSetting('5');

        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        // var_dump($onelist);exit;
        if (yii::$app->request->post()) {
            // var_dump(yii::$app->request->post());exit;
            $data = yii::$app->request->post();

            if (!preg_match('/^[_0-9a-z]{6,10}$/', $data['pwd1'])) {

                //提现密码格式不正确

                return 300;

            } else if ($data['pwd1'] != $data['pwd2']) {

                //两次密码不一样

                return 400;

            } else {

                $model = AdminMember::findOne(['id' => $onelist->id]);
                // var_dump($model);exit;
                $model->tx_pwd = Yii::$app->security->generatePasswordHash($data['pwd1']);

                if ($model->save()) {

                    return 100;

                } else {

                    return 500;

                }

            }


        }

        return $this->render("bankroll-password");

    }

    /**
     *交易密码
     * @return string
     */
    public function actionJyPwd()
    {
        return $this->render('account-pwd', [
            'member' => $this->member,
        ]);
    }

    //预警模块

    public function actionWarning()
    {
        $id = Yii::$app->request->get('id');
        $user_id = Yii::$app->session['id'];
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        $yujinglist = AdminWarning::find()->where(['user_id' => $user_id])->andFilterWhere(['state' => 0])->all();

        $yiyujinglist = AdminWarning::find()->where(['user_id' => $user_id])->andFilterWhere(['state' => 1])->all();

        $onestock = AdminStocks::find()->where(['id' => $id])->one();

        // var_dump($yujinglist);exit;

        return $this->render('warning', [

            'onelist' => $onelist,

            'onestock' => $onestock,

            'yujinglist' => $yujinglist,

            'yiyujinglist' => $yiyujinglist,

        ]);

    }

    public function actionPurchase()
    {
        $id = Yii::$app->request->get('id');
        $users_tel = Yii::$app->session['tel'];
        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        $ratev = AdminSetting::findOne(71);
        $rate = intval($ratev['val']);
        $onestock = AdminStocks::find()->where(['id' => $id])->one();
        if (Yii::$app->request->post()) {
            // var_dump(Yii::$app->request->post());exit;
            // $paw = Yii::$app->request->post('paw');
            $goods_id = Yii::$app->request->post('goods_id');
            $goods_name = Yii::$app->request->post('name');
            $goods_code = Yii::$app->request->post('stock_code');
            //委托买入价格
            $order_my_money = Yii::$app->request->post('decl_price');
            $order_bl = $rate;
            //委托买入手数
            $order_hander = Yii::$app->request->post('decl_num');
            //支付总数
            $pay_money = $order_my_money * $order_hander * (12.5 + 0.48) / 100;
            //履约保证金
            $order_ly_money = $order_my_money * $order_hander / 8;
            file_put_contents('bzj.txt', $order_ly_money . '-' . $onelist->tel . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            //手续费
            $order_charge = $order_my_money * $order_hander * 0.48 / 100;
            /**手续费不足20的情况*/
            if($order_charge<20){
                $order_charge = 20;
                $pay_money = $order_charge+$order_ly_money;
                if($onelist->money * 1000 < $pay_money * 1000){
                    $m = $order_hander-100;
                    return json_encode(array('status' => '300', 'info' => '你最多只可以买'.$m.'只股票'));
                }
            }
            /**end**/
            //买入市值
            $total = $order_my_money * $order_hander;

            $sumo = AdminOrder::find()->where(['goods_id' => $goods_id])->select('sum(total) as total')->asArray()->one();
            $summ = AdminOrder::find()->where(['goods_id' => $goods_id])->andWhere(['user_id' => Yii::$app->session['user_id']])->select('sum(total) as total')->asArray()->one();
            $sum_o = floatval($sumo['total']);
            $sum_m = floatval($summ['total']);
            if ($onelist->money * 1000 < $pay_money * 1000) {
                return json_encode(array('status' => '300', 'info' => '余额不足'));
            }
            if ($sum_o > 3000000) {
                return json_encode(array('status' => '400', 'info' => '单只个股总额超过上限'));
            } else {
                if ($sum_m > 1500000) {
                    return json_encode(array('status' => '600', 'info' => '单只个股购买/持股金额上限150万'));
                } else {//买多少
                    $num = 3000000 - $sum_o; //总账户可买
                    $num1 = 1500000 - $sum_m; //子账户可买
                    if ($total > $num && $total > $num1) {
                        if ($num1 > $num) {
                            $info = "您最多只能购买" . $num . "元市值的股票";
                            return json_encode(array('status' => '500', 'info' => $info));
                        } else {
                            $info = "您最多只能购买" . $num1 . "元市值的股票";
                            return json_encode(array('status' => '500', 'info' => $info));
                        }
                    } else if ($total > $num && $total < $num1) {
                        $info = "您最多只能购买" . $num . "元市值的股票";
                        return json_encode(array('status' => '500', 'info' => $info));
                    } else if ($total < $num && $total > $num1) {
                        $info = "您最多只能购买" . $num1 . "元市值的股票";
                        return json_encode(array('status' => '500', 'info' => $info));
                    }
//                    if( $sum_o+$total > 3000000){
//                        if($sum_m+$total<=1500000){
//                            $num=3000000-$sum_o;
//                            $info = "您最多只能购买".$num."元市值的股票";
//                            return json_encode(array('status'=>'500','info'=>$info));
//                        }
//                    }
                }
            }

            $Sj = mktime(9, 15, 0);
            $Sj2 = mktime(11, 30, 0);
            $Sj3 = mktime(13, 0, 0);
            $Sj4 = mktime(14, 55, 0);
            $week = date('w');
            $order_sn = Common::getOrderSn();
            $order = new AdminOrder;
            $fund = new AdminFund;
            if (($week != 6 && $week != 0) && (($Sj < time() && time() < $Sj2) || ($Sj3 < time() && time() < $Sj4))) {
//                $tdx = new Tdx();
//                $orderCate = 0;
//                $priceCate = 0;
//                $stockCode = substr($goods_code, 2);
//                $price = floatval($order_my_money);
//                $quantity = intval($order_hander);
//                $res = $tdx->SendOrder($orderCate, $priceCate, $stockCode, $price, $quantity);
//                if (!$res['success']) {
                if (false) {
                    //失败的情况
                    return json_encode(array('status' => '100', 'info' => $res['msg']));
//                } else if ($res['success'] == 1 && $res['msg'] == '委托下单成功') {
                } else if (true) {
                    //} else if($res['success'] == false) {
                    $order->goods_id = $goods_id;
                    $order->goods_name = $goods_name;
                    $order->goods_code = $goods_code;
                    $order->user_id = Yii::$app->session['id'];
                    $order->user_tel = $users_tel;
                    $order->order_sn = $order_sn;
                    $order->order_my_money = $order_my_money;
                    $order->order_hander = $order_hander;
                    //$order->order_real_money = $order_my_money;//假数据
                    $order->order_real_money = $res['data']['order']['price'];//真数据
                    $order->order_real_hander = $order_hander;
                    $fund->user_id = Yii::$app->session['id'];
                    $order->order_ly_money = $order_ly_money;
                    $order->order_bl = $order_bl;
                    // $order->order_zy_money = $order_zy_money;
                    // $order->order_zs_money = $order_zs_money;
                    $order->order_charge = $order_charge;
                    $order->total = $total;
                    $fund->order_id = $order_sn;
                    $order->created_time = time();
                    $fund->created_time = time();
                    $order->pay_money = $pay_money;
                    $fund->amount = $pay_money;

                    $fund->title = "买入(" . $goods_code . $goods_name . $order_my_money . "*" . $order_hander . ")(支出保证金+手续费" . $pay_money . ")";
                    $order->status = 4;//改成已报单    不确定交易方是否买入
                    $order->begin_time = time();
                    $order->result = serialize($res['data']['order']);
                    $order->tdx_orderNo = $res['data']['order']['orderNo'];
                    $onelist->money -= $pay_money;
                    $fund->money = $onelist->money;

                    if ($order->save() && $onelist->save() && $fund->save()) {

                        return json_encode(array('status' => '200', 'info' => '订单生成成功'));
                    } else {
                        return json_encode(array('status' => '300', 'info' => '订单生成失败'));
                    }
                } else {
                    return json_encode(array('status' => '300', 'info' => '订单生成失败'));
                }
            } else { //不在交易时间范围内
                return json_encode(array('status' => '100', 'info' => '不在交易范围内'));
            }
        }
        return $this->render('purchase', [
            'onelist' => $onelist,
            'onestock' => $onestock,
        ]);
    }


    public function actionMyorder()
    {
        $order = new AdminOption;
        $user_id = Yii::$app->session['id'];
        if (!Yii::$app->session['id']) {
            // return $this->redirect(['/index/login']);
            return 5;
            exit;
        }


        if (Yii::$app->request->get()) {

            $itemid = Yii::$app->request->get('itemid');

            $counts = AdminOption::find()->where(['user_id' => $user_id])->andFilterWhere(['goods_id' => $itemid])->all();

            // var_dump($counts);exit;

            if ($counts) {

                return 2;
                exit;

            } else {

                $order = new AdminOption;

                $order->goods_id = $itemid;

                $order->user_id = $user_id;

                if ($order->save()) {

                    return 1;
                    exit;


                }

            }


        }


    }

    public function actionDelMyorder()

    {

        $order = new AdminOption;

        $user_id = Yii::$app->session['id'];


        if (Yii::$app->request->get()) {

            $itemid = Yii::$app->request->get('itemid');


            $orders = AdminOption::find()->where(['goods_id' => $itemid])->one();

            if ($orders->delete()) {

                echo 1;
                exit;

            };


        }


    }


    public function actionMystock()

    {
        $title = Tools::getSetting('5');


        $user_id = Yii::$app->session['id'];

        // var_dump($user_id);exit;

        $orders = AdminStocks::find()->joinWith('option', 'AdminOption.goods_id = AdminStocks.id')->select(['admin_stocks.id', 'admin_stocks.cid', 'admin_stocks.code', 'admin_stocks.name'])->where(['admin_option.user_id' => $user_id])->asArray()->all();

        // $orders = AdminStocks::find()->joinWith(['order'])->where(['id',$this->id])->select('code')->asArray()->all();

        // var_dump($orders);exit;

        foreach ($orders as $k => $value) {


            if ($value['cid'] == 118) {

                $marketlist .= 'sh' . $value['code'] . ',';

            } else {

                $marketlist .= 'sz' . $value['code'] . ',';

            }

        }

        // var_dump($marketlist);exit;

        return $this->render('mystock', [

            'data' => $orders,

            'title' => $title,

            'marketlist' => $marketlist,

        ]);


    }


    /*

       * 持仓页面

       *

       */

    public function actionInvest()

    {

        // if (Yii::$app->session['islogin']) {

        $id = Yii::$app->request->get('id');

        // echo $id;exit;

        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

        $onestock = AdminStocks::find()->where(['id' => $id])->one();

        return $this->render('invest', [

            'onelist' => $onelist,

            'onestock' => $onestock,

        ]);

        // } else {

        //     return $this->render('invest');

        // }

    }


    /*

       * 预警页面

       *

       */

    public function actionYujing()

    {

        $user_id = Yii::$app->session['id'];

        if (Yii::$app->request->post()) {

            $value = intval(Yii::$app->request->post('value'));

            $stocks_name = Yii::$app->request->post('name');

            $stocks_code = Yii::$app->request->post('code');

            $stocks_id = intval(Yii::$app->request->post('id'));

            $yujing = new AdminWarning;

            $counts = AdminWarning::find()->where(['user_id' => $user_id])->count();

            if ($counts > 4) {

                echo 2;
                exit;

            } else {

                $yujing->user_id = $user_id;

                $yujing->stocks_name = $stocks_name;

                $yujing->stocks_code = $stocks_code;

                $yujing->stocks_id = $stocks_id;

                $yujing->value = $value;

                $yujing->state = 0;

                if ($yujing->save()) {

                    echo 1;
                    exit;

                }

            }

        }


    }


    /*

       * 删除预警页面

       *

       */

    public function actionDelYujing()

    {


        if (Yii::$app->request->post()) {

            $id = Yii::$app->request->post('id');

            $yujing = AdminWarning::find()->where(['id' => $id])->one();

            if ($yujing->delete()) {

                echo 1;
                exit;

            } else {

                echo 2;
                exit;

            }


        }

    }


    /*

     * 检查用户名是否已存在

     * */

    public function actionRegusername($usersname = '')

    {


        $usersname = $usersname ?: Yii::$app->request->post('usersname');


        //$onelist = AdminMember::find()->where(array('usersname' => "$usersname"))->one();

        if (preg_match("/^1[34578]{1}\d{9}$/", $usersname)) {

            $where = ['tel' => $usersname];

        } else {

            $where = ['usersname' => $usersname];

        }

        //$onelist = AdminMember::find()->where(['usersname'=>$usersname])->orFilterWhere(['tel'=>$usersname])->one();

        $onelist = AdminMember::find()->where($where)->one();


        if ($onelist) {

            return 200;
            exit;

        } else {

            return 100;
            exit;

        }

    }


    /*

     * 验证手机号码是否已被注册

     * */

    public function actionValidateTel($tel = '')

    {

        if (!$tel) {

            $tel = Yii::$app->request->post('tel');

        }

        $model = AdminMember::findOne(['tel' => $tel]);

        if ($model) {

            return 300;
            exit;

        }

        return 100;

    }



    /*

   * 提示单页

   * */

    /*

     * 处理手机号

     * */

    protected function dealTel($tel)

    {

        return substr_replace($tel, '********', 3, 8);

    }

    /*

     * 验证手机号码是否已被注册

     * */


    /*

     * 短信验证是否通过

     * */

    public function actionRegcode($tel = '', $vercode = '')

    {

        $tel = $tel ?: yii::$app->request->post('tel');

        $vercode = $vercode ?: yii::$app->request->post('vercode');

        if ($tel != Yii::$app->session['code_tel']) {

            //不是当前手机号

            return 300;
            exit;

        }

        if (empty(Yii::$app->session['validate'])) {

            return 200;
            exit;

        } else if (!empty(Yii::$app->session['validate']) && Yii::$app->session['validate'] != $vercode) {

            return 200;
            exit;

        } else {

            return 100;
            exit;

        }

    }


    /*

     * 检验密码

     * */

    public function actionRegpassword()

    {

        $username = Yii::$app->request->post('username');

        $password = Yii::$app->request->post('password');

        // $onelist = AdminMember::find()->where(array('usersname' => "$username"))->one();

        if (preg_match("/^1[34578]{1}\d{9}$/", $username)) {

            $where = ['tel' => $username];

        } else {

            $where = ['usersname' => $username];

        }

        $onelist = AdminMember::find()->where($where)->one();

        $hash_password = $onelist['userspwd'];

        $bool = Yii::$app->security->validatePassword($password, $hash_password);

        if (empty($bool)) {

            echo 200;

            exit;

        }


    }


    /*

      * 上传图片

      * */

    public function actionUploadImage()
    {

        $id = yii::$app->session['id'];


        $member = AdminMember::findone($this->user_id);

        $uploaddir = 'mobile/web/plugins/uploads/';

        $info = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

        $dir = $uploaddir . date('Ymd') . rand(10000, 99999) . '.' . $info;


//        if (!is_dir($upload_path)) {

//            if (!mkdir($upload_path, 0777, true)) {

//                exit("无法建立保存图片的目录！");

//            }

//        }

        $filetype = ['jpg', 'jpeg', 'gif', 'bmp', 'png'];

        if (!in_array($info, $filetype)) {

            $re['msg'] = "不是图片类型";

            echo json_encode($re);
            exit;

        }


        $size = $_FILES['img']['size'];

        if ($size > (6000 * 1024)) {

            $re['msg'] = "图片大小不超过6M";

            echo json_encode($re);
            exit;

        }


        if (move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {

            $re['dir'] = '/' . $dir;

            $re['msg'] = "上传成功";

            $re['status'] = 200;

            $member = AdminMember::findOne($id);

            $member->head_img = $re['dir'];

            $member->save(false);

        } else {

            $re['msg'] = "上传失败";

        }

        echo json_encode($re);

        exit;

    }


    /*

 * 根据省id获取市的信息

 * */

    public function actionGetCity($provine = '', $city_id = '')
    {
        $id = $provine ?: yii::$app->request->post('id');
        $city = AdminRegions::find()->where(['parent_id' => $id])->all();
        $arr = "<option value='0'>--市--</option>";
        foreach ($city as $list) {
            if ($list->id == $city_id) {
                $selected = "selected";
            } else {
                $selected = '';
            }
            $arr .= "<option " . $selected . " value='" . $list->id . "' >$list->name</option>";
        }
        return $arr;
    }


    /**
     * 获取平台账号
     */
    public function actionPtAccount()
    {
        $id = intval(Yii::$app->request->post('id'));
        $member = AdminMember::findOne($id);
        if ($member) {
            if ($member->xgj_name) {
                return json_encode(array('state' => 0, 'info' => '平台账号已经存在'));
            } else {
                $modle = AdminMember::find()->orderBy('xgj_name desc')->one()->xgj_name;
                if ($modle) {
                    $member->xgj_name = $modle + 1;
                    $member->isopen = 1;
                    if ($member->save(false)) {
                        return json_encode(array('state' => 1, 'info' => '恭喜你开通成功，账号为：' . $member->xgj_name));
                    } else {
                        return json_encode(array('state' => 0, 'info' => '系统出错'));
                    }
                }
            }

        } else {
            return json_encode(array('state' => 0, 'info' => '系统出错'));
        }
    }

    /**
     * 接口撤单
     */
    public function actionCheOrder()
    {

    }
}

