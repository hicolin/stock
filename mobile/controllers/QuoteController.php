<?php
/**
 * User: Colin
 * Time: 2019/1/21 15:54
 */

namespace mobile\controllers;

use backend\models\AdminFund;
use backend\models\AdminMember;
use backend\models\AdminOrder;
use backend\models\AdminOption;
use backend\models\AdminStocks;
use backend\models\AdminStocksCategory;
use Yii;
class QuoteController extends BaseController
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

    public function actionDetail()
    {
        $get = Yii::$app->request->get();
        $code = $get['code'];
        $prefix = substr($code, 0, 2);
        $newCode = substr($code,2);
        $this->getView()->title = $get['title'];
        $member = AdminMember::findOne($this->userId);
        if ($prefix == 'sh') {
            $stock = AdminStocks::findOne(['code' => $newCode, 'cid' => 118]);
        } else {
            $stock = AdminStocks::findOne(['code' => $newCode, 'cid' => 119]);
        }
        $option = AdminOption::find()->where(['user_id' => $this->userId, 'goods_id' => $stock->id])->one();
        $hasOption = $option ? true : false;
        $money = $member->money;
        $rate = (float)Helper::getSysInfo(71); // 配资比例
//        self::dd($stock);
        if ($stock->cate_id == 38) {
            return  $this->render('zhishu', compact('code', 'money', 'rate', 'hasOption'));
        }
        return $this->render('detail', compact('code', 'money', 'rate', 'hasOption'));
    }

    public function actionSelfSelect()
    {
        $this->getView()->title = '自选股';
        $optionlist = AdminStocks::find()
            ->joinWith('option', 'AdminOption.goods_id = AdminStocks.id')
            ->select(['admin_stocks.id', 'admin_stocks.cid', 'admin_stocks.code', 'admin_stocks.name'])
            ->where(['admin_option.user_id' => $this->userId])
            ->orderBy('id desc')
            ->all();
        $marketList =  self::getMarketList($optionlist);
        $categories =AdminStocksCategory::find()->all();
        $res = $this->getGp();
        $res = json_decode($res, true);
        $info = $res['data'];
        return $this->render('self-select',compact('optionlist','marketList', 'categories', 'info'));
    }

    /**
     * 组装股票代码
     * @param $stocks
     * @return bool|string
     */
    public static function getMarketList($stocks)
    {
        $marketList = '';
        foreach ($stocks as $list) {
            if ($list['cid'] == 118) { // 沪股
                $marketList .= 'sh' . $list['code'] . ',';
            } else { // 深股
                $marketList .= 'sz' . $list['code'] . ',';
            }
        }
        $marketList = substr($marketList, 0, strlen($marketList) - 1);
        return $marketList;
    }

    public function actionBuyIn()
    {
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $num = (int)$post['num'];
            $member = AdminMember::findOne($this->userId);
            $stock = AdminStocks::findOne(['code' => $post['code']]);
            $rate = (float)Helper::getSysInfo(71);
            $z = 0.0048 * $rate + 1;
            $maxBuyNum = $member->money * $rate / $z / $post['price'];
            $maxBuyNum = intval($maxBuyNum / 100) * 100;
            if ($num > $maxBuyNum) {
                return $this->json(100, '购买股数不能大于最大可购买数');
            }
            if ($num % 100 != 0) {
                return $this->json(100, '购买股数必须是100的整数倍');
            }
            $Sj = mktime(9, 15, 0);
            $Sj2 = mktime(11, 30, 0);
            $Sj3 = mktime(13, 0, 0);
            $Sj4 = mktime(14, 55, 0);
            $week = date('w');
            $res = ($week != 6 && $week != 0) && (($Sj < time() && time() < $Sj2) || ($Sj3 < time() && time() < $Sj4));
            if ($res) {
                return $this->json(100, '不在交易时间范围内');
            }
            if ($stock->cid == 118) {
                $new_code = 'sh'. $stock->code;
            } else {
                $new_code = 'sz'. $stock->code;
            }
            $goods_id = $stock->id;
            $goods_name = $stock->name;
            $goods_code = $new_code;
            $order_sn = Helper::getOrderNo();
            $order_my_money = $post['price'];
            $order_hander = $num;
            $order_bl = $rate;
            $pay_money = $order_my_money * $order_hander * (12.5 + 0.48) / 100;
            $order_ly_money = $order_my_money * $order_hander / 8;
            $order_charge = $order_my_money * $order_hander * 0.48 / 100;
            if ($order_charge < 20) {  // 手续费小于 20
                $order_charge = 20;
                $pay_money = $order_charge + $order_ly_money;
                if ($member->money * 1000 < $pay_money * 1000) {
                    $m = $order_hander - 100;
                    return $this->json(100, "您最多只可以买{$m}只股票");
                }
            }
            //买入市值
            $total = $order_my_money * $order_hander;
            $sumo = AdminOrder::find()->where(['goods_id' => $goods_id])
                ->select('sum(total) as total')->asArray()->one();
            $summ = AdminOrder::find()->where(['goods_id' => $goods_id])
                ->andWhere(['user_id' => $this->userId])
                ->select('sum(total) as total')->asArray()->one();
            $sum_o = floatval($sumo['total']);
            $sum_m = floatval($summ['total']);
            if($member->money * 1000 < $pay_money * 1000){
                return $this->json(100, '余额不足');
            }
            if ($sum_o > 3000000) {
                return $this->json(100, '单只个股总额超过上限');
            }
            if ($sum_m > 1500000) {
                return $this->json(100, '单只个股购买/持股金额上限150万');
            }
            $num = 3000000 - $sum_o; //总账户可买
            $num1 = 1500000 - $sum_m; //子账户可买
            if ($total > $num && $total < $num1) {
                $info = "您最多只能购买" . $num . "元市值的股票";
                return $this->json(100, $info);
            }
            if ($total < $num && $total > $num1) {
                $info = "您最多只能购买" . $num1 . "元市值的股票";
                return $this->json(100, $info);
            }
            if ($total > $num && $total > $num1) {
                if ($num1 > $num) {
                    $info = "您最多只能购买" . $num . "元市值的股票";
                } else {
                    $info = "您最多只能购买" . $num1 . "元市值的股票";
                }
                return $this->json(100, $info);
            }
            $order = new AdminOrder();
            $fund = new AdminFund();
            if (true) { // 私盘不需要接口
                $order->user_id = $this->userId;
                $fund->user_id = $this->userId;
                $order->user_tel = $member->tel;
                $order->goods_id = $goods_id;
                $order->goods_name = $goods_name;
                $order->goods_code = $goods_code;
                $order->order_my_money = $order_my_money;
                $order->order_real_money = $order_my_money;//假数据
                // $order->order_real_money = $res['data'][0];//真数据
                $order->order_ly_money = $order_ly_money;
                $order->order_bl = $order_bl;
                $order->order_charge = $order_charge;
                $order->order_hander = $order_hander;
                $order->left_hander = $order_hander;
                $order->order_real_hander = $order_hander;
                $order->total = $total;
                $order->order_sn = $order_sn;
                $fund->order_id = $order_sn;
                $order->created_time = time();
                $order->begin_time = time();
                $fund->created_time = time();
                $order->pay_money = $pay_money;
                $fund->amount = $pay_money;
                $fund->title = "手机买入(" . $goods_code . $goods_name . $order_my_money . "*" . $order_hander . ")(支出保证金+手续费" . $pay_money . ")";
                $order->status = 4;//委托买入  需要查询在确定改变状态
                $member->money -= $pay_money;
                $fund->money = $member->money;
                $trans = Yii::$app->db->beginTransaction();
                try{
                    $order->save();
                    $member->save();
                    $fund->save();
                    $trans->commit();
                    return $this->json(200, '委托买入成功');
                }catch (\Exception $e){
                    $trans->rollBack();
                    return $this->json(100, '委托买入失败');
                }
            }
        }
    }

    public function actionCartIn(){
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $code = $post['code'];
            $stock = AdminStocks::findOne(['code' => $code]);
            $counts = AdminOption::find()->where(['user_id' => $this->userId])->andFilterWhere(['goods_id' => $stock->id])->all();
            if ($counts) {
                return $this->json(100, '重复加入');
            } else {
                $order = new AdminOption;
                $order->goods_id = $stock->id;
                $order->user_id = $this->userId;
                if ($order->save()) {
                    return $this->json(200, '加入自选成功');
                }
            }
        }
    }

    public function actionCartDel()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $code = $post['code'];
            $stock = AdminStocks::findOne(['code' => $code]);
            $option = AdminOption::find()->where(['user_id' => $this->userId])
                ->andFilterWhere(['goods_id' => $stock->id])->one();
            if (!$option->delete()) {
                return $this->json(100, '移除失败');
            }
            return $this->json(200, '移除成功');
        }
    }

    public function actionMyorder(){

        $order = new AdminOption;
        $user_id = Yii::$app->session['id'];
        if (!Yii::$app->session['id']) {
           return 5;
            exit;
        }
        if (Yii::$app->request->get()) {
            $itemid = Yii::$app->request->get('itemid');
            $counts = AdminOption::find()->where(['user_id' => $user_id])->andFilterWhere(['goods_id' => $itemid])->all();
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



}