<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_sort".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property integer $level
 * @property integer $addtime
 */
class AdminSort extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_sort';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'level', 'addtime'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'pid' => '父id',
            'level' => '等级',
            'addtime' => '添加时间',
        ];
    }


    public function getCategories()
    {
        $data = self::find()->all();
        return $data;
    }

    /**
     *遍历出各个子类 获得树状结构的数组
     */
    public static function getTree($data,$pid = 0,$lev = 0)
    {
        $tree = [];
        foreach($data as $value){
            if($value['pid'] == $pid){
                //$value['name'] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$lev).$value['name'];
                $tree[] = $value;
                $tree = array_merge($tree,self::getTree($data,$value['id'],$lev+1));
            }
        }
        return $tree;
    }
    public static function getTree2($data,$pid = 0,$lev = 0)
    {
        $tree = [];
        foreach($data as $value){
            if($value['pid'] == $pid){
                $value['name'] = str_repeat('|___',$lev).$value['name'];
                $value['level']=$lev;
                $tree[] = $value;
                $tree = array_merge($tree,self::getTree2($data,$value['id'],$lev+1));
            }
        }
        return $tree;
    }
    /**
     * 得到相应  id  对应的  分类名  数组
     */
    public function getOptions()
    {
        $data = $this->getCategories();
        $tree = $this->getTree($data);
        $list = ['添加顶级分类'];
        foreach($tree as $value){
            $list[$value['id']] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$value['level']).$value['name'];
        }
        return $list;
    }

    public function getOptions2()
    {
        $data = $this->getCategories();
        $tree = $this->getTree($data);
        /*$list = ['添加顶级分类'];
        foreach($tree as $value){
            $list[$value['id']] = $value['name'];
        }*/
        return $tree;
    }
    public function getOptions4()
    {
        $data = $this->getCategories();
        $tree = $this->getTree2($data);
        return $tree;
    }
    public function getOptions3()
    {
        $data = $this->getCategories();
        $tree = $this->getTree($data);
        $list = ['请选择'];
        foreach($tree as $value){
            $list[$value['id']] = str_repeat("　",$value['level']).$value['name'];
        }
        return $list;
    }
    /*
     *查找指定分类的所有上级分类名称（包含本身）
     */
    public function getParentCat($id)
    {
        $model=new self;
        $str="";
        $son=$model->find()->where(array('id'=>$id))->one();
        if($son!=null){
            $str=$son['name'];
            if($son['pid']>0){
                $parent = $this->getParentCat($son['pid']);
                if(isset($parent)){
                    $str.=','.$parent;
                }
            }
        }
        return $str;
    }

    //根据分类id获取名称
    static function sort_name($id){
        $model=new self;
        $sort=$model->find()->where(array('id'=>$id))->one();
        return $sort->name;
    }

    /*
     *将获取到的分类从上到下排序
     */
    public function sortCat($id)
    {
        $str=$this->getParentCat($id);
        $arr=explode(',',$str);
        rsort($arr);
        return implode("&nbsp;&nbsp;",$arr);
    }
    /*
     *查找指定分类的所有子集分类id（包含本身）
     */
    public function getSonCat($id)
    {
        $model=new self;
        $sids="";
        $cat=$model->find()->where(array('id'=>$id))->one();
        $son=$model->find()->where(array('pid'=>$id))->all();
        $sids=$cat['id'];
        if($son!=null){
            foreach($son as $v){
                $sons = $this->getSonCat($v['id']);
                if(isset($sons)){
                    $sids.=','.$sons;
                }
            }
        }
        return $sids;
    }

}
