<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mobile\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'mobile/web/css/layout.css',
//        'css/baby.css',
    ];
    public $js = [
        'mobile/web/js/jquery-1.8.3.min.js',
        'mobile/web/js/layer.js',
    ];
    public $depends = [
       /* 'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',*/
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,   // 这是设置所有js放置的位置
    ];
}
