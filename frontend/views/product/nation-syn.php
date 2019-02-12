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
/*                            foreach ($products as $list) { */?><!--
                                <a href="<?/*=Url::toRoute(['product/nation','cid'=>$cid,'id'=>$list->id])*/?>"><li><?/*=$list->title*/?></li></a>
                            --><?php /*}
                            */?>
                            <a href="<?=Url::toRoute(['product/nation','cid'=>5,'id'=>5])?>"><li>国际综合授信版</li></a>
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
                                        <td><b class="price11">150.00</b></td>
                                    </tr>
                                    <tr>
                                        <td>总操盘资金（$）</td>
                                        <td><b class="price12">1650.00</b></td>
                                    </tr>
                                    <tr>
                                        <td>亏损平仓线（$）</td>
                                        <td><b class="price13"><?=number_format($product->loss_line*150/100,2)?></b></td>
                                    </tr>
                                    <tr>
                                        <td>账户管理费（$）</td>
                                        <td><b>0.00</b></td>
                                    </tr>
                                    <tr>
                                        <td>交易手续费（$）</td>
                                        <td><b>另议</b></td>
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
                            <span><?=$title?></span>
                            <i class="fr">
                                <img src="<?=Url::base()?>/frontend/web/images/xxgj.png"/>
                                <em>信管家交易户</em>
                            </i>
                            <div class="clear"></div>
                        </div>
                        <div class="namcr-nav">
                            <?php
                            foreach (explode(',',$product->label) as $k=> $val) {
                                echo "<button>$val</button>";
                            }
                            if(intval($id) != 3) {

                            ?>
                            <button style="background: red;color: #fff">10倍授信资金</button>
                            <?php } ?>
                        </div>
                        <div class="namcr-con">
                            <div class="namcrc-left fl">
                                <h1>投资风险：<?=$product->risk?></h1>
                                <h2>近3个月：<span style="color:<?=substr($product->single_income,0,1)=='-'?'#69cd8e':'#bb161d'?>" ><?=$product->single_income?>%</span></h2>
                                <h3>成立时间：<?=date('Y-m-d',$product->in_time)?></h3>
                            </div>
                            <div class="namcrc-right fl">
                                <div class="fl">
                                    <h1>可操盘时间：<span><?=$product->do_time?></span></h1>
                                    <h2>最近入金单笔：<?=number_format($product->single_money)?>（$）</h2>
                                    <h3>最近单笔收益率：<i style="color:<?=substr($product->single_income,0,1)=='-'?'#69cd8e':'#bb161d'?>" ><?=$product->single_income?>%</i></h3>
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
                                    <input type="text" class="fl num" value="150">
                                    <button class="fl add">+</button>
                                    <div class="clear"></div>
                                </div>
                                <div class="namcr-bot-mid-right fl">
                                    <button id="sub_order">提交操盘申请</button>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="namcr-foot mt15">
                            <label id="agree" >我已阅读并同意</label>
                            <a target="_blank" href="<?=Url::toRoute(['/user/page','id'=>15])?>">《用户服务协议》</a> 、<a target="_blank" href="<?=Url::toRoute(['/user/page','id'=>16])?>">《风险提示》</a>
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
                <div class="nml_top">
                    <p class="m1"></p>
                    <p class="m2">用户名</p>
                    <p class="m3">操盘金额</p>
                    <p class="m4">获利百分比</p>
                    <p class="m5">盈利金额</p>
                    <div class="clear"></div>
                </div>
                <div class="nml_li">
                <div class="nml_li_con">
                    <div class="bd">
                        <div class="tempWrap" style="height: 300px;">
                            <ul class="infoList">
                            <?php
                        $i=1;
                        foreach ($dummy_order as $list) {
                            ?>
                             <li>
                                    <p class="m1"><img src="<?=Url::base()?>/frontend/web/images/t<?=$i?>.png"/></p>
                                    <p class="m2">hojo123</p>
                                    <p class="m3">3.36万</p>
                                    <p class="m4"><span>37.1%</span></p>
                                    <p class="m5"><span>30万</span></p>
                                    <div class="clear"></div>
                                </li>
                            <?php
                            $i++;
                        }
                        ?>        
                            </ul>
                        </div>
                    </div>
                </div>
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
                <script src="<?=Url::base()?>/frontend/web/js/jquery.SuperSlide.2.1.1.js"></script>
                <script type="text/javascript">
                    jQuery(".nml_li").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:10,interTime:50});
                </script>
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
            var loss_line = <?=$product->loss_line?>;
            $(".add").click(function(){
                var praise_txt = $(".num");
                //var num = parseInt(praise_txt.val());
                var num = parseInt($('.price11').html());
                num+=150;
                praise_txt.val(num);
                var price13 = $('.price13').html();
                $(".price11").text(num+'.00');
                $(".price12").text(num*11+'.00');
                $(".price13").text(parseInt(loss_line)*num/100+'.00');
            });

            $(".desc").click(function(){
                var praise_txt = $(".num");
                //var num = parseInt(praise_txt.val());
                var num = parseInt($('.price11').html());
                num-=150;

                praise_txt.val(num);
                var price13 = $('.price13').html();
                $(".price11").text(num+'.00');
                $(".price12").text(num*11+'.00');
                $(".price13").text(parseInt(loss_line)*num/100+'.00');
            });

            $(".num").blur(function(){
                var praise_txt = $(".num");
                var num = parseInt(praise_txt.val());
                praise_txt.val(num);
                $(".price11").text(num+'.00');
                $(".price12").text(num*11+'.00');
                $(".price13").text(parseInt(loss_line)*num/100+'.00');
            })
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
                var id = <?=$product->id?>;
                var praise_txt = $(".num");
                var num = parseInt(praise_txt.val());
                $.ajax({
                    type: "POST",
                    url: "<?= Url::toRoute($this->context->id . '/sub-order')?>",
                    data: {"id": id, 'num':num},
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
                            layer.confirm('您已经提交，请在下载软件到交易端进行交易吧', {
                                btn: ['下载软件'] //按钮
                            }, function(){
                                location.href="<?=Url::toRoute('/file/index')?>"
                            }, function(e){
                                layer.close(e);
                                return false
                            });
                            //layer.alert('您的申请操作已通过，请查收短信内的信管家账号/密码，并在官网软件下载处下载软件开始操盘吧！', {icon: 1});
                            //layer.msg('提交成功');
                        } else if(data==200){
                           // layer.alert('账户余额为0！'+cz+'，如有疑问，请拨打客服热线：'+kfrx, {icon: 2});
                            $('.close').click()
                            layer.confirm('账户余额为0！', {
                                btn: ['确定'] //按钮
                            }, function(){
                                window.location.href="/index.php?r=member%2Frecharge&money="+num;
                            }, function(e){
                                layer.close(e);
                                return false;
                            });
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
                                btn: ['下载软件', '取消'] //按钮
                            }, function(){
                                location.href="<?=Url::toRoute('/file/index')?>"
                            }, function(e){
                                layer.close(e);
                                //location.href="<?=Url::toRoute('/file/index')?>"
                            });
                            //layer.alert('您的申请操作已通过，请查收短信内的信管家账号/密码，并在官网软件下载处下载软件开始操盘吧！', {icon: 1});
                            //layer.msg('提交成功');
                        } else if(data==400) {
                            layer.alert('提交失败,正在等待审核，如有疑问，请拨打客服热线：'+kfrx, {icon: 2});
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