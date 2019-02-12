<?php
use yii\helpers\Url;

?>
<style>

    .qhbox .style_content0 .list .box2 {

        margin: 0 65px;
    }
</style>
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/withdrawal.css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/recharge.css">
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
                        <li><a href="<?=Url::toRoute(['member/withdraw'])?>" class="current">我要提款</a></li>
                        <li><a href="<?=Url::toRoute(['member/withdraw-record'])?>">提款记录</a></li>
                        <!--<li><a href="<?/*=Url::toRoute(['member/bank-card-manage'])*/?>">银行卡管理</a></li>-->
                    </ul>
                    <span class="clear_f"></span></div>
                <div class="cn style_content style_content0">
                    <div style="display:block;" class="ul" id="nav_cont1">


                            <div class="nrbox">
                                <span class="tit1">账户余额</span>
                                <span class="price"><?=$onelist['money']?></span>元
                                <span style="width:150px;" class="tit1">提款手续费</span>
                                <span class="price"><?=$service_money?></span>元
                                <br>
                                <span class="tit1">提款银行卡</span>
                                <select name="addBankCode" onblur="getkaihubank('xz');" title="请选择一个选项~!"
                                        id="addBankCode">
                                    <option value="">请选择银行</option>
                                    <option value="中国工商银行">中国工商银行</option>
                                    <option value="中国农业银行">中国农业银行</option>
                                    <option value="中国建设银行">中国建设银行</option>
                                    <option value="成都银行">成都银行</option>
                                    <option value="招商银行">招商银行</option>
                                    <option value="中国银行">中国银行</option>
                                    <option value="中国光大银行">中国光大银行</option>
                                    <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
                                    <option value="兴业银行">兴业银行</option>
                                    <option value="交通银行">交通银行</option>
                                    <option value="中信银行">中信银行</option>
                                    <option value="华夏银行">华夏银行</option>
                                    <option value="上海浦东发展银行">上海浦东发展银行</option>
                                    <option value="其他银行">其他银行</option>
                                </select>
                                <br>

                               <!-- 我添加的内容开始-->
                                <span class="tit1">开户支行</span>
                                <select style="width: 100px" name="province" id="province">
                                    <?php foreach ($province as $k => $val){ ?>
                                        <option value="<?=$val['id']?>"><?=$val['name']?></option>
                                    <?php } ?>
                                </select>
                                <select style="width: 100px" name="city" id="city">
                                    <?php foreach ($city as $k => $val){ ?>
                                        <option value="<?=$val['id']?>"><?=$val['name']?></option>
                                    <?php } ?>
                                </select>
                                <input  id="withdrawalbranch" placeholder="开户行" name="branch" type="text" class="text" style="width:150px">
                                <br/>

                                <span class="tit1">银行卡号</span>
                                <input id="withdrawalcode" name="code" type="text" class="text" style="width:300px">
                                <br/>
                                <span class="tit1">绑定手机号</span>
                                <input id="tel" name="tel" type="text" class="text" style="width:300px">
                                <br/>
                                <span class="tit1">收款人姓名</span>
                                <input id="name" name="name" type="text" class="text" style="width:300px">
                                <br/>
                                <span class="tit1">提款余额</span>
                                <input id="withdrawalvalue" name="money" type="text" class="text">
                                元<br>


                               <!-- 我添加的内容结束-->
                                <span class="tit1">提款密码</span>
                                <input id="withdrawalpass" name="paypwd" type="password" class="text">
                                <input  name="totalmoney" type="hidden" class="text" value ="<?=$onelist['money']?>" >
                                <!--<a href=" " class="blue">设置密码</a>-->
                                <input style="display: none" id="isTradePassEmpty" value="1">
                                <br>

                                <input  type="button" value="提交"  id="sub_btn" class="btn">
                            </div>

                        <div class="list">
                            <div class="fl box1">
                                <div class="tit">最快<span class="red">5分钟</span>到账</div>
                                最快5分钟，一般情况10分钟内到账(节假日除外)
                            </div>
                            <div class="fl box2">
                                <div class="tit">提款<span class="lv"><?=$service_money?>元</span>手续费</div>
                                提款产生的银行手续费全免
                                更多优质服务只在红豆金融
                            </div>
                            <div class="fl box3">
                                <div class="tit">支持多家银行</div>
                                推荐您使用工商银行、建设银行、
                                招商银行、农业银行提款，到账最快
                            </div>
                            <span class="clear_f"></span></div>
                        <div class="tag">温馨提示：禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用。</div>
                    </div>
                </div>
                <span class="clear_f"></span></div>
        </div>
        <div class="clear"></div>
        <!-- right end -->
    </div>
</div>

<script type="text/javascript">
   /* function login_form() {
        var withdrawalvalue = $("#withdrawalvalue").val();
        var withdrawalpass = $("#withdrawalpass").val();
        if (withdrawalvalue == "") {
            layer.tips('请正确填写提款余额~float!', $("#withdrawalvalue"), {tips: 2, time: 2000});
            return false;
        }

        else if (withdrawalpass == "") {
            layer.tips('请正确填写提款密码~2-36:!', $("#withdrawalpass"), {tips: 2, time: 2000});
            return false;
        }


        else {
            return true;
        }
    }*/

    $('#sub_btn').click(function(){

        var withdrawalvalue = $("#withdrawalvalue").val();

        var withdrawalpass = $("#withdrawalpass").val();
        var withdrawalbranch = $("#withdrawalbranch").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var tel = $("#tel").val();
        var name = $("#name").val();
        var withdrawalcode = $("#withdrawalcode").val();
        var addBankCode = $("#addBankCode").val();
        var pattern = /^([1-9]{1})(\d{14}|\d{18})$/;
        var getCsrfToken = "<?=Yii::$app->getRequest()->getCsrfToken()?>";
        if (withdrawalvalue == "") {
            layer.tips('请正确填写提款余额~float!', $("#withdrawalvalue"), {tips: 2, time: 2000});
            return false;
        }
        else if(addBankCode =="")
        {
            layer.tips('请选择银行', $("#addBankCode"), {tips: 2, time: 2000});
            return false;
        }
        else if(isNaN(withdrawalvalue))
        {
            layer.tips('请正确填写提款余额~float1!', $("#withdrawalvalue"), {tips: 2, time: 2000});
            return false;
        }


        else if (withdrawalpass == "") {
            layer.tips('请正确填写提款密码~2-36:!', $("#withdrawalpass"), {tips: 2, time: 2000});
            return false;
        }
        else if (withdrawalbranch == "") {
            layer.tips('请正确填写开户支行~2-36:!', $("#withdrawalbranch"), {tips: 2, time: 2000});
            return false;
        }
        else if (withdrawalcode == "") {
            layer.tips('请正确填写银行卡号~2-36:!', $("#withdrawalcode"), {tips: 2, time: 2000});
            return false;
        }
        else if(isNaN(withdrawalcode))
        {
            layer.tips('请正确填写银行卡号~float1!', $("#withdrawalcode"), {tips: 2, time: 2000});
            return false;
        }
            else if(!pattern.test(withdrawalcode))
        {
            layer.tips('请正确填写银行卡号~float1!', $("#withdrawalcode"), {tips: 2, time: 2000});
            return false;
        }
        else if(name == '')
        {
            layer.tips('请输入收款人姓名', $("#name"), {tips: 2, time: 2000});
            return false;
        }
        else if(tel == '')
        {
            layer.tips('请输入手机号', $("#tel"), {tips: 2, time: 2000});
            return false;
        }
       else if(!(/^1[34578]\d{9}$/.test(tel)))
        {
            layer.tips('请输入正确的手机号', $("#tel"), {tips: 2, time: 2000});
            return false;
        }

        else {

            $.ajax({
                type: 'post',
                url: '<?=Url::toRoute("member/withdraw")?>',
                async: false,
                data: {'money': withdrawalvalue,
                    'tx_pwd': withdrawalpass,
                    'addBankCode': addBankCode,
                    'code': withdrawalcode,
                    'branch': withdrawalbranch,
                    'province':province,
                    'city':city,
                    'tel':tel,
                    'name':name,
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
                    if(msg == 666) {

                        layer.msg('提交成功',{time:2000},function(){
                           window.location.reload();
                        })
                    }
                    else if(msg == 22)
                    {
                        layer.msg('请输入手机号',{time:2000})
                    }
                    else if(msg == 2)
                    {
                        layer.msg('取款金额必须大于手续费',{time:2000})
                    }
                    else if(msg == 11)
                    {
                        layer.msg('取款密码错误',{time:2000})
                    }
                    else if(msg == 200)
                    {
                        layer.msg('输入金额错误',{time:2000})
                    }
                    else if(msg == 300)
                    {
                        layer.msg('余额不足',{time:2000})
                    }
                    else if(msg == 100){
                        layer.msg('取款密码错误',{time:2000})
                    }
                    else
                    {

                        layer.msg('提交失败',{time:2000})
                    }
                }
            });
        }

    });
</script>
<script>
    $(document).ready(function () {
        $('#province').change(function () {
            $.get("<?php echo Url::toRoute('/member/getcity1'); ?>", //获取地区的URL
                {provice_id: $('#province').val()},
                function (data) {
                    var options = '';
                    for (i in data) {
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    $("#city").html(options); // 数据插入到地区下拉表！
                });
        })


        $(function(){
            $.get("<?php echo Url::toRoute('member/getcity1'); ?>", //获取地区的URL
                {city_id: $('#province').val()},
                function (data) {
                    var options = '';
                    for (i in data) {
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    $("#city").html(options); // 数据插入到地区下拉表！
                }
            );
        })

    });
</script>