<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_tongji".
 *
 * @property integer $id
 * @property integer $xgj_id
 * @property string $group
 * @property integer $jy_time
 * @property integer $entrust
 * @property string $deal_num
 * @property string $request_num
 * @property string $bourse
 * @property string $contract
 * @property string $transaction
 * @property string $kaiping
 * @property string $insure
 * @property string $valence
 * @property integer $amount
 * @property string $amount_price
 * @property integer $sj_time
 * @property integer $cj_time
 * @property integer $account
 * @property string $xitong_num
 * @property string $charge
 * @property string $yingkui
 * @property string $pc_yingkui
 * @property string $jc_charge
 * @property string $currency
 */
class AdminTongji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_tongji';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'xgj_id', 'jy_time'], 'required'],
            [['id', 'xgj_id', 'jy_time', 'entrust', 'amount', 'sj_time', 'cj_time', 'account'], 'integer'],
            [['valence', 'amount_price', 'charge', 'yingkui', 'pc_yingkui', 'jc_charge'], 'number'],
            [['group', 'deal_num', 'request_num', 'bourse', 'contract', 'insure', 'xitong_num', 'currency'], 'string', 'max' => 255],
            [['transaction', 'kaiping'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'xgj_id' => 'Xgj ID',
            'group' => 'Group',
            'jy_time' => 'Jy Time',
            'entrust' => 'Entrust',
            'deal_num' => 'Deal Num',
            'request_num' => 'Request Num',
            'bourse' => 'Bourse',
            'contract' => 'Contract',
            'transaction' => 'Transaction',
            'kaiping' => 'Kaiping',
            'insure' => 'Insure',
            'valence' => 'Valence',
            'amount' => 'Amount',
            'amount_price' => 'Amount Price',
            'sj_time' => 'Sj Time',
            'cj_time' => 'Cj Time',
            'account' => 'Account',
            'xitong_num' => 'Xitong Num',
            'charge' => 'Charge',
            'yingkui' => 'Yingkui',
            'pc_yingkui' => 'Pc Yingkui',
            'jc_charge' => 'Jc Charge',
            'currency' => 'Currency',
        ];
    }

    public function getMember()
    {
        return $this->hasOne(AdminMember::className(),['xgj_name'=>'xgj_id']);
    }

    
}
