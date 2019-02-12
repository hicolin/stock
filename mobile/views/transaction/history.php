<?php
use yii\helpers\Url;
$status = [
    -1=>'委托卖出',

    4=>'委托买入中',
    0 => '待成交',
    1 => '持仓中',
    7=>'委托买入失败',

    9=>'买入委托撤单中',
    3=>'已撤销',
    6=>'委托撤单失败',

    5=>'委托卖出中',
    2 => '已结算',
    8=>'委托卖出失败',

    10=>'卖出委托撤单中',
];
?>
<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>
<script src="<?= Url::base() ?>/mobile/web/scripts/mobiscroll-master/js/mobiscroll.core.js"></script>
<link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/mobiscroll.animation.css">
<link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/mobiscroll.css">
<link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/mobiscroll2.css">
<script src="<?= Url::base() ?>/mobile/web/scripts/mobiscroll-master/js/mobiscroll.scroller.js"></script>
<script src="<?= Url::base() ?>/mobile/web/scripts/mobiscroll-master/js/mobiscroll.datetime.js"></script>
<script src="<?= Url::base() ?>/mobile/web/scripts/mobiscroll-master/js/i18n/mobiscroll.i18n.zh.js"></script>
<!--mobiscroll风格-->
<script src="<?= Url::base() ?>/mobile/web/scripts/mobiscroll-master/js/mobiscroll.scroller.android-holo.js"></script>
<style>
    .history_date{padding: 0 0.1rem;text-align: center;line-height: 30px;height: 30px;}
    .history_date input{width: 40%;height: 30px;border: 1px solid #555555;background: transparent;padding-left: 5px;color: #999999;border-radius: 5px;}
    .history_date a{color:#8D8D8D;}
</style>
<!--main -->
<div class="buy_main">
<!--    日期-->
    <div class="history_date">
        <div class="flow-query f-clear">
            <input type="text" class="fl flow-query-inp" id="stime" value="" />
            <span class="fl" style="margin: 0 0.1rem;color: #8d8d8d;font-size: 12px;">到</span>
            <input type="text" class="fl flow-query-inp" id="etime" value="" />
            <a class="dmfont dm-sousuo fr" href="javascript:" onclick="searchkey();"></a>
<!--            <div class="clear"></div>-->
        </div>
    </div>

<!--    列表-->
    <div class="buy_main_list" style="padding: 0 0.1rem;margin-top: 0.2rem;">

        <table>
            <tr>
                <th>名称</th>
                <th>代码</th>
                <th>时间</th>
                <th>状态</th>
            </tr>
            <?php foreach ($historylist as $v){?>
                <tr>
                    <td><?=$v->goods_name?></td>
                    <td><?=$v->goods_code?></td>
                    <td><?=$v->end_time?date('Y-m-d H:i:s',$v->end_time):date('Y-m-d H:i:s',$v->begin_time)?></td>
                    <td class="orange"><?=$status[$v->status]?></td>
                </tr>
            <?php }?>
        </table>
        <?php if(empty($historylist)){?>
            <?php $this->beginContent('@app/views/layouts/empty.php');?>
            <?php $this->endContent();?>
        <?php }?>

    </div>

</div>

<script>
    $(function () {
        var currYear = (new Date()).getFullYear();
        var currMonth = (new Date()).getMonth()+1;
        var currDay = (new Date()).getDate();
        var opt = {};
        opt.date = {
            preset: 'date'
        };
        opt.default = {
            theme: 'android-holo', //皮肤样式
            display: 'modal', //显示方式
            mode: 'scroller', //日期选择模式
            lang: 'zh',
            startYear: currYear - 10, //开始年份
            endYear: currYear + 10,//结束年份
            animate: 'slidedown',//动画方式
            dateFormat: 'yyyy-mm-dd',//日期格式
            dateOrder: 'yymmdd'//日期排序
        };
        $("#stime").scroller($.extend(opt['date'], opt['default'])).scroller('setDate', new Date("<?=$search['stime']?>"?"<?=$search['stime']?>":currYear-1+'-'+currMonth+'-'+currDay), true);
        $("#etime").scroller($.extend(opt['date'], opt['default'])).scroller('setDate', new Date("<?=$search['etime']?>"?"<?=$search['etime']?>":currYear+'-'+currMonth+'-'+currDay), true);
    });
    var stime = "<?=$search['stime']?>" ? "<?=$search['stime']?>": "2017-08-20", etime ="<?=$search['etime']?>" ? "<?=$search['etime']?>": "2018-08-20", ifload = "1";
    PagingData.init(2, "", { stime: stime, etime: etime, act: "deal_list_history" }, "alist", parseInt(ifload), "dataload");
    function searchkey() {
        var stime = $("#stime").val(), etime = $("#etime").val();
        window.location.href = '<?=Url::toRoute('transaction/historytrans')?>'+"?stime=" + stime + "&etime=" + etime;
    }
    function hideUnravelDetail() {
        $("#detail").hide();
    }
</script>
<!--main end-->






</body>
</html>