<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 14:17
 */
namespace frontend\controllers;
use backend\models\AdminOrder;
use common\models\Tdx;
use yii\web\Controller;

class TxdController extends Controller
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }
    public function actionOrder()
    {
        $order = AdminOrder::find()->where(['status'=>0])->orderBy('created_time asc')->asArray()->all();
        if($order){
            foreach($order as $k=>$value){
                echo '<pre>';
                $tdx = new Tdx();
                print_r($value);
                $code = mb_substr($value['goods_code'],2,7);
                $result = $tdx->SendOrder('0','0',$code,$value['order_my_money'],$value['order_hander']);
                print_r($result);exit;
            }
        }

    }
}