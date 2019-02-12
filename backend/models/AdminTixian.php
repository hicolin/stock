<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_tixian".
 *
 * @property integer $id
 * @property integer $users_id
 * @property integer $money
 * @property integer $z_money
 * @property integer $k_money
 * @property integer $service_money
 * @property string $title
 * @property integer $dates
 * @property string $ip
 * @property string $order_id
 * @property integer $bank_id
 * @property string $bank_code
 * @property integer $state
 */
class AdminTixian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_tixian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'money', 'title', 'dates', 'ip','bank_code'], 'required'],
            [['users_id', 'dates', 'state','service_money','service_money'], 'integer'],
            [['title', 'bank_code','province','city','tel','name', 'order_id'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 15],
            [['reason'], 'string', 'max' => 20],
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
            'money' => '提现金额',
            'z_money' => '提现当前权益',
            'k_money' => '提现可用资金',
            'title' => '备注',
            'dates' => '申请时间',
            'ip' => 'ip地址',
            'bank_id' => '银行',
            'bank_code' => '卡号',
            'state' => '状态',
            'service_money' => '手续费',
            'province' => '省',
            'city' => '市',
            'tel' => '手机号',
            'name' => '收款人姓名',
        ];
    }
    //获取会员
    public function getMember()
    {
        return $this->hasOne(AdminMember::className(), ['id' => 'users_id']);
    }

    public function writeWithdraw($userId, $money, $fee, $orderNo)
    {
        $this->users_id = $userId;
        $this->money = $money;
        $this->service_money = $fee;
        $this->order_id = $orderNo;
        $this->dates = time();
        $this->save(false);
    }
}
