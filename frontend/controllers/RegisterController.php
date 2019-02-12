<?php
/**
 * 前台注册登录
 */
namespace frontend\controllers;
use backend\models\AdminContent;
use backend\models\AdminSetting;
use common\models\Common;
use backend\models\AdminMember;
use backend\models\AdminUser;
use yii\web\Controller;
use yii\filters\VerbFilter;
use \yii\web\Cookie;
use Yii;

class RegisterController extends Controller
{
    public $layout = false;

    public function actionRegister()
    {   
        $is_yopen = AdminSetting::findOne(53)->val;

        return $this->render('register',[
            'is_yopen'=>$is_yopen,

        ]);
    }
    //注册操作
    public function actionRegisteradd(){
            $is_yopen = AdminSetting::findOne(53)->val;
            $member = new AdminMember;
            $scode =Yii::$app->session->get('bank-code');
            $smobile=Yii::$app->session->get('bank-tel');
            $mobile = Yii::$app->request->post('mobile');
            $password = Yii::$app->request->post('password');
            $mobilecode = Yii::$app->request->post('mobilecode');

            $patter = "/^1(3|4|5|7|8)\d{9}$/";
            if(preg_match($patter,$mobile)){
                $mobiles = AdminMember::find()->where(['tel'=>$mobile])->one();
            }else{
                $mobiles = AdminMember::find()->where(['usersname'=>$mobile])->one();
            } 
            if($mobiles){
                return 500;
            }           
            $count = AdminMember::find()->where('tel=' . $mobile)->count();
            if($is_yopen==1){
                $yqm = Yii::$app->request->post('yqm');
                $user = AdminUser::findOne(['vatation_code'=>$yqm]);
                if(!$user) {
                    return 400;
                }
            }else{
                $user = AdminUser::findOne(156);
                $yqm = $user->vatation_code;
            }
        if (($scode != $mobilecode) || ($mobile != $smobile)) {
            return 300;
        }elseif ($count > 0) {
            return 200;
        }else{
            $member->usersname = $mobile;
            $member->vatation_code = Common::getInvitation();
            $member->userspwd = Yii::$app->getSecurity()->generatePasswordHash($password);//加密密码
            $member->vatation_code2 = $yqm;
            $member->pid = $user->id;
            $member->tel = $mobile;
            $member->dates = time();
            if ($member->save(false)) {
                if ($yqm) {
                    $pre_member = AdminMember::find()->where(['vatation_code' => $yqm])->one();
                }

               return 100;
            }

         }    
    }


    public function actionLogin()
    {
        $tels=$_COOKIE['tels'];
        $passwords = $_COOKIE['passwords'];
      
        return $this->render('login',[
            'tels' =>$tels,
            'passwords'=>$passwords, 


        ]);
    }

    public function actionLoginadd()
    {   
        $tel = Yii::$app->request->post('mobile');
        $password = Yii::$app->request->post('password');
        $checkbox = Yii::$app->request->post('checkbox');
//        var_dump($checkbox);exit;
        $patter = "/^1(3|4|5|7|8)\d{9}$/";
        if(preg_match($patter,$tel)){
            $pwd = AdminMember::find()->where('tel=' . $tel)->one();
        }else{
            $pwd = AdminMember::find()->where(['username'=>$tel])->one();
        }
        if(empty($pwd)){
            return 300;
        }        
        if (Yii::$app->security->validatePassword($password, $pwd->userspwd)) {
            Yii::$app->session->set('user_id', $pwd->id); 
            Yii::$app->session->set('tel', $pwd->tel);
            if($checkbox==1&&empty($_COOKIE['tels'])&&empty($_COOKIE['passwords'])){
                setcookie("tels",$tel,time()+60000);
                setcookie("passwords",$password,time()+60000);
            }elseif($checkbox==2){
                setcookie("tels","",time()-1);
                setcookie("passwords","",time()-1);
            }

            return 100;
        } else {
            return 200;
        }            
        
    }

    public function actionLoginout()
    {
        Yii::$app->session['user_id'] = '';
        Yii::$app->session['tel'] = '';
        $url = Yii::$app->urlManager->createAbsoluteUrl(['index/index']);
        $this->redirect($url);
        return;

    }

    /**
     * 忘记密码
     */
    public function actionForgetPassword()
    {
        return $this->render('forget-password');
    }

    public function actionForgetPass()
    {

        $scode2 =Yii::$app->session->get('bank-code');
        $smobile2=Yii::$app->session->get('bank-tel');
        $tel = Yii::$app->request->post('mobile');
        $password = Yii::$app->request->post('password');
        $confirmpassword = Yii::$app->request->post('confirmpassword');
        $mobilevcode = Yii::$app->request->post('mobilevcode');
        $member =AdminMember::find()->where("tel=$tel")->one();
        if($member){
            if($scode2==$mobilevcode && $tel==$smobile2){
                if($password == $confirmpassword){
                $member->userspwd = Yii::$app->getSecurity()->generatePasswordHash($password);
                if ($member->save(false)) {
                    return 100;
                    }
                }else{
                    return 200;
                }
              }else{
                    return 300;
              }

            } else{
                    return 400;
            }
        }


    public function actionCode()
    {

        $mobile = Common::filter(Yii::$app->request->post('mobile'));
        //记得做手机号或用户名的判断
         $rand = rand(100000,999999);
        Yii::$app->session['bank-tel'] = $mobile;
        Yii::$app->session['bank-code'] = $rand;
//      $temp = AdminSetting::findOne(44)->val;

        $status = Common::getKxt($mobile,$rand); //


        if ($status) {
            Yii::$app->session['bank-tel'] = $mobile;
            Yii::$app->session['bank-code'] = $rand;
            return 600;
        }else{
            return 400;
        }
    }

    //发送邮件
    public function actionSendEmail(){
       
        $address=Yii::$app->request->post('sendemail');
        // return $address;
        // $title=Yii::$app->request->post('title');
        $title='绑定邮箱';
        $code = rand(100000,999999);
        Yii::$app->session['secode'] = $code;
        Yii::$app->session['semail'] = $address;
        $mail=Yii::$app->mailer->compose();
        $mail->setTo('2885135623@qq.com');
        $mail->setSubject('绑定邮箱');
        $mail->setHtmlBody('200001');
        if($mail->send()){
            return 100;
        }else{
            return 200;
        }        

    }
    public function actionAgreement(){
        $post = AdminContent::findOne(14);
        echo $post['contact'];
    }


}