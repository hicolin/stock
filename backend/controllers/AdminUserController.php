<?php

namespace backend\controllers;

use backend\models\AdminRole;
use backend\models\AdminUserRole;
use common\models\Common;
use Yii;
use yii\data\Pagination;
use backend\models\AdminUser;
use yii\web\NotFoundHttpException;
use backend\models\AdminProduct;
use backend\models\AdminUserpeoduct;

/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends BaseController
{
    public $layout = "lte_main";
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $query = AdminUser::find();
        $querys = Yii::$app->request->get('query');
        if (count($querys) > 0) {
            $uname = $querys['uname'];
            if ($uname) {
                $query = $query->andWhere(['and', ['like', 'uname', $uname]]);
            }
        }
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $models = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pagination,
            'query' => $querys,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $model2 = AdminUserRole::find()->where(['user_id' => $id])->one();
        $data = $model->getAttributes();
        $data['role'] = $model2->role_id;
        echo json_encode($data);

    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $code = $this->actionVatationCode();
        $code = Common::getCode();
        $model = new AdminUser();
        $role_user = new AdminUserRole();
        $user_pro = new AdminUserpeoduct();
        $role = AdminRole::find()->all();
        $product = AdminProduct::find()->all();
        if ($model->load((Yii::$app->request->post()))) {
            $roles = Yii::$app->request->post("role");
            if (empty($model->is_online) == true) {
                $model->is_online = 'n';
            }
            if (empty($model->status) == true) {
                $model->status = 10;
            }
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->create_user = Yii::$app->user->identity->uname;
            $model->update_user = Yii::$app->user->identity->uname;
            $model->vatation_code = $code;
            $model->pid = Yii::$app->user->identity->id;
            if ($model->validate() == true && $model->save()) {
                $role_user->user_id = $model->id;
                $role_user->create_user = Yii::$app->user->identity->uname;
                $role_user->create_date = date('Y-m-d H:i:s');
                $role_user->update_user = Yii::$app->user->identity->uname;
                $role_user->update_date = date('Y-m-d H:i:s');
                $role_user->role_id = Yii::$app->request->post("role");

                if ($role_user->save()) {
                    if ($roles == 2) {
                        $proid = Yii::$app->request->post("proid");
                        $price = Yii::$app->request->post("price") ?: '0';
                        $price = array_filter($price);
                        $user_pro->uid = $model->id;
                        if ($proid) {
                            $user_pro->proid = trim(implode(",", $proid), ",");
                            $user_pro->price = trim(implode(",", $price), ",");
                        }
                        $user_pro->save();
                    }
                    return $this->redirect(['index']);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                        'role_user' => $role_user,
                        'role' => $role,
                        'code' => $code,
                        'product' => $product,
                        'user_pro' => $user_pro,
                    ]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'role_user' => $role_user,
            'role' => $role,
            'code' => $code,
            'product' => $product,
            'user_pro' => $user_pro,
        ]);
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user_role = AdminUserRole::find()->where("user_id='$id'")->one();
        $role = AdminRole::find()->all();
        $product = AdminProduct::find()->all();
        $user_pro = AdminUserpeoduct::find()->where("uid='$id'")->one();
        if ($user_pro) {
            $pid_price = array();
            $proid = explode(",", $user_pro->proid);
            $price = explode(",", $user_pro->price);
            for ($i = 0; $i < count($proid); $i++) {
                $pid_price[$proid[$i]] = $price[$i];
            }
        } else {
            $pid_price = array();
            $proid = array();
        }


        if ($model->load(Yii::$app->request->post())) {
            $pass = Yii::$app->request->post('password');
            if ($pass) {
                $model->password = Yii::$app->security->generatePasswordHash($pass);
            }
            $model->update_user = Yii::$app->user->identity->uname;
            $model->update_date = date('Y-m-d H:i:s');
            if ($model->validate() == true && $model->save()) {
                $user_role->role_id = Yii::$app->request->post('role');
                $user_role->update_user = Yii::$app->user->identity->uname;
                $user_role->update_date = date('Y-m-d H:i:s');
                if ($user_role->save()) {
                    $proid = Yii::$app->request->post("proid");
                    $price = Yii::$app->request->post("price");
                    $price = array_filter($price);
                    if ($user_pro) {
                        if ($proid) {
                            $user_pro->proid = trim(implode(",", $proid), ",");
                            $user_pro->price = trim(implode(",", $price), ",");
                            $user_pro->save();
                        }
                    } else {
                        $users_pro = new AdminUserpeoduct();
                        $users_pro->uid = $model->id;
                        $users_pro->proid = trim(implode(",", $proid), ",");
                        $users_pro->price = trim(implode(",", $price), ",");
                        $users_pro->save();
                    }

                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'role' => $role,
            'user_role' => $user_role,
            'product' => $product,
            'pid_price' => $pid_price,
            'proid' => $proid,
        ]);

    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if (count($ids) > 0) {
            $c = AdminUser::deleteAll(['in', 'id', $ids]);
            AdminUserpeoduct::deleteAll(['in', 'uid', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }


    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
     * 生成唯一的16位邀请码
     * */
    public function actionVatationCode($id = '')
    {

        //$id = $_REQUEST['id'];
        $code = substr(md5(uniqid(rand(), 1)), 0, 16);
        $query = AdminUser::find()->andWhere(['vatation_code' => $code]);
        //如果id有值，即编辑
        if ($id) {
            $query = $query->andWhere(['<>', 'id', $id]);
        }
        //如果邀请码存在，重新再生成
        $res = $query->asArray()->one();
        if ($res) {
            $this->vatationCode($id);
        }
        return $code;
        //return $code;
    }

    public function actionCodes()
    {
        $id = $_REQUEST['id'];
        $code = substr(md5(uniqid(rand(), 1)), 0, 16);
        $query = AdminUser::find()->andWhere(['vatation_code' => $code]);
        //如果邀请码存在，重新再生成
        $res = $query->asArray()->one();
        if ($res) {
            $this->vatationCode($id);
        }
        echo json_encode($code);
        exit;
    }
}
