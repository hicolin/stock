<?php
use yii\helpers\Url;
?>

<?php $this->beginBlock('header'); ?>
<style>
    .main{color: #fff;padding: .1rem}
    .main .download{display: flex;flex-direction: column;align-items: center;margin-top: .5rem}
    .download a{color: #fff;display: inline-block;width: 65%;text-align: center;border-radius: .03rem;line-height: .4rem;height: .4rem}
    .download .android{background-color: rgb(94, 148, 255)}
    .download .ios{background-color: rgb(57, 61, 73);margin-top: .2rem}
</style>
<?php $this->endBlock(); ?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<div class="main">
    <div class="download">
        <a href="<?= Url::base()?>/mobile/web/app/android.apk" class="android">
            <i class="fa fa-android" style="font-size: .2rem;margin-right: .2rem"></i>安卓下载
        </a>
        <a href="<?= Url::base()?>/mobile/web/app/ios.ipa" class="ios">
            <i class="fa fa-apple" style="font-size: .2rem;margin-right: .2rem"></i>苹果下载
        </a>
    </div>
</div>