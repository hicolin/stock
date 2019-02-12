<?php 
use yii\helpers\Url;
$sign = Yii::$app->request->get('sign');

?>
<!DOCTYPE html>
<html class="pass-owrap">
    <head>
    <title>登录</title>
    <meta name="renderer" content="webkit" />
    <link href="<?=Url::base()?>/frontend/web/zqcss/base.css" type="text/css" rel="Stylesheet" />
    <link href="<?=Url::base()?>/frontend/web/zqcss/pass.css" type="text/css" rel="Stylesheet" />
    <link href="<?=Url::base()?>/frontend/web/zqcss/global.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/frontend/web/zqcss/system.css" rel="stylesheet" type="text/css" />

       
    <style>
#ft, #ft a {
	color: #333;
}
</style>
    <script src="<?=Url::base()?>/frontend/web/zqjs/jquery-1.8.3.min.js?v=1.11.1" type="text/javascript"></script>
    <script type="text/javascript" src="<?=Url::base()?>/frontend/web/zqjs/cfw.min.js"></script>
    <script type="text/javascript">
        var _oztime = (new Date()).getTime();
    </script>
    <!--tongdun-->
    <!--tongdun end-->
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
          <div class="img_gg"> <a href="" target="_blank"><img src="<?=Url::base()?>/frontend/web/images/20171211155152072.jpg" /></a> </div>
          <div class="main_box">
        <h1>账户登录<span>没有账号？<a href="<?=Url::toRoute('register/register')?>">免费注册</a></span></h1>
        
              <ul>
            <li> <i class="phone"></i>
              <input data-val="true" data-val-length="用户名长度为2到16个字符"  data-val-length-max="16" data-val-length-min="2" data-val-required="请输入用户名" id="UserName" name="UserName" placeholder="请输入用户名或手机号" type="text"
               value="<?=!empty($tels)?$tels:''?>" />
                  <span class="field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span> </li>
            <li> <i class="password"></i>
                  <input autocomplete="off" data-val="true" data-val-length="密码长度为8到20个字符" data-val-length-max="20" data-val-length-min="8" data-val-required="请输入密码" value="<?=!empty($passwords)?$passwords:''?>" id="Password" name="Password" placeholder="请输入密码" type="password" />
                  <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span> </li>
            <li> </li>
            <li style="position:relative;">
                  <input class="input" style="vertical-align:middle;" type="checkbox" value="1" id="check"  name="check" <?=empty($tels)&&empty($passwords)?'':'checked'?>   />
                  <div class="gou on" onclick="checked()" > </div>
                  <span style="margin-left:5px;">5天自动登录</span> <a href="<?=Url::toRoute(['register/forget-password'])?>" class="blue">忘记密码？</a> </li>
                   <!-- <input type="hidden" name="ss" id=ss value="1"> -->
                  <script type="text/javascript">
                   function checked(){
                      
                    //选中，返回true，没选中，返回false  
                    var checkbox =$("#check").val();
            
                    if(checkbox==1){
                        $("#check").val(2);
                        return 100;
                    }else{
                        $("#check").val(1);
                        return 200;
                    }

                      
                   }
                </script> 
            <li>
                  <input type="button" class="btn_login" id="loginBtn" onclick="loginBtn()" value="登录" />
                </li>
          </ul>
           
      </div>
        </div>
  </div>
<script src="<?=Url::base()?>/frontend/web/zqjs/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?=Url::base()?>/frontend/web/zqjs/jquery.validate.unobtrusive.min.js" type="text/javascript"></script> 
<script src="<?=Url::base()?>/frontend/web/zqjs/layer.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=Url::base()?>/frontend/web/zqjs/o_code.js"></script>
      <script type="text/javascript">
      $(function () {
          $("#loginForm").submit(function () {
              var submitBtn = $("#loginBtn");
              submitBtn.addClass("disable");
              submitBtn.attr("disabled", true);
              setTimeout(function () {
                  submitBtn.removeClass("disable");
                  submitBtn.attr("disabled", false);
              }, 1500);
          });

          //登录页面的记住密码
          $(".gou").click(function () {
              if ($(this).hasClass("on")) {
                  $(this).removeClass("on");
                  $(".input").prop("checked", false)
              } else {
                  $(this).addClass("on");
                  $(".input").prop("checked", true)
              }
          })

      })


    function check_tel(){
        var reg = /(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/;
        var mobile = $("#UserName").val();
        if(!reg.test(mobile)||mobile==''){
            layer.tips('请输入正确手机号或用户名',"#UserName",{tips:1,time:2000});
            return false;
        }else{
            return true;
        }

   }
  function pass(){
        var password = $("#Password").val();
        if(password==''){
            layer.tips('请输入正确的密码',"#Password",{tips:1,time:2000});
            return false;
        }else{
            return true;
        }

   }
    function loginBtn(){
          var csrf= "<?=Yii::$app->request->csrfToken?>";
          var mobile = $("#UserName").val(); 
          var password = $("#Password").val();
          var checkbox =$("#check").val();
  if(check_tel()&&pass()){
          $.ajax({ 
              url:"<?=Url::toRoute('register/loginadd')?>",
              type:'POST',
              data:{mobile:mobile,password:password,checkbox:checkbox,_csrf:csrf},
              success:function(data){

                 if(data==100){
                      layer.msg('登录成功!',{time:2000},function(){
                              window.location.href="<?=Url::toRoute('member/index')?>";      
                  });
                 }else if(data==200){
                    layer.msg('登录失败!', {time: 2000}, function () {
                      
                  });        
                 }else if(data==300){
                  layer.msg('您输入的手机号或验证码不正确!',{time:2000},function(){
                              // window.location.href="<?=Url::toRoute('member/index')?>";      
                  });
                 }
              }

          })

        }

    }


</script>
  </script> 


    </div>

<!-- foot -->
<div id="ft" class="footer-tmpl-1" style="padding: 0;">
      <p style="line-height: 44px;"> &copy;2015 掌期金服 All rights reserved&nbsp;&nbsp;&nbsp; </p>
    </div>
<!-- foot end --> 

<script src="http://cdn.bootcss.com/layer/2.4/layer.min.js"></script>
</body>
</html>

<?php if(isset($sign)&&!empty($sign)){ ?>

<script type="text/javascript">
   var msg ='您还未登录,请先登录！';
  layer.alert(msg, {icon: 2});    
</script> 
<?php }
?>