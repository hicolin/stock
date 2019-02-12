<?php
namespace frontend\controllers;

use backend\models\AdminContent;
use backend\models\AdminFile;
use backend\models\AdminSort;
use common\models\Common;
use yii\data\Pagination;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AdminRegions;
use common\helps\Tools;

/**
 * Site controller
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "main";
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    //新闻列表页
    public function actionList()
    {
        //sortid =2,8
        $query = AdminContent::find()->where(['in' , 'sortid' , [2,8]]);
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $news = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("sorting asc,id desc")
            ->all();
        $this->getView()->title = '新闻列表';

        return $this->render('list', [
            'news' => $news,
            'pages' => $pagination,
        ]);

        //return $this->render('list');
    }
     
     //配资问答
     public function actionWenda(){
        $query = AdminContent::find()->where(['sortid'=>7]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => '10']);
        $wendas = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('addtime desc')
            ->all();
        $this->getView()->title = '配资问答';

        return $this->render('wenda',[
              'wendas'=>$wendas,
              'pages'=>$pagination,
            ]);
     }
     //股票资讯
     public function actionStock(){
        $query = AdminContent::find()->where(['sortid'=>2]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => '10']);
        $stock = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('addtime desc')
            
            ->all();
        $this->getView()->title = '股票资讯';

            return $this->render('stock',[
              'stock'=>$stock,
              'pages'=>$pagination,
            ]);

     }
     //行业资讯
     public function actionReports(){
        $query = AdminContent::find()->where(['sortid'=>8]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => '10']);
        $reports = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('addtime desc')
            
            ->all();
        $this->getView()->title = '行业资讯';

            return $this->render('reports',[
              'reports'=>$reports,
              'pages'=>$pagination,
            ]);

     }
     //网站公告
     public function actionAnnounce(){
        $query = AdminContent::find()->where(['sortid'=>11]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => '10']);
        $announce = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('addtime desc')
            
            ->all();
        $this->getView()->title = '网站公告';

            return $this->render('announce',[
              'announce'=>$announce,
              'pages'=>$pagination,
            ]);

     }
    //新闻详情页
    public function actionDetail()
    {
        $id = $_REQUEST['id'];
        $new = AdminContent::findOne($id);
        $sortid = $new->sortid;
        $left = $this->getLeftById($new->sortid);
        $next = AdminContent::find()->where('id<' . $id . ' and sortid = ' . $sortid)->orderBy('sorting ASC,id DESC')->one();//上一篇
        $prev = AdminContent::find()->where('id>' . $id . ' and sortid = ' . $sortid)->orderBy('sorting DESC,id ASC')->one();//下一篇
        $sort_name = AdminSort::findOne(['id' => $new->sortid])->name;
        $sort_id = AdminSort::findOne(['id' => $new->sortid])->id;
        $this->getView()->title = $new->title . '-' . Tools::getSetting(5);
        return $this->render('newsPage', [
            'new' => $new,
            'prev' => $prev,
            'next' => $next,
            'left' => $left,
            'sort_name' => $sort_name,
            'sort_id' => $sort_id,
        ]);
    }

    /**
     * 关于我们---详情页
     */
    public function actionAbout()
    {
        $this->getView()->title = Tools::getSetting(5).'-关于我们';
        $id = intval(Yii::$app->request->get('id'));
        $detail = AdminContent::findOne($id);
        return $this->render('about', [
            'detail' => $detail,
        ]);
    }

    //根据新闻分类id获取左侧导航分类
    public function getLeftById($id = '')
    {
        //获取分类id
        $sort = AdminSort::findOne($id);
        $sort_pre = AdminSort::findOne($sort->pid);
        //查找该分类的子分类
        //$left_list = AdminSort::find()->where(['pid'=>$sort_pre->id])->all();
        return AdminSort::find()->where(['pid' => $sort_pre->id])->all();
    }

    /**
     * 软件下载
     */
    public function actionDown()
    {
        $file = AdminFile::find()->all();
        return $this->render('down',[
            'file'=>$file
        ]);
    }

    /**
     * 帮助中心
     */
    public function actionHelp()
    {
        $id = Yii::$app->request->get('cid');
        $nav = AdminSort::find()->where(['pid' => 37])->all();
        $detail = AdminContent::find()->where(['sortid' => $id])->orderBy('addtime desc')->one();
        $this->getView()->title =Common::getSysInfo(5).'-帮助中心';
        return $this->render('help', [
            'nav' => $nav,
            'detail' => $detail,
            'id' => $id,
        ]);
    }



    /**
     * 交易规则
     */
    public function actionRules()
    {
        return $this->render('rules');
    }
    public function actionFile()
    {
        $result = Common::getJtApi('ReqCreateAccount');
        echo '<pre>';
        print_r($result);
    }
    /**
     * 测试吉投
     * @return string
     */
    public function actionJt()
    {
        header('content-type:text/html;charset=utf8');
        $type='ReqCreateAccount';
        switch($type){
            case 'ReqQryAccountInfo'; //查询账户信息
                $data['ChdAccountID'] = '101784003';//子账号编号
            break;
            case 'ReqCreateAccount';//请求创建子账户
                //$data['AccountID'] = '';//待开户子账号所属的母账号。（如果填空，将使用第一个母账号）
                //$data['ChdPassword'] = '';//待开户的子账号密码。（如果填空，则密码默认为123456）
                $data['ChdName'] = 'haotian';//待开户的子账号名称。（如果填空，那么名称和id相同）
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
        //print_r(rtrim($kk, '&'));exit;
        //$As=http_build_query($data);//在没有中文字符的情况下使用fou否则校验失败
        $data['UserKey'] = '6d070ade208eee3611e61daff27230fd';
        //$b = $As.'&UserKey='.$data['UserKey'];
        $dd = $kk.'UserKey='.$data['UserKey'];
        $sign = md5($dd);
        //$url = 'http://120.27.112.91:8082/AccMgrt.aspx?'.$As.'&Sign='.$sign;
        $url = 'http://120.27.112.91:8082/AccMgrt.aspx?'.$kk.'Sign='.$sign;
        $a=Common::getRequest('get',$url);
        $b = json_decode($a,true);
        echo '<pre>';
        print_r($b);exit;
    }
    public function actionTest()
    {
        $url='ecommprotect.huaweiapi.com';
        $header=array();
        $header[]='Content-Type: application/json; charset=UTF-8';
        $header[]='Authorization: WSSE realm="SDP", profile="UsernameToken", type="Appkey"';
        $header[]='X-WSSE: UsernameToken Username="6fc8e4d7c71a4f5b92fac91730d53978", PasswordDigest="CGPqwzhrXpLgoXz39aFLVaTu0Ow=", Nonce="ZUEySldxeWx2bGJXakVSQWF5M1Z1NUVVZw==", Created="2014-01-07T01:58:21Z"';
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$header);//设置头部和请求类型
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);//post传参
        //curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); //数组转换
        $output = curl_exec($curl);
        print_r($output);exit;
        $result=json_decode($output,true);
    }
}
