<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use mobile\controllers\Helper;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title).' - '. Helper::getSysInfo(5) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="keywords" content=" "/>
    <meta name="author" content="order by www.lision.cn"/>
    <meta name="description" content=" "/>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/basic.css">
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/animotion.css">
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/index.css">
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/quote_center.css">
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/transaction.css">
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/user.css">
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/iconfont.css">
    <link rel="stylesheet" href="<?= Url::base()?>/mobile/web/plugins/font-awesome/css/font-awesome.min.css">
<!--    <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_1019128_q9jtbsjeawl.css">-->

    <?php if(isset($this->blocks['header'])):?>
        <?= $this->blocks['header'];?>
    <?php endif;?>

    <script src="<?= Url::base()?>/mobile/web/js/jquery-1.8.3.min.js"></script>
    <script src="<?= Url::base()?>/mobile/web/js/common.js"></script>

    <?php $this->head() ?>
</head>
<body style="display: none">

<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>

<!--<script src="//cdn.jsdelivr.net/npm/eruda"></script>-->
<!--<script>eruda.init();</script>-->

<script src="<?= Url::base()?>/mobile/web/js/layer/mobile/layer.js"></script>
<script src="<?= Url::base()?>/mobile/web/js/TouchSlide.1.1.js"></script>
<script src="<?= Url::base()?>/mobile/web/js/swiper-3.4.0.jquery.min.js"></script>
<script src="<?= Url::base()?>/mobile/web/js/mui.min.js"></script>
<script src="<?= Url::base()?>/mobile/web/js/aui-scroll.js"></script>
<script src="<?= Url::base()?>/mobile/web/js/global.js"></script>

<?php if(isset($this->blocks['footer'])):?>
    <?= $this->blocks['footer'];?>
<?php endif;?>

<script>
    $("body").css("display","block");

    // 返回键处理 需要mui.js版本
    document.addEventListener('plusready', function() {
        var webview = plus.webview.currentWebview();
        plus.key.addEventListener('backbutton', function() {
            webview.canBack(function(e) {
                if(e.canBack) {
                    webview.back();
                } else {
                    //webview.close(); //hide,quit
                    //plus.runtime.quit();
                    mui.plusReady(function() {
                        //首页返回键处理
                        //处理逻辑：1秒内，连续两次按返回键，则退出应用；
                        var first = null;
                        plus.key.addEventListener('backbutton', function() {
                            //首次按键，提示‘再按一次退出应用’
                            if(!first) {
                                first = new Date().getTime();
                                mui.toast('再按一次退出应用');
                                setTimeout(function() {
                                    first = null;
                                }, 1000);
                            } else {
                                if(new Date().getTime() - first < 1500) {
                                    plus.runtime.quit();
                                }
                            }
                        }, false);
                    });
                }
            })
        });
    });
</script>

</body>
</html>
<?php $this->endPage() ?>
