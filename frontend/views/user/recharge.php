
<?php 
use yii\helpers\Url;
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

                        <li style="display: block;"><a href="#" class="ada">快捷支付</a></li>
                        <li style="display: block;"><a href="<?=Url::toRoute(['user/line-recharge'])?>" class="">银行转账</a></li>
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
                    <div class="modoudcon" style="display: none;" id="symdc2">
                        <div class="clearfix" data-title="线下充值" id="symdc1 " style="display: block;">
                            <form id="form1" method="post" onsubmit="return false;">
                                <div class="bank_step_2 ">
                                    <h2 class="cz_h2">第一步：通过网上银行、银行柜台或ATM机等转账<i>（请先手动转账成功后再进行第二步）</i></h2>
                                    <table class="cz_two" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td width="202">
                                                <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/3002.jpg"></td>
                                            <td>银行帐号：6217 2315 1000 1302 457
                                                <br>
                                                账户名称：况庆国
                                                <br>
                                                开户银行：赣州工商银行创业支行
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="202">
                                                <img src="<?=Url::base()?>/frontend/web/xnn/images/bank/3005.jpg"></td>
                                            <td>银行帐号：6228 4834 7877 4422 971
                                                <br>
                                                账户名称：况庆国
                                                <br>
                                                开户银行：赣州农业银行黄金支行
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
                                            <th>转账方式</th>
                                            <td id="off_bank_name">
                                                <label style="display: none;">
                                                    <input name="pzzh" value="ATM" type="radio">
                                                    ATM</label>
                                                <label>
                                                    <input name="pzzh" value="柜台转账" type="radio" checked="checked">
                                                    柜台转账</label>
                                                <label>
                                                    <input name="pzzh" value="网上银行" type="radio">
                                                    网上银行</label>
                                                <label>
                                                    <input name="pzzh" value="手机银行" type="radio">
                                                    手机银行</label>
                                                <label>
                                                    <input name="pzzh" value="支付宝" type="radio">
                                                    支付宝</label>
                                                <label style="display: none;">
                                                    <input name="pzzh" value="其它" type="radio">
                                                    其它</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="color: red; width: 190px;">选择您转入的银行</th>
                                            <td>
                                                <select name="yh" id="yh">
                                                    <option value="工商银行 6217 2315 1000 1302 457">中国工商银行 账号：6217 2315 1000 1302 457</option>
                                                    <option value="农业银行 6228 4834 7877 4422 971">中国农业银行 账号：6228 4834 7877 4422 971</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>转账金额</th>
                                            <td>
                                                <input type="text" name="total" id="total" class="txt" style="width: 170px" autocomplete="off" placeholder="请输入您的转账金额">元<strong>*</strong></td>
                                        </tr>
                                        <tr>
                                            <th>您的转账卡号</th>
                                            <td>
                                                <textarea class="txt" style="width: 400px; height: 40px; line-height: 20px;" name="remark" id="remark"></textarea><strong>*</strong><br>
                                                <i>
                                                    <br>
                                                    提示：网上银行填写支付平台名称和交易号，其它填写转账银行及卡号</i>
                                            </td>
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
                    <!-- 微信转帐 -->
                    <div class="modoudcon" style="display: none;" id="symdc4">
                        <div class="clearfix" data-title="微信" id="wx_step_1" style="display: block;">
                            <form id="form2" method="post" onsubmit="return false;">
                                <div class="wx_step_1">
                                    <h2 class="cz_h2">第一步：提交您的转账信息</h2>
                                    <table class="cz_two" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td class="td" style="text-align: right;">您的微信账号：</td>
                                            <td>
                                                <input id="wxremark" name="wxremark" class="txt" type="text" value="" style="width: 209px;" placeholder="请输入账号"><strong>*</strong></td>
                                        </tr>
                                        <tr>
                                            <th>转账金额</th>
                                            <td>
                                                <input type="text" class="txt" style="width: 300px" name="wechat_total" id="wechat_total" placeholder="请输入您的转账金额">元<strong>*</strong><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <td>

                                                <input type="button" class="a_blue" onclick="return wx_step_2();" value="前往支付" id="Button1">

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="wx_step_2" style="display: none;">
                                    <h2 class="cz_h2">第二步：通过微信转账（微信转账0手续费）</h2>
                                    <table class="cz_four" cellpadding="0" cellspacing="0" style="width: 740px;">
                                        <tbody>
                                        <tr>
                                            <td class="td" width="40%">收款人微信账户</td>
                                            <td>股金源  *****----</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">手机微信扫一扫，快速转账，<span style="color: #E34343">0手续费</span><br>
                                                <img src="<?=Url::base()?>/frontend/web/xnn/images/wx_pay-xx.png" width="300">
                                                <img src="<?=Url::base()?>/frontend/web/xnn/images/wx_tips.png" width="285" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                <input type="button" class="a_blue" onclick="return pay_by_wechat();" value="确认支付" id="Button3" style="display: block; margin: 10px auto; width: 308px; height: 44px; background: #F44336; font-size: 30px;">
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                        <span style="color: #E34343; font-size: 18px;">重要提示：<br />
                                                            1.微信转账时请在【添加留言】里填写您在“金玉鼎”注册的手机号！
                                                                        <br />
                                                            2.支付成功后点击上面的【确认支付】按钮！</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="cz_three" style="width: 695px; margin-top: 20px;">
                                        <div class="top">温馨提示：</div>
                                        <div class="bottom">
                                            1、打开微信扫一扫或者长安识别图中二维码支付；<br />
                                            2、工作日17:30前充值,30分钟内未到账请联系客服<br />
                                            3、非工作日或工作日17:30后充值的，承诺在下一个工作日9:00前完成充值。
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- 认证支付 -->
                    <div class="modoudcon" style="display: none;" id="symdc5">
                        <div class="clearfix" data-title="认证支付" style="display: block;">
                            <form id="form5" method="post" onsubmit="return false;">
                                <div class="wx_step_1">
                                    <h2 class="cz_h2">认证支付需要您<a href="name_true.html">实名认证</a>以及<a href="bind.html">绑定银行卡</a></h2>
                                    <table class="cz_two" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <th>充值金额</th>
                                            <td>
                                                <input type="text" class="txt" style="width: 300px" name="auth_total" id="auth_total" placeholder="账户总额最多不能超过100万">元<strong>*</strong><br>
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
                    <div class="modoudcon" style="display: block;" id="symdc11" ng-controller="YouFuDataPayController as vm">
                        <form >
                            <div class="wx_step_1">
                                <table class="cz_two" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <th>充值方式</th>
                                        <td>
                                            <select id="tl_paymethod">
                                                <?php foreach($paytype as $k=>$v){ ?>
                                                <option value="<?=$v['id']?>"><?=$v['pay_name']?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr ng-if="vm.PayMethod==1" style="display: none;">
                                        <th>充值卡号</th>
                                        <input type="hidden" name="cardid" value="<?=$member->bankid?>">
                                    </tr>
                                    <tr ng-if="vm.PayMethod==1" style="display: none;">
                                        <th>姓名</th>
                                        <input type="hidden" name="cardname" value="<?=$member->realname?>">
                                    </tr>
                                    <tr>
                                        <th>充值金额</th>
                                        <td>
                                            <input type="text" ng-model="vm.Money" name="amount" class="txt" style="width: 300px" placeholder="请输入充值金额" />元<strong>*</strong>
                                        </td>

                                    </tr>
                                     <?php if($member->tx_pwd == "" ){?>
                                        <td>
                                            <input class="baishipay_submit" type="button" onclick="window.location.href='<?=Url::toRoute("user/bankroll-password")?>'"  value="请先设置交易密码" style="width: 125px;" />
                                        </td>
                                    <?php }else{?>
                                    <tr>
                                        <th>交易密码</th>
                                        <td>
                                            <input type="password" ng-model="vm.Pass" name="cardpass" class="txt" style="width: 300px" placeholder="请输入资金密码" /><strong>*</strong>
                                        </td>

                                    </tr>

                                    <tr>
                                        <th>&nbsp;</th>
                                        <td>
                                            <?php if($member->state == 1 ){?>
                                            <input class="baishipay_submit" type="button" onclick="sub()" value="充值" />
                                            <?php }else{?>
                                            <input class="baishipay_submit" type="button" onclick="window.location.href='<?=Url::toRoute("user/certification")?>'"  value="实名认证" />
                                            <?php }?>

                                        </td>
                                    </tr>

                                    <?php }?>
 
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

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
                        <p style="padding-left: 30px;">累计充值：<b class="text_red"><?=$sum?$sum:0?>元</b></p>
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
        function sub()
        {
        var pay_type = $("#tl_paymethod").val();
        var amount = $("input[name='amount']").val();
        var cardname = $("input[name='cardname']").val();
        var cardid = $("input[name='cardid']").val();
        var cardpass = $("input[name='cardpass']").val();
        if(amount==""){
            layer.tips("充值金额不能为空", "input[name='amount']", {tips:3,time:2000});
            return false;
        }else if(!(/^(\d)*$/).test(amount)){
            layer.tips("充值金额格式不对", "input[name='amount']", {tips:3,time:2000});
            return false;
        }else if(cardpass==""){
            layer.tips("请输入充值密码", "input[name='cardpass']", {tips:3,time:2000});
            return false;
        }
        $.ajax({
            url  : "<?= Url::toRoute($this->context->id . '/recharge-money')?>",
            type : 'post',
            data : {'cardname':cardname,'cardid':cardid,'amount':amount,'cardpass':cardpass,'pay_type':pay_type},
            dataType:'text',
            success:function(data){
                    if(data==100){
                        layer.msg('操作成功',{tips:3,time:2000},function(){
                           window.location.href='/user/index';
                        });
                    }else if(data==300) {
                        layer.msg('充值失败，请稍后重试',{tips:3,time:2000});
                    } else{
                        layer.msg('密码错误');
                    }
                }
        });

        }

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
<!-- <script type="text/javascript">
    var str;
    function tbbq(str) {
        for (var i = 1; i < 3; i++) {
            document.getElementById('tbbqc' + i).style.display = "none";
            document.getElementById('tbbqa' + i).className = "";
        }
        document.getElementById('tbbqc' + str).style.display = "block";
        document.getElementById('tbbqa' + str).className = "ada";
    }
    function symd(str) {
        for (var i = 1; i <= 13; i++) {
            $('#symdc' + i).hide();
            $('#symda' + i).removeClass('ada');
        }
        $('#symdc' + str).show();
        $('#symda' + str).addClass('ada');
    }
    function changeBank(a, num) {
        $(a).parents("li").siblings().find("label").css("border", "1px #ddd solid");
        $(a).parents("li").find("label").css("border", "1px #349cd8 solid");
        $("input").removeAttr('checked');
        $("input[id=" + num + "]").prop("checked", true);
    }
    $(function () {
        rechargeData(0);
        $("#user").addClass("now");
        $("#pay").addClass("ada");
        $("#pay").parent().parent().css("display", "block");
        $("#pay").parent().parent().prev().addClass("currentDd currentDt");
        $(".subNav").click(function () {
            $(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd")
            $(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt")
            // 修改数字控制速度， slideUp(500)控制卷起速度
            $(this).next(".navContent").slideToggle(500).siblings(".navContent").slideUp(500);
        });
        $(".yh li").click(function () {
            $(this).parent().find("li").css("border", "1px solid #ccc");
            $(this).css("border", "1px solid red");
            $("#bankcode").val($(this).find("span").attr("bank_icon"));
            $("#bankcode2").val($(this).find("span").attr("bank_icon"));
        });
        $(".yhll li").click(function () {
            $(this).parent().find("li").css("border", "1px solid #ccc");
            $(this).css("border", "1px solid red");
            $("#bankcode_ll").val($(this).find("span").attr("bank_icon"));
        });
    });

    //=====合力支付
    function money_in() {
        var pay_code = $('input:radio[name="pay_code"]:checked').val();
        var money = parseFloat($("#money").val()), payid = $('#bankcode').val();
        if (isNaN(money)) {
            TipMsg.position("请输入充值金额！", $("#money"), 2000, 0, 0); $("#money").focus(); return false;
        }
        if (money <= 0) {
            TipMsg.position("充值金额必须大于0！", $("#money"), 2000, 0, 0); $("#money").focus(); return false;
        }
        if (pay_code == 1) {
            window.open("/api/unspay/index.aspx?amount=" + money + "&bankCode=" + payid, "_blank");
        } else if (pay_code == 3) {
            window.open("/api/umpay/index.aspx?amount=" + money + "&bank_code=" + payid, "_blank");
        } else {
            window.open("/api/helipay/index.aspx?amount=" + money + "&bank_code=" + payid + "&user_id=833", "_blank");
        }
    }
    //=====连连支付
    function money_ll_in() {
        var pay_code = $('input:radio[name="pay_code"]:checked').val();
        var money = parseFloat($("#money_ll").val()), payid = $('#bankcode_ll').val();
        if (isNaN(money)) {
            TipMsg.position("请输入充值金额！", $("#money_ll"), 2000, 0, 0); $("#money_ll").focus(); return false;
        }
        if (money < 200) {
            TipMsg.position("单笔至少充值200元！", $("#money_ll"), 2000, 0, 0); $("#money_ll").focus(); return false;
        }
        window.open("http://www.hjn668.com/api/lianlianpay/index.aspx?urlLocation=2&amount=" + money + "&bankCode=" + payid + "&user_id=833", "_blank");
    }
    //=====连连认证支付充值
    function pay_by_llauth() {
        var money = parseFloat($("#auth_ll_total").val()), user_id = $("#user_id").val();
        if (isNaN(money)) {
            TipMsg.position("请输入充值金额！", $("#auth_ll_total"), 2000, 0, 0); $("#auth_ll_total").focus(); return false;
        }
        if (money < 200) {
            TipMsg.position("单笔至少充值200元！", $("#auth_ll_total"), 2000, 0, 0); $("#auth_ll_total").focus(); return false;
        }
        window.open("http://www.hjn668.com/api/lianlianpay_auth_web/index.aspx?urlLocation=2&amount=" + money + "&user_id=" + user_id + "&bank_id=0", "_blank")
    }
    //=====联动支付
    var rechargePay = function () {
        var rechargemoney = $("#pay_money").val(), payid = $('#bankcode2').val();
        if (rechargemoney == null || rechargemoney == "") {
            $("#pay_money").focus();
            layer.alert("请输入充值金额！", 8);
            return;
        }
        if (isNaN(rechargemoney)) {
            $("#rechargemoney").focus();
            layer.alert("充值金额必须是数字！", 8);
            return;
        }
        window.open("/api/umpay/index.aspx?user_id=" + 833 + "&amount=" + rechargemoney + "&bank_code=" + payid, "_blank");
    }

    function wx_step_2() {
        var total = $("#wechat_total").val(), wxremark = $("#wxremark").val();

        if (total.length < 1) {
            $("#wechat_total").focus();
            layer.alert("请填写转账金额！", 8);
            return;
        }
        if (isNaN(total)) {
            $("#wechat_total").focus();
            layer.alert("转账金额必须是数字！", 8);
            return false;
        }

        if (wxremark.length < 5) {
            $("#wxremark").focus();
            layer.alert("请输入正确的微信账户！", 8);
            return false;
        }

        $(".wx_step_1").css("display", "none");
        $(".wx_step_2").css("display", "block");
    }
    function zfb_step_2() {
        var total = $("#alipay_total").val(), zfbremark = $("#zfbremark").val();

        if (total.length < 1) {
            $("#alipay_total").focus();
            layer.alert("请填写转账金额！", 8);
            return;
        }
        if (isNaN(total)) {
            $("#alipay_total").focus();
            layer.alert("转账金额必须是数字！", 8);
            return false;
        }

        if (zfbremark.length < 5) {
            $("#zfbremark").focus();
            layer.alert("请输入正确的支付宝账户！", 8);
            return false;
        }
        $(".zfb_step_1").css("display", "none");
        $(".zfb_step_2").css("display", "block");
    }
    function ck_money(obj) {
        var money_able_use = parseFloat("0.00"), money_now = parseFloat($(obj).val());
        if (isNaN(money_now)) {
            money_now = 0;
        }
        var money_all = money_able_use + money_now;
        if (money_all > 1000000) {
            $(obj).val(1000000 - money_able_use)
        }
    }
    var ck_bank = function (type_id) {
        if (type_id == 1) {
            $(".heli").show();
        } if (type_id == 2) {
            $(".heli").show();
        } else {
            //$(".heli").hide();
        }
    }
    function authPaiPayAply() {
        var money = parseFloat($("#auth_total").val()), cardNo = $('#cardNo').val();
        if (isNaN(money)) {
            layer.alert("请输入充值金额", 8);
            $("#auth_total").focus();
            return false;
        }
        if (money <= 0) {
            layer.alert("充值金额必须大于0元", 8);
            $("#auth_total").focus();
            return false;
        }
        if (cardNo == "") {
            layer.alert("请先绑定充值银行卡", 8);
            return false;
        }
        layer.load(0, { shade: false });
        $.ajax({
            url: "/tools/user_pay_ajax.ashx?act=apply_unspay_auth_pay&amount=" + money + "&cardNo=" + cardNo + "",
            dataType: "json",
            type: "post",
            timeout: 10000,
            success: function (data) {
                layer.closeAll();
                if (data.status == "y") {
                    location.href = "/user/payOk.html?token=" + data.token + "&orderId=" + data.orderId + "&money=" + money;
                }
                else {
                    layer.alert(data.info, 8);
                    return;
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.alert("状态：" + textStatus + "；出错提示：" + errorThrown, 8);
            }
        });

        return;
    }
</script> -->

<div class="kefu">
    <ul>

        <li class="l3" style="display: none;">
            <a href="javascript:;"></a>
            <div class="hide3">
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><span>客服一</span><br/><i></i></a><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><span>qq交流群</span><br/><i></i></a>
            </div>
        </li>
        <li class="l4"><a href="#page1" id="scrollTop"></a></li>
    </ul>
</div>
</body>
</html>
