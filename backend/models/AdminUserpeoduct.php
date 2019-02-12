<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_user_peoduct".
 *
 * @property string $id
 * @property integer $uid
 * @property string $uname
 * @property string $pwd
 * @property string $proid
 * @property string $price
 * @property string $commission
 * @property string $commission_amount
 * @property string $commission_agent
 * @property string $commission_member
 * @property string $commission_pre
 * @property string $commission_cycle
 * @property string $rate
 * @property string $id_card
 * @property string $bank_name
 * @property string $bank_code
 * @property integer $bank_province
 * @property integer $bank_city
 * @property string $bank_address
 * @property string $bank_pic
 * @property string $card_zm
 * @property string $card_fm
 * @property string $proxy
 * @property string $license
 * @property string $ht_1
 * @property string $ht_2
 * @property string $ht_3
 * @property string $other_file
 * @property string $state
 */
class AdminUserpeoduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user_peoduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'bank_province', 'bank_city'], 'integer'],
            [['commission','commission_amount','commission_member','commission_agent','commission_pre'], 'number'],
            [['proid', 'price'], 'string', 'max' => 255],
            [['id_card', 'bank_name', 'bank_code'], 'string', 'max' => 30],
            [['bank_address','pwd','commission_cycle'], 'string', 'max' => 50],
            [['uname'], 'string', 'max' => 100],
            [['rate'], 'string', 'max' => 255],
            [['bank_pic', 'card_zm', 'card_fm', 'proxy', 'license', 'ht_1', 'ht_2', 'ht_3'], 'string', 'max' => 100],
            [['other_file'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '代理商名称',
            'uname' => '代理商名',
            'pwd' => '明文密码',
            'proid' => '产品',
            'price' => '价格',
            'commission' => '手续费',
            'commission_amount' => '返佣金额',
            'commission_agent' => '截佣',
            'commission_member' => '直系会员返佣',
            'commission_pre' => '上级金额',
            'commission_cycle' => '返佣周期',
            'rate' => '汇率',
            'id_card' => '身份证号码',
            'bank_name' => '银行卡名称',
            'bank_code' => '银行卡号',
            'bank_province' => '省',
            'bank_city' => '市',
            'bank_address' => '支行',
            'bank_pic' => '银行卡照片',
            'card_zm' => '身份证正面',
            'card_fm' => '身份证反面',
            'proxy' => '收款委托书',
            'license' => '营业执照',
            'ht_1' => '合同1',
            'ht_2' => '合同2',
            'ht_3' => '合同3',
            'other_file' => '其他文件',
            'state' => '状态',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(AdminUser::className(),['id'=>'uid']);
    }
}
