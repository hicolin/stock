<?php
use yii\helpers\Url;

?>
<!DOCTYPE html>
<html class="pass-owrap">
<head>
<title>重设密码</title>
<meta name="renderer" content="webkit" />
<link href="<?=Url::base()?>/frontend/web/zqcss/base.css" type="text/css" rel="Stylesheet" />
<link href="<?=Url::base()?>/frontend/web/zqcss/pass.css" type="text/css" rel="Stylesheet" />
<link href="<?=Url::base()?>/frontend/web/zqcss/global.css" rel="stylesheet" type="text/css" />
<link href="<?=Url::base()?>/frontend/web/zqcss/system.css" rel="stylesheet" type="text/css" />
<script src="<?=Url::base()?>/frontend/web/zqjs/jquery-1.8.3.min.js?v=1.11.1" type="text/javascript"></script>
<script type="text/javascript" src="<?=Url::base()?>/frontend/web/zqjs/cfw.min.js"></script>
</head>

<body>
<div class="hd">
  <div class="hd-content">
    <div class="hd-inner clearfix"> <a href="" class="fl"> <img src="<?=Url::base()?>/frontend/web/images/log_jylm.jpg" class="hd-logo" title="财富网，聚财富" alt="财富网，聚财富" /></a>
      <div class="hd-login">
        <ul class="hd-quick-menu" style="_width: 226px; margin-top: 28px;">
          <li style="width: 96px; font-size: 18px; font-weight: bold;"><a href="/" class="hd-quick-menu-sub-a pdr-15 br1e6"><span class="fl"><em>返回首页</em></span></a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="pass-wrap">
  <div class="pass-inner-wrap">
    <div class="pass-inner-content">
      <h2 class="clearfix"> <span class="large title fl">重设密码</span> <a href="<?=Url::toRoute(['register/login'])?>" class="fr">登录»</a></h2>
      <form action=" " class="pass-form" id="editForm" method="post">
        <div class="form-item">
          <p class="input-label">
            <label> 手机号</label>
          </p>
          <p style="position: relative;">
            <input class="input-text-style-3" data-val="true" data-val-regex="手机号码不正确" data-val-regex-pattern="^[1]\d{10}$" data-val-required="请输入您的手机号码" id="Mobile" name="Mobile" type="text" value="" />
            <span class="input-tips"> 请输入注册时填写的手机号</span></p>
          <p class="error-tips"><span class="field-validation-valid" data-valmsg-for="Mobile" data-valmsg-replace="true"></span></p>
        </div>
        <div class="form-item">
          <p class="input-label">
            <label> 验证码</label>
          </p>
          <p class="clearfix">
            <input autocomplete="off" class="input-text-style-3 fl" data-val="true" data-val-length="请输入您手机收到的6位验证码" data-val-length-max="6" data-val-length-min="6" data-val-required="请输入验证码" id="VCode" name="VCode" type="text" value="" />
            <input id="getMobileVCodeBtn" onclick="txy()" type="button" class="input-submit-style-3 get-regcode-btn fl" value="获取验证码" />
            <input id="hidden"  type="hidden" value="1" class="yzm_btn" />
            <input data-val="true" data-val-number="The field Ticks must be a number." data-val-required="Ticks 字段是必需的。" id="Ticks" name="Ticks" type="hidden" value="0" />
          </p>
          <p class="error-tips" style="padding-left:110px;"> <span class="field-validation-valid" data-valmsg-for="VCode" data-valmsg-replace="true"></span></p>
        </div>
        <div class="form-item">
          <p class="input-label">
            <label> 新密码</label>
          </p>
          <p>
            <input autocomplete="off" class="input-text-style-3" data-val="true" data-val-length="密码长度为8到20个字符" data-val-length-max="20" data-val-length-min="8" data-val-required="请输入密码" id="Password" name="Password" type="password" />
            <span class="input-tips">8-20位数字和字母组成</span></p>
          <p class="error-tips"> <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span></p>
        </div>
        <div class="form-item">
          <p class="input-label">
            <label> 确认密码</label>
          </p>
          <p>
            <input autocomplete="off" class="input-text-style-3" data-val="true" data-val-equalto="两次输入的密码不一致" data-val-equalto-other="*.Password" id="ConfirmPassword" name="ConfirmPassword" type="password" />
          </p>
          <p class="error-tips"> <span class="field-validation-valid" data-valmsg-for="ConfirmPassword" data-valmsg-replace="true"></span></p>
        </div>
        <div class="form-item form-foot">
          <input id="submitBtn" type="button" class="input-submit-style-3" onclick="forpassword()"  value="重设密码" />
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">

    // window.vCodeTicks = $("#Ticks").val();

    // $(function() {
    //     window.vT = setInterval(checkGetVCodeBtn, 1000);
    //     $("#editForm").submit(function() {
    //         var submitBtn = $("#submitBtn");
    //         submitBtn.addClass("disable");
    //         submitBtn.attr("disabled", true)
    //         setTimeout(function() {
    //             submitBtn.removeClass("disable");
    //             submitBtn.attr("disabled", false);
    //         }, 1500);
    //     });
    // });

    // function getRegMobileVCodeFirst() {
    //     var mobile = $("#Mobile").val();
    //     var reg = /^[1]\d{10}$/;
    //     if (!reg.test(mobile)) {
    //         CFW.dialog.alert("请输入正确的手机号码", 0, null);
    //         return;
    //     }
    //     CFW.vcodeDialog(getMobileVCode);
    // }

    // function getMobileVCode(vcode) {
    //     var mobile = $("#Mobile").val();
    //     var reg = /^[1]\d{10}$/;
    //     if (!reg.test(mobile)) {
    //         CFW.dialog.alert("请输入正确的手机号码", 0, null);
    //         return;
    //     }

    //     var getVCodeBtn = $("#getMobileVCodeBtn");
    //     window.vCodeTicks = 60;
    //     getVCodeBtn.addClass("disable");
    //     getVCodeBtn.attr("disabled", true);



    //     $.ajax({
    //         url: '/pass/GetMobileVCode',
    //         cache: false,
    //         data: { type: 5, mobile: mobile, vcode: vcode },
    //         type: 'get',
    //         dataType: 'json',
    //         success: function (r) {
    //             if (!r.success) {
    //                 CFW.dialog.alert(r.msg, 0, null);
    //             }  
    //             window.vT = setInterval(checkGetVCodeBtn, 1000);
    //         }
    //     });
    // }

    // function checkGetVCodeBtn() {
    //     window.vCodeTicks--;
    //     var getVCodeBtn = $("#getMobileVCodeBtn");
    //     if (window.vCodeTicks <= 0) {
    //         getVCodeBtn.removeClass("disable");
    //         getVCodeBtn.attr("disabled", false);
    //         getVCodeBtn.val("获取验证码");
    //         clearInterval(window.vT);
    //     } else {
    //         if (!getVCodeBtn.hasClass("disable")) {
    //             getVCodeBtn.addClass("disable");
    //             getVCodeBtn.attr("disabled", true);
    //         }
    //         getVCodeBtn.val(window.vCodeTicks + " 秒后重新获取");
    //     }
    // }

</script> 
  <script type="text/javascript">

            $(function () {
                $("#openKeFuPanelBtn").click(function () {
                    $(this).hide();
                    $("#kefuPanel").css("display", "block");
                });

                $("#closeKeFuPanelBtn").click(function () {
                    $("#kefuPanel").hide();
                    $("#openKeFuPanelBtn").show();
                });
            })
   </script> 
</div>
<div id="ft" class="footer-tmpl-1" style="padding: 0;">
  <p style="line-height: 44px;"> ©2015 掌期金服 All rights reserved&nbsp;&nbsp;&nbsp; </p>
</div>
<script src="<?=Url::base()?>/frontend/web/zqjs/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?=Url::base()?>/frontend/web/zqjs/jquery.validate.unobtrusive.min.js" type="text/javascript"></script> 
<script src="<?=Url::base()?>/frontend/web/zqjs/layer.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=Url::base()?>/frontend/web/zqjs/o_code.js"></script>
</body>
</html>

<script type="text/javascript">
  

      function forpassword(){
      
        var csrf= "<?=Yii::$app->request->csrfToken?>";
        var mobile = $("#Mobile").val(); 
        var password = $("#Password").val();
        var confirmpassword =$("#ConfirmPassword").val();
        var mobilevcode = $("#VCode").val();//手机验证码
        var reg = /(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/;
        if(!reg.test(mobile)&&mobile==''){
            layer.tips('请输入正确手机号码',"#Mobile",{tips:1,time:2000});
            return false;
        }
        if(password==''){
            layer.tips('您还没有输入密码',"#Password",{tips:1,time:2000});
            return false;
        }
        if(confirmpassword==''){
            layer.tips('您还没有确认密码',"#ConfirmPassword",{tips:1,time:2000});
            return false;
        }          
        if(mobilevcode==''){
            layer.tips('您还没有输入验证码',"#MobileVCode",{tips:1,time:2000});
            return false;
        }

        $.ajax({ 
            url:"<?=Url::toRoute('register/forget-pass')?>",
            type:'POST',
            data:{mobile:mobile,password:password,mobilevcode:mobilevcode,confirmpassword:confirmpassword,_csrf:csrf},
            success:function(data){

               if(data==100){
                    layer.msg('重置密码成功!',{time:2000},function(){
                            window.location.href="<?=Url::toRoute('register/login')?>";
                            // window.location.reload();
                });
               }else if(data==200){
                  layer.msg('两次密码不一致', {time: 2000}, function () {
                    
                });        
               }else if(data==300){
                  layer.msg('您输入的手机号或验证码不正确',{time:2000},function(){
                    });                        
               }else if(data==400){

                  layer.msg('您还未注册',{time:2000},function(){
                    });                     
               }
            }

        })
}


</script>
<script type="text/javascript">
      function check_tel(){
                var reg = /(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/;
                var mobile = $("#Mobile").val();
                if(!reg.test(mobile)&&mobile==''){
                    layer.tips('请输入正确手机号码',"#Mobile",{tips:1,time:2000});
                    return false;
                }else{
                    return true;
                }

           }
    function txy(){
            var hidden =$("#hidden").val();
            var phone = $("#Mobile").val();
            var csrf= "<?=Yii::$app->request->csrfToken?>";
            if(hidden==1){
                if(check_tel()){
                    $.ajax({
                        type: 'post',
                        url: "<?=Url::toRoute(['register/code'])?>",
                        data: {mobile: phone,_csrf:csrf},
                        dataType: "json",
                        success:function(res){
                          if(res==600){
                                count = 60;
                                //设置button效果，开始计时
                                $("#getMobileVCodeBtn").val(count + "秒后重试");
                                InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                                layer.tips('验证码发送成功！', '#getMobileVCodeBtn', {tips:3,time:2000});
                            } else if(res == 400){
                                layer.tips('验证码发送失败！', '#getMobileVCodeBtn', {tips:3,time:2000});
                            } else if(res==300){
                                layer.msg('手机号已注册!', {time:2000});

                            }
                        }
                    })

                }
            }else{
                    layer.msg('请勿重复点击!', {time:2000});
                    return false;
                }
            }
            //         //timer处理函数 
            function SetRemainTime() {
                if (count == 0) {
                    window.clearInterval(InterValObj);//停止计时器
                    $("#getMobileVCodeBtn").attr('href','javascript:get_codes()');//启用按钮
                    $("#hidden").val(1)
                    $("#getMobileVCodeBtn").val("重新发送");

                }
                else {
                    count--;
                    $("#hidden").val(2);
                    $("#getMobileVCodeBtn").val(count + "秒后重试");
                    
                }
            }
</script>