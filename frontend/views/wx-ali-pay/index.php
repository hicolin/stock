<?php

$data = array("order_sn"=>'qq22222236',"total_amount"=>0.01);
$result = shunfuPay($data,"","","");
//php post 提交
function http_post($url,$post) {
    $curl = curl_init();//初始化curl模块
    curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//是否自动显示返回的信息
    curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息
    $result = curl_exec($curl);//执行cURL
    curl_close($curl);//关闭cURL资源，并且释放系统资源
    return $result;
}

function ToUrlParams($values)
{
    $buff = "";
    foreach ($values as $k => $v)
    {
        if($k != "sign" && $v != "" && !is_array($v)){
            $buff .= $k . "=" . $v . "&";
        }
    }

    $buff = trim($buff, "&");
    return $buff;
}

//生成签名
function MakeSign($data,$keys)
{

    //去除空值
    foreach ($data as $key=>$val)
    {
        if(empty($val))
        {
            unset($data[$key]);
        }
    }



    //签名步骤一：按字典序排序参数
    ksort($data);
    $string =ToUrlParams($data);
    //签名步骤二：在string后加入KEY
    $string = $string . "&key=".$keys;
    // '31997dfe10d50b0236060baeae794d39';
    //签名步骤三：MD5加密
    $string = md5($string);


    return $string;
}

/*$data:（数组类型）订单的信息，$typeNo：支付类型编号，$openid：微信公众号支付时才需要填写，$url：请求地址*/
//最终发起支付的方法：shunfuPay
function shunfuPay($data,$typeNo,$openid='',$url='')
{
    $typeNo='0501';
    //微信0503
    $mchNo = '1234567890';
    $key = '31997dfe10d50b0236060baeae794d39';

    $url= "http://test.shunfu-pay.cn/shunfupay-admin/api/pay/doPay.html";//测试地址

    $extendParams = array('result'=>'success');//支付之后商户自定义返回的参数

    $post_data=array(
        'mchNo' =>$mchNo,
        'orderNo' =>  $data['order_sn'],
        'amount' =>  $data['total_amount'],
        'discountableAmount' =>  '0',
        'undiscountableAmount' =>  '0.01',
        'goodsName' =>  '测试商品' ,
        'goodsDesc' =>  '测试商品1' ,
        'payChannelTypeNo' =>$typeNo,
        'openid'=>$openid,
        'overtime' =>  '60',
        'operatorId' =>  'dd' ,
        'storeId' =>  'ff',
        'terminalId' =>  'ggg' ,
        'timeStamp' =>  time(),
        'extendParams' =>  json_encode($extendParams),
        //'extendParams' =>''

    );
    $post_data=array_filter($post_data);
    $post_data['sign'] = MakeSign($post_data,$key);

    $result = http_post($url,$post_data);
    $result = json_decode($result,1);
    return $result;
}


?>
<html>
<body>
<?php
//print_r($result);

?>
<img src="<?php echo $result['data']['qrCodeImg']?>" />
</body>
</html>
