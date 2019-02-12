<?php
use yii\helpers\Url;

?>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/lrtk.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/chaogu.css-v=20171204.css" rel="stylesheet"/>
<div class="clearborth"></div>

<div class="login">
    <div class="main bd-12 f-clear">
        <div class="login-box">
            <h3><strong>找回密码</strong></h3>
            <div class="login-con  register-con">
                <form id="form1" method="post" >
                    <div class="login-con-msg">
                        <dl>
                            <label class="tit">手机号码：</label>
                            <input id="mobile" name="mobile" type="text" class="login-inp"/>
                        </dl>

                        <dl>
                            <label class="tit">短信验证码：</label>
                            <input type="text" id="code_mobile" name="code_mobile" class="register-inp-1"/>
                            <input type="button" id="btnOnece" class="register-sms" value="获取短信验证码"
                                   onclick="findpwd_sms();">
                        </dl>
                        <dl>
                            <label class="tit">新密码：</label>
                            <input id="pwd" name="pwd" type="text" class="login-inp"/>
                        </dl>
                        <dl>
                            <input class="login-btn" type="submit" id="Submit1" value="找回密码"
                                   onclick="findpwd();"/>
                        </dl>
                        <dl class="last">
                            <a href="<?= Url::toRoute(['index/login']) ?>" class="fl">登录</a>
                            <a href="<?= Url::toRoute(['index/register']) ?>" class="fr">注册</a>
                        </dl>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="clearborth"></div>
<!--foot-kefu-->
<div class="foot-kefu" style="display: none;">
    <div class="main f-clear">
        <div class="fl foot-kefu-tit">
            <strong>客服中心</strong>
            <p>service</p>
        </div>

    </div>
</div>
<!-- foot -->

<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/layout.js"></script>


