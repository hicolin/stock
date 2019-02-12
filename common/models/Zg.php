<?php
namespace common\models;
use Yii;


class Zg{

    public $baseurl = "https://101.132.99.108:13134";
    public $sa = "tiaoshi299";
    public $sapass = "299";

    // 开户
    public function actionCreateAccount($account,$name)
    {
        $type = "createaccount";
        $password = mt_rand(000000,999999);
        $params = "requestid=1&sa={$this->sa}&sapass={$this->sapass}&account={$account}&password={$password}&name={$name}&group=aaa&mainaccount=";
        $res = $this->apiHandle($type,$params);


//       print_r($res);exit;
//        $result = array();
        if($res['Result']['Error']['Code'] == 0){
            $result['code'] = 0;
            $result['account'] = $res['Result']['Account'];
            $result['pwd'] = $password;
            $result['msg'] = "开户成功。开户子账户为：{$res['Result']['Account']},密码为：{$password}";

            return $result;
        }else{
            $result['code'] = 1;
            $result['msg'] = "开户失败。错误码：{$res['Result']['Error']['Code']}，错误提示：{$res['Result']['Error']['Message']}";
            return $result;
        }
    }

    // 设置保证金率
    public function actionSetMarginRate($account)
    {
        $type = "setmarginrate";
        $params = "requestid=2&sa={$this->sa}&sapass={$this->sapass}&account={$account}&source=81299001";
        $res = $this->apiHandle($type,$params);
        if($res['Result']['Error']['Code'] == 0){
            return "保证金率设置成功。";
        }else{
            return "保证金率设置失败。错误码：{$res['Result']['Error']['Code']}，错误提示：{$res['Result']['Error']['Message']}";
        }
    }

    // 设置手续费率
    public function actionSetCommissionRate($account)
    {
        $type = "setcommissionrate";
        $params = "requestid=3&sa={$this->sa}&sapass={$this->sapass}&account={$account}&source=81299001";
        $res = $this->apiHandle($type,$params);
        if($res['Result']['Error']['Code'] == 0){
            return "手续费率设置成功。";
        }else{
            return "手续费率设置失败。错误码：{$res['Result']['Error']['Code']}，错误提示：{$res['Result']['Error']['Message']}";
        }
    }

    // 设置风控
    public function actionSetRiskControl($account)
    {
        $type = "setriskcontrol";
        $params = "requestid=4&sa={$this->sa}&sapass={$this->sapass}&account={$account}&source=81299001";
        $res = $this->apiHandle($type,$params);
        if($res['Result']['Error']['Code'] == 0){
            return "风控设置成功。";
        }else{
            return "风控设置失败。错误码：{$res['Result']['Error']['Code']}，错误提示：{$res['Result']['Error']['Message']}";
        }
    }

    // 出入金
    public function actionDeposit($account,$money)
    {
        $type = "deposit";
        $params = "requestid=5&sa={$this->sa}&sapass={$this->sapass}&account={$account}&amount={$money}&credit=''&remark=自动";
        $res = $this->apiHandle($type,$params);
        if($res['Result']['Error']['Code'] == 0){
            return array('status'=>100,'msg'=>'成功');
        }else{
            return array('status'=>200,'msg'=>$res['Result']['Error']['Message']);
//            return "出入金失败。错误码：{$res['Result']['Error']['Code']}，错误提示：{$res['Result']['Error']['Message']}";
        }
    }

    // 查询账户资金
    public function actionQueryAccount($account)
    {
        $type = "queryaccount";
        $params = "requestid=6&sa={$this->sa}&sapass={$this->sapass}&account={$account}";
        $res = $this->apiHandle($type,$params);
        if($res['Result']['Error']['Code'] == 0){
            $summary = $res['Result']['Summary'];
            return $summary;
            $str = "查询成功。"."<br/>";
            $str .= "当前权益：".$summary['Balance']."<br/>";
            $str .= "上日权益：".$summary['PreBalance']."<br/>";
            $str .= "可用资金：".$summary['Available']."<br/>";
            $str .= "保证金：".$summary['Margin']."<br/>";
            $str .= "开仓冻结保证金：".$summary['MarginFrozen']."<br/>";
            $str .= "挂单冻结保证金：".$summary['CommissionFrozen']."<br/>";
            $str .= "持仓浮动盈亏：".$summary['PositionProfitFloat']."<br/>";
            $str .= "平仓浮动盈亏：".$summary['CloseProfitFloat']."<br/>";
            $str .= "手续费：".$summary['Commission']."<br/>";
            $str .= "持仓盯市盈亏：".$summary['PositionProfit']."<br/>";
            $str .= "平仓盯市盈亏：".$summary['CloseProfit']."<br/>";
            $str .= "入金：".$summary['Deposit']."<br/>";
            $str .= "出金：".$summary['Withdraw']."<br/>";
            $str .= "优先资金：".$summary['Credit']."<br/>";
            $str .= "期初投入：".$summary['BaseCapital']."<br/>";
            $str .= "历史最大权益：".$summary['EverMaxBalance']."<br/>";
            $str .= "当日最大权益：".$summary['MaxBalance']."<br/>";
            $str .= "劣后资金：".($summary['Balance']-$summary['Credit'])."<br/>";
            echo $str;

        }else{
            return 0;
            //echo "查询失败。错误码：{$res['Result']['Error']['Code']}，错误提示：{$res['Result']['Error']['Message']}";
        }
    }

    // JS错误提示并返回
    public function failTip($tip)
    {
        echo "<script>alert('".$tip."')</script>";
        echo "<script>history.go(-1)</script>";
        exit;
    }

    // curl请求（GET方式）
    public function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($curl);
        curl_close($curl);
        $data = mb_convert_encoding($data, 'utf8', 'gbk');
        $data = explode('<?xml version="1.0" encoding="GB2312" ?>', $data);
        $xmlObj = simplexml_load_string($data[1]);
        return json_decode(json_encode($xmlObj),true);
    }

    // 根据指定类型和参数发送curl请求
    protected function apiHandle($type,$params){
        $url = $this->baseurl."/".$type."?".$params;
        $res = $this->httpGet($url);
        return $res;
    }
}
