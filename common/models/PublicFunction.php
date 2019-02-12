<?php
namespace common\models;

use Yii;
use yii\base\Model;


/**
 * Login form
 */
class PublicFunction extends Model
{

    /*
        @$address  收件人邮箱 
        @subject   邮件标题
        @message   邮件内容
    */
public static function sendmailer($address='',$subject='',$message=''){
    require_once dirname(__FILE__).'./../../vendor/phpmailer/phpmailer/class.phpmailer.php';

    $mail        = new \PHPMailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;
    $mail->IsHTML(true);
    //$mail->SMTPDebug = 3;
    // 设置邮件的字符编码，若不指定，则为'UTF-8'
    $mail->CharSet = 'UTF-8';
    // 添加收件人地址，可以多次使用来添加多个收件人
    $mail->AddAddress($address);
    // 设置邮件正文
    $mail->Body = $message;
    // 设置邮件头的From字段。
    $mail->From = 'aavt99@163.com';
    // 设置发件人名字
    $mail->FromName = 'lifeng';
    // 设置邮件标题
    $mail->Subject = $subject;
    // 设置SMTP服务器。
    $mail->Host ='smtp.163.com';
    //by Rainfer
    // 设置SMTPSecure。
    
    // $mail->SMTPSecure ='tls';
    // 设置SMTP服务器端口。
    
    $mail->Port = '25';  //重要的一步
    // 设置为"需要验证"
    $mail->SMTPAuth    = true;
    $mail->SMTPAutoTLS = false;
    $mail->Timeout     = 10;
    // 设置用户名和密码。
    $mail->Username ='aavt99@163.com';
    $mail->Password ='aavt123456';
    // 发送邮件。
    if (!$mail->Send()) {
        ob_end_clean();
        $mailError = $mail->ErrorInfo;
        return 200;
        // return ["error" => 1, "message" => $mailError];
    } else {
        ob_end_clean();
        return 100;
        // return ["error" => 0, "message" => "success"];
    }
    

    }

    public function aa(){

        echo "1";exit;
    }


}




