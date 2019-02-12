<?php



namespace backend\models;



use Yii;



/**

 * This is the model class for table "{{%stocks}}".

 *

 * @property string $id

 * @property string $cid
 * @property string $cate_id

 * @property integer $recom

 * @property integer $status

 * @property string $hits

 * @property string $template

 * @property integer $addtime

 * @property integer $edittime

 * @property string $ip

 * @property integer $adminid

 * @property string $name

 * @property string $code

 * @property string $mcs

 * @property string $rules

 * @property integer $display

 */

class AdminStocks extends \yii\db\ActiveRecord

{

    /**

     * @inheritdoc

     */

    public static function tableName()

    {

        return '{{%stocks}}';

    }

    public function getOption(){

        return $this->hasOne(AdminOption::className(),['goods_id'=>'id']);

    }

    /**

     * @inheritdoc

     */

    public function rules()

    {

        return [

            [['cid', 'recom', 'status', 'hits', 'addtime', 'edittime', 'adminid', 'display','cate_id'], 'integer'],

            [['mcs', 'rules'], 'string'],

            [['template'], 'string', 'max' => 30],

            [['ip', 'name', 'code'], 'string', 'max' => 255],

        ];

    }



    /**

     * @inheritdoc

     */

    public function attributeLabels()

    {

        return [

            'id' => 'ID',

            'cid' => '分类',
            'cate_id' => '子分类',

            'recom' => '推荐',

            'status' => '状态',

            'hits' => '浏览量',

            'template' => '渲染模板',

            'addtime' => '添加时间',

            // 'edittime' => 'Edittime',

            'ip' => '发布者Ip',

            'adminid' => '管理员',

            'name' => '股票名称',

            'code' => '股票代码',

            'mcs' => '市值规模',

            'rules' => '期权规则',

            'display' => '上架显示',

        ];

    }

    public function getCate()
    {
        return $this->hasOne(AdminStocksCategory::className(), ['id'=>'cate_id']);
    }

}

