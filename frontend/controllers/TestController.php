<?php
namespace frontend\controllers;

use backend\models\AdminCharge;
use backend\models\AdminOrder;
use common\helps\Tools;
use common\models\Common;
use common\models\Tdx;
use common\models\WeChat;
use Qcloud\Sms\SmsVoicePromptSender;
use Yii;
use yii\web\Controller;
use backend\models\AdminMember;
use backend\models\AdminHousekeeper;
use common\utils\CommonFun;
use frontend\controllers\CommonController;
use backend\models\AdminAccount;
use backend\controllers\PublicController;
use ucpass\lib\Ucpaas;

class TestController extends Controller
{
    public $layout = "main";
    public $defaultAction = 'index';
    public $enableCsrfValidation = false;
    public $member;
    public $user_id;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */


    public function actionIndex()
    {
        $type = ['0' => '请选择', '0501' => '支付宝', '0503' => '微信', '3' => '网银支付'];
        $file = "abcd.txt";
        file_put_contents($file, '225今天测试1111');
        $str = file_get_contents('php://input');
        //$str = "timeStamp=1504071869057&elecInvoiceQRcode&payChannelTypeNo=0501&buyerId=2088902632762883&sign=2282a19ecc47954bb83ec408f456bbc8&amount=0.01&gwTradeNo=2017083013435501409562051&tradeNo3rd=2017083021001004880250386931&orderNo=1406&extendParams={'result':'success'}&goodsDesc=测试商品1&buyerAccount=187****7256&goodsName=测试商品&mchNo=1234567890";
        $str = urldecode($str);
        $data = explode('&', $str);
        $result = array();
        $file = "654321.txt";
        file_put_contents($file, $str);
        foreach ($data as $key => $value) {
            if ($key == 1) {
                continue;
            }
            $explode = explode('=', $value);
            $k = $explode[0];
            $result[$k] = $explode[1];
        }
        $post_sign = $result['sign'];
        unset($result['sign']);
        //$key='key的值';
        //$key='7f84cfec74c7212553cc1d2b2e6f249a';
        $key = 'f8d74549a5e686d67f02d2cca8797a30';
        $sign = $this->makeSign($result, $key);

        $file = "123456.txt";
        file_put_contents($file, '225今天测试');
        //验证签名
        if ($sign != $post_sign) {
            exit;
        }


        if ($result['order_sn']) {
            //更新订单状态     业务处理
            $model = AdminCharge::findOne(['id' => $result['order_sn']]);
            $user_id = $model->users_id;
            $member = AdminMember::findOne(['id' => $user_id]);
            $file = "aaaaaa.txt";
            file_put_contents($file, $user_id);
            if ($model->state == 1) {
                return 100;
                exit;
            }
            $model->state = 1;
            $model->pay_type = $type[$result['payChannelTypeNo']];
            $model->order_no = $result['orderNo'];
            //充值的钱存到账户中扣掉手续费后转换成美元
            //手续费比例
            $fee_lone = Tools::getSetting(37) ?: 0.3;
            //汇率
            $huilv = Tools::getSetting(22) ?: 7.2;
            $recharge_money = ($result['amount'] - $result['amount'] * $fee_lone / 100) / $huilv;
            $recharge_money = (intval($recharge_money * 100)) / 100;
            $member->money = $member->money + $recharge_money;
            //$url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=dsf1110011001&sapass=967865&account='.$member->xgj_name.'&amount='.$recharge_money.'&credit=0&currency=USD&remark=自动';
            //$this->actionHttp($url);
            $account = AdminAccount::findOne($member->account_id);
            $account_pass = PublicController::decrypt($account->pass);
            $file = "20171122.txt";
            file_put_contents($file, $member->account_id . ',' . $account->account . ',' . $account_pass);
            $url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=' . $account->account . '&sapass=' . $account_pass . '&account=' . $member->xgj_name . '&amount=' . $recharge_money . '&credit=0&currency=USD&remark=自动';
            //$url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=dsf1110011001&sapass=967865&account='.$member->xgj_name.'&amount='.$recharge_money.'&credit=0&currency=USD&remark=自动';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            $data = curl_exec($curl);
            //$member->money = $member->money+$result['amount'];
            $transaction = Yii::$app->db->beginTransaction();
            if ($member->validate() && $model->validate()) {
                try {
                    $member->save();
                    $model->save();
                    //提交
                    $transaction->commit();
                    return 100;
                    exit;
                } catch (Exception $e) {
                    //捕获错误
                    $transaction->rollback();
                }
            } else {
                return 400;
                exit;
            }

        }


    }

    public static function makeSign($data, $keys)
    {

        //去除空值
        foreach ($data as $key => $val) {
            if (empty($val)) {
                unset($data[$key]);
            }
        }

        //签名步骤一：按字典序排序参数
        ksort($data);
        $string = self::toUrlParams($data);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $keys;
        // '31997dfe10d50b0236060baeae794d39';
        //签名步骤三：MD5加密
        $string = md5($string);
        return $string;
    }

    public static function toUrlParams($values)
    {
        $buff = "";
        foreach ($values as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    /*
     * php post 提交
     * */
    protected static function httpPost($url, $post)
    {
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

    public static function httpGet($url)
    {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }

    /*
     * 最终发起支付的方法：shunfuPay
     * $data:（数组类型）订单的信息
     * $typeNo：支付类型编号
     * $openid：微信公众号支付时才需要填写
     * $url：请求地址
     * */

    public static function actionShunfuPay($data, $typeNo, $openid = '', $url = '')
    {
        //$typeNo='0501';
        //微信0503
        //$mchNo = 'SZSF001-0000007';
        $mchNo = 'SZXL10004-0000002';
        //$key = '7f84cfec74c7212553cc1d2b2e6f249a';
        $key = 'f8d74549a5e686d67f02d2cca8797a30';
        $url = "http://pay.shunfu-pay.cn/shunfupay-admin/api/pay/doPay.html";//测试地址
        //$url= "http://pay.shunfu-pay.cn/shunfupay-admin/api/pay/doPay.html?mchNo=$mchNo&orderNo=$aa&amount=$bb&timeStamp=".time();//测试地址
        //$url= "http://pay.shunfu-pay.cn/shunfupay-admin/api/pay/unifyCode.html?mchNo=SZSF001-0000007&timeStamp=".time()."&amount=".$data['total_amount'];//测试地址
        $file = "smzf.txt";
        file_put_contents($file, $mchNo . ',' . $data['order_sn'] . ',' . $data['total_amount'] . ',' . date('YmdH:i:s'));
        $extendParams = array('result' => 'success');//支付之后商户自定义返回的参数
        $post_data = array(
            'mchNo' => $mchNo,
            'order_sn' => $data['order_sn'],
            'amount' => $data['total_amount'],
            /*'discountableAmount' =>  '0',
            'undiscountableAmount' =>  '0.01',
            'goodsName' =>  '测试商品' ,
            'goodsDesc' =>  '测试商品1' ,
            'payChannelTypeNo' =>$typeNo,
            'openid'=>$openid,
            'overtime' =>  '60',
            'operatorId' =>  'dd' ,
            'storeId' =>  'ff',
            'terminalId' =>  'ggg' ,*/
            'timeStamp' => time()
            /*'extendParams' =>  json_encode($extendParams)*/,
            //'extendParams' =>''

        );
        $post_data = array_filter($post_data);
        $post_data['sign'] = self::makeSign($post_data, $key);
        //$result = self::httpPost($url,$post_data);
        //var_dump($result);exit;
        //$result['img'] = $url= "http://pay.shunfu-pay.cn/shunfupay-admin/api/pay/unifyCode.html?mchNo=SZSF001-0000007&timeStamp=".time()."&amount=".$data['total_amount'];
        //$result = json_decode($result,1);
        //var_dump($result);exit;
        $result['data']['qrCodeImg'] = "http://pay.shunfu-pay.cn/shunfupay-admin/api/pay/unifyCode.html?mchNo=" . $mchNo . "&order_sn=" . $data['order_sn'] . "&sign=" . $post_data['sign'] . "&timeStamp=" . $post_data['timeStamp'] . "&amount=" . $post_data['amount'];
        return $result;
    }

    /*
    * f访问接口
    * */
    public function actionHttp($url)
    {
        //$url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=dsf1110011001&sapass=967865&account=1110011108&amount=100&credit=0&currency=USD&remark=自动';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($curl);
        $arr = explode(' ', $data);
        return $arr;
    }


    /*
     * 银联支付回调地址
     * */

    public function actionBankPay()
    {
        $file = "wang.txt";
        file_put_contents($file, '银联测试' . date('Ymd H:i:s'));
        require ROOT . "/bankpay/common/log.php";
        $key = "FlIG2WvbeEb4d5N";//密钥
        $signMessage = "";
        $signMessage .= $this->isEmpty($_REQUEST["Name"]) ? "" : $_REQUEST["Name"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["Version"]) ? "" : $_REQUEST["Version"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["Charset"]) ? "" : $_REQUEST["Charset"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TraceNo"]) ? "" : $_REQUEST["TraceNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["MsgSender"]) ? "" : $_REQUEST["MsgSender"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["SendTime"]) ? "" : $_REQUEST["SendTime"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["InstCode"]) ? "" : $_REQUEST["InstCode"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["OrderNo"]) ? "" : $_REQUEST["OrderNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["OrderAmount"]) ? "" : $_REQUEST["OrderAmount"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransNo"]) ? "" : $_REQUEST["TransNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransAmount"]) ? "" : $_REQUEST["TransAmount"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransStatus"]) ? "" : $_REQUEST["TransStatus"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransType"]) ? "" : $_REQUEST["TransType"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["TransTime"]) ? "" : $_REQUEST["TransTime"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["MerchantNo"]) ? "" : $_REQUEST["MerchantNo"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["ErrorCode"]) ? "" : $_REQUEST["ErrorCode"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["ErrorMsg"]) ? "" : $_REQUEST["ErrorMsg"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["Ext1"]) ? "" : $_REQUEST["Ext1"] . "|";
        $signMessage .= $this->isEmpty($_REQUEST["SignType"]) ? "" : $_REQUEST["SignType"] . "|";
        $signMessage .= $key;

        writeLog("signMessage=" . $signMessage);
        $signMsg = strtoupper(md5($signMessage));
        $SignMsgMerchant = $_REQUEST["SignMsg"];
        writeLog("orderpay notifySFT.php signMsg=" . $signMsg . "     SignMsgMerchant=" . $SignMsgMerchant);
        if (isset($SignMsgMerchant) && strcasecmp($signMsg, $SignMsgMerchant) === 0) {
            $file = "abcde.txt";
            file_put_contents($file, $signMessage);
            $model = AdminCharge::findOne(['id' => $_REQUEST['OrderNo']]);
            $user_id = $model->users_id;
            $member = AdminMember::findOne(['id' => $user_id]);
            //判断是否已经处理过
            if ($model->state == 1) {
                //已经处理过，直接返回
                echo "OK";
                exit;
            }
            $model->state = 1;
            $model->order_no = $_REQUEST['TransNo'];
            $model->pay_ordersid = $_REQUEST['BankSerialNo'];
            //充值的钱存到账户中扣掉手续费后转换成美元
            //手续费比例
            $fee_lone = Tools::getSetting(37) ?: 0.3;
            //汇率
            $huilv = Tools::getSetting(22) ?: 7.2;
            $recharge_money = ($_REQUEST['TransAmount'] - $_REQUEST['TransAmount'] * $fee_lone / 100) / $huilv;
            $recharge_money = (intval($recharge_money * 100)) / 100;
            //$member->money = $member->money+$recharge_money;
            //$member->money = $member->money+$result['amount'];
            if ($model->validate()) {
                $account = AdminAccount::findOne($member->account_id);
                $account_pass = PublicController::decrypt($account->pass);
                $url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=' . $account->account . '&sapass=' . $account_pass . '&account=' . $member->xgj_name . '&amount=' . $recharge_money . '&credit=0&currency=USD&remark=自动';
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HEADER, 1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                $data = curl_exec($curl);
                $arr = explode(' ', $data);
                $file = "aabbcc.txt";
                file_put_contents($file, $recharge_money . date('Ymd H:i:s'));
                if ($arr[1] == 200) {
                    //$member->save();
                    if ($model->save()) {
                        $this->actionSetMsg($member->usersname, $_REQUEST['TransAmount']);
                        echo 'OK';
                        exit;
                        return 100;
                    } else {
                        echo 'OK';
                        exit;
                        //数据库更新失败的话，直接返回。
                        //$url = 'https://106.15.47.118:13134/deposit?requestid=5&sa=dsf1110011001&sapass=967865&account='.$member->xgj_name.'&amount='.-$recharge_money.'&credit=0&currency=USD&remark=自动';
                        //$curl = curl_init();
                        //curl_setopt($curl, CURLOPT_URL, $url);
                        //curl_setopt($curl, CURLOPT_HEADER, 1);
                        //curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                        //$data = curl_exec($curl);
                        return 400;
                    }
                }
            }
            //处理自己的业务逻辑
            writeLog("OK");
            echo "OK";
        }
    }

    /*
     *
     * */
    public function isEmpty($var)
    {
        if (isset($var) && $var != "") {
            return false;
        } else {
            return true;
        }
    }

    /*
     * 发送验证码
     * */
    public function actionSetMsg($username = '', $money = '')
    {
        ini_set('date.timezone', 'Asia/Shanghai');
        header("Content-type:text/html; charset=UTF-8");
        require ROOT . "/ucpass/lib/Ucpaas.class.php";
        $options['accountsid'] = 'e63c8240d2cd14d4609a9ccd1f7efed2';
        $options['token'] = '57f20a4587761dc0ddd035132b314876';
        $ucpass = new Ucpaas($options);
        $templateId = '143136';
        $appId = "037c812e751e445ea35482a1e98a8a2d";
        $to = Tools::getSetting(33);
        //$param=$username.','.$money;
        $param = $username . ',' . $money;
        if ($ucpass->templateSMS($appId, $to, $templateId, $param)) {
            return 100;
        } else {
            return 200;
        }
    }

    /**
     * 聚合短信
     */
    public function actionXin()
    {
        header('content-type:text/html;charset=utf-8');
        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
        $data = array(
            'mobile'    => '18341329120', //接受短信的用户手机号码
            'tpl_id'    => '94360', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.rand(10000,99999) ,//您设置的模板变量，根据实际情况修改
            'key'   => '546a5ca348513ea5e84600a82ee4052a', //您申请的APPKEY
        );
        /**聚合短信1**/
//        $postData = http_build_query($data);
//        $url = $sendUrl.'?'.$postData;
//        $result = file_get_contents($url);
//        print_r($result);exit;
        /***聚合短信2***/
        /*$result = Common::getRequest('post',$sendUrl,$data,1);
        print_r(json_decode($result,true));
        echo '<hr>';exit;*/
        /**聚合短信3**/
        $postData = http_build_query($data);
        $opts = array(
            'http'=>array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postData
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($sendUrl,false,$context);
        echo '<pre>';
        print_r(json_decode($result,true));
    }
    /**
     * 外盘期货
     */
    public function actionWp()
    {
        $pwd = md5('jgkwadwaKLsadF55dfgsd4fg');
        //$url = "http://api.lision.cn?user=zgduokong_com&pwd=$pwd&type=futures";
        $url = "http://ju.12315mq.com/wh/index.php?user=zgduokong_com&pwd=$pwd&type=futures";
        //$data = ['hf_hg'=>'COMEX铜','hf_cl'=>'NYMEX原油','hf_si'=>'COMEX白银','hf_gc'=>'COMEX黄金','hf_xau'=>'伦敦金','hf_xag'=>' 伦敦银'];
        $result = file_get_contents($url);
        print_r($result);exit;
    }

    /***
     * 外汇期货接口
     */
    public function actionTp()
    {
        $pwd = md5('jgkwadwaKLsadF55dfgsd4fg');
        //$pwd = md5('lision.cn');
        $url = "http://ju.12315mq.com/wh/index.php?user=zgduokong_com&pwd=$pwd&type=futures";
        //$url = "http://ju.12315mq.com/wh/index.php?user=lision&pwd=$pwd&type=hengsheng";
        //$data = array('list'=>"hf_CL,hf_GC,hf_SI,hf_HG,hf_EC,hf_AD,hf_CD,hf_BP");
        $data = array('list'=>"hf_FXA");
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
        echo '<pre>';
        print_r($res);exit;
    }
    public function actionTp1()
    {
        $pwd = md5('jgkwadwaKLsadF55dfgsd4fg');
        //$pwd = md5('lision.cn');
        $url = "http://yijuw.com.cn/stock.php?u=1q2w3e4r5t6y7u8i&type=stock&symbol=NECLA0,CMGCA0,CMSIA0,CMHGA0,CEDAXA0,HIHSIF,HIMHIF,WGCNA0,CENQA0,WICMBPA0,WICMECA0,WICMADA0,WICMCDA0,SCau0001,SCag0001,SCcu0001,SCni0001,SCbu0001,SCru0001,SCrb0001,DCp0001,ZCSR0001,DCm0001,DCy0001,DCpp0001";
        $res = file_get_contents($url);
        $ss = json_decode($res,true);
        echo '<pre>';
        print_r($ss);exit;
        //$url = "http://ju.12315mq.com/wh/index.php?user=lision&pwd=$pwd&type=hengsheng";
        //$data = array('list'=>"hf_CL,hf_GC,hf_SI,hf_HG,hf_EC,hf_AD,hf_CD,hf_BP");
        $data = array('list'=>"hf_FXA");
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
        echo '<pre>';
        print_r($res);exit;
    }
   /**
    *
    */
    public function actionKxt4()
    {
        $tdx = new Tdx();
        $tdx->queryHistoryData(0);
    }
    public function actionKxt3()
    {
        //0 资金1 股份2 当日委托3 当日成交4 可撤单
        $type = Yii::$app->request->get('type');
        $tdx = new Tdx();
        $res = $tdx->queryData($type);
        echo '<pre>';
        print_r($res);exit;
    }
    public function actionKxt2()
    {
        $tdx = new Tdx();
        $res = $tdx->cancelOrder('117','600006');
        echo '<pre>';
        print_r($res);exit;
    }
    public function actionKxt22()
    {
        $tdx = new Tdx();
        $tdx->cancelOrderEx('122','300004');
    }
    /**
     * 反馈可撤单的委托编号 根据这个字段查出个人拥有的订单
     * @return array
     */
    public function actionO()
    {

        $tdx = new Tdx();
        $res = $tdx->queryData(4);
        $rows = $res['data']['rows'];
        $orderNo = array();
        if(!empty($rows)){
            foreach ($rows as $list){
                $orderNo[] = $list['8'];
            }

            if(!empty($orderNo)){
                //$order = AdminOrder::find()->where(['status'=>1])->andWhere(['in','tdx_orderNo',$orderNo])->all();
                foreach ($orderNo as $k=>$value){
                    $order = AdminOrder::find()->where(['status'=>1])->andWhere(['tdx_orderNo'=>$value])->one();
                    $order->status = 4;
                    $order->save();
                }
            }
            echo '完成2';exit;
        }
        echo '完成';exit;
        //return $orderNo;
    }



    public function actionKxt()
    {
        $tdx = new Tdx();
        $res  = $tdx->SendOrder(1,0,600010,1.5,100);
        echo '<pre>';
        print_r($res);exit;
        // $tdx->SendOrder(0);
    }

    public function actionC()
    {
        $order = AdminOrder::find()->where(['id'=>8])->asArray()->one();
        //$order = AdminOrder::findOne(['id'=>1]);
        //$order = json_encode($order);
        echo '<pre>';
        $order['result'] = unserialize($order['result']);
        print_r($order);
    }
    public function actionCurl()
    {
        $s = '{"result":"1000","payAmount":"0.10","merchantId":"103189","sign":"3e7e0b8de3dcf47715f7ea97aeae3a81","successAmount":"0.10","transNo":"59913362","merchantOrderNo":"2018083111492312883","version":"1.0"}';
        $a = json_decode($s,true);
        ksort($a);
        $sing = http_build_query($a);
        print_r($sing);exit;
        echo '<hr>';
        $az = md5($sing);
        print_r(md5($az));

    }
}