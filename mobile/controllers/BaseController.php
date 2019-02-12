<?php
/**
 * User: Colin
 * Time: 2019/1/21 13:59
 */

namespace mobile\controllers;


use yii\helpers\VarDumper;
use yii\web\Controller;
use Yii;
class BaseController extends Controller
{
    /**
     * ajax 返回json数据
     * @param $status
     * @param $msg
     * @param string $data
     * @return string
     */
    public function json($status, $msg, $data = '')
    {
        if ($data) {
            return json_encode(['status' => $status, 'msg' => $msg, 'data' => $data]);
        } else {
            return json_encode(['status' => $status, 'msg' => $msg]);
        }
    }

    /**
     * 调试函数（语法高亮 | 格式化输出）
     * @param $param
     */
    public static function dd($param)
    {
        VarDumper::dump($param, 10, true);
        exit;
    }

    /**
     * 验证码检测
     * @param $tel
     * @return string
     */
    public function checkSms($tel)
    {
        if ($tel != Yii::$app->session['sendTel'] || $tel != Yii::$app->session['sendCode']) {
            return $this->json(100, '手机号或验证码不正确');
        }
        if (time() > Yii::$app->session['expTime']) {
            return $this->json(100, '验证码已失效，请重新获取');
        }
    }

    /**
     * 设置登录状态
     * @param $userId
     */
    public function setLogin($userId)
    {
        Yii::$app->session['isLogin'] = 1;
        Yii::$app->session['userId'] = $userId;
    }

    /**
     * 获取指数信息
     * @return bool|string
     */
    public function getGp()
    {
        $data = array('list' => 'sh000001,sz399001,sh000300');
        $url = 'http://api2.jinpinzhibo.com/goods.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40&show=json';
        $postData = http_build_query($data);
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postData,
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    }


}