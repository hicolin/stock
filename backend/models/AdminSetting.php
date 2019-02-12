<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_setting".
 *
 * @property integer $id
 * @property string $key
 * @property string $val
 */
class AdminSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'string', 'max' => 30],
            [['val'], 'string', 'max' => 100],
            [['type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => '配置名',
            'val' => '配置值',
            'type' => '类型',
        ];
    }
}
