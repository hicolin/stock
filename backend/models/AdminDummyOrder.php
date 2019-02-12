<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_dummy_order".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $money
 * @property integer $profit
 * @property string $profit_money
 * @property integer $add_time
 * @property integer $update_time
 */
class AdminDummyOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_dummy_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money', 'profit_money'], 'number'],
            [['add_time', 'update_time'], 'integer'],
            [['user_name'], 'string', 'max' => 50],
            [['profit'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => '用户名',
            'money' => '操盘金额',
            'profit' => '获利百分比',
            'profit_money' => '盈利金额',
            'add_time' => '添加时间',
            'update_time' => '更新时间',
        ];
    }
}
