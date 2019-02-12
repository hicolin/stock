<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminSort;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminSortController implements the CRUD actions for AdminSort model.
 */
class AdminSortController extends Controller
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
     * Lists all AdminSort models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new AdminSort();
        $list = $model->getOptions2();
        return $this->render('index', [
            'model2' => $list,
        ]);
    }

    /**
     * Displays a single AdminSort model.
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
     * Creates a new AdminSort model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminSort();

        if ($model->load(Yii::$app->request->post())) {
            $model->addtime = time();
            $parent = $model->find()->where(array('id' => $model->pid))->one();
            if ($parent == null) {
                $model->level = 1;
            } else {
                $model->level = $parent->level + 1;
            }


            if ($model->validate() && $model->save()) {
                return $this->redirect(['index']);
            } else {

//处理报错
                var_dump($model->getErrors());
            }
        } else {
            $id = Yii::$app->request->get('id');
            if (!empty($id)) {
                $pid = $id;
            } else {
                $pid = 0;
            }
            return $this->render('create', [
                'model' => $model,
                'tree' => $model->getOptions2(),
                'pid' => $pid,
                'test' => "分类列表"
            ]);
        }
    }

    /**
     * Updates an existing AdminSort model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $parent = $model->find()->where(array('id' => $model->pid))->one();
            $son = $model->find()->where(array('pid' => $model->id))->all();

            if ($parent == null) {
                $model->level = 1;
            } else {
                $model->level = $parent->level + 1;
            }
            if ($son != null) {
                $this->UpdateSonLev($model->id, $model->level);
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'tree' => $model->getOptions2()
            ]);
        }
    }

    /**
     * Deletes an existing AdminSort model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionDelrecord()
    {
        $id = Yii::$app->request->get('id');
        $model = new AdminSort();
        $cate = $model->findOne($id);
        $check = $model->find()->where(array('pid' => $id))->all();
        if (empty($check)) {
            $c = AdminSort::findOne($id)->delete();
            if ($c) {
                echo json_encode(array('status' => 1, 'msg' => "删除成功!"));
            }
        } else {
            echo json_encode(array('status' => 0, 'msg' => $cate['name'] . " " . " 不是末级分类或该分类下有内容,您不能删除!"));
        }
    }

    /**
     * Finds the AdminSort model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminSort the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminSort::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function UpdateSonLev($pid, $lev)
    {
        $model = new AdminSort();
        $son = $model->find()->where(array('pid' => $pid))->all();
        if ($son != null) {
            foreach ($son as $k => $v) {
                $update = $model->findOne($v->id);
                $update->level = $lev + 1;
                $update->save(false);
                $son2 = $model->findone($v->id);
                $this->UpdateSonLev($son2->id, $son2->level);
            }
        }
    }


}
