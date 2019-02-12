<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<!DOCTYPE html>
<html>
<head>
    <title>股票大厅</title>
</head>
<body onload="getMarket()">
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<link href="<?=Url::base()?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/lrtk.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/chaogu.css-v=20171204.css" rel="stylesheet"/>
<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet"/>

<div class="clearborth"></div>

<div class="chaogu_part2">
    <div class="nw1000" style="position: relative; width: 1000px;">
        <div class="notice">
            <div class="text">
                <span>最新公告</span>

                    <span>
                        除非黄土白骨，我守你百岁无忧
                    </span>

            </div>
            <!-- <div class="button_more"><a href="newslist/announce.html">更多</a></div> -->
        </div>
        <div class="tingpai" style="position: absolute; left: 900px;"><a href="javascript:"
                                                                         onclick="openUrl();">禁买黑名单</a></div>
    </div>
</div>
<div class="nbody">
    <div class="nw1000" style="width: 1000px;">
        <div class="cgleft">
            <div class="nleftmenu">
                <div class="subtitle">股票大厅</div>
                
            </div>
        </div>
        <div class="cgright">
            <!------顶部内容------->
            <div class="top">
                <div class="zichan">
                    <table width="510" border="0" cellpadding="0" cellspacing="0" class="tb_money">
                        <tr>
                            <td width="65" align="right">动态资产<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(3);"/></td>
                            <td width="104" class="num money_asset">0.00</td>
                            <td width="60" align="right">可用资金<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(1);"/></td>
                            <td width="104" class="num money_able"><?=$onelist->money?></td>
                            <td width="60" align="right">冻结资金<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(2);"/></td>
                            <td class="num money_lock">0.00</td>
                        </tr>
                        <tr>
                            <td align="right">实盘可买<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14" onclick="openTips(4);"/></td>
                            <td class="num money_can_buy">0.00</td>
                            <td align="right">证券市值</td>
                            <td class="num money_cap">0.00</td>
                            <td align="right">持仓盈亏</td>
                            <td class="num money_profit">0.00</td>
                        </tr>
                    </table>
                    <input id="money_yue" type="hidden" value="0"/>
                    <input id="money_cash_lock" type="hidden" value="0"/>
                    <input id="money_today_yq" type="hidden" value="0"/>
                    <input id="money_stock_yk" type="hidden" value="0"/>
                </div>
                <div class="zijin">
                    <img src="<?=Url::base()?>/frontend/web/xnn/images/yes.png" id="worn_green" title="绿灯表示可用资金充足，负数为多余资金，每天14：52系统会把多余资金转换成可用余额">
                    <img src="<?=Url::base()?>/frontend/web/xnn/images/no.png" id="worn_red" title="红灯表示可用资金不够延期所需费用，需要充值；否则系统在14：50时会强平股票" class="hide"
                         style="display: none;">

                    <p>
                        延期总费用 <b class="money_extended_all" id="ycfy">0 元</b><br/>
                        <b style="font-weight: normal" id="ycfykt">此刻保证金充足，请注意盘中变化！</b>
                    </p>
                </div>
                <div class="button_more shuaxin"><a href="javascript:" onclick="money_all()">手动刷新</a></div>
            </div>
            <section >
            <div class="mark_hall">

        <!-- 头部搜索 -->

        <!-- <div class="header" style="height: 30px;">

            <span class="fl"><i class="iconfont icon-gerenzhongxin size-15 personal_center"></i></span>

            <input id="Symbol" class="fl size-9" data-role = "none" type="text" onchange="searchstock()" placeholder="输入股票代码或名称" style="line-height: 30px;font-size: 16px;width: 70%;" />

            <a id="queryStock" type="button" onclick="searchstock()" class="ui-btn color-w fr" style="margin-right: 20%;">查询</a>



        </div> -->
        <style type="text/css">
            #queryStock{
                margin-right: 20%;
                background: #ddd;
                width: 52px;
                height: 28px;
                text-align: center;
                line-height: 30px;
                font-size: 16px;
            }
        </style>
        <div id="message" style="display: none"></div>

        <div class="clear"></div>

                <table id="tbCX" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                    <tr class="table_top">
                        <td height="40px" style="color: #444">股票代码</td>
                        <td style="color: #444">股票名称</td>
                        <td style="color: #444">最新价</td>
                        <td style="color: #444">涨跌幅</td>

                        <td style="color: #444">操作</td>
                    </tr>
                    <tbody id="apply_list">
                    </tbody>
                </table>



        <!-- 加载首页成功 -->

        <ul id="stock_list" class="stock_list" style="margin-top: 40px;">

           <?php $this->beginContent('@app/views/index/list.php',['data'=>$data]); ?>

           <?php $this->endContent(); ?>

        </ul>

                <div class="page">
                    <div id="pager_apply_history" class="flickr" style="display: none;"> </div>
                    <?= LinkPager::widget([
                        'pagination' => $pages,
                        'nextPageLabel' => '下一页',
                        'prevPageLabel' => '上一页',
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                    ]); ?>
                </div>

                <style>
                    .pagination li{
                        float:left;
                    }
                </style>   

    </div>

        </section>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){

        getMarket();
    

    });

var _thisPage=1;

var _maxPage=177;

var _thisUrl="<?=Url::toRoute(['index/stocks'])?>";

var _thisSearchUrl="<?=Url::toRoute('index/find-stocks')?>";

var _thisMarketlist="<?=$marketlist?>";

     function searchstock(){

                                var search=$('#Symbol').val();
                    
                                if(search==''){

                                   window.location.href='<?=Url::toRoute('index/stocks')?>';

                                   return false;

                                }


                                $.ajax({

                                    url:_thisSearchUrl,

                                    type: "post",

                                    data:{search:search},

                                    error: function(){

                                        layer.msg('搜索失败！')

                                    },

                                    dataType: "json",

                                    success: function(data){//如果调用php成功
                                         
                                    if(data.status==1){

                                         _thisMarketlist+=","+data.marketlist;   //新获取的股票代码列表要加上原来获取的

                                         $("#stock_list").html(data.html);     //写入搜索结果区域

                                          getMarket();


                                     }else if(data.status==0){

                                        layer.msg('无搜索结果！')

                                     }

                 

                                    }



                                });

                            };

    function goDetail(e){



        var stock_detail=$(e).attr('value');



        window.location.href="<?=Url::toRoute(['index/invest','id'=>$data->id])?>";

    }

                     
    function getMarket(e) {

        console.log(111)

        $.ajax({

            url: 'http://api2.jinpinzhibo.com/?user=lision&&pwd=c113a045bb7169e9012ccbada264be40&show=json',

            type: "POST",

            async: true,

            data: {list:_thisMarketlist},

            dataType: "json",

            error: function () {

                setTimeout('getMarket()', 5000);

            },

            success: function (data) {

                var market = data.data;

                    for (var i = 0; i < market.length; i++) {



                        var code=market[i].code.slice(2);

                        if(market[i].new_price == 0) {

                            $('#code_' + code + ' .new_price').html('--');

                            $('#code_' + code + ' .change i').html('----');

                        }else {

                            $('#code_' + code + ' .new_price').html(market[i].new_price);

                            $('#code_' + code + ' .change i').html(market[i].frice_fluctuation + '%');

                        }

                        if (market[i].frice_fluctuation < 0) {

                            $('#code_'+code+' .new_price').css({'color':'#0CBD70'});

                            $('#code_'+code+' .change i').css({'background':'#238859','color':'#ffffff'});

                            setTimeout(function (_code){

                                $('#code_'+_code+' .change i').css({'background':'','color':'#0CBD70'});

                            },2000,code);

                        } else {

                            $('#code_'+code+' .new_price').css({'color':'#e22626'});

                            $('#code_'+code+' .change i').css({'background': '#dc5538','color':'#ffffff'});

                            setTimeout(function (_code){



                                $('#code_'+_code+' .change i').css({'background':'','color':'#e22626'});

                            },2000,code);

                        }

                    }


                setTimeout('getMarket()', 5000);

            }

        });

    }


</script>
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

<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layout.js"></script>

<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layer-v1.8.5/layer/layer.min.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/stock.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/follow.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/search.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pagination.js?v=201712281640"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/pager.js"></script>

<div class="kefu">
    <ul>

        <li class="l3" style="display: none;">
            <a href="javascript:;"></a>

            <div class="hide3">
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><span>客服一</span><br/><i></i></a><a
                    href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes"
                    target="_blank"><span>qq交流群</span><br/><i></i></a>
            </div>
        </li>
        <li class="l4"><a href="#page1" id="scrollTop"></a></li>
    </ul>
</div>
</body>
</html>
