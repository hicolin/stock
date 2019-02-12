<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_chargexx".
 *
 * @property integer $id
 * @property integer $users_id
 * @property double $money
 * @property string $title
 * @property integer $dates
 * @property string $pay_ordersid
 * @property string $ip
 * @property string $pay_type
 * @property integer $state
 * @property string $img_url
 */
class AdminChargexx extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_chargexx';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'dates', 'state','money'], 'integer'],
//            [['title', 'dates', 'pay_ordersid', 'ip', 'pay_type', 'state', 'img_url'], 'required'],
            [['title', 'pay_ordersid', 'ip'], 'string', 'max' => 50],
            [['pay_type'], 'string', 'max' => 100],
            [['img_url'], 'string', 'max' => 200],
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
            'title' => '备注',
            'dates' => '充值时间',
            'pay_ordersid' => '流水号',
            'ip' => 'ip地址',
            'pay_type' => '支付方式',
            'state' => '状态',
            'img_url' => '打款凭证',
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
}
