<?php
namespace backend\models;

use Yii;
use backend\models\AdminUserRole;
use backend\models\AdminHousekeeper;
/**
 * This is the model class for table "admin_user".
 *
 * @property string $id
 * @property string $uname
 * @property string $password
 * @property string $auth_key
 * @property string $last_ip
 * @property string $pid
 * @property string $is_online
 * @property string $domain_account
 * @property integer $status
 * @property string $create_user
 * @property string $create_date
 * @property string $update_user
 * @property string $update_date
 * @property string $vatation_code
 * @property string $vatation_code2
 *
 * @property AdminUserRole[] $adminUserRoles
 * @property SystemUserRole[] $systemUserRoles
 */
class AdminUser extends BackendUser
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uname', 'password', 'create_user', 'create_date', 'update_user', 'update_date'], 'required'],
            [['status'], 'integer'],
            [['create_date', 'update_date','pid'], 'safe'],
            [['uname', 'domain_account', 'create_user'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 200],
            [['auth_key', 'last_ip'], 'string', 'max' => 50],
            [['is_online'], 'string', 'max' => 1],
            [['update_user'], 'string', 'max' => 101],
            [['vatation_code','vatation_code2'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uname' => '用户名',
            'password' => '密码',
            'auth_key' => '自动登录key',
            'last_ip' => '最近一次登录ip',
            'is_online' => '是否在线',
            'domain_account' => '域账号',
            'status' => '状态',
            'create_user' => '创建人',
            'create_date' => '创建时间',
            'update_user' => '更新人',
            'update_date' => '更新时间',
            'vatation_code' => '邀请码',
            'vatation_code2' => '被邀请码',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getAdminUserRoles()
    // {
    //     return $this->hasMany(AdminUserRole::className(), ['user_id' => 'id']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemUserRoles()
    {
        return $this->hasMany(SystemUserRole::className(), ['user_id' => 'id']);
    }
    /**根据id返回角色名称**/
    public static function getrolename($uid){
        $model =  AdminRole::find()->innerJoinWith(['rolename'])->where("user_id=$uid")->one();

        return $model['name'];
    }
    /**根据id 返回名称**/
    public static function getName($id)
    {
        $user = Yii::$app->db->createCommand("select uname from admin_user WHERE id=".$id)->queryOne();
        return $user['uname'];
    }
    /**根据pid返回上级名字**/
    public static function getParentByUid($id)
    {
        $parentId=AdminUser::findOne($id)->pid;
        if($parentId==0)
            return AdminUser::findOne(156)->uname;
        else
            return AdminUser::findOne($id)->uname;
    }

    public function getFid($uid){
        $pid=AdminUser::findOne($uid)->pid;
        $member = AdminUser::findOne($pid);
        $ids = array();
        if($member && $member->pid>0){
            $ids[] = $member->id;
            if(count($ids)<1){
                $ids = self::getFid($member->id);
            }
        }
        return $ids;
    }

    /**
     *根据ID返回所有上级的名称
     */
    public static function getAllParentName($id)
    {
        $parents=array();
        $pid=AdminUser::findOne($id)->pid;
        $parAgent=AdminUser::find()->andWhere(['id'=>$pid])->one();
        if($parAgent){
            $parents[]=$parAgent->uname;
            $parents=array_merge($parents,self::getAllParentName($parAgent->id)) ;
        }
        return $parents;
    }

    //根据id获取当前管理员
    public static function getuserinfo($id){
        return AdminUser::find()->where("id='$id'")->one();
    }
    /**
     * 得到相应  id  对应的  分类名  数组
     */
    public function getOptions3($pid=0)
    {
        $data = $this->getCategories();
        $tree = $this->getTree4($data,$pid,1,0);
        $role_id=AdminUserRole::findOne(['user_id'=>yii::$app->session['__id']])->role_id;
        if($role_id==8){
            $list[156]='admin';
        }else{
            $list[Yii::$app->user->identity->id]=Yii::$app->user->identity->uname;
        }

        foreach($tree as $value){
            $list[$value['id']] = $value['uname'];
        }
        return $list;
    }
    public function getCategories()
    {
        $data = Yii::$app->db->createCommand("SELECT a.id,a.pid,a.uname,b.user_id,b.role_id FROM admin_user as a LEFT JOIN admin_user_role as b ON a.id=b.user_id ORDER BY `id` ASC")->queryAll();;

        return $data;
    }

    public static function getTree4($data,$pid = 0,$lev = 1,$sign=1)
    {
        $tree = [];
        $fsign=$sign;
        foreach($data as $k=> $value ){
            if($value['pid'] == $pid && $fsign!=2){
                /*if($value['role_id']!=8){
                    if(($value['role_id']==2 || $value['role_id']==3) && Yii::$app->user->identity->pid > 0){
                        $sign++;
                    }
                }*/
                $value['uname'] = str_repeat('|___',$lev).$value['uname'];
                $value['level']=$lev;
                $tree[] = $value;
                $tree = array_merge($tree,self::getTree($data,$value['id'],$lev+1,$sign));
            }
            //  $sign=$fsign;
        }
        //print_r(count($tree));
        return $tree;

    }

    /**
     *遍历出各个子类 获得树状结构的数组
     */
    public static function getTree($data,$pid = 0,$lev = 1,$sign=1)
    {
        $tree = [];
        $fsign=$sign;
        foreach($data as $k=> $value){
            if($value['pid'] == $pid && $fsign!=2){
                //$value['uname'] = str_repeat('|___',$lev).$value['uname'].$sign.'-'.$fsign;
                $value['uname'] = str_repeat('|___',$lev).$value['uname'];
                $value['level']=$lev;
                $tree[] = $value;
                $tree = array_merge($tree,self::getTree($data,$value['id'],$lev+1,$sign));
                //$sign=$fsign;//循环结束重置sign，防止影响同级

            }
            //
        }
        //print_r(count($tree));
        return $tree;
    }

    /**
     *根据ID返回所有下级角色ID-只查到自己的直属代理,直属代理下面不能再查了
     * $sign 标记代理商或者运营中心出现的次数，出现第二次就不查代理商了
     */

    public static function getAllSonAgent($id,$sign=0)
    {
        $ids=array();
        $fsign=$sign;

        $sonAgent=Yii::$app->db->createCommand("SELECT a.id,a.pid,b.user_id,b.role_id FROM admin_user as a LEFT JOIN admin_user_role as b ON a.id=b.user_id WHERE a.pid='$id'".($fsign==3 ? ' AND b.role_id<>2 AND b.role_id<>3 ' : '')." ")->queryAll();
        if($sonAgent){

            foreach($sonAgent as $k=>$v){
                /*if(($v['role_id']==2 || $v['role_id']==3) && Yii::$app->user->identity->pid > 0){//如果登录的不是平台方需判断是否是代理商或者运营中心
                    $sign++;
                }*/

                $ids[]=$v['id'];
                $result=Yii::$app->db->createCommand("SELECT a.id,a.pid,b.user_id,b.role_id FROM admin_user as a LEFT JOIN admin_user_role as b ON a.id=b.user_id WHERE a.pid='$v[id]' ")->queryAll();
                if($result!=null){
                    $ids=array_merge($ids,self::getAllSonAgent($v['id'],$sign));
                    $sign=$fsign;//循环结束重置sign，防止影响同级
                }

            }
        }
        return $ids;
    }

    public function getDaili()
    {
        return $this->hasOne(AdminUserRole::className(),['user_id'=>'id']);
    }

    public function getRole()
    {
        return $this->hasOne(AdminUserRole::className(), ['user_id' => 'id']);
    }

    public function getAccount()
    {
        return $this->hasMany(AdminHousekeeper::className(),['agentid'=>'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(AdminUserpeoduct::className(),['uid'=>'id']);
    }
  /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 包含text,select,checkbox,radio,file,password,hidden
     * isEdit   是否允许编辑，如果允许编辑将在添加和修改时输入
     * isSearch 是否允许搜索
     * isDisplay 是否在列表中显示
     * isOrder 是否排序
     * udc - udc code，inputtype为select,checkbox,radio三个值时用到。
     * 特别字段：
     * id：主键。必须含有主键，统一都是id
     * create_date: 创建时间。生成的代码自动赋值
     * update_date: 修改时间。生成的代码自动赋值
     */
    public function getTableColumnInfo(){
        return array(
        'id' => array(
                        'name' => 'id',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => '',
//                         'dbType' => "bigint(20) unsigned",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'string',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'bigint',
                        'unsigned' => true,
                        'label'=>$this->getAttributeLabel('id'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'uname' => array(
                        'name' => 'uname',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '用户名',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('uname'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'password' => array(
                        'name' => 'password',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '密码',
//                         'dbType' => "varchar(200)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '200',
                        'scale' => '',
                        'size' => '200',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('password'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'auth_key' => array(
                        'name' => 'auth_key',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '自动登录key',
//                         'dbType' => "varchar(50)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '50',
                        'scale' => '',
                        'size' => '50',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('auth_key'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'last_ip' => array(
                        'name' => 'last_ip',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '最近一次登录ip',
//                         'dbType' => "varchar(50)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '50',
                        'scale' => '',
                        'size' => '50',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('last_ip'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'is_online' => array(
                        'name' => 'is_online',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '是否在线',
//                         'dbType' => "char(1)",
                        'defaultValue' => 'n',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '1',
                        'scale' => '',
                        'size' => '1',
                        'type' => 'char',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('is_online'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'domain_account' => array(
                        'name' => 'domain_account',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '域账号',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('domain_account'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'status' => array(
                        'name' => 'status',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '状态',
//                         'dbType' => "smallint(6)",
                        'defaultValue' => '10',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '6',
                        'scale' => '',
                        'size' => '6',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('status'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'create_user' => array(
                        'name' => 'create_user',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '创建人',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('create_user'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'create_date' => array(
                        'name' => 'create_date',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '创建时间',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('create_date'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'update_user' => array(
                        'name' => 'update_user',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '更新人',
//                         'dbType' => "varchar(101)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '101',
                        'scale' => '',
                        'size' => '101',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('update_user'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'update_date' => array(
                        'name' => 'update_date',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '更新时间',
//                         'dbType' => "datetime",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'datetime',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('update_date'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
