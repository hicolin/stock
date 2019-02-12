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
                        <form >
                            <dl>
                                <span>证券代码：</span>
                                <dd id="search" style="position: relative;">
                                    <div style="height: 2.05em;">
                                        <input type="text" class="text ui-autocomplete-input" id="stock_code"
                                               name="stock_code" value="<?=$onestock->code?>" autocomplete="off"/>
                                    </div>
                                    <ul style="display: none;" id="keyup_d" class="sokeyup">
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <span>证券名称：</span>
                                <dd><b class="text_blue stock_name"><?=$onestock->name?></b></dd>
                            </dl>
                            <dl>
                                <span>当前价格：</span>
                                <dd><b class="text_red price_now">0.00</b></dd>
                            </dl>
                            <dl>
                                <span>委托价格：</span>
                                <dd>
                                    <a class="jian" href="javascript:" onclick="reducePrice();">-</a>
                                    <input class="text wtpr" id="decl_price" name="decl_price" type="text" maxprice="100" minprice="0" />
                                    <a class="jia" href="javascript:" onclick="addPrice();">+</a>
                                    <a href="javascript:"  id="sjmr2" onclick="sjmr()" class="sj bgred">市价买入</a>
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
                                    <input class="text wtpr" id="decl_num" name="decl_num" type="text" maxprice="10000000" minprice="0" />
                                    <a class="jia" href="javascript:" onclick="addNum();">+</a>
                                    <a href="javascript:"  id="sjmr3"  class="sj bgred">全部买入</a>
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