<?php
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--main-->
<div class="help_center_main">
    <div class="hcm_con">
        <ul>
            <?php foreach ($cate as $list) : ?>
            <li>
                <a href="<?= Url::to(['index/article-detail','id'=>$list['id']])?>">
                    <?= $list['name']?>
                    <i class="fr dmfont dm-arrow-right"></i>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<!--main end-->