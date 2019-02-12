<?php
use yii\helpers\Url;
use \common\helps\Tools;//使用工具类
use yii\widgets\LinkPager;

?>
<link rel="stylesheet" type="text/css" href="<?= Url::base() ?>/frontend/web/css/style.css"/>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<!--nav star-->
<div class="nav">
    <div class="w1200">
        <h1>
            <span>下载中心</span>
            <i>Download center </i>
        </h1>
    </div>
</div>
<!--nav end-->

<!--main star-->
<div class="do-main">
    <div class="w1200">
        <div class="main-con">
            <ul>
                <?php
                 foreach ($file as $list) { ?>
                     <li>
                         <a target="_blank" href="<?=$list->file_path?>">
                             <img src="<?=$list->file_cover?>"/>
                         </a>
                         <a target="_blank" href="<?=$list->file_path?>">
                             <img src="<?= Url::base() ?>/frontend/web/images/xz.png"/>
                         </a>
                     </li>
                 <?php }
                ?>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="news-r-bot">
            <?= LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',

            ]); ?>
        </div>
    </div>
</div>
<!--main end-->


<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
