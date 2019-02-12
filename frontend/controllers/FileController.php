<?php
namespace frontend\controllers;
use backend\models\AdminFile;
use backend\models\AdminSort;
use common\helps\Tools;
use yii\data\Pagination;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AdminRegions;
/**
 * Site controller
 */
class FileController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "main";
    public $defaultAction='index';
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
    //下载页
    public function actionIndex()
    {
        $this->getView()->title = '下载中心-'.Tools::getSetting(5);
        $query = AdminFile::find();
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '12',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );
        $file = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("sort asc,file_id desc")
            ->all();
        //$file = AdminFile::find()->all();
        return $this->render('index',[
            'file'=>$file,
            'pages'=>$pagination,
        ]);
    }

    //下载
    public function actionDownload() {
        $file = Yii::$app->request->get('file_path');
        Tools::download($file);
        exit;
    }

}
