<?php
use yii\helpers\Url;

?>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/lrtk.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet"/>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/chaogu.css-v=20171204.css" rel="stylesheet"/>
<div class="clearborth"></div>

<div class="nbody">
    <div class="nw1000 f-clear help-center">
        <div class="nleftless help-center-nav">
            <div class="help-center-logo">
                <img src="<?= Url::base() ?>/frontend/web/xnn/images/help_logo.png"/>
            </div>
            <div class="subNavBox help-center-navbox">
                <div class="subNav currentDd currentDt" style="display:none">关于我们</div>
                <ul class="navContent" style="display:block"></ul>
                <div class="subNav currentDd currentDt" style="display:none">使用指南</div>
                <ul class="navContent" style="display:block">
                    <?php foreach($nav as $list){?>
                    <li><a href="<?=Url::toRoute(['news/help','cid'=>$list->id])?>" <?=$list->id==Yii::$app->request->get('cid')?'class="ada"' : ''?>><?=$list->name?></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <div class="nrightmore help-center-con">

            <div class="biaoti_top">
                <span class="bigtitle"><?=$detail->title?></span>
            </div>
            <div class="content_text">
                <?=$detail->contact?>
            </div>
        </div>
    </div>
</div>
<div class="clearborth"></div>

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

<script type="text/javascript">
    $(function () {
        var call_index = "playdesc";
        if (call_index == "about") {
            $("#about").addClass("now");
        } else {
            $("#guidance").addClass("now");
        }
        $(".subNav").click(function () {
            $(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd")
            $(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt")
            // 修改数字控制速度， slideUp(500)控制卷起速度
            $(this).next(".navContent").slideToggle(500).siblings(".navContent").slideUp(500);
        });
    });
</script>

<div class="kefu">
    <ul>

        <li class="l3" style="display: none;">
            <a href="javascript:;"></a>
            <div class="hide3">
                <a target="_blank"><span>客服一</span><br/><i></i></a><a target="_blank"><span>qq交流群</span><br/><i></i></a>
            </div>
        </li>
        <li class="l4"><a href="#page1" id="scrollTop"></a></li>
    </ul>
</div>
</body>
</html>
