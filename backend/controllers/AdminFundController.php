<?php

namespace backend\controllers;

use backend\models\AdminMember;
use backend\models\AdminUser;
use Yii;
use backend\models\AdminFund;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AdminFundController implements the CRUD actions for AdminFund model.
 */
class AdminFundController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "lte_main";
    public $cj = [];

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
     * Lists all AdminFund models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminFund::find()->with('member');
        $querys = Yii::$app->request->get('query');
        if (count($querys) > 0) {
            if($querys['tel']){
                $uid = AdminMember::findOne(['usersname'=>$querys['tel']])->id;
                $query = $query->where(['admin_fund.user_id'=>$uid]);
            }
            if($querys['b_time']){
                if($querys['e_time']){
                    $querys['b_time'] = strtotime($querys['b_time']);
                    $querys['e_time'] = strtotime($querys['e_time']);
                    $query = $query->where(['>=','admin_fund.created_time',$querys['b_time']]);
                    $query = $query->andWhere(['<=','admin_fund.created_time',$querys['e_time']]);
                }else{
                    $querys['b_time'] = strtotime($querys['b_time']);
                    $querys['e_time'] = time();
                    $query = $query->where(['>=','admin_fund.created_time',$querys['b_time']]);
                    $query = $query->andWhere(['<=','admin_fund.created_time',$querys['e_time']]);
                }
            }
        }
        $id = Yii::$app->session['__id'];
        if($id!=156){
            $model = AdminUser::find()->where(['pid'=>$id])->all();
            $ids = $this->getSon($model);
            array_unshift($ids,$id);
            $mid = AdminMember::getMid($ids);
            $query = $query->andWhere(['in','user_id',$mid]);
        }
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        //echo $query->createCommand()->getRawSql();exit;
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('id desc')
            ->all();
        $sum = $query->select('sum(amount) as money')->asArray()->one();
        return $this->render('index', [
            'model' => $products,
            'querys' => $querys,
            'pages' => $pagination,
            'sum' => $sum,
        ]);
    }

    /**
     * Displays a single AdminFund model.
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
     * Creates a new AdminFund model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminFund();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminFund model.
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
     * Deletes an existing AdminFund model.
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
            $c = AdminFund::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminFund model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminFund the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminFund::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getSon($model)
    {
        $ids = array();
        if($model){
            foreach($model as $list){
                $ids[] = $list->id;
                $this->cj[] = $list->id;
            }
        }
        $next_model = AdminUser::find()->where(['in','pid',$ids])->all();
        //如果存在下级代理
        if($next_model){
            $this->getSon($next_model);
        }
        return $this->cj;
    }

}
