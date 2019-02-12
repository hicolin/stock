<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;

/**
 * ContentController implements the CRUD actions for AdminContent model.
 */
class PublicController extends Controller
{
    public $enableCsrfValidation = false ;
    public function actionUpload()
    {
        $uploaddir = 'backend/web/plugins/uploads/';
        $info=pathinfo($_FILES['uploadfile']['name'],PATHINFO_EXTENSION);
        $dir=$uploaddir .date('Ymd').rand(10000,99999).'.'.$info;
        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'],$dir)) {
            $re['dir']='/'.$dir;
            $re['msg']="上传成功";
            $re['status']=200;
            echo json_encode($re);
        } else {
            $re['msg']="上传失败";
            echo json_encode($re);
        }
    }

    public function actionFile()
    {
        $uploaddir = 'uploads/file/';
        $info=pathinfo($_FILES['uploadfile']['name'],PATHINFO_EXTENSION);
        $dir=$uploaddir .date('Ymd').rand(10000,99999).'.'.$info;
        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'],$dir)) {
            $re['dir']='/'.$dir;
            $re['msg']="上传成功";
            $re['status']=200;
            echo json_encode($re);
        } else {
            $re['msg']="上传失败";
            echo json_encode($re);
        }
    }

    public static function getXgjInfo($xgj_name)
    {
        $url = 'https://106.15.47.118:13134/queryaccount?requestid=6&sa=dsf1110011001&sapass=967865&account='.$xgj_name;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($curl);
        curl_close($curl);
        //返回结果写入xml文件并删除第一行
        $file_add = "xml/$xgj_name.xml";
        file_put_contents($file_add,$data);
        $fn = "xml/$xgj_name.xml";
        $f= fopen($fn, "r");
        $line = fgets($f);
        ob_start();
        fpassthru($f);
        fclose($f);
        file_put_contents($fn, ob_get_clean() );
        //去除生成的xml文件前后空格
        $file_path = 'xml/'."$xgj_name.xml";
        if(file_exists($file_path)){
            $fp = fopen($file_path,"r");
            $str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
            $str = trim($str);
            file_put_contents($file_path,$str);
        }
        $xml = simplexml_load_file('xml/'.$xgj_name.'.xml');
        $results = $xml->Result->Summary;
        //var_dump($results);exit;
        $arr = [];
        foreach ($results as $key => $value) {
            $arr[] = $value;
            // print_r($value);
        }
        return  $arr[0];
        echo ( $arr[0]->Balance);exit;
    }

}
