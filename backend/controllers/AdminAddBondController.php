<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminAddBond;
use backend\models\AdminProduct;
use backend\models\AdminOrder;
use backend\models\AdminUser;
use backend\models\AdminMember;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminAddBondController implements the CRUD actions for AdminAddBond model.
 */
class AdminAddBondController extends Controller
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
     * Lists all AdminAddBond models.
     * @return mixed
     */
    public function actionIndex()
    {

        //获取全部的产品
        $product[''] = '请选择';
        $product_model = AdminProduct::find()->asArray()->all();
        foreach ($product_model as $k=> $arr ) {
            $product[$arr['id']] = $arr['title'];
        }
        //获取所有用户
        $user[''] = '请选择';
        $user_model = AdminMember::find()->asArray()->all();
        foreach ($user_model as $k=> $arr) {
            $user[$arr['id']] = $arr['usersname'];
        }
        $query = AdminAddBond::find()->joinWith('member')->joinWith('order');
        $querys = Yii::$app->request->get('query');
        if (count($querys) > 0) {
            $order_id = $querys['order_id'];
            $user_id = $querys['user_id'];
            $b_time = $querys['b_time'];
            $e_time = $querys['e_time'];
            if($order_id) {
                $query = $query->andWhere(['order_sn'=>$order_id]);
            }
            if($user_id) {
                $query = $query->andWhere(['admin_member.id'=>$user_id]);
            }
            if($b_time) {
                $query = $query->andWhere(['>=','admin_add_bond.created_time',$b_time]);
            }
            if($e_time) {
                $query = $query->andWhere(['<=','admin_add_bond.created_time',$e_time]);
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
            'product' => $product,
            'user' => $user,
            'query' => $querys,
        ]);
    }

    /**
     * Displays a single AdminAddBond model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->user_id = AdminMember::find()->where(['id'=>$model['user_id']])->one()->usersname;
        $model->order_id = AdminOrder::find()->where(['order_id'=>$model['order_id']])->one()->order_sn;
        $model->created_time = date('Y-m-d H:i',$model->created_time);
        return $this->render('view', [
            'model' =>$model,
        ]);

    }

    /**
     * Creates a new AdminAddBond model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //获取全部的订单
        $order['prompt'] = '请选择';
        $order_model = AdminOrder::find()->asArray()->all();
        foreach ($order_model as $k=> $arr ) {
            $order[$arr['order_id']] = $arr['order_sn'];
        }
        //获取所有用户
        $user['prompt'] = '请选择';
        $user_model = AdminMember::find()->asArray()->all();
        foreach ($user_model as $k=> $arr) {
            $user[$arr['id']] = $arr['usersname'];
        }
        $model = new AdminAddBond();

        if($model->load(Yii::$app->request->post())) {
            $satus = $model->status;
            $deposit_amout = $model->deposit_amout;
            $order_id = $model->order_id;
            if ($model->validate() == true && $model->save()) {
                //如果状态为通过，则需要在对应的订单中把追加的保证金加到风险保证金中去
                if($satus==1) {
                    $order = AdminOrder::findOne($order_id);
                    $order->order_deposit = $order->order_deposit+$deposit_amout;
                    if(!$order->save()) {
                        return $this->render('create', [
                            'model' => $model,
                            'user' => $user,
                            'order' => $order,
                        ]);
                    }
                }
                return $this->redirect(['index', 'id' => $model->id]);
            }else {
                return $this->render('create', [
                    'model' => $model,
                    'user' => $user,
                    'order' => $order,
                ]);
            }
        }else {
            return $this->render('create', [
                'model' => $model,
                'user' => $user,
                'order' => $order,
            ]);
        }
    }

    /**
     * Updates an existing AdminAddBond model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //获取全部的订单
        $order['prompt'] = '请选择';
        $order_model = AdminOrder::find()->asArray()->all();
        foreach ($order_model as $k=> $arr ) {
            $order[$arr['order_id']] = $arr['order_sn'];
        }
        //获取所有用户
        $user['prompt'] = '请选择';
        $user_model = AdminMember::find()->asArray()->all();
        foreach ($user_model as $k=> $arr) {
            $user[$arr['id']] = $arr['usersname'];
        }
        $model = $this->findModel($id);
        $model->created_time = date('Y-m-d H:i',$model->created_time);
        $status_1 = $model->status;
        if($status_1==1) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if($model->load(Yii::$app->request->post())) {
            $status_2 = $model->status;
            $order_id = $model->order_id;
            $deposit_amout = $model->deposit_amout;
            if ($model->validate() == true && $model->save()) {
                $order = AdminOrder::findOne($order_id);
                //从已申请改为已通过
                if($status_2>$status_1) {
                    $order->order_deposit = $order->order_deposit+$deposit_amout;
                    if(!$order->save()) {
                        return $this->render('create', [
                            'model' => $model,
                            'user' => $user,
                            'order' => $order,
                        ]);
                    }
                    //从已通过改为已申请
                }
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'user' => $user,
                    'order' => $order,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'user' => $user,
                'order' => $order,
            ]);
        }
    }

    /**
     * Deletes an existing AdminAddBond model.
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
            $c = AdminAddBond::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminAddBond model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminAddBond the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminAddBond::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
