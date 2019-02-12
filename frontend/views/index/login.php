

<?php
use yii\helpers\Url;
?>

<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css"  rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css"  rel="stylesheet" />
    <div class="clearborth"></div>
    <div class="login">
        <div class="main bd-12 f-clear">
            <div class="login-box">
                <h3><strong>用户登录</strong></h3>
                <div class="login-con">
                    <form id="form1" method="post" onsubmit="return false;" url="<?=Url::toRoute(['index/login'])?>">
                        <div class="login-con-msg">
                            <dl class="f-clear">
                                <label class="tit">登录账号：</label><input type="text" id="mobile" name="mobile" class="login-inp bg-b" value="<?=$username?>" />
                            </dl>
                            <dl class="f-clear">
                                <label class="tit">登录密码：</label><input type="password" id="pwd" name="pwd" class="login-inp bg-a" value="<?=$password?>" />
                            </dl>
                            <dl class="f-clear">
                                <label class="tit">
                                    <input type="checkbox" name="rb_name" id="rb_name" style="float: none;" />下次自动登录</label>
                                <label id="msgtips"></label>
                            </dl>
                            <dl class="f-clear">
                                <input class="login-btn" type="submit" id="btnSubmit" onclick="return login();" value="登 录" />
                            </dl>
                            <dl class="last">
                                <a href="<?=Url::toRoute(['index/register'])?>"  class="fl">注册</a>
                                <a class="fr" href="<?=Url::toRoute(['index/found-pass'])?>">找回密码</a>
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

    <script src="<?=Url::base()?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js" ></script>
    <script src="<?=Url::base()?>/frontend/web/xnn/scripts/layout.js" ></script>
    
    <script type="text/javascript">
        $(function () {
            $('#form1').bind('keypress', function (event) {
                if (event.keyCode == "13") {
                    login();
                }
            });
        });
    </script>
