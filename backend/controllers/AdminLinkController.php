<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminLink;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminLinkController implements the CRUD actions for AdminLink model.
 */
class AdminLinkController extends Controller
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
     * Lists all AdminLink models.
     * @return mixed
     */
    //友情链接
    public function actionIndex()
    {
        $query = AdminLink::find()->andWhere(['link_type'=>1]);
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '10',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );
        $model = $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy("id desc")
            ->all();
        return $this->render('index', [
            'model' => $model,
            'pages'=>$pagination,
        ]);
    }

    //合作伙伴
    public function actionList()
    {
        $query = AdminLink::find()->andWhere(['link_type'=>2]);
        $querys='';
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
     * Displays a single AdminLink model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $link_type=$model->link_type;
        if($link_type==1) {
            $view = 'index';
        } else {
            $view = 'list';
        }
        return $this->render('view', [
            'model' => $model,
            'view' => $view,
        ]);

    }

    /**
     * Creates a new AdminLink model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $link_type = $_REQUEST['link_type'];
        if ($link_type == 1) {
            $view = 'index';
        } else {
            $view = 'list';
        }
        $model = new AdminLink();
        $model->link_type = $link_type;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([$view, 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'view' => $view,
            ]);
        }
    }

    /**
     * Updates an existing AdminLink model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->link_image;
        //var_dump($model);exit;
        $link_type=$model->link_type;
        if($link_type==1) {
            $view = 'index';
        } else {
            $view = 'list';
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([$view, 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'view' => $view,
                'image' => $image,
            ]);
        }
    }

    /**
     * Deletes an existing AdminLink model.
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
            $c = AdminLink::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminLink model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminLink the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminLink::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
