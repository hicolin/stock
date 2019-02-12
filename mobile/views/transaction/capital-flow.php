
<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--main -->
<div class="cf_main">
    <?php if (empty($funds)) : ?>
        <?php $this->beginContent('@app/views/layouts/empty.php');?>
        <?php $this->endContent();?>
    <?php else : ?>
        <?php foreach ($funds as $list) : ?>
            <div class="cf_main_item">
                <ul>
                    <li>
                        订单ID：<span><?= $list['order_id']?></span>
                    </li>
                    <li>
                        金额：<span class="main_color"><?= $list['amount']?></span>
                    </li>
                    <li>
                        账户余额：<span><?= $list['money']?></span>
                    </li>
                    <li>
                        时间：<span><?= date('Y-m-d H:i',$list['created_time'])?></span>
                    </li>
                    <li>
                        备注：<span><?= $list['title']?></span>
                    </li>
                </ul>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>
<!--main end-->
