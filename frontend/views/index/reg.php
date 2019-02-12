
<?php 
use yii\helpers\Url;
$yqm =Yii::$app->request->get('vatation_code2');
?>
<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css"  rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css"  rel="stylesheet" />
    <div class="clearborth"></div>
    
    <div class="login">
        <div class="main bd-12 f-clear">
            <div class="login-box">
                <h3><strong>用户注册</strong></h3>
                <div class="login-con  register-con">
                    <form id="form1" method="post" onsubmit="return false;" url="<?=Url::toRoute(['index/register'])?>">
                        <div class="login-con-msg">
                            <dl style="display: none;"><span class="text">登录账号：</span><input id="account_no" name="account_no" type="text" class="register-inp" /></dl>
                            <dl>
                                <label class="tit">手机号码：</label><input id="mobile" name="mobile" type="text" onblur="checkreg()" class="login-inp" />
                            </dl>
                            <dl>
                                <label class="tit">登录密码：</label><input id="pwd" name="pwd" type="password" class="login-inp" />
                            </dl>

                            <dl>
                                <label class="tit">短信验证码：</label>
                                <input type="text" id="code_mobile" name="code_mobile" class="register-inp-1" />
                                <input type="button" id="btnOnece" class="register-sms" value="获取短信验证码" onclick="reg_sms();">
                            </dl>
                            <dl style="display: none;">
                                <label class="tit">推荐人手机：</label><input id="ref_mobile" name="ref_mobile" type="text" class="login-inp" value=""  />
                            </dl>
                            <?php if($set==1):?>
                            <dl>
                                <label class="tit">邀请码：</label><input id="agents_num"  <?= isset($yqm)?'readonly':''?> name="agents_num" type="text" class="login-inp" placeholder="输入您的邀请码" value="<?=$yqm?>"  />
                            </dl>
                            <?php endif;?>
                            <dl style="margin: 10px 0 15px 0;">
                                <p>
                                    <span style="padding-top: 4px;">
                                        <input type="checkbox" id="agree" name="agree"></span>我同意<?=\common\models\Common::getSysInfo(5)?>
                                    <a href="<?=Url::toRoute('news/help?cid=45')?>"  target="_blank" class="c-red">《注册协议》</a>
                                </p>
                            </dl>
                            <dl>
                                <input class="login-btn" type="submit" id="btnSubmit" value="注  册" onclick="return reg();" />
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
            JPlaceholderFix();
            $('#form1').bind('keypress', function (event) {
                if (event.keyCode == "13") {
                    reg();
                }
            });
        });
    </script>

    <div class="kefu">
        <ul>
            
            <li class="l3" style="display: none;">
                <a href="javascript:;"></a>
                <div class="hide3">
                    <a   target="_blank"><span>客服一</span><br/><i></i></a><a   target="_blank"><span>qq交流群</span><br/><i></i></a>
                </div>
            </li>
            <li class="l4"><a href="#page1" id="scrollTop"></a></li>
        </ul>
    </div>

