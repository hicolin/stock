
<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--main -->
<div class="sp_main">

    <div class="sp_main_con">
        <div class="sp_main_table_header fl">
            <table>
                <tr><th>代码/名称</th></tr>
                <?php foreach ($holdinglist as $v){?>
                    <tr>
                        <td>
                            <h1><?=$v->goods_name?></h1>
                            <p><?=$v->goods_code?></p>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
        <div class="sp_main_table_con fl">
            <table>
                <tr>
                    <th>持仓价格</th>
                    <th>持仓数</th>
                    <th>保证金</th>
                    <th>手续费</th>
                    <th>递延费</th>
                    <th>持仓时间</th>
                </tr>
                <?php foreach ($holdinglist as $v){?>
                    <tr>
                        <td><span><?=$v->order_real_money?></span></td>
                        <td><span><?=$v->order_hander?></span></td>
                        <td><span><?=$v->order_ly_money?></span></td>
                        <td><span><?=$v->order_charge?></span></td>
                        <td><span><?=$v->dy?></span></td>
                        <td><span class="green"><?=date('Y-m-d', $v->begin_time)?></span></td>
                    </tr>
                <?php }?>
            </table>
        </div>
        <div class="clear"></div>
    </div>

    <?php if(empty($holdinglist)){?>
        <?php $this->beginContent('@app/views/layouts/empty.php');?>
        <?php $this->endContent();?>
    <?php }?>
</div>


<!--main end-->

<script>

    $(function () {
        //    买入仓点击
        $(".pupBox_label label").click(function(){
            $(this).addClass("selected").siblings().removeClass("selected");
        });
    })



</script>






</body>
</html>