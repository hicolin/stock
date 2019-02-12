<?php
use yii\helpers\Url;
use backend\models\AdminMember;
use backend\models\AdminSetting;
$uid=Yii::$app->session->get('user_id');
$member= AdminMember::findOne($uid);
$bank_user = AdminSetting::findOne(29)->val;
$bank_card = AdminSetting::findOne(28)->val;
$back_name = AdminSetting::findOne(27)->val;
$pic = AdminSetting::findOne(64)->val;
?>
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/recharge.css">
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">

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
                        <li><a href="<?=Url::toRoute(['member/recharge'])?>" >第三方支付</a></li>
                        <li><a href="<?=Url::toRoute(['member/bank-giro'])?>" class="current">银行转账</a></li>
                        <li><a href="<?=Url::toRoute(['member/recharge-record'])?>" class="">充值记录</a></li>
                        <li><a href="<?=Url::toRoute(['member/bank-record'])?>" class="">银行转账记录</a></li>
                    </ul>
                    <span class="clear_f"></span></div>

                <div class="cn style_content style_content0">

                    <div class="ul ul3" id="nav_cont2" style="height: 600px; display: block;">
                        <?php if($open == 2){ ?>
                            银行转账暂时未开启
                            <?} else{ ?>
                            您可以通过网上银行或银行柜台向红豆金融转账（手续费最多一笔50元）
                        <table class="table" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td class="imgtd"><img src="<?=$pic?>"></td>
                                <td class="wz">帐号：<?=$bank_card?><br>
                                    户名：<?=$bank_user?><br>
                                    开户行：<?=$back_name?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div
                            style=" padding:0px; background:#fbf7cd; line-height:30px;   font-size:14px; padding-left:15px;">
                            请准确填写您的充值金额和帐单流水号
                        </div>
                        <div class="account" style="margin:10px 0px 50px">
                            <form id="mainForm" method="post" onsubmit="return login_form();" action="" enctype="multipart/form-data">
                                <table width="700">
                                    <tbody>
                                    <tr>
                                        <div style="display:block; margin:10px 0 0 0; " id="imagesShowList"></div>
                                        <td width="200"
                                            style="text-align:right; padding-right:15px; background:#eee; line-height:30px;"></td>

                                    </tr>
                                    <input type="hidden" name="bank_name" value="<?=$back_name?>">
                                    <tr>
                                        <td style="text-align:right; padding-right:15px;background:#eee; line-height:50px;">
                                            充值金额：
                                        </td>
                                        <td style="background:#f6efef"><input class="text" id="ordermoney" name="money"
                                                                              value="" type="text"
                                                                              style="line-height: 28px"></td>
                                        <td class="clear"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; padding-right:15px;background:#eee; line-height:38px;">
                                            账单流水号：
                                        </td>
                                        <td style="background:#f6efef"><input class="text" name="orders_id"
                                                                              id="payOrdersId" value="" type="text"
                                                                              style="line-height: 28px"></td>
                                        <div style="display:block; padding:10px 0 0 0; " id="imagesShowList"></div>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; padding-right:15px;background:#eee; line-height:36px;">
                                            充值方式：
                                        </td>
                                        <td style="background:#f6efef"><select name="payType">

                                                <option value="网上银行转账">网上银行转账</option>
                                                <option value="手机银行转账">手机银行转账</option>
                                                <option value="柜台转账">柜台转账</option>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align:right; padding-right:15px;background:#eee; line-height:40px;">
                                            打款凭证：
                                        </td>
                                        <td style="background:#f6efef">
                                            <div class="upLoadDivBox">

                                                <div id="preview">
                                                    <img id="imghead" width=100% height=auto border=0 src="<?=Url::base()?>/frontend/web/images/a1.png">
                                                </div>


                                                <input type="file" name="img_url"   onchange="previewImage(this)"/>

                                            </div>
                                            <div style="padding:10px 0 0 0; " id="uploadResult"></div>
                                            <div style="display:block; padding:5px 0 0 0; " id="imagesShowList"></div>

                                            <input name="imgUrl" type="text" id="imgUrl" ></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; padding-right:15px;background:#eee;  ">线下充值备注：</td>
                                        <td style="background:#f6efef"><input class="text" name="title" value=""
                                                                              style="line-height: 28px" type="text"
                                                                              title="请正确填写昵称~2-16:!"></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right; padding-right:15px;background:#eee; line-height:30px; padding:5px 15px 30px;">
                                            &nbsp;&nbsp;</td>
                                        <td style="background:#f6efef"><input type="submit" value=" 提交更新"
                                                                              class="xgxi btn1"
                                                                              style="padding:5px 10px; background:#4164c7;    color:#fff; border:0px;  font-size:14px">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <?php } ?>
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
        var ordermoney = $("#ordermoney").val();
        var payOrdersId = $("#payOrdersId").val();
        if (ordermoney == "") {
            layer.tips('请输入金额', $("#ordermoney"), {tips: 2, time: 2000});
            return false;
        }
        else if (payOrdersId == "") {
            layer.tips('请输入金额', $("#payOrdersId"), {tips: 2, time: 2000});
            return false;
        }
        else {
            return true;
        }
    }
</script>

<script type="text/javascript">
    //图片上传预览    IE是用了滤镜。
    function previewImage(file) {
        var MAXWIDTH = 100;
        var MAXHEIGHT = 73;
        var div = document.getElementById('preview');
        if (file.files && file.files[0]) {
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.onload = function () {
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width = rect.width;
                img.height = rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top + 'px';
            }
            var reader = new FileReader();
            reader.onload = function (evt) {
                img.src = evt.target.result;
            }
            reader.readAsDataURL(file.files[0]);
        }
        else //兼容IE
        {
            var sFilter = 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status = ('rect:' + rect.top + ',' + rect.left + ',' + rect.width + ',' + rect.height);
            div.innerHTML = "<div id=divhead style='width:" + rect.width + "px;height:" + rect.height + "px;margin-top:" + rect.top + "px;" + sFilter + src + "\"'></div>";
        }
    }
    function clacImgZoomParam(maxWidth, maxHeight, width, height) {
        var param = {top: 0, left: 0, width: width, height: height};
        if (width > maxWidth || height > maxHeight) {
            rateWidth = width / maxWidth;
            rateHeight = height / maxHeight;

            if (rateWidth > rateHeight) {
                param.width = maxWidth;
                param.height = Math.round(height / rateWidth);
            } else {
                param.width = Math.round(width / rateHeight);
                param.height = maxHeight;
            }
        }
        param.left = Math.round((maxWidth - param.width) / 2);
        param.top = Math.round((maxHeight - param.height) / 2);
        return param;
    }
</script>
<style type="text/css">
    #preview {
        width: 100px;
        height: 73px;
        overflow: hidden;
    }

    #imghead {
        margin-top: 0px ! improtant;
    }

    #imghead {
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);
    }
</style>
</body>
</html>