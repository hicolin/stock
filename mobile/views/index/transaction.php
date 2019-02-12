<?php
use yii\helpers\Url;
use common\models\Common;
?>

<?php $this->beginContent('@app/views/layouts/header.php');?>
<?php $this->endContent()?>

<!--tranTop-->
<div class="tranTop">
    <div class="tranTop_con">
        <div class="tranTop_con_list">
            <ul>
                <li>
                    <h1>信用权益</h1>
                    <p><span><?= $dt_m ?: '0.00' ?></span>元</p>
                </li>
                <li>
                    <h1>可用权益</h1>
                    <p><span><?= $onelist->money ?: '0.00' ?></span>元</p>
                </li>
                <li>
                    <h1>冻结权益</h1>
                    <p><span><?= $dj_m['money'] ?: '0.00' ?></span>元</p>
                </li>
                <li>
                    <h1>总体权益</h1>
                    <p><span><?= $onelist->money * Common::getSysInfo(71) ?: '0.00' ?></span>元</p>
                </li>
                <li>
                    <h1>证券市值</h1>
                    <p><span><?= $z ?: '0.00' ?></span>元</p>
                </li>
                <li>
                    <h1>持仓盈亏</h1>
                    <p><span><?= $profit['profit'] ?: '0.00' ?></span>元</p>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="tranTop_con_bot tc">
            延期总费用<span><?= $jS['dy'] ?: '0.00'?></span>（元）<br>
            <b style="font-weight: normal" id="ycfykt">
                <?php if ($syBzj > 0) {
                    echo '此刻保证金充足，请注意盘中变化';
                } elseif ($syBzj < 0) {
                    echo '此刻保证金不足，欠缺' . abs($syBzj) . '元';
                } ?>

            </b>
        </div>
    </div>
</div>
<!--tranTop end-->


<!--tranList-->
<div class="tranList">
    <ul>
        <li>
            <a href="<?=Url::toRoute(['index/quote'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/tran_icon/tran_icon1.png"/>
                <p>买入</p>
            </a>
        </li>
        <li>
            <a href="<?=Url::toRoute(['transaction/sale'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/tran_icon/tran_icon2.png"/>
                <p>卖出</p>
            </a>
        </li>
<!--        <li>-->
<!--            <a href="--><?//=Url::toRoute(['transaction/cd'])?><!--">-->
<!--                <img src="--><?//= Url::base()?><!--/mobile/web/images/tran_icon/tran_icon3.png"/>-->
<!--                <p>撤单</p>-->
<!--            </a>-->
<!--        </li>-->
        <li>
            <a href="<?=Url::toRoute(['transaction/holding'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/tran_icon/tran_icon4.png"/>
                <p>持仓</p>
            </a>
        </li>
        <li>
            <a href="<?=Url::toRoute(['transaction/todaytrans'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/tran_icon/tran_icon5.png"/>
                <p>今日交易</p>
            </a>
        </li>
        <li>
            <a href="<?=Url::toRoute(['transaction/historytrans'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/tran_icon/tran_icon6.png"/>
                <p>历史交易</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['transaction/capital-flow'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/tran_icon/tran_icon7.png"/>
                <p>资金流水</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['user/recharge'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/tran_icon/tran_icon8.png"/>
                <p>转账充值</p>
            </a>
        </li>
        <div class="clear"></div>
    </ul>
</div>
<!--tranList end-->

<?php $this->beginContent('@app/views/layouts/footer.php');?>
<?php $this->endContent()?>