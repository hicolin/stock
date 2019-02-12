<?php

namespace frontend\controllers;

use backend\models\AdminCommission;
use backend\models\AdminFund;
use backend\models\AdminMember;
use backend\models\AdminOrder;
use backend\models\AdminStocks;
use backend\models\AdminUser;
use backend\models\AdminUserpeoduct;
use common\models\Common;
use common\models\Tdx;
use yii\db\Expression;
use yii\rest\Controller;

class AutoController extends Controller
{
    /**
     * 根据止盈止损卖出
     */
    public function actionIndex()
    {
        file_put_contents('z.txt', date('ymd H:i:s') . PHP_EOL, FILE_APPEND);
        $time = mktime(0, 0, 0, date('m'), date('d'), date('y'));//今天凌晨
        $day = date("Ymd");
        $res = Common::getDay($day);
        if ($res['data'] != 0) {
            file_put_contents('dy_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            echo '今天是节假日';
            exit;
        }
        $rate = (100 - Common::getSysInfo(72)) / 100;
        $order = AdminOrder::find()->where(['status' => 1])->andWhere(['<', 'begin_time', $time])->asArray()->orderBy('id desc')->all();
        // var_dump($order);exit;
        if ($order) {
            foreach ($order as $list) {
                $bzj = ($list['order_ly_money'] + $list['zj_bzj']) * $rate;
                $this->rule($bzj, $list);
            }
            file_put_contents('zs_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            echo '完成';
            exit;
        } else {
            echo 666;
            exit;
        }
    }

    protected function rule($bzj, $list)
    {
        $data = array('list' => $list['goods_code']);
        $res = Common::getGp($data);
        $result = $res['data']['0'];
        file_put_contents('pj.txt',date("Y-m-d H:i:s").'-'.$list['goods_code'].'-'.$result['new_price'].PHP_EOL,FILE_APPEND);
        if ($result['new_price'] == 0) {
            $price_zz = floatval($result['settlement_yesterday']);
        } else {
            $price_zz = floatval($result['new_price']);
        }

        $dang_money = $price_zz * $list['order_hander'];
        $sy_money = $list['order_hander'] * $list['order_my_money'];
        if ($dang_money <= $sy_money - $bzj) {
            $bcMoney = $dang_money * 0.01;
            $member = AdminMember::findOne($list['user_id']);
            $found = new AdminFund();
            if ($bcMoney <= 0) {
                return;
            }
            if ($bcMoney < $member->money) {
                $found->user_id = $list['user_id'];
                $found->amount = $bcMoney;
                $found->order_id = $list['id'];
                $found->title = '追加保证金' . $list['goods_code'] . '+' . $bcMoney . '元';
                $found->created_time = time();
                $member->money -= $bcMoney;
                $found->money = $member->money;
                $list2 = AdminOrder::findOne($list['id']);
                //$list2->order_ly_money = $list2->order_ly_money + $bcMoney;
                $list2->zj_bzj = $list2->zj_bzj + $bcMoney;
                $tran = \Yii::$app->db->beginTransaction();
                try {
                    $member->save(false);
                    $found->save(false);
                    $list2->save(false);
                    $tran->commit();
                    file_put_contents('z_auto_log.txt', date('Y-m-d H:i:s', $found->created_time) . '追加保证金成功，订单号：' . $list['order_sn'] . PHP_EOL, FILE_APPEND);
                } catch (\Exception $e) {
                    $tran->rollBack();
                    file_put_contents('z_auto_log.txt', date('Y-m-d H:i:s', $found->created_time) . '追加保证金失败，订单号：' . $list['order_sn'] . PHP_EOL, FILE_APPEND);
                }
            } else {//调用接口卖出
                $tdx = new Tdx();
                $orderCate = 1;
                $priceCate = 0;
                $stock_code = substr($list['goods_code'], 2);

                if ($result['new_price'] == 0) {
                    $price = floatval($result['settlement_yesterday']);
                } else {
                    $price = floatval($result['new_price']);
                }
                $quantity = intval($list['order_hander']);
                $res = $tdx->SendOrder($orderCate, $priceCate, $stock_code, $price, $quantity);
                if ($res['success'] == true) {
                    $list3 = AdminOrder::findOne($list['id']);
                    $list3->sale_money = $price;
                    $list3->sale_hander = $quantity;
                    $list3->end_time = time();
                    $list3->status = 5;
                    $list3->sale_total = $price * $quantity;

                    $bzj1 = $quantity * $list3->order_ly_money / $list3->order_hander;
                    $bzj2 = $quantity * $list3->zj_bzj / $list3->order_hander;
                    $list3->order_ly_money -= $bzj1;
                    $list3->zj_bzj -= $bzj2;
                    $bzj = $bzj1 + $bzj2;
                    $list3->left_hander = $list3->order_hander - $quantity;//剩余数量
                    $list3->order_hander -= $quantity;//剩余数量
                    $list3->mc_orderNo = $res['data']['order']['orderNo'];//卖出时的委托单号

                    $yq_money = $quantity * $list3->order_my_money;
                    $chajia = $list3->sale_total - $yq_money;
                    $list3->mc_yk = $list3->mc_yk + $chajia;
                    $list3->mc_ly_bzj = $bzj1;
                    $list3->mc_zj_bzj = $bzj2;
                    $list3->mc_chajia = $chajia;
                    $memberMoney = $bzj + $chajia;
                    //$member->money += $memberMoney;
                    //$member->money += $price * $quantity;
//                    $found->user_id = $list['user_id'];
//                    $found->amount = $memberMoney;
//                    $found->order_id = $list['id'];
//                    $found->title = "平仓卖出(" . $stock_code. '退还保证金'.$bzj1.'+追加保证金'.$bzj2.'+差价'.$chajia .")";
//                    $found->created_time = time();
                    $tran = \Yii::$app->db->beginTransaction();
                    try {
                        //$member->save(false);
                        //$found->save(false);
                        $list3->save(false);
                        $tran->commit();
                        file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s', $found->created_time) . '平仓卖出成功，订单号：' . $list['id'] . PHP_EOL, FILE_APPEND);
                    } catch (\Exception $e) {
                        $tran->rollBack();
                        file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s', $found->created_time) . '平仓卖出失败，订单号：' . $list['id'] . PHP_EOL, FILE_APPEND);
                    }
                }
            }
        }
    }

    /**
     * 先计算每条订单递延费和盈亏 用来看余额是否充足
     */
    public function actionDy()
    {
        file_put_contents('dy.txt', date('Y-m-d H:i:s'));
        //$time = mktime(0,0,0,date('m'),date('d'),date('y'));//当天凌晨
        $order = AdminOrder::find()->where(['status' => 1])->asArray()->orderBy('id desc')->all();//今天之前的订单
        if ($order) {
            foreach ($order as $k => $value) {
                $data = array('list' => $value['goods_code']);
                $res = Common::getGp($data);
                //$member = AdminMember::findOne($value['user_id']);
                $result = $res['data']['0'];
                if ($result['new_price'] == 0) {
                    $result['new_price'] = $result['settlement_yesterday'];
                }
                //当前市值
                $dang_money = $result['new_price'] * $value['order_hander'];
                //当前预留保证金
                $new_bzj = $dang_money * 0.125;
                //结算盈亏
                $yq_money = $value['order_hander'] * $value['order_my_money'];
                //$yk = $dang_money - $value['total'] + $value['order_ly_money'] - $new_bzj;
                $yk = $dang_money - $yq_money;
                $dy = $dang_money * 0.0018; //当前递延费
                $list = AdminOrder::findOne($value['id']);
                //$list->order_ly_money = $new_bzj;
                $list->profit = $yk;
                $list->day_dy = $dy;
                $list->day_yk = $yk;
                $list->new_total = $dang_money;
                $list->save();
            }
            file_put_contents('DY_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            echo '完成';
            exit;
        }
    }

    /**
     * 14.50  当日结算
     */
    public function actionRate()
    {
        //今天之前的交易完成的订单
        $time = mktime(0, 0, 0, date('m'), date('d'), date('y'));
        // $week = date('w');
        //  if ($week == 6 || $week == 0) {
        $day = date("Ymd");
        $res = Common::getDay($day);
        if ($res['data'] != 0) {
            file_put_contents('dy_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            echo '今天是节假日';
            exit;
        }
        $order = AdminOrder::find()->where(['status' => 1])->andWhere(['<', 'begin_time', $time])->asArray()->orderBy('id desc')->all();
        if ($order) {
            foreach ($order as $k => $value) {
                $data = array('list' => $value['goods_code']);
                $res = Common::getGp($data);
                $member = AdminMember::findOne($value['user_id']);
                $result = $res['data']['0'];
                //当前市值
                if ($result['new_price'] == 0) {
                    $result['new_price'] = $result['settlement_yesterday'];
                }
                $dang_money = $result['new_price'] * $value['order_hander'];
                //当前预留保证金
                $new_bzj = $dang_money * 0.125;
                /******递延不足卖出*****/
                $dy = $dang_money * 0.0018; //当前递延费
                if ($member->money < $dy) {
                    $tdx = new Tdx();
                    $orderCate = 1;
                    $priceCate = 0;
                    $stock_code = substr($value['goods_code'], 2);
                    if ($result['new_price'] == 0) {
                        $price = floatval($result['settlement_yesterday']);
                    } else {
                        $price = floatval($result['new_price']);
                    }
                    $quantity = $value['order_hander'];
                    $resz = $tdx->SendOrder($orderCate, $priceCate, $stock_code, $price, $quantity);
                    if ($resz['success'] == true) {
                        $sale_order = AdminOrder::findOne($value['id']);
                        $sale_order->sale_money = $price;
                        $sale_order->sale_hander = $quantity;
                        $sale_order->end_time = time();
                        $sale_order->status = 5;
                        $sale_order->sale_total = $price * $quantity;
                        $bzj1 = $quantity * $sale_order->order_ly_money / $sale_order->order_hander;
                        $bzj2 = $quantity * $sale_order->zj_bzj / $sale_order->order_hander;
                        $sale_order->order_ly_money -= $bzj1;
                        $sale_order->zj_bzj -= $bzj2;
                        $bzj = $bzj1 + $bzj2;
                        $sale_order->left_hander = $sale_order->order_hander - $quantity;//剩余数量
                        $sale_order->order_hander -= $quantity;//剩余数量
                        $yq_money = $quantity * $sale_order->order_my_money;
                        $chajia = $sale_order->sale_total - $yq_money;
                        $sale_order->mc_orderNo = $resz['data']['order']['orderNo'];//卖出时的委托单号
                        $sale_order->mc_yk = $sale_order->mc_yk + $chajia;
                        $sale_order->mc_ly_bzj = $bzj1;
                        $sale_order->mc_zj_bzj = $bzj2;
                        $sale_order->mc_chajia = $chajia;
                        $memberMoney = $bzj + $chajia;
                        //$member->money += $memberMoney;
//                        $found = new AdminFund();
//                        $found->user_id = $value['user_id'];
//                        $found->amount = $memberMoney;
//                        $found->order_id = $value['id'];
//                        $found->money = $member->money;
//                        $found->title = "递延费用不足平仓卖出(" . $stock_code. '退还保证金'.$bzj1.'+追加保证金'.$bzj2.'+差价'.$chajia .")";
//                        $found->created_time = time();
                        $tran = \Yii::$app->db->beginTransaction();
                        try {
                            //$member->save(false);
                            //$found->save(false);
                            $sale_order->save(false);
                            $tran->commit();
                            file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s') . '递延费用不足平仓卖出，订单号：' . $value['id'] . PHP_EOL, FILE_APPEND);
                        } catch (\Exception $e) {
                            $tran->rollBack();
                            file_put_contents('z_auto_sale_log.txt', date('Y-m-d H:i:s') . '递延费用不足平仓卖出，订单号：' . $value['id'] . PHP_EOL, FILE_APPEND);
                        }
                    }
                    /*******结束*****/
                } else {
                    //结算盈亏
                    $yq_money = $value['order_hander'] * $value['order_my_money'];
                    $yk = $dang_money - $yq_money;
                    $list = AdminOrder::findOne($value['id']);
                    //$list->order_ly_money = $new_bzj;
                    $list->profit = $yk;
                    $dy = $dang_money * 0.0018; //当前递延费
                    $list->day_dy = $dy;
                    $list->dy += $dy;
                    $list->day_yk = $yk;
                    $list->new_total = $dang_money;
                    $member->money -= $dy;
                    $found = new AdminFund();
                    $found->user_id = $value['user_id'];
                    $found->amount = $dy;
                    $found->money = $member->money;
                    $found->order_id = $value['id'];
                    $found->title = '扣除递延费' . $dy . '元';
                    $found->created_time = time();
                    //计算佣金
                    $ids = array();
                    if ($member->pid != 156) {
                        array_push($ids, $member->pid);
                        $id = AdminUser::findOne($member->pid)->pid;
                        if ($id != 156) {
                            array_unshift($ids, $id);
                        }
                    }
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        $member->save(false);
                        $list->save(false);
                        $found->save(false);
                        $transaction->commit();
                        if (!empty($ids)) {
                            foreach ($ids as $kk => $val) {
                                $model = AdminUser::findOne($val);
                                $commission = new AdminCommission();
                                $commission->type = 2;
                                $commission->uid = $val;
                                $commission->order_sn = $list->order_sn;
                                $commission->create_time = time();
                                $commission->money = $dy * $model->dy_rate / 100;
                                $user = AdminUserpeoduct::findOne(['uid' => $model->id]);
                                $user->commission_member += $commission->money;
                                $user->commission_agent += $commission->money;
                                $tran = \Yii::$app->db->beginTransaction();
                                try {
                                    $commission->save();
                                    $user->save(false);
                                    $tran->commit();
                                } catch (\Exception $e) {
                                    $tran->rollBack();
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                    }
                }
            }
        }
        file_put_contents('js_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
        echo '完成';
        exit;
    }

    /**
     * 反馈可撤单的委托编号 根据这个字段查出个人拥有的订单
     * @return array
     * 先查状态为4的
     */
    public function actionO()
    {
        $tdx = new Tdx();
        $res = $tdx->queryData(4);//可撤单
        $rows = $res['data']['rows'];//所有的可撤单 代表依然在已报中
        $orderNo = array();
        if (!empty($rows)) {
            foreach ($rows as $list) {
                $orderNo[] = $list['8'];//反馈的委托单号
            }

            if (!empty($orderNo)) {
                //$order = AdminOrder::find()->where(['status'=>1])->andWhere(['in','tdx_orderNo',$orderNo])->all();
                foreach ($orderNo as $k => $value) {
                    $order = AdminOrder::find()->where(['status' => 1])->andWhere(['tdx_orderNo' => $value])->one();
                    $order->status = 4;
                    $order->save();
                }
            }
            echo '完成2';
            exit;
        }
        echo '完成';
        exit;
        //return $orderNo;
    }

    /**
     * 处理买入委托已报的订单
     */
    public function actionD()
    {
        $time = mktime('15', '10', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
            $tdx = new Tdx();
            $res = $tdx->queryData(2);//查询当日委托单
            $rows = $res['data']['rows'];//所有的委托单
            $orderNo = array();
            foreach ($rows as $list) {
                if($list['5']=='已成'){
                    $orderNo[] = $list['8'];//反馈的委托单号
                    $realm[$list['8']] = $list['9'];//实际成交价格
                }
            }
            if (!empty($orderNo)) {
                $order = AdminOrder::find()->where(['status' => 4])->orWhere(['status' => 9])->andWhere(['in', 'tdx_orderNo', $orderNo])->all();
            }
            if (!empty($order)) {
                file_put_contents('11.txt', date('Y-m-d H:i:s'));
                foreach ($order as $key=>$list) {
                    $ids = array();
                    $onelist = AdminMember::findOne($list->user_id);
                    if ($onelist->pid != 156) {
                        array_push($ids, $onelist->pid);
                        $id = AdminUser::findOne($onelist->pid)->pid;
                        if ($id != 156) {
                            array_unshift($ids, $id);
                        }
                    }
                    if (!empty($ids)) {
                        foreach ($ids as $k => $val) {
                            $list->status = 1;
                            $list->order_real_money = $realm[$list['tdx_orderNo']];
                            $model = AdminUser::findOne($val);
                            $commission = new AdminCommission();
                            $commission->type = 1;
                            $commission->uid = $val;
                            $commission->order_sn = $list->id;
                            $commission->create_time = time();
                            $commission->money = $list->order_charge * $model->rate / 100;
                            $user = AdminUserpeoduct::findOne(['uid' => $model->id]);
                            $user->commission_member += $commission->money;
                            $user->commission_amount += $commission->money;
                            $tran = \Yii::$app->db->beginTransaction();
                            file_put_contents('12390.txt', $commission->money);
                            try {
                                $list->save(false);
                                $commission->save(false);
                                $user->save(false);
                                $tran->commit();
                            } catch (\Exception $e) {
                                $tran->rollBack();
                            }
                        }
                    } else {
                        $list->status = 1;
                        $list->order_real_money = $realm[$key];
                        $list->save(false);
                    }
                }
                echo '买入委托完成';
                exit;
            }
            echo '没有买入委托的订单';
            exit;
        }

        echo '不在时间范围';
        exit;
    }


    /**
     * 处理买入委托已报的订单（常杰）
     */
    public function actionD2()
    {
        $time = mktime('15', '10', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
            $tdx = new Tdx();
            $res = $tdx->queryData(4);//可撤单
            $rows = $res['data']['rows'];//所有的可撤单 代表依然在已报中 ====== 委托单中自己要加一个委托可撤单
            $orderNo = array();
            foreach ($rows as $list) {
                $orderNo[] = $list['8'];//反馈的委托单号
            }
            file_put_contents('kc_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            file_put_contents('kc_log_dd.txt', json_encode($orderNo) . '-' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
            if (!empty($orderNo)) {
                $order = AdminOrder::find()->where(['status' => 4])->andWhere(['not in', 'tdx_orderNo', $orderNo])->all();
            }
            if (!empty($order)) {
                file_put_contents('11.txt', date('Y-m-d H:i:s'));
                foreach ($order as $list) {
                    $ids = array();
                    $onelist = AdminMember::findOne($list->user_id);
                    if ($onelist->pid != 156) {
                        array_push($ids, $onelist->pid);
                        $id = AdminUser::findOne($onelist->pid)->pid;
                        if ($id != 156) {
                            array_unshift($ids, $id);
                        }
                    }
                    if (!empty($ids)) {
                        foreach ($ids as $k => $val) {
                            $list->status = 1;
                            $model = AdminUser::findOne($val);
                            $commission = new AdminCommission();
                            $commission->type = 1;
                            $commission->uid = $val;
                            $commission->order_sn = $list->id;
                            $commission->create_time = time();
                            $commission->money = $list->order_charge * $model->rate / 100;
                            $user = AdminUserpeoduct::findOne(['uid' => $model->id]);
                            $user->commission_member += $commission->money;
                            $user->commission_amount += $commission->money;
                            $tran = \Yii::$app->db->beginTransaction();
                            file_put_contents('12390.txt', $commission->money);
                            try {
                                $list->save(false);
                                $commission->save(false);
                                $user->save(false);
                                $tran->commit();
                            } catch (\Exception $e) {
                                $tran->rollBack();
                            }
                        }
                    } else {
                        $list->status = 1;
                        $list->save(false);
                    }
                }
                echo '买入委托完成';
                exit;
            }
            echo '没有买入委托的订单';
            exit;
        }

        echo '不在时间范围';
        exit;
    }

    /**
     * 处理买入主动撤单的，19点之前可以主动撤单，15点之后自动撤单
     */
    public function actionCdself()
    {
        $time = mktime('16', '0', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
            $tdx = new Tdx();
            $res = $tdx->queryData(4);//可撤单
            $rows = $res['data']['rows'];//所有的可撤单 代表依然在已报中
            $orderNo = array();
            if (!empty($rows)) {
                foreach ($rows as $list) {
                    $orderNo[] = $list['8'];//反馈的委托单号
                }
                file_put_contents('kc_log.txt', date('Y-m-d H:i:s') .$orderNo. PHP_EOL, FILE_APPEND);
                if (!empty($orderNo)) {
                    $btime = mktime(0, 0, 0, date('m'), date('d'), date('Y')); //当天所有的订单--起始时间
                    $etime = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1; //当天所有的订单--结束时间
                    //去找用户主动撤单的订单
                    $order = AdminOrder::find()->where(['status' => 9])->andWhere(['in', 'tdx_orderNo', $orderNo])->andWhere(['between','begin_time',$btime,$etime])->all();
                    if (!empty($order)) {
                        foreach ($order as $list) {
                            $stock_code = substr($list->goods_code, 2);
                            file_put_contents('120851.txt', $list->tdx_orderNo . '-' . $stock_code);
                            $cdRes = $tdx->cancelOrder($list->tdx_orderNo, $stock_code);
                            file_put_contents('cd_jg1.txt', $cdRes['success'] . '-' . $cdRes['msg'] . '单号' . $list->id . '-' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
                            if ($cdRes['success'] == 1 && $cdRes['msg'] == '撤销委托成功') {
                                $list->status = 3;
                                $onelist = AdminMember::findOne($list->user_id);
                                $onelist->money += $list->pay_money;
                                $found = new AdminFund();
                                $found->user_id = $list->user_id;
                                $found->amount = $list->pay_money;
                                $found->money = $onelist->money;
                                $found->order_id = $list->id;
                                $found->title = '该笔订单撤单退还金额' . $list->pay_money . '元';
                                $found->created_time = time();
                                $tran = \Yii::$app->db->beginTransaction();
                                try {
                                    $list->save(false);
                                    $onelist->save(false);
                                    $found->save(false);
                                    $tran->commit();
                                } catch (\Exception $e) {
                                    $tran->rollBack();
                                }
                                echo '买入委托主动撤单完成';
                                exit;
                            }
                        }
                    }else{
                        echo '没有买入委托的主动撤单';
                        exit;
                    }
                }
            }else{
                echo '没有可撤单';
                exit;
            }
        }else{
            echo '不在时间内';
            exit;
        }

    }

    /**
     * 下午三点处理买入委托单中，全部还原
     */
    public function actionCd3()
    {
        $time = mktime('16', '0', '0', date('m'), date('d'), date('y'));
        if (time() == $time) {
            $btime = mktime(0, 0, 0, date('m'), date('d'), date('Y')); //当天所有的订单--起始时间
            $etime = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1; //当天所有的订单--结束时间
            $order = AdminOrder::find()->where(['status' => 4])->andWhere(['between','begin_time',$btime,$etime])->all();
            if (!empty($order)) {
                foreach ($order as $list) {
                    $list->status = 3;
                    $onelist = AdminMember::findOne($list->user_id);
                    $onelist->money += $list->pay_money;
                    $found = new AdminFund();
                    $found->user_id = $list->user_id;
                    $found->amount = $list->pay_money;
                    $found->money = $onelist->money;
                    $found->order_id = $list->id;
                    $found->title = '该笔订单撤单退还金额' . $list->pay_money . '元';
                    $found->created_time = time();
                    $tran = \Yii::$app->db->beginTransaction();
                    try {
                        $list->save(false);
                        $onelist->save(false);
                        $found->save(false);
                        $tran->commit();
                    } catch (\Exception $e) {
                        $tran->rollBack();
                    }
                }
                echo '买入委托自动撤单完成';
                exit;
            }
            echo '没有买入委托的可撤单';
            exit;
        }
        echo '不在时间内';
        exit;
    }


    /**
     * 处理买入委托单中超过1分钟的   对其进行自动撤单 （常杰）
     */
    public function actionCd()
    {
        $time1 = mktime('14', '50', '0', date('m'), date('d'), date('y'));
        $time2 = mktime('16', '0', '0', date('m'), date('d'), date('y'));
        if ($time1 < time() && time() < $time2) {
            $tdx = new Tdx();
            $res = $tdx->queryData(4);//可撤单
            $rows = $res['data']['rows'];//所有的可撤单 代表依然在已报中
            $orderNo = array();
            if (!empty($rows)) {
                foreach ($rows as $list) {
                    $orderNo[] = $list['8'];//反馈的委托单号
                }
                file_put_contents('kc_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
                if (!empty($orderNo)) {
//                    $time = time() - 60*30; //30分钟之前所有的订单
                    $order = AdminOrder::find()->where(['status' => 4])->andWhere(['in', 'tdx_orderNo', $orderNo])->all();
                    if (!empty($order)) {
                        foreach ($order as $list) {
                            $stock_code = substr($list->goods_code, 2);
                            file_put_contents('12085.txt', $list->tdx_orderNo . '-' . $stock_code);
                            $cdRes = $tdx->cancelOrder($list->tdx_orderNo, $stock_code);
                            file_put_contents('cd_jg.txt', $cdRes['success'] . '-' . $cdRes['msg'] . '单号' . $list->id . '-' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
                            if ($cdRes['success'] == 1 && $cdRes['msg'] == '撤销委托成功') {
                                $list->status = 3;
                                $onelist = AdminMember::findOne($list->user_id);
                                $onelist->money += $list->pay_money;
                                $found = new AdminFund();
                                $found->user_id = $list->user_id;
                                $found->amount = $list->pay_money;
                                $found->money = $onelist->money;
                                $found->order_id = $list->id;
                                $found->title = '该笔订单撤单退还金额' . $list->pay_money . '元';
                                $found->created_time = time();
                                $tran = \Yii::$app->db->beginTransaction();
                                try {
                                    $list->save(false);
                                    $onelist->save(false);
                                    $found->save(false);
                                    $tran->commit();
                                } catch (\Exception $e) {
                                    $tran->rollBack();
                                }
                                echo '买入委托自动撤单完成';
                                exit;
                            }
                        }
                    }else{
                        echo '没有买入委托的可撤单';
                        exit;
                    }
                }
            }else{
                echo '没有可撤单';
                exit;
            }
        }else{
            echo '不在时间内';
            exit;
        }
    }

    /**
     * 处理委托卖出的订单
     */
    public function actionSale()
    {
        $time = mktime('16', '10', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
            $tdx = new Tdx();
            $res = $tdx->queryData(2);//查询当日所有委托单
            $rows = $res['data']['rows'];//所有的委托单  判断list['5']为已成状态，则改变订单状态
            $orderNo = array();
            $realm = array();
            foreach ($rows as $list) {
                if($list['5']=='已成'){
                    $orderNo[] = $list['8'];//反馈的委托单号
                    $realm[$list['8']] = $list['9'];//实际成交价格
                }
            }
            if (!empty($orderNo)) {
                $order = AdminOrder::find()->where(['status' => 5])->orWhere(['status' => 10])->andWhere(['in', 'mc_orderNo', $orderNo])->all();
            }
            if (!empty($order)) {
                file_put_contents('mc_log2.txt', $list->id . '-' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
                foreach ($order as $key=>$list) {
                    if ($list->order_hander > 0) {//看卖出成功后的订单数量
                        $list->status = 1;
                    } else {
                        $list->status = 2;
                    }
                    $list->sale_real_money = $realm[$list['mc_orderNo']];
                    if($list->sale_money != $list->sale_real_money){
                        $chaj = ($list->sale_real_money - $list->sale_money) * $list->sale->hander;
                    }else{
                        $chaj = 0;
                    }
                    $money = $list->mc_ly_bzj + $list->mc_zj_bzj + $list->mc_chajia + $chaj;
                    $member = AdminMember::findOne($list->user_id);
                    $member->money += $money;
                    $fund = new AdminFund();
                    $fund->user_id = $list->user_id;
                    $fund->order_id = $list->id;
                    $fund->created_time = time();
                    $fund->amount = $money;
                    $fund->money = $member->money;
                    $fund->title = "卖出(" . $list->goods_code . $list->goods_name . '退还保证金' . $list->mc_ly_bzj . '+退还追加保证金' . $list->mc_zj_bzj . '+差价' . $list->mc_chajia . ")";
                    $tran = \Yii::$app->db->beginTransaction();
                    try {
                        $list->save(false);
                        $member->save(false);
                        $fund->save(false);
                        $tran->commit();
                    } catch (\Exception $e) {
                        $tran->rollBack();
                    }
                }
                echo '卖出委托完成';
                exit;
            }
            echo '没有卖出委托的订单';
            exit;
        }

        echo '不在时间范围';
        exit;
    }

    /**
     * 处理委托卖出的订单（私盘）
     */
    public function actionSale2()
    {
        $time = mktime('17', '10', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
           $order = AdminOrder::find()->andWhere(['status' => 5])->all();
            if (!empty($order)) {
                foreach ($order as $list) {
                    $randtime = rand(3,30);
                    sleep($randtime);
                    $list->status = 2;
                    $list->save(false);
                echo '卖出委托完成';
                exit;
                }
            }
            echo '没有卖出委托的订单';
            exit;
        }

        echo '不在时间范围';
        exit;
    }

    /**
     * 处理委托卖出的订单（私盘）
     */
    public function actionBuy2()
    {
        $time = mktime('18', '10', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
            $order = AdminOrder::find()->andWhere(['status' => 4])->all();
            if (!empty($order)) {
                foreach ($order as $list) {
                    $randtime = rand(3,30);
                    sleep($randtime);
                    $list->status = 1;
                    $list->save(false);
                    echo '买入委托完成';
                    exit;
                }
            }
            echo '没有买入委托的订单';
            exit;
        }
        echo '不在时间范围';
        exit;
    }


    /**
     * 主动卖出委托撤单
     */
    public function actionMcCdself()
    {
        $time = mktime('16', '0', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
            $tdx = new Tdx();
            $res = $tdx->queryData(4);//可撤单

            $rows = $res['data']['rows'];//所有的可撤单 代表依然在已报中
            $orderNo = array();
            if (!empty($rows)) {
                foreach ($rows as $list) {
                    $orderNo[] = $list['8'];//反馈的委托单号
                }
                if (!empty($orderNo)) {
                    $btime = mktime(0, 0, 0, date('m'), date('d'), date('Y')); //当天所有的订单--起始时间
                    $etime = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1; //当天所有的订单--结束时间
                    $order = AdminOrder::find()->where(['status' => 10])->andWhere(['in', 'mc_orderNo', $orderNo])->andWhere(['between','end_time',$btime,$etime])->all();
                    if (!empty($order)) {
                        foreach ($order as $list) {
                            $stock_code = substr($list->goods_code, 2);
                            file_put_contents('12085.txt', $list->mc_orderNo . '-' . $stock_code);
                            $cdRes = $tdx->cancelOrder($list->mc_orderNo, $stock_code);
                            file_put_contents('mc_cd_jg.txt', $cdRes['success'] . '-' . $cdRes['msg'] . '单号' . $list->id . '-' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
                            if ($cdRes['success'] == 1 && $cdRes['msg'] == '撤销委托成功') {
                                $list->status = 1;//持仓中
                                $list->end_time = '';
                                $list->sale_hander -= $list->sale_real_hander;
                                $list->order_ly_money += $list->mc_ly_bzj;
                                $list->zj_bzj += $list->mc_zj_bzj;
                                $list->left_hander = $list->order_hander + $list->sale_real_hander;//剩余数量
                                $list->order_hander += $list->sale_real_hander;//剩余数量
                                $list->mc_yk = $list->mc_yk - $list->mc_chajia;
                                $onelist = AdminMember::findOne($list->user_id);
                                $found = new AdminFund();
                                $found->user_id = $list->user_id;
                                $found->amount = '0';
                                $found->money = $onelist->money;
                                $found->order_id = $list->id;
                                $found->title = '卖出撤单不产生金额';
                                $found->created_time = time();
                                $tran = \Yii::$app->db->beginTransaction();
                                try {
                                    $list->save(false);
                                    $found->save(false);
                                    $tran->commit();
                                } catch (\Exception $e) {
                                    $tran->rollBack();
                                }
                                echo '卖出委托主动撤单完成';
                                exit;
                            }
                        }
                    }else{
                        echo '没有卖出委托的可撤单';
                        exit;
                    }
                }
            }else{
                echo '没有可撤单';
                exit;
            }
        }else{
            echo '不在时间内';
            exit;
        }
    }


    /**
     * 卖出委托单中超过15点 对其进行自动撤单
     * http://xinniuniu.cn/auto/mc-cd 网址（常杰）
     */
    public function actionMcCd()
    {
        $time1 = mktime('14', '50', '0', date('m'), date('d'), date('y'));
        $time2 = mktime('16', '0', '0', date('m'), date('d'), date('y'));
        if ($time1< time() && time() < $time2) {
            $tdx = new Tdx();
            $res = $tdx->queryData(4);//可撤单
            $rows = $res['data']['rows'];//所有的可撤单 代表依然在已报中
            $orderNo = array();
            if (!empty($rows)) {
                foreach ($rows as $list) {
                    $orderNo[] = $list['8'];//反馈的委托单号
                }
                file_put_contents('maic_kc_log.txt', date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
                if (!empty($orderNo)) {
//                    $time = time() - 60*30;
                    $order = AdminOrder::find()->where(['status' => 5])->andWhere(['in', 'mc_orderNo', $orderNo])->all();
                    if (!empty($order)) {
                        foreach ($order as $list) {
                            $stock_code = substr($list->goods_code, 2);
                            file_put_contents('12085.txt', $list->mc_orderNo . '-' . $stock_code);
                            $cdRes = $tdx->cancelOrder($list->mc_orderNo, $stock_code);
                            file_put_contents('mc_cd_jg.txt', $cdRes['success'] . '-' . $cdRes['msg'] . '单号' . $list->id . '-' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
                            if ($cdRes['success'] == 1 && $cdRes['msg'] == '撤销委托成功') {
                                $list->status = 1;//持仓中
                                $list->end_time = '';
                                $list->sale_hander -= $list->sale_real_hander;
                                $list->order_ly_money += $list->mc_ly_bzj;
                                $list->zj_bzj += $list->mc_zj_bzj;
                                $list->left_hander = $list->order_hander + $list->sale_real_hander;//剩余数量
                                $list->order_hander += $list->sale_real_hander;//剩余数量
                                $list->mc_yk = $list->mc_yk - $list->mc_chajia;
                                $onelist = AdminMember::findOne($list->user_id);
                                $found = new AdminFund();
                                $found->user_id = $list->user_id;
                                $found->amount = '0';
                                $found->money = $onelist->money;
                                $found->order_id = $list->id;
                                $found->title = '卖出撤单不产生金额';
                                $found->created_time = time();
                                $tran = \Yii::$app->db->beginTransaction();
                                try {
                                    $list->save(false);
                                    $found->save(false);
                                    $tran->commit();
                                } catch (\Exception $e) {
                                    $tran->rollBack();
                                }
                                echo '委托卖出自动撤单';
                                exit;
                            }
                        }

                    }else{
                        echo '没有委托卖出的可撤单';
                        exit;
                    }
                }
            }else{
                echo '没有可撤单';
                exit;
            }
        }else{
            echo '不在时间内';
            exit;
        }
    }






    /**
     * 主动卖出委托撤单（私盘）
     * sleep随机时间，再改变状态
     */
    public function actionMcCdselfnew()
    {
        $time = mktime('17', '0', '0', date('m'), date('d'), date('y'));
        if (time() < $time) {
                if (!empty($orderNo)) {
                    $btime = mktime(0, 0, 0, date('m'), date('d'), date('Y')); //当天所有的订单--起始时间
                    $etime = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1; //当天所有的订单--结束时间
                    $order = AdminOrder::find()->where(['status' => 10])->andWhere(['between','end_time',$btime,$etime])->all();
                    if (!empty($order)) {
                        foreach ($order as $list) {
                            $stock_code = substr($list->goods_code, 2);
                            if (1) {
                                $list->status = 1;//持仓中
                                $list->end_time = '';
                                $list->sale_hander -= $list->sale_real_hander;
                                $list->order_ly_money += $list->mc_ly_bzj;
                                $list->zj_bzj += $list->mc_zj_bzj;
                                $list->left_hander = $list->order_hander + $list->sale_real_hander;//剩余数量
                                $list->order_hander += $list->sale_real_hander;//剩余数量
                                $list->mc_yk = $list->mc_yk - $list->mc_chajia;
                                $onelist = AdminMember::findOne($list->user_id);
                                $found = new AdminFund();
                                $found->user_id = $list->user_id;
                                $found->amount = '0';
                                $found->money = $onelist->money;
                                $found->order_id = $list->id;
                                $found->title = '卖出撤单不产生金额';
                                $found->created_time = time();
                                $tran = \Yii::$app->db->beginTransaction();
                                $randtime = rand(10,6*60);
                                sleep($randtime);
                                try {
                                    $list->save(false);
                                    $found->save(false);
                                    $tran->commit();
                                } catch (\Exception $e) {
                                    $tran->rollBack();
                                }
                                echo '卖出委托主动撤单完成';
                                exit;
                            }
                        }
                    }else{
                        echo '没有卖出委托的可撤单';
                        exit;
                    }
                }
                }


}
}
