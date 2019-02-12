<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/24
 * Time: 10:06
 */
namespace common\models;
class Tdx
{
    /**
     * 查询数据接口
     * @param string $type
     */
    public function queryData($type="0")
    {
        $data = $this->currency();
        $url = 'http://118.24.229.209:8080/tdx/queryData';
        $params = "category={$type}&randomStr=".$data['randomStr']."&mtimestamp=".$data['mtimestamp']."&signature=".$data['signature'];

        $result = $this->getRequest($url,$params);
        $res = json_decode($result, true);
        return $res;
    }

    /**
     * 委托下单接口
     * @param string $type
     */
    public function SendOrder($orderCate,$priceCate,$stockCode,$price,$quantity)
    {
        $data = $this->currency();
        $url = 'http://118.24.229.209:8080/tdx/sendOrder';
        $params = "orderCate={$orderCate}&priceCate={$priceCate}&stockCode={$stockCode}&price={$price}&quantity={$quantity}&randomStr=".$data['randomStr']."&mtimestamp=".$data['mtimestamp']."&signature=".$data['signature'];
        // print_r($params);
        $result = $this->getRequest($url,$params);
        $res = json_decode($result, true);
        return $res;
//         echo '<pre>';
//         print_r($res);exit;
    }

    /**
     * 撤销委托接口
     * @param string $type
     */
    public function cancelOrder($orderNo,$stockCode)
    {
        $data = $this->currency();
        $url = 'http://118.24.229.209:8080/tdx/cancelOrder';
        $params = "orderNo={$orderNo}&stockCode={$stockCode}&randomStr=".$data['randomStr']."&mtimestamp=".$data['mtimestamp']."&signature=".$data['signature'];
        $result = $this->getRequest($url,$params);
        //print_r($result);exit;
        $res = json_decode($result, true);
        return $res;
    }
    
    /**
     * 撤销委托接口
     * @param string $type
     */
    public function cancelOrderEx($orderNo,$stockCode)
    {
        $data = $this->currency();
        $url = 'http://118.24.229.209:8080/tdx/cancelOrder';
        $params = "orderNo={$orderNo}&stockCode={$stockCode}&randomStr=".$data['randomStr']."&mtimestamp=".$data['mtimestamp']."&signature=".$data['signature'];
        $result = $this->getRequest($url,$params);
        //print_r($result);exit;
        $res = json_decode($result, true);
        echo '<pre>';
        print_r($res);exit;
    }

    /**
     * 查询历史数据接口
     * @param string $type
     * @param string $startDate
     * @param string $endDate
     */
    public function queryHistoryData($type="0",$startDate='2018-08-23',$endDate='2018-09-11')
    {
        $data = $this->currency();
        $url = 'http://118.24.229.209:8080/tdx/queryHistoryData';
        $params = "category={$type}&startDate={$startDate}&endDate={$endDate}&randomStr=".$data['randomStr']."&mtimestamp=".$data['mtimestamp']."&signature=".$data['signature'];
        $result = $this->getRequest($url,$params);
        //print_r($result);exit;
        $res = json_decode($result, true);
        echo '<pre>';
        print_r($res);exit;
    }

    /**
     * 去除字符串之间的空格
     * @param $str
     * @return mixed
     */
    public function trimall($str)
    {
        $qian=array(" ","　","\t","\n","\r");
        $hou=array("","","","","");
        return str_replace($qian,$hou,$str);
    }

    /**
     * 加密
     * @return array
     */
    protected function currency()
    {
        $data = [
            'securityKey' => 'jxJUhrOikaNzLw1JDFjlXKDh0KoQbGPXIh3Fc1LUHI/k26+AG3+Y8d6ZO30KOnZNuua5ZdO7rGn9RsGCFzHb74D3niRSi52UXuFvTIfAZ5Fp904T5MAm2cTtleeYPF+whoiuUXukTzxcwodFY6nNPYeT',
            'randomStr' => rand(1000000, 9999999),
            'mtimestamp' => time(),
        ];
        $string = '';
        foreach($data as $k=>$value){
            $string .= $k.'='.$value.'&';
        }
        $string = trim($string,'&');
        $sign = md5($string);
        $data['signature'] = $sign;
        return $data;
    }

    protected function getRequest($url, $data = array(), $ssl = true,$method = 'post')
    {
        //curl完成，先开启curl模块
        //初始化一个curl资源
        $curl = curl_init();
        //设置curl选项
        curl_setopt($curl, CURLOPT_URL, $url);//url
        //请求的代理信息
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0 FirePHP/0.7.4';
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
        //referer头，请求来源
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);//设置超时时间
        //SSL相关
        if ($ssl) {
            //禁用后，curl将终止从服务端进行验证;
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            //检查服务器SSL证书是否存在一个公用名
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        }
        //判断请求方式post还是get
        if (strtolower($method) == 'post') {
            /**************处理post相关选项******************/
            //是否为post请求 ,处理请求数据
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        //是否处理响应头
        curl_setopt($curl, CURLOPT_HEADER, false);
        //是否返回响应结果
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //发出请求
        $response = curl_exec($curl);
        if (false === $response) {
            echo '<br>', curl_error($curl), '<br>';
            return false;
        }
        //关闭curl
        curl_close($curl);
        return $response;
    }

}