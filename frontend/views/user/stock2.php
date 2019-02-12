<?php
use yii\helpers\Url;

?>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/lrtk.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/chaogu.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/shares.css" rel="stylesheet"/>
<style>
    .tab_conts div {
        width: 100% !important;
    }

    .tab_conts div canvas {
    }
</style>

<div class="clearborth"></div>

<div class="chaogu_part2">
    <div class="nw1000" style="position: relative; width: 1000px;">
        <div class="notice">
            <div class="text">
                <span>最新公告</span>

                    <span>
                        除非黄土白骨，我守你百岁无忧
                    </span>

            </div>
            <!-- <div class="button_more"><a href="newslist/announce.html">更多</a></div> -->
        </div>
        <div class="tingpai" style="position: absolute; left: 900px;"><a href="javascript:"
                                                                         onclick="openUrl();">禁买黑名单</a></div>
    </div>
</div>
<div class="nbody">
    <div class="nw1000" style="width: 1000px;">
        <div class="cgleft">
            <div class="nleftmenu">
                <div class="subtitle">我的实盘</div>
                <div class="subNavBox" id="stockNavBox" style="border-right: 0;">
                    <ul class="navContent1" style="display: block;">
                        <li class="sp_1"><a href="javascript:" id="btnBuy">买&nbsp;&nbsp;入</a></li>
                        <li class="sp_2"><a href="javascript:" id="BtnApply" onclick="apply_list();">撤&nbsp;&nbsp;单</a>
                        </li>
                        <!-- <li class="sp_3"><a href="javascript:" id="sales" onclick="ChangeSale()">卖&nbsp;&nbsp;出</a></li> -->
                        <li class="sp_5"><a href="javascript:" id="btnStock" onclick="stock_list(1);">股票持仓</a></li>
                        <li class="sp_6"><a href="javascript:" id="btn_apply_today"
                                            onclick="apply_list_today();">当日委托</a></li>
                        <li class="sp_7"><a href="javascript:" onclick="deal_today();">当日成交</a></li>
                        <li class="sp_6"><a href="javascript:" onclick="ApplyHistoryData(0);">历史委托</a></li>
                        <li class="sp_7"><a href="javascript:" onclick="DealHistoryData(0);">历史成交</a></li>
                        <li class="sp_8"><a href="javascript:" id="btnMoney" onclick="MoneyData(0)">资金流水</a></li>
                        <li class="sp_9" style="display: none;"><a href="javascript:" onclick="InterestData(0)">平仓记录</a>
                        </li>
                        <li class="sp_9"><a href="javascript:" onclick="stock_hisData(0)">平仓记录</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="cgright">
            <!------顶部内容------->
            <div class="top">
                <div class="zichan">
                    <table width="510" border="0" cellpadding="0" cellspacing="0" class="tb_money">
                        <tr>
                            <td width="65" align="right">动态资产<img
                                    src="<?= Url::base() ?>/frontend/web/xnn/images/help.png" width="14"
                                    onclick="openTips(3);"/></td>
                            <td width="104" class="num money_asset">0.00</td>
                            <td width="60" align="right">可用资金<img
                                    src="<?= Url::base() ?>/frontend/web/xnn/images/help.png" width="14"
                                    onclick="openTips(1);"/></td>
                            <td width="104" class="num money_able"><?= $member->money ?></td>
                            <td width="60" align="right">冻结资金<img
                                    src="<?= Url::base() ?>/frontend/web/xnn/images/help.png" width="14"
                                    onclick="openTips(2);"/></td>
                            <td class="num money_lock">0.00</td>
                        </tr>
                        <tr>
                            <td align="right">实盘可买<img src="<?= Url::base() ?>/frontend/web/xnn/images/help.png"
                                                       width="14" onclick="openTips(4);"/></td>
                            <td class="num money_can_buy">0.00</td>
                            <td align="right">证券市值</td>
                            <td class="num money_cap">0.00</td>
                            <td align="right">持仓盈亏</td>
                            <td class="num money_profit">0.00</td>
                        </tr>
                    </table>
                    <input id="money_yue" type="hidden" value="0"/>
                    <input id="money_cash_lock" type="hidden" value="0"/>
                    <input id="money_today_yq" type="hidden" value="0"/>
                    <input id="money_stock_yk" type="hidden" value="0"/>
                </div>
                <div class="zijin">
                    <img src="<?= Url::base() ?>/frontend/web/xnn/images/yes.png" id="worn_green"
                         title="绿灯表示可用资金充足，负数为多余资金，每天14：52系统会把多余资金转换成可用余额">
                    <img src="<?= Url::base() ?>/frontend/web/xnn/images/no.png" id="worn_red"
                         title="红灯表示可用资金不够延期所需费用，需要充值；否则系统在14：50时会强平股票" class="hide"
                         style="display: none;">

                    <p>
                        延期总费用 <b class="money_extended_all" id="ycfy">0 元</b><br/>
                        <b style="font-weight: normal" id="ycfykt">此刻保证金充足，请注意盘中变化！</b>
                    </p>
                </div>
                <div class="button_more shuaxin"><a href="javascript:" onclick="money_all()">手动刷新</a></div>
            </div>

            <!--买入-->
            <div class="sec sec1 tabcon">
                <div class="secleft">
                    <div class="top">
                        <table width="520" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="35">昨收:</td>
                                <td width="48" class="y_close">0</td>
                                <td width="35">今开:</td>
                                <td width="48" class="t_open">0</td>
                                <td width="35">最高:</td>
                                <td width="48" class="t_max">0</td>
                                <td width="35">最低:</td>
                                <td width="48" class="t_min">0</td>
                                <td width="50">涨停价:</td>
                                <td width="48" class="upstop">0</td>
                                <td width="50">跌停价:</td>
                                <td width="48" class="downstop">0</td>
                                <td width="58" class="open_detail"
                                    style="color: #ff5a55;font-size: 12px;cursor: pointer;">查看详情
                                </td>
                            </tr>
                        </table>
                    </div>
                   <!-- <div class="details" style="display: none;">-->
                        <div>
                            <h1 class="clearfix shares-name">
                                <div class="stock">
                                    <p><?= $onestock->name ?></p>
                                    <em><?php if ($onestock['cid'] == 118) { ?>
                                            sh<?= $onestock->code ?>
                                        <?php } else { ?>
                                            sz<?= $onestock->code ?>
                                        <?php } ?>
                                    </em>
                                </div>
                                <div>
                                    <div id="new_price"><i></i></div>
                                    <span id="pro_closing_price"><em></em></span><span id="fluctuation"><em></em></span>
                                </div>


                            </h1>
                        </div>


                        <!--tab切换-->
                        <div class="tab_box" style="margin-top: 10%;width: 100%;">

                            <ul class="tab_nav clearfix">
                                <li class="on fenshi">分时</li>
                                <li class="rik">日K</li>
                                <li class="5K">5分</li>
                                <li class="15K">15分</li>
                                <li class="30K">30分</li>
                                <li class="60K">60分</li>
                            </ul>

                            <div>
                                <div class="clearfix tab_conts" id="mpc_son_img" style="width: 100%;height: 250px;">
                                </div>
                            </div>


                        </div>
                        <!--tab切换 end-->

                        <!---->

                        <div class="klmc_list">
                            <ul class="shares_market">
                                <li class="clearfix">
                                    <div class="name"><span>股票：</span><em></em></div>
                                    <div class="quote_2"><span>今开：</span><em class="green"></em></div>
                                    <div class="quote_1"><span>最高：</span><em class="green"></em></div>
                                </li>
                                <li class="clearfix">
                                    <div class="code"><span>代码：</span><em></em></div>
                                    <div class="quote_5"><span>昨收：</span><em></em></div>
                                    <div class="quote_4"><span>最低：</span><em class="red"></em></div>
                                </li>
                                <li class="clearfix">
                                    <div class="buy_hands"><span>买量：</span><em></em></div>
                                    <div class="market_buy"><span>涨跌%：</span><em class="green"></em></div>
                                    <div class="quote_3"><span>成交量：</span><em></em></div>

                                </li>
                                <li class="clearfix">
                                    <div class="sale_hands"><span>卖量：</span><em></em></div>
                                    <div class="fluctuation"><span>振幅：</span><em></em></div>
                                    <div class="quote_6"><span>成交额：</span><em></em></div>

                                </li>
                            </ul>


                        </div>
                    <!--</div>-->
                    <div class="maimai">
                        <form>
                            <dl>
                                <span>证券代码：</span>
                                <dd id="search" style="position: relative;">
                                    <div style="height: 2.05em;">
                                        <input type="text" class="text ui-autocomplete-input" id="stock_code"
                                               name="stock_code" value="<?= $onestock->code ?>" autocomplete="off"/>
                                    </div>
                                    <ul style="display: none;" id="keyup_d" class="sokeyup">
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <span>证券名称：</span>
                                <dd><b class="text_blue stock_name"><?= $onestock->name ?></b></dd>
                            </dl>
                            <dl>
                                <span>当前价格：</span>
                                <dd><b class="text_red price_now">0.00</b></dd>
                            </dl>
                            <dl>
                                <span>委托价格：</span>
                                <dd>
                                    <a class="jian" href="javascript:" onclick="reducePrice();">-</a>
                                    <input class="text wtpr" id="decl_price" name="decl_price" type="text"
                                           maxprice="100" minprice="0"/>
                                    <a class="jia" href="javascript:" onclick="addPrice();">+</a>
                                    <a href="javascript:" id="sjmr2" onclick="sjmr()" class="sj bgred">市价买入</a>
                                </dd>
                            </dl>
                            <dl>
                                <span>最大可买：</span>
                                <dd><b class="text_red can_quantity"></b></dd>
                            </dl>
                            <dl>
                                <span>买入数量：</span>
                                <dd>
                                    <a class="jian" href="javascript:" onclick="reduceNum();">-</a>
                                    <input class="text wtpr" id="decl_num" name="decl_num" type="text"
                                           maxprice="10000000" minprice="0"/>
                                    <a class="jia" href="javascript:" onclick="addNum();">+</a>
                                    <a href="javascript:" id="sjmr3" class="sj bgred">全部买入</a>
                                </dd>
                            </dl>

                            <dl>
                                <span>&nbsp;</span>
                                <dd style="height: auto;">
                                    <input class="but sbut" type="button" value="提 交" onclick="return buy();"
                                           id="stock_buy"/>

                                    <p style="text-align: center; display: none;"><a href="/fengkong.aspx"
                                                                                     target="_blank"
                                                                                     style="color: #64b2c9;">查看风控规则</a>
                                    </p>
                                </dd>
                            </dl>
                            <dl>
                                <span>&nbsp;</span>
                                <dd>委买单30分钟无成交自动撤单！</dd>
                            </dl>
                        </form>
                    </div>
                    <!-- <div class="wu">
                        <div class="top"><span class="text_green stock_code"></span><span class="stock_name"></span>
                        </div>
                        <dl><span>卖⑤</span> <span class="dd text_red sale5_p"
                                                  onclick="choosePriceBuy(this);">0.00</span> <i class="sale5_g">0</i>
                        </dl>
                        <dl><span>卖④</span> <span class="dd text_red sale4_p"
                                                  onclick="choosePriceBuy(this);">0.00</span> <i class="sale4_g">0</i>
                        </dl>
                        <dl><span>卖③</span> <span class="dd text_red sale3_p"
                                                  onclick="choosePriceBuy(this);">0.00</span> <i class="sale3_g">0</i>
                        </dl>
                        <dl><span>卖②</span> <span class="dd text_red sale2_p"
                                                  onclick="choosePriceBuy(this);">0.00</span> <i class="sale2_g">0</i>
                        </dl>
                        <dl><span>卖①</span> <span class="dd text_red sale1_p"
                                                  onclick="choosePriceBuy(this);">0.00</span> <i class="sale1_g">0</i>
                        </dl>
                        <div class="line"></div>
                        <dl><span>买①</span> <span class="dd text_red buy1_p" onclick="choosePriceBuy(this);">0.00</span>
                            <i class="buy1_g">0</i></dl>
                        <dl><span>买②</span> <span class="dd text_red buy2_p" onclick="choosePriceBuy(this);">0.00</span>
                            <i class="buy2_g">0</i></dl>
                        <dl><span>买③</span> <span class="dd text_red buy3_p" onclick="choosePriceBuy(this);">0.00</span>
                            <i class="buy3_g">0</i></dl>
                        <dl><span>买④</span> <span class="dd text_red buy4_p" onclick="choosePriceBuy(this);">0.00</span>
                            <i class="buy4_g">0</i></dl>
                        <dl><span>买⑤</span> <span class="dd text_red buy5_p" onclick="choosePriceBuy(this);">0.00</span>
                            <i class="buy5_g">0</i></dl>
                    </div> -->
                </div>
                <div class="secright">
                    <div class=" maichu mairu">
                        <div class="top">自选股票池</div>
                        <table id="tbCQBuy" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                            <tr class="table_top">
                                <!-- <td height="40" style="color: #444">选择</td> -->
                                <td style="color: #444">证券代码</td>
                                <td style="color: #444">证券名称</td>
                                <td style="color: #444">现价</td>
                                <td style="color: #444">涨幅</td>
                                <td style="color: #444">操作</td>
                            </tr>
                            <tbody id="stock_pool_list">
                            </tbody>
                        </table>
                        <div class="page">
                            <div id="pager_stock_pool" class="flickr" style="display: none;"></div>
                        </div>
                        <div class="zixuan">
                            <form>
                                <dl>
                                    <span>证券代码：</span>
                                    <dd>
                                        <input class="text" name="" type="text" id="txtMySelfCode"
                                               onkeyup="GetMySelfStockinfo(this.value)"/></dd>
                                </dl>
                                <dl>
                                    <span>证券名称：</span>
                                    <dd>
                                        <input class="name" name="" type="text" id="txtMySelfName"/></dd>
                                </dl>
                                <dl>
                                    <span>&nbsp;</span>
                                    <dd>
                                        <input class="but sbut" type="button" value="添 加" onclick="AddMySelfStock()"
                                               id="btnSaveSelfStock"/></dd>
                                </dl>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearborth"></div>
            </div>

            <!--撤单-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="tbCX" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40px" style="color: #444">证券代码</td>
                            <td style="color: #444">名称</td>
                            <td style="color: #444">方向</td>
                            <td style="color: #444">委托时间</td>
                            <td style="color: #444">委托价格</td>
                            <td style="color: #444">委托数量</td>
                            <td style="color: #444">成交数量</td>
                            <td style="color: #444">成交价格</td>
                            <td style="color: #444">状态</td>
                            <td style="color: #444">操作</td>
                        </tr>
                        <tbody id="apply_list">
                        </tbody>
                    </table>
                </div>
            </div>

            <!--卖出-->
            <!-- <div class="sec1 tabcon" id="ChangeSale" style="display: block;">
                <iframe src="<?= Url::toRoute('user/sale') ?>"></iframe>
            </div> -->

            <!--持仓-->
            <div class="sec sec1 tabcon tab_staock">
                <div class="maichu chicang">
                    <table id="tbSL" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40" style="color: #444">证券代码</td>
                            <td style="color: #444">名称</td>
                            <td style="color: #444">持有数量</td>
                            <td style="color: #444">可用数量</td>
                            <td style="color: #444">持仓均价</td>
                            <td style="color: #444">当前价格</td>
                            <td style="color: #444">当前市值</td>
                            <td style="color: #444">止损价格</td>
                            <td style="color: #444">盈亏比例</td>

                            <td style="color: #444">持仓盈亏</td>
                            <td style="color: #444">操作</td>
                        </tr>
                        <tbody id="stock_list">
                        </tbody>
                    </table>
                </div>
            </div>

            <!--当日委托-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="tbQC" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40px" style="color: #444">证券代码</td>
                            <td style="color: #444">名称</td>
                            <td style="color: #444">方向</td>
                            <td style="color: #444">委托时间</td>
                            <td style="color: #444">委托价格</td>
                            <td style="color: #444">委托数量</td>
                            <td style="color: #444">成交数量</td>
                            <td style="color: #444">成交价格</td>
                            <td style="color: #444">合同号</td>
                            <td style="color: #444">状态</td>
                            <td style="color: #444">操作</td>
                        </tr>
                        <tbody id="apply_list_today">
                        </tbody>
                    </table>
                </div>
            </div>

            <!--当日成交-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="tbQCgroup" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40" style="color: #444">证券代码</td>
                            <td style="color: #444">名称</td>
                            <td style="color: #444">方向</td>
                            <td style="color: #444">成交时间</td>
                            <td style="color: #444">成交价格</td>
                            <td style="color: #444">成交数量</td>
                            <td style="color: #444">成交金额</td>
                        </tr>
                        <tbody id="deal_today">
                        </tbody>
                    </table>
                </div>
                <div class="cg_db">
                    <div class="page" id="pageQCgroup" style="display: none;">
                    </div>
                </div>
            </div>

            <!--历史委托-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="tbWT" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40" style="color: #444">证券代码</td>
                            <td style="color: #444">名称</td>
                            <td style="color: #444">方向</td>
                            <td style="color: #444">委托时间</td>
                            <td style="color: #444">委托价格</td>
                            <td style="color: #444">委托数量</td>
                            <td style="color: #444">成交数量</td>
                            <td style="color: #444">成交价格</td>
                            <td style="color: #444">合同编号</td>
                            <td style="color: #444">状态</td>
                        </tr>
                        <tbody id="apply_list_history">
                        </tbody>
                    </table>
                    <div class="page">
                        <div id="pager_apply_history" class="flickr" style="display: none;"></div>
                    </div>
                </div>
            </div>

            <!--历史成交-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="tbCJ" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40" style="color: #444">证券代码</td>
                            <td style="color: #444">名称</td>
                            <td style="color: #444">方向</td>
                            <td style="color: #444">成交时间</td>
                            <td style="color: #444">成交价格</td>
                            <td style="color: #444">成交数量</td>
                            <td style="color: #444">成交金额</td>
                        </tr>
                        <tbody id="deal_history">
                        </tbody>
                    </table>
                    <div class="page">
                        <div id="pager_deal_history" class="flickr" style="display: none;"></div>
                    </div>
                </div>
            </div>

            <!--资金流水-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="tbLSCJ" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40" style="color: #444; width: 45px;">流水号</td>
                            <td style="color: #444; width: 80px;">发生时间</td>
                            <td style="color: #444">发生前金额</td>
                            <td style="color: #444">发生金额</td>
                            <td style="color: #444">综合手续费</td>
                            <td style="color: #444">发生后余额</td>
                            <td style="color: #444; width: 200px;">备注</td>
                            <td style="color: #444; width: 60px;">证券代码</td>
                            <td style="color: #444; width: 60px;">证券名称</td>
                        </tr>
                        <tbody id="money_list">
                        </tbody>
                    </table>
                    <div class="page">
                        <div id="pager_money" class="flickr" style="display: none;"></div>
                    </div>
                </div>
            </div>

            <!--交割记录-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="tPCJL" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40" style="color: #444">股票代码</td>
                            <td style="color: #444">股票名称</td>
                            <td style="color: #444">卖出时间</td>
                            <td style="color: #444">成本价格</td>
                            <td style="color: #444">买入成本</td>
                            <td style="color: #444">卖出价格</td>
                            <td style="color: #444">卖出数量</td>
                            <td style="color: #444">卖出收入</td>
                            <td style="color: #444">结算盈亏</td>
                        </tr>
                        <tbody id="interest_list">
                        </tbody>
                    </table>
                    <div class="cg_db">
                        <div class="leiji">累计盈亏：<strong id="txtprofit_price" class="text_red">0.00</strong></div>
                        <div class="page">
                            <div id="pager_interest" class="flickr" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--平仓结算-->
            <div class="sec sec1 tabcon">
                <div class="maichu chicang">
                    <table id="Table1" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                        <tr class="table_top">
                            <td height="40" style="color: #444">股票代码</td>
                            <td style="color: #444">股票名称</td>
                            <td style="color: #444">买入数量</td>
                            <td style="color: #444">买入均价</td>
                            <td style="color: #444">买入成本</td>
                            <td style="color: #444">卖出数量</td>
                            <td style="color: #444">卖出均价</td>
                            <td style="color: #444">卖出收入</td>
                            <td style="color: #444">结算盈亏</td>
                        </tr>
                        <tbody id="stock_his_list">
                        </tbody>
                    </table>
                    <div class="cg_db">

                        <div class="page">
                            <div id="pager_stock_his" class="flickr" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<input id="stock_code_val" type="hidden" value=""/>
<input id="money_balance" type="hidden" value="0"/>
<input id="stock_pool_count" type="hidden" value="1"/>
<input id="apply_history_count" type="hidden" value="0"/>
<input id="deal_history_count" type="hidden" value="0"/>
<input id="money_count" type="hidden" value="0"/>
<input id="interest_count" type="hidden" value="0"/>
<input id="talent_count" type="hidden" value="0"/>
<input id="stock_his_count" type="hidden" value="0"/>

<div class="clearborth"></div>
<!--foot-kefu-->
<div class="foot-kefu" style="display: none;">
    <div class="main f-clear">
        <div class="fl foot-kefu-tit">
            <strong>客服中心</strong>

            <p>service</p>
        </div>

    </div>
</div>
<!-- foot -->

<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/layout.js"></script>

<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/layer-v1.8.5/layer/layer.min.js"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/stock.js?v=201712281640"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/follow.js?v=201712281640"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/search.js?v=201712281640"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/pagination.js?v=201712281640"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/pager.js"></script>
<script type="text/javascript">
    $(function () {
        $("#stock").addClass("now");
        $("#btnBuy").addClass("ada");
        keypress();
        money_all();//资金统计
        StockPoolData(0);//自选股池

    });
    $(function () {

        $(".tab_nav li").click(function () {
            $(this).addClass("on").siblings().removeClass("on");
            var li_con = $(this).text();
            switch (li_con) {
                case "分时":
                    $(".tab_conts").show();
                    $(".tab_conts").siblings().hide();
                    console.log(minute_data_list)
                    fenshi(minute_data_list);
                    break;
                case "日K":
                    $(".tab_conts_day_k").show();
                    $(".tab_conts_day_k").siblings().hide();
                    getdayMinK();
                    break;
                case "5分":
                    $(".tab_conts_minte5_k").show();
                    $(".tab_conts_minte5_k").siblings().hide();
                    get5MinK();
                    break;
                case "15分":
                    $(".tab_conts_minte15_k").show();
                    $(".tab_conts_minte15_k").siblings().hide();
                    get15MinK();
                    break;
                case "30分":
                    $(".tab_conts_minte30_k").show();
                    $(".tab_conts_minte30_k").siblings().hide();
                    get30MinK();
                    break;
                case "60分":
                    $(".tab_conts_minte60_k").show();
                    $(".tab_conts_minte60_k").siblings().hide();
                    get60MinK();
                    break;
            }

        });

    })

    $('.open_detail').click(function () {
        $(this).text($('.details').is(":hidden") ? "收起详情" : "查看详情");
        $('.details').slideToggle();
    });

    $('#sjmr2').click(function () {
        var xianjia = $('.price_now').text();
        $('#decl_price').val(xianjia);
    })
    $('#sjmr3').click(function () {
        var num = $('.can_quantity').text();
        $('#decl_num').val(num);
    })


</script>
<script src="http://web.eiaihe.cn/skin/js/echarts.min.js"></script>
<script src="<?= Url::base() ?>/backend/web/dist/js/echarts.js"></script>
<script type="text/javascript" src="http://hq.sinajs.cn/?list=sz300736" charset="utf-8"></script>
<script type="text/javascript"
        src="http://vip.stock.finance.sina.com.cn/quotes_service/view/vML_DataList.php?asc=j&symbol=sz300736&num=500"
        charset="utf-8"></script>
<script>
    function getMarket() {
        var code = $('.stock em').html();
        // console.log(code);
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/?user=lision&&pwd=c113a045bb7169e9012ccbada264be40&show=json',
            type: "POST",
            async: true,
            data: {list: code},
            dataType: "json",
            error: function () {
                setTimeout('getMarket()', 1000);
            },
            success: function (data) {
                // console.log(data);
                var money = '<?=$member->money?>';
                var market = data.data;
                for (var i = 0; i < market.length; i++) {
                    $('#new_price').val(market[i].new_price > 0 ? market[i].new_price : '--');
                    $('#pro_closing_price').val(market[i].settlement_yesterday > 0 ? market[i].settlement_yesterday : '--');
                    $('#fluctuation').val(market[i].new_price > 0 ? market[i].frice_fluctuation + '%' : '--');
                    $('#new_price').html(market[i].new_price > 0 ? market[i].new_price : '--');
                    $('.y_close').text(market[i].settlement_yesterday > 0 ? market[i].settlement_yesterday : '--');
                    $('.t_open').text(market[i].opening_price > 0 ? market[i].opening_price : '--');
                    $('.t_max').text(market[i].highest_price > 0 ? market[i].highest_price : '--');//最高
                    $('.t_min').text(market[i].minimum_price > 0 ? market[i].minimum_price : '--');//最低
                    $('#decl_price').val(market[i].new_price > 0 ? market[i].new_price : '--');//现价
                    $('.price_now').html(market[i].new_price > 0 ? market[i].new_price : '--');//现价
                    $('.now_price').html(market[i].new_price > 0 ? market[i].new_price : '--');//现价
                    $('.quote_6 em').text(market[i].turnover > 0 ? market[i].turnover : '--');//成交额
                    $('.quote_5 em').text(market[i].settlement_yesterday > 0 ? market[i].settlement_yesterday : '--');//昨收
                    $('.quote_4 em').text(market[i].minimum_price > 0 ? market[i].minimum_price : '--');//最低
                    $('.quote_3 em').text(market[i].volume > 0 ? market[i].volume : '--');//成交量
                    $('.quote_2 em').text(market[i].opening_price > 0 ? market[i].opening_price : '--');//今开
                    $('.quote_1 em').text(market[i].highest_price > 0 ? market[i].highest_price : '--');//最高
                    $('.market_buy em').text(market[i].new_price > 0 ? market[i].frice_fluctuation + '%' : '--');//涨跌
                    $('.buy_hands em').text(market[i].buy_hands > 0 ? market[i].buy_hands : '--');//买量
                    $('.sale_hands em').text(market[i].sale_hands > 0 ? market[i].sale_hands : '--');//卖量
                    $('.fluctuation em').text(market[i].new_price > 0 ? market[i].fluctuation : '--');//振幅
                    $('.stock p').text(market[i].name);//股票名称
                    $('.name em').text(market[i].name);//股票名称
                    $('.code em').text(market[i].code);//股票代码
                    $('.stock em').text(market[i].code);//股票代码
                    $('.can_quantity').text(parseInt((money * 8 * (1 - 0.48 / 100) / market[i].new_price) / 100) * 100);//最大可买数
                    $('#decl_num').val(parseInt((money * 8 * (1 - 0.48 / 100) / market[i].new_price) / 100) * 100);//最大可买数


                    if (market[i].frice_fluctuation < 0) {
                        $('#new_price').css({'color': '#0CBD70'});
                        //$('.mpc_son_pankou ul li span').css({'color': '#0CBD70'});
                        $('.mpc_son_price').css({'color': '#0CBD70'});
                        $('.market_buy').css({'color': '#0CBD70'});
                        $('.market_sale').css({'color': '#0CBD70'});
                        //$('#'+code+' .change i').css({'background':'#238859','color':'#ffffff'});

                    } else {
                        $('#new_price').css({'color': '#e22626'});
                        //$('.mpc_son_pankou ul li span').css({'color': '#e22626'});
                        $('.mpc_son_price ').css({'color': '#e22626'});
                        $('.market_buy').css({'color': '#e22626'});
                        $('.market_sale').css({'color': '#e22626'});
                        //$('#'+code+' .change i').css({'background': '#dc5538','color':'#ffffff'});
                    }
                }
                setTimeout('getMarket()', 10000);
            }
        });
    }


    function getdayMinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/Dayline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: '<?=$onestock->code?>'},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                var alldata = result.result;
//alldata.reverse();

                var myChart = echarts.init(document.getElementById('mpc_son_img'));

                var rawData = [];

                for (var i = 0; i < alldata.length; i++) {
                    rawData[i] = alldata[i].split(',');
                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[2], +item[3], +item[4]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['日K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';

                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    markLine: {
                        symbol: ['none', 'none'],
                        data: [
                            [
                                {
                                    name: 'from lowest to highest',
                                    type: 'min',
                                    valueDim: 'lowest',
                                    symbol: 'circle',
                                    symbolSize: 10,
                                    label: {
                                        normal: {show: false},
                                        emphasis: {show: false}
                                    }
                                },
                                {
                                    type: 'max',
                                    valueDim: 'highest',
                                    symbol: 'circle',
                                    symbolSize: 10,
                                    label: {
                                        normal: {show: false},
                                        emphasis: {show: false}
                                    }
                                }
                            ],
                            {
                                name: 'min line on close',
                                type: 'min',
                                valueDim: 'close'
                            },
                            {
                                name: 'max line on close',
                                type: 'max',
                                valueDim: 'close'
                            }
                        ]
                    },
                    grid: {
                        bottom: 60
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 0,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 0,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '日K',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }

                    ]
                };
                myChart.hideLoading();
                myChart.clear();
                myChart.setOption(option);
            }
        });
    }

    function get5MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "POST",
            async: true,
            data: {list: '<?=$onestock->code?>'},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];
                for (var i = 0; i < alldata.length; i++) {
                    rawData[i] = alldata[i].split(',');
                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {
                            var res = '<div><p>时间：' + params[0].name + '</p></div>';
                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    grid: {
                        bottom: 80
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 80,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 80,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }

                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);
            }
        });
    }

    function get15MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: '<?=$onestock->code?>'},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                console.log(result);
                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];

                for (var i = 0; i < alldata.length; i++) {
                    if (i % 3 == 0) {
                        rawData[i / 3] = alldata[i].split(',');
                    }

                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    grid: {
                        bottom: 60
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 60,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 60,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }
                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);

            }
        });
    }

    function get30MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: '<?=$onestock->code?>'},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {


                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];

                for (var i = 0; i < alldata.length; i++) {
                    if (i % 6 == 0) {
                        rawData[i / 6] = alldata[i].split(',');
                    }

                }


                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    grid: {
                        bottom: 60
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 0,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 0,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }
                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);

            }
        });
    }

    function get60MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: '<?=$onestock->code?>'},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];
                for (var i = 0; i < alldata.length; i++) {
                    if (i % 12 == 0) {
                        rawData[i / 12] = alldata[i].split(',');
                    }
                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: '#333'}
                        }
                    },
                    grid: {
                        bottom: 60
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 0,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 0,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }

                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);
            }
        });
    }
    minute_data_list.reverse();

    function fenshi(data) {
        var dates = data.map(function (item) {
            return item[0];
        });

        var data = data.map(function (item) {
            return item[1];
        });
        var myChart = echarts.init(document.getElementById('mpc_son_img'));
        option = {
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            title: {
                show: false,
                left: 'center',
                text: '行情分时图',
            },
            toolbox: {
                show: false,
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    restore: {},
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                data: dates,
                axisLine: {lineStyle: {color: '#000'}},
                axisLabel: {
                    textStyle: {color: '#333'}
                }

            },
            yAxis: {
                scale: true,
                axisLine: {lineStyle: {color: '#000'}},
                splitLine: {
                    show: false,
                    lineStyle: {
                        type: 'dotted',
                        color: '#FF0000',
                        width: 0.5
                    }
                },
                axisLabel: {
                    textStyle: {color: '#333'}
                }


            },
            // dataZoom: [{
            //      show: false,
            //      type: 'inside',
            //      start: 0,
            //      end: 100,
            //      dataBackgroundColor: '#eee'
            //  }, {
            //      start: 0,
            //      end:0,
            //      // handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
            //      // handleSize: '90%',
            //      handleStyle: {
            //          borderColor: "#cacaca",
            //          borderWidth: "0.8",
            //          shadowBlur: 2,
            //          background: "#ddd",
            //          shadowColor: "#ddd"
            //      }
            //  }],
            series: [
                {
                    name: '分时价格',
                    type: 'line',
                    smooth: true,
                    symbol: 'none',
                    sampling: 'average',
                    itemStyle: {
                        normal: {
                            color: '#3a89e4',
                            lineStyle: {
                                width: 1.4
                            },
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: 'rgba(80,141,255,0.39)'
                            }, {
                                offset: 1,
                                color: '#ccdefec7'
                            }])
                        }
                    },
                    data: data
                }
            ]
        };
        myChart.clear();
        myChart.setOption(option);
    }
    ;
    $(function () {
        getMarket();
        fenshi(minute_data_list);
    });
</script>
<div class="kefu">
    <ul>

        <li class="l3" style="display: none;">
            <a href="javascript:;"></a>

            <div class="hide3">
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><span>客服一</span><br/><i></i></a><a
                    href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes"
                    target="_blank"><span>qq交流群</span><br/><i></i></a>
            </div>
        </li>
        <li class="l4"><a href="#page1" id="scrollTop"></a></li>
    </ul>
</div>
</body>
</html>
