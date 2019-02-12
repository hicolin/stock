<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%fund}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property integer $type
 * @property string $amount
 * @property string $money
 * @property string $title
 * @property integer $created_time
 */
class AdminFund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fund}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id','created_time','type'], 'integer'],
            [['amount','money'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['order_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'order_id' => '订单ID',
            'amount' => '金额',
            'title' => '备注',
            'money' => '账户余额',
            'created_time' => '时间',
        ];
    }

    public function getMember()
    {
        return $this->hasOne(AdminMember::className(),['id'=>'user_id']);
    }

    public function writeFund($userId, $orderId, $amount, $title, $type, $money)
    {
        $this->user_id = $userId;
        $this->order_id = $orderId;
        $this->amount = $amount;
        $this->title = $title;
        $this->type = $type;
        $this->money = $money;
        $this->created_time = time();
        $this->save(false);
    }


}
