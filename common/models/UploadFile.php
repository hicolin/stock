<?php
namespace common\models;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\helpers\FileHelper;
/**
 * UploadForm is the model behind the upload form.
 */
class UploadFile extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $path;
    public $w;
    public $h;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'],'file'],
        ];
    }

    /**
     * @param string $type      上传文件类型 image video audio file
     * @return string
     */
    public function upload($type='image'){
        $fileType = [
            'image' => ['png','jpg','gif'],
            'video' => ['mp4'],
            'audio' => ['mp3'],
            'file' => ['xls','xlsx','csv','xltx','docx','doc','dotx'],
        ];
        //$name = $this->file->extension;
        if(!in_array($type,['image','video','audio','file'])) {
            $type = 'image';
        }
        if(!in_array($this->file->extension,$fileType[$type])) {
            $message['msg'] = '不允许上传"'. $type. '"类型的文件';
            $message['status'] = 300;
            $message['path'] = '';
        }else {
            $path = 'uploads/' . $type . '/' . date('Ymd');
            $this->path = $path . '/' . $this->randName() .'.'. $this->file->extension;
            $this->createDir($path);
            $this->file->saveAs($this->path);
            $message['msg'] = '上传成功';
            $message['path'] = $this->path;
            $message['status'] = 200;
        }
        return json_encode($message);
    }

    /**
     * 生成缩略图
     * @param string $filename      源文件名称
     * @param int $width            缩略图宽
     * @param int $height           缩略图高
     * @param int $quality          质量
     * @param int $type             类型，1是填充，2是裁剪
     * @return string
     */
    public function createThumbnail($filename, $width=100, $height=100, $quality=100, $type=1)
    {
        $path = Yii::getAlias('@root').'/uploads/image/'.date('Ymd').'/thumb/';
        $this->createDir($path);                    //判断文件夹是否存在并创建
        $toFile = $path.$this->randName().'.png';   //缩略图文件路径
        $model = $type==1?ManipulatorInterface::THUMBNAIL_INSET:ManipulatorInterface::THUMBNAIL_OUTBOUND;
        Image::thumbnail($filename,$width,$height,$model)->save($toFile,['quality' => $quality]);
        $this->path = $toFile;
    }

    /**
     * 裁剪图片
     * @param $filename
     * @param int $width
     * @param int $height
     * @param array $start      裁剪起始坐标
     * @param int $quality      质量
     * @return string
     */
    public function cropImage($filename, $width=100, $height=100, array $start = [0, 0], $quality=100)
    {
        $path = Yii::getAlias('@root').'/uploads/image/'.date('Ymd').'/crop/';
        $this->createDir($path);                    //判断文件夹是否存在并创建
        $toFile = $path.$this->randName().'.png';   //裁剪图文件路径
        Image::crop($filename,$width ,$height,$start)->save($toFile, ['quality' => $quality]);
        $this->path = $toFile;
    }

    /**
     * 添加水印图片
     * @param $filename         源文件
     * @param $waterFile        水印文件
     * @param array $start      起始位置
     * @param int $quality      质量
     */
    public function waterImage($filename, $waterFile, array $start = [0, 0], $quality=100)
    {
        $path = Yii::getAlias('@root').'/uploads/image/'.date('Ymd').'/water/';
        $this->createDir($path);                    //判断文件夹是否存在并创建
        $toFile = $path.$this->randName().'.png';   //裁剪图文件路径
        Image::watermark($filename,$waterFile,$start)->save($toFile, ['quality' => $quality]);
        $this->path = $toFile;
    }

    /**
     * 添加水印文字
     * @param $filename             \\源文件
     * @param int $text             文字
     * @param string $fontFile      字体路劲
     * @param array $fontOption     配置
     * @param array $start          起始位置
     * @param int $quality          质量
     */
    public function textImage($filename, $text=1234, $fontFile='', array $fontOption=['size'=>12,'color'=>'#000'], array $start = [12, 12], $quality=100)
    {
        $fontFile = $fontFile?:Yii::getAlias('@root').'/frontend/web/font/04B_20__.TTF';
        $path = Yii::getAlias('@root').'/uploads/image/'.date('Ymd').'/text/';
        $this->createDir($path);                    //判断文件夹是否存在并创建
        $toFile = $path.$this->randName().'.png';   //裁剪图文件路径
        Image::text($filename,$text,$fontFile,$start,$fontOption)->save($toFile, ['quality' => $quality]);
        $this->path = $toFile;
    }


    /**
     * 旋转图片
     * @param $filename
     * @param int $margin
     * @param string $color
     * @param int $alpha
     * @param int $angle
     * @param int $quality
     */
    public function frameImage($filename, $margin=0, $color='fff', $alpha=100, $angle=-8, $quality=50)
    {
        $path = Yii::getAlias('@root').'/uploads/image/'.date('Ymd').'/frame/';
        $this->createDir($path);                    //判断文件夹是否存在并创建
        $toFile = $path.$this->randName().'.png';   //裁剪图文件路径
        Image::frame($filename, $margin, $color, $alpha)->rotate($angle)->save($toFile, ['quality' => $quality]);
        $this->path = $toFile;
    }

    /**
     * 随机生成文件名
     * @param int $length
     * @return bool|string
     */
    protected function randName($length = 10) {
        $str = 'abcdefghijkmnpqrstuvwxyz23456789';
        return substr(md5(str_shuffle($str)),0,$length);
    }

    /**
     * 创建一个文件夹
     * @param $path
     * @return bool
     * @throws \yii\base\Exception
     */
    public function createDir($path)
    {
        if(!file_exists($path)){
            if(!FileHelper::createDirectory($path)){
                return false;
            }
        }
    }

}
