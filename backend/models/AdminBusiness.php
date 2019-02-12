<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%business}}".
 *
 * @property integer $id
 * @property string $account
 * @property integer $date
 * @property integer $entrust
 * @property string $success_account
 * @property string $request
 * @property string $exchange
 * @property string $contract
 * @property string $is_buy
 * @property string $is_open
 * @property string $insure
 * @property string $deal_price
 * @property integer $deal_num
 * @property string $deal_money
 * @property integer $actual_date
 * @property integer $actual_his
 * @property string $z_account
 * @property string $system
 * @property string $service
 * @property string $float_yk
 * @property string $close_yk
 * @property string $jc_service
 * @property string $add_time
 */
class AdminBusiness extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%business}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'deal_num', 'actual_date', 'actual_his','add_time'], 'integer'],
            [['deal_price', 'deal_money', 'service', 'float_yk', 'close_yk', 'jc_service'], 'number'],
            [['account'], 'string', 'max' => 11],
            [['success_account', 'entrust', 'exchange', 'contract', 'is_buy', 'is_open', 'insure'], 'string', 'max' => 10],
            [['request'], 'string', 'max' => 5],
            [['z_account', 'system'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account' => '子账号',
            'date' => '交易日',
            'entrust' => '委托号',
            'success_account' => '成交号',
            'request' => '请求号',
            'exchange' => '交易所',
            'contract' => '合约',
            'is_buy' => '买卖',
            'is_open' => '开平',
            'insure' => '投保',
            'deal_price' => '成交价',
            'deal_num' => '成交量',
            'deal_money' => '成交金额',
            'actual_date' => '实际日期',
            'actual_his' => '成交时间',
            'z_account' => '主账号',
            'system' => '系统号',
            'service' => '手续费',
            'float_yk' => '平仓浮动盈亏',
            'close_yk' => '平仓赢亏',
            'jc_service' => '基础手续费',
            'add_time' => '导入时间',
        ];
    }
}
