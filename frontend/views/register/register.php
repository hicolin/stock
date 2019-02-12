<?php
use yii\helpers\Url;
$yqm =Yii::$app->request->get('yqm');
?>
<!DOCTYPE html>
<html class="pass-owrap">
<head>
<title>免费注册</title>
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
  <div class="login_box">
    <div class="w1140">
      <div class="img_gg"> <a href=" " target="_blank"><img src="<?=Url::base()?>/frontend/web/images/20171211141812700.jpg" /></a> </div>
      <div class="main_box">
        <h1>账户注册<span>已注册？<a href="<?=Url::toRoute(['register/login'])?>">立即登录</a></span></h1>
        <ul>
          <form action=" " id="regForm" method="post" style="margin:0px;">
            <li> <i class="phone"></i>
              <input autocomplete="off"  type="text"  placeholder="请输入您的手机号码"  value="" id="Mobile" />
              <span class="field-validation-valid" data-valmsg-for="Mobile" data-valmsg-replace="true"></span> </li>
            <li> <i class="yzm"></i>
              <input autocomplete="off" class="yzm" data-val="true" data-val-length="请输入您手机收到的6位验证码" data-val-length-max="6" data-val-length-min="6" data-val-required="请输入手机收到的验证码" id="MobileVCode" name="MobileVCode" placeholder="请输入短信验证码" type="text" value="" />

              <input id="getRegMobileVCodeBtn" onclick="txy()" type="button" value="获取验证码" class="yzm_btn" />
              <input id="hidden"  type="hidden" value="1" class="yzm_btn" />
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
                                $("#getRegMobileVCodeBtn").val(count + "秒后重试");
                                InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                                layer.tips('验证码发送成功！', '#getRegMobileVCodeBtn', {tips:3,time:2000});
                            } else if(res == 400){
                                layer.tips('验证码发送失败！', '#getRegMobileVCodeBtn', {tips:3,time:2000});
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
                    // $("#getRegMobileVCodeBtn").attr('href','javascript:get_codes()');//启用按钮
                    $("#hidden").val(1)
                    $("#getRegMobileVCodeBtn").val("重新发送");

                }
                else {
                    count--;
                    $("#hidden").val(2);
                    $("#getRegMobileVCodeBtn").val(count + "秒后重试");
                    
                }
            }
        </script>
              <span class="field-validation-valid" data-valmsg-for="MobileVCode" data-valmsg-replace="true"></span>
              <input data-val="true" data-val-number="The field Ticks must be a number." data-val-required="Ticks 字段是必需的。" id="Ticks" name="Ticks" type="hidden" value="0" />
            </li>
            <li> <i class="password"></i>
              <input autocomplete="off" data-val="true" data-val-length="密码长度为8到20个字符" data-val-length-max="20" data-val-length-min="8" data-val-required="请输入密码" id="Password" name="Password" placeholder="请输入密码" type="password" />
              <p><span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span></p>
            </li>
            <?php if($is_yopen==1&&!empty($yqm)){ ?>
         
                        <li class="yqm_show" style="display: block;"> <i class="yqm"></i>
              <input autocomplete="off" id="yqm" name="InviteCode" value="<?=$yqm?>" placeholder="请输入您的邀请码" type="text" value="" />
              <span class="field-validation-valid" data-valmsg-for="InviteCode" data-valmsg-replace="true"></span> </li>

            <?php }else if($is_yopen==1){ ?>

                             <li class="yqm_show" style="display: block;"> <i class="yqm"></i>
              <input autocomplete="off" id="yqm" name="InviteCode"  placeholder="请输入您的邀请码" type="text" value="" />
              <span class="field-validation-valid" data-valmsg-for="InviteCode" data-valmsg-replace="true"></span> </li>

            <?php }else if(!empty($yqm)){ ?>
         
                                    <li class="yqm_show" style="display: block;"> <i class="yqm"></i>
              <input autocomplete="off" id="yqm" name="InviteCode" value="<?=$yqm?>"   placeholder="请输入您的邀请码" type="text"  />
              <span class="field-validation-valid" data-valmsg-for="InviteCode" data-valmsg-replace="true"></span> </li>

           <?php }else{ ?>



           <?php }  ?>   


            <li style="position:relative;">
              <input class="input" id="checkbox" type="checkbox" value="1" checked="" />
              <div class="gou on"  style="top:3px;" onclick="checked()"> </div>
              <span style="margin-left:5px;">我已阅读并接受</span><a href="javascript:showContract()" class="blue" style="position:static;border-left:none; padding-left: 0px;">《掌期金服网注册协议》</a> </li>
            <li>
              <input id="registerBtn" type="button" class="btn_login" onclick="layerC()" value="立即注册" />
              <input type="hidden" name="ss" id=ss value="1">
                <script type="text/javascript">
                   function checked(){
                    
                    //选中，返回true，没选中，返回false  
                    var checkbox =$("#checkbox").val();
                    if(checkbox==1){
                        $("#checkbox").val(2);
                        return 100;
                    }else{
                        $("#checkbox").val(1);
                        return 200;
                    }

                      
                   }
                </script>              
            </li>
          </form>
        </ul>
      </div>
    </div>
  </div>

</div>

<div id="ft" class="footer-tmpl-1" style="padding: 0;">
  <p style="line-height: 44px;"> &copy;2015 掌期金服 All rights reserved&nbsp;&nbsp;&nbsp; </p>
</div>
<script src="<?=Url::base()?>/frontend/web/zqjs/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?=Url::base()?>/frontend/web/zqjs/jquery.validate.unobtrusive.min.js" type="text/javascript"></script> 
<script src="<?=Url::base()?>/frontend/web/zqjs/layer.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=Url::base()?>/frontend/web/zqjs/o_code.js"></script>
</body>
</html>
<script type="text/javascript">
    $(function () {
        CFW.init();
    })
</script>
<script type="text/javascript">

    function layerC(){
        var csrf= "<?=Yii::$app->request->csrfToken?>";
        var checkbox = $("#checkbox").val();
        var mobile = $("#Mobile").val(); 
        var password = $("#Password").val();
        var MobileVCode = $("#MobileVCode").val();//手机验证码
        var yqm =$("#yqm").val(); 
        var reg = /(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/;
        if(!reg.test(mobile)&&mobile==''){
            layer.tips('请输入正确手机号码',"#Mobile",{tips:1,time:2000});
            return false;
        }
        if(password==''){
            layer.tips('您还没有输入密码',"#Password",{tips:1,time:2000});
            return false;
        } 
        if(MobileVCode==''){
            layer.tips('您还没有输入验证码',"#MobileVCode",{tips:1,time:2000});
            return false;
        }
        if(yqm==''){
            layer.tips('您还没有输入邀请码',"#yqm",{tips:1,time:2000});
            return false;
        }
       
        if(checkbox!=1){
            layer.tips('您还未阅读并接受协议', '#checkbox', {tips:3,time:2000});
            return false;
        }

        $.ajax({ 
            url:"<?=Url::toRoute('register/registeradd')?>",
            type:'POST',
            data:{mobile:mobile,password:password,mobilecode:MobileVCode,yqm:yqm,_csrf:csrf},
            success:function(data){
               if(data==100){
                    layer.msg('您已经注册成功!',{time:2000},function(){
                            window.location.href="<?=Url::toRoute('register/login')?>";
                            // window.location.reload();
                });
               }else if(data==200){
                  layer.msg('该号码已经注册!', {time: 2000}, function () {
                    
                });        
               }else if(data==300){
                  layer.msg('您输入的手机号或验证码不正确',{time:2000},function(){
                    });                        
               }else if(data==400){

                  layer.msg('邀请码不存在',{time:2000},function(){
                    });                     
               }else if(data==500){
                  layer.msg('该手机号或用户名已经存在',{time:2000},function(){
                    });                     
               }
            }

        })
}
    window.vCodeTicks = $("#Ticks").val();

    $(function () {
        window.vT = setInterval(checkGetVCodeBtn, 1000);
        $("#regForm").submit(function () {
            var submitBtn = $("#registerBtn");
            submitBtn.addClass("disable");
            submitBtn.attr("disabled", true);
            setTimeout(function () {
                submitBtn.removeClass("disable");
                submitBtn.attr("disabled", false);
            }, 1500);
        });
        $("a.show_li").click(function () {
            $(".yqm_show").toggle();
        });
        $("a.show_li").toggle(function () {
            $(".main_box ul li em.jt").addClass("active");
        }, function () {
            $(".main_box ul li em.jt").removeClass("active");
        });


        //注册页面的我已经阅读
        $(".gou").click(function () {
            if ($(this).hasClass("on")) {
                $(this).removeClass("on");
                $(".input").prop("checked", false)
            } else {
                $(this).addClass("on");
                $(".input").prop("checked", true)
            }
        })

    });

    function btnSumit() {

        $("#regForm").submit();
    }

    function getRegMobileVCodeFirst() {
        var mobile = $("#Mobile").val();
        var reg = /^[1]\d{10}$/;
        if (!reg.test(mobile)) {
            CFW.dialog.alert("请输入正确的手机号码", 0, null);
            return;
        }
        CFW.vcodeDialog(getRegMobileVCode);
    }

    function getRegMobileVCodeFirst() {
        var mobile = $("#Mobile").val();
        var reg = /^[1]\d{10}$/;
        if (!reg.test(mobile)) {
            CFW.dialog.alert("请输入正确的手机号码", 0, null);
            return;
        }
        CFW.vcodeDialog(getMobileSmsWithVerifyCode);
    }

    function getMobileSmsWithVerifyCode(vcode) {
        var mobile = $("#Mobile").val();
        var reg = /^[1]\d{10}$/;
        if (!reg.test(mobile)) {
            CFW.dialog.alert("请输入正确的手机号码", 0, null);
            return;
        }

        var getVCodeBtn = $("#getMobileVCodeBtn");
        window.vCodeTicks = 60;
        getVCodeBtn.addClass("disable");
        getVCodeBtn.attr("disabled", true);



        $.ajax({
            url: '/pass/GetMobileVCode',
            cache: false,
            data: { type: 1, mobile: mobile, vcode: vcode },
            type: 'get',
            dataType: 'json',
            success: function (r) {
                if (!r.success) {
                    CFW.dialog.alert(r.msg, 0, null);
                }
                window.vT = setInterval(checkGetVCodeBtn, 1000);
            }
        });
    }

    function getRegMobileVCode() {
        var mobile = $("#Mobile").val();
        var reg = /^[1]\d{10}$/;
        if (!reg.test(mobile)) {
            CFW.dialog.alert("请输入正确的手机号码", 0, null);
            return;
        }

        var getVCodeBtn = $("#getRegMobileVCodeBtn");
        window.vCodeTicks = 60;
        getVCodeBtn.addClass("disable");
        getVCodeBtn.attr("disabled", true);

        $.ajax({
            url: '/pass/GetMobileVCodeNoPicCode',
            cache: false,
            data: { type: 1, mobile: mobile },
            type: 'get',
            dataType: 'json',
            success: function (r) {
                if (!r.success) {
                    CFW.dialog.alert(r.msg, 0, null);
                }
                window.vT = setInterval(checkGetVCodeBtn, 1000);
            }
        });
    }

    function checkGetVCodeBtn() {
        window.vCodeTicks--;
        var getVCodeBtn = $("#getRegMobileVCodeBtn");
        if (window.vCodeTicks <= 0) {
            getVCodeBtn.removeClass("disable");
            getVCodeBtn.attr("disabled", false);
            getVCodeBtn.val("获取验证码");
            clearInterval(window.vT);
        } else {
            if (!getVCodeBtn.hasClass("disable")) {
                getVCodeBtn.addClass("disable");
                getVCodeBtn.attr("disabled", true);
            }
            getVCodeBtn.val(window.vCodeTicks + " 秒后重新获取");
        }
    }

    function showContract() {
        var iWidth=1000; //弹出窗口的宽度;
        var iHeight=800; //弹出窗口的高度;
        var iTop = (window.screen.availHeight-30-iHeight)/2; //获得窗口的垂直位置;
        var iLeft = (window.screen.availWidth-10-iWidth)/2; //获得窗口的水平位置;
        window.open('/register/agreement', '掌期金服协议', 'height=800,width=1000,top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no');
    }

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