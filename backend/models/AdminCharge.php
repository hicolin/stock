<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_charge".
 *
 * @property integer $id
 * @property integer $users_id
 * @property double $money
 * @property double $fee_money
 * @property string $title
 * @property integer $dates
 * @property string $pay_ordersid
 * @property integer $ip
 * @property integer $pay_type
 * @property integer $state
 * @property integer $status
 * @property integer $order_no
 */
class AdminCharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'money', 'title', 'dates', 'pay_ordersid', 'ip'], 'required'],
            [['users_id', 'dates', 'state', 'status'], 'integer'],
            [['money'], 'number'],
            [['title','ip', 'pay_type',], 'string', 'max' => 50],
            [['pay_ordersid'], 'string', 'max' => 30],
            [['order_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => '会员账号',
            'money' => '金额',
            'fee_money' => '手续费',
            'title' => '备注',
            'dates' => '充值时间',
            'pay_ordersid' => '流水号',
            'ip' => 'ip地址',
            'pay_type' => '支付方式',
            'state' => '状态',
            'order_no' => '支付单号',
        ];
    }

    //获取会员
    public function getMember()
    {
        return $this->hasOne(AdminMember::className(), ['id'=>'users_id']);
    }
        //获取支付名
    public function getPayname()
    {
        return $this->hasOne(AdminPayType::className(), ['id'=>'pay_type']);
    }

    /**
     * 创建订单
     * @param $userId
     * @param $orderSid
     * @param $money
     * @param $feeMoney
     * @param $payType
     */
    public function createOrder($userId, $orderSid, $money, $feeMoney, $payType)
    {
        $this->users_id = $userId;
        $this->money = $money;
        $this->fee_money = $feeMoney;
        $this->title = '充值';
        $this->dates = time();
        $this->pay_ordersid = $orderSid;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->pay_type = $payType;
        $this->state = 2; // 先设置为支付失败状态
        $this->save(false);
    }

}
