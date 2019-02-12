<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_add_bond".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property string $deposit_amout
 * @property string $description
 * @property integer $status
 * @property integer $created_time
 */
class AdminAddBond extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_add_bond';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'status', 'created_time'], 'integer'],
            [['deposit_amout'], 'number'],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户',
            'order_id' => '订单编号',
            'deposit_amout' => '追加金额',
            'description' => '描述',
            'status' => '状态',
            'created_time' => '创建时间',
        ];
    }

    //获取会员
    public function getMember()
    {
        return $this->hasOne(AdminMember::className(), ['id'=>'user_id']);
    }

    //获取订单
    public function getOrder()
    {
        return $this->hasOne(AdminOrder::className(), ['order_id'=>'order_id']);
    }
}
