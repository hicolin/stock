<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminOrder;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helps\ExportExcelController;
use yii\data\Pagination;
/**
 * AdminOrderController implements the CRUD actions for AdminOrder model.
 */
class AdminOrderController extends Controller
{

public $status = [1 => '申请中', 2 => '持仓中', 3 => '已结算'];

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
     * Lists all AdminOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
    $query = AdminOrder::find();
    $static = AdminOrder::find();
    $search = Yii::$app->request->get('query');
    // var_dump($search);
    $query = $this->condition($query,$search);
    $static = $this->condition($static,$search);
    // var_dump($query);
    $num=$static->count();
    $cc=$static->where(['status'=>1])->count();
    $js=$static->where(['status'=>2])->count();
    // var_dump($this->status);

            
    $pagination = new Pagination([
    'totalCount' =>$query->count(),
    'pageSize' => '10',
    'pageParam'=>'page',
    'pageSizeParam'=>'per-page']
    );
    $products = $query->offset($pagination->offset)
    ->limit($pagination->limit)
    ->orderBy("created_time desc")
    ->all();
    // var_dump($products);
    return $this->render('index', [
    'model' => $products,
    'query' => $search,
    'num' => $num,
    'cc' => $cc,
    'js' => $js,
    'status'=>$this->status,
    'pages'=>$pagination,
    ]);
    }











    public function actionApply()
    {
    $query = AdminOrder::find();
    $static = AdminOrder::find();
    $search = Yii::$app->request->get('query');
    // var_dump($search);
    $search['status']=1;

    $query = $this->condition($query,$search);
    $static = $this->condition($static,$search);
    // var_dump($query);
    $num=$static->where(['status'=>0])->count();
    $cc=$static->where(['status'=>1])->count();
    $js=$static->where(['status'=>2])->count();
    // var_dump($this->status);

            
    $pagination = new Pagination([
    'totalCount' =>$query->count(),
    'pageSize' => '10',
    'pageParam'=>'page',
    'pageSizeParam'=>'per-page']
    );
    $products = $query->offset($pagination->offset)
    ->where(['status'=>0])
    ->limit($pagination->limit)
    ->all();
    // var_dump($products);
    return $this->render('index', [
    'model' => $products,
    'query' => $search,
    'num' => $num,
    'cc' => $cc,
    'js' => $js,
    'status'=>$this->status,
    'pages'=>$pagination,
    ]);
    }


    public function actionHolding()
    {
    $query = AdminOrder::find();
    $static = AdminOrder::find();
    $search = Yii::$app->request->get('query');
    // var_dump($search);
    $search['status']=2;

    $query = $this->condition($query,$search);
    $static = $this->condition($static,$search);
    // var_dump($query);
    $num=$static->where(['status'=>1])->count();
    $cc=$static->where(['status'=>1])->count();
    $js=$static->where(['status'=>2])->count();
    // var_dump($this->status);

            
    $pagination = new Pagination([
    'totalCount' =>$query->count(),
    'pageSize' => '10',
    'pageParam'=>'page',
    'pageSizeParam'=>'per-page']
    );
    $products = $query->offset($pagination->offset)
    ->where(['status'=>1])
    ->limit($pagination->limit)
    ->all();
    // var_dump($products);
    return $this->render('index', [
    'model' => $products,
    'query' => $search,
    'num' => $num,
    'cc' => $cc,
    'js' => $js,
    'status'=>$this->status,
    'pages'=>$pagination,
    ]);
    }



    public function actionFinish()
    {
    $query = AdminOrder::find();
    $static = AdminOrder::find();
    $search = Yii::$app->request->get('query');
    // var_dump($search);
    $search['status']=3;
    $query = $this->condition($query,$search);
    $static = $this->condition($static,$search);
    // var_dump($query);
    $num=$static->where(['status'=>2])->count();
    $cc=$static->where(['status'=>1])->count();
    $js=$static->where(['status'=>2])->count();
    // var_dump($this->status);

            
    $pagination = new Pagination([
    'totalCount' =>$query->count(),
    'pageSize' => '10',
    'pageParam'=>'page',
    'pageSizeParam'=>'per-page']
    );
    $products = $query->offset($pagination->offset)
    ->where(['status'=>2])
    ->limit($pagination->limit)
    ->all();
    // var_dump($products);
    return $this->render('index', [
    'model' => $products,
    'query' => $search,
    'num' => $num,
    'cc' => $cc,
    'js' => $js,
    'status'=>$this->status,
    'pages'=>$pagination,
    ]);
    }

    /**
     * Displays a single AdminOrder model.
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
     * Creates a new AdminOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminOrder model.
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
    if(count($ids) > 0){
    $c=AdminOrder::deleteAll(['in', 'id', $ids]);
    echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
    }
    else{
    echo json_encode(array('errno'=>2, 'msg'=>''));
    }
    }
    /**
     * Finds the AdminOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * 生成excel
     * $field 表头数据
     * $data 数据
     */
    public function actionExport()
    {
        // if( !in_array($this->role_id, [1,6]) ) {
        //     yii::$app->getSession()->setFlash('error', '没有该权限');
        //     echo "<script>window.history.go(-1)</script>";exit;
        // }
        $arr_status = [1=>'申请中',2=>'持仓中',3=>'已结算'];
        $excel = new ExportExcelController();
        $search = Yii::$app->request->get('query');
        // var_dump(Yii::$app->request->get('query'));exit;
        // $query=AdminOrder::find();
        // $querys=$this->condition($query,$search);
        // var_dump($search['status']);exit;

        $model = $this->condition(AdminOrder::find(),$search)->asArray()->all();
        // var_dump($model);exit;
        //$model = AdminCharge::find()->joinWith('member')->asArray()->all();
        $data[] = ['ID','股票名称','股票代码','用户号码','名义本金','履约保证金','杠杆倍率','触发止盈','触发止损','手续费','申请时间'];
        foreach ($model as $k=> $arr) {

            $data[$k+1]['id'] = $arr['id'];
            $data[$k+1]['goods_name'] = $arr['goods_name'];
            $data[$k+1]['goods_code'] = $arr['goods_code'];
            $data[$k+1]['user_tel'] = $arr['user_tel'];
            $data[$k+1]['order_my_money'] = $arr['order_my_money'];
            $data[$k+1]['order_ly_money'] = $arr['order_ly_money'];
            $data[$k+1]['order_bl'] = $arr['order_bl'];
            $data[$k+1]['order_zy_money'] = $arr['order_zy_money'];
            $data[$k+1]['order_zs_money'] = $arr['order_zs_money'];
            $data[$k+1]['order_charge'] = $arr['order_charge'];
            $data[$k+1]['dates'] = date('Y-m-d H:i:s',$arr['created_time']);
            $data[$k+1]['state'] = $this->status[$arr['status']+1];
        }
        $filename = '策略列表'.date('Ymd',time());
        $excel->download($data, $filename);
        //echo "<script>history.go(-1)</script>";

    }

     //     * 搜索条件
     // * @param $query
     // * @param $search
     // * @return mixed
     // */
    protected function condition($query,$search)
    {
        if (count($search) > 0) {
            $user_tel = $search['user_tel'];
            $goods_name = $search['goods_name'];
            if ($user_tel) {
                $query = $query->andWhere(['like', 'user_tel', $user_tel]);
            }
            if ($goods_name) {
                $query = $query->andWhere(['like', 'goods_name', $goods_name]);
            }
            if ($search['status']>0) {
                $query = $query->andWhere(['status' => $search['status']-1]);
            }
            if ($search['b_time']) {
                $b_time = strtotime($search['b_time']);
                $query = $query->andWhere(['>=', 'created_time', $b_time]);
            }
            if ($search['e_time']) {
                $e_time = strtotime($search['e_time']);
                $query = $query->andWhere(['<=', 'created_time', $e_time]);
            }
            
        }
        // if(Yii::$app->request->get('status')){
        //      $query = $query->andWhere(['status' => Yii::$app->request->get('status')-1]);
        // }
        return $query;
    }
}
