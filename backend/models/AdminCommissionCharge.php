<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_commission_charge".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $money
 * @property string $flow_count
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $state
 */
class AdminCommissionCharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_commission_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'create_time', 'update_time', 'state'], 'integer'],
            [['money'], 'number'],
            [['flow_count'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '代理',
            'money' => '佣金',
            'flow_count' => '打款流水号',
            'create_time' => '申请时间',
            'update_time' => '审核时间',
            'state' => '状态',
        ];
    }
    public function getInfo()
    {
        return $this->hasOne(AdminUser::className(),['id'=>'uid']);
    }
}
