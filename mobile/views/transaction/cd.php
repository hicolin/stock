
<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>
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
<style>
    #stock_name{
        width: 50%;float: left;    height: 0.35rem;
        border: 1px solid #3b87f1;
        font-size: 0.14rem;
        font-weight: bold;
        color: #cccccc;
        padding-left: 0.1rem;
        background: none;
        border-radius: 3px;
    }
</style>
<!--main -->
<div class="buy_main">

    <div class="buy_main_top">

        <div class="bmt_input">
            <select class="buy-info-stock" id="stock_name" name="stock_name">
                <option>请选择</option>
                <?php foreach($cdlist as $vo){?>
                    <option money="<?=$vo['order_my_money']?>" max="<?=$vo['order_hander']?>" code="<?=$vo['goods_code']?>" value="<?=$vo['id']?>" ><?=$vo['goods_name']?></option>
                <?php }?>
            </select>
            <input style="width: 50%;" type="text" class="stockCode" value="" placeholder="股票代码 / 名称">
            <input style="width: 50%;" type="hidden" class="stockid" value="" placeholder="股票id">
        </div>

        <div class="pupBox_list">

            <ul>
                <li>
                    <div class="pupBox_list_change">
                        <button class="reduceNum">－</button>
                        <input type="number" value="" class="num order_price" placeholder="委托价">
                        <button class="addNum">＋</button>
                    </div>
                </li>

                <li>
                    <div class="pupBox_list_change">
                        <button class="reduceNum">－</button>
                        <input type="number" value="" class="num salenum" placeholder="委托数量">
                        <button class="addNum">＋</button>
                    </div>


                </li>

                <div class="clear"></div>
            </ul>

            <div class="pupBox_list_bot">
                <span class="dt">现价<i class="num green new_price"></i></span>
                <span class="dt">跌停<i class="num green downstop"></i></span>
                <span class="fr">涨停<i class="num red upstop"></i></span>
            </div>

        </div>
        <div class="pupBox_submit">
            <button onclick="cdapply();">确认撤单</button>
        </div>

    </div>
    <div class="h10"></div>

    <div class="buy_main_list">

        <table>
            <tr>
                <th>名称</th>
                <th>代码</th>
                <th>时间</th>
                <th>价格</th>
                <th>状态</th>
            </tr>
            <?php foreach ($cdlist as $v){?>
            <tr>
                <td><?=$v->goods_name?></td>
                <td><?=$v->goods_code?></td>
                <td><?=date('Y/m/d H:i:s',$v->begin_time)?></td>
                <td class="red"><?=$v->order_real_money?></td>
                <td class="orange"><?=$status[$v->status]?></td>
            </tr>
            <?php }?>
        </table>

    </div>

</div>


<!--main end-->

<script>

    $('select#stock_name').change(function(){
        var code = $(this).find("option:selected").attr("code");
        var max=$(this).find("option:selected").attr("max");
        var money=$(this).find("option:selected").attr("money");
        var id=$(this).find("option:selected").attr("value");
        $('.stockCode').val(code);
        $('.salenum').val(max);
        $('.order_price').val(money);
        $('.stockid').val(id);
        getMarket();
    });

    function getMarket() {
        var code = $('.stockCode').val();
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/?user=lision&&pwd=c113a045bb7169e9012ccbada264be40&show=json',
            type: 'POST',
            async: true,
            data: {list: code},
            dataType: 'json',
            error: function () {
                setTimeout('getMarket()', 10000);
            },
            success: function (res) {
                if (res.status == '00') {
                    var data = res.data[0];
                    $('.new_price').html(data.new_price);
                    $('.downstop').html((data.settlement_yesterday * (1 - 10 / 100)).toFixed(3));
                    $('.upstop').html((data.settlement_yesterday * (1 + 10 / 100)).toFixed(3));

                }
                setTimeout('getMarket()', 10000);
            }
        })
    }

    function cdapply() {
        var id = $('.stockid').val();
        var _csrf= "<?=Yii::$app->request->csrfToken?>";
        if(!id){
            layerMsg("请选择股票！");return;
        }
        $.ajax({
            url: "<?=Url::toRoute(['transaction/cdcomfirm'])?>",
            type: "post",
            data: {
                id:id,
                _csrf:_csrf,
            },
            dataType: "json",
            success: function (data) { //如果调用php成功
                if(data.status ==100){
                    layerMsg(data.info);
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                }else{
                    layerMsg(data.info);
                    setTimeout(function () {
                        location.reload();
                    }, 2000)
                }
            }
        });


    }

</script>






</body>
</html>