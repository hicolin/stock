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
                <i class="dmfont dm-mima"></i>
                <input type="text" placeholder="请输入旧密码" class="changeLpwd1">
            </li>
            <li>
                <i class="dmfont dm-xinmima"></i>
                <input type="password" placeholder="请输入新密码" class="changeLpwd2">
            </li>
            <li  class="no_border_bottom">
                <i class="dmfont dm-mima1"></i>
                <input type="password" placeholder="请确认密码" class="changeLpwd3">
            </li>
        </ul>
    </div>
    <div class="login_main_bot">
        <button onclick="changeLoginPwd()">保存</button>
    </div>
</div>
<!--login_main end-->

<?php $this->beginBlock('footer')?>
<script>
    function changeLoginPwd() {
        var oldPwd = $('.changeLpwd1').val();
        var pwd = $('.changeLpwd2').val();
        var rePwd = $('.changeLpwd3').val();
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if (!oldPwd || !pwd || !rePwd) {
            layerMsg('密码不能为空');return;
        }
        if (pwd != rePwd) {
            layerMsg('新密码与确认密码不一致');return;
        }
        layerLoad();
        $.post('<?= Url::to(['user/change-login-pwd'])?>', {oldPwd:oldPwd, pwd: pwd, rePwd: rePwd, _csrf: _csrf},
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
<?php $this->endBlock()?>
