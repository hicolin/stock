<?php
use yii\helpers\Url;

?>
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
                        <li><a href="<?=Url::toRoute(['member/withdraw'])?>" >我要提款</a></li>
                        <li><a href="<?=Url::toRoute(['member/withdraw-record'])?>">提款记录</a></li>
                      <!--  <li><a href="<?/*=Url::toRoute(['member/bank-card-manage'])*/?>" class="current">银行卡管理</a></li>-->
                    </ul>
                    <span class="clear_f"></span></div>
                <div class="cn style_content style_content0">
                    <div style="display:block;" class="ul" id="nav_cont1">
                        <form action=" " onsubmit="return login_form();" method="post">
                            <div class="nrbox">
                                <div class="tit">管理银行卡</div>
                                <span class="tit1">开户名</span> <span> 您尚未实名认证</span> <a style="color:red"
                                                                                       href="<?=Url::toRoute(['member/security'])?>">马上认证</a> <br>
                                <span class="tit1">开户银行</span>
                                <select name="addBankCode" onblur="getkaihubank('xz');" title="请选择一个选项~!"
                                        id="addBankCode">
                                    <option value="">请选择银行</option>
                                    <option value="5">中国工商银行</option>
                                    <option value="6">中国农业银行</option>
                                    <option value="7">中国建设银行</option>
                                    <option value="16">成都银行</option>
                                    <option value="17">招商银行</option>
                                    <option value="18">中国银行</option>
                                    <option value="19">中国光大银行</option>
                                    <option value="20">中国邮政储蓄银行</option>
                                    <option value="21">兴业银行</option>
                                    <option value="15">交通银行</option>
                                    <option value="14">中信银行</option>
                                    <option value="13">华夏银行</option>
                                    <option value="12">上海浦东发展银行</option>
                                    <option value="22">其他银行</option>
                                </select>
                                <br>
                                <span class="tit1">开户行所在地</span>
                                <select class="s1" id="c1" name="ProvinceId" title="请选择一个选项~!">
                                    <option value="0" selected="selected">请选择省份</option>
                                    <option value="1">北京</option>
                                    <option value="1">北京</option>
                                    <option value="2">天津</option>
                                    <option value="2">天津</option>
                                    <option value="3">河北</option>
                                    <option value="3">河北</option>
                                    <option value="4">山西</option>
                                    <option value="4">山西</option>
                                    <option value="5">内蒙古</option>
                                    <option value="5">内蒙古</option>
                                    <option value="6">辽宁</option>
                                    <option value="6">辽宁</option>
                                    <option value="7">吉林</option>
                                    <option value="7">吉林</option>
                                    <option value="8">黑龙江</option>
                                </select>
                                <select class="s1" id="c2" name="CityId" title="请选择一个选项~!">
                                    <option value="0">请选择城市</option>
                                </select>
                                <input value="" name="bankAddress" class="text" style="width:200px" id="bankAddress">
                                <div style="display:none">
                                    <select id="provincecode" name="provincecode"
                                            onchange="javascript:selectchange(province,city);getkaihubank();"
                                            class="s1">
                                        <option value="0">安徽</option>
                                        <option value="1">北京</option>
                                        <option value="2">重庆</option>
                                        <option value="3">福建</option>
                                        <option value="4">甘肃</option>
                                        <option value="5">广东</option>
                                        <option value="6">广西</option>
                                        <option value="7">贵州</option>
                                        <option value="8">海南</option>
                                        <option value="9">河北</option>
                                        <option value="34" selected="selected">请选择省</option>
                                    </select>
                                    <select class="s1" id="citycode" name="citycode" onchange="getkaihubank('xz');">
                                        <option></option>
                                        <option value="3400">请选择</option>
                                    </select>
                                    <select class="easyui-combobox combobox-f combo-f" id="selectbankno"
                                            style="width: 250px; display: none;">
                                    </select>
                  <span class="combo" style="width: 248px; height: 20px;">
                  <input type="text" class="combo-text validatebox-text" autocomplete="off"
                         style="width: 226px; height: 20px; line-height: 20px;">
                  <span><span class="combo-arrow" style="height: 20px;"></span></span>
                  <input type="hidden" class="combo-value" value="">
                  </span></div>
                                <br>
                                <span class="tit1">银行卡号</span>
                                <input type="text" id="changbankno" name="changbankno" value="" class="text1">
                                <span id="bankmsg" style="color:red"></span><br>
                                <input type="submit" value="保存" class="btn">
                            </div>
                        </form>
                    </div>
                </div>
                <span class="clear_f"></span></div>
        </div>
        <div class="clear"></div>
        <!-- right end -->
    </div>
</div>
<script type="text/javascript">
    function login_form() {
        var addBankCode = $("#addBankCode").val();
        var bankAddress = $("#bankAddress").val();
        var changbankno = $("#changbankno").val();
        if (addBankCode == "") {
            layer.tips('请选择银行!', $("#addBankCode"), {tips: 2, time: 2000});
            return false;
        }

        else if (bankAddress == "") {
            layer.tips('请正确填写开户行名称~2-36:!', $("#bankAddress"), {tips: 2, time: 2000});
            return false;
        }

        else if (changbankno == "") {
            layer.tips('请正确填写银行卡号~12-36:!', $("#changbankno"), {tips: 2, time: 2000});
            return false;
        }

        else {
            return true;
        }
    }
</script>
