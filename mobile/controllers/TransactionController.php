<?php
/**
 * User: Colin
 * Time: 2019/1/21 15:57
 */

namespace mobile\controllers;

use backend\models\AdminFund;
use backend\models\AdminMember;
use backend\models\AdminOrder;
use Yii;

class TransactionController extends BaseController
{
    public $userId;

    public function beforeAction($action)
    {
        $isLogin = Yii::$app->session['isLogin'];
        if (!$isLogin) {
            $this->redirect(['index/login']);
            return false;
        }
        $this->userId = Yii::$app->session['userId'];
        return parent::beforeAction($action);
    }

    public function actionBuy(){
        $this->getView()->title = '买入';
        return $this->render('buy');
    }

    public function actionSale(){
        $this->getView()->title = '卖出';
        $holdinglist = AdminOrder::find()
            ->where(['user_id'=>$this->userId])
            ->orderBy('created_time desc')
            ->andWhere(['status'=>1])
            ->all();
        return $this->render('sale',compact('holdinglist'));
    }

    public function actionSaleholding()
    {
        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post('id');
            $stock_code = Yii::$app->request->post('stock_code');
            $stock_name = Yii::$app->request->post('name');
            $price = floatval(Yii::$app->request->post('decl_price'));
            $quantity = intval(Yii::$app->request->post('decl_num'));
            $ordersale = AdminOrder::findone($id);
            if($quantity>$ordersale->left_hander){
                return json_encode(array('status' => '300', 'info' => '卖出数量有误'));
            }
            $fund = new AdminFund;
            $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
            if (false) {
                //失败的情况
                return json_encode(array('status' => '300', 'info' => $res['msg']));
            } else {
                $randtime = rand(3,30);
                sleep($randtime);
                $sale_money = $price;//假定
                $tran = Yii::$app->db->beginTransaction();
                if($quantity == $ordersale->order_hander){
                    //全部卖出的情况
                    // $sale_money=$res['data']['headers'][4];//假定
                    $ordersale->end_time = time();
                    $ordersale->sale_money = '+'.$sale_money;//卖出价格
                    $ordersale->sale_real_money = $price;//假数据
                    $ordersale->sale_hander = $quantity;
                    $ordersale->sale_real_hander = $quantity; //卖出数量
                    $ordersale->s_hand =  '+'.$quantity;//卖出数量
                    $ordersale->status = 5;
                    $bzj1 = $quantity*$ordersale->order_ly_money/$ordersale->order_hander;//卖出数量占比的保证金
                    $bzj2 = $quantity*$ordersale->zj_bzj/$ordersale->order_hander;//卖出数量占比的追加保证金
                    $ordersale->order_ly_money -= $bzj1;//扣除卖出数量后剩余的保证金
                    $ordersale->zj_bzj -= $bzj2;//扣除卖出数量后剩余的追加保证金
                    $bzj = $bzj1+$bzj2;
                    $ordersale->left_hander = $ordersale->order_hander - $quantity;//剩余数量
                    $new_money =  $sale_money * $quantity;//卖出市值
                    $ordersale->sale_total = $new_money;//卖出总额
//                $ordersale->mc_orderNo = $res['data']['order']['orderNo'];//卖出时的委托单号
                    $yq_money = $quantity*$ordersale->order_my_money;//
                    $chajia = $new_money - $yq_money;//卖出市值和买入市值的差价
                    $ordersale->mc_yk = $ordersale->mc_yk + $chajia;//卖出盈亏
                    $ordersale->mc_ly_bzj = $bzj1;//卖出履约保证金
                    $ordersale->mc_zj_bzj = $bzj2;//卖出时追加保证金
                    $ordersale->mc_chajia = $chajia;//卖出差价
                    $memberMoney = $bzj + $chajia;
                    try{
                        $ordersale->save(false);
                        //$onelist->save(false);
                        //$fund->save(false);
                        $tran->commit();
                        file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s', time()) . '手机主动卖出成功，订单号：' . $ordersale->id. PHP_EOL, FILE_APPEND);
                        return json_encode(array('status' => '100', 'info' => '卖出成功'));
                    }catch (\Exception $e){
                        $tran->rollBack();
                        file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s', time()) . '手机主动卖出失败，订单号：' . $ordersale->id. PHP_EOL, FILE_APPEND);
                        return json_encode(array('status' => '200', 'info' => '卖出失败'));
                    }
                }else if($quantity < $ordersale->order_hander){
                    //卖出部分股票的情况，原来的只有剩余数量会变
                    $ordersale->left_hander -= $quantity;//剩余数量
                    $ordersale->sale_hander += $quantity;
                    $bzj1 = $quantity*$ordersale->order_ly_money/$ordersale->order_hander;//卖出数量占比的保证金
                    $bzj2 = $quantity*$ordersale->zj_bzj/$ordersale->order_hander;//卖出数量占比的追加保证金
                    $ordersale->order_ly_money -= $bzj1;//扣除卖出数量后剩余的保证金
                    $ordersale->zj_bzj -= $bzj2;//扣除卖出数量后剩余的追加保证金
                    if($ordersale->left_hander == 0 ){
                        $ordersale->status = 2;
                        $ordersale->end_time = time();
                    }

                    //新增一条订单
                    $saleorder = new AdminOrder;
                    $maxid = AdminOrder::find()->max('id');
                    $saleorder->goods_id = $ordersale->goods_id;
                    $saleorder->goods_name = $ordersale->goods_name;
                    $saleorder->goods_code = $ordersale->goods_code;
                    $saleorder->user_id = $ordersale->user_id;
                    $saleorder->user_tel = $ordersale->user_tel;
                    $saleorder->order_sn = $ordersale->order_sn;
                    $saleorder->order_my_money = $ordersale->order_my_money;
                    $saleorder->order_hander = $ordersale->order_hander;
//                    $saleorder->order_real_money = $ordersale->order_real_money;
//                    $saleorder->order_real_hander = $ordersale->order_real_hander;
                    $saleorder->sale_money = '+'.$sale_money;//卖出价格
                    $saleorder->sale_hander = $quantity;//卖出数量
                    $saleorder->sale_total = $sale_money * $quantity;
                    $saleorder->s_hand =  '+'.$quantity;//卖出数量
                    $saleorder->end_time = time();
                    $saleorder->status = 5;
                    $new_money =  $sale_money * $quantity;//卖出市值
                    $yq_money = $quantity*$ordersale->order_my_money;//
                    $chajia = $new_money - $yq_money;//卖出市值和买入市值的差价
                    $saleorder->mc_yk = $ordersale->mc_yk + $chajia;//卖出盈亏
                    $saleorder->mc_ly_bzj = $bzj1;//卖出履约保证金
                    $saleorder->mc_zj_bzj = $bzj2;//卖出时追加保证金
                    $saleorder->mc_chajia = $chajia;//卖出差价
                    $saleorder->id = $maxid+1;
                    if($saleorder->save(false) && $ordersale->save(false)){
                        return json_encode(array('status' => '100', 'info' => '卖出成功'));
                    }
                }
            }
        }
    }

    public function actionCd(){
        $this->getView()->title = '撤单';
        $cdlist = AdminOrder::find()
            ->where(['user_id'=>$this->userId])
            ->orderBy('created_time desc')
            ->andWhere(['in','status',[4,5]])
            ->all();
        return $this->render('cd',compact('cdlist'));
    }

    public function actionCdcomfirm(){
        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post('id');
            $ordersale = AdminOrder::findone($id);
            if($ordersale->status ==4){
                $ordersale->status = 9;//委托撤单中（买入撤单）
                $info = '买入委托撤单成功';
            }else if($ordersale->status ==5){
                $ordersale->status = 10;//委托撤单中（卖出撤单）
                $info = '卖出委托撤单成功';
            }
            $ordersale->save(false);
            return json_encode(array('status' => '100', 'info' => $info));
        }else{
            return json_encode(array('status' => '300', 'info' => '数据不正确'));
        }
    }


    public function actionHolding(){
        $this->getView()->title = '持仓';
        $holdinglist = AdminOrder::find()
            ->where(['user_id'=>$this->userId])
            ->orderBy('created_time desc')
            ->andWhere(['status'=>1])
            ->all();
        return $this->render('holding',compact('holdinglist'));
    }

    public function actionTodaytrans(){
        $this->getView()->title = '今日交易';
        $todaylist = AdminOrder::find()
            ->andWhere(['between', 'created_time', mktime(0, 0, 0, date('m'), date('d'), date('Y')), mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1])
            ->orWhere(['between', 'end_time', mktime(0, 0, 0, date('m'), date('d'), date('Y')), mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1])
            ->andWhere(['user_id' => $this->userId])
            ->orderBy('id desc')
            ->all();
        return $this->render('today',compact('todaylist'));
    }

    public function actionHistorytrans(){
        $this->getView()->title = '历史交易';
        $query = AdminOrder::find();
        $search = yii::$app->request->get();
        $stime = explode('-', $search['stime']);
        $etime = explode('-', $search['etime']);
        $stime2 = mktime(0, 0, 0, $stime[1], $stime[2], $stime[0]);
        $etime2 = mktime(23, 59, 59, $etime[1], $etime[2], $etime[0]);
        if ($search) {
            $query = $query->where(['between', 'created_time', $stime2, $etime2]);
        }
        $historylist = $query
            ->andWhere(['user_id' => $this->userId])
            ->orderBy('id desc')
            ->all();
        return $this->render('history',compact('historylist'));
    }

    public function actionCapitalFlow()
    {
        $this->getView()->title = '资金流水';
        $funds = AdminFund::find()->where(['user_id' => $this->userId])
            ->orderBy('created_time desc')
            ->limit(10)->all();
        return $this->render('capital-flow', compact('funds'));
    }


}