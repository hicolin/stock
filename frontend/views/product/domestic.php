<?php
use yii\helpers\Url;
?>
    <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/css/style.css"/>
<?php $this->beginBlock('header'); ?>
    <!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

    <!--main1 star-->
    <div class="na-main1">
        <div class="w1200">
            <div class="na-main1-con">
                <div class="namc-left fl">
                    <div class="namc-left-top">
                        <ul>
                            <li class="curr">国际原油</li>
                            <li>美黄金</li>
                            <li>恒生指数</li>
                            <li>德指</li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="namc-left-con">
                        <div class="namc-left-son">
                            <h2>确认操盘规则</h2>
                            <p>操盘须知：<span>美国轻质原油期货当期主力合约（不可留仓）</span></p>
                            <p>交易时间：<span>夏令时06:00-05:00，冬令时07:00-06:00</span></p>
                            <p>操盘保证金（$）：<span><i class="price31">1000.00</i>美元</span></p>
                            <p>总操盘资金（$）：<span><i class="price32">3000.00</i>美元</span></p>
                            <p>亏损平仓线（$）：<span><i class="price33">2500.00</i>美元</span></p>
                            <p>账户管理费（$）：<span> 0美元</span></p>
                            <p>交易手续费：<span>另议</span></p>
                        </div>
                        <!--<div class="namc-left-son hiddendiv">-->
                        <!--<h2>确认操盘规则</h2>-->
                        <!--<p>操盘须知：<span>美黄金GC当期主力合约（不可留仓）</span></p>-->
                        <!--<p>交易时间：<span>夏令时06:00-05:00，冬令时07:00-06:00</span></p>-->
                        <!--<p>操盘保证金（$）：<span><i class="price31">1000.00</i>美元</span></p>-->
                        <!--<p>总操盘资金（$）：<span><i class="price32">3000.00</i>美元</span></p>-->
                        <!--<p>亏损平仓线（$）：<span><i class="price33">2500.00</i>美元</span></p>-->
                        <!--<p>账户管理费（$）：<span> 0美元</span></p>-->
                        <!--<p>交易手续费：<span>另议</span></p>-->
                        <!--</div>-->
                        <!--<div class="namc-left-son hiddendiv">-->
                        <!--<h2>确认操盘规则</h2>-->
                        <!--<p>操盘须知：<span>香港恒生指数当期主力合约（中午可留仓，下午晚上不可留仓）</span></p>-->
                        <!--<p>交易时间：<span>夏令时06:00-05:00，冬令时07:00-06:00</span></p>-->
                        <!--<p>操盘保证金（$）：<span><i class="price31">1000.00</i>美元</span></p>-->
                        <!--<p>总操盘资金（$）：<span><i class="price32">3000.00</i>美元</span></p>-->
                        <!--<p>亏损平仓线（$）：<span><i class="price33">2500.00</i>美元</span></p>-->
                        <!--<p>账户管理费（$）：<span> 0美元</span></p>-->
                        <!--<p>交易手续费：<span>另议</span></p>-->
                        <!--</div>-->
                        <!--<div class="namc-left-son hiddendiv">-->
                        <!--<h2>确认操盘规则</h2>-->
                        <!--<p>操盘须知：<span>德指当期主力合约（中午可留仓，下午晚上不可留仓）</span></p>-->
                        <!--<p>交易时间：<span>夏令时06:00-05:00，冬令时07:00-06:00</span></p>-->
                        <!--<p>操盘保证金（$）：<span><i class="price31">1000.00</i>美元</span></p>-->
                        <!--<p>总操盘资金（$）：<span><i class="price32">3000.00</i>美元</span></p>-->
                        <!--<p>亏损平仓线（$）：<span><i class="price33">2500.00</i>美元</span></p>-->
                        <!--<p>账户管理费（$）：<span> 0美元</span></p>-->
                        <!--<p>交易手续费：<span>另议</span></p>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="namc-mid fl">
                    <img src="<?=Url::base()?>/frontend/web/images/box-shadow.png"/>
                </div>
                <div class="namc-right fr">
                    <div class="namc-right-son">
                        <div class="namc-right-son-top">
                            <h1>选择开仓手数<span>（可持仓的最大手数）</span></h1>
                        </div>
                        <div class="namc-right-son-li">
                            <ul>
                                <li class="active">
                                    <h3><i class="snum">1</i>手</h3>
                                    <h4>可开仓1手</h4>
                                </li>
                                <li>
                                    <h3><i class="snum">2</i>手</h3>
                                    <h4>可开仓1-2手</h4>
                                </li>
                                <li>
                                    <h3><i class="snum">3</i>手</h3>
                                    <h4>可开仓1-3手</h4>
                                </li>
                                <li>
                                    <h3><i class="snum">5</i>手</h3>
                                    <h4>可开仓1-5手</h4>
                                </li>
                                <li>
                                    <h3><i class="snum">6</i>手</h3>
                                    <h4>可开仓1-6手</h4>
                                </li>
                                <li>
                                    <h3><i class="snum">7</i>手</h3>
                                    <h4>可开仓1-7手</h4>
                                </li>
                                <li>
                                    <h3><i class="snum">8</i>手</h3>
                                    <h4>可开仓1-8手</h4>
                                </li>
                                <li>
                                    <h3><i class="snum">10</i>手</h3>
                                    <h4>可开仓1-10手</h4>
                                </li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="namc-right-son-top mt20">
                            <h1>单手保证金<span>（操盘保证金越多，平仓风险越低）</span></h1>
                        </div>
                        <div class="namc-right-son-li2">
                            <div class="namc-right-son-li2-left fl">
                                <button class="fl desc">-</button>
                                <!--<i class="fl num">1000.00</i>-->
                                <input type="text" class="fl num" value="1000">
                                <button class="fl add">+</button>
                                <div class="clear"></div>
                            </div>
                            <div class="namc-right-son-li2-right fl">
                                <ul>
                                    <li class="active">1000</li>
                                    <li>2000</li>
                                    <li>4000</li>
                                    <li>6000</li>
                                    <li>8000</li>
                                    <li>10000</li>
                                    <li>12000</li>
                                    <li>15000</li>
                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!--<div class="namc-right-son hiddendiv">-->
                    <!--<div class="namc-right-son-top">-->
                    <!--<h1>选择开仓手数<span>（可持仓的最大手数）</span></h1>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li">-->
                    <!--<ul>-->
                    <!--<li class="active">-->
                    <!--<h3><i class="snum">1</i>手</h3>-->
                    <!--<h4>可开仓1手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">2</i>手</h3>-->
                    <!--<h4>可开仓1-2手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">3</i>手</h3>-->
                    <!--<h4>可开仓1-3手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">4</i>手</h3>-->
                    <!--<h4>可开仓1-4手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">5</i>手</h3>-->
                    <!--<h4>可开仓1-5手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">6</i>手</h3>-->
                    <!--<h4>可开仓1-6手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">7</i>手</h3>-->
                    <!--<h4>可开仓1-7手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">8</i>手</h3>-->
                    <!--<h4>可开仓1-8手</h4>-->
                    <!--</li>-->
                    <!--<div class="clear"></div>-->
                    <!--</ul>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-top mt20">-->
                    <!--<h1>单手保证金<span>（操盘保证金越多，平仓风险越低）</span></h1>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li2">-->
                    <!--<div class="namc-right-son-li2-left fl">-->
                    <!--<button class="fl desc">-</button>-->
                    <!--<i class="fl num">1000.00</i>-->
                    <!--<button class="fl add">+</button>-->
                    <!--<div class="clear"></div>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li2-right fl">-->
                    <!--<ul>-->
                    <!--<li class="active">1000</li>-->
                    <!--<li>2000</li>-->
                    <!--<li>4000</li>-->
                    <!--<li>6000</li>-->
                    <!--<li>8000</li>-->
                    <!--<li>10000</li>-->
                    <!--<li>12000</li>-->
                    <!--<li>15000</li>-->
                    <!--</ul>-->
                    <!--</div>-->
                    <!--<div class="clear"></div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son hiddendiv">-->
                    <!--<div class="namc-right-son-top">-->
                    <!--<h1>选择开仓手数<span>（可持仓的最大手数）</span></h1>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li">-->
                    <!--<ul>-->
                    <!--<li class="active">-->
                    <!--<h3><i class="snum">1</i>手</h3>-->
                    <!--<h4>可开仓1手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">2</i>手</h3>-->
                    <!--<h4>可开仓1-2手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">3</i>手</h3>-->
                    <!--<h4>可开仓1-3手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">4</i>手</h3>-->
                    <!--<h4>可开仓1-4手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">5</i>手</h3>-->
                    <!--<h4>可开仓1-5手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">7</i>手</h3>-->
                    <!--<h4>可开仓1-7手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">8</i>手</h3>-->
                    <!--<h4>可开仓1-8手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">10</i>手</h3>-->
                    <!--<h4>可开仓1-10手</h4>-->
                    <!--</li>-->
                    <!--<div class="clear"></div>-->
                    <!--</ul>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-top mt20">-->
                    <!--<h1>单手保证金<span>（操盘保证金越多，平仓风险越低）</span></h1>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li2">-->
                    <!--<div class="namc-right-son-li2-left fl">-->
                    <!--<button class="fl desc">-</button>-->
                    <!--<i class="fl num">1000.00</i>-->
                    <!--<button class="fl add">+</button>-->
                    <!--<div class="clear"></div>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li2-right fl">-->
                    <!--<ul>-->
                    <!--<li class="active">1000</li>-->
                    <!--<li>2000</li>-->
                    <!--<li>4000</li>-->
                    <!--<li>6000</li>-->
                    <!--<li>8000</li>-->
                    <!--<li>10000</li>-->
                    <!--<li>12000</li>-->
                    <!--<li>15000</li>-->
                    <!--</ul>-->
                    <!--</div>-->
                    <!--<div class="clear"></div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son hiddendiv">-->
                    <!--<div class="namc-right-son-top">-->
                    <!--<h1>选择开仓手数<span>（可持仓的最大手数）</span></h1>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li">-->
                    <!--<ul>-->
                    <!--<li class="active">-->
                    <!--<h3><i class="snum">1</i>手</h3>-->
                    <!--<h4>可开仓1手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">2</i>手</h3>-->
                    <!--<h4>可开仓1-2手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">3</i>手</h3>-->
                    <!--<h4>可开仓1-3手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">4</i>手</h3>-->
                    <!--<h4>可开仓1-4手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">5</i>手</h3>-->
                    <!--<h4>可开仓1-5手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">7</i>手</h3>-->
                    <!--<h4>可开仓1-7手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">8</i>手</h3>-->
                    <!--<h4>可开仓1-8手</h4>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--<h3><i class="snum">10</i>手</h3>-->
                    <!--<h4>可开仓1-10手</h4>-->
                    <!--</li>-->
                    <!--<div class="clear"></div>-->
                    <!--</ul>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-top mt20">-->
                    <!--<h1>单手保证金<span>（操盘保证金越多，平仓风险越低）</span></h1>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li2">-->
                    <!--<div class="namc-right-son-li2-left fl">-->
                    <!--<button class="fl desc">-</button>-->
                    <!--<i class="fl num">1000.00</i>-->
                    <!--<button class="fl add">+</button>-->
                    <!--<div class="clear"></div>-->
                    <!--</div>-->
                    <!--<div class="namc-right-son-li2-right fl">-->
                    <!--<ul>-->
                    <!--<li class="active">1000</li>-->
                    <!--<li>2000</li>-->
                    <!--<li>4000</li>-->
                    <!--<li>6000</li>-->
                    <!--<li>8000</li>-->
                    <!--<li>10000</li>-->
                    <!--<li>12000</li>-->
                    <!--<li>15000</li>-->
                    <!--</ul>-->
                    <!--</div>-->
                    <!--<div class="clear"></div>-->
                    <!--</div>-->
                    <!--</div>-->
                </div>
                <div class="clear"></div>
                <div class="namc-btn">
                    <h1><a href=""><button>提交操盘申请</button></a></h1>
                    <h2>
                        <label class="on">我已阅读并同意</label>
                        <a target="_blank" href="<?=Url::toRoute('/member/register-agree')?>">《用户服务协议》</a>
                        <a target="_blank" href="<?=Url::toRoute('/member/register-agree')?>">《风险提示》</a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!--main1 end-->

    <!--main2 star-->
    <div class="na-main2">
        <div class="w1200">
            <div class="na-main2-left fl">
                <div class="na-main2-table">
                    <table>
                        <tr>
                            <td></td>
                            <td>用户名</td>
                            <td>操盘金额</td>
                            <td>获利百分比</td>
                            <td>盈利金额</td>
                        </tr>
                        <tr>
                            <td><img src="<?=Url::base()?>/frontend/web/images/t1.png"/></td>
                            <td>hojo123</td>
                            <td>3.36万</td>
                            <td><span>37.1%</span></td>
                            <td><span>30万</span></td>
                        </tr>
                        <tr>
                            <td><img src="<?=Url::base()?>/frontend/web/images/t2.png"/></td>
                            <td>hojo123</td>
                            <td>3.36万</td>
                            <td><span>37.1%</span></td>
                            <td><span>30万</span></td>
                        </tr>
                        <tr>
                            <td><img src="<?=Url::base()?>/frontend/web/images/t3.png"/></td>
                            <td>hojo123</td>
                            <td>3.36万</td>
                            <td><span>37.1%</span></td>
                            <td><span>30万</span></td>
                        </tr>
                        <tr>
                            <td><img src="<?=Url::base()?>/frontend/web/images/t4.png"/></td>
                            <td>hojo123</td>
                            <td>3.36万</td>
                            <td><span>37.1%</span></td>
                            <td><span>30万</span></td>
                        </tr>
                        <tr>
                            <td><img src="<?=Url::base()?>/frontend/web/images/t5.png"/></td>
                            <td>hojo123</td>
                            <td>3.36万</td>
                            <td><span>37.1%</span></td>
                            <td><span>30万</span></td>
                        </tr>
                        <tr>
                            <td><img src="<?=Url::base()?>/frontend/web/images/t6.png"/></td>
                            <td>hojo123</td>
                            <td>3.36万</td>
                            <td><span>37.1%</span></td>
                            <td><span>30万</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="na-main2-right fl ml30">
                <h1><span>特别说明</span></h1>
                <div class="na-main2-right-con">
                    <p>1、您需在交易时段结束前自行平仓，如未平仓，我们有权进行强平将无法保证您的盈亏。  </p>
                    <p>2、信管家止损止盈的设置由本软件在用户本机实现，如遇网络断开或软件关闭则不会触发。</p>
                    <p>3、如亏损大于风险保证额度，则按保证金额度计算，用户无需承担保证金外的风险，若持
                        仓风险度过高，请您做好仓位控制。</p>
                    <p>4、期货业务办理时间为工作日08:30——16:00，商品期货账户结算办理请在15:30之前申请。</p>
                    <p>5、账户资金充足的情况下可以交易其他外盘品种</p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--main2 end-->

    <div id="xeditor_content">
        <div class="xc-left fl">
            <img src="<?=Url::base()?>/frontend/web/img/fp-tx.png"/>
        </div>
        <div class="xc-right fl">
            <h1>HX****</h1>
            <h2>操盘金额:3.70万</h2>
            <h2>申请时间:2017-07-21 08:40</h2>
        </div>
        <div class="clear"></div>
    </div>

    <script>
        //    $(function(){
        //        $(".namc-left-top li").click(function(){
        //            $(this).addClass("curr").siblings().removeClass("curr");
        //            $('.namc-left-son').hide().eq($(this).index()).show();
        //            $('.namc-right-son').hide().eq($(this).index()).show();
        //        })
        //    });

        $(function(){
            $(".namc-right-son-li li").click(function(){
//            var price31 = 500;
                var price32 = 2000;
                var price33 = 1500;
                $(this).addClass("active").siblings().removeClass("active");
                var snum=$(this).find('.snum').text();
                var bnum=parseInt($(".namc-right-son-li2-left .num").val());
                var tprice31=snum*bnum;
                var tprice32=snum*bnum+price32;
                var tprice33=snum*bnum+price33;
                $(".price31").text(tprice31+'.00');
                $(".price32").text(tprice32+'.00');
                $(".price33").text(tprice33+'.00');
            });

            $(".namc-right-son-li2-right li").click(function(){
                $(this).addClass("active").siblings().removeClass("active");
                var bail=$(this).text();
                var bnum=$(".namc-right-son-li2-left .num");
                bnum.val(bail);
            });

            $(".add").click(function(){
                var praise_txt = $(".num");
                var bnum = parseInt(praise_txt.val());
                bnum+=1000;
                praise_txt.val(bnum);
            });

            $(".desc").click(function(){
                var praise_txt = $(".num");
                var bnum = parseInt(praise_txt.val());
                bnum-=1000;
                if(bnum<1000){
                    bnum=1000;
                }
                praise_txt.val(bnum);
            });
        });

        $(function(){
            $(".namc-btn label").click(function(){
                if($(this).hasClass('on')){
                    $(this).removeClass('on');
                }else{
                    $(this).addClass('on');
                }
            })
        });
    </script>


<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>