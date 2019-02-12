<?php

namespace backend\controllers;
use backend\models\AdminAccount;
use common\models\Common;
use Yii;
use yii\web\Controller;
use backend\models\AdminMember;

/**
 * ContentController implements the CRUD actions for AdminContent model.
 */
class PublicController extends Controller
{
    public $enableCsrfValidation = false ;

    /**
     * 清除缓存
     */
    public function actionClearCache(){
        $cache=Yii::$app->cache;
        if($cache->flush()){
            echo json_encode(['status'=>1]);
        }
    }

    /**
     * 上传文件
     */
    public function actionUploadFile()
    {
        $ext = pathinfo($_FILES['uploadfile']['name'],PATHINFO_EXTENSION);
        $upload_path = "uploads/file/".date("Ym")."/";
        $file = date("Ymd").rand(10,99).time().".".$ext;
        if(!is_dir($upload_path)){
            if(!mkdir($upload_path,0777,true)){
                exit("无法建立保存图片的目录！");
            }
        }
        $size = $_FILES['uploadfile']['size'];
        if($size>(20000*1024)){
            $re['msg']="文件大小不超过20M";
            echo json_encode($re);exit;
        }
        if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $upload_path.$file)){
            $re['dir']='/'.$upload_path.$file;
            $re['msg']="上传成功";
            $re['status']=200;
        }else{
            $re['msg']="上传失败";
        }
        echo json_encode($re);exit;
    }

    /**
     * 下载文件
     */
    public function actionDownloadFile(){
        ob_end_clean();
        $file = yii::$app->request->get('file');
        $fileName = yii::$app->request->get('fileName');
        //文件绝对路径
        $path_name = Yii::getAlias('@root').$file;
        $ext=pathinfo($path_name,PATHINFO_EXTENSION);
        $save_name=isset($fileName) ? $fileName : time();
        $hfile = fopen($path_name, "rb") or die("Can not find file: $path_name\n");
        Header("Content-type: application/octet-stream");
        Header("Content-Transfer-Encoding: binary");
        Header("Accept-Ranges: bytes");
        Header("Content-Length: ".filesize($path_name));
        Header("Content-Disposition: attachment; filename=\"$save_name\".".$ext);
        while (!feof($hfile)) {
            echo fread($hfile, 32768);
        }
        fclose($hfile);
    }


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

    /**
     * 上传图片
     */
    public function actionUploadImage()
    {
        $ext = pathinfo($_FILES['uploadfile']['name'],PATHINFO_EXTENSION);
        $upload_path = "uploads/image/".date("Ym")."/";
        $file = date("Ymd").rand(10,99).time().".".$ext;
        if(!is_dir($upload_path)){
            if(!mkdir($upload_path,0777,true)){
                exit("无法建立保存图片的目录！");
            }
        }
        $size = $_FILES['uploadfile']['size'];
        if($size>(6000*1024)){
            $re['msg']="图片大小不超过6M";
            echo json_encode($re);exit;
        }
        if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $upload_path.$file)){
            $re['dir']='/'.$upload_path.$file;
            $re['msg']="上传成功";
            $re['status']=200;
        }else{
            $re['msg']="上传失败";
        }
        echo json_encode($re);exit;
    }
    /**
     * 上传文件
     * @param string $name   表单名称
     * @param string $type   文件类型
     * @return mixed
     */
    public function actionFile1($name='file',$type='image')
    {
        // echo 11;exit;
        return Common::upload($name,$type);
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
        $model = AdminMember::find()->where(['xgj_name'=>$xgj_name])->one();
        $account = AdminAccount::findOne($model->account_id);
        $pass = self::decrypt($account->pass);
        $url = 'https://106.15.47.118:13134/queryaccount?requestid=6&sa='.$account->account.'&sapass='.$pass.'&account='.$xgj_name;
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

    /**
     * 加密
     */
    public static function encrypt($string='',$skey='')
    {
        $strArr = str_split(base64_encode($string));
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value)
            $key < $strCount && $strArr[$key].=$value;
        return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));        var_dump($aa);
    }

    /**
     * 解密
     */
    public static function decrypt($string='',$skey='')
    {
        $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value)
            $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
        return base64_decode(join('', $strArr));
    }

}
