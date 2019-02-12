<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminSlideCats;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminSlideCatsController implements the CRUD actions for AdminSlideCats model.
 */
class AdminSlideCatsController extends Controller
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
     * Lists all AdminSlideCats models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminSlideCats::find();
        $querys = Yii::$app->request->get('query');
        if (count($querys) > 0) {
            if($querys['cid']){
                $query = $query->andWhere(['cid' => $querys['cid']]);
            }
            if($querys['cat_name']){
                $query = $query->andWhere(['like','cat_name',$querys['cat_name']]);
            }
            if($querys['cat_idname']){
                $query = $query->andWhere(['like','cat_idname',$querys['cat_idname']]);
            }
        }
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

    /**
     * Displays a single AdminSlideCats model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /**检查权限--start**/
        $route = $this->route;
        $system_rights = Yii::$app->user->identity->getSystemRights();
        $loginAllowUrl = ['site/index', 'site/logout', 'site/psw', 'site/psw-save'];
        if(in_array($route, $loginAllowUrl) == false){

            if((empty($system_rights) == true || empty($system_rights[$route]) == true)){

                Yii::$app->session->setFlash('error','抱歉,您没有权限这么做');
                return $this->redirect(['index']);
            }
        }
        /**检查权限--end**/
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new AdminSlideCats model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /**检查权限--start**/
        $route = $this->route;
        $system_rights = Yii::$app->user->identity->getSystemRights();
        $loginAllowUrl = ['site/index', 'site/logout', 'site/psw', 'site/psw-save'];
        if(in_array($route, $loginAllowUrl) == false){

            if((empty($system_rights) == true || empty($system_rights[$route]) == true)){

                Yii::$app->session->setFlash('error','抱歉,您没有权限这么做');
                return $this->redirect(['index']);
            }
        }
        /**检查权限--end**/
        $model = new AdminSlideCats();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminSlideCats model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /**检查权限--start**/
        $route = $this->route;
        $system_rights = Yii::$app->user->identity->getSystemRights();
        $loginAllowUrl = ['site/index', 'site/logout', 'site/psw', 'site/psw-save'];
        if(in_array($route, $loginAllowUrl) == false){

            if((empty($system_rights) == true || empty($system_rights[$route]) == true)){

                Yii::$app->session->setFlash('error','抱歉,您没有权限这么做');
                return $this->redirect(['index']);
            }
        }
        /**检查权限--end**/
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminSlideCats model.
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
        /**检查权限--start**/
        $route = $this->route;
        $system_rights = Yii::$app->user->identity->getSystemRights();
        $loginAllowUrl = ['site/index', 'site/logout', 'site/psw', 'site/psw-save'];
        if(in_array($route, $loginAllowUrl) == false){

            if((empty($system_rights) == true || empty($system_rights[$route]) == true)){

                echo 'prohibit';
                exit;
            }
        }
        /**检查权限--end**/
        if (count($ids) > 0) {
            $c = AdminSlideCats::deleteAll(['in', 'cid', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminSlideCats model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminSlideCats the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminSlideCats::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
