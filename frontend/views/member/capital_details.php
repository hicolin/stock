<?php
use yii\helpers\Url;
?>
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
<!-- <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/withdrawal.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/recharge.css"> -->
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/main(1).css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/details.css">
<style>
    /*.con .right li {*/
        /*line-height: 72px;*/
        /*border-bottom: 1px solid #ddd;*/
        /*margin: 0;*/
    /*}*/
    /*.con .right li .tit {*/
        /*padding-left: 0;*/
    /*}*/
</style>
<div class="wal">
    <div class="con">
        <!-- left -->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!-- left end -->

        <!-- right -->
        <div class="fr right">
            <div class="nr">
                <!-- 资产 -->
                <div class="detailed">
                    <ul>
                        <li>
                            <div class="tit">账户总资产
                                <div class="icon icon-help-s ml6" style="cursor: pointer;">
                                    <div style="display: none;" class="xin_tag">
                                        <div class="jt"></div>
                                        <div class="tag"> 账户余额 + 冻结金额</div>
                                    </div>
                                </div>
                            </div>
                            <span class="f20">78130</span>元
                        </li>
                        <li>
                            <div class="tit">配资金额
                                <div class="icon icon-help-s ml6" style="cursor: pointer;">
                                    <div style="display: none;" class="xin_tag">
                                        <div class="jt"></div>
                                        <div class="tag" style="top:-34px"> 短期配资金额 + 中期配资金额</div>
                                    </div>
                                </div>
                            </div>
                            <span class="f20">0</span>元
                        </li>
                        <li>
                            <div class="tit">风险保证金
                                <div class="icon icon-help-s ml6" style="cursor: pointer;">
                                    <div style="display: none;" class="xin_tag">
                                        <div class="jt"></div>
                                        <div class="tag" style="top:-34px"> 短期配资风险保证金 + 中期配资风险保证金</div>
                                    </div>
                                </div>
                            </div>
                            <span class="f20"></span>元
                        </li>
                        <li>
                            <div class="tit">冻结金额</div>
                            <span class="f20"></span>元
                        </li>
                        <li style="border-right:0;">
                            <div class="tit">账户余额</div>
                            <span class="f20">78130.00</span>元
                        </li>
                    </ul>
                    <span class="clear_f"></span></div>
            </div>
            <div class="qhbox">
                <div class="menu menu0">
                    <ul class="style_head">
                        <li><a href="" class="now a1">入金明细</a></li>
                       <!-- <li><a href=" ">充值提款提盈</a></li>
                        <li><a href=" ">配资明细</a></li>
                        <li><a href=" ">配资利息</a></li>
                        <li><a href=" ">推广佣金</a></li>-->
                    </ul>
                    <span class="clear_f"></span></div>
                <div class="cn style_content style_content0">
                    <div style="display:block;" class="ul">
                        <div class="detailstab" id="ajaxGetDetails1">
                            <div class="query">
                                <div class="fl"><!--本页收入1笔共2,164.5元--></div>
                                <div class="fr" style="display:none">
                                    <select onchange="getDetailsList(1,5,this.value)">
                                        <option>全部明细</option>
                                    </select>
                                    <input type="button" value="查询" class="btn">
                                </div>
                                <span class="clear_f"></span></div>
                            <div class="tab">
                                <div class="tr">
                                    <div class="th td td1">时间</div>
                                    <div class="th td td2">类型</div>
                                    <div class="th td td3">收入</div>
                                    <div class="th td td4">支出</div>
                                    <div class="th td td5">余额</div>
                                    <span class="clear_f"></span></div>
                                <div class="tr">
                                    <div class="td td1">2018-03-19 11:08:26</div>
                                    <div class="td td2">股票操盘赢管理费</div>
                                    <div class="td td3"><span class="hs">0</span>元</div>
                                    <div class="td td4"><span class="price">750</span>元</div>
                                    <div class="td td5"><span class="td6">78130.00元</span><span class="xq"><span
                                                class="xq1"></span><span class="xq2">收起</span></span></div>
                                    <span class="clear_f"></span>
                                    <div class="xqbox">详情：方案[<span class="blue">S49838</span>]支付12月2日的账户管理费4.5元</div>
                                </div>
                                <div class="tr">
                                    <div class="td td1">2018-03-19 11:08:26</div>
                                    <div class="td td2">购买股票操盘</div>
                                    <div class="td td3"><span class="hs">0</span>元</div>
                                    <div class="td td4"><span class="price">10000</span>元</div>
                                    <div class="td td5"><span class="td6">78880.00元</span><span class="xq"><span
                                                class="xq1"></span><span class="xq2">收起</span></span></div>
                                    <span class="clear_f"></span>
                                    <div class="xqbox">详情：方案[<span class="blue">S49838</span>]支付12月2日的账户管理费4.5元</div>
                                </div>
                                <div class="tr">
                                    <div class="td td1">2018-03-19 11:08:00</div>
                                    <div class="td td2">股票操盘赢管理费</div>
                                    <div class="td td3"><span class="hs">0</span>元</div>
                                    <div class="td td4"><span class="price">1120</span>元</div>
                                    <div class="td td5"><span class="td6">88880.00元</span><span class="xq"><span
                                                class="xq1"></span><span class="xq2">收起</span></span></div>
                                    <span class="clear_f"></span>
                                    <div class="xqbox">详情：方案[<span class="blue">S49838</span>]支付12月2日的账户管理费4.5元</div>
                                </div>
                                <div class="tr">
                                    <div class="td td1">2018-03-19 11:08:00</div>
                                    <div class="td td2">购买股票操盘</div>
                                    <div class="td td3"><span class="hs">0</span>元</div>
                                    <div class="td td4"><span class="price">10000</span>元</div>
                                    <div class="td td5"><span class="td6">90000.00元</span><span class="xq"><span
                                                class="xq1"></span><span class="xq2">收起</span></span></div>
                                    <span class="clear_f"></span>
                                    <div class="xqbox">详情：方案[<span class="blue">S49838</span>]支付12月2日的账户管理费4.5元</div>
                                </div>
                                <div class="tr">
                                    <div class="td td1">2017-12-04 16:45:49</div>
                                    <div class="td td2">线下充值</div>
                                    <div class="td td3"><span class="hs">100000</span>元</div>
                                    <div class="td td4"><span class="price">0</span>元</div>
                                    <div class="td td5"><span class="td6">100000.00元</span><span class="xq"><span
                                                class="xq1"></span><span class="xq2">收起</span></span></div>
                                    <span class="clear_f"></span>
                                    <div class="xqbox">详情：方案[<span class="blue">S49838</span>]支付12月2日的账户管理费4.5元</div>
                                </div>
                                <div class="tr">
                                    <div class="td td1">2017-12-04 16:45:49</div>
                                    <div class="td td2">系统奖励</div>
                                    <div class="td td3"><span class="hs">0</span>元</div>
                                    <div class="td td4"><span class="price">0</span>元</div>
                                    <div class="td td5"><span class="td6">0.00元</span><span class="xq"><span
                                                class="xq1"></span><span class="xq2">收起</span></span></div>
                                    <span class="clear_f"></span>
                                    <div class="xqbox">详情：方案[<span class="blue">S49838</span>]支付12月2日的账户管理费4.5元</div>
                                </div>
                            </div>
                        </div>
                        <div class="clear_f"></div>
                        <div class="page" style="padding-left:20px;"><span>1/1页</span> <a href=" " class="pagePre">
                                上一页 </a><a href=" " class="current"> 1 </a> <a href=" " class="pageNext"> 下一页 </a>
                            <div class="clear_f"></div>
                        </div>
                        <div class="clear_f"></div>
                    </div>
                </div>
                <span class="clear_f"></span></div>
        </div>
        <!-- right end -->
        <div class="clear"></div>
    </div>
</div>
