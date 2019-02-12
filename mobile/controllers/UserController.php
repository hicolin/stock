<?php
/**
 * User: Colin
 * Time: 2019/1/21 15:55
 */

namespace mobile\controllers;

use backend\models\AdminCharge;
use backend\models\AdminFund;
use backend\models\AdminMember;
use backend\models\AdminTixian;
use Yii;

class UserController extends BaseController
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

    public function actionCertificate()
    {
        $this->getView()->title = '实名认证';
        $member = AdminMember::findOne($this->userId);
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($member->state == 1) {
                return $this->json(100, '您已经认证过了，无需重复认证');
            }
//            $res = Helper::bankcard($post['bankTel'], $post['bankNo'],$post['idCard'],$post['name']);
            $res['status'] = 200;
            if ($res['status'] != 200) {
                return $this->json(100, $res['msg']);
            }
            $res = $member->certificate($post['name'], $post['idCard'], $post['bankTel'], $post['bank'], $post['bankNo'],
                $post['area'], $post['branch']);
            if ($res['status'] != 200) {
                return $this->json(100, $res['msg']);
            }
            return $this->json(200, '认证成功');
        }
        return $this->render('certificate',compact('member'));
    }

    public function actionRecharge()
    {
        $this->getView()->title = '充值';
        $feeRate = Helper::getSysInfo(37);
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $money = (int)$post['money'];
            $member = AdminMember::findOne($this->userId);
            $charge = new AdminCharge();
            $orderSid = Helper::getOrderNo();
            $feeMoney = $money * ($feeRate / 100);
            $charge->createOrder($this->userId, $orderSid, $money, $feeMoney, $post['type']);
            return Helper::pexPay($post['type'], $money, $member->realname, $orderSid);
        }
        return $this->render('recharge', compact('feeRate'));
    }

    public function actionWithdraw()
    {
        $this->getView()->title = '提现';
        $member = AdminMember::findOne($this->userId);
        $withdrawFee = Helper::getSysInfo(26);
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $money = (int)$post['money'];
            if (!$member->cartid) {
                return $this->json(100, '您还没有实名认证，请先实名认证');
            }
            if ($money <= 0) {
                return $this->json(100, '提现金额不正确');
            }
            if ($money > $member->money) {
                return $this->json(100, '提现金额不能大于账户余额');
            }
            $res = Yii::$app->security->validatePassword($post['pwd'], $member->tx_pwd);
            if (!$res) {
                return $this->json(100, '提现密码不正确');
            }
            $trans = Yii::$app->db->beginTransaction();
            try{
                $member->money -= $money;
                $withdraw = new AdminTixian();
                $orderNo = Helper::getOrderNo();
                $withdraw->writeWithdraw($this->userId, $money, $withdrawFee, $orderNo);
                $fund = new AdminFund();
                $title = "提现（手续费 {$withdrawFee} 元）";
                $fund->writeFund($this->userId, $orderNo, $money, $title, 2, $member->money);
                $member->save(false);
                $trans->commit();
                return $this->json(200, '提现申请成功，等待审核中...');
            }catch (\Exception $e){
                $trans->rollBack();
                return $this->json(100, '提现申请失败');
            }
        }
        return $this->render('withdraw', compact('member', 'withdrawFee'));
    }

    public function actionChangeLoginPwd()
    {
        $this->getView()->title = '修改登录密码';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $member = AdminMember::findOne($this->userId);
            $res = Yii::$app->security->validatePassword($post['oldPwd'],$member->userspwd);
            if (!$res) {
                return $this->json(100, '旧密码不正确');
            }
            if ($post['pwd'] != $post['rePwd']) {
                return $this->json(100, '新密码与确认密码不一致');
            }
            $pwd = Yii::$app->security->generatePasswordHash($post['pwd']);
            $member->userspwd = $pwd;
            if (!$member->save(false)) {
                return $this->json(100, '修改失败');
            }
            return $this->json(200, '修改成功');
        }
        return $this->render('change-login-pwd');
    }

    public function actionChangeMoneyPwd()
    {
        $this->getView()->title = '修改资金密码';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $member = AdminMember::findOne($this->userId);
            if ($post['pwd'] != $post['rePwd']) {
                return $this->json(100, '新密码与确认密码不一致');
            }
            $pwd = Yii::$app->security->generatePasswordHash($post['pwd']);
            $member->tx_pwd = $pwd;
            if (!$member->save(false)) {
                return $this->json(100, '修改失败');
            }
            return $this->json(200, '修改成功');
        }
        return $this->render('change-money-pwd');
    }

    public function actionLogout()
    {
        Yii::$app->session->remove('isLogin');
        Yii::$app->session->remove('userId');
        return $this->redirect(['index/user']);
    }




}