<?php
/**
 * User: Colin
 * Time: 2019/1/21 14:20
 */

namespace mobile\controllers;

use backend\models\AdminMember;
use backend\models\AdminSetting;
use Yii;
use yii\helpers\Url;

class Helper
{
    /**
     * 获取系统配置信息
     * @param $id
     * @return string
     */
    public static function getSysInfo($id)
    {
        return AdminSetting::findOne($id)->val;
    }

    /**
     * 生成唯一邀请码
     * @return bool|string
     */
    public static function getInvitation()
    {
        $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        do {
            $code = substr(str_shuffle($str), 0, 6);
        } while (AdminMember::find()->where(['vatation_code' => $code])->count() > 0);//数据库没有该邀请码才返回
        return $code;
    }

    /**
     * 返回数组信息
     * @param $status
     * @param $msg
     * @return array
     */
    public static function arrData($status, $msg)
    {
        return ['status' => $status, 'msg' => $msg];
    }

    /**
     * 生成订单号
     * @return string
     */
    public static function getOrderNo()
    {
        return date('Ymd', time()) . substr(uniqid(microtime(true), true), 0, 20) * 10000;
    }

    /**
     * 短信接口：腾讯云
     * @param $phone
     * @param $random
     * @return array
     */
    public static function sendSms($phone, $random)
    {
        $appId = self::getSysInfo(42);
        $appKey = self::getSysInfo(43);
        $temp = self::getSysInfo(44);
        $sj = 3;
        $curTime = time();
        $wholeUrl = "https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid=" . $appId . "&random=" . $random;
        // 按照协议组织 post 包体
        $data = new \stdClass();
        $tel = new \stdClass();
        $tel->nationcode = "" . "86";
        $tel->mobile = "" . $phone;
        $data->tel = $tel;
        $data->sig = hash("sha256",
            "appkey=" . $appKey . "&random=" . $random . "&time="
            . $curTime . "&mobile=" . $phone, FALSE);
        $data->tpl_id = $temp;
        $data->params = array($random, $sj);
        $data->time = $curTime;
        //$data->sign = '云肆网络';//如果只有一个则不需要签名
        $data->extend = '';
        $data->ext = '';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $wholeUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($curl);
        $res = json_decode($ret, true);
        if ($res['errmsg'] == 'OK') { // 发送成功
            return self::arrData(200, '发送成功');
        }else{
            return self::arrData(100, $res['errmsg']);
        }
    }

    /**
     * 银行卡四要素接口：腾讯云
     * @param $mobile
     * @param $bankcard
     * @param $idCard
     * @param $name
     * @return mixed
     */
    public static function bankcard($mobile,$bankcard, $idCard,$name)
    {
        $dateTime = gmdate("I d F Y H:i:s");
        $SecretId = Yii::$app->params['bankcard']['secretId'];
        $SecretKey = Yii::$app->params['bankcard']['secretKey'];
        $srcStr = "date: " . $dateTime . "\n" . "source: " . "bankcard4";
        $Authen = 'hmac id="' . $SecretId . '", algorithm="hmac-sha1", headers="date source", signature="';
        $signStr = base64_encode(hash_hmac('sha1', $srcStr, $SecretKey, true));
        $Authen = $Authen . $signStr . "\"";
        $url = 'https://service-m5ly0bzh-1256140209.ap-shanghai.apigateway.myqcloud.com/release/bank_card4/verify';
        $bodys = "?bankcard=$bankcard&idcard=$idCard&name=$name&mobile=$mobile";
        $headers = array(
            'Host:service-m5ly0bzh-1256140209.ap-shanghai.apigateway.myqcloud.com',
            'Accept:text/html, */*; q=0.01',
            'Source: bankcard4',
            'Date: ' . $dateTime,
            'Authorization: ' . $Authen,
            'X-Requested-With: XMLHttpRequest',
            'Accept-Encoding: gzip, deflate, sdch'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url . $bodys);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $data = curl_exec($ch);
        $result = json_decode($data,true);
        if ($result['code'] != '0') {
            return self::arrData(100, $result['message']);
        }
        if ($result['code'] == '0' && $result['result']['res'] != 1) {
            return self::arrData(100, $result['result']['description']);
        }
        return self::arrData(200, '认证成功');
    }

    /**
     * PEX 支付
     * @param $type
     * @param $money
     * @param $name
     * @param $orderNo
     * @return string
     */
    public static function pexPay($type, $money, $name, $orderNo)
    {
        $url = 'https://zf.pexotc.com/payment/';
        $tokenKey = Yii::$app->params['pexPay']['tokenKey'];						//接口密钥32位，请从商户后台获取
        $Pay['merchantid'] = Yii::$app->params['pexPay']['merchantId'];				//商户ID：从商户后台获得
        $Pay['serverbackurl'] = Url::to(['mobile-pay/pex-back-url'],true);	//订单回调通知地址，需带http://
        $Pay['callbackurl'] = Url::to(['index/user'],true);	            //支付完成跳转地址，需带http://
        $Pay['orderamount'] = $money;								                //支付购买数量：USDT单位为（个），CNY单位为（元）不支持小数点
        $Pay['paytype'] = $type;										            //付款方式(小写英文)：alipay/bank ，alipay支付宝，bank银联卡
        $Pay['ordercurrency'] = 'CNY';							                    //购买币种：USDT/CNY , USDT（泰达币），CNY（人民币）
        $Pay['orderno'] = $orderNo;											        //商户业务订单号：最大长度32个字符，每次提交须不同值。
        $Pay['customername'] = $name;												//付款人姓名：只能中文，可空
        $Pay['signType'] = 'md5';													//签名加密算法：md5，32位小写
        $Pay['sign'] = md5($Pay['merchantid'].$Pay['orderno'].$Pay['orderamount'].$Pay['serverbackurl'].$Pay['callbackurl'].$tokenKey);
        return self::buildForm($Pay, $url);
    }

    /**
     * 创建并提交 POST 表单
     * @param $data
     * @param $url
     * @return string
     */
    public static function buildForm($data, $url)
    {
        $sHtml = "<!DOCTYPE html><html><head><title>Waiting...</title>";
        $sHtml.= "<meta http-equiv='content-type' content='text/html;charset=utf-8'></head>
      <body><form id='submit' name='pay' action='".$url."' method='post'>";
        foreach($data as $key => $value){
            $sHtml.= "<input type='hidden' name='".$key."' value='".$value."' style='width:90%;'/>";
        }
        $sHtml .= "</form>正在提交订单信息...";
        $sHtml .= "<script>document.forms['submit'].submit();</script></body></html>";
        return $sHtml;
    }

    /**
     * 发送 POST 请求
     * @param $url
     * @param $postData
     * @return bool|string
     */
    public static function sendPost($url, $postData) {
        $postData = http_build_query($postData);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postData,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }






}