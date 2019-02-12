
<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--main -->
<div class="buy_main">

    <div class="buy_main_top">

        <div class="bmt_input">
            <input type="text" class="stockCode" placeholder="股票代码 / 名称">
        </div>

        <div class="pupBox_list">

            <ul>
                <li>
                    <div class="pupBox_list_change">
                        <button class="reduceNum">－</button>
                        <input type="number" value="4.33" class="num" placeholder="买入价">
                        <button class="addNum">＋</button>
                    </div>

                    <div class="pupBox_list_bot">
                        <span>跌停<i class="num green">4.17</i></span>
                        <span class="fr">涨停<i class="num red">4.97</i></span>
                    </div>
                </li>

                <li>
                    <div class="pupBox_list_change">
                        <button class="reduceNum">－</button>
                        <input type="number" value="100" class="num" placeholder="买入量">
                        <button class="addNum">＋</button>
                    </div>

                    <div class="pupBox_list_bot">
                        <em>可买<i class="num">0</i>股</em>
                    </div>
                </li>

                <div class="clear"></div>
            </ul>

        </div>

        <div class="pupBox_label">
            <label class="selected">全仓</label>
            <label>半仓</label>
            <label>1/3仓</label>
            <label>2/3仓</label>
            <label>1/4仓</label>
            <div class="clear"></div>
        </div>

        <div class="pupBox_submit">
            <button>买入</button>
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
            <tr>
                <td>森莫电气</td>
                <td>600000</td>
                <td>2018/12/23 15:35:23</td>
                <td class="red">4.14</td>
                <td class="orange">待审核</td>
            </tr>
            <tr>
                <td>森莫电气</td>
                <td>600000</td>
                <td>2018/12/23 15:35:23</td>
                <td class="red">4.14</td>
                <td class="orange">待审核</td>
            </tr>
            <tr>
                <td>森莫电气</td>
                <td>600000</td>
                <td>2018/12/23 15:35:23</td>
                <td class="red">4.14</td>
                <td class="orange">待审核</td>
            </tr>
            <tr>
                <td>森莫电气</td>
                <td>600000</td>
                <td>2018/12/23 15:35:23</td>
                <td class="red">4.14</td>
                <td class="orange">待审核</td>
            </tr>
            <tr>
                <td>森莫电气</td>
                <td>600000</td>
                <td>2018/12/23 15:35:23</td>
                <td class="red">4.14</td>
                <td class="orange">待审核</td>
            </tr>
            <tr>
                <td>森莫电气</td>
                <td>600000</td>
                <td>2018/12/23 15:35:23</td>
                <td class="red">4.14</td>
                <td class="orange">待审核</td>
            </tr>

        </table>

    </div>

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