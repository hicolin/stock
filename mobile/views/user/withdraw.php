<?php
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<div class="withdraw_main">
    <form onsubmit="return false">
        <ul>
            <li>
                <span>可用资金</span>
                <em><i class="num red"><?= $member['money']?></i>元</em>
            </li>
            <li>
                <span>提款金额</span>
                <input type="number" placeholder="请输入提款金额" name="money">
            </li>
            <li>
                <span>收款人</span>
                <input type="text" value="<?= $member['realname']?>" placeholder="请输入收款人姓名" disabled>
            </li>
            <li>
                <span>收款银行卡</span>
                <input type="text"
                    value="<?= mb_substr($member['cartid'],0,4).' **** **** '.mb_substr($member['cartid'],-4)?>"
                 placeholder="请输入收款银行卡号码" disabled>
            </li>
            <li>
                <span>支付密码</span>
                <input type="password" placeholder="请输入支付密码" name="pwd">
            </li>
        </ul>
        <div class="withdraw_form_bot">
            <button onclick="withdraw()">提现</button>
        </div>
    </form>
    <div class="withdraw_main_tips">
        <h1><i class="dmfont dm-tishi"></i>温馨提示</h1>
        <p>1、 到账时间：银行普通转帐，平台准实时提交到银行，一般1~2小时到账，具体到账时间以收款行到账时间为准。</p>
        <p>2、 提现手续费：<span style="font-weight: bolder"> <?= $withdrawFee?> </span>元/笔。</p>
    </div>
</div>

<?php $this->beginBlock('footer')?>
<script>
    function withdraw() {
        var money = parseInt($('input[name="money"]').val());
        var balance = parseInt('<?= $member['money']?>');
        var pwd = $('input[name="pwd"]').val();
        var idCard = '<?= $member['cartid']?>';
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if (!idCard) {
            layerMsg('您还没有实名认证，请先实名认证');
            setTimeout(function () {
                location.href = '<?= Url::to(['user/certificate'])?>';
            }, 2000);
            return;
        }
        if (!money || money <= 0) {
            layerMsg('提现金额不正确');return;
        }
        if (money > balance) {
            layerMsg('提现金额不能大于账户余额');return;
        }
        if (!pwd) {
            layerMsg('支付密码不能为空');return;
        }
        layerLoad();
        $.post('<?= Url::to(['user/withdraw'])?>', {money: money, pwd: pwd, _csrf: _csrf}, function (res) {
            layer.closeAll();
            if (res.status === 200) {
                layerMsg(res.msg,5);
                setTimeout(function () {
                    location.reload();
                }, 2000)
            }else{
                layerMsg(res.msg,3);
            }
        }, 'json')
    }
</script>
<?php $this->endBlock();?>