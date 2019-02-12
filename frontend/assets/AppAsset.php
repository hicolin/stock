<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

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
       'frontend/web/css/layout.css',
      'frontend/web/css/top-foot.css',
//       'frontend/web/zqcss/global.css',
 //       'frontend/web/zqcss/index.css',
//       'frontend/web/zqcss/system.css',
//        'frontend/web/zqcss/about.css',
//        'frontend/web/zqcss/new.css',
//        'frontend/web/zqcss/help.css',
//        'frontend/web/zqcss/account.css',
//        'frontend/web/zqcss/common.css',
//        'frontend/web/zqcss/management.css',
//        'frontend/web/zqcss/main(1).css',
//        'frontend/web/zqcss/center.css',
//        'frontend/web/zqcss/details.css',
//        'frontend/web/zqcss/recharge.css',
//        'frontend/web/zqcss/withdrawal.css',
//        'frontend/web/zqcss/layout.css',
//        'frontend/web/zqcss/details.css',
//        'frontend/web/zqcss/down.css',

       'css/baby.css',
    ];
    public $js = [
        'frontend/web/js/jquery-1.8.3.min.js',
        'frontend/web/zqjs/slider.js',
        'frontend/web/js/jquery.SuperSlide.2.1.1.js',
        'frontend/web/js/jquery.SuperSlide.2.1.2.js',
        'frontend/web/js/layer.js',
        'frontend/web/zqjs/cfw.min.js',
        'frontend/web/zqjs/a.js',
        'frontend/web/zqjs/layer.js',
    ];
//    public $js = [
//        'frontend/web/js/jquery-1.8.3.min.js',
//        'frontend/web/js/banner-slide.js',
//        'frontend/web/js/business.js',
//        'frontend/web/js/common.js',
//        'frontend/web/js/index.js',
//        'frontend/web/js/jquery.cityselect.js',
//        'frontend/web/js/jquery.date_input.pack.js',
//        'frontend/web/js/jquery.SuperSlide.2.1.1.js',
//        'frontend/web/js/jquery.SuperSlide.2.1.2.js',
//        'frontend/web/js/layer.js',
//        'frontend/web/js/person.js',
//    ];
    public $depends = [
       /* 'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',*/
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,   // 这是设置所有js放置的位置
    ];
}
