<?php

namespace backend\controllers;

use backend\models\AdminChargexx;
use backend\models\AdminCommissionCharge;
use backend\models\AdminRegions;
use backend\models\AdminUserpeoduct;
use Yii;
use yii\web\Controller;
use backend\models\AdminUser;
use backend\models\AdminMember;
use backend\models\AdminCharge;
use backend\models\AdminOrder;
use backend\models\BackendUser;
use backend\models\AdminUserRole;
use common\utils\CommonFun;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    public $layout = "lte_main";

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->layout = "lte_main_login";
            return $this->render('login');
        } else {
            $admin_id = yii::$app->session['__id'];
            //根据管理员id判断管理员的角色，超级管理员role_id为1
            $role_id = AdminUserRole::findOne(['user_id' => yii::$app->session['__id']])->role_id;
            $admin_user = AdminUser::findOne(['id' => yii::$app->session['__id']]);
            $url = "http://www.xinniuniu.cn/index/register?vatation_code2=" . $admin_user->vatation_code;
            $menus = Yii::$app->user->identity->getSystemMenus();
            $sysInfo = [
                ['name' => '操作系统', 'value' => php_uname('s')],  //'value'=>php_uname('s').' '.php_uname('r').' '.php_uname('v')],
                ['name' => 'PHP版本', 'value' => phpversion()],
                ['name' => 'Yii版本', 'value' => Yii::getVersion()],
                ['name' => '数据库', 'value' => $this->getDbVersion()],
                ['name' => 'AdminLTE', 'value' => 'V2.3.6'],
            ];
            $model = AdminUserpeoduct::findOne(['uid' => $admin_id]);
            if ($model->bank_province && $model->bank_city) {
                $bank_address = AdminRegions::findOne(['id' => $model->bank_province])->name . AdminRegions::findOne(['id' => $model->bank_city])->name . $model->bank_address;
            } else {
                $bank_address = '';
            }
            $model_money = AdminCommissionCharge::find()->where(['uid'=>$admin_id])->select('sum(money) as money')->asArray()->one();
            $count_orders = AdminOrder::find()->count();
            $count_members = AdminMember::find()->count();
            $sum_charge = AdminCharge::find()->where(['state' => 1])->sum('money');
            $sum_chargexx = AdminChargexx::find()->where(['state' => 1])->sum('money');
            $sum_charge = $sum_chargexx+$sum_charge;
            $sum_daili = AdminUserpeoduct::find()->count();
            // var_dump($sum_deposit);exit;
            $count_members = AdminMember::find()->count();


            //四天前注册人数
            $timestart4 = strtotime(date('Y-m-d' . '00:00:00', time() - 3600 * 24 * 4));
            $timeend4 = strtotime(date('Y-m-d' . '00:00:00', time() - 3600 * 24 * 3));
            $map4 = array("$timestart4", "$timeend4");
            // var_dump($map4);exit;

            //三天前注册人数
            $timestart3 = strtotime(date('Y-m-d' . '00:00:00', time() - 3600 * 24 * 3));
            $timeend3 = strtotime(date('Y-m-d' . '00:00:00', time() - 3600 * 24 * 2));
            $map3 = array("$timestart3", "$timeend3");


            //两天前注册人数
            $timestart2 = strtotime(date('Y-m-d' . '00:00:00', time() - 3600 * 24 * 2));
            $timeend2 = strtotime(date('Y-m-d' . '00:00:00', time() - 3600 * 24));
            $map2 = array("$timestart2", "$timeend2");


            //昨天前注册人数
            $timestart1 = strtotime(date('Y-m-d' . '00:00:00', time() - 3600 * 24));
            $timeend1 = strtotime(date('Y-m-d' . '00:00:00', time()));
            $map1 = array("$timestart1", "$timeend1");


            //今天注册人数
            $timestart = strtotime(date('Y-m-d' . '00:00:00', time()));
            $timeend = strtotime(date('Y-m-d' . '00:00:00', time() + 3600 * 24));
            $map = array("$timestart", "$timeend");


            $member_count[] = AdminMember::find()->where(['between', 'dates', $map4[0], $map4[1]])->count();
            $member_count[] = AdminMember::find()->where(['between', 'dates', $map3[0], $map3[1]])->count();
            $member_count[] = AdminMember::find()->where(['between', 'dates', $map2[0], $map2[1]])->count();
            $member_count[] = AdminMember::find()->where(['between', 'dates', $map1[0], $map1[1]])->count();
            $member_count[] = AdminMember::find()->where(['between', 'dates', $map[0], $map[1]])->count();
            $order_count[] = AdminOrder::find()->where(['between', 'created_time', $map4[0], $map4[1]])->count();
            $order_count[] = AdminOrder::find()->where(['between', 'created_time', $map3[0], $map3[1]])->count();
            $order_count[] = AdminOrder::find()->where(['between', 'created_time', $map2[0], $map2[1]])->count();
            $order_count[] = AdminOrder::find()->where(['between', 'created_time', $map1[0], $map1[1]])->count();
            $order_count[] = AdminOrder::find()->where(['between', 'created_time', $map[0], $map[1]])->count();

            return $this->render('index', [
                'system_menus' => $menus,
                'sysInfo' => $sysInfo,
                'role_id' => $role_id,
                'member_count' => $member_count,
                'order_count' => $order_count,
                'count_orders' => $count_orders,
                'count_members' => $count_members,
                'sum_charge' => $sum_charge,
                'sum_daili' => $sum_daili,
                'model' => $model,
                'adminUser' => $admin_user,
                'bank_address' => $bank_address,
                'url' => $url,
                'fy_id' => $admin_id,
                'model_money' => $model_money,
                'code' => $admin_user->vatation_code,
            ]);
        }
    }

    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $rememberMe = Yii::$app->request->post('remember');
        $rememberMe = $rememberMe == 'y' ? true : false;
        if (AdminUser::login($username, $password, $rememberMe) == true) {
            AdminUser::updateAll(
                ['last_ip' => CommonFun::getClientIp()],
                ['uname' => $username]
            );
            //return $this->goBack();
            echo json_encode(['errno' => 0]);
        } else {
            echo json_encode(['errno' => 2]);
        }

    }

    public function actionTest($nid)
    {
        $day = Yii::$app->request->post('nid');

        var_dump($day);
        exit;

    }


    /**
     * 订单 图表 数据
     */
    public function actionOrderCount()
    {
        echo 222;
        exit;
        $type = Yii::$app->request->post('date');
        $order = new AdminOrder();
        $data = array();
        if ($type == 1) {
            list ($start, $end) = Time::today();
            for ($i = 0; $i < 24; $i++) {
                $date_start = date("Y-m-d H:i:s", $start + 3600 * $i);
                $date_end = date("Y-m-d H:i:s", $start + 3600 * ($i + 1));
                $count = $order->getOrderCount([
                    'shop_id' => $this->instance_id,
                    'create_time' => [
                        'between',
                        [
                            getTimeTurnTimeStamp($date_start),
                            getTimeTurnTimeStamp($date_end)
                        ]
                    ]
                ]);
                $data[$i] = array(
                    $i . ':00',
                    $count
                );
            }
        } elseif ($type == 2) {
            list ($start, $end) = Time::yesterday();
            for ($j = 0; $j < 24; $j++) {
                $date_start = date("Y-m-d H:i:s", $start + 3600 * $j);
                $date_end = date("Y-m-d H:i:s", $start + 3600 * ($j + 1));
                $count = $order->getOrderCount([
                    'shop_id' => $this->instance_id,
                    'create_time' => [
                        'between',
                        [
                            getTimeTurnTimeStamp($date_start),
                            getTimeTurnTimeStamp($date_end)
                        ]
                    ]
                ]);
                $data[$j] = array(
                    $j . ':00',
                    $count
                );
            }
        } elseif ($type == 3) {
            list ($start, $end) = Time::week();
            $start = $start - 604800;
            for ($j = 0; $j < 7; $j++) {
                $date_start = date("Y-m-d H:i:s", $start + 86400 * $j);
                $date_end = date("Y-m-d H:i:s", $start + 86400 * ($j + 1));
                $count = $order->getOrderCount([
                    'shop_id' => $this->instance_id,
                    'create_time' => [
                        'between',
                        [
                            getTimeTurnTimeStamp($date_start),
                            getTimeTurnTimeStamp($date_end)
                        ]
                    ]
                ]);
                $data[$j] = array(
                    '星期' . ($j + 1),
                    $count
                );
            }
        } elseif ($type == 4) {
            list ($start, $end) = Time::month();
            for ($j = 0; $j < ($end + 1 - $start) / 86400; $j++) {
                $date_start = date("Y-m-d H:i:s", $start + 86400 * $j);
                $date_end = date("Y-m-d H:i:s", $start + 86400 * ($j + 1));
                $count = $order->getOrderCount([
                    'shop_id' => $this->instance_id,
                    'create_time' => [
                        'between',
                        [
                            getTimeTurnTimeStamp($date_start),
                            getTimeTurnTimeStamp($date_end)
                        ]
                    ]
                ]);
                $data[$j] = array(
                    (1 + $j) . '日',
                    $count
                );
            }
        }
        return $data;
    }


    public function actionGetMemberCount()
    {
        $start = strtotime(date('Y-m-d 00:00:00'));
        $end = strtotime(date('Y-m-d H:i:s'));
        $mem_condition['reg_time'] = [
            'between',
            [
                $start,
                $end
            ]
        ];
        $count = AdminMember::find()->where($mem_condition)->count();
        return $count;
    }

    public function actionLogout()
    {
        Yii::$app->user->identity->clearUserSession();
        Yii::$app->user->logout();
        return $this->render('login');
    }

    public function actionPsw()
    {
        $userRole = AdminUserRole::find()->with('role')->andWhere(['user_id' => Yii::$app->user->identity->id])->one();
        return $this->render('psw', [
            'user_role' => $userRole->role->name
        ]);
    }

    public function actionPswSave()
    {
        $old_password = Yii::$app->request->post('old_password', '');
        $new_password = Yii::$app->request->post('new_password', '');
        $confirm_password = Yii::$app->request->post('confirm_password', '');
        if (empty($old_password) == true) {
            $msg = array('error' => 2, 'data' => array('old_password' => '旧密码不正确'));
            echo json_encode($msg);
            exit();
        }
        if (empty($new_password) == true) {
            $msg = array('error' => 2, 'data' => array('new_password' => '新密码不能为空'));
            echo json_encode($msg);
            exit();
        }
        if (empty($confirm_password) == true) {
            $msg = array('error' => 2, 'data' => array('confirm_password' => '确认密码不能为空'));
            echo json_encode($msg);
            exit();
        }
        if ($new_password != $confirm_password) {
            $msg = array('error' => 2, 'data' => array('confirm_password' => '两次新密码不相同'));
            echo json_encode($msg);
            exit();
        }
        if (Yii::$app->user->isGuest == false) {
            $user = AdminUser::findByUsername(Yii::$app->user->identity->uname);
            if (BackendUser::validatePassword($user, $old_password) == true) {
                $user->password = Yii::$app->security->generatePasswordHash($new_password);
                $user->save();
                $msg = array('errno' => 0, 'msg' => '保存成功');
                echo json_encode($msg);
            } else {
                $msg = array('errno' => 2, 'data' => array('old_password' => '旧密码不正确'));
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno' => 2, 'msg' => '请先登录');
            echo json_encode($msg);
        }
    }

    private function getDbVersion()
    {
        $driverName = Yii::$app->db->driverName;
        if (strpos($driverName, 'mysql') !== false) {
            $v = Yii::$app->db->createCommand('SELECT VERSION() AS v')->queryOne();
            $driverName = $driverName . '_' . $v['v'];
        }
        return $driverName;
    }

    public function actionWithdraw()
    {
        if(Yii::$app->request->isAjax){
            $money = Yii::$app->request->post('money');
            $uid = Yii::$app->session['__id'];
            $withdraw = new AdminCommissionCharge();
            $withdraw->uid = $uid;
            $withdraw->money = $money;
            $withdraw->create_time = time();
            $user = AdminUserpeoduct::findOne(['uid'=>$uid]);
            $user->commission_member -= $money;
            $tran = Yii::$app->db->beginTransaction();
            try{
                $user->save();
                $withdraw->save();
                $tran->commit();
                $msg = array('status' =>'y', 'msg' => '提现成功');
                return json_encode($msg);
            }catch (\Exception $e){
                $tran->rollBack();
                $msg = array('status' =>'n', 'msg' => '提现失败');
                return json_encode($msg);
            }
        }
    }

    /**
     * 全局错误处理
     */
    public function actionError()
    {
        $exception = Yii::$app->getErrorHandler()->exception;
        $statusCode = $exception->statusCode;
//         return $this->render('error', ['name' => $statusCode, 'message'=>$exception->__toString()]);
        return $this->render('error', ['name' => $statusCode, 'message' => "系统出错，具体错误信息请查看runtime\logs\app.log"]);

    }
}
