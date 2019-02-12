<?php
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');?>
    <style>
        .search_list{background: #20212a;padding-left: .2rem}
        .search_list ul li{line-height: .3rem}
        .search_list ul li a{display: inline-block;width: 100%;color: red}
        .search_list .stock_name{margin-left: .15rem}
    </style>
<?php $this->endBlock()?>

<!--head-->
<div class="head">
    <span>自选股</span>
    <i class="dmfont searchCode dm-sousuo"></i>
</div>
<!--head end-->
<!--searchCodeBox-->
<div class="searchCodeBox animated bounceInDown">
    <div class="searchCodeBoxInput fl">
        <i class="dmfont dm-sousuo"></i>
        <input type="text" placeholder="请输入代码/名称" class="searText">
    </div>
    <span class="closeSearBox fl tc">取消</span>
    <div class="clear"></div>
    <div class="search_list">
        <ul>
        </ul>
    </div>
</div>
<script>
    $(function(){
        $(".searchCode").click(function(){
            $(".searchCodeBox").show();
            $("#cover").show();
            $(".searText").focus();
        });
        $(".closeSearBox").click(function(){
            $(".searchCodeBox").hide();
            $("#cover").hide();
        })
    })
</script>
<!--searchCodeBox end-->

<!--tab-->
<div class="tranTab">
    <div class="chooseMyself ttList fl">
        <a href="<?= Url::to(['quote/self-select'])?>" class="selected">
            <span>自选股</span>
        </a>
    </div>
    <div class="tranTabList ttList ttListMy fl">
        <div class="swiper-container swiper1">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="<?= Url::to(['index/quote'])?>"><span>A股</span></a></div>
                <?php foreach ($categories as $list) : ?>
                    <div class="swiper-slide"><a href="<?= Url::to(['index/quote', 'cate_id' => $list['id']])?>"><span><?= $list->name ?></span></a></div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<!--tab end-->

<div class="myChooseNav">
    <div class="myChooseNav_list fl">
        <ul>
            <li>
                <h1 class="green"><?= number_format($info[0]['opening_price'], 2) ?></h1>
                <p>上证<span class="green"><?= $info[0]['frice_fluctuation'] ?>%</span></p>
            </li>
            <li>
                <h1 class="red"><?= number_format($info[1]['opening_price'], 2)?></h1>
                <p>深成<span class="red"><?= $info[1]['frice_fluctuation'] ?>%</span></p>
            </li>
            <li>
                <h1 class="green"><?= number_format($info[2]['opening_price'], 2)?></h1>
                <p>创业板<span class="green"><?= $info[2]['frice_fluctuation'] ?>%</span></p>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="myChooseNav_news fl tc">
        <a href="<?= Url::to(['index/news']) ?>">
            <i class="dmfont dm-xinwen"></i>
            <p>资讯</p>
        </a>
    </div>
    <div class="clear"></div>
</div>

<!--tableHead-->
<div class="qml_center_head qml_my_head">
    <span class="qmlch_one">全部自选</span>
    <span class="qmlch_two">最新价</span>
    <span class="qmlch_three">涨跌价</span>
    <span class="qmlch_four">涨跌幅</span>
    <div class="clear"></div>
</div>
<!--tableHead end-->


<!--main-->
<div class="quote_main myChooseMain">
    <div class="quote_main_list qml_item">
        <div class="qml_center_con">

            <ul>
<!--                --><?php //foreach ($optionlist as $vo){?>
<!--                <li>-->
<!--                    <a href="">-->
<!--                        <span class="qcc_one">-->
<!--                            <i class="title">--><?//=$vo['name']?><!--</i>-->
<!--                            <i class="code">--><?//=$vo['code']?><!--</i>-->
<!--                        </span>-->
<!--                        <span class="qcc_two">-->
<!--                            <em class="red">6.34</em>-->
<!--                        </span>-->
<!--                        <span class="qcc_two">-->
<!--                            <em class="red">+0.58</em>-->
<!--                        </span>-->
<!---->
<!--                        <span class="qcc_four">-->
<!--                            <i class="amp bg_red">+5.96%</i>-->
<!--                        </span>-->
<!---->
<!--                    </a>-->
<!--                </li>-->
<!--                --><?php //}?>
            </ul>

        </div>
    </div>

<!--    <div class="addChoose tc searchCode">-->
<!--        <i class="dmfont dm-icon-add"></i>-->
<!--        <span >添加自选股</span>-->
<!--    </div>-->

</div>
<!--main end-->
    <!--遮罩层-->
    <div id="cover"></div>

<script>
    $(function() {
        function setCurrentSlide(ele, index) {
            $(".swiper1 .swiper-slide").removeClass("selected");
            ele.addClass("selected");
            //swiper1.initialSlide=index;
        }
        var swiper1 = new Swiper('.swiper1', {
//					设置slider容器能够同时显示的slides数量(carousel模式)。
//					可以设置为number或者 'auto'则自动根据slides的宽度来设定数量。
//					loop模式下如果设置为'auto'还需要设置另外一个参数loopedSlides。
            slidesPerView: 5.5,
            paginationClickable: true,//此参数设置为true时，点击分页器的指示点分页器会控制Swiper切换。
            spaceBetween: 10,//slide之间的距离（单位px）。
            freeMode: true,//默认为false，普通模式：slide滑动时只滑动一格，并自动贴合wrapper，设置为true则变为free模式，slide会根据惯性滑动且不会贴合。
            loop: false,//是否可循环
            onTab: function(swiper) {
                var n = swiper1.clickedIndex;
            }
        });

    });

    var marketList = '<?= $marketList ?>';
    getMarket(marketList);

    function getMarket (marketList) {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/?user=lision&&pwd=c113a045bb7169e9012ccbada264be40&show=json',
            type: 'POST',
            async: true,
            data: {list: marketList},
            dataType: 'json',
            error: function () {
                setTimeout('getMarket()', 5000);
            },
            success: function (res) {
                var data = res.data;
                // console.log(data)
                if (res.status == '00') {
                    var html = '';
                    data.forEach(function (item, index) {
                        html += `<li>
                        <a href="/quote/detail?code=${item.code}&title=${item.name}">
                            <span class="qcc_one">
                                <i class="title">${item.name}</i>
                                <i class="code">${item.code.substr(2)}</i>
                            </span>
                            <span class="qcc_two"><em class="red">${item.new_price}</em></span>
                            <span class="qcc_two"><em class="${item.fluctuation > 0 ? 'red' : 'green' }">${item.fluctuation}</em></span>
                            <span class="qcc_four"><i class="amp ${item.frice_fluctuation > 0 ? 'bg_red' : 'bg_green' }">${item.frice_fluctuation}</i></span>
                        </a>
                    </li>`;
                    });
                    $('.qml_center_con ul').html('').append(html);
                }
                setTimeout('getMarket()', 5000);
            }
        })
    }

    $('.searText').keyup(function () {
        var text = $('.searText').val();
        $.get('<?= Url::to(['index/search-stock'])?>', {text: text}, function (res) {
            var content = '';
            if (res.status === 200) {
                res.data.forEach(function (item, index) {
                    content += `<li><a href="/quote/detail?code=${item.new_code}&title=${item.name}">${item.code}<span class="stock_name">${item.name}<span></a></li>`;
                })
            } else {
                content = `<li><a href="javascript:;">${res.msg}</a></li>`;
            }
            console.log(content)
            $('.search_list ul').empty().append(content)
        }, 'json');
    })
</script>

<?php $this->beginContent('@app/views/layouts/footer.php');?>
<?php $this->endContent()?>