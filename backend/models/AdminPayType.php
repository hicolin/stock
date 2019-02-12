<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%pay_type}}".
 *
 * @property integer $id
 * @property string $pay_name
 * @property integer $type
 * @property integer $created_time
 * @property integer $status
 */
class AdminPayType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pay_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'created_time', 'status'], 'integer'],
            [['pay_name'], 'string', 'max' => 50],
            [['setting'], 'string', 'max' => 250],
        ];
    }
      //判断
    public static function dropDownList($column,$value=null)
    {
        $dropDownList=[
            'type'=>[1=>'第三方支付',2=>'网银支付'],
            'status'=>[1=>'开启',2=>'关闭'],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pay_name' => '支付名称',
            'type' => '支付类型',
            'setting' =>'配置',
            'created_time' => '创建时间',
            'status' => '状态',
        ];
    }
}
