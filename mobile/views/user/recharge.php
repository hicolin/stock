<?php
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--recharge_main-->
<div class="withdraw_main">
    <form class="form-recharge" onsubmit="return recharge()" method="post" action="<?= Url::to(['user/recharge'])?>">
        <ul>
            <li>
                <span>充值方式</span>
                <select name="type">
                    <option value="bank">银行卡支付</option>
                    <option value="alipay">支付宝支付</option>
                </select>
            </li>
            <li>
                <span>充值金额</span>
                <input type="number" placeholder="请输入充值金额/元" name="money">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            </li>
        </ul>

        <div class="withdraw_form_bot">
            <button>充值</button>
        </div>
    </form>

    <div class="withdraw_main_tips">
        <h1><i class="dmfont dm-tishi"></i>温馨提示</h1>
        <p>1、 到账时间：银行普通转帐，平台准实时提交到银行，一般1~2小时到账，具体到账时间以收款行到账时间为准。</p>
        <p>2、 充值手续费：<span style="font-weight: bolder"><?= $feeRate ?></span> %。</p>
    </div>
</div>
<!--recharge_main end-->

<?php $this->beginBlock('footer')?>
<script>
    function recharge() {
        var form = $('.form-recharge');
        var money = parseInt($('input[name="money"]').val());
        if (!money || money < 100) {
            // todo pexPay支付限定的最新金额
           layerMsg('充值金额不能小于100元');
           return false;
        }
        form.submit();
    }
</script>
<?php $this->endBlock()?>
