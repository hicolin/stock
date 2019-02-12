<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $file_id
 * @property string $file_name
 * @property string $file_desc
 * @property string $file_path
 * @property string $file_cover
 * @property integer $sort
 * @property integer $addtime
 */
class AdminFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'file_path'], 'required'],
            [['file_desc','file_cover','sort','addtime','updatetime'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'ID',
            'file_name' => '软件名称',
            'file_desc' => '软件描述',
            'file_path' => '文件路径',
            'file_cover' => '软件封面',
            'sort' => '排序',
            'addtime' => '添加时间',
            'updatetime' => '更新时间',
        ];
    }
}
