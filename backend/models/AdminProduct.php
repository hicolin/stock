<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_product".
 *
 * @property integer $id
 * @property string $code
 * @property integer $in_time
 * @property integer $cat_id
 * @property string $title
 */
class AdminProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_time', 'cat_id'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '代码',
            'do_time' => '可操盘时间',
            'in_time' => '成立时间',
            'cat_id' => '分类',
            'title' => '标题',
        ];
    }


    //获取分类
    public function getCat()
    {
        return $this->hasOne(AdminCat::className(), ['id'=>'cat_id']);
    }
}
