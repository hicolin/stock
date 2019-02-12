<?php

namespace frontend\controllers;


use backend\models\AdminContent;

use backend\models\AdminTixian;

use Yii;

use yii\helpers\Url;

use yii\data\Pagination;

use yii\web\Controller;

use common\models\Common;

use yii\filters\VerbFilter;

use yii\filters\AccessControl;

use backend\models\AdminRegions;

use backend\models\AdminMember;

use backend\models\AdminUserPeoduct;

use backend\models\AdminUser;

use backend\models\AdminStocks;

use backend\models\AdminOrder;

use backend\models\AdminSetting;

use common\helps\Tools;

use backend\models\AdminCharge;

use backend\models\AdminChargexx;

use common\utils\CommonFun;

use frontend\controllers\TestController;

use yii\web\UploadedFile;

use backend\models\AdminAccount;

use backend\controllers\PublicController;

/**
 * Site controller
 */
class IndexController extends Controller
{

    /**
     * @inheritdoc
     */

    public $layout = 'main';
    public $defaultAction = 'index';
    public $enableCsrfValidation = false;
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


    /** 注册
     * */
    public function actionRegister()
    {
        $set = AdminSetting::find()->where(['id' => 53])->one();
        if (Yii::$app->session['islogin']) {
            return $this->redirect(['/user/index']);
        } else {
            $user_model = new AdminMember();
            if (Yii::$app->request->post()) {
                //验证手机号是否已被注册
                $is_tel = $this->actionValidateTel(Yii::$app->request->post('tel'));
                $is_recode = $this->actionRegcode(Yii::$app->request->post('tel'), Yii::$app->request->post('vercode'));
                if ($is_tel == 300) {
                    return json_encode(array('status' => 'n', 'info' => '手机号码已存在'));
                }
                if ($is_recode == 200) {
                    return json_encode(array('status' => 'n', 'info' => '验证码不正确'));
                }
                $user_model->userspwd = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('pwd'));
                $user_model->usersname = Yii::$app->request->post('tel');
                $user_model->tel = Yii::$app->request->post('tel');
                $user_model->vatation_code = Common::getInvitation();
                $user_model->dates = time();
                if ($set['val'] == 1) {
                    $pid = AdminUser::find()->where(['vatation_code' => Yii::$app->request->post('vatation_code')])->one();
                    $user_model->vatation_code2 = strtoupper(Yii::$app->request->post('vatation_code'));
                } else {
                    $pid = AdminUser::findOne(156);
                    $user_model->vatation_code2 = $pid->vatation_code;
                }
                if (!$pid) {
                    return json_encode(array('status' => 'n', 'info' => '该邀请码不存在'));
                }
                $user_model->pid = $pid['id'];
                if ($user_model->validate() == true && $user_model->save()) {
                    return json_encode(array('status' => 'y', 'info' => '注册成功'));

                } else {
                    return json_encode(array('status' => 'y', 'info' => '注册失败'));
                }
            }
            $this->getView()->title = '用户注册-' . Common::getSysInfo(5);
            return $this->render('reg', [
                'model' => $user_model,
                'set' => $set['val'],
            ]);
        }
    }

    public function actionLogin()
    {
        $logo = AdminSetting::find()->where(['id' => 66])->one();
        if (Yii::$app->session['islogin']) {
            $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
            return $this->redirect(['user/index', ['onelist' => $onelist]]);
        } else {
            if (Yii::$app->request->post()) {
                $username = Yii::$app->request->post('usersname');
                $password = Yii::$app->request->post('password');
                $is_username = $this->actionRegusername($username);
                if ($is_username == 100) {
                    return json_encode(array('status' => 'n', 'info' => '手机号不存在'));
                }
                if (preg_match("/^1[34578]{1}\d{9}$/", $username)) {
                    $where = ['tel' => $username];
                } else {
                    $where = ['usersname' => $username];
                }
                $onelist = AdminMember::find()->where($where)->one();
                $hash_password = $onelist['userspwd'];
                $bool = Yii::$app->security->validatePassword($password, $hash_password);
                $history = Yii::$app->request->post('rb_name');
                if ($bool) {
                    AdminMember::updateAll(
                        ['logip' => CommonFun::getClientIp(), 'logdates' => time(), 'lognums' => $onelist['lognums'] + 1],
                        ['usersname' => $username]

                    );
                    $uid = $onelist['id'];
                    Yii::$app->session['islogin'] = 'true';
                    Yii::$app->session['user_id'] = $uid;
                    Yii::$app->session['id'] = $uid;
                    Yii::$app->session['tel'] = $onelist['tel'];
                    Yii::$app->session['username'] = $onelist['usersname'];
                    Yii::$app->session['nickname'] = $onelist['nickname'];
                    /**存缓存记住登录***/
                    if ($history == 1) {
                        setcookie('username', $username, time() + 86400 * 5, "/");
                        setcookie('password', $password, time() + 86400 * 5, "/");
                    } else {
                        setcookie('username', $username, time() - 3600, "/");
                        setcookie('password', $password, time() - 3600, "/");
                    }
                    return json_encode(array('status' => 'y', 'info' => '登录成功'));
                } else {
                    return json_encode(array('status' => 'n', 'info' => '登录失败,用户名或者密码错误'));
                }
            }
            $this->getView()->title = '用户登录-' . Common::getSysInfo(5);
            $username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
            $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
            return $this->render('login', [
                'username' => $username,
                'password' => $password,
            ]);

        }

    }


    public function actionFoundPass()
    {

        $logo = AdminSetting::find()->where(['id' => 66])->one();


        if (Yii::$app->session['islogin']) {

            $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

            // var_dump($onelist);

            return $this->redirect(['user/index', ['onelist' => $onelist]]);

        } else {


            $user_model = new AdminMember();

            if (Yii::$app->request->post()) {

                //验证手机号是否已被注册

                $username = Yii::$app->request->post('tel');

                $model = AdminMember::findOne(['usersname' => $username]);

                $model->userspwd = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('userspwd'));

                if ($model->save()) {

                    return 600;

                } else {

                    return 500;

                }

            }


            return $this->render('findpwd', [
                'logo' => $logo['val'],
            ]);

        }


    }


    /*
     * 检查用户名是否已存在
     * */
    public function actionRegusername($usersname = '')
    {
        $usersname = $usersname ?: Yii::$app->request->post('usersname');
        if (preg_match("/^1[34578]{1}\d{9}$/", $usersname)) {
            $where = ['tel' => $usersname];
        } else {
            $where = ['usersname' => $usersname];
        }
        $onelist = AdminMember::find()->where($where)->one();
        if ($onelist) {
            return 200;
            exit;
        } else {
            return 100;
            exit;
        }
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex()
    {
        $data = array('list' => 'sh000001,sz399001,sh000300');
        $title = Tools::getSetting('5');
        //最新公告
        //获取最近4条数据
        $zj_announcement = AdminContent::find()->andwhere(['sortid' => 11])->orderBy('addtime desc')->one();
        $stock_list = AdminContent::find()->andwhere(['sortid' => 8])->orderBy('addtime desc')->limit(10)->all();
        // var_dump($stock_list);exit;
        //获取添加时间
        $zj_add_time = $zj_announcement->addtime;
        //根据最近时间获取当天的时间范围
        $today_begin = strtotime(date('Y-m-d', $zj_add_time));
        $today_end = strtotime(date('Y-m-d', $zj_add_time)) + 24 * 60 * 60;
        $news_list['announcement'] = AdminContent::find()
            ->andwhere(['sortid' => 11])
            ->andWhere(['between', 'addtime', $today_begin, $today_end])
            ->orderBy('sorting ASC,id DESC')
            ->asArray()->all();
        //行业新闻
        $news_list['trade'] = AdminContent::find()
            ->where(['sortid' => 8])
            ->orderBy('sorting ASC,id DESC')
            ->offset(0)
            ->limit(3)
            ->asArray()
            ->all();
        //股票资讯
        $news_list['stock_list'] = AdminContent::find()
            ->where(['sortid' => 2])
            ->orderBy('sorting ASC,id DESC')
            ->offset(0)
            ->limit(10)
            ->asArray()
            ->all();
        $this->getView()->title = '首页';

        return $this->render('index', [
            'zj_announcement' => $zj_announcement,
            'news_list' => $news_list,
            'title' => $title,
            'code_list'=>$data,
        ]);
    }
    /**
     * 股票接口
     */
    public function actionGetGp()
    {
        $data = array('list' => 'sh000001,sz399001,sh000300');
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
        return $result;
    }

    /*

     * 持仓页面

     * 

     */

    public function actionInvest()

    {

        $id = Yii::$app->request->get('id');

        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

        $onestock = AdminStocks::find()->where(['id' => $id])->one();
        $this->getView()->title = Common::getSysInfo(5) . '-股票行情';
        return $this->render('invest', [

            'onelist' => $onelist,

            'onestock' => $onestock,

        ]);

    }


    /*

     * 返回信管家接口数据

     * */

    public static function actionXml($url)

    {

        //$url = 'https://106.15.47.118:13134/queryaccount?requestid=6&sa=dsf1110011001&sapass=967865&account=1110011107';

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_HEADER, 1);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        $data = curl_exec($curl);

        curl_close($curl);

        //返回结果写入xml文件并删除第一行

        file_put_contents('xml.xml', $data);

        $fn = "xml.xml";

        $f = fopen($fn, "r");

        $line = fgets($f);

        ob_start();

        fpassthru($f);

        fclose($f);

        file_put_contents($fn, ob_get_clean());

        //去除生成的xml文件前后空格

        $file_path = "xml.xml";

        if (file_exists($file_path)) {

            $fp = fopen($file_path, "r");

            $str = fread($fp, filesize($file_path));//指定读取大小，这里把整个文件内容读取出来

            $str = trim($str);

            file_put_contents($file_path, $str);

        }

        $xml = simplexml_load_file('xml.xml');

        $results = $xml->Result->Summary;

        //var_dump($results);exit;

        $arr = [];

        foreach ($results as $key => $value) {

            $arr[] = $value;

            // print_r($value);

        }

        return $arr[0];

        echo($arr[0]->Balance);
        exit;


        //var_dump($xml->Result->Summary);

        // var_dump($xml);

        //var_dump($data);

    }


    /*

     * 验证手机号码是否已被注册

     * */

    public function actionValidateTel()
    {
        $tel = Yii::$app->request->post('tel');
        if (!$tel) {
            $tel = Yii::$app->request->post('tel');
        }
        $model = AdminMember::findOne(['tel' => $tel]);
        if ($model) {
            return 300;
        } else {
            return 100;
        }
    }

    /*

  * 取现验证手机号码是否已绑定

  * */

    public function actionBankTel()
    {
        $tel = Yii::$app->request->post('tel');
        if (!$tel) {
            $tel = Yii::$app->request->post('tel');
        }
        $model = AdminMember::findOne(['bank_tel' => $tel]);
        if ($model) {
            //是该银行卡绑定手机号
            return 300;
            exit;
        } else {
            return 100;
            exit;

        }

    }

    /*

 * 短信验证是否通过

 * */

    public function actionRegcode($tel = '', $vercode = '')

    {

        $tel = $tel ?: yii::$app->request->post('tel');

        $vercode = $vercode ?: yii::$app->request->post('vercode');

        if ($tel != Yii::$app->session['code_tel']) {

            //不是当前手机号

            return 300;
            exit;

        }

        if (empty(Yii::$app->session['validate'])) {

            return 200;
            exit;

        } else if (!empty(Yii::$app->session['validate']) && Yii::$app->session['validate'] != $vercode) {

            return 200;
            exit;

        } else {

            return 100;
            exit;

        }

    }


    /*

     * 查找股票

     * */

    public function actionFindStocks()

    {


        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();

        $search = Yii::$app->request->post('search');
        // var_dump($search);exit;

        if ($search) {


            if (strlen($search) > 10) {

                $tmp = explode(' ', $search);

                $search = $tmp[0];

            }

            $condition = "`status`='1' and `display`='1' ";

            if ($search) {

                $condition .= " and (`code` LIKE '{$search}%' or `name` LIKE '%{$search}%')";

            }

            $page = Yii::$app->request->get('page') ? Yii::$app->request->get('page') : "1";


            $list = AdminStocks::find()->where($condition);

            $pages = new Pagination(['totalCount' => $list->count(), 'pageSize' => '12']);

            $data = $list->offset($pages->offset)->limit(6)->orderBy(`recom DESC`)->asArray()->all();
            // var_dump($data);exit;

            foreach ($data as $k => $v) {

                if ($v['cid'] == 118) {

                    $marketlist .= 'sh' . $v['code'] . ',';

                } else {

                    $marketlist .= 'sz' . $v['code'] . ',';

                }


            }

            $marketlist = substr($marketlist, 0, strlen($marketlist) - 1);

            // var_dump($data);exit;


            // $html = $this->render('stocks',['data'=>$data,'pages'=>$pages,'marketlist'=>$marketlist,'onelist'=>$onelist]);

            // if($data){

            //        $ajax = array(

            //                             "status" => 1,

            //                             "html" => $html,

            //                             "_thisPages" => $page,

            //                             "marketlist" => $marketlist,

            //                             // "thisUrl" =>  $this->render('stocks',['data'=>$data,'pages'=>$pages,'marketlist'=>$marketlist,'onelist'=>$onelist]),

            //                         );

            //         }else{

            //             $ajax=array(

            //                "status" => 0,

            //             );

            //         }


            // return $data;
            return json_encode($data);

        }

    }

    public function actionStocks()
    {

        $onelist = AdminMember::find()->where(['usersname' => Yii::$app->session['username']])->one();
        $dj_m = AdminTixian::find()->where(['users_id' => Yii::$app->session['user_id']])->andWhere(['state' => 0])->select('sum(money) as money')->asArray()->one();
        $profit = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->andWhere(['status' => 1])->select('sum(profit) as profit')->asArray()->one();
        $title = Tools::getSetting('5');
        $holdings = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->andWhere(['status' => 1])->all();
        foreach ($holdings as $m => $n) {

            $code .= $n['goods_code'] . ',';
            $arr_hander[] = $n['order_hander'];
        }
        $codes = array('list' => $code);
        $res = Common::getGp($codes);
        $resarr = $res['data'];
        foreach ($resarr as $q => $w) {
            $arr_price[] = floatval($w['new_price']);
        }
        $z = 0;
        foreach ($arr_hander as $k => $val) {
            $z += $val * $arr_price[$k];
        }
        //保证金
        $bzj_m = AdminOrder::find()->where(['user_id' => Yii::$app->session['user_id']])->select('sum(total) as total')->asArray()->one();
        //动态资产
        $dt_m = floatval($onelist->money) + floatval($bzj_m['total']) * 12.5 / 100 + floatval($profit['profit']) + floatval($dj_m['money']);
        $page = Yii::$app->request->get('page') ? Yii::$app->request->get('page') : "1";
        $lists = AdminStocks::find()->where(['status' => 1]);
        $pages = new Pagination(['totalCount' => $lists->count(), 'pageSize' => '11']);    //实例化分页类,带上参数(总条数,每页显示条数)
        // var_dump($pages);exit;
        $datas = $lists->offset($pages->offset)->limit($pages->limit)->orderBy(`recom DESC`)->where('status', 1)->all();

        foreach ($datas as $k => $v) {

            if ($v['cid'] == 118) {

                $marketlist .= 'sh' . $v['code'] . ',';

            } else {

                $marketlist .= 'sz' . $v['code'] . ',';

            }

        }

        $marketlist = substr($marketlist, 0, strlen($marketlist) - 1);
        $time = mktime(0,0,0,date('m'),date('d'),date('y'));//当天凌晨
        $jS = AdminOrder::find()->andWhere(['status'=>1,'user_id'=>Yii::$app->session['user_id']])->andWhere(['<','begin_time',$time])->select('sum(day_dy) as dy, sum(day_yk) as yk')->asArray()->one();
        if($jS['yk']>0){
            $syBzj =  $onelist->money-$jS['dy'];
        }else{
            $syBzj =  $onelist->money-$jS['dy']+$jS['yk'];
        }
        return $this->render('stocks', ['data' => $datas, 'pages' => $pages, 'marketlist' => $marketlist, 'title' => $title, 'onelist' => $onelist, 'dj_m' => $dj_m, 'profit' => $profit, 'z' => $z, 'dt_m' => $dt_m, 'jS'=>$jS,
            'syBzj'=>$syBzj,]);
    }


    public function actionMessage()
    {
        // var_dump(Yii::$app->session['validate']);
        // var_dump(Yii::$app->session['code_tel']);exit;

        $tel = Yii::$app->request->post('tel');
        $mobile_code = rand(100000, 999999);
        $res = Common::setCode($tel, $mobile_code);
        if ($res == 200) {
            echo "发送成功！";
            Yii::$app->session['validate'] = $mobile_code;
            Yii::$app->session['code_tel'] = $tel;
            exit();
        } else {
            echo '发送失败，请联系管理员';
            exit();
        }
    }

    /**
     * 后台登录
     */
    public function actionBLogin()
    {

        $key = Common::getSysInfo(73);
        $post = Yii::$app->request->get();
        $id = $post['id'];
        $uid = $post['uid'];
        $sing = $post['sign'];
        $val = $uid . $key;
        $singz = md5($val);
        $member = AdminMember::findOne($id);
        if ($member) {
            Yii::$app->session['islogin'] = 'true';
            Yii::$app->session['user_id'] = $member->id;
            Yii::$app->session['id'] = $member->id;
            Yii::$app->session['tel'] = $member->tel;
            Yii::$app->session['username'] = $member->usersname;
            Yii::$app->session['nickname'] = $member->nickname;
            echo '<script>window.location.href="http://www.xinniuniu.cn";</script>';
            exit;
            return json_encode(['status' => 200, 'msg' => '登陆成功，即将跳转。。。']);
        }
        /**********需要完善*****/
        /*if($sing != $singz){ //验证失败
            return json_encode(['status'=>100,'msg'=>'验证失败']);
        }else{
            $member = AdminMember::findOne($id);
            if($member){
                Yii::$app->session['islogin'] = 'true';
                Yii::$app->session['user_id'] = $member->id;
                Yii::$app->session['id'] = $member->id;
                Yii::$app->session['tel'] = $member->tel;
                Yii::$app->session['username'] = $member->usersname;
                Yii::$app->session['nickname'] =$member->nickname;
                echo '<script>window.location.href="http://www.xinniuniu.cn";</script>';exit;
                return json_encode(['status'=>200,'msg'=>'登陆成功，即将跳转。。。']);
            }
            return json_encode(['status'=>100,'msg'=>'操作有误']);
        }*/
    }

    public function actionTi()
    {
        $detail = AdminContent::find()->where(['sortid' => 45])->orderBy('addtime desc')->one();
        return $this->render('tishi',compact('detail'));
    }

}

