<?php


/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;

use yii\helpers\Url;

use yii\bootstrap\Nav;

use yii\bootstrap\NavBar;

use yii\widgets\Breadcrumbs;

use frontend\assets\AppAsset;

use common\widgets\Alert;

use backend\models\AdminCat;

use common\helps\Tools;
use common\models\Common;
use backend\models\AdminMember;


AppAsset::register($this);

$cat = AdminCat::findAll(['pid' => 4]);

$uid = Yii::$app->session->get('user_id');

$member = AdminMember::findOne($uid);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>

    <title><?= Html::encode($this->title) ?></title>
    <meta name="keywords" content="<?= Common::getSysInfo(5) ?>"/>
    <meta name="description" content="<?= Common::getSysInfo(5) ?>"/>
</head>
<body ng-app="nlfapp">
<div class="head">
    <div class="headtop">
        <div class="main f-clear">
            <div class="fl"><?= Common::getSysInfo(5) ?>专业的股票撮合平台</div>
            <div class="fr">
                <ul class="headtop-nav">
                    <?php if($uid){?>
                    <li>
                        <a href="<?= Url::toRoute(['user/stock']) ?>" style="height: 38px;color: #fff">
                            <?= Common::getSysInfo(5) ?>欢迎您 <?=$member->usersname?>  <?=$member->realname?>！
                        </a>
                    </li>
                        <li><a href="<?= Url::toRoute(['user/logout']) ?>" class="help" style="color: #fff">退出</a></li>
                    <?php } else{ ?>
                    <li><a href="<?= Url::toRoute(['index/login']) ?>" class="help" style="color: #fff">登录</a></li>
                    <li><a href="<?= Url::toRoute(['index/register']) ?>" class="help" style="color: #fff">注册</a></li>
                    <?php } ?>
                    <li><a href="<?= Url::toRoute(['user/index']) ?>" style="color: #fff">个人中心</a></li>
                    <li><a href="<?= Url::toRoute(['news/help', 'cid' => 38]) ?>" style="color: #fff">帮助中心</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="headnav f-clear">
        <div class="main">
            <div class="fl logo">
                <a href="/">
                    <img src="<?= Common::getSysInfo(67) ?>"/></a>
            </div>

            <div class="fr nav" id="page1">
                <ul>
                    <li><a id="default" href="/">首页</a></li>
                    <li><a id="index" href="<?= Url::toRoute(['index/stocks']) ?>">股票行情</a></li>
                    <li><a id="stock" href="<?= Url::toRoute(['user/stock']) ?>">我的策略</a></li>
                    <li><a id="user" href="<?= Url::toRoute(['user/index']) ?>">账户中心</a></li>
                    <li class="last"><a id="about" href="<?= Url::toRoute(['news/about', 'id' => 256]) ?>">关于我们</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- nav end -->

<!--  -->


<?= $content ?>


<!--foot star-->


<div class="foot">
    <div class="footer-main f-clear">
        <div class="footer-fl">
            <p class="about"><span><a href="<?= Url::toRoute(['news/help', 'cid' => 38]) ?>">关于我们</a></span>股市有风险，入市需谨慎！
            </p>
            <img src="<?= Common::getSysInfo(67) ?>"
                 style="height: 70px"/>
        </div>
        <div class="footer-mid">
            <p class="phone" style="display: none;">客服QQ：<?= Common::getSysInfo(10) ?></p>

            <p>工作时间 周一至周五 09:00-17:00</p>

            <p><?= Common::getSysInfo(14) ?></p>
        </div>
        <!--<div class="footer-fr" style="display: none;">
            <p>微信公众号</p>
            <img src="upload/201601/21/201601211744599138.jpg"
                 alt="微信公众号" width="120"/>
        </div>-->
    </div>
</div>


<div class="kefu">
    <ul>

        <li class="l3" style="display: none;">
            <a href="javascript:;"></a>

            <div class="hide3">
                <a

                    target="_blank"><span>客服一</span><br/><i></i></a><a


                    target="_blank"><span>qq交流群</span><br/><i></i></a>
            </div>
        </li>
        <li class="l4"><a href="#page1" id="scrollTop"></a></li>
    </ul>
</div>

<!--/.page-footer-->


<!--foot end-->


<?php


if (Yii::$app->getSession()->hasFlash('error')) { ?>

    <script>

        var error = "<?=Yii::$app->getSession()->getFlash('error')?>";

        layer.alert(error, {icon: 2});

    </script>


<?php }


if (Yii::$app->getSession()->hasFlash('success')) { ?>

    <script>

        var success = "<?=Yii::$app->getSession()->getFlash('success')?>";

        layer.alert(success, {icon: 1});

    </script>

<?php }

?>

<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>

