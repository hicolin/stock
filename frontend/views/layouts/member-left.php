<?php
use yii\helpers\Url;
$page = $this->context->action->id;
//判断当前用户的
?>
<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/user.css" rel="stylesheet" />
<!-- left -->
<div class="nleftless">
    <div class="subtitle">会员中心</div>
    <div class="subNavBox">

        <div class="subNav currentDd currentDt" style="display: none;">我的账户</div>
        <ul class="navContent" style="display: block;">
            <li><a href="<?=Url::toRoute(['user/index'])?>" id="index"><i class="user-ico user-ico-home"></i>我的主页</a></li>
        </ul>
        <div class="subNav currentDd currentDt" style="display: none;">财务管理</div>
        <ul class="navContent" style="display: block;">
            <li><a href="<?=Url::toRoute(['user/recharge-money'])?>" id="pay"><i class="user-ico user-ico-pay"></i>信用充值</a></li>
            <li><a href="<?=Url::toRoute(['user/withdraw-money'])?>" id="cash"><i class="user-ico user-ico-cash"></i>我要提现</a></li>
            <li><a href="<?=Url::toRoute(['user/certification'])?>" id="bind"><i class="user-ico user-ico-bind"></i>实名认证</a></li>
        </ul>
        <div class="subNav currentDd currentDt" style="display: none;">个人设置</div>
        <ul class="navContent" style="display: block;">
            <li><a href="<?=Url::toRoute(['user/revisepassword'])?>" id="pwd"><i class="user-ico user-ico-pwd"></i>密码设置</a></li>
        </ul>

    </div>
</div>
<script>
    $(".nav div").each(function () {
        //alert($(this).attr('href'));
        if ($(this)[0].href == String(window.location) && $(this).attr('href') != "") {
            $(this).addClass("title");
            $(this).sibling("div").removeClass("title");
        }
    });
</script>