<?php
use yii\helpers\Url;

?>
<link href="<?=Url::base()?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/lrtk.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/chaogu.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>

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
            <div class="button_more"><a href="newslist/announce.html">更多</a></div>
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
                        <li class="sp_3"><a href="javascript:" id="sales" onclick="ChangeSale()">卖&nbsp;&nbsp;出</a></li>
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
                            <td width="65" align="right">动态资产<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(3);"/></td>
                            <td width="104" class="num money_asset">0.00</td>
                            <td width="60" align="right">可用资金<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(1);"/></td>
                            <td width="104" class="num money_able">0.00</td>
                            <td width="60" align="right">冻结资金<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(2);"/></td>
                            <td class="num money_lock">0.00</td>
                        </tr>
                        <tr>
                            <td align="right">实盘可买<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14" onclick="openTips(4);"/></td>
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
                    <img src="<?=Url::base()?>/frontend/web/xnn/images/yes.png" id="worn_green" title="绿灯表示可用资金充足，负数为多余资金，每天14：52系统会把多余资金转换成可用余额">
                    <img src="<?=Url::base()?>/frontend/web/xnn/images/no.png" id="worn_red" title="红灯表示可用资金不够延期所需费用，需要充值；否则系统在14：50时会强平股票" class="hide"
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
                            </tr>
                        </table>
                    </div>
                    <div class="maimai">
                        <form id="form1" method="post">
                            <dl>
                                <span>证券代码：</span>
                                <dd id="search" style="position: relative;">
                                    <div style="height: 2.05em;">
                                        <input type="text" class="text ui-autocomplete-input" id="stock_code"
                                               name="stock_code" onkeyup="keyup(event)" autocomplete="off"/>
                                    </div>
                                    <ul style="display: none;" id="keyup_d" class="sokeyup">
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <span>证券名称：</span>
                                <dd><b class="text_blue stock_name"></b><a href="javascript:" class="Refbuy"
                                                                           onclick="Refbuy()">刷新</a></dd>
                            </dl>
                            <dl>
                                <span>当前价格：</span>
                                <dd><b class="text_red price_now">0.00</b></dd>
                            </dl>
                            <dl>
                                <span>委托价格：</span>
                                <dd>
                                    <a class="jian" href="javascript:" onclick="reducePrice();">-</a>
                                    <input class="text wtpr" id="decl_price" name="decl_price" type="text" maxprice="0"
                                           minprice="0" onblur="uptPrice();"/>
                                    <a class="jia" href="javascript:" onclick="addPrice();">+</a>
                                    <a href="javascript:" onclick="sjmr();" class="sj bgred">市价买入</a>
                                </dd>
                            </dl>
                            <dl>
                                <span>最大可买：</span>
                                <dd><b class="text_red can_quantity"></b></dd>
                            </dl>
                            <dl>
                                <span>买入数量：</span>
                                <dd>
                                    <input class="text" id="decl_num" name="decl_num" onblur="onlynum();" type="text"/>
                                </dd>
                            </dl>
                            <dl>
                                <label>
                                    <input type="radio" name="fenshu" value="radio" onclick="percentnum(1)"/>
                                    全部</label>
                                <label>
                                    <input type="radio" name="fenshu" value="radio" onclick="percentnum(2)"/>
                                    1/2</label>
                                <label>
                                    <input type="radio" name="fenshu" value="radio" onclick="percentnum(3)"/>
                                    1/3</label>
                                <label>
                                    <input type="radio" name="fenshu" value="radio" onclick="percentnum(4)"/>
                                    1/4</label>
                                <label>
                                    <input type="radio" name="fenshu" value="radio" onclick="percentnum(5)"/>
                                    1/5</label>
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
                    <div class="wu">
                        <div class="top"><span class="text_green stock_code"></span><span class="stock_name"></span>
                        </div>
                        <!--5档-->
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
                    </div>
                </div>
                <div class="secright">
                    <div class=" maichu mairu">
                        <div class="top">自选股票池</div>
                        <table id="tbCQBuy" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                            <tr class="table_top">
                                <td height="40" style="color: #444">选择</td>
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
            <div class="sec1 tabcon" id="ChangeSale" style="display: block;">
                <iframe src="sale.html"></iframe>
            </div>

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

<script src="<?=Url::base()?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layout.js"></script>

<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layer-v1.8.5/layer/layer.min.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/stock.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/follow.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/search.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pagination.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pager.js"></script>
<script type="text/javascript">
    $(function () {
        $("#stock").addClass("now");
        keypress();
        money_all();//资金统计
        StockPoolData(0);//自选股池

    });
    var stock_refresh = function () {

        if ($("#btnBuy").hasClass("currentDt")) {
            refresh();
        }
        if ($("#btnStock").hasClass("ada")) {
            stock_list(1);
        }
        if ($("#BtnApply").hasClass("currentDt")) {
            apply_list();
        }
    }
    var stock_refresh2 = function () {

        if ($("#btn_apply_today").hasClass("ada")) {
            apply_list_today();
        }
    }
    var openTips = function (typeid) {
        switch (typeid) {
            case 1:
                var money_able = $(".money_able").html(), money_yue = $("#money_yue").val(), money_lock = $(".money_lock").html();
                layer.alert("可用资金(" + money_able + ") = 余额(" + money_yue + ") - 冻结资金(" + money_lock + ")<br/><span style='color:red;'>请保持可用资金大于延期总费用,14:50分结算</span>", 4);
                break;
            case 2:
                var money_lock = $(".money_lock").html(), money_cash_lock = $("#money_cash_lock").val(),
                    money_today_yq = $("#money_today_yq").val(), money_stock_yk = $("#money_stock_yk").val();
                layer.alert("冻结资金(" + money_lock + ") ＝ 已提现未付金额(" + money_cash_lock + ")", 4);//+ 当日延期总费用金额(" + money_today_yq + ") + 持仓亏损到本金金额(" + money_stock_yk + ")
                break;
            case 3:
                layer.alert("动态资产 ＝ 可用资金 + 保证金 + 手续费 + 盈亏额 + 冻结资金", 4);//+ 当日延期总费用金额(" + money_today_yq + ") + 持仓亏损到本金金额(" + money_stock_yk + ")
                break;
            case 4:
                layer.alert("实盘最大可买额限制为1000万", 4);
                break;
            default:
                break;
        }
    }
    var openUrl = function () {
        $.layer({
            type: 2,
            shadeClose: true,
            title: false,
            closeBtn: [0, false],
            shade: [0.8, '#000'],
            border: [0],
            area: ['460px', '430px'],
            iframe: {src: 'dialog/blacklist.html'}
        });
    }
    var openUrlStockMoney = function (id) {
        $.layer({
            type: 2,
            shadeClose: true,
            title: false,
            closeBtn: [0, false],
            shade: [0.8, '#000'],
            border: [0],
            area: ['900px', '380px'],
            iframe: {src: 'dialog/moneylist.aspx?id=' + id}
        });
    }
    var search = function (stock_code) {
        $("#stock_code").val(stock_code);
        $.ajax({
            url: "tools/opt_ajax.ashx?act=sina_api&code=" + stock_code + "&t=" + new Date(),
            dataType: "text",
            type: "GET",
            timeout: 6000,
            success: function (data) {
                var api = data.split(',');
                if (api.length > 30) {
                    if (api[33] == "1") {
                        layer.alert("亲，该票禁止买入哟！", 5);
                    } else {
                        var yprice = api[2], money_now = $("#money_balance").val(), decl_price = Number(api[3]).toFixed(2),
                            quantity = parseInt(api[34]), q_100 = 0, forbid = parseInt(api[33]), forbidprice = parseFloat("2000");//昨日收盘价,账户当前总额,当前价格,是否禁止买入状态及价格
                        if (quantity > 0) {
                            var q = quantity % 100, q_100 = quantity - q;//可买数量是否是100的倍数，不是则去最接近的
                        }
                        if (decl_price <= 0) {
                            decl_price = yprice;
                        }
                        $(".stock_code").html(stock_code);//股票代码
                        $(".stock_name").html(api[0]);//股票名字
                        $(".y_close").html(Number(yprice).toFixed(2));//昨收
                        $(".t_open").html(Number(api[1]).toFixed(2));//今开
                        $(".t_max").html(Number(api[4]).toFixed(2));//今日最高价
                        $(".t_min").html(Number(api[5]).toFixed(2));//今日最低价
                        $(".upstop").html(Number(yprice * 1.1).toFixed(2));//涨停
                        $(".downstop").html(Number(yprice * 0.9).toFixed(2));//跌停
                        $(".price_now").html(decl_price);//当前价
                        $("#decl_price").val(decl_price);
                        $("#decl_price").attr("maxprice", Number(yprice * 1.1).toFixed(2));//涨停
                        $("#decl_price").attr("minprice", Number(yprice * 0.9).toFixed(2));//跌停
                        $(".sale5_p").html(Number(api[29]).toFixed(2));//“卖五”报价
                        $(".sale5_g").html(parseInt(parseFloat(api[28]) / 100));//“卖五”申请4695股，即X手；
                        $(".sale4_p").html(Number(api[27]).toFixed(2));
                        $(".sale4_g").html(parseInt(parseFloat(api[26]) / 100));
                        $(".sale3_p").html(Number(api[25]).toFixed(2));
                        $(".sale3_g").html(parseInt(parseFloat(api[24]) / 100));
                        $(".sale2_p").html(Number(api[23]).toFixed(2));
                        $(".sale2_g").html(parseInt(parseFloat(api[22]) / 100));
                        $(".sale1_p").html(Number(api[21]).toFixed(2));
                        $(".sale1_g").html(parseInt(parseFloat(api[20]) / 100));
                        $(".buy1_p").html(Number(api[11]).toFixed(2));//“买五”报价
                        $(".buy1_g").html(parseInt(parseFloat(api[10]) / 100));//“买五”申请4695股，即X手；
                        $(".buy2_p").html(Number(api[13]).toFixed(2));
                        $(".buy2_g").html(parseInt(parseFloat(api[12]) / 100));
                        $(".buy3_p").html(Number(api[15]).toFixed(2));
                        $(".buy3_g").html(parseInt(parseFloat(api[14]) / 100));
                        $(".buy4_p").html(Number(api[17]).toFixed(2));
                        $(".buy4_g").html(parseInt(parseFloat(api[16]) / 100));
                        $(".buy5_p").html(Number(api[19]).toFixed(2));
                        $(".buy5_g").html(parseInt(parseFloat(api[18]) / 100));
                        $(".can_quantity").html(q_100);
                        $("#decl_num").val("");
                        $("#stock_buy").css("background", "#ff5a55");
                        if (forbid == 1) {
                            $("#stock_buy").css("background", "#ddd");
                        }
                        if (decl_price > forbidprice) {
                            $("#stock_buy").css("background", "#ddd");
                        }
                    }
                }
                else {
                    layer.alert("没有查询到相关数据！", 8);
                }
            }
        });
    }
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
