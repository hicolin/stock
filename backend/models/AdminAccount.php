<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_setting".
 *
 * @property integer $id
 * @property string $account
 * @property string $pass
 * @property integer $created_time
 */
class AdminAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account','pass'], 'string', 'max' => 50],
            [['created_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => '账号',
            'pass' => '密码',
            'created_time' => '添加时间',
        ];
    }
}
