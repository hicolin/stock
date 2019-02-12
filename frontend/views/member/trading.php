<?php
use yii\helpers\Url;
?>

    <link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<!--    <link rel="stylesheet" type="text/css" href="--><?//=Url::base()?><!--/frontend/web/zqcss/withdrawal.css">-->
<!--    <link rel="stylesheet" type="text/css" href="--><?//=Url::base()?><!--/frontend/web/zqcss/recharge.css">-->
<!--    <link rel="stylesheet" type="text/css" href="--><?//=Url::base()?><!--/frontend/web/zqcss/main(1).css">-->
<!--    <link href="--><?//=Url::base()?><!--/frontend/web/tradcss/base.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="--><?//=Url::base()?><!--/frontend/web/tradcss/global_2.0.css" rel="stylesheet" type="text/css" />-->

<!--    <link href="--><?//=Url::base()?><!--/frontend/web/tradcss/tip-yellowsimple.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="--><?//=Url::base()?><!--/frontend/web/tradcss/system.css" rel="stylesheet" type="text/css" />-->
    <link href="<?=Url::base()?>/frontend/web/tradcss/global_3.0.css" rel="stylesheet" type="text/css" />
<link href="<?=Url::base()?>/frontend/web/tradcss/my.css" rel="stylesheet" type="text/css" />
<!--<link href="--><?//=Url::base()?><!--/frontend/web/zqcss/global.css" rel="stylesheet" type="text/css">-->
    <link href="<?=Url::base()?>/frontend/web/tradcss/newpage.css" rel="stylesheet" type="text/css" />
    <script src="<?=Url::base()?>/frontend/web/js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="<?=Url::base()?>/frontend/web/js/cfw.min.js" type="text/javascript"></script>
    <script src="<?=Url::base()?>/frontend/web/js/cfw.user.min.js" type="text/javascript"></script>
    <script src="<?=Url::base()?>/frontend/web/js/jquery.pagination.js" type="text/javascript"></script>



<div class="sidebar">
    <a class="sidedar_top" href=""></a>
    <a class="sidedar_center" href=""></a>
    <p class="sidedar_bottom" id="toTop"></p>
</div>
<script>
    $(window).scroll(function() {
        var x = $(window).scrollTop();
        if(x > 500) {
            $('.sidedar_bottom').fadeIn();
        } else {
            $('.sidedar_bottom').fadeOut();
        }

    })

    $('.sidedar_bottom').click(function() {
        $('html,body').animate({
            'scrollTop': 0
        }, 500);
    })
</script>

<!--[if IE 7]>
<div class="ie_bar">
    您现在使用的浏览器版本过低，可能会导致部分图片和信息的缺失，建议您安装360极速浏览器或升级到IE8以上版本<a href="http://down.360safe.com/cse/360cse_8.1.0.428.exe" target="_blank">下载并安装360极速浏览器</a>
</div>
<![endif]-->





<!--bannerEND-->
<div class="user_bg_box wal">
    <div class="con w1200 over ">
        <!--左导航END-->
        <!-- left -->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!-- left end -->
        <div class="user_right_box">

            <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/tradcss/fuaccount.css" />

            <!--个人中心右边-->

            <div class="user_new_right">
                <div class="user_right_hd">
                    <div class="inspann" style="width:915px; position:relative;">
                        <li>
                            <a title="关于国内期货二交易软件更新通知" href="<?=Url::toRoute(['news/detail','id'=>$noticeOne->id])?>">更新通知:<?=$noticeOne->title?></a><span style="margin-left:20px;"><?=date('Y-m-d H:i',$noticeOne->addtime)?></span><a href="<?=Url::toRoute(['news/list','cid'=>11])?>" class="a02" style="margin-left:60px;"> 更多&gt;&gt;</a></li>
                        <li>
                            <a title="通知" href="">通知</a><span style="margin-left:45px;">2018-03-07</span></li>
                        <ul style="margin-left:30px;"></ul>

                    </div>

                </div>
                <div class="user_content">
                    <input type="hidden" value="250718" id="userId" />

                    <!--我的账户-->
                    <div class="my_zhanghu">
                        <div class="zhanghu_money">
									<span class="money_left">
                    可用余额：<span>￥<?=$money?><span style="font-size: 12px;">元</span></span>
									</span>
                            <dl>
                                <dd class="dd01">
                                    <a href="<?=Url::toRoute(['member/recharge'])?>">账户充值</a>
                                </dd>
                                <dd class="dd03">
                                    <a href="<?=Url::toRoute(['member/withdraw'])?>">提现</a>
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <!--期货账户-->
                    <div class="qihuo_account">
                        <div class="left_wrap">

                            <div class="left" style="border-right:none;">
                                <h3><span>国内期货交易账号</span>：<?=$user_name?></h3>
                                <h3 style="background:none"><span>        初始密码</span>：<?=$user_pwd?></h3>
                                <h4>总资产：</h4>
                                <h2>¥<?=$balance?></h2>
                                <p class="bttn">
                                    <a href="javascript:;" onclick="Charg(1, 19332 ,1.0000 ,51208695)" style="background:#4064C7;color:#fff;">入金</a>
                                    <a href="javascript:;" onclick="Withdraw(1, 0.00, 1.0000, 19332, 51208695)">出金</a>
                                    <a href="javascript:;" onclick="TradeInfo(1,19332, 51208695)">资金明细</a>
                                </p>
                                <h5>
                                    <a href="<?=Url::toRoute(['news/help','cid'=>24])?>" target="_blank">国内期货产品介绍>></a>
                                    <a href="<?=Url::toRoute(['news/help','cid'=>25])?>" target="_blank">风险说明书>></a>
                                </h5>
                                <h5>
                                    <a href="<?=Url::toRoute(['news/help','cid'=>26])?>" target="_blank">交易品种/交易规则>></a>
                                    <a href="<?=Url::toRoute(['news/help','cid'=>27])?>" target="_blank">平仓线计算>></a>
                                </h5>
                            </div>

                        </div>

                    </div>

                    <div class="qihuo_news">
                        <dl>
                            <dt>特别说明：</dt>
                            <dd> 1、持仓手数限制：国内期货单个品种合约单次开仓不得超过30手，单个品种合约持仓量不得超过100手；</dd>
                            <dd> 2、休市期间，交易服务器关闭，资金显示为0，不影响交易账户数据。</dd>
                            <dd>3、申请期货账号15天内未进行任何操作，平台有权回收交易账号；</dd>
                            <dd>4、如委托价过低导致长时间挂单未成交，平台有权根据实际情况选择将委托单撤掉；</dd>
                            <dd>5、交易期货主力合约，即市场持仓量最大合约；</dd>
                            <dd>6、您需在交易时段结束前自行平仓，如未平仓，我们有权进行强平将无法保证您的盈亏，具体成交价以结算单为准；</dd>
                            <dd>7、博易大师交易软件<span>止损止盈的设置由本软件在用户本机实现，如遇网络断开、软件关闭、电脑关机或待机状态下则不会触发；</span></dd>
                            <dd>8、若持仓风险度过高或持仓量过大，请您做好仓位控制，及时追加资金；</dd>
                            <dd>9、账户资金充足的情况下可以交易其他品种；</dd>
                            <dd>10、<span>【内盘】</span>强平时间为：每周五14:55（中金所品种15:12）即可持周一至周五，遇节假日实时调整。持仓过夜的条件，合约隔夜占用保证金不超过权益的0.25倍，否则平台有权将全部或者部分强平，国内商品在14：55分进行仓位调整（国债过夜调整仓位时间为15:12）。</dd>
                            <dd>11、<span>【内盘】</span>主力合约条件,合约总持仓量大于2w手，否则无法开仓。</dd>
                        </dl>

                    </div>

                </div>
            </div>
        </div>



        <!--------------------流水明细------------------------------->
        <div class="gray_global" style="display: none;"></div>
        <div class="trade_list tWindow" style="display: none;">
            <p class="title">资产明细 — <i id="p_TradeInfoTitle">国内期货账户<?=$user_name?></i><span class="CloseSpan">×</span></p>
            <div class="content">
                <table class="tableul">
                    <thead>
                    <tr>
                        <th>日期</th>
                        <th>时间</th>
                        <th>类型</th>
                        <th>金额(￥)</th>

                    </tr>
                    </thead>
                    <tbody id="li_liushui">
                    <?php foreach ($deposit as $k => $val) { ?>
                    <tr>
                        <th><?=date('Y-m-d',$val['time'])?></th>
                        <th><?=date('H:i:s',$val['time'])?></th>
                        <th><?=$val['type'] == 1 ?'入金': '出金'?></th>
                        <th><?=$val['money']?></th>

                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="pagemany">
                    <div style="position: relative; text-align:center; zoom:1;width:100%" id="pagepa"></div>
                </div>
            </div>
        </div>
        <!--------------------------流水明细结束----------------->
        <!----------------弹窗=====入金--------------------------->
        <div class="window_money_in tWindow" style="display: none;">
            <p class="title">入金<span class="CloseSpan">×</span></p>
            <div class="content">
                <div class="licon">
                    <span class="lconleft" id="ChargTitle">国内期货账户</span>
                    <div class="lconright">
                        <span class="firstl" id="Charg_Account"><?=$user_name?></span>
                        <input id="hdID" type="hidden" value="19332">
                    </div>
                </div>
                <div class="licon">
                    <span class="lconleft">可入余额</span>
                    <div class="lconright">
                        <span class="firstl rjje"><?=$money?></span> 元
                        <a class="scor blue" onclick="Allrujin()">全额入金</a>
                        资金不足，<a href="<?=Url::toRoute(['member/recharge'])?>" class="blue02">立即充值</a>
                    </div>
                </div>
                <div class="licon">
                    <span class="lconleft">入金金额</span>
                    <div class="lconright">
                        <div class="inputdiv">
                            <input type="text" class="hitboom" id="num_Rujin" value="0" onchange="ChangeUSA(1)" style="vertical-align: top">
                            <span id="sp_MoneyType" style="color:#070707">元</span>
                        </div>

                    </div>
                </div>
                <div class="licon">
                    <span class="lconleft">资金密码</span>
                    <div class="lconright">
                        <div class="inputdiv">
                            <input type="password" id="txt_rjPwd">

                        </div>
                        <a href="<?=Url::toRoute(['member/security'])?>" class="blue">忘记密码</a>

                    </div>
                </div>

                <div class="licon querli">
                    <span class="lconleft"></span>
                    <div class="lconright">
                        <div class="inputdiv divquer">
                            <button class="quer" onclick="InsertMoney()" id="btnInsertMoney">确认入金</button>
                        </div>
                    </div>
                </div>


                <div class="info" id="gnChargInfo" style="">
                    <p>入金说明：</p>
                    <p>
                        1、内盘期货入金时间限定：交易日8：30-16:00；20:30-次日2:30（以系统服务器开放时间为准）；
                    </p>
                    <p>
                        2、请使用储蓄卡进行充值，并确认您的银行卡开通了网上银行业务；
                    </p>
                    <p>3、如需帮助，可拨打客服热线：0791-88287228。</p>
                </div>


                <div class="info" style="display: none;" id="gjChargInfo">
                    <p>入金说明：</p>
                    <p>
                        1、外盘入金时间限定：交易日【冬令时】7：00-次日6：00，【夏令时】6：00-次日5：00（以系统服务器开放时间为准）；
                    </p>
                    <p>
                        2、外盘期货账户，出入金为美元（固定汇率7.2，1美元=7.2人民币）；
                    </p>
                    <p>3、请使用储蓄卡进行充值，并确认您的银行卡开通了网上银行业务；</p>
                    <p>4、如需帮助，可拨打客服热线：0791-88287228。</p>
                </div>

            </div>
        </div>


        <!--出金详情-->
        <div class="window_money_out tWindow" style="display: none;">
            <p class="title">出金<span class="CloseSpan">×</span></p>
            <div class="content">
                <div class="licon">
                    <span class="lconleft" id="WithdrawTitle">国内期货账户</span>
                    <div class="lconright">
                        <span class="firstl" id="Withdraw_Account"><?=$user_name?></span>
                    </div>
                </div>
                <div class="licon">
                    <span class="lconleft">可出金</span>
                    <div class="lconright">
                        <input id="hd_draw" type="hidden" value="<?=$money?>">
                        <span class="firstl" id="sp_draw"><?=$money?></span>
                        <a class="scor blue" onclick="Allrujin_cj()" >全额出金</a>
                    </div>
                </div>
                <div class="licon">
                    <span class="lconleft">出金金额</span>
                    <div class="lconright">
                        <div class="inputdiv">
                            <input type="text" class="hitboom" id="num_Rujin_cj"  onchange="ChangeUSA()" style="vertical-align: top">
                            <span id="sp_MoneyType_CJ" style="color:#070707">元</span>
                        </div>


                    </div>
                </div>


                <div class="licon" id="divDraw" style="display:none;">
                    <span class="lconleft">提现银行卡</span>
                    <div class="lconright">
                        <input type="hidden" id="cardNo" name="cardNo" value="CARD114169">
                        <span class="name">建设银行</span>
                        <span class="bancknumber">**** **** **** 6066</span>

                    </div>
                </div>

                <div class="licon">
                    <span class="lconleft">资金密码</span>
                    <div class="lconright">
                        <div class="inputdiv">
                            <input type="password" id="txt_cjPwd" style="width:170px;">

                        </div>
                        <a href="<?=Url::toRoute(['member/security'])?>" class="blue">忘记密码</a>
                    </div>
                </div>

                <div class="licon querli">
                    <span class="lconleft"></span>
                    <div class="lconright">
                        <div class="inputdiv divquer">
                            <button class="quer" onclick="OutMoney()" id="btndraw">确认出金</button>
                        </div>
                    </div>
                </div>


                <div class="info" id="gnDrawInfo" style="">
                    <p>出金说明：</p>
                    <p>
                        1、内盘账户出金时间限定：交易日8:30-16:00；20:30-次日2:30（以系统服务器开放时间为准）；
                    </p>
                    <p>
                        2、账户出金前请确保交易账户无持仓状态；
                    </p>

                    <p>3、出金金额将转入平台账户余额，可随时提现；</p>
                    <p>4、如需帮助，可拨打客服热线：0791-88287228。</p>
                </div>


                <div class="info" style="display: none;" id="gjDrawInfo">
                    <p>出金说明：</p>
                    <p>
                        1、外盘账户出金时间限定：交易日【冬令时】7：00-次日6：00，【夏令时】6：00-次日5：00（以系统服务器开放时间为准）；
                    </p>
                    <p>
                        2、账户出金前请确保交易账户无持仓状态；
                    </p>
                    <p>3、外盘期货账户，出入金为美元（固定汇率7.2，1美元=7.2人民币）；</p>

                    <p>3、出金金额将转入平台账户余额，可随时提现；</p>
                    <p>5、如需帮助，可拨打客服热线：4008-076-086。</p>
                </div>

            </div>
        </div>
        <script type="text/javascript">
            //出金
            function Withdraw(type, org_risk_money, exchange_rate, id, stock_account) {
                $(".gray_global").show();
                $(".window_money_out").show();
                if (type == 1) {
                    var orgRiskMoney = (org_risk_money > 0) ? org_risk_money : 0;
                    var exchargeRate = (exchange_rate > 0) ? exchange_rate : 1;
                    var hdId = (id > 0) ? id : 0;
                    var stockAccount = (stock_account !== null ) ? stock_account : "";
                    // $("#sp_draw").text(orgRiskMoney+ "元");
                    // $("#hd_draw").val(orgRiskMoney);
                    $("#hd_Rate").val(exchargeRate);
                    $("#hd_Rate_CJ").val(exchargeRate);
                    $("#hdID").val(hdId)
                    $("#WithdrawTitle").text("国内期货账户");
                    // $("#Withdraw_Account").text(stock_account);
                    $("#sp_RateRmb_CJ").attr("style", "display:none;");
                    $("#sp_MoneyType_CJ").text("元");
                    $("#gnDrawInfo").show();
                    $("#gjDrawInfo").hide();
                } else {
                    var orgRiskMoney = (org_risk_money > 0) ? org_risk_money : 0;
                    var exchargeRate = (exchange_rate > 0) ? exchange_rate : 7;
                    var exchargeRateCJ = (exchange_rate > 0) ? exchange_rate : 1;
                    var hdId = (id > 0) ? id : 0;
                    var stockAccount = (stock_account !== null ) ? stock_account : "";
                    $("#sp_draw").text(orgRiskMoney + "美元");
                    $("#hd_draw").val(orgRiskMoney);
                    $("#hd_Rate").val(exchargeRate);
                    $("#hd_Rate_CJ").val(exchargeRateCJ);
                    $("#hdID").val(hdId)
                    $("#WithdrawTitle").text("国际期货账户");
                    // $("#Withdraw_Account").text(stockAccount);
                    $("#sp_RateRmb_CJ").attr("style", "display:block;");
                    $("#sp_MoneyType_CJ").text("美元");
                    $("#gnDrawInfo").hide();
                    $("#gjDrawInfo").show();
                }
            }
            //确认出金
            function OutMoney() {

                var money = $("#num_Rujin_cj").val();
                var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
                if (!reg.test(money)) {
                    CFW.dialog.alert("请输入正确的金额", 0, null);
                    return false;
                }
                $("#btndraw").removeAttr("onclick");
                $.ajax({
                    url: "<?=Url::toRoute(['member/zg-recharge'])?>",
                    data: { money: money, type: 2, payPwd: $("#txt_cjPwd").val() },
                    type: "post",
                    dataType: "json",
                    success: function (r) {
                        if(r.status == 100){
                            layer.msg(r.msg, {time: 2000}, function () {
                                location.reload();
                            });
                        }else{
                            layer.msg(r.msg, {time: 2000});
                        }

                    }
                });
            }

            //入金
            function Charg(type, id ,rate ,account) {
                $(".gray_global").show();
                $(".window_money_in").show();
                if (type == 1) {
                    var hdrate = (rate > 0) ? hdrate : 1;
                    var hdid = (id > 0) ? id : 0;
                    var chargAccount = (account !== null ) ? account : "";
                    $("#hd_Rate").val(hdrate);
                    $("#hdID").val(hdid);
                    $("#ChargTitle").text("国内期货账户");
                    $("#Charg_Account").text();
                    $("#sp_RateRmb").attr("style", "display:none;");
                    $("#gnChargInfo ").show();
                    $("#gjChargInfo").hide();
                }
                else {
                    var hdrate = (rate > 0) ? rate :7;
                    var hdid = (id > 0) ? id : 0;
                    var chargAccount = (account !== null ) ? account : "";
                    $("#hd_Rate").val(hdrate);
                    $("#hdID").val(hdid)
                    $("#ChargTitle").text("国际期货账户");
                    $("#Charg_Account").text();
                    $("#sp_RateRmb").attr("style", "display:block;");
                    $("#gjChargInfo ").show();
                    $("#gnChargInfo").hide();
                }
            }
            //确认入金
            function InsertMoney() {
                var money = $("#num_Rujin").val();
                var pwd = $("#txt_rjPwd").val();
                var balance = '<?=$money?>';
                if(money*1000>balance*1000){
                   layer.msg("输入的金额不可以大于当前余额");return false;
                }
                /*var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
                if (!reg.test(money)) {
                    CFW.dialog.alert("请输入正确的金额", 0, null);
                    return false;
                }*/
                if(money<0){
                    layer.msg("输入正确的金额");return false;
                }
                $("#btnInsertMoney").removeAttr("onclick");
                $.ajax({
                    url: "<?=Url::toRoute(['member/zg-recharge'])?>",
                    data: { money: money, type: 1, payPwd: $("#txt_rjPwd").val() },
                    type: "post",
                    dataType: "json",
                    success: function (r) {
                        if(r.status == 100){
                            layer.msg(r.msg, {time: 2000}, function () {
                                location.reload();
                            });
                        }else{
                            layer.msg(r.msg, {time: 2000});
                        }

                    }
                });
            }

            //交易流水
            function TradeInfo(type,id, stock_account) {
                $(".gray_global").show();
                $(".trade_list").show();
                var stockAccount = (stock_account !== null ) ? stock_account :"";
                // if (type == 1) {
                //     $("#p_TradeInfoTitle").html("国内期货账户"+stockAccount);
                // } else {
                //     $("#p_TradeInfoTitle").html("国际期货账户" + stockAccount);
                // }
                var total = Init(id, 1, 10);
                if (total >= 10) {
                    $("#pagepa").pagination({
                        totalData: total,			//数据总条数
                        showData: 10,			//每页显示的条数
                        callback: PageCallback,
                    });
                    function PageCallback(pagination) {
                        Init(id, pagination.getCurrent(), 10);
                    }
                } else {
                    $("#pagepa").html("");
                }
            }

            function Init(id, pageIndex, pageSize) {
                var total = 0;
                $.ajax({
                    async: false,
                    url: "/FuturesAccount/QueryInsertOrOutList",
                    data: { id: id, pageIndex: pageIndex, pageSize: pageSize },
                    type: "post",
                    dataType: "json",
                    success: function (r) {
                        if (r.IsSuccess) {
                            var shtml = "";
                            for (var i = 0; i < r.ResponseObj.length; i++) {
                                var date = parseInt(r.ResponseObj[i].create_time.replace(/\D/igm, ""));
                                var date1 = new Date(date);
                                shtml += "<tr>";
                                shtml += "<td>" + date1.toISOString().slice(0, 10) + "</td>";
                                shtml += "<td>" + date1.toTimeString().slice(0, 8) + "</td>";
                                if (r.ResponseObj[i].trade_type == 15) {
                                    shtml += "<td>出金</td>";
                                    shtml += "<td>0</td>";
                                    shtml += "<td>" + r.ResponseObj[i].money + "</td>";
                                }
                                else {
                                    shtml += "<td>入金</td>";
                                    shtml += "<td>" + r.ResponseObj[i].money + "</td>";
                                    shtml += "<td>0</td>";
                                }
                                shtml += "</tr>";
                            }
                            $("#li_liushui").html(shtml);
                            total = r.OtherResponseObj;
                        }
                    }
                });
                return total;
            }

            $(function () {
                //弹框“x”关闭
                $(".CloseSpan").on("click", function () {
                    $(".gray_global").hide();
                    $(".tWindow").hide();
                    $(".real").hide();
                    $(".window_know").hide();
                });
                $(".greengray").on("click", function () {
                    if ($(this).hasClass("graygreen")) {
                        $(this).removeClass("graygreen");
                        $("#hd_tfDraw").val(0);
                        $("#divDraw").css("display", "none")
                    } else {
                        $(this).addClass("graygreen");
                        $("#hd_tfDraw").val(1);
                        $("#divDraw").css("display", "block")
                    }
                });
                $.ajax({
                    url: "/home/GetNewsList",
                    data: { count: 8, cname: '掌期金服网站公告' },
                    type: "post",
                    dataType: "json",
                    success: function (r) {
                        var items = [];
                        var rlen = r.length;
                        for (var i = 0; i < rlen; i++) {

                            var d = r[i];
                            var t;
                            var time;
                            var item;

                            if (d.CreateDateTime) t = eval('new ' + d.CreateDateTime.substr(1, d.CreateDateTime.length - 2));

                            time = new Date(t).toISOString().slice(0, 10); //$.monthday(t);
                            item = '<li><a title="' + d.NewsTitile + '" href="/realtimenews/NoticeDetail?' + 'id='+ d.Id  + '">' + (d.NewsTitile.length > 25 ? d.NewsTitile.substring(0, 25) : d.NewsTitile) + '</a><span style=margin-left:45px;>' + time + '</span></li>';
                            items.push(item);

                        }

                        if (items.length > 0) {
                            $(".inspann").prepend(items.join('')).fadeIn();
                        } else {
                            $(".inspann").append("<li>暂无公告</li>").fadeIn();
                        }
                    },
                    complete: function () {
                    }
                });
            });

            function ChangeUSA(num) {
                var value = 0;
                var rate = 0;
                if (num == 1) {
                    value = $("#num_Rujin").val();
                    rate = $("#hd_Rate").val();
                    $("#sp_Usmoney").text(parseFloat(value / rate).toFixed(2));
                } else {
                    value = $("#num_Rujin_cj").val();
                    rate = $("#hd_Rate_CJ").val();
                    $("#sp_Usmoney_CJ").text(parseFloat(value * rate).toFixed(2));
                }
            }
            function Allrujin() {
                $("#num_Rujin").val($(".rjje").text());
                ChangeUSA(1);
            }
            function Allrujin_cj() {
                $("#num_Rujin_cj").val($("#hd_draw").val());
                ChangeUSA();
            }
            function Reload() {
                window.location.reload();
            }

            function RealName(type) {
                if ("" == "False") {
                    $(".real").show();
                    $(".gray_global").show();
                    return false;
                }
                $(".window_know").show();
                $(".gray_global").show();
                $("#btnOpenAg").attr("onclick", "isOpen(" + type + ");");
            }
            function isOpen(type) {
                window.location.href = "/FuturesAccount/RiskTest?accountType=" + type;
                return;
            }
        </script>



