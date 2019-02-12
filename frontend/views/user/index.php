<?php
use yii\helpers\Url;
use common\models\Common;

?>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="<?=Url::base()?>/frontend/web/xnn/layui/layui.css">
<div class="clearborth"></div>

<div class="nbody">
    <div class="main f-clear">
        <!--member-left-->
        <?php $this->beginContent('@app/views/layouts/member-left.php') ?>
        <?php $this->endContent() ?>
        <!--end left-->
        <div class="nrightmore">
            <div class="user-right-tit"><i class="user-right-titimg"></i><a
                    href="<?= Url::toRoute(['user/index']) ?>"><b>会员中心</b></a> > <a href="javascript:;">我的主页</a></div>
            <div class="zhsz" style="margin: 20px 0;">
                <div class="zhzrtop">
                    <div class="zhzrimg">
                        <img src="<?= Url::base() ?>/frontend/web/xnn/upload/default.jpg"/>
                    </div>
                    <div class="zhzrtopcon" style="overflow: visible;">
                        <div class="zhzrtctop" style="height: auto; margin-top: -20px;">
                            <h6>
                                <span class="fl">您好~<b><?= $member->realname ?></b></span>

                                <button style="margin-left: 5px" class="layui-btn layui-btn-sm  layui-btn layui-btn-warm">平台账号</button>                      <?php if($member->state==1){?>
                                <button class="layui-btn layui-btn-radius layui-btn-sm layui-btn-normal" id="<?=$member->isopen==0?'ptAccount':''?>"><?=$member->isopen==0?'点击获取':$member->xgj_name?></button>
                                <?php } ?>
                            </h6>

                            <div class="user-money">
                                <a href="javascript:;">
                                    <i></i>可用权益：<span class="money_able c-red"><?= $member->money ?></span>元
                                </a>
                            </div>

                        </div>
                        <div class="zhzrtcbom">
                            <dl>
                                <a class="tx" href="<?= Url::toRoute(['user/withdraw-money']) ?>">提现</a>
                                <a class="cz" href="<?= Url::toRoute(['user/recharge-money']) ?>">充值</a>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="clearborth"></div>
                <div class="zcsdiv">
                    <div class="zhzc">
                        <span>信用权益(元)</span>
                        <font class="money_asset"><?= $dt_m ?: '0.00' ?></font>
                    </div>

                    <div class="djzj">
                        <span>证券市值(元)</span>
                        <font class="money_cap"><?= $z ?: '0.00' ?></font>
                    </div>

                    <div class="jdfz">
                        <span>总体权益(元)</span>
                        <font class="money_can_buy"><?= $member->money * Common::getSysInfo(71) ?></font>
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

<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/follow.js"></script>
<script src="<?= Url::base() ?>/frontend/web/xnn/scripts/layer.js"></script>

<script type="text/javascript">
    $(function () {
        money_all();//资金统计
        $("#user").addClass("now");
        $("#index").addClass("ada");
        $("#index").parent().parent().css("display", "block");
        $("#index").parent().parent().prev().addClass("currentDd currentDt");
        $(".subNav").click(function () {
            $(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd")
            $(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt")
            // 修改数字控制速度， slideUp(500)控制卷起速度
            $(this).next(".navContent").slideToggle(500).siblings(".navContent").slideUp(500);
        });
    });
    $("#ptAccount").click(function(){
        $.post('<?=Url::toRoute(['user/pt-account'])?>',{id:'<?=$member->id?>'},
            function(msg){
                if(msg.state==1){
                    layer.msg(msg.info,function(){
                        window.location.reload();
                    })
                }else{
                    layer.msg(msg.info);
                }
            },'json')
    });
</script>


