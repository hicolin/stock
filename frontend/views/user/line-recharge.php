
<?php
use yii\helpers\Url;
use common\models\Common;
?>
<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/recharge.css" rel="stylesheet" />
<div class="clearborth"></div>
<div class="nbody">
    <div class="nw1000 f-clear">
        <!--member-left-->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!--end left-->
        <style type="text/css">
            #pay{color: #ff5a55;}
            #user{color: #b23843;}

        </style>
        <div class="nrightmore">
            <div class="zhsz">
                <div class="modou hongbao">
                    <ul class="modoudul">
                        <li style="display: block;"><a href="<?=Url::toRoute(['user/recharge-money'])?>" class="">快捷支付</a></li>
                        <li style="display: block;"><a href="#" class="ada">银行转账</a></li>
                        <li style="display: block;"><a href="<?=Url::toRoute(['user/sao-recharge'])?>" class="">扫码支付</a></li>
                    </ul>
                    <div class="modoudcon" id="symdc12" style="display: none;">
                        <div class="nrbox">
                            <div class="tit">选择充值银行<span style="color: red">（2小时内到账，到账后开户）</span></div>
                            <div>
                                <!--选择银行-->
                                <ul class="yhll">
                                    <li class="gdyh card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/icbc.jpg" height="48" width="146" alt="工商银行" />
                                        <span bank_icon="01020000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/abc.jpg" height="48" width="146" alt="农业银行" />
                                        <span bank_icon="01030000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/ccb.jpg" height="48" width="146" alt="建设银行" />
                                        <span bank_icon="01050000" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/boc.jpg" height="48" width="146" alt="中国银行" />
                                        <span bank_icon="01040000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/bocom.jpg" height="48" width="146" alt="交通银行" />
                                        <span bank_icon="03010000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/citic.jpg" height="48" width="146" alt="中信银行" />
                                        <span bank_icon="03020000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/ceb.jpg" height="48" width="146" alt="光大银行" />
                                        <span bank_icon="03030000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/pab.jpg" height="48" width="146" alt="平安银行" />
                                        <span bank_icon="03070000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/psbc.jpg" height="48" width="146" alt="邮政储蓄银行" />
                                        <span bank_icon="01000000" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card heli">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/shb.gif" height="48" width="146" alt="上海银行" />
                                        <span bank_icon="04012900" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/spdb.jpg" height="48" width="146" alt="浦东发展银行" />
                                        <span bank_icon="03100000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>

                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/cmb.jpg" height="48" width="146" alt="招商银行" />
                                        <span bank_icon="03080000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/cmbc.jpg" height="48" width="146" alt="民生银行" />
                                        <span bank_icon="03050000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/hxb.jpg" height="48" width="146" alt="华夏银行" />
                                        <span bank_icon="hxb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/gdb.jpg" height="48" width="146" alt="广东发展银行" />
                                        <span bank_icon="03060000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/bob.jpg" height="48" width="146" alt="北京银行" />
                                        <span bank_icon="04031000" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                </ul>
                                <span class="clear_f"></span>
                            </div>
                        </div>
                        <div class="modou_text f-clear">
                            <div class="symd czdiv">
                                <form id="form8" method="post" onsubmit="return false;" url="/tools/user_follow_ajax.ashx?act=recharge">
                                    <h5 style="display: none;">选择充值方式</h5>
                                    <div class="czjecon" style="display: none;">
                                        <div class="czjecleft">
                                            <div>
                                                <div class="qtcz">
                                                    <ul>
                                                        <li>
                                                            <input type="radio" value="1" name="pay_code" checked="checked" onclick="ck_bank(1);" />
                                                            <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/unspay.png" height="40" />
                                                        </li>
                                                        <li style="display: none;">
                                                            <input type="radio" value="2" name="pay_code" onclick="ck_bank(2);" />
                                                            <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/heli.png" height="40" />
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="czjecon">
                                        <div class="czjecleft">
                                            <dd>
                                                <font>充值金额：</font>
                                                <input class="cztxt" type="text" name="money_ll" id="money_ll" />
                                                <font>元</font>
                                            </dd>
                                            <input id="user_id" type="hidden" value="833" />
                                            <input id="bankcode_ll" type="hidden" value="01020000" />

                                            <input class="czbut" type="button" value="充值" id="Button9" onclick="return money_ll_in();" />

                                        </div>
                                        <div class="czjecright">
                                        </div>
                                    </div>
                                    <div class="czjecon">
                                        <div class="czjecleft"></div>
                                        <div class="czjecright">
                                            <h6>温馨提示</h6>
                                            <p>
                                                1、为了您的账户安全，请在充值前完善【个人信息】及【绑定银行卡】。<br />
                                                2、您的账户资金将通过第三方平台进行充值。请注意您的银行卡充值限制，以免造成不便。<br />
                                                3、禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用。<br />
                                                4、如出现充值页面打不开的情况，请换个浏览器（IE，谷歌等），或者清除DNS缓存后重试。
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- 连连认证支付 -->
                    <div class="modoudcon" id="symdc13" style="display: none;">
                        <div class="clearfix" data-title="认证支付">
                            <form id="form9" method="post" onsubmit="return false;">
                                <div class="wx_step_1">
                                    <h2 class="cz_h2">认证支付需要您<a href="name_true.html">实名认证</a>以及<a href="bind.html">绑定银行卡</a></h2>
                                    <table class="cz_two" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <th>充值金额</th>
                                            <td>
                                                <input type="text" class="txt" style="width: 300px" name="auth_ll_total" id="auth_ll_total" placeholder="账户总额最多不能超过100万" onkeyup="ck_money(this);">元<strong>*</strong><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <td>

                                                <a class="a_blue" href="bind.html">立即绑定银行卡</a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modoudcon" style="display: none;" id="symdc1">
                        <div class="nrbox">
                            <div class="tit">选择充值银行<span style="color: red">（2小时内到账）</span></div>
                            <div>
                                <!--选择银行-->
                                <ul class="yh">
                                    <li class="gdyh card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/icbc.jpg" height="48" width="146" alt="工商银行" />
                                        <span bank_icon="icbc" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/abc.jpg" height="48" width="146" alt="农业银行" />
                                        <span bank_icon="abc" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/ccb.jpg" height="48" width="146" alt="建设银行" />
                                        <span bank_icon="ccb" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/boc.jpg" height="48" width="146" alt="中国银行" />
                                        <span bank_icon="boc" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/bocom.jpg" height="48" width="146" alt="交通银行" />
                                        <span bank_icon="comm" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/cib.jpg" height="48" width="146" alt="兴业银行" />
                                        <span bank_icon="cib" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/citic.jpg" height="48" width="146" alt="中信银行" />
                                        <span bank_icon="cncb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/ceb.jpg" height="48" width="146" alt="光大银行" />
                                        <span bank_icon="ceb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/pab.jpg" height="48" width="146" alt="平安银行" />
                                        <span bank_icon="pingan" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/psbc.jpg" height="48" width="146" alt="邮政储蓄银行" />
                                        <span bank_icon="psbc" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card heli">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/shb.gif" height="48" width="146" alt="上海银行" />
                                        <span bank_icon="bosh" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/spdb.jpg" height="48" width="146" alt="浦东发展银行" />
                                        <span bank_icon="spdb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>

                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/cmb.jpg" height="48" width="146" alt="招商银行" />
                                        <span bank_icon="cmb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/cmbc.jpg" height="48" width="146" alt="民生银行" />
                                        <span bank_icon="cmbc" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/hxb.jpg" height="48" width="146" alt="华夏银行" />
                                        <span bank_icon="hxb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/gdb.jpg" height="48" width="146" alt="广东发展银行" />
                                        <span bank_icon="gdb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card heli-1" style="display: none;">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/desz.jpg" height="48" width="146" alt="深圳发展银行" />
                                        <span bank_icon="desz" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/shrcb.jpg" height="48" width="146" alt="上海农村商业银行" />
                                        <span bank_icon="shrcb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/bob.jpg" height="48" width="146" alt="北京银行" />
                                        <span bank_icon="bob" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card heli-1" style="display: none;">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/gzcb.jpg" height="48" width="146" alt="广州商业银行" />
                                        <span bank_icon="gzcb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                </ul>
                                <span class="clear_f"></span>
                            </div>
                        </div>
                        <div class="modou_text f-clear">
                            <div class="symd czdiv">
                                <form id="form4" method="post" onsubmit="return false;" url="/tools/user_follow_ajax.ashx?act=recharge">
                                    <h5>选择充值方式</h5>
                                    <div class="czjecon">
                                        <div class="czjecleft">
                                            <div>
                                                <div class="qtcz">
                                                    <ul>
                                                        <li>
                                                            <input type="radio" value="1" name="pay_code" checked="checked" onclick="ck_bank(1);" />
                                                            <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/unspay.png" height="40" />
                                                        </li>
                                                        <li style="display: none;">
                                                            <input type="radio" value="2" name="pay_code" onclick="ck_bank(2);" />
                                                            <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/heli.png" height="40" />
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="czjecon">
                                        <div class="czjecleft">
                                            <dd>
                                                <font>充值金额：</font>
                                                <input class="cztxt" type="text" name="money" id="money" />
                                                <font>元</font>
                                            </dd>
                                            <input id="bankcode" type="hidden" value="icbc" />

                                            <input class="czbut" type="button" value="充值" id="btnSubmit" onclick="return money_in();" />


                                        </div>
                                        <div class="czjecright">
                                        </div>
                                    </div>
                                    <div class="czjecon">
                                        <div class="czjecleft"></div>
                                        <div class="czjecright">
                                            <h6>温馨提示</h6>
                                            <p>
                                                1、为了您的账户安全，请在充值前完善【个人信息】及【绑定银行卡】。<br />
                                                2、您的账户资金将通过第三方平台进行充值。请注意您的银行卡充值限制，以免造成不便。<br />
                                                3、禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用。<br />
                                                4、如出现充值页面打不开的情况，请换个浏览器（IE，谷歌等），或者清除DNS缓存后重试。
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- 银行转帐 -->
                    <div class="modoudcon" style="display: block;" id="symdc2">
                        <div class="clearfix" data-title="线下充值" id="symdc1 " style="display: block;">
                            <form id="form1" method="post" onsubmit="return false;">
                                <div class="bank_step_2 ">
                                    <h2 class="cz_h2">第一步：通过网上银行、银行柜台或ATM机等转账<i>（请先手动转账成功后再进行第二步）</i></h2>
                                    <table class="cz_two" cellpadding="0" cellspacing="0">
                                        <tbody>

                                        <tr>
                                            <td width="202">
                                                <img src="<?=Common::getSysInfo(64)?>"></td>
                                            <td>银行帐号：<?=Common::getSysInfo(28)?>
                                                <br>
                                                账户名称：<?=Common::getSysInfo(29)?>
                                                <br>
                                                开户银行：<?=Common::getSysInfo(27)?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><span class="STYLE2">请使用实名认证对应姓名的银卡进行转账、汇款</span></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="bank_step_1">
                                    <h2 class="cz_h2">第二步：填写银行转账确认单<i>（转账确认单是用于财务核对具体转账单，便于及时入到您的个人中心）</i></h2>
                                    <table class="cz_two" cellpadding="0" cellspacing="0">
                                        <tbody>

                                        <tr>
                                            <th>转账金额</th>
                                            <td>
                                                <input type="text" name="total" id="total" class="txt" style="width: 170px" autocomplete="off" placeholder="请输入您的转账金额">元<strong>*</strong></td>
                                        </tr>
                                        <tr>
                                            <th>您的转账信息</th>
                                            <td>
                                                <textarea class="txt" style="width: 400px; height: 40px; line-height: 20px;" name="remark" id="remark"></textarea><strong>*</strong><br>
                                                <i>
                                                    <br>
                                                    提示：网上银行填写支付平台名称和交易号，其它填写转账银行及卡号</i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>转账凭证</th>
                                            <td>
                                                <img id="pz" src="<?=Url::base()?>/frontend/web/xnn/images/timg.jpg" onclick="upload('pz')" style="width: 100px;height: 150px"></td>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <td>
                                                <input type="button" class="a_blue" onclick="return pay_by_bank();" value="转账确认" id="Button2"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                            <div class="cz_three">
                                <div class="top">温馨提示</div>
                                <div class="bottom">
                                    关于转账到款时间说明：<br>
                                    1、工作日17点30分前转账的，承诺在资金到账后的半小时内完成充值<br>
                                    2、工作日17点30分以后转账的，承诺在第二个工作日的早上9点完成充值<br>
                                    3、非工作日转账的，承诺在下一工作日的早上9点完成充值<br>
                                    4、请使用实名认证后对应姓名的银卡进行转账<br>
                                    5、如未能及时充值，请联系客服。</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 支付宝转帐 -->
                    <div class="modoudcon" style="display: none;" id="symdc3">
                        <div class="clearfix" data-title="微信" id="Div2" style="display: block;">
                            <form id="form3" method="post" onsubmit="return false;">
                                <div class="zfb_step_1">
                                    <h2 class="cz_h2">第一步：提交您的转账信息</h2>
                                    <table class="cz_two" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>

                                            <td class="td" style="text-align: right;">您的支付宝账号：</td>
                                            <td>
                                                <input id="zfbremark" name="zfbremark" class="txt" type="text" style="width: 209px;" placeholder="请输入账号"><strong>*</strong></td>
                                        </tr>
                                        <tr>
                                            <th>转账金额</th>
                                            <td>
                                                <input type="text" class="txt" style="width: 300px" name="alipay_total" id="alipay_total" placeholder="请输入您的转账金额">元<strong>*</strong><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <td>

                                                <input type="button" class="a_blue" onclick="return zfb_step_2();" value="前往支付" id="Button4">

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="zfb_step_2" style="display: none;">
                                    <h2 class="cz_h2">第二步：通过支付宝转账（支付宝转账0手续费）</h2>
                                    <table class="cz_four" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td class="td" width="40%">收款人支付宝账号</td>
                                            <td>--</td>
                                        </tr>
                                        <tr>
                                            <td class="td" width="40%">收款人支付宝户名</td>
                                            <td>--</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">手机支付宝扫一扫，快速转账，<span style="color: #E34343">0手续费</span><br>
                                                <img src="--" width="300"><img src="<?=Url::base()?>/frontend/web/xnn/images/alipay_tips.png" width="300" />
                                            </th>
                                        </tr>

                                        <tr>

                                            <td colspan="2">
                                                        <span style="color: #E34343; font-size: 18px;">重要提示：<br>
                                                            1.为了您的权益，请您一定在此处备注填写您在金玉鼎平台的注册手机号和用户！
                                                                        <br>
                                                            2.支付成功后一定点击下面的确认支付！
                                                        </span>
                                                <br>
                                                <input type="button" class="a_blue" onclick="return pay_by_alipay();" value="确认支付" id="Button5" style="display: block; margin: 10px auto; width: 308px; height: 44px; background: #F44336; font-size: 30px;"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                            <div class="cz_three">
                                <div class="top">关于转账到款时间说明：</div>
                                <div class="bottom">
                                    1、工作日17点30分前转账的，承诺在资金到账后的半小时内完成充值<br>
                                    2、工作日17点30分以后转账的，承诺在第二个工作日的早上9点完成充值
                                    <br>
                                    3、非工作日转账的，承诺在下一工作日的早上9点完成充值
                                    <br>
                                    4、请使用实名认证后对应姓名的银卡进行转账
                                    <br>
                                    5、如未能及时充值，请联系客服。
                                </div>
                            </div>
                        </div>
                    </div>





                    <!-- 扫码支付 -->
                    <div class="modoudcon" style="display: none;" id="symdc6">
                        <div class="clearfix" data-title="认证支付" style="display: block;">
                            <form id="form6" method="post" onsubmit="return false;">
                                <table class="cz_two" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <th style="color: red; width: 190px;">选择您转账方式</th>
                                        <td>
                                            <select name="sm_type" id="sm_type">
                                                <option value="微信">微信</option>
                                                <option value="支付宝">支付宝</option>
                                                <option value="QQ钱包">QQ钱包</option>
                                                <option value="银联钱包">银联钱包</option>
                                                <option value="京东钱包">京东钱包</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td" style="text-align: right;">您的转账账号：</td>
                                        <td>
                                            <input id="smremark" name="smremark" class="txt" type="text" value="" style="width: 209px;" placeholder="请输入您的对应转账方式的账号"><strong>*</strong></td>
                                    </tr>
                                    <tr>
                                        <th>充值金额</th>
                                        <td>
                                            <input type="text" class="txt" style="width: 300px" name="sm_total" id="sm_total" placeholder="账户总额最多不能超过100万">元<strong>*</strong><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;
                                        </th>
                                        <td>手机扫一扫，快速转账，<span style="color: #E34343">0手续费</span><br>
                                            <img src="<?=Url::base()?>/frontend/web/xnn/images/sm_pay.png" width="300"></td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <td>
                                            <input type="button" class="a_blue" onclick="return pay_by_sm();" value="立即支付" id="Button7">

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>

                    <div class="modoudcon" style="display: none;" id="symdc7">
                        <div class="nrbox">
                            <div class="tit">选择充值银行<span style="color: red">（2小时内到账，到账后开户）</span></div>
                            <div>
                                <ul class="yh" style="margin-top: 30px;">
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/boc.jpg" height="49" width="154" alt="中国银行" />
                                        <span bank_icon="boc" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/abc.jpg" height="49" width="154" alt="中国农业银行" />
                                        <span bank_icon="abc" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/icbc.jpg" height="49" width="154" alt="中国工商银行" />
                                        <span bank_icon="ICBC" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/ccb.jpg" height="49" width="154" alt="中国建设银行" />
                                        <span bank_icon="ccb" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/psbc.jpg" height="49" width="154" alt="邮政储蓄银行" />
                                        <span bank_icon="psbc" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/cmbc.jpg" height="49" width="154" alt="民生银行" />
                                        <span bank_icon="cmbc" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/ceb.jpg" height="49" width="154" alt="光大银行" />
                                        <span bank_icon="ceb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/citic.jpg" height="49" width="154" alt="中信银行" />
                                        <span bank_icon="CITIC" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/pab.jpg" height="49" width="154" alt="平安银行" />
                                        <span bank_icon="SPAB" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/bob.jpg" height="49" width="154" alt="北京银行" />
                                        <span bank_icon="BJB" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/gdb.jpg" height="49" width="154" alt="广东发展银行" />
                                        <span bank_icon="GDB" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh  card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/hxb.jpg" height="49" width="154" alt="华夏银行" />
                                        <span bank_icon="hxb" bank_name="" bank_num="" bank_id="" limit="" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/cmb.jpg" height="49" width="154" alt="招商银行" />
                                        <span bank_icon="cmb" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/spdb.jpg" height="49" width="154" alt="浦发银行" />
                                        <span bank_icon="spdb" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                    <li class="gdyh card ">
                                        <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/bocom.jpg" height="49" width="154" alt="交通银行" />
                                        <span bank_icon="comm" bank_name="" bank_num="" bank_id="" limit="5000" bank_num_whole="" obligate_phone=""></span>
                                    </li>
                                </ul>
                                <span class="clear_f"></span>
                            </div>
                        </div>
                        <div class="modou_text f-clear">
                            <div class="symd czdiv">
                                <form id="form7" method="post" onsubmit="return false;" url="/tools/user_follow_ajax.ashx?act=recharge">
                                    <div class="czjecon">
                                        <div class="czjecleft">
                                            <dd>
                                                <font>充值金额：</font>
                                                <input class="cztxt" type="text" name="pay_money" id="pay_money" />
                                                <font>元</font>
                                            </dd>
                                            <input id="bankcode2" type="hidden" value="icbc" />

                                            <input class="czbut" type="button" value="充值" id="Button8" onclick="return rechargePay();" />

                                        </div>
                                        <div class="czjecright">
                                        </div>
                                    </div>
                                    <div class="czjecon">
                                        <div class="czjecleft"></div>
                                        <div class="czjecright">
                                            <h6>温馨提示</h6>
                                            <p>
                                                1、为了您的账户安全，请在充值前完善【个人信息】及【绑定银行卡】。<br />
                                                2、您的账户资金将通过第三方平台进行充值。请注意您的银行卡充值限制，以免造成不便。<br />
                                                3、禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用。<br />
                                                4、如出现充值页面打不开的情况，请换个浏览器（IE，谷歌等），或者清除DNS缓存后重试。
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- 天下支付-->
                    <div class="modoudcon" style="display: none;" id="symdc10" ng-controller="TianXiaPayController as vm">
                        <form ng-submit="vm.submit()">
                            <div class="wx_step_1">
                                <table class="cz_two" cellpadding="0" cellspacing="0">
                                    <tbody>

                                    <tr style="display: none">
                                        <th>卡类型</th>
                                        <td>
                                            <select ng-options="type.key as type.value for type in vm.cardTypes" ng-model="vm.cardType">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>支付类型</th>
                                        <td>
                                            <select id="Select1" ng-options="type.key as type.value for type in vm.PayMethods" ng-model="vm.PayMethod">
                                                <option selected disabled="disabled" value="">请选择</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr ng-if="vm.PayMethod==1">
                                        <th>银行卡</th>
                                        <td>
                                            <select ng-options="type.key as type.value for type in vm.bankSegments" ng-model="vm.bankSegment">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>充值金额</th>
                                        <td>
                                            <input type="text" ng-model="vm.Money" class="txt" style="width: 300px" placeholder="请输入充值金额">元<strong>*</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <td>

                                            <input class="baishipay_submit" type="submit" value="充值" /><span style="color: red; margin-left: 20px; line-height: 50px;">本次充值支持储蓄账户，不支持信用卡。</span>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                    <!-- youfu支付 网银-->


                    <style>
                        .baishipay_submit {
                            float: left;
                            padding: 0;
                            margin-left: 15px;
                            width: 80px;
                            height: 32px;
                            background: #FB8405;
                            border-radius: 5px;
                            border: none;
                            color: #fff;
                            margin-top: 10px;
                        }
                    </style>
                </div>


                <div class="modou_text f-clear">
                    <div class="guanzhuyonghu_top1" id="paylist">
                        <div class="title">充值记录</div>
                    </div>
                    <div class="czjl">
                        <ul id="recharge_list">
                        </ul>
                        <p style="padding-left: 30px;">累计充值：<b class="text_red"><?=$sum['money']?$sum['money']:0?>元</b></p>
                        <input id="recharge_count" type="hidden" value="0" />
                    </div>
                    <div class="page">
                        <div id="pager_recharge" class="flickr" style="display: none;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<form id="uploadForm" enctype="multipart/form-data" style="display: none">
    <input type="file" name="file" id="file">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken?>">
</form>
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

<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pagination.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pager.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layer.js"></script>

<script src="<?=Url::base()?>/frontend/web/xnn/scripts/angular.min.js"></script>

<script type="text/javascript">
    // 图片异步上传
    function upload(type) {
        type_file = type;
        $('#file').click();
    }
    $("#file").change(function(){
        $.ajax({
            url: '<?=Url::toRoute('public/upload')?>',
            type: 'POST',
            cache: false,
            data: new FormData($('#uploadForm')[0]),
            dataType:'JSON',
            processData: false,
            contentType: false
        }).done(function(res) {
            if(res.status === 200){
                $('#'+type_file).attr('src',res.path);
                $('.'+type_file).val(res.path);
            }
        });
    });
</script>

<!--[if lte IE 7]>
<script src="https://cdn.bootcss.com/json2/20160511/json2.min.js"></script>
<script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
<script>
    layer.alert('建议使用谷歌浏览器');
    var PayMethods = [{ key: 1, value: '网银支付' }, { key: 2, value: '快捷支付' }];//{ key: 2, value: '快捷支付' }
    var options='';
    for (var i = 0; i < PayMethods.length; i++) {
        options += '<option value="' + PayMethods[i].key + '">' + PayMethods[i].value + '<option>'
    }
    $('#tl_paymethod').append(options);
    layer.alert($('#tl_paymethod'));
</script>
<![endif]-->



