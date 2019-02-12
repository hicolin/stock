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
                <i class="dmfont dm-shouji"></i>
                <input type="text" placeholder="请输入手机号码" class="login_account">
            </li>
            <li  class="no_border_bottom">
                <i class="dmfont dm-mima"></i>
                <input type="password" placeholder="请输入密码" class="login_pwd">
            </li>
        </ul>
    </div>

    <div class="login_main_bot">
        <div class="lmb_head">
<!--            <a href="--><?//= Url::to(['index/phone-login'])?><!--">手机验证码登录</a>-->
            <a href="<?= Url::to(['index/register'])?>" class="fr">快速注册</a>
        </div>
        <button onclick="login()">登录</button>
        <div class="lmb_head">
<!--            <a href="--><?//= Url::to(['index/forget-pwd'])?><!--">忘记密码</a>-->
        </div>
    </div>
</div>
<!--login_main end-->

<?php $this->beginBlock('footer')?>
<script>
    function login() {
        var tel = $('.login_account').val();
        var pwd = $('.login_pwd').val();
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if (!TEL_TEMP.test(tel)) {
            layerMsg('手机号码不正确');return;
        }
        if (!pwd) {
            layerMsg('密码不能为空');return;
        }
        layerLoad();
        $.post('<?= Url::to(['index/login'])?>', {tel: tel, pwd: pwd, _csrf: _csrf}, function (res) {
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
