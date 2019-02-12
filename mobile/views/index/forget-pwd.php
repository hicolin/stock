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
                <input type="text" placeholder="请输入手机号" class="searchPwd_account send-tel">
            </li>
            <li>
                <i class="dmfont dm-yanzhengma"></i>
                <input type="number" placeholder="请输入验证码" class="searchPwd_code">
                <button class="sendCode_SearPwd send-code" onclick="sendSms()">获取验证码</button>
            </li>
            <li>
                <i class="dmfont dm-mima"></i>
                <input type="password" placeholder="请输入密码" class="searchPwd_pwd1">
            </li>
            <li class="no_border_bottom">
                <i class="dmfont dm-mima"></i>
                <input type="password" placeholder="请确认密码" class="searchPwd_pwd2">
            </li>
        </ul>
    </div>
    <div class="login_main_bot">
        <div class="lmb_head">
            <a href="<?= Url::to(['index/login'])?>">返回登录</a>
        </div>
        <button onclick="findPwd()">确认找回</button>
    </div>
</div>
<!--login_main end-->

<?php $this->beginBlock('footer')?>
<script>
    function findPwd() {
        var tel = $('.searchPwd_account').val();
        var code = $('.searchPwd_code').val();
        var pwd = $('.searchPwd_pwd1').val();
        var rePwd = $('.searchPwd_pwd2').val();
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if(!TEL_TEMP.test(tel)){
            layerMsg('手机号码不正确');return;
        }
        if(!CODE_TEMP.test(code)){
            layerMsg('验证码不正确');return;
        }
        if(!pwd || !rePwd){
            layerMsg('密码或确认密码不能为空');return;
        }
        if(pwd != rePwd){
            layerMsg('密码与确认密码不一致');return;
        }
        layerLoad();
        $.post('<?= Url::to(['index/forget-pwd'])?>',{tel: tel, code: code, pwd: pwd, rePwd: rePwd,
            _csrf: _csrf},function (res) {
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
