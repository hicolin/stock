<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%slide_cat}}".
 *
 * @property integer $cid
 * @property string $cat_name
 * @property string $cat_idname
 * @property string $cat_remark
 * @property integer $cat_status
 */
class AdminSlideCats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slide_cat}}';
    }

    public static function dropDownList($column,$value=null)
    {
         $dropDownList=[
            'is_show'=>[1=>'显示',0=>'隐藏'],
        ];
        if ($value !== null)
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        //返回关联数组，用户下拉的filter实现
        else
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name', 'cat_idname'], 'required'],
            [['cat_remark'], 'string'],
            [['cat_status'], 'integer'],
            [['cat_name', 'cat_idname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => '编号',
            'cat_name' => '分类名称',
            'cat_idname' => '分类标识',
            'cat_remark' => '分类备注',
            'cat_status' => '状态',
        ];
    }
}
