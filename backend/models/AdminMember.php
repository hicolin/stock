<?php

namespace backend\models;

use mobile\controllers\Helper;
use Yii;

/**
 * This is the model class for table "admin_member".
 *
 * @property string $id
 * @property string $usersname
 * @property string $userspwd
 * @property string $xgj_name
 * @property string $xgj_pwd
 * @property string $tel
 * @property double $money
 * @property double $moneyFreeze
 * @property double $profit_money
 * @property integer $recom_id
 * @property integer $isopen
 * @property integer $dates
 * @property integer $logdates
 * @property string $logip
 * @property integer $lognums
 * @property integer $state
 * @property integer $sex
 * @property integer $edu
 * @property string $address
 * @property string $realname
 * @property string $cartid
 * @property string $cartfiles
 * @property string $email
 * @property integer $emailcheck
 * @property string $emailcode
 * @property integer $marry
 * @property string $nickname
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property string $rndcode
 * @property string $userspay
 * @property string $userspay2
 * @property string $bankid
 * @property string $bank_pic
 * @property string $bank_name
 * @property string $bank_tel
 * @property string $bankcode
 * @property string $bank_province
 * @property string $bank_city
 * @property string $bankaddress
 * @property string $bank_branch
 * @property integer $sfstatus
 * @property string $payordersid
 * @property string $vatation_code
 * @property string $vatation_code2
 * @property string $tx_pwd
 * @property string $openid
 * @property string $is_top
 * @property string $update_time
 * @property integer $account_id
 * @property integer $pid
 */
class AdminMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $verifyCode;

    public static function tableName()
    {
        return 'admin_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dates'], 'safe'],
            [['money', 'moneyFreeze','balance','profit_money'], 'number' ,'min' => 0],
            [['update_time','account_id','recom_id', 'isopen', 'dates', 'logdates', 'lognums', 'state', 'sex', 'edu', 'emailcheck', 'marry', 'province', 'city', 'area', 'sfstatus','bank_province','bank_city','pid'], 'integer'],
            [['address', 'realname', 'cartid', 'email', 'nickname', 'userspay', 'userspay2', 'bankaddress'], 'string', 'max' => 50],
            [['usersname', 'tel'], 'string', 'max' => 60],
            [['userspwd', 'xgj_pwd','openid','bank_branch'], 'string', 'max' => 255],
            [['xgj_name'], 'string', 'max' => 20],
            [['cartfiles'], 'string', 'max' => 300],
            [['logip'], 'string', 'max' => 15],
            [['emailcode'], 'string', 'max' => 500],
            [['rndcode'], 'string', 'max' => 10],
            [['bankid', 'bankcode'], 'string', 'max' => 22],
            [['payordersid'], 'string', 'max' => 30],
            [['vatation_code', 'vatation_code2'], 'string', 'max' => 16],
            ['bank_tel','match','pattern'=>'/^1[3-9]\d{9}$/'],
            ['bankid','match','pattern'=>'/^([1-9]{1})(\d{14,18})$/'],
            ['cartid','match','pattern'=>'/^\d{18}|\d{17}x$/i'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usersname' => '用户名',
            'userspwd' => '密码',
            'xgj_name' => '交易账号',
            'xgj_pwd' => '交易密码',
            'tel' => '手机号',
            'money' => '余额',
            'profit_money' => '交易盈亏',
            'moneyFreeze' => 'Money Freeze',
            'recom_id' => 'Recom ID',
            'isopen' => '是否开户',
            'dates' => '注册日期',
            'logdates' => '最后登录时间',
            'logip' => '最后登录IP',
            'lognums' => '登录次数',
            'state' => '实名状态',
            'sex' => '性别',
            'pid' => '推荐人ID',
            'edu' => '最高学历',
            'address' => '地址',
            'realname' => '姓名',
            'cartid' => '身份证号',
            'cartfiles' => '身份证件照',
            'email' => '邮箱',
            'emailcheck' => '邮箱审核',
            'emailcode' => 'Emailcode',
            'marry' => '婚姻状况',
            'nickname' => '昵称',
            'province' => '省',
            'city' => '市',
            'area' => '区',
            'tx_pwd' => '提现密码',
            'rndcode' => 'Rndcode',
            'userspay' => 'Userspay',
            'userspay2' => 'Userspay2',
            'bankid' => '银行卡号',
            'bankcode' => '银行名称',
            'bank_name' => '银行户名',
            'bank_pic' => '银行卡照片',
            'bank_province' => '开户行省',
            'bank_city' => '开户行市',
            'bankaddress' => '开户行支行',
            'balance' => '余额',
            'sfstatus' => 'Sfstatus',
            'payordersid' => 'Payordersid',
            'vatation_code' => '邀请码',
            'vatation_code2' => '被邀请码',
            'verifyCode' => '',
            'openid' => '',
            'is_top' => '',
            'update_time' => '审核时间',
            'account_id' => '主账户',

        ];
    }

      //判断
    public static function dropDownList($column,$value=null)
    {
        $dropDownList=[
            'is_emailcheck'=>[1=>'已审核',0=>'未审核'],
            'is_sex'=>[1=>'女',0=>'男'],
            'is_marry'=>[1=>'已婚',0=>'未婚'],
            'is_edu'=>["0"=>"本科","1"=>"专科","2"=>"研究生","3"=>"硕士","4"=>"博士","5"=>"博士后"],
            'is_isopen'=>[1=>'已开户',0=>'未开户'],
        ];
        if ($value !== null)
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        //返回关联数组，用户下拉的filter实现
        else
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
    }

    public static function Random_code(){
        $code = substr(md5(uniqid(rand(),1)),0,16);
        $result=self::find()->where(array('vatation_code'=>$code))->one();
        if($result){
            self::Random_code();
        }
        else{
            return $code;
        }
    }

    /**
     * 根据id  返回用户真实名称
     * @param $id
     * @return mixed
     */
    public static function getName($id)
    {
        $member =  Yii::$app->db->createCommand("select realname from admin_member WHERE id =".$id)->queryOne();
        return $member['realname'];
    }
    /**
     * 根据父id返回所有会员的id
     */
    public static function getMid($arr)
    {
        $mid = array();
        foreach($arr as $k=>$v){
            $model = AdminMember::find()->where(['pid'=>$v])->all();
            if($model){
                foreach($model as $list){
                    $mid[] = $list->id;
                }
            }
        }
        return $mid;
    }

    public function register($tel, $pwd, $inviteCode, $pid)
    {
        $this->usersname = $tel;
        $this->tel = $tel;
        $this->userspwd = Yii::$app->security->generatePasswordHash($pwd);
        $this->dates = time();
        $this->vatation_code2 = $inviteCode;
        $this->vatation_code = Helper::getInvitation();
        $this->pid = $pid;
        if ($this->save()) {
            return ['status' => 200, 'msg' => '保存成功'];
        } else {
            $errors = $this->getErrors();
            foreach ($errors as $field) {
              return ['status' => 100, 'msg' => $field[0]];
            }
        }
    }

    public function certificate($name, $idCard, $bankTel, $bank, $bankNo, $area, $branch)
    {
        $this->realname = $name;
        $this->cartid = $idCard;
        $this->bank_tel = $bankTel;
        $this->bankcode = $bank;
        $this->bankid = $bankNo;
        $this->bankaddress = $area;
        $this->bank_branch = $branch;
        $this->state = 1;
        if ($this->save()) {
            return ['status' => 200, 'msg' => '保存成功'];
        } else {
            $errors = $this->getErrors();
            foreach ($errors as $field) {
                return ['status' => 100, 'msg' => $field[0]];
            }
        }
    }

}
