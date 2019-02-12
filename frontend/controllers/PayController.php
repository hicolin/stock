<?php
namespace frontend\controllers;
use backend\models\AdminCharge;
use backend\models\AdminMember;
use backend\models\AdminOrders;
use Faker\Provider\at_AT\Payment;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use huanxun\models\Huanxun;
/**
 * Site controller
 */

class PayController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false ;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
    public function actionPay()
    {
        include_once dirname(__FILE__)."./Pay.class.php";
        $order_id=Yii::$app->request->get('id');
        $data=AdminCharge::findOne($order_id);
        if($data && $data->state==0){

            $return = Yii::$app->urlManager->createAbsoluteUrl(['pay/return']);
            $notify = Yii::$app->urlManager->createAbsoluteUrl(['pay/notify']);
            $fail = Yii::$app->urlManager->createAbsoluteUrl(['pay/fail']);

            $info['InMerCode'] = '208801';
            $info['InAccount'] = '2088010018';
            $info['InMerName'] = '';
            $info['InVersion'] = 'v1.0.0';
            $info['InMerBillNo'] = $data->pay_ordersid;
            $info['selPayType'] = '01';
            $info['InDate'] = date('Ymd');
            $info['InAmount'] = $data->money;
            $info['InReturnUrl'] = $return;
            $info['InFailUrl'] = $fail;
            $info['selRetEncodeType'] = "17";
            $info['InServerUrl'] = $notify;
            $info['selIsCredit'] = '';
            $info['InGoodsName'] = '余额';
            $info['selProductType'] = '1';
            $info['InAttach'] = $data->id;
            $url = 'http://zjpro.boheng100.com/ips/IpsPayApi.php';
            $this->build_form($url,$info);
        }else{
            print_r('系统错误');
        }
    }
    /**
     * 创建&提交FORM表单
     * @param string $url 需要提交到的地址
     * @param array $data 需要提交的数据
     * @return void
     * @author chunkuan <urcn@qq.com>
     */
    public function build_form($url, $data){

        $sHtml = "<!DOCTYPE html><html><head><title>Waiting...</title>";
        $sHtml.= "<meta http-equiv='content-type' content='text/html;charset=utf-8'></head>
      <body><form id='lakalasubmit' name='yeepay' action='".$url."' method='post'>";
        foreach($data as $key => $value){
            $sHtml.= "<input type='hidden' name='".$key."' value='".$value."' style='width:90%;'/>";
        }
        // echo  $sHtml; exit;
        $sHtml .= "</form>正在提交订单信息...";
        $sHtml .= "<script>document.forms['lakalasubmit'].submit();</script></body></html>";
        exit($sHtml);
    }

    public function actionNotify(){
        include_once dirname(__FILE__)."./../../ips/IpsPay.Config.php";
        include_once dirname(__FILE__)."./../../ips/lib/IpsPayNotify.class.php";
        $ipspayNotify = new \IpsPayNotify($ipspay_config);
        $verify_result = $ipspayNotify->verifyReturn();
        /***
        商户在处理数据时一定要按照文档中’交易返回接口验证事项‘进行判断处理
        1：先判断签名验证是否正确
        2：判断交易状态
        3：判断订单交易时间，订单号，金额，订单状态，和订单防重处理
         **/
        file_put_contents("hxlog2.txt", "验签成功".PHP_EOL, FILE_APPEND);
        file_put_contents("hx2.txt",json_encode($_REQUEST));
        if ($verify_result) { // 验证成功
            //请商户根据自己的业务逻辑进行数据处理操作。
            file_put_contents("hxlog.txt", "验签成功".PHP_EOL, FILE_APPEND);
            file_put_contents("hx.txt",json_encode($_REQUEST));
            if (isset($_POST["paymentResult"])){
                $paymentResult = $_POST["paymentResult"];//获取信息
                file_put_contents("zzz.txt",$_POST["paymentResult"]);
                //$xml=simplexml_load_string($paymentResult,'SimpleXMLElement', LIBXML_NOCDATA);
                $xmlResult = new \SimpleXMLElement($paymentResult);
                $MerBillNo = $xmlResult->GateWayRsp->body->MerBillNo;//传过去的订单号
                $IpsTradeNo = $xmlResult->GateWayRsp->body->IpsTradeNo;//返回的商户订单号
                //请商户根据自己的业务逻辑进行数据处理操作。
                $recharge = AdminCharge::find()->where(['pay_ordersid'=>$MerBillNo])->one();
                if($recharge && $recharge->state==0){
                    file_put_contents("hxlog.txt", "订单存在，进行状态修改".PHP_EOL, FILE_APPEND);
                    $recharge->state = 1;
                    $recharge->order_no = $IpsTradeNo;
                    $member = AdminMember::findOne($recharge->users_id);
                    $member->money += $recharge->money;
                    file_put_contents("333.txt",json_encode($recharge));
                    $tran = Yii::$app->db->beginTransaction();
                    try{
                        $recharge->save(false);
                        $member->save();
                        $tran->commit();
                        file_put_contents("hxlog.txt", "订单状态修改成功".PHP_EOL, FILE_APPEND);
                    }catch(Exception $e){
                        $tran->rollBack();
                        file_put_contents("hxlog.txt", "订单状态修改失败".PHP_EOL, FILE_APPEND);
                    }
                }else{
                    file_put_contents("hxlog.txt", "订单不存在".PHP_EOL, FILE_APPEND);
                }
            }
            echo "ipscheckok";
        } else {
            file_put_contents("hxlog.txt", "验签失败".PHP_EOL, FILE_APPEND);
            echo "ipscheckfail";
        }
    }
    public function actionReturn(){
        include_once dirname(__FILE__)."./../../ips/IpsPay.Config.php";
        include_once dirname(__FILE__)."./../../ips/lib/IpsPayNotify.class.php";
        $ipspayNotify = new \IpsPayNotify($ipspay_config);
        $verify_result = $ipspayNotify->verifyReturn();
        /***
        商户在处理数据时一定要按照文档中’交易返回接口验证事项‘进行判断处理
        1：先判断签名是否正确
        2：判断交易状态
        3：判断订单交易时间，订单号，金额，订单状态，和订单防重处理
         **/
        if ($verify_result) { // 验证成功
            $paymentResult = $_REQUEST['paymentResult'];
            //$xmlResult = new SimpleXMLElement($paymentResult);
            $xmlResult = new \SimpleXMLElement($paymentResult);
            $status = $xmlResult->GateWayRsp->body->Status;
            if ($status == "Y") {
                $merBillNo = $xmlResult->GateWayRsp->body->MerBillNo;
                $ipsBillNo = $xmlResult->GateWayRsp->body->IpsBillNo;
                $ipsTradeNo = $xmlResult->GateWayRsp->body->IpsTradeNo;
                $bankBillNo = $xmlResult->GateWayRsp->body->BankBillNo;
                $message = "交易成功";
                return $this->redirect(['member/trading']);
            }elseif($status == "N")
            {
                $message = "交易失败";
            }else {
                $message = "交易处理中";
            }
        } else {
            $message = "验证失败";
        }

        file_put_contents("rz.txt",$message.PHP_EOL,FILE_APPEND);
    }
    public function actionFail(){
        echo 4;exit;
    }

}
