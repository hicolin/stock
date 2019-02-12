<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminSlides;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminSlidesController implements the CRUD actions for AdminSlides model.
 */
class AdminSlidesController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "lte_main";
    public $enableCsrfValidation = false;

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
     * Lists all AdminSlides models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminSlides::find();
        $querys = Yii::$app->request->get('query');
        if (count($querys) > 0) {
            if($querys['slide_id']){
                $query = $query->andWhere(['slide_id' => $querys['slide_id']]);
            }
            if($querys['slide_cid']){
                $query = $query->andWhere(['slide_cid' => $querys['slide_cid']]);
            }
            if($querys['slide_name']){
                $query = $query->andWhere(['like','slide_name',$querys['slide_name']]);
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
            'query' => $querys,
        ]);
    }

    /**
     * Displays a single AdminSlides model.
     * @param string $id
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
     * Creates a new AdminSlides model.
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
        $model = new AdminSlides();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->slide_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminSlides model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
            return $this->redirect(['view', 'id' => $model->slide_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminSlides model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
            $c = AdminSlides::deleteAll(['in', 'slide_id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    public function actionUpload()
    {
        $uploaddir = 'backend/web/plugins/uploads/';
        $info = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $dir = $uploaddir . date('Ymd') . time() . '.' . $info;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $dir)) {
            $re['dir'] = '/' . $dir;
            $re['msg'] = "上传成功";
            $re['status'] = 200;
            echo json_encode($re);
        } else {

            $re['msg'] = "上传失败";
            echo json_encode($re);
        }
    }

    /**
     * Finds the AdminSlides model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminSlides the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminSlides::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
