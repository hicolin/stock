<?php

namespace backend\models;

use Yii;
use backend\models\AdminSlideCats;
/**
 * This is the model class for table "{{%slide}}".
 *
 * @property string $slide_id
 * @property integer $slide_cid
 * @property string $slide_name
 * @property string $slide_pic
 * @property string $slide_url
 * @property string $slide_des
 * @property string $slide_content
 * @property integer $slide_status
 * @property integer $listorder
 */
class AdminSlides extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slide}}';
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

    public static function slideCat()
    {
        $list=AdminSlideCats::find()->where(array('cat_status'=>1))->all();
        $slidelist=array();
        foreach($list as $item){
           $arr=$item->attributes;
           $slidelist[$arr['cid']]=$arr['cat_name'];
        }
        return $slidelist;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slide_cid', 'slide_name'], 'required'],
            [['slide_pic','slide_url','slide_des','slide_content','slide_status','listorder'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slide_id' => '编号',
            'slide_cid' => '分类ID',
            'slide_name' => '标题',
            'slide_pic' => 'banner图',
            'slide_url' => '链接',
            'slide_des' => '描述',
            'slide_content' => '幻灯片内容',
            'slide_status' => '状态',
            'listorder' => '排序',
        ];
    }

    public static function getBanner($cid=1)
    {
        $banner=new self;
        $banners=$banner->find()->where(array('slide_status'=>1,'slide_cid'=>$cid))->orderBy("listorder ASC")->all();
        return $banners;
    }

}
