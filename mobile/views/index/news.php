<?php
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');?>
<link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/news.css">
<?php $this->endBlock();?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--main-->
<div class="new_list_main">
    <ul>
        <?php foreach ($news as $list) : ?>
        <li>
            <a href="<?= Url::to(['index/article-detail', 'id' => $list['id'], 'type' => 2])?>">
                <img src="<?= Url::base().$list['img']?>" class="nlm_img fr"/>
                <h1><?= $list['title']?></h1>
                <p><?= date('Y-m-d', $list['addtime'])?></p>
            </a>
        </li>
        <?php endforeach;?>
    </ul>
</div>
<!--main end-->