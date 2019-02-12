<?php

namespace backend\controllers;

use backend\models\AdminStocksCategory;
use Yii;
use backend\models\AdminStocks;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\helps\ExportExcelController;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\models\Excel;

/**
 * AdminStocksController implements the CRUD actions for AdminStocks model.
 */
class AdminStocksController extends Controller
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
     * Lists all AdminStocks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AdminStocks::find()->joinWith('cate');
        $search = Yii::$app->request->get('query');
        $query = $this->condition($query, $search);
        $pagination = new Pagination([
                'totalCount' => $query->count(),
                'pageSize' => '10',
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page']
        );
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $stocksCats = AdminStocksCategory::find()->asArray()->all();
        $categories = [];
        foreach ($stocksCats as $list) {
            $categories[$list['id']] = $list['name'];
        };
        return $this->render('index', [
            'model' => $products,
            'query' => $search,
            'pages' => $pagination,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single AdminStocks model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new AdminStocks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminStocks();
        $stocksCats = AdminStocksCategory::find()->asArray()->all();
        $categories = [];
        foreach ($stocksCats as $list) {
            $categories[$list['id']] = $list['name'];
        };
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing AdminStocks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $stocksCats = AdminStocksCategory::find()->asArray()->all();
        $categories = [];
        foreach ($stocksCats as $list) {
            $categories[$list['id']] = $list['name'];
        };
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing AdminStocks model.
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
        if (count($ids) > 0) {
            $c = AdminStocks::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno' => 0, 'data' => $c, 'msg' => json_encode($ids)));
        } else {
            echo json_encode(array('errno' => 2, 'msg' => ''));
        }
    }

    /**
     * Finds the AdminStocks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminStocks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminStocks::findOne($id)) !== null) {
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
        $excel = new ExportExcelController();
        $search = Yii::$app->request->get('query');
        $model = $this->condition(AdminStocks::find(), $search)->asArray()->all();
        //$model = AdminCharge::find()->joinWith('member')->asArray()->all();
        $data[] = ['ID', '股票名称', '股票代码','分类','子分类', '市值规模', '期权规则'];
        foreach ($model as $k => $arr) {
            $data[$k + 1]['id'] = $arr['id'];
            $data[$k + 1]['name'] = $arr['name'];
            $data[$k + 1]['code'] = $arr['code'];
            $data[$k + 1]['cid'] = $arr['cid'];
            $data[$k + 1]['cate_id'] = $arr['cate_id'];
            $data[$k + 1]['mcs'] = $arr['mcs'];
            $data[$k + 1]['rules'] = $arr['rules'];
        }
        $filename = '股票列表' . date('Ymd', time());
        $excel->download($data, $filename);
        //echo "<script>history.go(-1)</script>";

    }


    public function actionImport()
    {
        $path = Yii::$app->request->get('path');
        $root = Yii::getAlias('@root');
        $data = Excel::getExcelData($root . '/' . $path);
        foreach ($data as $k => $list) {
            $model[$k]['cid'] = $list[3];
            $model[$k]['cate_id'] = $list[4];
            $model[$k]['name'] = $list[1];
            $model[$k]['code'] = $list[2];
        }
        $num = Yii::$app->db->createCommand()->batchInsert('admin_stocks', ['cid','cate_id','name', 'code'], $model)->execute();
        if ($num) {
            return json_encode(['status' => 200]);
            exit;
        } else {
            return json_encode(['status' => 500]);
            exit;
        }


    }

    //     * 搜索条件
    // * @param $query
    // * @param $search
    // * @return mixed
    // */
    protected function condition($query, $search)
    {
        if (count($search) > 0) {
            $name = $search['name'];
            $code = $search['code'];
            $cateId = $search['cate_id'];
            if ($name) {
                $query = $query->andWhere(['like', 'admin_stocks.name', $name]);
            }
            if ($code) {
                $query = $query->andWhere(['like', 'admin_stocks.code', $code]);
            }
            if ($cateId) {
                $query = $query->andWhere(['cate_id' => $cateId]);
            }
        }
        return $query;
    }
}

