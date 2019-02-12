<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminContent;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\models\AdminSort;

/**
 * AdminContentController implements the CRUD actions for AdminContent model.
 */
class AdminContentController extends Controller
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
     * Lists all AdminContent models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query = AdminContent::find();
        $querys = Yii::$app->request->get('query');
        if (count($querys) > 0) {
            $title = $querys['title'];
            $cid = $querys['cid'];

            if ($title) {
                $query = $query->andWhere(['like', 'title', $title]);
            }
            if($cid){
                $query = $query->andWhere(['sortid'=>$cid]);
            }

        }
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("sorting asc,id desc")
            ->all();
        $cat=new AdminSort();
        $list=$cat->getOptions4();

        return $this->render('index', [
            'model' => $products,
            'pages' => $pagination,
            'query' => $querys,
            'cat' => $list,
        ]);
    }

    /**
     * Displays a single AdminContent model.
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
     * Creates a new AdminContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminContent();
        $model2 = new AdminSort();
        if ($model->load(Yii::$app->request->post())) {
            $model->contact = htmlspecialchars_decode(Yii::$app->request->post('contact'));
            if ($model->validate() == true && $model->save()) {
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'tree' => $model2->getOptions3(),
            ]);
        }
    }

    /**
     * Updates an existing AdminContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model2 = new AdminSort();
        if ($model->load(Yii::$app->request->post())) {
            $model->contact = htmlspecialchars_decode(Yii::$app->request->post('contact'));
            if ($model->validate() == true && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'tree' => $model2->getOptions3(),
            ]);
        }
    }

    /**
     * Deletes an existing AdminContent model.
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
            $c = AdminContent::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }


    //批量置顶操作
    public function actionIstop(array $ids)
    {
        $judge = $_GET['judge'];
        if (count($ids) > 0) {
            $c = AdminContent::updateAll(["top" => $judge], ['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    //批量推荐操作
    public function actionRecommend(array $ids)
    {
        $judge = $_GET['judge'];
        if (count($ids) > 0) {
            $c = AdminContent::updateAll(["recommend" => $judge], ['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    //批量修改排序操作
    public function actionSort()
    {
        $query = AdminContent::find()->all();
        //print_r($query);exit;
        $provicelist = "";
        foreach ($query as $item) {
            $arr = $item->attributes;
            $id = $arr["id"];
            $sorting = "sorting" . $arr["id"];
            $provicelist = $_POST["$sorting"];
            if ($provicelist) {
                AdminContent::updateAll(["sorting" => $provicelist], "id=$id");
            }
        }
        return $this->redirect(['index']);
    }

}
