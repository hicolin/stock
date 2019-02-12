<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_xgj".
 *
 * @property integer $xgj_id
 * @property integer $xgj_name
 * @property string $xgj_pwd
 * @property string $agentid
 * @property integer $states
 * @property integer $account_id
 */
class AdminHousekeeper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_xgj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['xgj_name', 'xgj_pwd','states','agentid','account_id'], 'safe'],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'xgj_id' => 'ID',
            'xgj_name' => '交易账号',
            'xgj_pwd' => '交易密码',
            'states' => '使用状态',
            'agentid' => '用户',
            'account_id' => '主账户',
        ];
    }

    public function getAccount()
    {
        return $this->hasOne(AdminAccount::className(),['id'=>'account_id']);
    }
}
