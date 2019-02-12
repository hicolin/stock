<?php 
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head> 
    <title>期货开户_掌期金服</title>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit" />
    <meta name="360-site-verification" content="75d2ecb8676c9f62d31b7271c57d4ee3" />
    <meta name="sogou_site_verification" content="nSVAEi2VY1" />
    <meta name="baidu-site-verification" content="kSvaTvCgVM" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="【掌期金服】-投资国内期货、外盘期货，沪橡胶、国债、股指期货、美原油、美黄金、德指、香港恒指期货，品种丰富，低门槛、低保证金，100%实盘交易，软件齐全,开户便捷,提供一站式金融交易服务" />
    <meta name="keywords" content="期货开户、投资开户、掌期金服" />
    <link rel="shortcut icon" href="/Content/v3.0/img/jin1.ico" />
    <link href="<?=Url::base()?>/frontend/web/css/global_2.0.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/frontend/web/css/global_3.0.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/frontend/web/css/index.css" rel="stylesheet" type="text/css" />               
    <script src="<?=Url::base()?>/frontend/web/js/jquery-1.11.1.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?=Url::base()?>/frontend/web/js/cfw.min.js"></script>
    <script type="text/javascript" language="javascript">
        var _oztime = (new Date()).getTime();
    </script>
 <script>

    var _hmt = _hmt || [];

    (function () {

        var hm = document.createElement("script");

        hm.src = "https://hm.baidu.com/hm.js?55b69ff9b0b77102062343ce39bdadbd";

        var s = document.getElementsByTagName("script")[0];

        s.parentNode.insertBefore(hm, s);

    })();

    </script>
</head>

<body>
<!--[if IE 7]>
    <div class="ie_bar">
        您现在使用的浏览器版本过低，可能会导致部分图片和信息的缺失，建议您安装360极速浏览器或升级到IE8以上版本<a href="http://down.360safe.com/cse/360cse_8.1.0.428.exe" target="_blank">下载并安装360极速浏览器</a>
    </div>
<![endif]-->







<!--top导航NED-->

<!--导航END-->
<script type="text/javascript">

    $(function () {
        var url = window.location.pathname + "";
        url = url.toLowerCase();

        var hasMenu = false;
        $(".main_nav li a").each(function () {
            var theLink = $(this);
            var href = theLink.attr("href");
            if (url == href.split('?')[0]) {
                hasMenu = true;
                theLink.addClass("active");
            } else {
                theLink.removeClass("active");
            }
        });

        //检测DNS劫持
        if (window.self == window.top) {
            document.documentElement.style.display = 'block';
        } else {
            window.top.location = window.self.location;
        }
    })
</script>
    <div class="bd">

<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/css/fuaccount.css" />
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/css/system.css" />
<link rel="shortcut icon" href="/Content/v3.0/img/jin1.ico" />

<!--------------------------申请开户---------------------------->
<div class="account_wrap" id="divOpenAccount">
    <div class="risk_1083">
        <div class="bar">
            <img src="<?=Url::base()?>/frontend/web/img/bar03.png" />
        </div>

        
        <div class="test_result">
            <h3>评测结果</h3>
            <p>您的总分是<span id="spanTestResult"><?=$cj?></span>，您的风险承受能力大致属于：</p>
            <div class="img">
                <img id="imgTestResult" src="<?=Url::base()?>/frontend/web/img/tu<?=$tt?>.png" />
            </div>
                <h4>
                    <input type="checkbox" class="choose-input" />我已阅读并同意<a href="<?=Url::toRoute(['news/help','cid'=>25])?>" target="_blank">《风险说明书》</a>
                </h4>
            <a class="bttn" href="javascript:;" onclick="openAccount()" id="aTestResult">申请开户</a>
        </div>


        <div class="mask" style="display:none"></div>
        <div class="window tWindow" style="display:none">
            <div class="in" style="padding-left:0;">
                <span class="delete CloseSpan" style="cursor:pointer;">
                    
                </span>
                <p class="content" id="pMsg" style="margin-bottom:45px;">暂时无法开通账号，请尝试重新开户</p>
                
                <a href="javascript:;" class="bttn red" onclick="Close()">重新开户</a>
            </div>
        </div>
    </div>
</div>
<!--------------------------申请开户   end---------------------------->


<script type="text/javascript">
    //风险评测，提交测试

    //申请开户
    function openAccount() {
        var aa = $('.choose-input').prop('checked');
        if (aa == false) {
            $("#pMsg").text("请先阅读并同意《风险说明书》");
            $(".bttn").text("确定");
            $(".tWindow,.mask").show();
        } else {
            var accountType = $("#hdaccountType").val();
            var openUrl = "/futuresaccount/OpenFutureAccount";
            $("#aTestResult").html("正在开户，请稍等。。。");
            $("#aTestResult").css("background", "#999999");
            $("#aTestResult").removeAttr("onclick");
            window.location.href="<?=Url::toRoute(['member/open-account'])?>"
        }


    }

    $(function () {
        //弹框“x”关闭
        $(".CloseSpan").on("click", function () {
            $(".mask").hide();
            $(".tWindow").hide();
        });
    });
    function Close() {
        $(".mask").hide();
        $(".tWindow").hide();
    }
</script>

<!--<div class="foot_bg">
    <div class="w1140">
        <div class="foot_nav_box">
            <ul>
                <li>
                    <div class="tle_box">
                        <dl>
                            <dt>掌期金服咨询热线</dt>
                            <dd><strong></strong></dd>
                            <dd><span>工作日：8:30-17:30</span><span>节假日：9:00-17:30</span></dd>
                            <dd style="margin-top: 5px;">夜盘紧急联系电话：020-87682367</dd>
                        </dl>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>-->
                
<!--页脚-->




<script type="text/javascript">
    $(function () {
        if ('True' == "True") {
            $(document).attr("title", "掌期金服");
            $(document).attr("description", "掌期金服");
            $(document).attr("keywords", "掌期金服");
        }
        //$("#serviceNumber2").html($("#serviceNumber").html());
        //var n = $("#hdServiceName").val();
        //if (n != '') {
        //    $("#sname").text(n + "服务热线");
        //}
    })
</script>

<div style="display: none;">
    <!--jbp66-->
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?2b5e3118a74aec54e09c4c43ff70040e";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <!--hengruicaifuwang-->
    
    
    
    
    
    
    
    
    

    
    <script type="text/javascript">
        var _py = _py || [];
        _py.push(['a', 'Yu..M_PNwlIxhKbda-RG1_NswX']);
        _py.push(['domain', 'stats.ipinyou.com']);
        _py.push(['e', '']);
        -function (d) {
            var s = d.createElement('script'),
            e = d.body.getElementsByTagName('script')[0]; e.parentNode.insertBefore(s, e),
            f = 'https:' == location.protocol;
            s.src = (f ? 'https' : 'http') + '://' + (f ? 'fm.ipinyou.com' : 'fm.p0y.cn') + '/j/adv.js';
        }(document);
    </script>
    <noscript><img src="//stats.ipinyou.com/adv.gif?a=Yu..M_PNwlIxhKbda-RG1_NswX&e=" style="display:none;" /></noscript>
</div>
    </div>


    
    <div class="sidebar">
        <a class="sidedar_top" href="tencent://message/?uin=1307304130"></a>
        <a class="sidedar_center" href="/help/HelpList?NewsCategoryTitle=掌期金服常见问题-应急报单&Menu=应急报单"></a>
        <p class="sidedar_bottom" href="" id="toTop"></p> 
        

    </div>
    <script>
        
        $(window).scroll(function () {
            var x = $(window).scrollTop();
            if (x > 500) {
                $('.sidedar_bottom').fadeIn();
            } else {
                $('.sidedar_bottom').fadeOut();
            }

        })

        $('.sidedar_bottom').click(function () {
            $('html,body').animate({ 'scrollTop': 0 }, 500);
        })

    </script>

    <script type="text/javascript" src="/Content/v2.0/js/util.min.js"></script>
    <script type="text/javascript" src="/Content/v2.0/js/user/cfw.user.min.js"></script>
    <script type="text/javascript">
        var ctx = {
            home: '',
            trade: '/jubaopen',
            user: '/user',
            my: '/my',
            account: '/account',
            union: '/union',
            lowdown: '/lowdown',
            sso: '/pass',
            seven: '/seven',
            res_js: '/content/v1.0/js',
            res_css: '/content/v1.0/css',
            res_img: '/content/v1.0/img'
        };
        //判断是否登录，如果登录则更新头部登录状态
        CFW.user.isLogin(function () { }, true);
        //$(function () {
        //    if ($.cookie("the_cookie") == null) {
        //        $.cookie('the_cookie', 'the_value', { expires: 1 });
        //        $(".advertising_box").show();
        //        $(".advertising_bg").show();
        //    }
          
        //    $(".advertising_main a.ad_close").click(function() {
        //        $(".advertising_box").hide();
        //        $(".advertising_bg").hide();
        //    });
           
        //});
    </script>

    
    
    <script type="text/javascript" src="/Content/js.lib/monitor/o_code.js"></script>

    
</body>
</html>
