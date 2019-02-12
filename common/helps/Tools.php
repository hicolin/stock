<?php
namespace common\helps;
use backend\models\AdminContent;
use backend\models\AdminSetting;
use backend\models\AdminLink;
use Yii;
/*
 * 自定义全局公共方法
 */
class Tools extends \yii\db\ActiveRecord
{

    /*
     * 截取并处理字符串
     * $str 处理的字符串
     * $len 截取的长度
     * $add 后面是否加...
     * */
    public static function subStr($str,$len=0,$add=true){
        if( $len < mb_strlen($str,'utf8') && $len && $add) {
            $str = mb_substr($str,0,$len,'utf-8').'...';
        } else {
            $str = mb_substr($str,0,$len,'utf-8');
        }
        return $str;
    }

    /*
     * 网站配置
     * */
   public static function getSetting($k='')
   {
       $setting = AdminSetting::find()->asArray()->all();
       $arr = [];
       foreach ($setting as $list) {
           $arr[$list['id']] = $list['val'];
           $arr[$list['key']] = $list['val'];
       }
       return $arr[trim($k)];
   }

   /*
    * 获取友情链接
    * */
   public static function getLinks()
   {
       return Adminlink::find()->where(['link_type'=>1])->all();
   }

}
?>