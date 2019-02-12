<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_charge".
 *
 * @property integer $id
 * @property integer $uid
 * @property double $money

 * @property integer $create_time


 * @property integer $type

 * @property integer $order_sn
 */
class AdminCommission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_commission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'create_time', 'type'], 'integer'],
            [['money'], 'number'],
            [['order_sn'], 'string', 'max' => 32],
        ];
    }
    public function getInfo()
    {
        return $this->hasOne(AdminUser::className(),['id'=>'uid']);
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

}
