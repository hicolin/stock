<?php
use yii\helpers\Url;
?>
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/main(1).css">
<script src="<?=Url::base()?>/frontend/web/zqjs/layer/layer.js"></script>
<script src="<?=Url::base()?>/frontend/web/js/ajaxfileupload.js"></script>
<div class="wal">
    <div class="con">
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>

        <!-- right -->
        <div class="fr right" style="width: 880px">
            <div class="xinbox">

                <div class="fl img">
                    <img src="<?=$member->head_img?:'/frontend/web/images/mrt.jpg'?>" alt="上传图片" class="pho_bt" onclick="$('#hiddenFile').click()" style="width:90px;height:120px">
                    <input onChange="ajaxFileUpload()" type="file" id="hiddenFile" name="img" style="display: none;">
                </div>

                <div class="fl xin" style="width:700px;">
                    <div class="name" style="font-size:15px;height: 30px;">掌期聚财号:&nbsp;&nbsp;&nbsp;<?=$member->xgj_name?></div>
<!--                    安全等级 <span class="red" style="margin-left: 5px;">中</span>-->
                    <input onclick="cz()" type="button" class="btn1" value="充值" style="margin-left:250px">
                    <script>
                        function cz(){
                            location.href="<?=Url::toRoute(['member/recharge'])?>";
                        }
                    </script>
                    <input onclick=" " type="button" class="btn2" value="提款">
                    <br>
                    <span class="span2"><span class="balance">账户余额</span><span class="price"><?=$member->money ?></span>元
<!--                        <span class="balance">净资产</span><span class="price">100000.00</span>元</span>-->
                    <br>
                    <span class="user" style="float:left; display:block"><span class="sj sj1"></span><span
                            class="sf sf1"></span><span class="mm mm1"></span><span class="yj yj1"></span></span></div>
                <span class="clear_f"></span></div>
            <div class="nr">
                <!-- 资产 -->
<!--                <div class="detailed">-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            <div class="tit">账户总资产-->
<!--                                <div class="icon icon-help-s ml6" style="cursor: pointer;">-->
<!--                                    <div style="display: none;" class="xin_tag">-->
<!--                                        <div class="jt"></div>-->
<!--                                        <div class="tag"> 账户余额 + 冻结金额</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <span class="f20">--><?//=$member->money ?><!--</span>元-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="tit">配资金额-->
<!--                                <div class="icon icon-help-s ml6" style="cursor: pointer;">-->
<!--                                    <div style="display: none;" class="xin_tag">-->
<!--                                        <div class="jt"></div>-->
<!--                                        <div class="tag" style="top:-34px"> 短期配资金额 + 中期配资金额</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <span class="f20">0</span>元-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="tit">风险保证金-->
<!--                                <div class="icon icon-help-s ml6" style="cursor: pointer;">-->
<!--                                    <div style="display: none;" class="xin_tag">-->
<!--                                        <div class="jt"></div>-->
<!--                                        <div class="tag" style="top:-34px"> 短期配资风险保证金 + 中期配资风险保证金</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <span class="f20">0</span>元-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <div class="tit">冻结金额</div>-->
<!--                            <!--总操盘资金-->
<!--                            <span class="f20">0</span>元-->
<!--                        </li>-->
<!--                        <li style="border-right:0;">-->
<!--                            <div class="tit">账户余额</div>-->
<!--                            <span class="f20">--><?//=$member->money ?><!--</span>元-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                    <span class="clear_f"></span></div>-->

                <div class="title"><span class="tit">股票操盘列表</span>进行中<span class="red"><a href=" "
                                                                                          style="text-decoration:underline"
                                                                                          class="red">0</a></span>笔
                </div>
                <a href=" " class="a">我要配资</a>
            </div>
            <!-- 推广赚钱 -->
            <div class="extension">
                <div class="title">
                    <div class="fl tit">推广赚钱</div>
                    <div class="fr"><a href=" ">了解详情</a></div>
                    <span class="clear_f"></span></div>
                <img src="<?=Url::base()?>/frontend/web/images/tg.jpg" style="margin:50px 0"></div>
        </div>

        <!-- right end -->
        <div class="clear"></div>
    </div>
</div>
<!--图片上传-->
<script>
    function ajaxFileUpload() {

        $.ajaxFileUpload
        (
            {
                url: "<?=Url::toRoute(['member/upload1'])?>", //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: 'hiddenFile', //文件上传域的ID
                dataType: 'JSON', //返回值类型 一般设置为json
                success: function (data)  //服务器成功响应处理函数
                {
                    var obj = jQuery.parseJSON(data);
                    console.log(obj);
                    if(obj.status==200){
                      location.reload();
                    }
                },

            }
        );
        return false;
    }
</script>

