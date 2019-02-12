<?php
use yii\helpers\Url;
?>
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/management.css">
<link href="http://cdn.bootcss.com/layer/2.4/skin/layer.min.css"></link>
<script src="http://cdn.bootcss.com/jquery/2.2.0/jquery.js"></script>
<script src="http://cdn.bootcss.com/layer/2.4/layer.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/uc_admin.css">
<style>
    .mybutton {
        border: 0px;
        background: url(<?=Url::base()?>/frontend/web/images/tj.jpg) no-repeat;
        width: 84px;
        height: 31px;
        color: #ffffff;
        font-size: 14px;
        line-height: 31px;
        text-align: center;
        margin-right: 5px;
        padding: 0;
        cursor: pointer;
    }
</style>



<style>
.layui-layer-btn .layui-layer-btn0 {
    border-color: #dd4b39;
    background-color: #dd4b39;
    color: #fff;
}
</style>


<script>
  function update_email(){
          var csrf= "<?=Yii::$app->request->csrfToken?>";
          var uemail6 = $("#uemail6").val();
          var email_code =$("#email_code").val(); 
          if(uemail6==''){
                layer.msg('邮箱不能为空!');
                return false;
          }
          if(email_code==''){
                layer.msg('验证码不能为空!');
                return false;
          }
           $.ajax({
                    type: 'post',
                    url: "<?=Url::toRoute(['member/bangemail'])?>",
                    data: {sendemail:uemail6,emailyzm:email_code,_csrf:csrf},
                    dataType: "json",
                    success:function(res){
                    if(res==100){
                        layer.msg('设置成功!',{time:2000},function(){
                          window.location.href="<?=Url::toRoute('member/security')?>";
                      });
                     }else if(res==200){
                        layer.msg('设置失败,邮箱已经设置', {time: 2000}, function () {
                          
                        });        
                     }else if(res==300){
                        layer.msg('邮箱或验证码不正确',{time:2000},function(){
                          });                        
                    }          
                  }
              })  
      }
 
    function send_email(){
        var hidden6 =$("#hidden").val();
        var uemail6 = $("#uemail6").val();
        var csrf= "<?=Yii::$app->request->csrfToken?>";
      if(uemail6==''){
                layer.msg('邮箱不能为空!');
                return false;
          }
      if(email_code==''){
                layer.msg('验证码不能为空!');
                return false;
      }        
      if(hidden6==1){
            $.ajax({
                type: 'post',
                url: "<?=Url::toRoute(['member/send-email'])?>",
                data: {sendemail:uemail6,_csrf:csrf},
                dataType: "json",
                success:function(res){
                  if(res==100){
                        count = 60;
                        //设置button效果，开始计时
                        $("#btnSendEmail").html(count + "秒后重试");
                        InterValObj = window.setInterval(SetRemainTime6, 1000); //启动计时器，1秒执行一次
                      layer.msg('验证码发送成功!',{time:2000},function(){
                        
                    });
                    }else if(res == 200){
                        layer.msg('验证码发送失败!',{time:2000},function(){
                        
                    });
                        
                    } 
                }
            })
        
    }else{
            layer.msg('请勿重复点击!', {time:2000});
            return false;
        }
}

    //         //timer处理函数
    function SetRemainTime6() {
        if (count == 0) {
            window.clearInterval(InterValObj);//停止计时器
            // $("#uemail6").attr('href','javascript:get_codes()');//启用按钮
            $("#hidden6").val(1)
            $("#btnSendEmail").html("重新发送");

        }
        else {
            count--;
            $("#hidden6").val(2);
            $("#btnSendEmail").html(count + "秒后重试");
            
        }
    }
</script>
<div class="wal" style="margin-top:30px;min-height: 700px" >
    <div class="con" >
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!-- right -->
        <div class="fr right" style="width:880px;">
            <div class="title"> 安全信息</div>


            <script type="text/javascript">


            </script>

            <ul>
                <li>
                  <span class="tit t2">实名认证</span> 
                  <?php if($member->state==1){ ?>
                  <span class="span1" style="color: red;">未认证</span> 
                  <span class="span2" style="color: red"> <a class="idno1" style="display: inline;">认证</a> 
                  <a class="idno2" style="display: none;">取消认证</a> </span>

                 <?php }else if($member->state==2){ ?>

                  <span class="span1">正在审核中</span> 
                  <span class="span2" style="color: red"> <a class="idno1" style="display: inline;">认证</a> 
                  <a class="idno2" style="display: none;">取消认证</a> </span>
                 <?php }else if($member->state==3){ ?>

                  <span class="span1">认证成功</span> 
                  <span class="span2" style="color: red"> <a class="idno1" style="display: inline;">认证</a> 
                  <a class="idno2" style="display: none;">取消认证</a> </span>

                 <?php } ?>


                    <!-- 用户实名认证 -->
                    <!-- 暂时注释 -->

                    <!--输入真实姓名和身份证认证-->
                    <div class="none n2" id="nameForm" style="display: none;">
                        <div class="nr nc">
                            <ul>
                                <li><span class="s1">姓名：</span> <span class="s2">
                  <input type="text" id="name" value="<?=$member->realname?>" placeholder="请输入您的姓名" class="txt">
                  </span> <span id="namemsg"></span></li>
                                <li><span class="s1">身份证号：</span> <span class="s2">
                  <input type="text" value="<?=$member->cartid?>" placeholder="请输入您的身份证号" id="idno" class="txt">
                  </span> <span id="idnomsg"></span></li>
                                <li><span class="s1">银行卡号：</span> <span class="s2">
                  <input type="text" id="bankcard"  value="<?=$member->bankid?>" placeholder="请输入您的银行卡号" class="txt">
                  </span> <span id="idno2msg"></span></li>
                                <li><span class="s1">开户分行：</span> <span class="s2">
                  <input type="text" id="bankname"  value="<?=$member->bank_name?>" placeholder="请输入您的开户行" class="txt">
                  </span> <span id="idno2msg"></span></li>                  
                                <li><span class="s1">银行卡绑定手机号：</span> <span class="s2">
                  <input type="text" id="mobile" value="<?=$member->bank_tel?>" name="mobile" placeholder="输入您银行绑定的的手机号" class="txt">
                  </span> <span id="idno2msg"></span></li>
                                <input type="hidden" value="<?=$member->state?>" class="state_member">
  <!--                               <li>
                                  <span class="s1"><b></b>验证码：</span><span class="s2">
                  <input type="text" class="txt1" style="width: 50px;background:none;border:1px solid #ccc"
                         id="code-id2" >
                  <input type="button" id="btn-id2" style="margin: 0px 0px" class="btn2 mybutton" value="获取验证码"
                         onclick="getcodephoneregpc(this.id);">
                  <span id="butn-btn-id2msg" style="color: red;"></span>
                  <label id="msgbutn-btn-id2" style="color: #a9a9a9;font-size:10px"></label>
                  <span id="id2msg" style="color: red"></span> </span>
                                    <label id="msgbutn-id2" style="color: red"></label>
                                </li> -->
                                <li><span id="pwdmsg" style="color: red;"></span> <span class="s1">
                  <input type="button" style="margin: 15px 280px" class="xgxi btn1 mybutton" value="提交认证"
                         onclick="nameValidate2();">
                                        <input type="button" style="margin: 15px 280px;" class="up_xgxi btn1 mybutton" value="修改认证" >
                  </span></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- 实名认证 -->
            <script type="text/javascript">

                  function y_pass4(){
                            var idno = $("#idno").val();
                            var bankcard = $("#bankcard").val();
                            var name = $("#name").val();
                            var mobile = $("#mobile").val();
                            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/; //身份证匹配
                           
                      if(!reg.test(idno)){

                              layer.msg('身份证号码不合法!');
                              return false;
                        }

                        if(bankcard==''){
                              layer.msg('银行卡号不能为空!');
                              return false;
                        }

                        if(name==""){

                            layer.msg('姓名不能为空!');
                              return false;
                        }
                        if(mobile==""){
                            layer.msg('请输入正确的手机号!');
                              return false;
                        }else{

                             return true;
                        }


                      } 
             function nameValidate2(){
                    var name =$("#name").val();
                    var idno = $("#idno").val();
                    var bankcard=$("#bankcard").val();
                    var mobile =$("#mobile").val();
                    var bankname =$("#bankname").val();
                    var csrf= "<?=Yii::$app->request->csrfToken?>";
                  if(y_pass4()){
                      //alert(name);
                      $.ajax({
                          type:'POST',
                          url: "<?=Url::toRoute(['member/rz'])?>",
                          data: {name:name,idno:idno,bankcard:bankcard,bankname:bankname,mobile:mobile,_csrf:csrf},

                          success:function(res){
                            //alert(res)
                            if(res==100){

                                layer.msg('绑定成功!',{time:2000},function(){
                                      window.location.reload();
                               });
                            } else if(res==200){
                               layer.msg('系统错误!',{time:2000},function(){
                                      window.location.reload();
                               });
                            } else if(res==300){
                                layer.msg('您已完成绑定',{time:2000},function(){
                                      window.location.reload();
                               });                              

                            }else if(res==400){
                                layer.msg('绑定失败',{time:2000},function(){
                                      
                               });
                            }
                            

                          }
                      })
                    }
                  }

                </script>
                <!-- 验证码 -->
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
                        url: "<?=Url::toRoute(['member/code'])?>",
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
                    $("#getRegMobileVCodeBtn").attr('href','javascript:get_codes()');//启用按钮
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

            <!-- 设置密码 -->
            <script type="text/javascript">
              function y_pass(){
                  var oldPassWord = $("#iputpassword").val();
                  var password = $("#newpwd1").val();
                  var password2= $("#newpwd2").val();
                  if(oldPassWord==''||password==''|| password2==''){
                    layer.msg('密码不能为空!');
                    return false;
                  }else if(password!=password2){
                    layer.msg('两次密码不一致!');
                    return false;
                  }else{
                    return true;
                  }

            }
            </script>
            <script type="text/javascript">
                     //修改支付密码
                function changePassWord(){
                    var oldPassWord = $("#iputpassword").val();
                    var newpwd1 = $("#newpwd1").val();
                    var newpwd2 = $("#newpwd2").val();
                    var csrf= "<?=Yii::$app->request->csrfToken?>";
                if(y_pass()){
                    $.ajax({
                        type: 'post',
                        url: "<?=Url::toRoute(['member/changepass'])?>",
                        data: {oldPassWord:oldPassWord,newpwd1:newpwd1,newpwd2:newpwd2,_csrf:csrf},
                        dataType: "json",
                        success:function(res){
                         if(res==100){
                              layer.msg('修改成功!',{time:2000},function(){
                                    window.location.reload();
                          });
                         }else if(res==200){
                            layer.msg('修改失败,系统错误!', {time: 2000}, function () {
                              
                            });        
                         }else if(res==300){
                            layer.msg('重复密码不一致',{time:2000},function(){
                              });                        
                         }else if(res==400){

                            layer.msg('原密码错误',{time:2000},function(){
                              });                     
                         }              


                        }
                    })                  

                 }   

                }
            </script>

                <li><span class="tit t3">登录密码</span> 

                  <span class="span1">已设置</span> 

                  <span class="span2"><a class="pwdxg1" style="display: inline;">修改</a> <a class="pwdxg2" style="display: none;">取消修改</a> </span>
                    <!-- 修改密码 -->
                    <div class="none n1" id="password" style="display: none;">
                        <div class="nr">
                            <ul>
                                <li><span class="s1">原密码:</span> <span class="s2">
                  <input type="password" placeholder="输入原密码" maxlength="16" class="txt" id="iputpassword"">
                  </span> </li>
                                <li><span class="s1">新密码：</span> <span class="s2">
                  <input type="password" placeholder="输入新密码" maxlength="16" class="txt" id="newpwd1">
                  </span> </li>
                                <li><span class="s1">重复新密码:</span> <span class="s2">
                  <input type="password" placeholder="重复新密码" maxlength="16" class="txt" id="newpwd2"">
                  </span> <span id="newpwd2msg" style="display: none;"></span></li>
                                <li><span id="pwdmsg" style="color: red;"></span> <span class="s1">
                  <input type="button" style="margin: 0px 280px" class="btn1 mybutton" value="确认"
                         onclick="changePassWord();">
                  </span></li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>
                </li>

                <li><span class="tit t4">绑定邮箱</span> 
                  
                  <?php if(isset($member->email)&&!empty($member->email)){ ?>

                    <span class="span1">已绑定</span> 
                    <span class="span2"><a class="bdemail1">绑定</a> <a class="bdemail2">取消绑定</a></span>
                    <script type="text/javascript">
                      

                          $(".bdemail1").click(function () {

                                  $(this).hide();
                                  $(".bdemail2").show();
                                  $(".none100").show();
                              });

                              $(".bdemail2").click(function () {
                                  $(this).hide();
                                  $(".bdemail1").show();
                                  $(".none100").hide();
                              });
                    </script>
                  <?php }else{ ?>

                    <span class="span1"  id="span11" style="color: red">未绑定</span> 
                    <span class="span2"  id="span12" ><a class="bdemail1" >绑定</a> <a class="bdemail2">取消绑定</a></span>

                    <script type="text/javascript">
                        $(".bdemail1").click(function () {
                              $(this).hide();
                              $(".bdemail2").show();
                              $(".none101").show();
                          });

                          $(".bdemail2").click(function () {
                              $(this).hide();
                              $(".bdemail1").show();
                              $(".none101").hide();
                          });
                
                    </script>

                  <?php }   ?>
                  <!-- 未绑定邮箱 -->
                    <div class="none none101" id="newemail01" style="display: none;">
                        <div class="headerDiv">
         
                            <span class="clear_f"></span></div>
                        <div class="nr">
                            <ul>
                                <li>
                                  <span class="s1">绑定新邮箱</span>
                                </li>
                                <li><span class="s1">验证邮箱 </span> <span class="s2">
                                <input type="text" id="codemail"  value="<?=$member['email']?>" class="txt1" style="width: 220px;background:none;border:1px solid #ccc"
                               id="code-newemail"> </span></li>
                                <li><span class="s1"><b>*</b>验证码</span><span class="s2">
                        <input type="text" class="txt1" value="" id="emailyzm"  style="width: 50px;background:none;border:1px solid #ccc" >
                        <input type="button" id="sendemails" class="btn2 mybutton" title="设置邮箱" value="获取验证码"
                               onclick="getcodeemail0()">
                           
                        <span id="butn-newemailmsg" style="color: red;"></span>
                        <label id="msgbutn-newemail" style="color:  #a9a9a9;font-size:10px"></label>
                        </span>
                                </li>
                                <li>
                                    <input type="button" class="btn1 mybutton" style="margin:0px 280px;" value="提交"
                                           onclick="BangEmail();">
                                </li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>
                    <input id="hidden"  type="hidden" value="1" class="yzm_btn" />
                    <input id="hidden0"  type="hidden" value="1" class="yzm_btn" />       
                    <script type="text/javascript">
                       function BangEmail(){
                           var csrf= "<?=Yii::$app->request->csrfToken?>";
                           var sendemail= $("#codemail").val();
                           var emailyzm = $("#emailyzm").val();
                           if(sendemail==""||emailyzm==""){
                             layer.msg('请输入邮箱或验证码!',{time:2000},function(){
                                  });
                            return false;
                           }

                       $.ajax({
                                type: 'post',
                                url: "<?=Url::toRoute(['member/bangemail'])?>",
                                data: {sendemail:sendemail,emailyzm:emailyzm,_csrf:csrf},
                                dataType: "json",
                                success:function(res){
                                if(res==100){
                                    layer.msg('设置成功!',{time:2000},function(){
                                      window.location.href="<?=Url::toRoute('member/security')?>";
                                  });
                                 }else if(res==200){
                                    layer.msg('设置失败,邮箱已经设置', {time: 2000}, function () {
                                      
                                    });        
                                 }else if(res==300){
                                    layer.msg('邮箱或验证码不正确',{time:2000},function(){
                                      });                        
                               }          
                                }
                          })

                       }

                  function getcodeemail0(){
                      var hidden0 =$("#hidden").val();
                      var sendemail = $("#codemail").val();
                      var csrf= "<?=Yii::$app->request->csrfToken?>";
                    if(hidden0==1){
                      if(check_tel()){
                          $.ajax({
                              type: 'post',
                              url: "<?=Url::toRoute(['member/send-email'])?>",
                              data: {sendemail:sendemail,_csrf:csrf},
                              dataType: "json",
                              success:function(res){
                                if(res==100){
                                      count = 60;
                                      //设置button效果，开始计时
                                      $("#sendemails").val(count + "秒后重试");
                                      InterValObj = window.setInterval(SetRemainTime0, 1000); //启动计时器，1秒执行一次
                                      
                                    layer.msg('验证码发送成功!',{time:2000},function(){
                                      
                                  });
                                  } else if(res == 200){

                                      layer.msg('验证码发送失败!',{time:2000},function(){
                                      
                                  });
                                      
                                  } 
                              }
                          })
                      }
                  }else{
                          layer.msg('请勿重复点击!', {time:2000});
                          return false;
                      }
                  }

          //timer处理函数
                  function SetRemainTime0() {
                      if (count == 0) {
                          window.clearInterval(InterValObj);//停止计时器
                          // $("#getRegMobileVCodeBtn").attr('href','javascript:get_codes()');//启用按钮
                          $("#hidden0").val(1)
                          $("#sendemails").val("重新发送");

                      }
                      else {
                          count--;
                          $("#hidden0").val(2);
                          $("#sendemails").val(count + "秒后重试");
                          
                      }
                  }

                  function getcodeemail(){
                      var hidden =$("#hidden").val();
                      var sendemail = $("#codemail").val();
                      var csrf= "<?=Yii::$app->request->csrfToken?>";
                    if(hidden==1){
                      if(check_tel()){
                          $.ajax({
                              type: 'post',
                              url: "<?=Url::toRoute(['member/send-email'])?>",
                              data: {sendemail:sendemail,_csrf:csrf},
                              dataType: "json",
                              success:function(res){
                                if(res==100){
                                      count = 60;
                                      //设置button效果，开始计时
                                      $("#dmail").val(count + "秒后重试");
                                      InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                                      
                                    layer.msg('验证码发送成功!',{time:2000},function(){
                                      
                                  });
                                  } else if(res == 200){

                                      layer.msg('验证码发送失败!',{time:2000},function(){
                                      
                                  });
                                      
                                  } 
                              }
                          })
                      }
                  }else{
                          layer.msg('请勿重复点击!', {time:2000});
                          return false;
                      }
                  }

      //timer处理函数
              function SetRemainTime() {
                  if (count == 0) {
                      window.clearInterval(InterValObj);//停止计时器
                      // $("#getRegMobileVCodeBtn").attr('href','javascript:get_codes()');//启用按钮
                      $("#hidden").val(1)
                      $("#dmail").val("重新发送");

                  }
                  else {
                      count--;
                      $("#hidden").val(2);
                      $("#dmail").val(count + "秒后重试");
                      
                  }
              }
                 
                    </script>
                    <!-- 选择修改方式      邮箱 -->
                    <div class="none1">
                        <div class="headerDiv"> 您正在修改的绑定邮箱是 <span class="red">*****</span>
                            <div class="head">
                                <div class="fl f1"><a class="yx">通过原邮箱修改</a></div>
                                <div class="fl f2"><a class="sj">通过原手机修改</a></div>
                                <span class="clear_f"></span></div>
                            如果您在操作过程中出现问题，请金诺鼎客服电话： 400-150-7888
                        </div>
                    </div>
                    <!--选择修改方式     邮箱 end -->

                    <!-- 原始邮箱      邮箱 -->
                    <div class="none none2" id="oledemail" style="display: none;">
                        <div class="headerDiv">
                            <div class="fl s1"> 验证当前邮箱</div>
                            <div class="fl s2"> 验证新邮箱</div>
                            <div class="fl s3"> 成功</div>
                            <span class="clear_f"></span></div>
                        <div class="nr">
                            <ul>
                                <li><span class="s1">已验证邮箱 </span> <span class="s2"> ***** </span></li>
                                <li><span class="s1"><b>*</b>验证码</span> <span class="s2">
                  <input type="text" class="txt1" style="width: 50px;background:none;border:1px solid #ccc"
                         id="code-oledemail" onblur="checkcode(&#39;oledemail&#39;)">
                  <input type="button" class="btn2 mybutton" id="butn-oledemail" value="获取验证码"
                         onclick="getcodeemail(&#39;oledemail&#39;,&#39;&#39;);">
                  </span> <span id="butn-oledemailmsg" style="color: red;"></span>
                                    <label id="msgbutn-oledemail" style="color: #a9a9a9;font-size:10px"></label>
                                </li>
                                <li>
                                    <input type="button" class="btn1 mybutton"
                                           onclick="gotoChangeEmail(&#39;oledemail&#39;,&#39;newemail&#39;,1);"
                                           value="下一步">
                                </li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>
                    <!-- 原始手机      邮箱 -->
                    <div class="none none5" id="oledphone1" style="display: none;">
                        <div class="headerDiv">
                            <div class="fl s1"> 验证当前手机号</div>
                            <div class="fl s2"> 验证新邮箱</div>
                            <div class="fl s3"> 成功</div>
                            <span class="clear_f"></span></div>
                        <div class="nr">
                            <ul>
                                <li><span class="s1">已验证手机号 </span><span class="s2"> 186*****402 </span></li>
                                <li><span class="s1"><b>*</b>验证码</span><span class="s2">
                  <input type="text" class="txt1" style="width: 50px;background:none;border:1px solid #ccc"
                         id="code-oledphone1" onblur="checkcode(&#39;oledphone1&#39;)">
                  <input type="button" class="btn2 mybutton" id="butn-oledphone1" value="获取验证码"
                         onclick="getcodeemail(&#39;oledphone1&#39;,&#39;18663165402&#39;)">
                  </span> <span id="msgbutn-oledphone1" style="color:  #a9a9a9;font-size: 9px"></span>
                                    <label id="butn-oledphone1msg" style="color: red"></label>
                                </li>
                                <li>
                                    <input type="button" class="btn1 mybutton"
                                           onclick="gotoChangeEmail(&#39;oledphone1&#39;,&#39;newemail&#39;,2);"
                                           value="下一步">
                                </li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>
                     <!-- 当前邮箱     邮箱 -->
                    <div class="none none100" id="newemail00" style="display: none;">
                        <div class="headerDiv">
                            <div class="fl s1"> 验证当前邮箱</div>
                            <div class="fl s2"> 验证新邮箱</div>
                            <div class="fl s3"> 成功</div>
                            <span class="clear_f"></span></div>
                        <div class="nr">
                            <ul>
                                <li>
                                  <span class="s1">当前邮箱</span>
                                </li>
                                <li><span class="s1">已验证邮箱 </span> <span class="s2"><?=$member->email?> </span></li>
                                <li><span class="s1"><b>*</b>验证码</span><span class="s2">
                  <input type="text" class="txt1" style="width: 50px;background:none;border:1px solid #ccc"
                         id="emailcode4" ">
                  <input type="button" id="dmail" class="btn2 mybutton" title="设置邮箱" value="获取验证码"
                         onclick="getcodeemail()">
                  <span id="butn-newemailmsg" style="color: red;"></span>
                  <label id="msgbutn-newemail" style="color:  #a9a9a9;font-size:10px"></label>
                  </span></li>
                              <li>
                                    <input type="button" class="btn1 mybutton" style="margin:0px 280px;" value="提交"
                                           onclick="DchangeEmail();">
                                </li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>

                    <script type="text/javascript">
                      function DchangeEmail(){
                           var csrf= "<?=Yii::$app->request->csrfToken?>";
                           var mailcode1 ="<?=$member->email?>";
                           var emailcode4 = $("#emailcode4").val(); 
                           $.ajax({
                                type: 'post',
                                url: "<?=Url::toRoute(['member/mailcode1'])?>",
                                data: {mailcode1:mailcode1,emailcode4:emailcode4,_csrf:csrf},
                                dataType: "json",
                                success:function(res){
                                  alert(res)
                                if(res==100){
                                    layer.msg('验证成功!',{time:2000},function(){ 
                                            $(".bdemail2").show();
                                            $(".none100").hide();
                                            $(".none3").show();

                                  });
                                 }else if(res==200){

                                    layer.msg('验证失败,邮箱或验证码不正确!', {time: 2000}, function () {
                                      
                                    });        
                                 }

                                }
                          })

                      }

                    </script>
                    <!-- 新邮箱     邮箱 -->
                    <div class="none none3" id="newemail" style="display: none;">
                        <div class="headerDiv">
                            <div class="fl s1"> 验证当前邮箱</div>
                            <div class="fl s2"> 验证新邮箱</div>
                            <div class="fl s3"> 成功</div>
                            <span class="clear_f"></span></div>
                        <div class="nr">
                            <ul>
                                <li><span class="s1">新邮箱</span>
                                    <input type="text" class="txt" id="newemail444" name="newemail">
                                </li>
                                <li><span class="s1"><b>*</b>验证码</span><span class="s2">
                  <input type="text" class="txt1" style="width: 50px;background:none;border:1px solid #ccc"
                         id="emailcode5" ">
                  <input type="button" id="butn-newemail" class="btn2 mybutton" title="设置邮箱" value="获取验证码"
                         onclick="getcodeemail2()">
                  <span id="butn-newemailmsg" style="color: red;"></span>
                  <label id="msgbutn-newemail" style="color:  #a9a9a9;font-size:10px"></label>
                  </span></li>
                                <li>
                                    <input type="button" class="btn1 mybutton" style="margin:0px 280px;" value="提交"
                                           onclick="DchangeEmail2();">
                                </li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>
                    <!-- 修改成功邮箱      邮箱 -->
                    <div class="none none4" id="sucssemail" style="display: none;">
                        <div class="headerDiv">
                            <div class="fl s1"> 验证当前邮箱</div>
                            <div class="fl s2"> 验证新邮箱</div>
                            <div class="fl s3"> 成功</div>
                            <span class="clear_f"></span></div>
                        <div class="nr">
                            <ul>
                                <li>
                                    <!-- ***** -->
                                    <span class="s1">新邮箱 </span><span id="successemailno" class="s2">验证成功</span></li>
                                <li> <span class="s1">
                  <input type="button" class="btn1 mybutton" onclick="locationpage('1');" value="确定">
                  <input id="hidden2"  type="hidden" value="1" class="yzm_btn" />   
                  </span></li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>
                </li>
                <script type="text/javascript">
                  
                  function DchangeEmail2(){
                         var csrf= "<?=Yii::$app->request->csrfToken?>";
                         var mailcode2 =$("#newemail444").val();
                         var emailcode5 = $("#emailcode5").val();
                         $.ajax({
                              type: 'post',
                              url: "<?=Url::toRoute(['member/mailcode2'])?>",
                              data: {mailcode2:mailcode2,emailcode5:emailcode5,_csrf:csrf},
                              dataType: "json",
                              success:function(res){
                                alert(res)
                              if(res==100){
                                  layer.msg('设置成功!',{time:2000},function(){
                                          
                                            $(".bdemail2").show();
                                            $(".none100").hide();
                                            $(".none3").hide();
                                            $(".none4").show();;

                            });
                               }else if(res==200){
                                  layer.msg('设置失败,系统错误!', {time: 2000}, function () {
                                    
                                  });        
                               }else if(res==300){
                                  layer.msg('重复密码不一致',{time:2000},function(){
                                    });                        
                             }          

                              }
                        })

                  }
                  function getcodeemail2(){
                      var hidden2 =$("#hidden2").val();
                      var sendemail = $("#newemail444").val();
                      var csrf= "<?=Yii::$app->request->csrfToken?>";
                      //alert(sendemail)
                   if(hidden2==1){
                      if(check_tel()){
                          $.ajax({
                              type: 'post',
                              url: "<?=Url::toRoute(['member/send-email'])?>",
                              data: {sendemail:sendemail,_csrf:csrf},
                              dataType: "json",
                              success:function(res){
                                if(res==100){
                                      count = 60;
                                      //设置button效果，开始计时
                                      $("#butn-newemail").val(count + "秒后重试");
                                      InterValObj = window.setInterval(SetRemainTime2, 1000); //启动计时器，1秒执行一次
                                      
                                    layer.msg('验证码发送成功!',{time:2000},function(){
                                      
                                  });
                                  } else if(res == 200){

                                      layer.msg('验证码发送失败!',{time:2000},function(){     
                                  });
                                      
                                  } 
                              }
                          })
                      }
                  }else{
                          layer.msg('请勿重复点击!', {time:2000});
                          return false;
                      }
                }

                function SetRemainTime2() {
                    if (count == 0) {
                        window.clearInterval(InterValObj);//停止计时器
                        $("#hidden2").val(1)
                        $("#butn-newemail").val("重新发送");

                    }
                    else {
                        count--;
                        $("#hidden2").val(2);
                        $("#butn-newemail").val(count + "秒后重试");
                        
                    }
                }                
              //   
                </script>

                <script type="text/javascript">
                  function locationpage(id){
                    
                    if(id==1){

                      window.location.href='<?=Url::toRoute('member/security')?>';
                    }
                        
                  }
                </script>
                <li><span class="tit t6">提现密码</span> 
                  <?php if(isset($member->tx_pwd)&&!empty($member->tx_pwd)){ ?>
                      <span class="span1">已设置</span>
                  <?php }else{ ?>

                    <span class="span1" style="color: red">未设置</span>

                  <?php }  ?> 
                  

                  
                    <span class="span2"> <!--
										<a href="javascript:" onclick="showorhide('changtradepass')">设置</a>--> 
          <span class="span2"> 
             <?php if(isset($member->tx_pwd)&&!empty($member->tx_pwd)){ ?>
                  <a class="settradepass1" onclick="$(&#39;#changtradepass&#39;).show();$(&#39;.settradepass2&#39;).show();$(&#39;.settradepass1&#39;).hide();">修改</a> 

                  <a class="settradepass2" onclick="$(&#39;#changtradepass&#39;).hide();$(&#39;.settradepass1&#39;).show();$(&#39;.settradepass2&#39;).hide();" style="display: none">取消修改</a> </span> </span>

               <?php }else{ ?>

                  <a class="settradepass1" onclick="$(&#39;#settradepass&#39;).show();$(&#39;.settradepass2&#39;).show();$(&#39;.settradepass1&#39;).hide();">设置</a> 
                  <a class="settradepass2" onclick="$(&#39;#settradepass&#39;).hide();$(&#39;.settradepass1&#39;).show();$(&#39;.settradepass2&#39;).hide();" style="display: none">取消设置</a> </span> </span>

               <?php }  ?> 

  
                    <!-- 设置提现密码 -->
                    <div class="none none11" id="settradepass" style="display: none">
                        <!-- 	<div class="headerDiv">
                                            </div> -->
                        <div class="nr">
                            <ul>
                                <li><span class="s1">提现密码:</span> <span class="s2">
                      <input placeholder="6-12位可以是字母和数字的组合" type="password" id="settradepass1" class="txt">
                      </span> <span class="span3" id="settradepass1msg"></span></li>
                                    <li><span class="s1">重复提现密码:</span> <span class="s2">
                      <input placeholder="重复提现密码" type="password" id="settradepass2" class="txt">
                      </span> <span class="span3" style="color: red" id="settradepass2msg"></span></li>
                                    <li> <span class="s1">
                      <input type="button" class="btn1 mybutton" value="确定" onclick="settradepass();">
                      </span></li>
                                </ul>
                                为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                            </div>
                  </div>

                    <script>
                      function y_pass2(){
                            var settradepass1 = $("#settradepass1").val();
                            var settradepass2 = $("#settradepass2").val();
                            
                          if(settradepass1==''||settradepass2==''){
                              layer.msg('密码不能为空!');
                              return false;
                            }else if(settradepass1!=settradepass2){
                              layer.msg('两次密码不一致!');
                              return false;
                            }else{
                              return true;
                            }

                      }
                     function settradepass(){

                           var settradepass1 = $("#settradepass1").val();
                           var settradepass2 = $("#settradepass2").val();
                           var csrf= "<?=Yii::$app->request->csrfToken?>";

                        if(y_pass2()){
                            $.ajax({
                                type: 'post',
                                url: "<?=Url::toRoute(['member/setpass'])?>",
                                data: {settradepass1:settradepass1,settradepass2:settradepass2,_csrf:csrf},
                                dataType: "json",
                                success:function(res){
                                if(res==100){
                                      layer.msg('设置成功!',{time:2000},function(){
                                              window.location.reload();
                                  });
                                 }else if(res==200){
                                    layer.msg('设置失败,系统错误!', {time: 2000}, function () {
                                      
                                    });        
                                 }else if(res==300){
                                    layer.msg('重复密码不一致',{time:2000},function(){
                                      });                        
                                 }          


                                }
                            })

                          }
                    }


                    </script>

                    <!-- 修改提现密码 -->
                    <div class="none none10" id="changtradepass" style="display: none;">
                        <!--  <div class="headerDiv">
                                            </div>-->
                        <div class="nr">
                            <ul>
                                <li><span class="s1">登录密码:</span> <span class="s2">
                                <input placeholder="请输入登录密码" type="password" id="tradepassloginpass" class="txt">
                                </span> <span id="tradepassloginpassmsg"></span></li>
<!--                                              <li><span class="s1">身份证号码：</span> <span class="s2">-->
<!--                                <input placeholder="请输入身份证号码" type="text" id="tradepassidno" class="txt">-->
<!--                                </span> <span id="tradepassidnosmsg"></span></li>-->
                                              <li><span class="s1">提现密码:</span> <span class="s2">
                                <input placeholder="6-12位可以是字母和数字的组合" type="password" id="tradepass1" class="txt">
                                </span> <span id="tradepass1msg"></span></li>
                                              <li><span class="s1">重复提现密码:</span> <span class="s2">
                                <input placeholder="重复提现密码" type="password" id="tradepass2" class="txt">
                                </span> <span id="tradepass2msg"></span></li>
                                <li>
                                    <input type="button" style="margin: 15px 280px" class="btn1 mybutton" value="确定"
                                           onclick="changetradepass();">
                                </li>
                            </ul>
                            为保障您的账户信息安全，在变更重要信息时需要进行身份验证。
                        </div>
                    </div>
                    <script type="text/javascript">
                      function y_pass3(){
                            var tradepass1 = $("#tradepass1").val();
                            var tradepass2 = $("#tradepass2").val();
                            var tradepassidno = $("#tradepassidno").val();
                            var loginpass = $("#tradepassloginpass").val();
                            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/; //身份证匹配
                          var pass=/^[a-zA-Z0-9]{6,12}$/;//密码验证
                        if(loginpass==''){
                              layer.msg('登录密码不能为空!');
                              return false;
                        }                            
                        // if(!reg.test(tradepassidno)){
                        //
                        //       layer.msg('身份证号码不合法!');
                        //       return false;
                        // }
                        if(!pass.test(tradepass1)){
                            layer.msg('密码不合法!');
                                  return false;
                        }
                        if(tradepass1==''||tradepass2==''){
                              layer.msg('提现密码不能为空!');
                              return false;
                            }else if(tradepass2!=tradepass1){
                              layer.msg('两次提现密码不一致!');
                              return false;
                            }else{
                              return true;
                        }

                      }                      
                      function changetradepass(){
                             var loginpass = $("#tradepassloginpass").val(); //登录密码
                             // var tradepassidno = $("#tradepassidno").val(); //身份证号
                             var tradepass1 = $("#tradepass1").val();  //提现密码                           
                             var tradepass2 = $("#tradepass2").val();  //重复提现                          
                             var csrf= "<?=Yii::$app->request->csrfToken?>";
                          if(y_pass3()){
                              $.ajax({
                                  type: 'post',
                                  url: "<?=Url::toRoute(['member/changetpass'])?>",
                                  data: {loginpass:loginpass,tradepass1:tradepass1,tradepass2:tradepass2,_csrf:csrf},
                                  dataType: "json",
                                  success:function(res){
                                  if(res==100){
                                        layer.msg('修改成功!',{time:2000},function(){
                                        window.location.reload();
                                    });
                                   }else if(res==200){
                                      layer.msg('修改失败,系统错误!', {time: 2000}, function () {
                                        
                                      });        
                                   }else if(res==300){
                                      layer.msg('提现密码不一致',{time:2000},function(){
                                        });                        
                                   }else if(res==400){
                                      layer.msg('登录密码错误',{time:2000},function(){
                                        });                        
                                   }


                                  }
                              })

                            }
                      }
                    </script>
                </li>
            </ul>
        </div>
        <!-- right end -->
    </div>
</div>
<div class="clear"></div>

<script>


    /*客服*/

    //设置提现密码
    var a;

    //传入密码 验证和当前登陆用户是否相符
    function valipwdoled(pwd) {
        $.ajax({
            async: false,
            type: "post",
            url: ' ' + pwd,
            dataType: 'JSON',
            async: false,
            success: function (result) {
                if (result.success == "false") {
                    $("#iputpassword").focus();
                    $("#iputpasswordmsg").show();
                    $("#iputpasswordmsg").text("请输入正确的密码！");
                    a = "false";
                    return false;
                } else {
                    $("#iputpasswordmsg").hide();
                    a = "true";
                    return true;
                }
            }
        });

        return a;
    }

    $(function () {


        $(".rightFast .l1").click(function () {
            $(this).parent().parent().find(".list").show("slow");
            $(this).parent().parent().find(".jsq").hide();
        });
        $(".rightFast .gbbx").click(function () {
            $(this).parent().hide();
        });
    });
    /*top隐藏显示*/
    $(function () {
        if ($(".topbx").length > 0) {
            $(window).scroll(function () {
                if ($(window).scrollTop() > $(window).height() / 2) {
                    $(".topbx").fadeIn("slow");
                } else {
                    $(".topbx").fadeOut("slow");
                }
            });
        }
    });


    /*修改个信息*/

    $(function () {


        $(".xgxi").click(function () {
            $(".usein2").show();
            $(".usein1").hide();
        });
        $(".qxxg").click(function () {
            $(".usein1").show();
            $(".usein2").hide();
        });
    });


    $(function () {

        $(".xg1").click(function () {
            $(this).hide();
            $(".xg2").show();
            $(".none1").show();
        });
        $(".none1 .yx").click(function () {
            $(this).parent().parent().parent().parent().hide();
            $(this).parent().parent().parent().parent().parent().find(".none2").show();
        });
        $(".none1 .sj").click(function () {


            if ($("#userPhone").val() == "") {
                $("#ajaxmsg3 .box").html("<span>您尚未绑定手机</span>")
                $("#ajaxmsg3").show();

            } else {
                $(this).parent().parent().parent().parent().hide();
                $(this).parent().parent().parent().parent().parent().find(".none5").show();
            }

        });
        $(".xg2").click(function () {
            $(".xg1").show();
            $(".xg2").hide();
            $(this).parent().parent().parent().find(".none").hide();
            $(this).parent().parent().parent().find(".none1").hide();
        });


 
        $(".phonexg1").click(function () {
            $(this).hide();
            $(".phonexg2").show();

            $(".none6").show();
            //$(".none7").show();

            // $(this).parent().parent().find(".none7").show();
        });
        $(".phonexg2").click(function () {
            $(".phonexg1").show();
            $(".phonexg2").hide();
            $(this).parent().parent().parent().find(".none").hide();
            $(this).parent().parent().parent().find(".none6").hide();
        });
        $(".none6 .sj").click(function () {

            if ($("#userEmail").val() == "") {
                $("#ajaxmsg3 .box").html("<span>您尚未绑定邮箱</span>")
                $("#ajaxmsg3").show();
            } else {
                $(this).parent().parent().parent().parent().hide();
                $(this).parent().parent().parent().parent().parent().find(".none12").show();
            }

        });
        $(".none6 .sfz").click(function () {
            $(this).parent().parent().parent().parent().hide();
            $(this).parent().parent().parent().parent().parent().find(".none7").show();
        });


        $(".tradepass1").click(function () {
            $(this).hide();
            $(".tradepass2").show();
            $(".none10").show();
        });
        $(".tradepass2").click(function () {
            $(".tradepass1").show();
            $(".tradepass2").hide();
            $(this).parent().parent().parent().find(".none").hide();
            $(this).parent().parent().parent().find(".none0").hide();
        });

        $(".pwdxg1").click(function () {
            $(this).hide();
            $(".pwdxg2").show();
            $(".n1").show();
        });

        $(".pwdxg2").click(function () {
            $(".pwdxg1").show();
            $(".pwdxg2").hide();
            $(this).parent().parent().parent().find(".none").hide();
            $(this).parent().parent().parent().find(".n1").hide();
        });


        $(".idno1").click(function () {
            $(this).hide();
            $(".idno2").show();
            $(".n2").show();
            var state=$(".state_member").val();

            // alert($(".nc").find(".s2").length);
            if(state=="3"){
                for(var i=0;i< $(".nc").find("input:text").length;i++){
                    $(".nc").find("input:text").eq(i).attr("disabled",true);
                    // alert($(".nc").find(".s2"));
                }
                $(".up_xgxi").attr("display","block");
                $(".xgxi").css("display","none");
            }else{
                $(".up_xgxi").css("display","none");//修改按钮隐藏
            }
        });
        //修改按钮
        $('.up_xgxi').click(function(){
            $(".xgxi").css("display","block");
            $(this).css("display","none");
            for(var i=0;i< $(".nc").find("input").length;i++){
                $(".nc").find("input").eq(i).attr("disabled",false);
                // alert($(".nc").find(".s2"));
            }

        });
        $(".idno2").click(function () {
            $(".idno1").show();
            $(".idno2").hide();
            $(this).parent().parent().parent().find(".none").hide();
            $(this).parent().parent().parent().find(".n2").hide();
        });

    });


</script>

