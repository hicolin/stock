<?php
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--login_main-->
<div class="login_main">
    <div class="login_main_img tc">
        <img src="<?= Url::base()?>/mobile/web/images/tx.png"/>
    </div>
    <div class="login_main_form">
        <ul>
            <li>
                <i class="dmfont dm-xinmima"></i>
                <input type="password" placeholder="请输入新的资金密码" class="changeMpwd1">
            </li>
            <li  class="no_border_bottom">
                <i class="dmfont dm-mima1"></i>
                <input type="password" placeholder="请确认您的资金密码" class="changeMpwd2">
            </li>
        </ul>
    </div>
    <div class="login_main_bot">
        <button onclick="changeMoneyPwd()">保存修改</button>
    </div>
</div>
<!--login_main end-->

<?php $this->beginBlock('footer') ?>
<script>
    function changeMoneyPwd() {
        var pwd = $('.changeMpwd1').val();
        var rePwd = $('.changeMpwd2').val();
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if (!pwd || !rePwd) {
            layerMsg('密码不能为空');return;
        }
        if (pwd != rePwd) {
            layerMsg('新密码与确认密码不一致');return;
        }
        layerLoad();
        $.post('<?= Url::to(['user/change-money-pwd'])?>', {pwd: pwd, rePwd: rePwd, _csrf: _csrf},
            function (res) {
                layer.closeAll();
                layerMsg(res.msg);
                if (res.status === 200) {
                    setTimeout(function () {
                        location.href = '<?= Url::to(['index/user'])?>';
                    }, 2000)
                }
            }, 'json')
    }
</script>
<?php $this->endBlock() ?>
