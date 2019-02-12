<?php


namespace backend\models;


use Yii;


/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $order_id
 * @property integer $goods_id
 * @property string $goods_name
 * @property string $goods_code
 * @property integer $user_id
 * @property integer $user_tel
 * @property string $order_sn
 * @property string $order_my_money
 * @property string $order_ly_money
 * @property integer $order_bl
 * @property string $order_zy_money
 * @property string $order_zs_money
 * @property string $order_charge
 * @property integer $order_hander
 * @property integer $created_time
 * @property integer $begin_time
 * @property integer $end_time
 * @property integer $status
 * @property string $profit
 * @property string $loss
 * @property integer $type
 */
class AdminOrder extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%order}}';
    }


    /**
     * @inheritdoc
     */

    public function rules()
    {

        return [

            [['goods_id', 'user_id', 'user_tel', 'order_bl', 'order_hander', 'created_time', 'begin_time', 'end_time', 'status', 'type'], 'integer'],
            [['order_my_money', 'order_ly_money', 'total', 'order_zy_money', 'order_zs_money', 'order_charge', 'profit', 'day_dy', 'day_yk','zj_bzj','dy','new_total', 'loss','mc_ly_bzj','mc_zj_bzj','mc_chajia','mc_yk'], 'number'],
            [['order_ly_money'], 'safe'],
            [['goods_name', 'goods_code', 'result','s_hand','mc_orderNo','sale_money'], 'string', 'max' => 255],
            [['order_sn'], 'string', 'max' => 40],
            [['tdx_orderNo'], 'string', 'max' => 32],
        ];
    }


    /**
     * @inheritdoc
     */

    public function attributeLabels()
    {
        return [
            'id' => '策略编号',
            'goods_id' => '股票ID',
            'goods_name' => '股票名称',
            'goods_code' => '股票代码',
            'user_id' => '用户ID',
            'user_tel' => '用户号码',
            'order_sn' => 'Order Sn',

            'order_my_money' => '买入价格',

            'order_ly_money' => '履约保证金',

            'order_bl' => '杠杆倍率',

            'order_zy_money' => '触发止盈',

            'order_zs_money' => '触发止损',

            'order_charge' => '手续费',

            'pay_money' => '综合手续费',

            'current' => '买入价格',

            'order_hander' => 'Order Hander',

            'created_time' => '申请时间',

            'begin_time' => '开始时间',

            'end_time' => 'End Time',

            'status' => '状态',

            'profit' => 'Profit',

            'loss' => 'Loss',

            'type' => 'Type',

        ];

    }

    /**关联会员表**/

    public function getMember()
    {
        return $this->hasOne(AdminMember::className(), ['id' => 'user_id']);
    }

}

