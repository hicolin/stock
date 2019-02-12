<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminDeposit;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\helps\ExportExcelController;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * AdminDepositController implements the CRUD actions for AdminDeposit model.
 */
class AdminDepositController extends Controller
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
     * Lists all AdminDeposit models.
     * @return mixed
     */
    public function actionIndex()
    {
    $type = [1=>'入金',2=>'出金'];
    $query = AdminDeposit::find()->joinWith('member');
    // var_dump($query);
    $search = Yii::$app->request->get('query');
    $query = $this->condition($query,$search);

    $pagination = new Pagination([
    'totalCount' =>$query->count(),
    'pageSize' => '10',
    'pageParam'=>'page',
    'pageSizeParam'=>'per-page']
    );

    $products = $query->offset($pagination->offset)
    ->limit($pagination->limit)
        ->orderBy('time desc')
    ->all();
    // var_dump($products);
    return $this->render('index', [
    'type'=>$type,
    'query'=>$search,
    'model' => $products,
    'pages'=>$pagination,
    ]);
    }



    public function actionMoneyin()
    {
    $type = [1=>'入金',2=>'出金'];
    $query = AdminDeposit::find()->joinWith('member');
    // var_dump($query);
    $search = Yii::$app->request->get('query');
    $search['type']=1;

    $query = $this->condition($query,$search);

    $pagination = new Pagination([
    'totalCount' =>$query->count(),
    'pageSize' => '10',
    'pageParam'=>'page',
    'pageSizeParam'=>'per-page']
    );

    $products = $query->offset($pagination->offset)
    ->limit($pagination->limit)
    ->where(['type'=>1])
        ->orderBy('time desc')
    ->all();
    // var_dump($products);
    return $this->render('index', [
    'type'=>$type,
    'query'=>$search,
    'model' => $products,
    'pages'=>$pagination,
    ]);
    }


    public function actionMoneyout()
    {
    $type = [1=>'入金',2=>'出金'];
    $query = AdminDeposit::find()->joinWith('member');
    // var_dump($query);
    $search = Yii::$app->request->get('query');
    $search['type']=2;
    $query = $this->condition($query,$search);

    $pagination = new Pagination([
    'totalCount' =>$query->count(),
    'pageSize' => '10',
    'pageParam'=>'page',
    'pageSizeParam'=>'per-page']
    );

    $products = $query->offset($pagination->offset)
    ->limit($pagination->limit)
    ->where(['type'=>2])
        ->orderBy('time desc')
    ->all();
    // var_dump($products);
    return $this->render('index', [
    'type'=>$type,
    'query'=>$search,
    'model' => $products,
    'pages'=>$pagination,
    ]);
    }

    /**
     * Displays a single AdminDeposit model.
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
     * Creates a new AdminDeposit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminDeposit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminDeposit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing AdminDeposit model.
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
    $c=AdminDeposit::deleteAll(['in', 'id', $ids]);
    echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
    }
    else{
    echo json_encode(array('errno'=>2, 'msg'=>''));
    }
    }
    /**
     * Finds the AdminDeposit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminDeposit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminDeposit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     /**
     * 搜索条件
     * @param $query
     * @param $search
     * @return mixed
     */
    protected function condition($query,$search)
    {
        if (count($search) > 0) {

            if (intval($search['type']) >= 0) {
                $query = $query->andWhere(['type' => $search['type']]);
            }
            if($search['realname']) {
                $query = $query->andWhere(['realname'=>$search['realname']]);
            }
            if($search['xgj_name']) {
                $query = $query->andWhere(['like','xgj_name',$search['xgj_name']]);
            }
            if ($search['usersname']) {
                $query = $query->andWhere(['usersname' => $search['usersname']]);
            }
            if ($search['b_time']) {
                $b_time = strtotime($search['b_time']);
                $query = $query->andWhere(['>=', 'dates', $b_time]);
            }

            if ($search['e_time']) {
                $e_time = strtotime($search['e_time']);
                $query = $query->andWhere(['<=', 'dates', $e_time]);
            }

        }
        return $query;
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
        $type = [1=>'入金',2=>'出金'];
        $excel = new ExportExcelController();
        $search = Yii::$app->request->get('query');
        $query=AdminDeposit::find()->joinWith('member');
        // $querys=$this->condition($query,$search);
        // var_dump($querys);exit;

        $model = $this->condition($query,$search)->asArray()->all();
        // var_dump($model);
        //$model = AdminCharge::find()->joinWith('member')->asArray()->all();
        $data[] = ['ID','用户名','真实姓名','交易账号','金额','交易时间','类型'];
        foreach ($model as $k=> $arr) {

            $data[$k+1]['id'] = $arr['id'];
            $data[$k+1]['usersname'] = $arr['member']['usersname'];
            $data[$k+1]['realname'] = $arr['member']['realname'];
            $data[$k+1]['xgj_name'] = $arr['member']['xgj_name'];
            $data[$k+1]['money'] = $arr['money'];
            $data[$k+1]['time'] = date('Y-m-d H:i:s',$arr['time']);
            $data[$k+1]['type'] = $type[$arr['type']];
        }
        $filename = '配资列表'.date('Ymd',time());
        $excel->download($data, $filename);
        //echo "<script>history.go(-1)</script>";

    }
}
