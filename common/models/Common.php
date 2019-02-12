<?php

namespace common\models;


use backend\models\AdminMember;

use backend\models\AdminSetting;

use backend\models\AdminSlides;

use backend\models\AdminUser;

use Yii;

use yii\helpers\Html;

use yii\helpers\HtmlPurifier;

use backend\models\AdminLog;

use dosamigos\qrcode\QrCode;

use yii\web\UploadedFile;


class Common

{

    /**
     *过滤公共方法
     * $type  1是纯文本过滤，2是HTML过滤
     */

    public static function filter($text, $type = 1)
    {
        if ($type == 1) {
            return Html::encode($text);
        } else if ($type == 2) {
            return HtmlPurifier::process($text);
        }
    }


    public static function filter_decode($text, $type = 1)

    {

        if ($type == 1) {

            return htmlspecialchars_decode($text);

        } else {

            return HtmlPurifier::process($text);

        }

    }


    /**
     *生成邀请码；老的
     */

    public static function getCode2()

    {

        $code = substr(md5(uniqid(rand(), 1)), 0, 16);

        if (AdminMember::find()->where(['invitation' => $code])->one()) {

            self::getInvitation();

        }

        return $code;

    }
    /**生成唯一邀请码**/
    public static function getCode()
    {
        $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        do{
            $code=substr(str_shuffle($str), 0, 6);
        }
        while(AdminUser::find()->where(['vatation_code'=>$code])->count() > 0);//数据库没有该邀请码才返回
        return $code;
    }


    /**生成唯一邀请码（新的）**/

    public static function getInvitation()
    {
        $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        do {
            $code = substr(str_shuffle($str), 0, 6);
        } while (AdminUser::find()->where(['vatation_code' => $code])->count() > 0);//数据库没有该邀请码才返回
        return $code;
    }


    /**
     * @param string $name 上传表单名称
     * @param string $type 上传文件类型 image video audio file
     * @return mixed
     */

    public static function upload($name = 'file', $type = 'image')

    {

        $model = new UploadFile();

        $model->file = UploadedFile::getInstanceByName($name);

        return $model->upload($type);

    }


    /**
     * 截取并处理字符串
     * $str 处理的字符串
     * $len 截取的长度
     * $add 后面是否加...
     */

    public static function subStr($str, $len = 0, $add = true)

    {

        if ($len < mb_strlen($str, 'utf8') && $len && $add) {

            $str = mb_substr($str, 0, $len, 'utf-8') . '...';

        } else {

            $str = mb_substr($str, 0, $len, 'utf-8');

        }

        return $str;

    }


    /**
     * 获取设备信息
     * @return integer
     * 1,安卓，2,ios,3,其他
     */

    public static function getSystem()

    {

        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        $is_pc = (strpos($agent, 'windows nt')) ? true : false;

        $is_mac = (strpos($agent, 'mac os')) ? true : false;

        $is_iphone = (strpos($agent, 'iphone')) ? true : false;

        $is_android = (strpos($agent, 'android')) ? true : false;

        $is_ipad = (strpos($agent, 'ipad')) ? true : false;

        if ($is_android) {

            return 1;

        } else if ($is_iphone) {

            return 2;

        } elseif ($is_pc) {

            return 3;

        } else {

            return 4;

        }

    }


    /**
     * 发送短信阿里
     */

    public static function sendSms($tel, $param, $temp, $sign = '卡农社区')

    {

        require_once '/sms/TopSdk.php';

        //$code=rand(100000,999999);

        $appkey = self::getSysInfo(45);

        $secret = self::getSysInfo(46);

        $c = new \TopClient;

        $c->appkey = $appkey;

        $c->secretKey = $secret;

        $c->format = 'json';


        $req = new \AlibabaAliqinFcSmsNumSendRequest;

        //$req->setExtend($code);

        $req->setSmsType('normal');

        $req->setSmsFreeSignName($sign); //发送的签名

        $req->setSmsParam($param);//根据模板进行填写

        $req->setRecNum($tel);//接收着的手机号码

        $req->setSmsTemplateCode($temp);//短信模板

        $resp = $c->execute($req);

        return $resp->result->err_code;

    }

    /**
     * 凯信 短信
     * @param $mobile
     * @param $rand
     *
     */
    public static function getKxt($mobile,$rand)
    {
        $post_data['userid'] = 6117;
        $post_data['account'] = '15170492935';
        $post_data['password'] = 'zqjf115599';
        $post_data['content'] = '【掌期金服】您的验证码是：'.$rand;
//多个手机号码用英文半角豆号‘,’分隔
        $post_data['mobile'] = $mobile;
        $url='http://sms.kingtto.com:9999/sms.aspx?action=send';
        $o='';
        foreach ($post_data as $k=>$v)
        {
//短信内容需要用urlencode编码，否则可能收到乱码
            $o.="$k=".urlencode($v).'&';
        }
        $post_data=substr($o,0,-1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
        $result = curl_exec($ch);
        return $result;
    }
    /**
     * @param $id
     * @return string
     * 获取配置信息
     */

    public static function getSysInfo($id)

    {

        return AdminSetting::findOne($id)->val;

    }


    /**
     * 二维数组按照指定的键值进行排序
     * @param $arr
     * @param $keys
     * @param string $type
     * @return array
     */

    public static function arraySort($arr, $keys, $type = 'asc')

    {

        $keysvalue = $new_array = array();

        foreach ($arr as $k => $v) {

            $keysvalue[$k] = $v[$keys];

        }

        if (strtolower($type) == 'asc') {

            asort($keysvalue);

        } else {

            arsort($keysvalue);

        }

        reset($keysvalue);

        foreach ($keysvalue as $k => $v) {

            $new_array[$k] = $arr[$k];

        }

        return $new_array;

    }


    /**
     * 2017121010057495
     * 获取唯一的订单号
     * @return string
     */

    public static function getOrderSn()

    {

        return date('YmdHis') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

    }

    public static function getOrderSn2()

    {

        return date('YmdHis') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 6);

    }

    /**
     * 5d7e0157327f4b90be8a785aa1dbc12e
     * 生成不带横杠的UUID
     * @return string
     */

    public static function getUid()

    {

        return sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',

            // 32 bits for "time_low"

            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"

            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",

            // four most significant bits holds version number 4

            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",

            // 8 bits for "clk_seq_low",

            // two most significant bits holds zero and one for variant DCE1.1

            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"

            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)

        );

    }


    /**
     * 获取客户端IP
     * @return string 返回ip地址,如127.0.0.1
     */

    public static function getClientIp()

    {

        $onlineip = 'Unknown';

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ips = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);

            $real_ip = $ips['0'];

            if ($_SERVER['HTTP_X_FORWARDED_FOR'] && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $real_ip)) {

                $onlineip = $real_ip;

            } elseif ($_SERVER['HTTP_CLIENT_IP'] && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {

                $onlineip = $_SERVER['HTTP_CLIENT_IP'];

            }

        }

        if ($onlineip == 'Unknown' && isset($_SERVER['HTTP_CDN_SRC_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CDN_SRC_IP'])) {

            $onlineip = $_SERVER['HTTP_CDN_SRC_IP'];

            $c_agentip = 0;

        }

        if ($onlineip == 'Unknown' && isset($_SERVER['HTTP_NS_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER ['HTTP_NS_IP'])) {

            $onlineip = $_SERVER ['HTTP_NS_IP'];

            $c_agentip = 0;

        }

        if ($onlineip == 'Unknown' && isset($_SERVER['REMOTE_ADDR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['REMOTE_ADDR'])) {

            $onlineip = $_SERVER['REMOTE_ADDR'];

            $c_agentip = 0;

        }

        return $onlineip;

    }


    /**
     * 读取文本末尾n行
     * @param $fileName
     * @param $n
     * @param int $base
     * @return array
     */

    public static function tail($fileName, $n, $base = 5)

    {

        $fp = fopen($fileName, "r+");

        $pos = $n + 1;

        $lines = array();

        while (count($lines) <= $n) {

            try {

                fseek($fp, -$pos, SEEK_END);

            } catch (Exception $e) {

                fseek(0);

                break;

            }

            $pos *= $base;

            while (!feof($fp)) {

                array_unshift($lines, fgets($fp));

            }

        }

        //echo implode ( "", array_reverse ( $lines ) );

        return array_reverse(array_slice($lines, 0, $n));

    }


    /**
     * 对象排序
     * @param $orderby
     * @param $key
     * @return string
     */

    public static function sortClass($orderby, $key)

    {

        $data = explode(' ', $orderby);

        $sortClass = 'class="sorting"';

        if (count($data) > 0) {

            if (empty($data[0]) == false && $data[0] == $key) {

                if (empty($data[1]) == false && $data[1] == 'desc') {

                    $sortClass = 'class="sorting_desc"';


                } else {

                    $sortClass = 'class="sorting_asc"';

                }

            }

        }

        return $sortClass;

    }


    /**
     * 提交表单
     * @param $url
     * @param $model
     */

    public static function build_form($url, $model)

    {

        $sHtml = "<!DOCTYPE html><html><head><title>Waiting...</title>";

        $sHtml .= "<meta http-equiv='content-type' content='text/html;charset=utf-8'></head>

	    <body><form id='submit' name='submit' action='" . $url . "' method='POST'>";

        foreach ($model as $key => $value) {

            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $value . "' style='width:90%;'/>";

        }

        $sHtml .= "</form>正在提交信息...";

        $sHtml .= "<script>document.forms['submit'].submit();</script></body></html>";

        exit($sHtml);

    }


    /**
     * 生成二维码
     * @param string $url
     * @param int $size
     * @param int $margin
     * @param bool $outfile
     */

    public static function qrCode($url = 'http://www.wyyang.com/', $size = 6, $margin = 1, $outfile = false)

    {

        QrCode::png($url, $size, $margin, $outfile);

    }


    /**
     * 腾讯云短信发送
     * @param $phone ||手机号
     * @param $temp ||模板ID
     * @param $random ||随机数
     * @return int
     */

    public static function setCode($phone, $random)

    {

        //$appId = AdminSetting::findOne(42)->val;


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

        if ($res['errmsg'] == 'OK') {//发送成功

            return 200;

        }

    }

    public static function SendCode($tel, $rand)
    {

        header("Content-Type: text/html; charset=UTF-8");

        $flag = 0;

        $params = '';//要post的数据

        $verify = $rand;//获取随机验证码


        //以下信息自己填以下

        $mobile = $tel;//手机号

        $argv = array(

            'name' => '13814987777',     //必填参数。用户账号

            'pwd' => '655B73CCF2998660E824C7B58B67',     //必填参数。（web平台：基本资料中的接口密码）

            'content' => '短信验证码为：' . $verify . '，有效时间一分钟，请勿将验证码提供给他人。',   //必填参数。发送内容（1-500 个汉字）UTF-8编码

            'mobile' => $mobile,   //必填参数。手机号码。多个以英文逗号隔开

            'stime' => '',   //可选参数。发送时间，填写时已填写的时间发送，不填时为当前时间发送

            'sign' => '赢天下',    //必填参数。用户签名。

            'type' => 'pt',  //必填参数。固定值 pt

            'extno' => ''    //可选参数，扩展码，用户定义扩展码，只能为数字

        );

        //print_r($argv);exit;

        //构造要post的字符串

        //echo $argv['content'];

        foreach ($argv as $key => $value) {

            if ($flag != 0) {

                $params .= "&";

                $flag = 1;

            }

            $params .= $key . "=";
            $params .= urlencode($value);// urlencode($value);

            $flag = 1;

        }

        $url = "http://web.wasun.cn/asmx/smsservice.aspx?" . $params; //提交的url地址

        $con = substr(file_get_contents($url), 0, 1);  //获取信息发送后的状态

        if ($con == '0') {

            return 600;

        } else {

            echo "2";
            exit;

        }

    }
    public static function getRequest($method='get',$url,$data=array(),$ssl=true){
        //curl完成，先开启curl模块
        //初始化一个curl资源
        $curl = curl_init();
        //设置curl选项
        curl_setopt($curl,CURLOPT_URL,$url);//url
        //请求的代理信息
        $user_agent = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']: 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0 FirePHP/0.7.4';
        curl_setopt($curl,CURLOPT_USERAGENT,$user_agent);
        //referer头，请求来源
        curl_setopt($curl,CURLOPT_AUTOREFERER,true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);//设置超时时间
        //SSL相关
        if($ssl){
            //禁用后，curl将终止从服务端进行验证;
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
            //检查服务器SSL证书是否存在一个公用名
            curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
        }
        //判断请求方式post还是get
        if(strtolower($method)=='post') {
            /**************处理post相关选项******************/
            //是否为post请求 ,处理请求数据
            curl_setopt($curl,CURLOPT_POST,true);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }
        //是否处理响应头
        curl_setopt($curl,CURLOPT_HEADER,false);
        //是否返回响应结果
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
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

    /**
     * 开户通过发送交易账号密码到开户手机号
     */

    public static function SendTradeAccount($tel, $username, $password, $type = 1)
    {

        header("Content-Type: text/html; charset=UTF-8");

        $flag = 0;

        $params = '';//要post的数据


        //以下信息自己填以下

        $mobile = $tel;//手机号

        $argv = array(

            'name' => '13814987777',     //必填参数。用户账号

            'pwd' => '655B73CCF2998660E824C7B58B67',     //必填参数。（web平台：基本资料中的接口密码）

            'content' => '您的' . (($type == 2) ? '代理' : '交易') . '账号为:' . $username . '，' . (($type == 2) ? '代理' : '交易') . '密码为:' . $password . ",切勿随意泄露信息给他人 ",   //必填参数。发送内容（1-500 个汉字）UTF-8编码

            'mobile' => $mobile,   //必填参数。手机号码。多个以英文逗号隔开

            'stime' => '',   //可选参数。发送时间，填写时已填写的时间发送，不填时为当前时间发送

            'sign' => '赢天下',    //必填参数。用户签名。

            'type' => 'pt',  //必填参数。固定值 pt

            'extno' => ''    //可选参数，扩展码，用户定义扩展码，只能为数字

        );

        foreach ($argv as $key => $value) {

            if ($flag != 0) {

                $params .= "&";

                $flag = 1;

            }

            $params .= $key . "=";
            $params .= urlencode($value);// urlencode($value);

            $flag = 1;

        }

        $url = "http://web.wasun.cn/asmx/smsservice.aspx?" . $params; //提交的url地址

        $con = substr(file_get_contents($url), 0, 1);  //获取信息发送后的状态

    }


    /**
     * @param $model
     * @return mixed
     */

    public static function getLabels($model)
    {

        foreach ($model as $key => $list) {

            $model[$key]->labels = explode(',', $list->labels);

        }

        return $model;

    }


    /**
     * @param $cid || 分类id
     * @param $num || 数量
     * @return array|\yii\db\ActiveRecord[]
     */

    public static function getBanner($cid, $num)
    {

        $banner = AdminSlides::find()->where(['slide_cid' => $cid, 'slide_status' => 1])->limit($num)->all();

        return $banner;

    }


    /**
     * 获取ip名称
     * @param $cip
     * @return string
     */

    public static function getLoginIp($cip)

    {

        $url = 'http://restapi.amap.com/v3/ip';

        $data = array(

            'output' => 'json',

            'key' => '16199cf2aca1fb54d0db495a3140b8cb',

            'ip' => $cip

        );


        $postdata = http_build_query($data);

        $opts = array(

            'http' => array(

                'method' => 'POST',

                'header' => 'Content-type: application/x-www-form-urlencoded',

                'content' => $postdata

            )

        );

        $context = stream_context_create($opts);

        $result = file_get_contents($url, false, $context);

        $res = json_decode($result, true);

        if (count($res['province']) == 0) {

            $res['province'] = '北京市';

        }

        if (!empty($res['province']) && $res['province'] == "局域网") {

            $res['province'] = '北京市';

        }

        if (count($res['city']) == 0) {

            $res['city'] = '北京市';

        }

        return $res['city'];

    }

    /**银行四要素身份验证-获取access_token**/

    public static function getAccessToken()

    {

        /**请求接口验证身份信息**/

        $key = "d8cc402d-f5c7-4fa8-ab05-6c727909fa43";

        $secret = "50ce0b95-8226-47f6-9a0b-76b36ad8db81";

        $url = "http://open.hscloud.cn/oauth2/oauth2/token";

        $postArr = array(

            'client_id' => $key,

            'grant_type' => 'client_credentials',

        );

        $header = array();

        $header[] = 'Authorization: Basic ' . base64_encode($key . ':' . $secret);

        $header[] = 'Content-Type: application/x-www-form-urlencoded';

        $model = AdminSetting::findOne(13);

        if ($model->update_time + 23 * 3600 < time()) {

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $url);

            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($curl, CURLOPT_POST, 1);

            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postArr));

            $output = curl_exec($curl);

            $result = json_decode($output, true);

            if (isset($result['access_token'])) {


                $model->update_time = time();

                $model->val = $result['access_token'];

                $model->save(false);

                return $result['access_token'];

            }

        } else {

            return $model->val;

        }


    }

    /**根据银行卡四要素请求身份验证信息**/

    public static function checkCard($data)

    {

        $url = "https://api.hscloud.cn/data_check/v1/ccxcredit/auth_cncm?access_token=" . $data['access_token'] . "&id_no=" . $data['id_no'] . "&real_name=" . $data['real_name'] . "&bank_account=" . $data['bank_account'] . "&mobile_tel=" . $data['mobile_tel'];

        $result = file_get_contents($url);

        return json_decode($result, true);

    }
    //吉投对接的公共验证
    public static function getJtApi($type)
    {
        header('content-type:text/html;charset=utf8');
        switch($type){
            case 'ReqQryAccountInfo'; //查询账户信息
                $data['ChdAccountID'] = '101784003';//子账号编号
                break;
            case 'ReqCreateAccount';//请求创建子账户
                //$data['AccountID'] = '';//待开户子账号所属的母账号。（如果填空，将使用第一个母账号）
                //$data['ChdPassword'] = '';//待开户的子账号密码。（如果填空，则密码默认为123456）
                $data['ChdName'] = '昊天';//待开户的子账号名称。（如果填空，那么名称和id相同）
                break;
            case 'ReqCheckChdAccount'; //请求检验子账号密码
                $data['ChdAccountID'] = '101784003';
                $data['ChdPassword'] = '12345678';
                break;
            case 'ReqModifyChdAccount';//请求修改子账户名称和密码
                $data['ChdAccountID']='101784003';
                $data['ChdPassword']='12345678';//（不填代表不修改）
                $data['ChdName']='zeze';//（不填代表不修改）
                break;
            case 'ReqTransfer';//请求出入金
                $data['ChdAccountID']='101784003';
                $data['PriorityAmount']='10';//优先资金(正数代表入金，负数代表出金，可填0，单位为分)
                $data['BadAmount']='0';//劣后资金(正数代表入金，负数代表出金，可填0，单位为分)
                break;
            case 'ReqSetMarginCommission';//请求设置保证金手续费
                $data['ChdAccountID']='101784003';//待设置保证金的子账号。
                $data['Source']='101784003';//参考账号，ChdAccountID的保证金手续费将被设置为和source一样。
                break;
            case 'ReqSetRiskControl';//请求设置风控参数
                $data['ChdAccountID']='101784003';//待设置风控的子账号。
                $data['Source']='101783003';//参考账号，ChdAccountID的风控参数将被设置为和source一样。
                break;
            default:
        }
        $data['Action'] = $type; //请求类型
        $data['UserID'] = 'superadmin';//
        ksort($data);
        $kk = '';
        foreach($data as $k=>$value){
            $kk .= $k.'='.$value.'&';
        }
        //$As=http_build_query($data);//在没有中文字符的情况下使用fou否则校验失败
        $data['UserKey'] = '6d070ade208eee3611e61daff27230fd';
        //$b = $As.'&UserKey='.$data['UserKey'];
        $dd = $kk.'UserKey='.$data['UserKey'];
        $sign = md5($dd);
        //$url = 'http://120.27.112.91:8082/AccMgrt.aspx?'.$As.'&Sign='.$sign;
        $url = 'http://120.27.112.91:8082/AccMgrt.aspx?'.$kk.'Sign='.$sign;
        $result = self::getRequest('get',$url);
        $resultY = json_decode($result,true);
        return $resultY;
    }

    /**
     * 邮箱提示
     * @param $email
     * @param $html
     * @return int
     */

    public static function getEmailTips($email, $html)

    {

        //$email = Yii::$app->request->post('email');

        //$email_code = rand(100000, 999999);

        $mail = Yii::$app->mailer->compose();

        $mail->setTo($email);

        $mail->setSubject("邮件提醒");

        $mail->setHtmlBody("$html");

        if ($mail->send()) {

            return 600;

        } else {

            return 200;

        }

    }

    /**
     * 股票接口
     */
    public static function getGp($data)
    {
        $url = 'http://api2.jinpinzhibo.com/goods.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40&show=json';
        $postdata = http_build_query($data);
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata,
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        $res = json_decode($result, true);
        return $res;
    }
    /**
     * 生成菜单
     */

 /**
     * @param string $bankcard
     * @param string $idcard
     * @param string $name
     * @param string $mobile
     * @return mixed
     * 腾讯云银行四要素验证 九洲金服
     */
    public static function bankcard($mobile,$bankcard, $idcard,$name)
    {
        $dateTime = gmdate("I d F Y H:i:s");
        $SecretId = 'AKIDMypV1EXH1jD427H4VmgC9AI7PxXm4WaJA87q';
        $SecretKey = 'F2GKoPPZH1K8gsSw8hSo2u3Av1WaZd38V1z7hnIw';
        $srcStr = "date: " . $dateTime . "\n" . "source: " . "bankcard4";
        $Authen = 'hmac id="' . $SecretId . '", algorithm="hmac-sha1", headers="date source", signature="';
        $signStr = base64_encode(hash_hmac('sha1', $srcStr, $SecretKey, true));
        $Authen = $Authen . $signStr . "\"";
        $url = 'https://service-m5ly0bzh-1256140209.ap-shanghai.apigateway.myqcloud.com/release/bank_card4/verify';
        $bodys = "?bankcard=$bankcard&idcard=$idcard&name=$name&mobile=$mobile";
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
        return $result;
    }
    


    
}