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
                <input type="text" placeholder="请输入手机号" class="register_account send-tel">
            </li>
<!--            <li>-->
<!--                <i class="dmfont dm-yanzhengma"></i>-->
<!--                <input type="number" placeholder="请输入验证码" class="register_code">-->
<!--                <button class="sendCode_register send-code" onclick="sendSms()">获取验证码</button>-->
<!--            </li>-->
            <li>
                <i class="dmfont dm-mima"></i>
                <input type="password" placeholder="请输入密码" class="register_pwd1">
            </li>
            <li>
                <i class="dmfont dm-mima"></i>
                <input type="password" placeholder="请确认密码" class="register_pwd2">
            </li>
            <li class="no_border_bottom">
                <i class="dmfont dm-wode"></i>
                <input type="password" placeholder="请输入邀请码（选填）" class="invite_code">
            </li>
        </ul>
    </div>
    <div class="login_main_bot">
        <div class="lmb_head">
            <a href="<?= Url::to(['index/login'])?>">账号密码登录</a>
<!--            <a href="--><?//= Url::to(['index/phone-login'])?><!--" class="fr">手机验证码登录</a>-->
        </div>
        <button onclick="register()">注册</button>
    </div>
</div>
<!--login_main end-->

<?php $this->beginBlock('footer')?>
<script>
    function register() {
        var tel = $('.register_account').val();
        // var code = $('.register_code').val();
        var pwd = $('.register_pwd1').val();
        var rePwd = $('.register_pwd2').val();
        var inviteCode = $('.invite_code').val();
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if(!TEL_TEMP.test(tel)){
            layerMsg('手机号码不正确');return;
        }
        // if(!CODE_TEMP.test(code)){
        //     layerMsg('验证码不正确');return;
        // }
        if(!pwd || !rePwd){
            layerMsg('密码或确认密码不能为空');return;
        }
        if(pwd != rePwd){
            layerMsg('密码与确认密码不一致');return;
        }
        layerLoad();
        $.post('<?= Url::to(['index/register'])?>',{tel: tel, pwd: pwd, rePwd: rePwd,
            inviteCode: inviteCode,_csrf: _csrf},function (res) {
            layer.closeAll();
            layerMsg(res.msg);
            if (res.status === 200) {
                setTimeout(function () {
                    location.href = '<?= Url::to(['index/login'])?>';
                }, 2000)
            }
        }, 'json')
    }
</script>
<?php $this->endBlock()?>
