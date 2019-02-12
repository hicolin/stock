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
                <form id="form" method="post" >
                    <div class="login-con-msg">
                        <dl>
                            <label class="tit">手机号码：</label>
                            <input id="tel"  name="tel" type="text" class="login-inp"/>
                        </dl>

                        <dl>
                            <label class="tit">短信验证码：</label>
                            <input type="text" id="vercode" name="vercode" class="register-inp-1"/>
                            <input type="button" id="btnOnece" class="register-sms get-code  code send_code" value="获取短信验证码">
                        </dl>
                        <dl>
                            <label class="tit">新密码：</label>
                            <input id="userspwd" name="userspwd" type="password" class="login-inp"/>
                        </dl>
                        <dl>
                            <input class="login-btn" type="submit" id="sub" value="找回密码" "/>
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
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/layer.js"></script>

<script type="text/javascript">
         $("input[name='tel']").blur(function(){

        var tel = $(this).val();

        if(tel==""){

            layer.tips("手机号不能为空", "#tel", {tips:3,time:2000});

            return false;

        }

        if(!(/^1(3|4|5|7|8)\d{9}$/).test(tel)){

            layer.tips("手机号输入不正确", "#tel", {tips:3,time:2000});

            return false;

        }

        $.ajax({

            url  : "<?= Url::toRoute('index/validate-tel')?>",

            type : 'post',

            data : {'tel':tel},

            dataType:'text',

            //beforeSend:function(){},

            success:function(data){

                if(data==100){

                     layer.msg('该手机还未注册，请先注册',{time:2000},function(){
                        top.location.href ="<?=Url::toRoute('index/register')?>";
                    })

                }

                else{

                    $(".send_code").attr("onclick","get_code();");

                    $('.send_code').attr('disabled',false).css('cursor','pointer');

                    $('#sub').attr('disabled',false).css('cursor','pointer');

                }

            }

        });



    })





    //发送验证码

    function get_code(){

        var tel = $('#tel').val();

        // alert(tel);

        if(tel==""){

            layer.tips("手机号不能为空", "#tel", {tips:3,time:2000});

            return false;

        }

        else if(!(/^1(3|4|5|7|8)\d{9}$/).test(tel)){

            layer.tips("手机号输入不正确", "#tel", {tips:3,time:2000});

            return false;

        }

        send_code('send_code',tel)

    }



    function send_code(code,tel){

        var btn = $('.'+code);

        var count = 60;


        var resend = setInterval(function(){

            count--;

            console.log(count)

            if (count > 0){

                btn.val('重新发送('+count+')');

            }else {

                clearInterval(resend);

                btn.val("获取验证码").removeAttr('disabled style');

            }

        }, 1000);

        if(code=='old_code'){

            var url =  "<?=Url::toRoute('index/message')?>";

        }else{

            var url = "<?=Url::toRoute('index/message')?>";

        }

        $.ajax({

            url  : url,

            type : 'post',

            data : {'tel':tel},

            dataType:'text',

            success:function(data){

                layer.msg("发送成功");

            }

        });

        btn.attr('disabled',true).css('cursor','not-allowed');

    }



    $("#sub").click(function(){

        var tel=$("input[name='tel']").val();

        var vercode=$("input[name='vercode']").val();

        var userspwd=$("input[name='userspwd']").val();
        

        if(tel==""){

            layer.tips('请输入您的手机号', "input[name='tel']", {tips:3,time:2000});

            return false;

        }

        else if(!/^1(3|4|5|7|8)\d{9}$/.test(tel)){

            layer.tips('请输入正确的手机号', "input[name='tel']", {tips:3,time:2000});

            return false;

        }

        else if(userspwd==""){

            layer.tips('请输入您的密码', "input[name='userspwd']", {tips:3,time:2000});

            return false;

        }

        else if(userspwd.length<6 || userspwd.length>18){

            layer.tips('请输入您6-18位字符的密码', "input[name='userspwd']", {tips:3,time:2000});

            return false;

        }

        // else if(reuserspwd!=userspwd){

        //     layer.tips('您两次输入的密码不一样', "input[name='reuserspwd']", {tips:3,time:2000});

        //     return false;

        // }

        else if(vercode==""){

            layer.tips('验证码不能为空', "input[name='vercode']", {tips:3,time:2000});

            return false;

        }

        else{

             $.ajax({

                url  : "<?= Url::toRoute($this->context->id . '/regcode')?>",

                type : 'post',

                data : {'vercode':vercode,'tel':tel},

                dataType:'text',

                //beforeSend:function(){},

                success:function(data){

                    if(data==200){

                        layer.tips('验证码错误，请重新输入', "input[name='vercode']", {tips:3,time:2000});

                    }else if(data==300) {

                        layer.tips('不是当前手机号', "input[name='tel']", {tips:3,time:2000});

                    } else {

                        
                         $.ajax({
                            url:"<?=Url::toRoute('index/found-pass')?>",
                            type:'post',
                            data:{'tel':tel,'vercode':vercode,'userspwd':userspwd},
                            dataType:'text',
                            success:function(data){
                               if(data == 600){
                                  layer.msg('修改成功',{time:2000},function(){
                                  top.location.href ="<?=Url::toRoute('index/login')?>";
                                  })
                               }
                               if(data == 500){
                                layer.msg('修改失败',{time:2000},function(){
                                  top.location.reload();
                                  })

                               } 

                            }
                         });






                    }

                }

            });

             return false;

        }

    })
</script>

