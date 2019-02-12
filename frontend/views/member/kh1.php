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

    <link href="<?=Url::base()?>/frontend/web/css/global_2.0.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/frontend/web/css/global_3.0.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/frontend/web/css/index2.css" rel="stylesheet" type="text/css" />

               
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
<link rel="shortcut icon" href="<?=Url::base()?>/frontend/web/img/jin1.ico" />

<!--------------------------风险评测---------------------------->

<div class="risk_wrap" id="divRiskTest">
    <input id="hdaccountType" type="hidden" value="1" />
    <div class="risk_1083">
        <div class="bar">
            <img src="<?=Url::base()?>/frontend/web/img/bar02.png" />
        </div>
        <h2>期货投资者风险承受能力调查问卷</h2>
        <h3>声明：本调查问卷的结果将作为您未来在进行期货交易时的风险评估参考。此问卷的内容及结果非投资买卖建议。本平台将不对此份问卷准确性以及咨询完整性负责。</h3>
        <div class="test" id="radioList">
            <h4><span>1</span>您的年龄: </h4>
            <p class="pradio">
                <input type="radio" name="one" value="1" id="one1" /><label for="one1">20-30(含)</label>
                <input type="radio" name="one" value="10" id="one2" /><label for="one2">30-50(含)</label>
                <input type="radio" name="one" value="1" id="one3" /><label for="one3">50-60(含)</label>
            </p>
            <h4><span>2</span>您的年收入为:<br /> </h4>
            <p class="pradio">
                <input type="radio" name="two" value="1" id="two1" /><label for="two1">5万元以下</label>
                <input type="radio" name="two" value="2" id="two2" /><label for="two2">5-20万元</label>
                <input type="radio" name="two" value="6" id="two3" /><label for="two3">20-50万元</label>
                <input type="radio" name="two" value="8" id="two4" /><label for="two4">50-100万元</label>
                <input type="radio" name="two" value="10" id="two5" /><label for="two5">100万元以上</label>
            </p>
            <h4><span>3</span>在您每年的家庭收入中，可用于金融投资（储蓄存款除外）的比例为:</h4>
            <p class="pradio">
                <input type="radio" name="three" value="2" id="three1" /><label for="three1">小于10%</label>
                <input type="radio" name="three" value="6" id="three2" /><label for="three2">10%-25%</label>
                <input type="radio" name="three" value="8" id="three3" /><label for="three3">25%-50%</label>
                <input type="radio" name="three" value="10" id="three4" /><label for="three4">大于50%</label>
            </p>
            <h4><span>4</span>您投资期货的资金主要来源于：</h4>
            <p class="pradio">
                <input type="radio" name="four" value="10" id="four1" /><label for="four1">银行存款</label>
                <input type="radio" name="four" value="6" id="four2" /><label for="four2">私人借款</label>
                <input type="radio" name="four" value="2" id="four3" /><label for="four3">银行借贷</label>
                <input type="radio" name="four" value="0" id="four4" /><label for="four4">其他</label>
            </p>
            <h4><span>5</span>投资过的品种:  （请选择一项您所投资过的最高风险的金融产品）</h4>
            <p class="pradio">
                <input type="radio" name="five" value="0" id="five1" /><label for="five1">从来没有</label>
                <input type="radio" name="five" value="2" id="five2" /><label for="five2">保险、银行存款产品或者债券</label>
                <input type="radio" name="five" value="6" id="five3" /><label for="five3">股票或股票基金</label>
                <input type="radio" name="five" value="10" id="five4" /><label for="five4">期货、期权等衍生品</label>
            </p>
            <h4><span>6</span>您投资金融产品的年限:</h4>
            <p class="pradio">
                <input type="radio" name="six" value="0" id="six1" /><label for="six1">没有经验</label>
                <input type="radio" name="six" value="2" id="six2" /><label for="six2">少于2年</label>
                <input type="radio" name="six" value="6" id="six3" /><label for="six3">2至5年</label>
                <input type="radio" name="six" value="10" id="six4" /><label for="six4">5年以上</label>
            </p>
            <h4>
                <span>7</span>您进行投资的主要依据是什么：
            </h4>
            <p class="pradio">
                <input type="radio" name="seven" value="0" id="seven1" /><label for="seven1">凭感觉</label>
                <input type="radio" name="seven" value="2" id="seven2" /><label for="seven2">技术分析或基本面分析</label>
                <input type="radio" name="seven" value="6" id="seven3" /><label for="seven3">朋友推荐</label>
                <input type="radio" name="seven" value="10" id="seven4" /><label for="seven4">专家意见</label>
            </p>
            <h4>
                <span>8</span>除期货风险外，您对期货知识的了解：
            </h4>
            <p class="pradio">
                <input type="radio" name="eight" value="0" id="eight1" /><label for="eight1">一点都不了解</label>
                <input type="radio" name="eight" value="6" id="eight2" /><label for="eight2">有一定程度的了解</label>
                <input type="radio" name="eight" value="10" id="eight3" /><label for="eight3">非常了解</label>
            </p>

            <h4>
                <span>9</span>假定有3种投资供您选择，您会选择：
            </h4>
            <p class="pradio">
                <input type="radio" name="nine" value="2" id="nine1" /><label for="nine1">肯定赚5%</label>
                <input type="radio" name="nine" value="6" id="nine2" /><label for="nine2">可能亏20%可能赚50%</label>
                <input type="radio" name="nine" value="10" id="nine3" /><label for="nine3">可能全部亏损可能赚200%</label>
            </p>
            <h4>
                <span>10</span>若与预期相反，当亏损达到20%时，您会怎么做：
            </h4>
            <p class="pradio">
                <input type="radio" name="ten" value="2" id="ten1" /><label for="ten1">再等等看，也许可以收回本金</label>
                <input type="radio" name="ten" value="10" id="ten2" /><label for="ten2">为避免更大损失，全部平仓</label>
            </p>
            <h4>
                <span>11</span>您投资期货的目的是：
            </h4>
            <p class="pradio">
                <input type="radio" name="eleven" value="2" id="eleven1" /><label for="eleven1">获取高收益</label>
                <input type="radio" name="eleven" value="6" id="eleven2" /><label for="eleven2">获取稳定收益</label>
                <input type="radio" name="eleven" value="10" id="eleven3" /><label for="eleven3">进行套期保值</label>
            </p>
            <h4>
                <span>12</span>您可以承受的价值波动幅度：
            </h4>
            <p class="pradio">
                <input type="radio" name="twelve" value="0" id="twelve1" /><label for="twelve1">不能够承受本金损失</label>
                <input type="radio" name="twelve" value="2" id="twelve2" /><label for="twelve2">能够承受本金20％以内的亏损</label>
                <input type="radio" name="twelve" value="6" id="twelve3" /><label for="twelve3">能够承受本金20%-50%的亏损</label>
                <input type="radio" name="twelve" value="10" id="twelve4" /><label for="twelve4">能够承受本金50％以上亏损</label>
            </p>
        </div>

        <a href="javascript:;" onclick="SubmitTest();">提交测评</a>
    </div>
</div>

<!--------------------------风险评测  end---------------------------->

<script type="text/javascript">
    //风险评测，提交测试
  function SubmitTest() {

      var cdun = $('#radioList .pradio').find('input:checked:first');
      var pradio = $(".pradio").length;
      if (cdun.length == pradio) {
          window.location.href='<?=Url::toRoute(['member/kh2'])?>'

      } else {

          CFW.dialog.alert("请完成全部调查问卷！", 0, null);
      }
  }

    //重新评测
    function AgainTest() {
        $("#divOpenAccount").css("display", "none");
        $("#divRiskTest").css("display", "block");
    }
    //申请开户
    function openAccount() {
        var aa = $('.choose-input').prop('checked');
        if (aa == false) {
            $("#pMsg").text("请先阅读并同意《风险说明书》");
            $(".bttn").text("确定");
            $(".tWindow,.mask").show();
        } else {
            var accountType = $("#hdaccountType").val();
            alert(accountType);return;
            var openUrl = "/futuresaccount/OpenFutureAccount";
            $("#aTestResult").html("正在开户，请稍等。。。");
            $("#aTestResult").css("background", "#999999");
            $("#aTestResult").removeAttr("onclick");
            $.ajax({
                url: "/futuresaccount/OpenFutureAccount",
                type: 'get',
                data: { accountType: accountType },
                dataType: 'json',
                success: function (r) {
                    if (r.success) {
                        $("#divOpenAccount").css("display", "none");
                        $("#divAccountSuccess").css("display", "block");
                        $("#hAccountType").text("恭喜您，" + r.type + "账号开通成功！");
                        $("#spanAccount").text(r.account);
                        $("#spanAccountPwd").text(r.password);
                    } else {
                        $(".mask").css("display", "block");
                        $(".window").css("display", "block");
                        $("#pMsg").text(r.msg);
                    }
                    $("#aTestResult").html("申请开户");
                    $("#aTestResult").css("background", "#dc2b17");
                    $("#aTestResult").attr("onclick", "openAccount();");
                }
            });
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
