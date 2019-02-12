<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/css/style.css"/>
<?php $this->beginBlock('header'); ?>
    <!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

    <!--main2 begin-->
    <div class="na-main1">
        <div class="w1200">
            <div class="na-main1-con">
                <div class="namc-left fl">
                    <div class="namc-left-top">
                        <ul>
                            <li class="curr">国际综合自由版</li>
                            <li id="nation">国际综合传统版</li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="namc-left-con">
                        <div class="namc-left-son">
                            <h1>操盘难度</h1>
                            <div class="mdc-left-table">
                                <table>
                                    <tr>
                                        <td>操盘保证金（$）</td>
                                        <td><b class="price11">2000.00</b>美元</td>
                                    </tr>
                                    <tr>
                                        <td>总操盘资金（$）</td>
                                        <td><b class="price12">3000.00</b>美元</td>
                                    </tr>
                                    <tr>
                                        <td>亏损平仓线（$）</td>
                                        <td><b class="price13">2500.00</b>美元</td>
                                    </tr>
                                    <tr>
                                        <td>账户管理费（$）</td>
                                        <td><b>0.00</b>美元</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="namc-left-son hiddendiv">
                            <h1>操盘难度</h1>
                            <div class="mdc-left-table">
                                <table>
                                    <tr>
                                        <td>操盘保证金（$）</td>
                                        <td><b class="price11">2000.00</b>美元</td>
                                    </tr>
                                    <tr>
                                        <td>总操盘资金（$）</td>
                                        <td><b class="price12">3000.00</b>美元</td>
                                    </tr>
                                    <tr>
                                        <td>亏损平仓线（$）</td>
                                        <td><b class="price13">2500.00</b>美元</td>
                                    </tr>
                                    <tr>
                                        <td>账户管理费（$）</td>
                                        <td><b>0.00</b>美元</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="namc-mid fl">
                    <img src="<?=Url::base()?>/frontend/web/images/box-shadow.png"/>
                </div>
                <div class="namc-right fr">
                    <div class="namc-right-son">
                        <div class="namcr-top">
                            <span>国际综合自由版</span>
                            <i class="fr">
                                <img src="<?=Url::base()?>/frontend/web/images/xxgj.png"/>
                                <em>信管家交易户</em>
                            </i>
                            <div class="clear"></div>
                        </div>
                        <div class="namcr-nav">
                            <button>自由型</button>
                            <button>20余种品种</button>
                            <button>主力合约10种</button>
                        </div>
                        <div class="namcr-con">
                            <div class="namcrc-left fl">
                                <h1>投资风险：中等</h1>
                                <h2>近3个月：<span>+30.00%</span></h2>
                                <h3>成立时间：2014-01-09</h3>
                            </div>
                            <div class="namcrc-right fl">
                                <div class="fl">
                                    <h1>可操盘时间：<span>自由</span></h1>
                                    <h2>最近入金单笔：150，000（$）</h2>
                                    <h3>最近单笔收益率：<i>-2.70%</i></h3>
                                </div>
                                <img src="<?=Url::base()?>/frontend/web/images/gfrz.png" class="fl">
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="namcr-bot">
                            <h1>投资金额：</h1>
                            <div class="namcr-bot-mid">
                                <div class="namcr-bot-mid-left fl">
                                    <button class="fl desc">-</button>
                                    <input type="text" class="fl num" value="1000">
                                    <button class="fl add">+</button>
                                    <div class="clear"></div>
                                </div>
                                <div class="namcr-bot-mid-right fl">
                                    <button>提交操盘申请</button>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="namcr-foot mt15">
                            <label class="on">我已阅读并同意</label>
                            <a target="_blank" href="<?=Url::toRoute('/member/register-agree')?>">《用户服务协议》</a> 、<a target="_blank" href="<?=Url::toRoute('/member/register-agree')?>">《风险提示》</a>
                        </div>
                    </div>
                    <div class="namc-right-son hiddendiv" >
                        <div class="namcr-top">
                            <span>国际综合传统版</span>
                            <i class="fr">
                                <img src="<?=Url::base()?>/frontend/web/images/xxgj.png"/>
                                <em>信管家交易户</em>
                            </i>
                            <div class="clear"></div>
                        </div>
                        <div class="namcr-nav">
                            <button>自由型</button>
                            <button>20余种品种</button>
                            <button>主力合约10种</button>
                        </div>
                        <div class="namcr-con">
                            <div class="namcrc-left fl">
                                <h1>投资风险：中等</h1>
                                <h2>近3个月：<span>+30.00%</span></h2>
                                <h3>成立时间：2014-01-09</h3>
                            </div>
                            <div class="namcrc-right fl">
                                <div class="fl">
                                    <h1>可操盘时间：<span>自由</span></h1>
                                    <h2>最近入金单笔：150，000（$）</h2>
                                    <h3>最近单笔收益率：<i>-2.70%</i></h3>
                                </div>
                                <img src="<?=Url::base()?>/frontend/web/images/gfrz.png" class="fl">
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="namcr-bot">
                            <h1>投资金额：</h1>
                            <div class="namcr-bot-mid">
                                <div class="namcr-bot-mid-left fl">
                                    <button class="fl desc">-</button>
                                    <input type="text" class="fl num" value="1000">
                                    <button class="fl add">+</button>
                                    <div class="clear"></div>
                                </div>
                                <div class="namcr-bot-mid-right fl">
                                    <button>提交操盘申请</button>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="namcr-foot mt15">
                            <label class="on">我已阅读并同意</label>
                            <a target="_blank" href="<?=Url::toRoute('/member/register-agree')?>">《用户服务协议》</a> 、<a target="_blank" href="<?=Url::toRoute('/member/register-agree')?>">《风险提示》</a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
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
        $(function(){
            var pid = "<?=Yii::$app->request->get('pid')?>"
            if(pid == 2) {
                $('#nation').addClass("curr").siblings().removeClass("curr");
                $('.namc-left-son').hide().eq( $('#nation').index()).show();
                $('.namc-right-son').hide().eq( $('#nation').index()).show();
            }
        })

        $(function(){
            $(".namc-left-top li").click(function(){
                $(this).addClass("curr").siblings().removeClass("curr");
                $('.namc-left-son').hide().eq($(this).index()).show();
                $('.namc-right-son').hide().eq($(this).index()).show();
            })
        });

        $(function(){
            $(".add").click(function(){
                var praise_txt = $(".num");
                var num = parseInt(praise_txt.val());
                num+=1000;
                praise_txt.val(num);
                var price11=1000;
                var price12=2000;
                var price13=1500;
                $(".price11").text(num+price11+'.00');
                $(".price12").text(num+price12+'.00');
                $(".price13").text(num+price13+'.00');
            });

            $(".desc").click(function(){
                var praise_txt = $(".num");
                var num = parseInt(praise_txt.val());
                num-=1000;
                if(num<1000){
                    num=1000;
                }
                praise_txt.val(num);
                var price11=1000;
                var price12=2000;
                var price13=1500;
                $(".price11").text(num+price11+'.00');
                $(".price12").text(num+price12+'.00');
                $(".price13").text(num+price13+'.00');
            });
        });

        $(function(){
            $(".namcr-foot label").click(function(){
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