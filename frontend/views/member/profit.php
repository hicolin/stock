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
                        <li><a href="" class="current">我要提盈</a></li>
                        <li><a href="">提盈记录</a></li>
                    </ul>
                </div>
                <div class="cn style_content style_content0">
                    <div style="display:block;" class="ul" id="nav_cont1">
                        <form action=" " onsubmit="return login_form();" method="post">
                            <div class="nrbox"><span class="tit1">股票帐户余额</span><span
                                    class="price">自行查看是否符合提盈条件</span><br>
                                <span class="tit1">股票帐户</span>
                                <select name="Hsname">
                                    <option value="">账户1</option>
                                    <option value="">账户2</option>
                                </select>
                                <br>
                                <span class="tit1">提盈金额</span>
                                <input id="withdrawalvalue" name="money" type="text" class="text"
                                       title="请正确填写提款余额~float!">
                                元<br>
                                <br>
                                <input onclick="" type="submit" value="提交" class="btn">
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
        var withdrawalvalue = $("#withdrawalvalue").val();
        if (withdrawalvalue == "") {
            layer.tips('请正确填写提款余额~float!', $("#withdrawalvalue"), {tips: 2, time: 2000});
            return false;
        }
        else {
            return true;
        }
    }
</script>
