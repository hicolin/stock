<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_content".
 *
 * @property integer $id
 * @property string $title
 * @property string $keyword
 * @property string $describe
 * @property string $contact
 * @property string $img
 * @property integer $top
 * @property integer $recommend
 * @property integer $sortid
 * @property string $addtime
 * @property integer $views
 * @property string $author
 * @property integer $sorting
 */
class AdminContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact'], 'string'],
            [['top', 'recommend', 'sortid', 'sorting'], 'integer'],
            [['title', 'keyword', 'describe', 'img', 'author'], 'string', 'max' => 255],
            [['addtime'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'keyword' => '关键字',
            'describe' => '描述',
            'contact' => '内容',
            'img' => '缩略图',
            'top' => '是否置顶',
            'recommend' => '推荐',
            'sortid' => '分类',
            'addtime' => '添加时间',
            'views' => '查看次数',
            'author' => '作者',
            'sorting' => '排序',
        ];
    }


    //判断
    public static function dropDownList($column,$value=null)
    {
        $dropDownList=[
            'is_judge'=>[1=>'是',0=>'否'],
        ];
        if ($value !== null)
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        //返回关联数组，用户下拉的filter实现
        else
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
    }
}
