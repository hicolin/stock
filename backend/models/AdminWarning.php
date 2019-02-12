<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%warning}}".
 *
 * @property integer $id
 * @property integer $stocks_id
 * @property string $stocks_name
 * @property string $stocks_code
 * @property integer $user_id
 * @property integer $value
 * @property integer $state
 */
class AdminWarning extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warning}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stocks_id', 'user_id', 'value', 'state'], 'integer'],
            [['stocks_code', 'state'], 'required'],
            [['stocks_name'], 'string', 'max' => 255],
            [['stocks_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stocks_id' => 'Stocks ID',
            'stocks_name' => 'Stocks Name',
            'stocks_code' => 'Stocks Code',
            'user_id' => 'User ID',
            'value' => 'Value',
            'state' => 'State',
        ];
    }
}
