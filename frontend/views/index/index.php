<?php
use yii\helpers\Url;
use common\models\Common;
?>
<link href="<?=Url::base()?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/lrtk.css-v=20171204.css"  rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/chaogu.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layout.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/jquery.SuperSlide.2.1.1.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/main.js" ></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/follow.js" ></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/search.js" ></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/index.js"></script>
<div class="clearborth"></div>

<div class="app">
    <ul>
        <li>
            <img src="<?=Common::getSysInfo(76)?>" width="140" />
            <a href="javascript:" class="btn" target="_blank">APP下载</a>
        </li>

    </ul>
</div>
<!-- head end -->
<!--轮播图片-->
<div class="big-banner" id="slide-fade">
    <div class="hd" style="width: 135px;">
        <ul>
            <li class="on"></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="bd">
        <ul style="position: relative;">
            <li style="background:url('<?=Common::getSysInfo(68)?>') no-repeat  center  center" title=''></li>
            <li style="background:url('<?=Common::getSysInfo(69)?>') no-repeat  center  center" title=''></li>
            <li style="background:url('<?=Common::getSysInfo(70)?>') no-repeat  center  center" title=''></li>
        </ul>
    </div>
</div>
<script>
    jQuery("#slide-fade").slide({
        titCell: ".hd ul", mainCell: ".bd ul", effect: "leftLoop", autoPlay: true, autoPage: true, trigger: "mouseover",
        startFun: function (i) {
            var curLi = jQuery("#slide-fade .bd li").eq(i);
            var top;
            if (!!curLi.attr("_src")) {
                curLi.css("background-image", curLi.attr("_src")).removeAttr("_src");
            }
            for (var ii = 0; ii < $("#slide-fade .bd li").length; ii++) {
                $("#slide-fade .hd li").eq(ii).html($("#slide-fade .bd li").eq(ii).attr("title"));
            }
            $(".i-dot").animate({
                left: (jQuery("#slide-fade .hd li").eq(i).position().left) + "px"
            }, 200);
        }
    });
</script>
<!--top_news-->
<div class="news">
    <div class="top_news">
        <div class="top_news_left">
            最新<span>公告</span>
        </div>
        <div class="top_news_main" id="topNews">
            <div class="bd">
                <ul>
                   <!--  <?php foreach($zj_announcement as $list){?>
                    <li>$list['title']</li>
                    <?php }?> -->

                </ul>
            </div>
            <span class="clear_f"></span>
        </div>
        <div class="top_new_right">
            <a href="<?=Url::toRoute('news/announce')?>"  target="_blank">查看更多</a>
        </div>
        <span class="clear_f"></span>
    </div>
</div>
<div class="main f-clear">

     <!--沪深市场 start-->

    <div class="new_box1">
        <div class="new_box1_head">
            <h2>沪深市场</h2>
        </div>
        <div class="body">
            <div class="hcharts clearfix">
                <div class="hcharts-left tab-hv-box">
                    <div class="hcharts-list">
                        <div class="item tab-hv-trigger cur">
                            <h3 class="icons1">涨跌分布</h3>
                            <p class="detail">
                                <span class="c-rise">上涨：2963只</span>
                                <span class="c-fall">下跌：412只</span>
                            </p>
                        </div>
                        <div class="item tab-hv-trigger">
                            <h3 class="icon2">涨跌停</h3>
                            <p class="detail">
                                <span class="c-rise">涨停：31只</span>
                                <span class="c-fall">跌停：9只</span>
                            </p>
                        </div>
                        <div class="item tab-hv-trigger">
                            <h3 class="icon3">昨日涨停今日收益</h3>
                            <p class="detail">
                                <span class="c-rise">今收益：0.62%</span>
                            </p>
                        </div>
                    </div>
                    <div class="imgs_box">
                        <img src="<?=Url::base()?>/frontend/web/xnn/images/index/img_hs01.png" kind="1">
                        <img src="<?=Url::base()?>/frontend/web/xnn/images/index/img_hs02.png" style="display: none;" kind="2">
                        <img src="<?=Url::base()?>/frontend/web/xnn/images/index/img_hs03.png" style="display: none;" kind="3">
                    </div>
                </div>
                <div class="hcharts-right">
                    <h3>大盘评级</h3>
                    <div>
                        <img src="<?=Url::base()?>/frontend/web/xnn/images/index/img_sh_cord.png">
                    </div>
                    <p><label>投资建议</label></p>
                    <p id="tzjy">大盘震荡，适当参与</p>
                </div>
            </div>
            <div class="mt30 clearfix">
                <div class="flash-single flash-small">
                    <div class="data-line">
                        <strong class="off">上证指数(1A0001)</strong><br>
                        <span class="hint red" id="000001">2797.48</span>
                        <span class="red">2.50%</span>
                        <span class="red">68.24</span>
                    </div>
                    <div class="small_box">
                        <img src="<?=Url::base()?>/frontend/web/xnn/images/index/img_small01.png">
                    </div>
                </div>
                <div class="flash-single flash-small flash-sec">
                    <div class="data-line">
                        <strong class="off">深证指数(399001)</strong><br>
                        <span class="hint red" id="399001">8409.18</span>
                        <span class="red">2.13%</span>
                        <span class="red">175.29</span>
                    </div>
                    <div class="small_box">
                        <img src="<?=Url::base()?>/frontend/web/xnn/images/index/img_small02.png">
                    </div>
                </div>
                <div class="flash-single flash-small">
                    <div class="data-line">
                        <strong class="off">沪深(300)</strong><br>
                        <span class="hint red" id="000300">1411.12</span>
                        <span class="red">1.69%</span>
                        <span class="red">23.50</span>
                    </div>
                    <div class="small_box">
                        <img src="<?=Url::base()?>/frontend/web/xnn/images/index/img_small03.png">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function(){
           $(".hcharts-list .item").hover(function(){
               var _index = $(this).index()+1;
               $(this).addClass("cur").siblings().removeClass("cur");
               $(".imgs_box img[kind='"+ _index +"']").show().siblings().hide();
           });
        });
    </script>
    <!--沪深市场 start-->

    <!--四大优势 start-->
    <div class="advantage new_advantage1">
        <div class="advantage-four">
            <h3>安全可靠的策略投资</h3>
            <ul>
                <li>
                    <div class="safe-1 safe1">
                        <span class="safe-l"></span>
                        <span>什么是创建A股策略
						</span>
                    </div>
                    <div class="safe-2">
                        <p>T+1交易，时间2-20交易日，策略人提供交易策略。</p>
                        <p>投资人提供资金，平台撮合双方，风险共同承担，收益共享</p>
                    </div>
                </li>
                <li>
                    <div class="safe-1 safe2">
                        <span class="safe-l"></span>
                        <span>技术安全<br>
						</span>
                    </div>
                    <div class="safe-2">
                        <p>采用银行级监控技术，内部资金信息传输多层加密，分级设置权限、</p>
                        <p>交叉复合、形成严格内部控制体系，用户账户信息密码防篡泄露</p>
                    </div>
                </li>
                <li>
                    <div class="safe-1 safe3">
                        <span class="safe-l"></span>
                        <span>资金安全<br>
						</span>
                    </div>
                    <div class="safe-2">
                        <p>策略人和投资人的所有资金全部通过安全的支付通道，</p>
                        <p>所有资金进出全权由第三方机构负责并监督</p>
                    </div>
                </li>
                <li>
                    <div class="safe-1 safe4">
                        <span class="safe-l"></span>
                        <span>合法合规<br>
						</span>
                    </div>
                    <div class="safe-2">
                        <p>平台不参与交易，制作撮合策略人和投资人的信息匹配服务，指令的通讯服务，交易风控管理服务</p>
                        <p>资金支付以及清算服务，交易合作协议生产和管理服务</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!--四大优势 end  -->


    <!-- 新闻 -->
    <div class="in-news f-clear">
        <div class="fl in-news-type1">
            <h3 class="f-clear"><span class="fl"><i></i>行业资讯</span><a href="<?=Url::toRoute('news/reports')?>"

                                                                      class="more">更多&gt;</a></h3>

            <div class="in-news-list">
                <ul id="news_hy">
                    <?php foreach($news_list['trade'] as $list){?>
                    <li>
                        <a href="<?=Url::toRoute(['news/detail','id'=>$list['id']])?>" ><img src="<?=$list['img']?>"></a>
                        <a href="<?=Url::toRoute(['news/detail','id'=>$list['id']])?>"  class="tit"><?=mb_substr($list['title'],0,30).'....'?></a>

                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <div class="fr in-news-type2">
            <h3 class="f-clear"><span class="fl"><i></i>股票资讯</span><a href="<?=Url::toRoute('news/stock')?>"

                                                                      class="more">更多&gt;</a></h3>

            <div class="in-news-list">
                <ul id="news_zx">
                    <?php foreach($news_list['stock_list'] as $list){?>
                    <li>
                        <a href="<?=Url::toRoute(['news/detail','id'=>$list['id']])?>"  ><?=mb_substr($list['title'],0,18).'....'?></a>

                    </li>
                    <?php }?>

                </ul>
            </div>
        </div>
        <div class="in-news-separate"></div>
    </div>
</div>



<div class="clearborth"></div>
<script>
    $(function () {
        getMarket_z();
    });
    function getMarket_z(e) {
        var list = '<?=$code_list?>';
        $.ajax({
            url: '<?=Url::toRoute(['index/get-gp'])?>',
            type: "get",
            async: true,
            data: {list:list},
            dataType: "json",
            error: function () {
                setTimeout('getMarket_z()', 5000);
            },
            success: function (data) {
                var market = data.data;
                console.log(market);
                for (var i = 0; i < market.length; i++) {
                    var code=market[i].code.slice(2);
                    //alert(code);
                    if(market[i].new_price == 0) {
                        $('#code_' + code + ' .new_price').html('--');
                        $('#code_' + code + ' .change i').html('----');
                    }else {
                        //alert(market[i].new_price);
                        $('#'+ code).html(market[i].new_price);
                        $('#'+ code).next().html(market[i].frice_fluctuation+'%');
                        $('#'+ code).next().next().html(market[i].fluctuation);
                    }
                    if (market[i].frice_fluctuation < 0) {
                        $('#'+code).next().css({'color':'#0CBD70'});
                        $('#'+code).next().next().css({'background':'#238859','color':'#ffffff'});
                        setTimeout(function (_code){
                            $('#'+_code).next().next().css({'background':'','color':'#0CBD70'});
                        },2000,code);
                    } else {
                        $('#'+code).next().css({'color':'#e22626'});
                        $('#'+code).next().next().css({'background': '#dc5538','color':'#ffffff'});
                        setTimeout(function (_code){
                            $('#'+_code).next().next().css({'background':'','color':'#e22626'});
                        },2000,code);
                    }
                }
                setTimeout('getMarket_z()', 5000);
            }
        });
    }
</script>

