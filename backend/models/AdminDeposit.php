<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%deposit}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property double $money
 * @property double $charge
 * @property integer $time
 * @property integer $type
 */
class AdminDeposit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%deposit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'time', 'type'], 'integer'],
            [['money', 'charge'], 'number'],
            [['time'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '用户名',
            'money' => '金额（￥）',
            'charge' => 'Charge',
            'time' => '交易时间',
            'type' => '类型',
        ];
    }
    //获取会员
    public function getMember()
    {
        return $this->hasOne(AdminMember::className(), ['id'=>'uid']);
    }
}
