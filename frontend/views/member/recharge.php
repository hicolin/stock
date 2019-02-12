<?php
use yii\helpers\Url;
?>
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/recharge.css">
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/main(1).css">


<div class="wal">
    <div class="con">
        <!-- left -->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!-- left end -->

        <!-- right -->
        <div class="fr right">
            <div class="qhbox">
                <div class="menu menu0">
                    <ul class="style_head">
                        <li><a href="<?=Url::toRoute(['member/recharge'])?>" class="current">第三方支付</a></li>
                        <li><a href="<?=Url::toRoute(['member/bank-giro'])?>" class="">银行转账</a></li>
                        <li><a href="<?=Url::toRoute(['member/recharge-record'])?>" class="">充值记录</a></li>
                    </ul>
                    <span class="clear_f"></span>
                </div>
                <div class="cn style_content style_content0">
                    <div style="display:block;" class="ul" id="nav_cont1">
                        <!-- <form id="mainForm" method="post" onsubmit="return login_form();" action=""> -->
                            <div class="nrbox">
                                <div class="tit">填写充值金额</div>
                                <span class="tit1">账户余额</span><span class="price"><?=$member->money?></span>元<br>
                                <div style="width: 250px; height: 50px; margin-left: 260px;">
                                    <span style="width: 80px"> 支付方式：</span>
                                <select name="changetype" id="changetype" style="width: 130px;height: 28px;"> 

                                    <?php foreach ($recharge_type as $key => $value) { ?>
                                        <option value="<?=$value->id?>"> <?=$value->pay_name?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                <span class="tit1">充值金额</span>
                                <input name="ordermoney" type="text" class="text" value="" id="ordermoney">
                                元
                                &nbsp; &nbsp; &nbsp;<span id="rechargemsg" style="color:red"></span><br>
                                <input type="hidden" value="2199" name="userID" id="userid">
                                <input type="hidden" value="" name="Username" id="Username">
                                <input type="hidden" value="" name="v_rcvemail" id="v_rcvemail">
                                <input type="hidden" value="18164462528" name="v_rcvmobile" id="v_rcvmobile">
                                <input type="button" id="sub_btn" name="submit"  value="立即充值" class="btn">


                            </div>
                            <div class="tag">温馨提示：因第三方支付需要通过财务支付审核，如果想尽快操盘，建议您采用以即时到帐的银行转账充值方式，谢谢支持。</div>
                            <div class="tagxin">1、为了您的资金安全，您的账户资金将由第三方银行托管；<br>
                                2、充值前请注意您的银行卡充值限制，以免造成不便；<br>
                                3、禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用；<br>
                                4、为了您的资金安全，建议充值前进行实名认证、手机绑定、设置提现密码；<br>
                                5、为了维持银行通道的稳定性，我们采用的是综合支付通道，在此支付过程中，可能会通过支付宝、快钱、网银在线、双乾、银联等支付通道进行充值，请放心使用。<br>
                                6、如果充值遇到任何问题，请联系客服： 400-150-7888。
                            </div>
                       <!--  </form> -->
                    </div>
                </div>
                <span class="clear_f"></span></div>
        </div>
        <!-- right end -->
        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript">
    $('#sub_btn').click(function(){

        var ordermoney = $("#ordermoney").val();
        var changetype = $("#changetype").val();
        var getCsrfToken = "<?=Yii::$app->getRequest()->getCsrfToken()?>";
        if (ordermoney == "") {
            layer.tips('请输入金额', $("#ordermoney"), {tips: 2, time: 2000});
            return false;
        }else if(changetype==""){
            layer.tips('选择支付方式', $("#changetype"), {tips: 2, time: 2000});
            return false;

        } else {
            $.ajax({
                type: 'post',
                url: '<?=Url::toRoute("member/recharge")?>',
                async: false,
                dataType:'json',
                data: {'ordermoney': ordermoney,
                    'changetype': changetype,
                    '_csrf': getCsrfToken

                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    layer.closeAll();
                    layer.open({
                        content: '系统出错'
                        ,skin: 'msg'
                        ,time: 2
                    });
                },
                success: function (msg) {
                    layer.closeAll();
                    if(msg.status == 600) {
//                        var h = "<?//=$_SERVER['HTTP_HOST']?>//";
//                        alert(h);
                        window.location.href="http://zjpro.boheng100.com/pay/pay?id="+msg.order_id;
                    }else{
                        layer.msg('提交失败',{time:2000})
                    }
                }
            });
        }

    });
</script>
