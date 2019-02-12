<?php 
use yii\helpers\Url;
?>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet" />
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layer.js"></script>
<link href="<?=Url::base()?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet" />
<div class="clearborth"></div>

<div class="nbody" ng-app="WithdrawalsApp">
    <div class="nw1000">
        <!--member-left-->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!--end left-->
        <div class="nrightmore">
            <div class="zhsz">
                <div class="czdiv">
                    <form id="form1" name="form1" method="post" action="">
                        <div class="czje">
                            <h5><a href="javascript:">填写提现金额</a></h5>
                            <div class="czjecon">
                                <div class="czjecleft">
                                    <dd>
                                        <font>可用资金：</font>
                                        <label class="money_able"><?=$onelist->money?></label>
                                        <font>元</font>
                                    </dd>
                                    <div class="clearborth"></div>
                                    <dd>
                                        <font>提现金额：</font>
                                        <input class="cztxt" type="text" id="amount" name="amount" />
                                        <font>元</font>
                                    </dd>
                                        <input class="cztxt" type="hidden"  name="cardname" readonly="" value="<?=$onelist->realname?>" />
                                        <input class="cztxt" type="hidden"  name="cardid" readonly=""   value="<?=$onelist->bankid?>" />

                                    <div class="clearborth"></div>
                                    <?php if($onelist->tx_pwd == ""){ ?>
                                    <dd style="height: 48px;">
                                        <input class="czbut" type="button" value="请先设置交易密码" id="cash-submit" onclick="window.location.href='<?=Url::toRoute('user/bankroll-password')?>'" style="margin-left: 70px;width: 115px;" />
                                    </dd>
                                    <?php }else{ ?>
                                    <dd>
                                        <font>交易密码：</font>
                                        <input class="cztxt" type="password" name="cardpass" id="amount" />
                                        <!-- <font style="color: red">*</font> -->
                                    </dd>
                                    <div class="clearborth"></div>
                                    
                                    <dd>
                                        <font>手机号码：</font>
                                        <input class="cztxt" type="text" id="tel" name="tel" />
                                    </dd>
                                    <div class="clearborth"></div>
                                      
                                    <dd>
                                        <font>验证码：</font>
                                        <input class="cztxt" type="text" id="vercode" name="vercode" style="width: 15%;" />
                                        <input type="button" id="btnOnece" class="register-sms get-code  code send_code" value="获取短信验证码" style="width: 105px;">
                                    </dd>
             
                                    <div class="clearborth"></div>
                                    <?php if($onelist->state == 1){ ?>
                                    <dd style="height: 48px;">
                                        <input class="czbut" type="button" value="提现" id="cash-submit" onclick="sub();" style="margin-left: 70px;" />
                                    </dd>
                                    <?php }else{ ?>
                                    <dd style="height: 48px;">
                                        <input class="czbut" type="button" value="请先实名认证" id="cash-submit" onclick="window.location.href='<?=Url::toRoute('user/certification')?>'" style="margin-left: 70px;width: 115px;" />
                                    </dd>
                                    <?php }?>
                                    <?php }?>
                                </div>
                                <div class="czjecright">
                                    <h6>注意事项</h6>
                                    <p>
                                        1、到账时间：银行普通转帐，平台准实时提交到银行，一般1~2小时到账，具体到账时间以收款行到账时间为准。<br />
                                        2、提现不得低于100元。<br />
                                        3、操盘无需申请，买入成功后才支付手续费。<br />
                                        4、每天只能免费提现一次，否则收取0.3%手续费，50元封顶。<br />
                                        5、没有任何操作，充值了又提现的，每次我们将扣取0.5%的提现手续费，50元封顶<br />
                                        6、24小时均可申请提现，审核时间为（周一到周五）16:30-17:00<br />
                                    </p>
                                    <h6>温馨提示</h6>
                                    <p>
                                        1、请确保您输入的提现金额，以及银行帐号信息准确无误。<br />
                                        2、平台禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="guanzhuyonghu_top1" style="margin-top: 20px; width: 760px;">
                        <div class="title">提现记录</div>
                    </div>
                    <div class="czjl txjl" style="width: 778px;">
                        <ul id="cash_list">
                        </ul>
                        <p style="padding-left: 30px;">累计提现：<b class="text_red"><?=$sum['money']?$sum['money']:0?>元</b></p>
                        <input id="cash_count" type="hidden" value="0" />
                        <div class="page">
                            <div id="pager_cash" class="flickr" style="display: none;"></div>
                        </div>
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


<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layout.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pagination.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pager.js"></script>
<script type="text/javascript">
         $("input[name='tel']").blur(function(){

        var tel = $(this).val();

        if(tel==""){

            layer.tips("手机号不能为空", "#tel", {tips:3,time:2000});

            return false;

        }

        if(!(/^1(3|4|5|7|8)\d{9}$/).test(tel)){

            layer.tips("手机号输入不正确", "#tel", {tips:3,time:2000});

            return false;

        }

        $.ajax({

            url  : "<?= Url::toRoute('index/bank-tel')?>",

            type : 'post',

            data : {'tel':tel},

            dataType:'text',

            //beforeSend:function(){},

            success:function(data){

                if(data==100){

                     layer.msg('请输入正确的银行卡绑定手机号',{time:2000},function(){



                        top.location.href ="<?=Url::toRoute('user/certification')?>";



                    })

                }

                else{

                    $(".send_code").attr("onclick","get_code();");

                    $('.send_code').attr('disabled',false).css('cursor','pointer');

                    $('#sub').attr('disabled',false).css('cursor','pointer');

                }

            }

        });



    })





    //发送验证码

    function get_code(){

        var tel = $('#tel').val();

        // alert(tel);

        if(tel==""){

            layer.tips("手机号不能为空", "#tel", {tips:3,time:2000});

            return false;

        }

        else if(!(/^1(3|4|5|7|8)\d{9}$/).test(tel)){

            layer.tips("手机号输入不正确", "#tel", {tips:3,time:2000});

            return false;

        }

        send_code('send_code',tel)

    }



    function send_code(code,tel){

        var btn = $('.'+code);

        var count = 60;

        var resend = setInterval(function(){

            count--;

            console.log(count)

            if (count > 0){

                btn.val('重新发送('+count+')');

            }else {

                clearInterval(resend);

                btn.val("获取验证码").removeAttr('disabled style');

            }

        }, 1000);

        if(code=='old_code'){

            var url = "<?=Url::toRoute('index/message')?>";

        }else{

            var url = "<?=Url::toRoute('index/message')?>";

        }

        $.ajax({

            url  : url,

            type : 'post',

            data : {'tel':tel},

            dataType:'text',

            success:function(data){

                layer.msg("发送成功");

            }

        });

        btn.attr('disabled',true).css('cursor','not-allowed');

    }

</script>
<script type="text/javascript">

    $(function () {
        cashData(0);
        $("#user").addClass("now");
        $("#cash").addClass("ada");
        $("#cash").parent().parent().css("display", "block");
        $("#cash").parent().parent().prev().addClass("currentDd currentDt");
        $(".subNav").click(function () {
            $(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd")
            $(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt")
            // 修改数字控制速度， slideUp(500)控制卷起速度
            $(this).next(".navContent").slideToggle(500).siblings(".navContent").slideUp(500);
        });
    });
    function sub()
        {
          // alert(111);
        var money = <?=$onelist->money?>;
        var amount = $("input[name='amount']").val();
        var cardname = $("input[name='cardname']").val();
        var cardid = $("input[name='cardid']").val();
        var cardpass = $("input[name='cardpass']").val();
        var tel=$("input[name='tel']").val();
        var vercode=$("input[name='vercode']").val();
        if(amount==""){
            layer.tips("提现金额不能为空", "input[name='amount']", {tips:3,time:2000});
            return false;
        }
        if(amount > money ){
          layer.tips("数款数额不得大于账户余额", "input[name='amount']", {tips:3,time:2000});
            return false;
        }
        if(cardpass==""){
            layer.tips("请输入提现密码", "input[name='cardpass']", {tips:3,time:2000});
            return false;
        }
        if(cardname==""){
            layer.tips("请输入收款人姓名", "input[name='cardname']", {tips:3,time:2000});
            return false;
        }
        if(cardid==""){
            layer.tips("请输入提现银行卡号", "input[name='cardid']", {tips:3,time:2000});
            return false;
        }
        if(tel==""){
            layer.tips("请输入手机号", "input[name='tel']", {tips:3,time:2000});
            return false;
        }
        if(vercode==""){
            layer.tips("请输入验证码", "input[name='vercode']", {tips:3,time:2000});
            return false;
        }
        else{

             $.ajax({

                url  : "<?= Url::toRoute($this->context->id . '/regcode')?>",

                type : 'post',

                data : {'vercode':vercode,'tel':tel},

                dataType:'text',

                //beforeSend:function(){},

                success:function(data){

                    if(data==200){

                        layer.tips('验证码错误，请重新输入', "input[name='vercode']", {tips:3,time:2000});

                    }else if(data==300) {

                        layer.tips('不是当前手机号', "input[name='tel']", {tips:3,time:2000});

                    } else {

                        $.ajax({
                        url  : "<?= Url::toRoute($this->context->id . '/withdraw-money')?>",
                        type : 'post',
                        data : {'cardname':cardname,'cardid':cardid,'amount':amount,'cardpass':cardpass},
                        dataType:'text',
                        success:function(data){
                                if(data==100){
                                    layer.msg('提现成功，审核中',{tips:3,time:2000},function(){
                                       window.location.reload();
                                    });
                                }else if(data==300) {
                                    layer.msg('提现失败，请稍后重试',{tips:3,time:2000});
                                }else if(data == 200){
                                    layer.msg('提现密码错误',{tips:3,time:2000});
                                }
                            }
                       });

                    }

                }

            });

             return false;

        }



        

        }
</script>


