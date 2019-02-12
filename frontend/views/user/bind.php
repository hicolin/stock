<?php
use yii\helpers\Url;

?>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet"/>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<div class="clearborth"></div>
<div class="nbody">
    <div class="nw1000">
        <!--member-left-->
        <?php $this->beginContent('@app/views/layouts/member-left.php') ?>
        <?php $this->endContent() ?>
        <!--end left-->
        <div class="nrightmore">
            <div class="zhsz">
                <div class="nw1000" id="bdyhk">
                    <div class="nleftmore">
                        <div class="bdyhk">
                            <h5><a href="javascript:">实名认证</a></h5>
                        </div>
                        <div class="zcdiv margin0">
                            <div class="zcdcon login" style="background: none;">
                                <form id="form1" method="post" onsubmit="return false;"
                                      url="/user/certification">
                                    <dl style="color: red; height:48px;line-height: 24px;">
                                        <span>温馨提示</span>
                                        <dd style="width:82%; margin-right:2%;">

                                            请填写实名认证身份证开户的银行卡，填写正确的银行账号及开户支行，如以上银行信息填写错误会导致提现不到账，如不清楚开户支行信息请拨打银行服务热线咨询。
                                        </dd>
                                    </dl>
                                    <dl>
                                        <span>开户银行</span>
                                        <dd>
                                            <input class="dtxt" type="text" name="bank_id" value="<?=$member->bankcode?>">
                                        </dd>
                                    </dl>
                                    <dl style="overflow: visible;">
                                        <span>开户行地区</span>
                                        <dd>

                                            <select name="province" id="province" style="width: 30%;height: 30px;border: 1px solid #ddd">
                                                <option value='0'>--省--</option>
                                                <?php
                                                foreach ($province as $list) { ?>
                                                    <option <?=$list->id==$member->bank_province?'selected':''?> value="<?=$list->id?>"><?=$list->name?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <select name="city" id="city" style="width: 30%;height: 30px;border: 1px solid #ddd" >
                                                <?=$city?>
                                            </select>

                                        </dd>
                                    </dl>
                                    <dl>
                                        <span>开户支行</span>
                                        <dd>
                                            <input class="dtxt" name="bank_branch" type="text" value="<?=$member->bankaddress?>"
                                                   id="bank_branch"/>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <span>银行卡号</span>
                                        <dd>
                                            <input class="dtxt" name="bank_card" type="text" value="<?=$member->bankid?>" id="bank_card"/>
                                            <em></em>
                                        </dd>
                                    </dl>
                                    <?php if($member->state!=1):?>
                                    <dl>
                                        <span>银行卡号确认</span>
                                        <dd>
                                            <input class="dtxt" type="text" value="" id="bank_card2" name="bank_card2" value="<?=$member->bankid?>"/>
                                            <em></em>
                                        </dd>
                                    </dl>
                                    <?php endif;?>
                                    <dl>
                                        <span>开户人姓名</span>
                                        <dd>
                                            <input class="dtxt" name="bank_account_name" value="<?=$member->realname?>" type="text"
                                                   id="bank_account_name" />
                                        </dd>
                                    </dl>
                                    <dl>
                                        <span>身份证号</span>
                                        <dd>
                                            <input class="dtxt" name="id_card" value="<?=$member->cartid?>" type="text"
                                                   id="id_card" />
                                            <em></em>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <span>手机</span>
                                        <dd>
                                            <input class="dtxt" name="mobile_phone" id="mobile_phone" type="text"
                                                   value="<?=$member->bank_tel?>"/>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <span>&nbsp;</span>
                                        <dd>
                                            <?php if($member->state==1){?>
                                            <input class="but sbut" type="button" value="已认证" />
                                            <?php }else{?>
                                                <input class="but sbut" type="button" value="保  存" id="btnSubmit"/>
                                            <?php }?>
                                        </dd>
                                    </dl>
                                </form>
                                <div class="zhsz">
                                    <div class="czjecright">
                                        <h6>温馨提示：<b style="color: red;">为了您的账户安全，请输入真实信息。</b></h6>
                                    </div>
                                </div>
                            </div>
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


<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/layout.js"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/area.js"></script>
<script type="text/javascript">
    $(function () {
        var state = <?=$member->state?>;
        if(state == 1){
            $("input").attr("disabled",true);
            $("select").attr("disabled",true);
        }
        $("#user").addClass("now");
        $("#bind").addClass("ada");
        $("#bind").parent().parent().css("display", "block");
        $("#bind").parent().parent().prev().addClass("currentDd currentDt");
        $(".subNav").click(function () {
            $(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd")
            $(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt")
            // 修改数字控制速度， slideUp(500)控制卷起速度
            $(this).next(".navContent").slideToggle(500).siblings(".navContent").slideUp(500);
        });
    });
    $(function () {
        //保存
        $("#btnSubmit").click(function () {
            if (!$("#bank_branch").val()) {
                TipMsg.position("开户支行不为空！", $("#bank_branch"), 2000, 0, 0);
                return false;
            }
            if (!$("#bank_card").val()) {
                TipMsg.position("请输入银行卡号！", $("#bank_card"), 2000, 0, 0);
                return false;
            }
            if (!bankcardCheck($("#bank_card").val())) {
                TipMsg.position("银行卡号不合法！", $("#bank_card"), 2000, 0, 0);
                return false;
            }
            if ($("#bank_card2").val() != $("#bank_card").val()) {
                TipMsg.position("银行卡号输入不一致！", $("#bank_card2"), 2000, 0, 0);
                return false;
            }
            if (!$("#bank_account_name").val()) {
                TipMsg.position("请输入开户人姓名！", $("#bank_card2"), 2000, 0, 0);
                return false;
            }
            if ($("#id_card").val().length < 15) {
                TipMsg.position("身份证不合法！", $("#id_card"), 2000, 0, 0);
                return false;
            }
            $.ajax({
                type: "POST",
                url: $("#form1").attr("url"),
                dataType: "json",
                data: $("#form1").serialize(),
                timeout: 20000,
                cache: false,
                beforeSend: function (XMLHttpRequest) {
                    $("#btnSubmit").attr("disabled", true);
                },
                success: function (data, textStatus) {
                    if (data.status == "y") {
                        alert(data.info);
                        window.location.reload();
                    } else {
                        $("#btnSubmit").attr("disabled", false);
                        TipMsg.position(data.info, $("#btnSubmit"), 2000, 0, 0);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("状态：" + textStatus + "；出错提示：" + errorThrown);
                    $("#btnSubmit").attr("disabled", false);
                }
            });
        });
    });
    function load_bank_city(pname, cname) {
        var id = pname.val();
        if (id == -1) {
            var html = "<option value='-1'>=请选择=</option>";
        }
        else {
            var regionConfs = regionConf[id]['list'];
            var html = "<option value='-1'>=请选择=</option>";
            for (var key in regionConfs) {
                html += "<option value='" + regionConfs[key]['city_cd'] + "'>" + regionConfs[key]['city_nm'] + "</option>";
            }
        }
        cname.html(html);
    }
</script>
<script type="text/javascript">
    $('#province').change(function(){
        var province = $(this).val()
        $.ajax({
            url  : "<?= Url::toRoute('/user/get-city')?>",
            type : 'post',
            data : {'id':province},
            dataType:'text',
            success:function(data){
                $('#city').html(data)
                $('#area').html("<option value='0'>--区--</option>")
            }
        });
    })

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
