<?php

namespace backend\controllers;

use backend\models\AdminAccount;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use backend\models\AdminUser;
use yii\web\Controller;

/**
 * AdminAccountController implements the CRUD actions for AdminAccount model.
 */
class AdminAccountController extends BaseController
{
	public $layout = "lte_main";
    public $enableCsrfValidation = false;
    /**
     * Lists all AdminAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminAccount::find();
        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '10', 
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );
        $model = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('created_time DESC')
            ->all();
        return $this->render('index', [
            'model'=>$model,
            'pages'=>$pagination,
        ]);
    }

    /**
     * Displays a single AdminAccount model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new AdminAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminAccount();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->created_time = time();
            $model->pass = PublicController::encrypt($model->pass);
            if($model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminAccount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $pass1 = $model->pass;
        if ($model->load(Yii::$app->request->post())) {
            if($pass1 != $model->pass) {
                $model->pass = PublicController::encrypt($model->pass);
            }
            if($model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete(array $ids)
    {
        return;
        if(count($ids) > 0){
            $c = AdminAccount::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the AdminAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
