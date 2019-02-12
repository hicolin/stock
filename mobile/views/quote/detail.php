<?php
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');?>
<?php $this->endBlock();?>

<!--head-->
<div class="head">
    <div class="detail_head">
        <i class="name"><?= $this->title?></i>
        <p class="code num"><?= $code ?></p>
    </div>

    <a href="javascript:history.go(-1)" class="back">
        <i class="dmfont dm-fanhui"></i>
    </a>
    <i class="dmfont searchCode dm-refresh" onclick="location.reload()"></i>
</div>
<!--head end-->

<!--qd_nav-->
<div class="qd_nav">
    <div class="qd_nav_con pr">
        <div class="qd_nav_left fl">
            <h1 class="num red new_price"></h1>
            <h2>
                <span  class="num red upstop"></span>
                <span  class="num green downstop"></span>
            </h2>
        </div>
        <div class="qd_nav_right fl">
            <div class="qdnr_list">
                <ul>
                    <li>
                        <em>高</em>
                        <span class="num red highest_price"></span>
                    </li>
                    <li>
                        <em>开</em>
                        <span class="num red opening_price"></span>
                    </li>
                    <li>
                        <em>数量</em>
                        <span class="num volume"></span>
                    </li>
                    <li>
                        <em>低</em>
                        <span class="num minimum_price"></span>
                    </li>
                    <li>
                        <em>换</em>
                        <span class="num">0.47%</span>
                    </li>
                    <li>
                        <em>金额</em>
                        <span class="num red turnover"></span>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
        </div>
        <div class="clear"></div>

        <i class="dmfont dm-xia"></i>
    </div>

    <div class="qd_nav_list" style="z-index: 666">
        <ul>
            <li>
                <em>股票名称</em>
                <span class="fr stock_name"></span>
            </li>
            <li>
                <em>股票代码</em>
                <span class="fr num stock_code"></span>
            </li>
            <li>
                <em>昨收</em>
                <span class="fr num settlement_yesterday"></span>
            </li>
            <li>
                <em>现价</em>
                <span class="fr red num new_price"></span>
            </li>
            <li>
                <em>涨停</em>
                <span class="fr red num upstop"></span>
            </li>
            <li>
                <em>跌停</em>
                <span class="fr green num downstop">3.97</span>
            </li>
            <li>
                <em>涨跌</em>
                <span class="fr green num frice_fluctuation"></span>
            </li>
            <li>
                <em>振幅</em>
                <span class="fr  num fluctuation"></span>
            </li>
            <li>
                <em>买量</em>
                <span class="fr num buy_hands"></span>
            </li>
            <li>
                <em>卖量</em>
                <span class="fr  num sale_hands"></span>
            </li>
            <div class="clear"></div>
        </ul>

        <div class="qd_nav_list_bot tc">
            <i class="dmfont dm-shang"></i>
            <span>收起</span>
        </div>

    </div>

</div>
<div class="h5"></div>
<script>
    $(function(){
        $(".qd_nav_con").click(function(){
            if($(this).find(".dm-xia").hasClass("iconRotate")){
                $(this).find(".dm-xia").removeClass("iconRotate");
                $(".qd_nav_list").fadeOut();
            }else{
                $(this).find(".dm-xia").addClass("iconRotate");
                $(".qd_nav_list").fadeIn();
            }

        });

        $(".qd_nav_list_bot").click(function(){
            $(".dm-xia").removeClass("iconRotate");
            $(".qd_nav_list").fadeOut();
        })
    })
</script>
<!--qd_nav end-->

<!--main-->
<div class="qd_main">
    <div class="qd_main_nav">
        <ul>
            <li onclick="fenShi(minute_data_list)">
                <span>分时</span>
            </li>
            <li onclick="getdayMinK()">
                <span>日K</span>
            </li>
            <li onclick="get5MinK()">
                <span>5分</span>
            </li>
            <li onclick="get15MinK()">
                <span>15分</span>
            </li>
            <li onclick="get30MinK()">
                <span>30分</span>
            </li>
            <li onclick="get60MinK()">
                <span>60分</span>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="chart_pic">
        <div id="mpc_son_img" style="height: 250px;width: 100%"></div>
    </div>
</div>
<!--main end-->

<!--foot-->
<div class="qd_foot">
    <ul>
        <li class="buy" style="width: 30%">买入</li>
        <li class="sale" style="width: 30%" onclick="location.href = '<?= Url::to(['transaction/sale'])?>'">卖出</li>
<!--        <li class="withdrawal">-->
<!--            <i class="dmfont dm-fanhui1"></i>-->
<!--            <p>撤单</p>-->
<!--        </li>-->
        <?php if($hasOption) : ?>
            <li class="addMy" style="width: 40%">
                <i class="fa fa-minus-circle"></i>
                <p  onclick="CartDel();">移除自选</p>
            </li>
        <?php else : ?>
            <li class="addMy" style="width: 40%">
                <i class="dmfont dm-zixuan"></i>
                <p  onclick="CartIn();">加自选</p>
            </li>
        <?php endif; ?>
        <div class="clear"></div>
    </ul>
</div>
<!--foot end-->

<!--遮罩层-->
<div id="cover"></div>

<!--买入弹窗-->
<div class="buyIn_box  pupBox animated bounceInUp ">
    <i class="dmfont dm-guanbi pupClose"></i>
    <div class="pupBox_list">
        <ul>
            <li>
                <div class="pupBox_list_change buy_in_price">
                    <button class="reduceNum"></button>
                    <input type="number" value="" class="num new_price" placeholder="买入价" disabled>
                    <button class="addNum"></button>
                </div>

                <div class="pupBox_list_bot">
                    <span>涨停<i class="num red upstop"></i></span>
                    <span class="fr">跌停<i class="num green downstop"></i></span>
                </div>
            </li>
            <li>
                <div class="pupBox_list_change buy_in_num">
                    <button class="reduceNum">－</button>
                    <input type="number" value="100" class="num buy_num" placeholder="买入量">
                    <button class="addNum">＋</button>
                </div>

                <div class="pupBox_list_bot">
                    <em>最多可买<i class="num max_buy_num"> 0 </i>股</em>
                </div>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="pupBox_label">
<!--        <label class="selected">全仓</label>-->
        <label onclick="calcBuyNum(1)">全仓</label>
        <label onclick="calcBuyNum(1/2)">半仓</label>
        <label onclick="calcBuyNum(1/3)">1/3仓</label>
        <label onclick="calcBuyNum(2/3)">2/3仓</label>
        <label onclick="calcBuyNum(1/4)">1/4仓</label>
        <div class="clear"></div>
    </div>
    <div class="pupBox_submit">
        <button onclick="buyIn()">买入</button>
    </div>
</div>

<!--卖出弹窗-->
<div class="buyOut_box  pupBox animated bounceInUp ">
    <i class="dmfont dm-guanbi pupClose"></i>
    <div class="pupBox_list">
        <ul>
            <li>
                <div class="pupBox_list_change">
                    <button class="reduceNum">－</button>
                    <input type="number" value="3.3" class="num " placeholder="卖出价">
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
                    <input type="number" value="100" class="num" placeholder="卖出量">
                    <button class="addNum">＋</button>
                </div>

                <div class="pupBox_list_bot">
                    <em>最多可买<i class="num"> 0 </i>股</em>
                </div>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="pupBox_label">
        <label class="selected">全仓</label>
        <label>半仓</label>
        <label><i>1/3</i>仓</label>
        <label><i>2/3</i>仓</label>
        <label><i>1/4</i>仓</label>
        <div class="clear"></div>
    </div>
    <div class="pupBox_submit">
        <button>卖出</button>
    </div>
</div>

<script>
    $(function () {
        //  点击显示买入、卖出的弹窗
        $(".qd_foot .buy").click(function(){
            $(".buyIn_box").show();
            $("#cover").show();
        });
        $(".qd_foot .sale").click(function(){
            $(".buyOut_box").show();
            $("#cover").show();
        });
        $(".pupClose").click(function(){
            $(".buyIn_box").hide();
            $(".buyOut_box").hide();
            $("#cover").hide();
        });
        //    买入仓点击
        $(".pupBox_label label").click(function(){
            $(this).addClass("selected").siblings().removeClass("selected");
        });
    })
</script>

<?php $this->beginBlock('footer'); ?>

<script src="<?= Url::base() ?>/backend/web/dist/js/echarts.js"></script>
<script type="text/javascript" src="http://hq.sinajs.cn/?list=<?= $code ?>" charset="utf-8"></script>
<script type="text/javascript" src="http://vip.stock.finance.sina.com.cn/quotes_service/view/vML_DataList.php?asc=j&symbol=<?= $code ?>&num=500" charset="utf-8"></script>
<script>
    const THEME_COLOR = '#8f92a5';
    var code = '<?= $code ?>';
    var codeNum = code.substr(2);

    var money = '<?= $money ?>';
    var rate = '<?= $rate ?>';
    var z = 0.0048 * rate + 1;

    $(function () {
        getMarket();
        minute_data_list.reverse();
        fenShi(minute_data_list);
        $('.qd_main_nav ul li:first').addClass('selected');
    });

    $('.qd_main_nav ul li').click(function () {
       $(this).addClass('selected').siblings().removeClass('selected')
    });

    function getMarket() {
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
                    // console.log(data);
                    $('.stock_name').html(data.name);
                    $('.stock_code').html(data.code);
                    $('.settlement_yesterday').html(data.settlement_yesterday);
                    $('.new_price').html(data.new_price);
                    $('.buy_hands').html(data.buy_hands);
                    $('.sale_hands').html(data.sale_hands);
                    $('.fluctuation').html(data.fluctuation);
                    $('.frice_fluctuation').html(data.frice_fluctuation + '%');
                    $('.minimum_price').html(data.minimum_price);
                    $('.highest_price').html(data.highest_price);
                    $('.opening_price').html(data.opening_price);
                    $('.volume').html(data.volume);
                    $('.turnover').html(data.turnover);
                    $('.upstop').html((data.settlement_yesterday * (1 + 10 / 100)).toFixed(3));
                    $('.downstop').html((data.settlement_yesterday * (1 - 10 / 100)).toFixed(3));

                    $('.pupBox_list_change .new_price').val(data.new_price);
                    // 最大可买股数
                    setMaxBuyNum(data.new_price);
                }
                setTimeout('getMarket()', 10000);
            }
        })
    }

    function fenShi(param) {
        var dates = param.map(function (item) {
            return item[0];
        });

        var data = param.map(function (item) {
            return item[1];
        });
        var myChart = echarts.init(document.getElementById('mpc_son_img'));
        option = {
            grid: {
                left: '15%',
                top: '15%',
            },
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            title: {
                show: false,
                left: 'center',
                text: '行情分时图',
            },
            toolbox: {
                show: false,
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    restore: {},
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                data: dates,
                axisLine: {lineStyle: {color: THEME_COLOR}},
                axisLabel: {
                    textStyle: {color: THEME_COLOR}
                }
            },
            yAxis: {
                scale: true,
                axisLine: {lineStyle: {color: THEME_COLOR}},
                splitLine: {
                    show: false,
                    lineStyle: {
                        type: 'dotted',
                        color: '#FF0000',
                        width: 0.5
                    }
                },
                axisLabel: {
                    textStyle: {color: THEME_COLOR}
                }


            },
            // dataZoom: [{
            //      show: false,
            //      type: 'inside',
            //      start: 0,
            //      end: 100,
            //      dataBackgroundColor: '#eee'
            //  }, {
            //      start: 0,
            //      end:0,
            //      // handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
            //      // handleSize: '90%',
            //      handleStyle: {
            //          borderColor: "#cacaca",
            //          borderWidth: "0.8",
            //          shadowBlur: 2,
            //          background: "#ddd",
            //          shadowColor: "#ddd"
            //      }
            //  }],
            series: [
                {
                    name: '分时价格',
                    type: 'line',
                    smooth: true,
                    symbol: 'none',
                    sampling: 'average',
                    itemStyle: {
                        normal: {
                            color: '#3a89e4',
                            lineStyle: {
                                width: 1.4
                            },
                        }
                    },
                    areaStyle: {
                        normal: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: 'rgba(80,141,255,0.39)'
                            }, {
                                offset: 1,
                                color: '#ccdefe'
                            }])
                        }
                    },
                    data: data
                }
            ]
        };
        myChart.clear();
        myChart.setOption(option);
    }

    function getdayMinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/Dayline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: codeNum},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                // console.log(result)
                var alldata = result.result;
//alldata.reverse();
                var myChart = echarts.init(document.getElementById('mpc_son_img'));

                var rawData = [];

                for (var i = 0; i < alldata.length; i++) {
                    rawData[i] = alldata[i].split(',');
                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[2], +item[3], +item[4]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['日K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';

                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    markLine: {
                        symbol: ['none', 'none'],
                        data: [
                            [
                                {
                                    name: 'from lowest to highest',
                                    type: 'min',
                                    valueDim: 'lowest',
                                    symbol: 'circle',
                                    symbolSize: 10,
                                    label: {
                                        normal: {show: false},
                                        emphasis: {show: false}
                                    }
                                },
                                {
                                    type: 'max',
                                    valueDim: 'highest',
                                    symbol: 'circle',
                                    symbolSize: 10,
                                    label: {
                                        normal: {show: false},
                                        emphasis: {show: false}
                                    }
                                }
                            ],
                            {
                                name: 'min line on close',
                                type: 'min',
                                valueDim: 'close'
                            },
                            {
                                name: 'max line on close',
                                type: 'max',
                                valueDim: 'close'
                            }
                        ]
                    },
                    grid: {
                        left: '15%',
                        top: '15%',
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 0,
                        end: 100,
                        dataBackgroundColor: '#eee',
                    }, {
                        start: 0,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '日K',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }

                    ]
                };
                myChart.hideLoading();
                myChart.clear();
                myChart.setOption(option);
            }
        });
    }

    function get5MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "POST",
            async: true,
            data: {list: codeNum},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];
                for (var i = 0; i < alldata.length; i++) {
                    rawData[i] = alldata[i].split(',');
                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {
                            var res = '<div><p>时间：' + params[0].name + '</p></div>';
                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    grid: {
                        bottom: 80
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 80,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 80,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }

                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);
            }
        });
    }

    function get15MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: codeNum},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                // console.log(result);
                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];

                for (var i = 0; i < alldata.length; i++) {
                    if (i % 3 == 0) {
                        rawData[i / 3] = alldata[i].split(',');
                    }

                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    grid: {
                        bottom: 60
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 60,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 60,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }
                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);

            }
        });
    }

    function get30MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: codeNum},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {


                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];

                for (var i = 0; i < alldata.length; i++) {
                    if (i % 6 == 0) {
                        rawData[i / 6] = alldata[i].split(',');
                    }

                }


                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    grid: {
                        bottom: 60
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 0,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 0,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }
                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);

            }
        });
    }

    function get60MinK() {
        $.ajax({
            url: 'http://api2.jinpinzhibo.com/kline.php?user=lision&&pwd=c113a045bb7169e9012ccbada264be40',
            type: "GET",
            async: true,
            data: {list: codeNum},
            dataType: "json",
            error: function () {
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                myChart.showLoading();
            },
            success: function (result) {
                var alldata = result.result;
                var myChart = echarts.init(document.getElementById('mpc_son_img'));
                var rawData = [];
                for (var i = 0; i < alldata.length; i++) {
                    if (i % 12 == 0) {
                        rawData[i / 12] = alldata[i].split(',');
                    }
                }

                var dates = rawData.map(function (item) {
                    return item[0];
                });

                var data = rawData.map(function (item) {
                    return [+item[1], +item[4], +item[2], +item[3]];
                });
                var option = {
                    //backgroundColor: '#21202D',
                    legend: {
                        show: false,
                        data: ['5K'],
                        inactiveColor: '#777',
                        textStyle: {
                            color: '#fff'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {

                            var res = '<div><p>时间：' + params[0].name + '</p></div>';

                            res += '<p>-开盘价:' + params[0].data[1] + '</p>';
                            res += '<p>-收盘价:' + params[0].data[2] + '</p>';
                            res += '<p>-最高价:' + params[0].data[3] + '</p>';
                            res += '<p>-最低价:' + params[0].data[4] + '</p>';
                            //console.log(params);
                            return res;
                        },
                        axisPointer: {
                            animation: false,
                            type: 'cross',
                            lineStyle: {
                                color: '#fff',
                                width: 2,
                                opacity: 1
                            }

                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: dates,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    yAxis: {
                        scale: true,
                        axisLine: {lineStyle: {color: '#FF0000'}},
                        splitLine: {
                            show: true,
                            lineStyle: {
                                type: 'dotted',
                                color: '#FF0000',
                                width: 0.5
                            }
                        },
                        axisLabel: {
                            textStyle: {color: THEME_COLOR}
                        }
                    },
                    grid: {
                        bottom: 60
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 0,
                        end: 100,
                        dataBackgroundColor: '#eee'
                    }, {
                        start: 0,
                        end: 100,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '80%',
                        handleStyle: {
                            borderColor: "#cacaca",
                            borderWidth: "1",
                            shadowBlur: 2,
                            background: "#ddd",
                            shadowColor: "#ddd"
                        }
                    }],
                    animation: false,
                    series: [
                        {
                            type: 'candlestick',
                            name: '5minK',
                            data: data,
                            itemStyle: {
                                normal: {
                                    color: '#FD1050',
                                    color0: '#0CF49B',
                                    borderColor: '#FD1050',
                                    borderColor0: '#0CF49B'
                                }
                            }
                        }

                    ]
                };
                myChart.hideLoading();
                myChart.setOption(option);
            }
        });
    }

    // 设置最大可购买股数
    function setMaxBuyNum(price) {
        var max_buy_num = parseInt(money * rate / z / price);
        max_buy_num = parseInt(max_buy_num / 100) * 100;
        $('.max_buy_num').html(max_buy_num);
    }


    // 买入价
    $('.buyIn_box .buy_in_price .reduceNum').click(function () {
        return;
        var oringinPrice = $('.new_price').html(); // 接口获取的价格
        var newPriceObj = $('.buyIn_box .new_price');
        var buyPrice = newPriceObj.val();
        var minPrice = (oringinPrice * 0.9).toFixed(3);
        var price = (buyPrice * 1000 - 0.01 * 1000)/1000;
        price = price.toFixed(3);
        if (price < minPrice) {
            layerMsg('委托价格不能低于市价的90%');
            newPriceObj.val(minPrice);
            setMaxBuyNum(minPrice)
        } else {
            newPriceObj.val(price);
            setMaxBuyNum(price)
        }
    });
    $('.buyIn_box .buy_in_price .addNum').click(function () {
        return;
        var oringinPrice = $('.new_price').html(); // 接口获取的价格
        var newPriceObj = $('.buyIn_box .new_price');
        var buyPrice = newPriceObj.val();
        var maxPrice = (oringinPrice * 1.1).toFixed(3);
        var price = (buyPrice * 1000 + 0.01 * 1000)/1000;
        price = price.toFixed(3);
        if (price > maxPrice) {
            layerMsg('委托价格不能高于市价的110%');
            newPriceObj.val(maxPrice);
            setMaxBuyNum(maxPrice)
        } else {
            newPriceObj.val(price);
            setMaxBuyNum(price)
        }
    });
    $('.buyIn_box .new_price').keyup(function () {
        layerMsg('只能市价买入，不可修改');return;
        var oringinPrice = $('.new_price').html(); // 接口获取的价格
        var newPriceObj = $('.buyIn_box .new_price');
        var buyPrice = newPriceObj.val();
        var minPrice = (oringinPrice * 0.9).toFixed(3);
        var maxPrice = (oringinPrice * 1.1).toFixed(3);
        if (buyPrice < minPrice) {
            layerMsg('委托价格不能低于市价的90%');
            buyPrice = minPrice;
        }
        if (buyPrice > maxPrice) {
            layerMsg('委托价格不能高于市价的110%');
            buyPrice = maxPrice;
        }
        newPriceObj.val(buyPrice);
        setMaxBuyNum(buyPrice);
    })

    // 买入量
    $('.buyIn_box .buy_in_num .reduceNum').click(function () {
        var buyNumObj = $('.buyIn_box .buy_in_num .buy_num');
        var buyNum = buyNumObj.val();
        var num = buyNum - 100;
        if (num <= 100) {
            layerMsg('最少购买股数为100股');
            num = 100
        }
        buyNumObj.val(num);
    });
    $('.buyIn_box .buy_in_num .addNum').click(function () {
        var buyNumObj = $('.buyIn_box .buy_in_num .buy_num');
        var buyNum = parseInt(buyNumObj.val());
        var num = buyNum + 100;
        var max_buy_num = $('.max_buy_num').html();
        if (num >= max_buy_num) {
            layerMsg('最大购买股数不能超过账户可购买股数');
            num = max_buy_num;
        }
        buyNumObj.val(num);
    });
    $('.buyIn_box .buy_num').blur(function () {
        var buyNumObj = $('.buyIn_box .buy_in_num .buy_num');
        var buyNum = parseInt(buyNumObj.val());
        var max_buy_num = $('.max_buy_num').html();
        if (buyNum % 100 != 0) {
            layerMsg('购买股数必须是100的整数倍');
            buyNum = parseInt(buyNum / 100) * 100;
        }
        if (buyNum < 100 ) {
            layerMsg('最少购买股数为100股');
            buyNum = 100;
        }
        if (buyNum > max_buy_num) {
            layerMsg('最大购买股数不能超过账户可购买股数');
            buyNum = max_buy_num;
        }
        buyNumObj.val(buyNum);
    })

    function calcBuyNum(rate) {
        var buyNumObj = $('.buyIn_box .buy_in_num .buy_num');
        var max_buy_num = parseInt($('.max_buy_num').html());
        var buyNum = max_buy_num * rate;
        if (buyNum % 100 != 0) {
            buyNum = parseInt(buyNum / 100) * 100;
        }
        buyNumObj.val(buyNum);
        $(this).addClass('selected').siblings().removeClass('selected');
    }

    function buyIn() {
       var price = $('.buy_in_price .new_price').val();
       var num = $('.buy_in_num .buy_num').val();
       var _csrf = '<?= Yii::$app->request->csrfToken?>';
       layerLoad();
       $.post('<?= Url::to(['quote/buy-in'])?>', {price: price, num: num, code: codeNum, _csrf: _csrf}, function (res) {
           layer.closeAll();
           layerMsg(res.msg);
           if (res.status === 200) {
               setTimeout(function () {
                   location.reload();
               }, 2000);
           }
       }, 'json')
    }

    function CartIn() {
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        layerLoad();
        $.post('<?= Url::to(['quote/cart-in'])?>', {code: codeNum, _csrf: _csrf}, function (res) {
            layer.closeAll();
            layerMsg(res.msg);
            if (res.status === 200) {
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }, 'json')
    }

    function CartDel() {
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        layerLoad();
        $.post('<?= Url::to(['quote/cart-del'])?>', {code: codeNum, _csrf: _csrf}, function (res) {
            layer.closeAll();
            layerMsg(res.msg);
            if (res.status === 200) {
                setTimeout(function () {
                    location.href = '<?= Url::to(['quote/self-select'])?>';
                }, 2000);
            }
        }, 'json')
    }

</script>
<?php $this->endBlock(); ?>
