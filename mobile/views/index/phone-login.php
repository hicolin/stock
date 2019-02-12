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
                <input type="text" placeholder="请输入手机号码" class="login_account send-tel">
            </li>
            <li class="no_border_bottom">
                <i class="dmfont dm-yanzhengma"></i>
                <input type="number" placeholder="请输入验证码" class="login_code">
                <button class="sendCode send-code" onclick="sendSms()">获取验证码</button>
            </li>
        </ul>
    </div>

    <div class="login_main_bot">
        <div class="lmb_head">
            <a href="<?= Url::to(['index/login'])?>">账号密码登录</a>
            <a href="<?= Url::to(['index/register'])?>" class="fr">快速注册</a>
        </div>
        <button onclick="login()">登录</button>
    </div>
</div>
<!--login_main end-->

<?php $this->beginBlock('footer')?>
<script>
    function login() {
        var tel = $('.login_account').val();
        var code = $('.login_code').val();
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if (!TEL_TEMP.test(tel)) {
            layerMsg('手机号码不正确');return;
        }
        if (!CODE_TEMP.test(code)) {
            layerMsg('验证码不正确');return;
        }
        layerLoad();
        $.post('<?= Url::to(['index/phone-login'])?>', {tel: tel, code: code, _csrf: _csrf}, function (res) {
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
