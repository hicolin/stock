<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/5
 * Time: 11:35
 */
namespace huanxun\models;
class Huanxun {
    private $version = 'v1.0.0';    //版本号
    private $merCode;               //商户号
    private $account;               //交易账户号
    private $merCert;          //商户证书
    private $postUrl = 'https://newpay.ips.com.cn/psfp-entry/gateway/payment.do';//请求地址
    private $s2Snotify_url;         //异步回调地址
    private $return_url;            //成功同步回调地址
    private $fail_url;              //失败同步回调地址
    private $ccy = '156';           //默认156#人民币
    private $lang = 'GB';           //GB中文
    private $orderEncodeType = '5'; //加密方式，5采用md5
    private $retType = '1';         //返回方式 1#S2S返回
    private $msgId;                 //消息唯一标示，交易必输，查询可选
    private $retEncodeType = '17';  //交易返回接口加密方式
    private $billEXP = '';          //订单有效期
    private $isCredit = '';         //1.直连，空值非直连
    private $productType = '';      //产品类型,1。个人网银，2.企业网银，直连必填
    private $ipspay_config = array();

    public function __construct() {
        $this->ipspay_config = array('version'=>$this->version,'merCert'=>$this->merCert,'postUrl'=>$this->postUrl,
            's2Snotify_url'=>$this->s2Snotify_url,'return_url'=>$this->return_url,'ccy'=>$this->ccy,'lang'=>$this->lang,
            'orderEncodeType'=>$this->orderEncodeType,'retType'=>$this->retType,'MsgId'=>$this->msgId
        );
    }
    public function setOption($merCode='',$account='',$merCert='') {
        $this->merCode = $merCode;
        $this->account = $account;
        $this->merCert = $merCert;
        $this->ipspay_config['merCode'] = $merCode;
        $this->ipspay_config['account'] = $account;
        $this->ipspay_config['merCert'] = $merCert;
    }

    public function __get($key)
    {
        return $this->$key;
    }

    public function __set($key,$value)
    {
        $this->$key = $value;
    }

    public function goPay($data)
    {
        date_default_timezone_set('Asia/Shanghai');
        $params = [
            "Version" => $this->version,
            "MerCode" => $this->merCode,
            "Account" => $this->account,
            "MerCert" => $this->merCert,
            "PostUrl" => $this->postUrl,
            "S2Snotify_url" => $this->s2Snotify_url,
            "Return_url" => $this->return_url,
            "CurrencyType" => $this->ccy,
            "OrderEncodeType" => $this->orderEncodeType,
            "RetType" => $this->retType,
            "MerBillNo" => $data['orderNo'],    //商户订单号
            "MerName" => $data['merName'],      //商户名
            "MsgId" => $this->msgId,
            "PayType" => $data['payType'],      //支付方式 01#借记卡 02#信用卡 03#IPS账户支付
            "FailUrl" => $this->fail_url,
            "Date" => date('Ymd',$data['addtime']),         //订单日期
            "ReqDate" => date("YmdHis"),
            "Amount" => $data['totalFee'],      //订单金额
            "Attach" => $data['attach'],        //数字、字母或数字+字母,自定义
            "RetEncodeType" => $this->retEncodeType,
            "BillEXP" => $this->billEXP,
            "GoodsName" => $data['title'],
            "BankCode" => $data['bankCode'],    //直连必填，银行编号
            "IsCredit" => $this->isCredit,
            "ProductType" => $this->productType,
        ];
        $html_text = $this->build_form($params);
        return (['status'=>1,'text'=>'正在提交数据...','html'=>$html_text]);
    }

    /**
     * 快捷支付
     * @param $data
     * @return array
     */
    public function h5Pay($data) {
        date_default_timezone_set('Asia/Shanghai');
        $this->orderEncodeType['postUrl'] = 'https://mobilegw.ips.com.cn/psfp-mgw/paymenth5.do';
        $this->postUrl = 'https://mobilegw.ips.com.cn/psfp-mgw/paymenth5.do';
        $params = [
            "Version" => $this->version,
            "MerCode" => $this->merCode,
            "Account" => $this->account,
            "MerCert" => $this->merCert,
            "PostUrl" => $this->postUrl,
            "S2Snotify_url" => $this->s2Snotify_url,
            "Return_url" => $this->return_url,
            "CurrencyType" => $this->ccy,
            "Lang" => $this->lang,
            "OrderEncodeType" => $this->orderEncodeType,
            "RetType" => $this->retType,
            "MerBillNo" => $data['orderNo'],    //商户订单号
            "MerName" => $data['merName'],      //商户名
            "MsgId" => $this->msgId,
            "PayType" => $data['payType'],      //支付方式 01#借记卡 02#信用卡 03#IPS账户支付
            "FailUrl" => $this->fail_url,
            "Date" => date('Ymd',$data['addtime']),         //订单日期
            "ReqDate" => date("YmdHis"),
            "Amount" => $data['totalFee'],      //订单金额
            "Attach" => $data['attach'],        //数字、字母或数字+字母,自定义
            "RetEncodeType" => $this->retEncodeType,
            "BillEXP" => $this->billEXP,
            "GoodsName" => $data['title'],
            "BankCode" => $data['bankCode'],    //直连必填，银行编号
            "IsCredit" => $this->isCredit,
            "ProductType" => $this->productType,
            "UserRealName"	=> '',
            "UserId"	=> '',
            "CardInfo" => ''
        ];
        $html_text = $this->build_form($params);
        return (['status'=>1,'text'=>'正在提交数据...','html'=>$html_text]);
    }


    /**
     * 建立请求，以表单HTML形式构造（默认）
     * @param $para_temp 请求参数数组
     * @return 提交表单HTML文本
     */
    private function build_form($para_temp) {
        //待请求参数xml
        $para = $this->buildRequestPara($para_temp);
        $sHtml = "<form id='ipspaysubmit' name='ipspaysubmit' method='post' action='".$this->postUrl."'>";
        $sHtml.= "<input type='hidden' name='pGateWayReq' value='".$para."'/>";
        $sHtml = $sHtml."<input type='submit' style='display:none;'></form>";
        $sHtml = $sHtml."<script>document.forms['ipspaysubmit'].submit();</script>";
        return $sHtml;
    }

    /**
     * 生成要请求给IPS的参数XMl
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数XMl
     */
     private function buildRequestPara($para_temp) {
         $sReqXml = "<Ips>";
         $sReqXml .= "<GateWayReq>";
         $sReqXml .= $this->buildHead($para_temp);
         $sReqXml .= $this->buildBody($para_temp);
         $sReqXml .= "</GateWayReq>";
         $sReqXml .= "</Ips>";
         ///\LxzCmsRoot\LxzCms::WriteLog("请求给IPS的参数XMl:" . $sReqXml,"pay_request_ips");
         //Log::DEBUG("请求给IPS的参数XMl:" . $sReqXml);
         return $sReqXml;
    }

    /**
     * 请求报文头
     * @param   $para_temp 请求前的参数数组
     * @return 要请求的报文头
     */
    private function buildHead($para_temp){
        $sReqXmlHead = "<head>";
        $sReqXmlHead .= "<Version>".$para_temp["Version"]."</Version>";
        $sReqXmlHead .= "<MerCode>".$para_temp["MerCode"]."</MerCode>";
        $sReqXmlHead .= "<MerName>".$para_temp["MerName"]."</MerName>";
        $sReqXmlHead .= "<Account>".$para_temp["Account"]."</Account>";
        $sReqXmlHead .= "<MsgId>".$para_temp["MsgId"]."</MsgId>";
        $sReqXmlHead .= "<ReqDate>".$para_temp["ReqDate"]."</ReqDate>";
        $sReqXmlHead .= "<Signature>".$this->md5Sign($this->buildBody($para_temp),$para_temp["MerCode"],$this->merCert)."</Signature>";
        $sReqXmlHead .= "</head>";
        return $sReqXmlHead;
    }
    /**
     *  请求报文体
     * @param  $para_temp 请求前的参数数组
     * @return 要请求的报文体
     */
    private function buildBody($para_temp){
        $sReqXmlBody = "<body>";
        $sReqXmlBody .= "<MerBillNo>".$para_temp["MerBillNo"]."</MerBillNo>";
        $sReqXmlBody .= "<GatewayType>".$para_temp["PayType"]."</GatewayType>";
        $sReqXmlBody .= "<Date>".$para_temp["Date"]."</Date>";
        $sReqXmlBody .= "<CurrencyType>".$para_temp["CurrencyType"]."</CurrencyType>";
        $sReqXmlBody .= "<Amount>".$para_temp["Amount"]."</Amount>";
        $sReqXmlBody .= "<Lang>".$para_temp["Lang"]."</Lang>";
        $sReqXmlBody .= "<Merchanturl><![CDATA[".$para_temp["Return_url"]."]]></Merchanturl>";
        $sReqXmlBody .= "<FailUrl><![CDATA[".$para_temp["FailUrl"]."]]></FailUrl>";
        $sReqXmlBody .= "<Attach><![CDATA[".$para_temp["Attach"]."]]></Attach>";
        $sReqXmlBody .= "<OrderEncodeType>".$para_temp["OrderEncodeType"]."</OrderEncodeType>";
        $sReqXmlBody .= "<RetEncodeType>".$para_temp["RetEncodeType"]."</RetEncodeType>";
        $sReqXmlBody .= "<RetType>".$para_temp["RetType"]."</RetType>";
        $sReqXmlBody .= "<ServerUrl><![CDATA[".$para_temp["S2Snotify_url"]."]]></ServerUrl>";
        $sReqXmlBody .= "<BillEXP>".$para_temp["BillEXP"]."</BillEXP>";
        $sReqXmlBody .= "<GoodsName>".$para_temp["GoodsName"]."</GoodsName>";
        $sReqXmlBody .= "<IsCredit>".$para_temp["IsCredit"]."</IsCredit>";
        $sReqXmlBody .= "<BankCode>".$para_temp["BankCode"]."</BankCode>";
        $sReqXmlBody .= "<ProductType>".$para_temp["ProductType"]."</ProductType>";
        $sReqXmlBody .= "</body>";
        return $sReqXmlBody;
    }

    /**
     * 签名字符串
     * @param $prestr       需要签名的字符串
     * @param $merCode      商戶號
     * @param $key          私钥
     * @return string       签名结果
     */
    public function md5Sign($prestr, $merCode, $key)
    {
        $prestr = $prestr . $merCode . $key;
        return md5($prestr);
    }

    /**
     * 验证签名
     * @param $prestr   需要签名的字符串
     * @param $sign     签名结果
     * @param $merCode  商戶號
     * @param $key      私钥
     * @return bool     签名结果
     */
    function md5Verify($prestr, $sign, $merCode, $key)
    {
        $prestr = $prestr . $merCode . $key;
        $mysgin = md5($prestr);

        if ($mysgin == $sign) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * php截取<body>和</body>之間字符串
     * @param string $begin 开始字符串
     * @param string $end 结束字符串
     * @param string $str 需要截取的字符串
     * @return string
     */
    public function subStrXml($begin,$end,$str){
        $b= (strpos($str,$begin));
        $c= (strpos($str,$end));
        return substr($str,$b,$c-$b + 7);
    }
}