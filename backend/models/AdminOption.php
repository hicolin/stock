<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%option}}".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property integer $user_id
 */
class AdminOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%option}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'Goods ID',
            'user_id' => 'User ID',
        ];
    }
}
