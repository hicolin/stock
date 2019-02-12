<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_moneylog".
 *
 * @property integer $id
 * @property integer $users_id
 * @property double $money
 * @property double $money_left
 * @property double $money_freeze
 * @property integer $typer
 * @property integer $dates
 * @property string $ip
 * @property string $info
 * @property integer $caopan_id
 */
class AdminMoneylog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_moneylog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'typer', 'dates', 'caopan_id'], 'integer'],
            [['money', 'money_left', 'money_freeze'], 'number'],
            [['dates', 'ip', 'info'], 'required'],
            [['ip'], 'string', 'max' => 20],
            [['info'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => '会员账户',
            'money' => '影响金额',
            'money_left' => '可用金额',
            'money_freeze' => '待收金额',
            'typer' => '交易类型',
            'dates' => '时间',
            'ip' => 'ip地址',
            'info' => '备注',
            'caopan_id' => '操盘',
        ];
    }
    //获取会员
    public function getMember()
    {
        return $this->hasOne(AdminMember::className(), ['id'=>'users_id']);
    }

}
