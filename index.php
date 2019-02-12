<?php

define("ROOT",__DIR__);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('YII_ENV_DEV') or define('YII_ENV_DEV', true);

error_reporting(0);

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/common/config/bootstrap.php');

if(is_mobile()){
   require(__DIR__ . '/mobile/config/bootstrap.php');
}else{
    require(__DIR__ . '/frontend/config/bootstrap.php');
}

if(is_mobile()){
   $config = yii\helpers\ArrayHelper::merge(
       require(__DIR__ . '/common/config/main.php'),
       require(__DIR__ . '/mobile/config/main.php')
   );
}else{
    $config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/common/config/main.php'),
        require(__DIR__ . '/frontend/config/main.php')
    );
}

$application = new yii\web\Application($config);
$application->run();

function is_mobile()
{
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $is_pc = (strpos($agent, 'windows nt')) ? true : false;
    $is_mac = (strpos($agent, 'mac os')) ? true : false;
    $is_iphone = (strpos($agent, 'iphone')) ? true : false;
    $is_android = (strpos($agent, 'android')) ? true : false;
    $is_ipad = (strpos($agent, 'ipad')) ? true : false;
    if($is_pc){
        return  false;
    }
    if($is_mac){
        return  true;
    }
    if($is_iphone){
        return  true;
    }
    if($is_android){
        return  true;
    }
    if($is_ipad){
        return  true;
    }
}



