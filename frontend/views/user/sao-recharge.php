
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
            div#sm_type{display: flex;align-items: center;}
            div#sm_type span{margin-right: 20px;border: 1px solid #eee;border-radius: 2px;display:inline-block;width: 76px;height: 30px;text-align: center;line-height: 30px;cursor: pointer;}
            div#sm_type span.on{background: #ff0000;color: #fff;border: 1px solid #ff0000;}
        </style>
        <div class="nrightmore">
            <div class="zhsz">
                <div class="modou hongbao">
                    <ul class="modoudul">
                        <li style="display: block;"><a href="<?=Url::toRoute(['user/recharge-money'])?>" class="">快捷支付</a></li>
                        <li style="display: block;"><a href="<?=Url::toRoute(['user/line-recharge'])?>" class="">银行转账</a></li>
                        <li style="display: block;"><a href="<?=Url::toRoute(['user/sao-recharge'])?>" class="ada">扫码支付</a></li>
                    </ul>
                    <!-- 扫码支付 -->
                    <div class="modoudcon" style="display: block;" id="symdc6">
                        <div class="clearfix" data-title="认证支付" style="display: block;">
                            <form id="form6" method="post" onsubmit="return false;">
                                <table class="cz_two" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <th style="color: red; width: 190px;">选择您转账方式</th>
                                        <td>
<!--                                            <select name="sm_type" id="sm_type">-->
<!--                                                <option value="weiXin">微信</option>-->
<!--                                                <option value="zhiFuBao">支付宝</option>-->
<!--                                            </select>-->

                                            <div name="sm_type" id="sm_type">
                                                <span kind="weiXin" class="on">微信</span>
                                                <span kind="zhiFuBao">支付宝</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="weiXin">
                                        <th>&nbsp;
                                        </th>
                                        <td>手机扫一扫，快速转账<br>
                                            <img src="<?=Common::getSysInfo(74)?>" width="300">
                                        </td>
                                    </tr>
                                    <tr id="zhiFuBao" style="display: none">
                                        <th>&nbsp;
                                        </th>
                                        <td>手机扫一扫，快速转账<br>
                                            <img src="<?=Common::getSysInfo(75)?>" width="300">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td" style="text-align: right;">转账信息：</td>
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
                                        <th>转账凭证</th>
                                        <td>
                                            <img id="pz" src="<?=Url::base()?>/frontend/web/xnn/images/timg.jpg" onclick="upload('pz')" style="width: 100px;height: 150px"></td>
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
    $("#sm_type span").click(function () {
        $(this).addClass("on").siblings().removeClass("on");
       var val = $(this).attr("kind");
      if(val==='weiXin'){
          $('#weiXin').show();
          $('#zhiFuBao').hide();
      }else if(val==='zhiFuBao'){
          $('#zhiFuBao').show();
          $('#weiXin').hide();
      }
    });
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



