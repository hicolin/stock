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

<!--main -->
<div class="buy_main">

    <div class="buy_main_list">

        <table>
            <tr>
                <th>名称</th>
                <th>代码</th>
                <th>时间</th>
                <th>状态</th>
            </tr>

            <?php foreach ($todaylist as $v){?>
            <tr>
                <td><?=$v->goods_name?></td>
                <td><?=$v->goods_code?></td>
                <td><?=$v->end_time?date('Y-m-d H:i:s',$v->end_time):date('Y-m-d H:i:s',$v->begin_time)?></td>
                <td class="orange"><?=$status[$v->status]?></td>
            </tr>
            <?php }?>

        </table>
        <?php if(empty($todaylist)){?>
            <?php $this->beginContent('@app/views/layouts/empty.php');?>
            <?php $this->endContent();?>
        <?php }?>
    </div>

</div>


<!--main end-->






</body>
</html>