<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_links".
 *
 * @property integer $id
 * @property string $link_url
 * @property string $link_name
 * @property string $link_image
 * @property integer $link_status
 * @property integer $link_type
 */
class AdminLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_status', 'link_type'], 'integer'],
            [['link_url', 'link_image'], 'string', 'max' => 255],
            [['link_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_url' => '链接地址',
            'link_name' => '名称',
            'link_image' => '图片',
            'link_status' => '状态',
            'link_type' => '类别',
        ];
    }
}
