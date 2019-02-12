<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminSetting;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminSettingController implements the CRUD actions for AdminSetting model.
 */
class AdminSettingController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "lte_main";
    public $enableCsrfValidation = false ;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminSetting models.
     * @return mixed
     */
    public function actionIndex1()
    {
        $query = AdminSetting::find();
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'model' => $products,
            'pages' => $pagination,
        ]);
    }

    public function actionIndex()
    {
        $type = yii::$app->request->get('id')?:2;
        $query = AdminSetting::find();
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page',
            ]
        );
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        // var_dump($products);exit;
        $setting['1'] = '网站设置';
        $setting['2'] = '站点信息';
        $setting['3'] = '平台管理员信息';
        $setting['4'] = '图片信息';
        $setting['5'] = '轮播图';
        $setting['6'] = '短信配置';
        $setting['7'] = '支付配置';
        $setting['8'] = '邮箱配置';
        $model = AdminSetting::find()->andWhere(['type'=>$type])->orderBy('id asc')->asArray()->all();
        foreach ($model as $k=> $arr) {
            $list[$arr['type']][] = $arr;
        }
        $model63 = AdminSetting::findOne(63);
        // var_dump($list);exit;

        return $this->render('index', [
            'list' => $list,
            'setting' => $setting,
            'products' => $products,
            'pages' => $pagination,
            'type' => $type,
            'model63'=>$model63,
        ]);
    }
    /**
     * Displays a single AdminSetting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new AdminSetting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $setting['1'] = '配资额度设置';
        $setting['2'] = '站点信息';
        $setting['3'] = '平台管理员信息';
        $setting['4'] = '图片信息';
        $setting['5'] = '轮播图';
        $setting['6'] = '短信配置';
        $setting['7'] = '支付配置';
        $setting['8'] = '邮箱配置';
        $model = new AdminSetting();
        if($model->load(Yii::$app->request->post())) {

        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','id'=>$model->type]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'setting' => $setting,
            ]);
        }
    }

    /**
     * Updates an existing AdminSetting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminSetting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDelrecord(array $ids)
    {
        if (count($ids) > 0) {
            $c = AdminSetting::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminSetting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminSetting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminSetting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //ajax修改信息
    public function actionAjaxUpdate() {
        $id = yii::$app->request->post('id');
        $val = yii::$app->request->post('val');
        $key = yii::$app->request->post('field');

        $model = AdminSetting::findOne($id);
        $model->$key=$val;
        if($model->save()) {
            echo 1;
        }
    }
    /**
     * 修改支付状态
     * @return \yii\web\Response
     */
    public function actionPayUpdate()
    {
        $val = Yii::$app->request->post('val');
        $id = Yii::$app->request->post('id');
        $model = AdminSetting::findOne($id);
        $model->val = $val;
        if($model->save()){
            return 1;
        }
    }

    //编辑图片
    public function actionChangeImg()
    {
        $id = Yii::$app->request->post('img_id');
        $uploaddir = 'backend/web/plugins/uploads/';
        $info=pathinfo($_FILES['ewm']['name'],PATHINFO_EXTENSION);
        $dir=$uploaddir .date('Ymd').rand(10000,99999).'.'.$info;
        if (move_uploaded_file($_FILES['ewm']['tmp_name'],$dir)) {
            $re['dir']='/'.$dir;
            $re['msg']="上传成功";
            $re['status']=200;
            $model = AdminSetting::findOne($id);
            $model->val=$re['dir']='/'.$dir;
            if($model->save(false)) {
                return $this->redirect(['admin-setting/index']);
            }
        } else {
            $re['msg']="上传失败";
            echo json_encode($re);
        }
    }
}
