<?php

namespace backend\controllers;

use backend\models\AdminCat;
use Yii;
use backend\models\AdminProduct;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminProductController implements the CRUD actions for AdminProduct model.
 */
class AdminProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "lte_main";

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
     * Lists all AdminProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminProduct::find()->joinWith('cat');
        $querys='';
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '15',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );
        $model = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'model' => $model,
            'pages'=>$pagination,
            'query'=>$querys,

        ]);
    }

    public function actionList()
    {
        $query = AdminProduct::find()->andWhere(['cat_id'=>2]);
        $querys='';
        /*$querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
            $uname = $querys['uname'];
            if($uname){
                $query = $query->andWhere(['like','uname',$uname]);
            }
        }*/
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '10',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );
        $model = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("id desc")
            ->all();
        return $this->render('list', [
            'model' => $model,
            'pages'=>$pagination,
            'query'=>$querys,

        ]);
    }

    /**
     * Displays a single AdminProduct model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->cat_id = AdminCat::findOne(['id'=>$model->cat_id])->name;
        return $this->render('view', [
            'model' => $model,
        ]);

    }

    /**
     * Creates a new AdminProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $cat = new AdminCat();
        $cid = $_REQUEST['cid'];
        if ($cid == 1) {
            $view = 'index';
        } else {
            $view = 'list';
        }
        $model = new AdminProduct();
        $model->cat_id = $cid;
        $model->in_time = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([$view, 'id' => $model->id]);
        } else {
            $id=Yii::$app->request->get('id');
            if(!empty($id)){
                $pid=$id;
            }else{
                $pid=0;
            }
            return $this->render('create', [
                'model' => $model,
                'tree' => $cat->getOptions2(),
                'pid' => $pid,
            ]);
        }
    }

    /**
     * Updates an existing AdminProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $cat = new AdminCat();
        /*$cid = $_REQUEST['cid'];
        if ($cid == 1) {
            $view = 'index';
        } else {
            $view = 'list';
        }*/
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tree' => $cat->getOptions2(),
            ]);
        }
    }

    /**
     * Deletes an existing AdminProduct model.
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
            $c = AdminProduct::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminProduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
