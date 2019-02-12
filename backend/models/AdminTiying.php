<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_tiying".
 *
 * @property integer $id
 * @property integer $users_id
 * @property integer $money
 * @property string $title
 * @property integer $dates
 * @property string $ip
 * @property integer $bank_id
 * @property string $bank_code
 * @property string $hsname
 * @property integer $state
 */
class AdminTiying extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_tiying';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'money', 'title', 'dates', 'ip', 'bank_id', 'bank_code', 'hsname'], 'required'],
            [['users_id', 'dates', 'state'], 'integer'],
            [['title', 'bank_code', 'hsname'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => '会员账号',
            'money' => '金额',
            'title' => '备注',
            'dates' => '申请时间',
            'ip' => 'ip地址',
            'bank_id' => '银行',
            'bank_code' => '卡号',
            'hsname' => '股票账户',
            'state' => '状态',
        ];
    }
    //获取会员
    public function getMember()
    {
        return $this->hasOne(AdminMember::className(), ['id'=>'users_id']);
    }
}
