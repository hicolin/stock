<?php
use yii\helpers\Url;
use common\helps\Tools;
?>
    <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/css/barrager.css"/>
    <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/js/barrager.js"/>
    <style>
        ::-webkit-scrollbar { width:3px;}
        /* 滚动槽 */
        ::-webkit-scrollbar-track { -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); border-radius: 10px;}
        /* 滚动条滑块 */
        ::-webkit-scrollbar-thumb { border-radius:10px; background: rgba(255,255,255,0.1); -webkit-box-shadow: inset 0 0 6px rgba(255,255,255,0.3);}
        ::-webkit-scrollbar-thumb:window-inactive { background: rgba(255,255,255,0.15);}
    </style>
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
                            <?php
                            foreach ($products as $list) { ?>
                                <a href="<?=Url::toRoute(['product/nation','cid'=>$cid,'id'=>$list->id])?>"><li><?=$list->title?></li></a>
                            <?php }
                            ?>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="namc-left-con">
                        <div class="namc-left-son">
                            <h2>确认操盘规则</h2>
                            <p>操盘须知：<span>美国轻质原油期货当期主力合约（不可留仓）</span></p>
                            <p>交易时间：<span>夏令时06:00-05:00，冬令时07:00-06:00</span></p>
                            <p>操盘保证金（$）：<span><i class="price31">1000.00</i></span></p>
                            <p>总操盘资金（$）：<span><i class="price32">2000.00</i></span></p>
                            <p>亏损平仓线（$）：<span><i class="price33"><?=number_format(1000+1000*$product->loss_line/100,2)?></i></span></p>
                            <p>账户管理费（$）：<span> 0.00</span></p>
                            <p>交易手续费：<span>另议</span></p>
                        </div>
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
                </div>
                <div class="clear"></div>
                <div class="namc-btn">
                    <h1><a href="javascript:;"><button id="sub_order">提交操盘申请</button></a></h1>
                    <h2>
                        <label id="agree" >我已阅读并同意</label>
                        <a target="_blank" href="<?=Url::toRoute(['/user/page','id'=>15])?>">《用户服务协议》</a>
                        <a target="_blank" href="<?=Url::toRoute(['/user/page','id'=>16])?>">《风险提示》</a>
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
                <div class="na-main2-table1">
                    <table>
                        <tr>
                            <td></td>
                            <td>用户名</td>
                            <td>操盘金额</td>
                            <td>获利百分比</td>
                            <td>盈利金额</td>
                        </tr>
                    </table>
                </div>
                <div class="na-main2-table">
                    <table>
                        <?php
                        $i=1;
                        foreach ($dummy_order as $list) {
                            ?>
                            <tr>
                                <td><img src="<?=Url::base()?>/frontend/web/images/t<?=$i?>.png"/></td>
                                <td>hojo123</td>
                                <td>3.36万</td>
                                <td><span>37.1%</span></td>
                                <td><span>30万</span></td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
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

    <script>
        /*
        * snum几手
        * bnum本金
        * */
        var tprice31 = 0;
        var tprice32 = 0;
        var tprice33 = 0;
        function price_count(snum,bnum) {
            tprice31 = bnum;
            tprice32 = snum*bnum+bnum;
            tprice33 = snum*bnum+bnum*<?=$product->loss_line?>/100;
        }

        $(function(){
            $(".namc-right-son-li li").click(function(){
//            var price31 = 500;
                $(this).addClass("active").siblings().removeClass("active");
                //几手
                var snum=$(this).find('.snum').text();
                //本金
                var bnum=parseInt($(".namc-right-son-li2-left .num").val());
                price_count(snum,bnum)
                $(".price31").text(tprice31+'.00');
                $(".price32").text(tprice32+'.00');
                $(".price33").text(tprice33+'.00');
            });

            $(".namc-right-son-li2-right li").click(function(){
                $(this).addClass("active").siblings().removeClass("active");
                var bail=$(this).text();
                var bnum=$(".namc-right-son-li2-left .num");
                var snum = parseInt($('.namc-right-son-li ul li.active i.snum').text())
                bail = parseInt(bail)
                price_count(snum,bail)
                $(".price31").text(tprice31+'.00');
                $(".price32").text(tprice32+'.00');
                $(".price33").text(tprice33+'.00');
                bnum.val(bail);
            });

            $(".add").click(function(){
                var praise_txt = $(".num");
                var snum = parseInt($('.namc-right-son-li ul li.active i.snum').text())
                var bnum = parseInt(praise_txt.val());
                bnum+=1000;
                price_count(snum,bnum)
                $(".price31").text(tprice31+'.00');
                $(".price32").text(tprice32+'.00');
                $(".price33").text(tprice33+'.00');
                praise_txt.val(bnum);
            });

            $(".desc").click(function(){
                var praise_txt = $(".num");
                var bnum = parseInt(praise_txt.val());
                bnum-=1000;
                if(bnum<1000){
                    bnum=1000;
                }
                var snum = parseInt($('.namc-right-son-li ul li.active i.snum').text())
                price_count(snum,bnum)
                $(".price31").text(tprice31+'.00');
                $(".price32").text(tprice32+'.00');
                $(".price33").text(tprice33+'.00');
                praise_txt.val(bnum);
            });

            $(".num").blur(function(){
                var praise_txt = $(".num");
                var bnum = parseInt(praise_txt.val());
                praise_txt.val(bnum);
                var snum = parseInt($('.namc-right-son-li ul li.active i.snum').text())
                price_count(snum,bnum)
                $(".price31").text(tprice31+'.00');
                $(".price32").text(tprice32+'.00');
                $(".price33").text(tprice33+'.00');
            })
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

        //提交订单
        $(function(){
            var cz = "<a target='_blank' style='color:#ceaf64;font-size:14px;' href='<?=Url::toRoute('/member/recharge')?>'>请充值</a>";
            var rz = "<a target='_blank' style='color:#ceaf64;font-size:14px;' href='<?=Url::toRoute('/member/safe')?>'>请认证</a>";
            var bd = "<a target='_blank' style='color:#ceaf64;font-size:14px;' href='<?=Url::toRoute('/member/safe')?>'>请绑定银行卡</a>";
            var tx = "<a target='_blank' style='color:#ceaf64;font-size:14px;' href='<?=Url::toRoute('/member/safe')?>'>请设置提现密码</a>";
            $('#sub_order').on('click',function(){
                var kfrx = "<?=Tools::getSetting(12);?>"
                if($('#agree').attr('class') != 'on') {
                    layer.msg('请阅读并勾选用户服务协议、风险提示')
                    return false
                }
                var snum = parseInt($('.namc-right-son-li ul li.active i.snum').text())
                var id = <?=$product->id?>;
                var praise_txt = $(".num");
                var num = parseInt(praise_txt.val());
                $.ajax({
                    type: "POST",
                    url: "<?= Url::toRoute($this->context->id . '/sub-order')?>",
                    data: {"id": id, 'num':num, 'hand':snum},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                    success: function (data) {
                        if(data==-1) {
                            layer.confirm('您还未登录！马上登录？', {
                                btn: ['确定', '取消'] //按钮
                            }, function(){
                                location.href="<?=Url::toRoute('/user/login')?>"
                            }, function(e){
                                layer.close(e);
                                return false;
                            });
                        } else if(data==800) {
                            layer.confirm('您已经提交，请在交易端进行交易吧', {
                                btn: ['确定'] //按钮
                            }, function(){
                                location.href="<?=Url::toRoute('/member/plan')?>"
                            }, function(e){
                                layer.close(e);
                                return false
                            });
                        }  else if(data==200){
                            layer.alert('账户余额为0！'+cz+'，如有疑问，请拨打客服热线：'+kfrx, {icon: 2});
                        } else if(data==300) {
                            layer.alert('账户余额为小于投资金额！'+cz+'，如有疑问，请拨打客服热线：'+kfrx, {icon: 2});
                        } else if(data==100) {
                            //短信通知
                            var templateId = "140326";
                            var tel = "<?=$onelist->tel?>";
                            var xgj_name = "<?=$onelist->xgj_name?>";
                            var xgj_pwd = "<?=$onelist->xgj_pwd?>";
                            $.ajax({
                                url  : "/ucpass/ucpass2.php",
                                type : 'post',
                                data : {'tel':tel,'templateId':templateId,'xgj_name':xgj_name,'xgj_pwd':xgj_pwd},
                                dataType:'text',
                                //beforeSend:function(){},
                            });
                            layer.confirm('您的申请操作已通过，请查收短信内的信管家账号/密码，并在官网软件下载处下载软件开始操盘吧！', {
                                btn: ['立即操盘', '下载软件'] //按钮
                            }, function(){
                                location.href="<?=Url::toRoute('/member/plan')?>"
                            }, function(e){
                                //layer.close(e);
                                location.href="<?=Url::toRoute('/file/index')?>"
                            });
                        } else if(data==400) {
                            layer.alert('提交失败,正在等待审核，如有疑问，请拨打客服热线：'+kfrx, {icon: 1});
                        } else if(data==500) {
                            layer.alert('没有实名认证!'+rz+'，如有疑问，请拨打客服热线：'+kfrx, {icon: 2});
                        } else if(data==600) {
                            layer.alert('没有绑定银行卡!'+bd+'，如有疑问，请拨打客服热线：'+kfrx, {icon: 2});
                        } else if(data==700) {
                            layer.alert('没设置提现密码'+tx+'，如有疑问，请拨打客服热线：'+kfrx, {icon: 2});
                        }
                    }
                });
            })
        })

    </script>
    <script>
        $('.namc-left-top ul a li:first').addClass('curr')
        $(function(){
            $(".namc-left-top ul a").each(function(){
                if ($(this)[0].href == String(window.location) && $(this).attr('href')!="") {
                    $('.namc-left-top ul a li:first').removeClass('curr')
                    $(this).find("li").addClass("curr").siblings().removeClass("curr");
                }
            });
        })
    </script>

<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>