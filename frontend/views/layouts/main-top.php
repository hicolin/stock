<?php
use yii\helpers\Url;
$page = $this->context->action->id;
//判断当前用户的
?>
<!-- top and left in user page -->

<section class="newCenter">
    <div class="topLogInfo">
        <div class="topLeft">
            <img src="<?=Url::base()?>/frontend/web/i/photo.jpg" tppabs="https://www.91wcp.com/i/photo.jpg" id="userP" />
            <span class="topLeftText" id="helloUser"></span><span class="topLeftName" id="userName"></span>
        </div>
        <div class="topRight">
            <div class="topPhon" id="phone">手机号码：<span class="topPhonNum" id="phNum"></span><a href="newmember/security.htm" tppabs="https://www.91wcp.com/newmember/security"><img src="<?=Url::base()?>/frontend/web/i/suo.png" tppabs="https://www.91wcp.com/i/suo.png" /></a></div>
            <div class="topSecurity" id="sText">安全等级：<span class="topGrade" id="sLvC"></span><span class="topGradeText" id="sLv"></span><span class="topGradeIn"><a href="<?=Url::toRoute('user/safe')?>" tppabs="https://www.91wcp.com/newmember/security">查看</a></span></div><!--鼠标滑过效果topGradeIn1-->
        </div>
    </div>
    <div class="newCenterMain">
        <div class="newCenterNav">
            <ul>

                <li class="">
                    <a href="<?=Url::toRoute('user/page')?>" ><i class="icon-mine"></i><br />个人中心</a>
                </li>
                <li class="">
                    <a href="<?=Url::toRoute('user/recharge-money')?>" ><i class="icon-topup"></i><br />充值</a>
                </li>
                <li class="">
                    <a href="<?=Url::toRoute('user/withdraw-money')?>" ><i class="icon-withdraw"></i><br />提现</a>
                </li>
                <li class="">
                    <a href="<?=Url::toRoute('user/rcord')?>" ><i class="icon-menu"></i><br />资金明细</a>
                </li>
                <li class="">
                    <a href="<?=Url::toRoute('user/certification')?>" ><i class="icon-card"></i><br />实名认证</a>
                </li>
                <li class="">
                    <a href="<?=Url::toRoute('user/safe')?>" ><i class="icon-safe"></i><br />账户安全</a>
                </li>
                <!-- <li class="">
                    <a href="<?=Url::toRoute('user/promote')?>" ><i class="icon-soundup"></i><br />推广赚钱</a>
                </li> -->
            </ul>
            <!--<div class="navSelect">
                <div class="navSelectBox"><img src="~/i/zijin1.png" /><br />资金明细</div>
                <div class="zhe"></div>
            </div>-->
        </div>
        
  <script type="text/javascript">
      $(document).ready(function () {

                $(".newCenterNav li a").each(function(k,v){

                    if ($(this)[0].href == String(window.location) && $(this).attr('href')!="") {

                        $(this).parent().attr('class',"active").siblings().removeAttr("class")
                       }

                   });

                });
  </script>  