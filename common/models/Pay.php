<?php
namespace common\models;
use yii;
use common\utils\CommonFun;
use yii\helpers\Url;
use JiaLeo\Payment\Alipay\WapPay;
use JiaLeo\Payment\Alipay\WebPay;
class Pay{

    public static function aliPay($data)
    {
        $config = array(
            //支付宝分配给开发者的应用ID
            'app_id' => '2017091108668524',
            //签名方式,现在只支持RSA2
            'sign_type' => 'RSA2',
            //支付宝公钥(证书路径或key,请填写绝对路径)
            'ali_public_key' => Yii::getAlias('@root').'/vendor/jialeo/payment/ali_cert/ali_public_key.pem',
            //用户应用私钥(证书路径或key,请填写绝对路径)
            'rsa_private_key' => Yii::getAlias('@root').'/vendor/jialeo/payment/ali_cert/rsa_private_key.pem',
        );
        if(self::agent() == 'web') {
            $pay = new WebPay($config);
        }else{
            $pay = new WapPay($config);
        }
        $pay_data = array(
            'body' => $data['body'], //内容
            'subject' => $data['subject'], //标题
            'out_trade_no' => $data['out_trade_no'], //商户订单号
            'timeout_express' => '30m', //取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天
            'total_amount' => $data['amount'], //支付价格(单位:分)
            'passback_params' => $pay->setPassbackParams($data['attach']), //额外字段，回调时
            'notify_url' => $data['notify_url'], //后台回调地址
            'return_url' => $data['return_url'] //支付成功后跳转的地址
        );
        return $pay->handle($pay_data);

    }

    public static function weChatPay($data)
    {

    }

    private static function agent()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        if($is_pc) {
            return 'web';
        }else{
            return 'wap';
        }
    }
}