<?php
/**
 * User: Colin
 * Time: 2019/1/25 11:09
 */

namespace frontend\controllers;

use backend\models\AdminCharge;
use backend\models\AdminFund;
use backend\models\AdminMember;
use yii\web\Controller;
use Yii;

class MobilePayController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionPexBackUrl()
    {
        $post = Yii::$app->request->post();
        $tokenKey = Yii::$app->params['pexPay']['tokenKey'];
        $sign = md5($post['orderno'] . $post['orderamount'] . $post['payamount'] . $post['confirmpaytime']
            . $post['safetycode'] . $tokenKey);
        if ($sign == $post['sign'] && $post['status'] == 1) {  // 验签通过且支付成功
            $charge = AdminCharge::findOne(['pay_ordersid' => $post['orderno']]);
            $member = AdminMember::findOne($charge->users_id);
            if ($charge && $charge->state == 2) {  // 未支付状态下
                $trans = Yii::$app->db->beginTransaction();
                try{
                    $member->money += $charge->money;
                    $charge->state = 1; // 支付成功
                    $charge->save(false);
                    $member->save(false);
                    $fund = new AdminFund();
                    $title = "充值（手续费 {$charge->fee_money} 元）";
                    $fund->writeFund($charge->users_id, $charge->pay_ordersid, $charge->money, $title,1,
                        $member->money);
                    $trans->commit();
                }catch (\Exception $e){
                    $trans->rollBack();
                }
            }
        }
        return json_encode(['reason' => 'success']);
    }
}