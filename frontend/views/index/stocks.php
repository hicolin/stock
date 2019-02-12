<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\Common;

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
    <!-- <div class="nw1000" style="position: relative; width: 1000px;">
        <div class="notice">
            <div class="text">
                <span>最新公告</span>

                    <span>
                        除非黄土白骨，我守你百岁无忧
                    </span>

            </div>
            <div class="button_more"><a href="newslist/announce.html">更多</a></div>
        </div>
        <div class="tingpai" style="position: absolute; left: 900px;"><a href="javascript:"
                                                                         onclick="openUrl();">禁买黑名单</a></div>
    </div> -->
</div>
<div class="nbody">
    <div class="nw1000" style="width: 1000px;">
        <div class="cgleft">
            <div class="nleftmenu">
                <div class="subtitle">股票行情</div>
                
            </div>
        </div>
        <div class="cgright">
            <!------顶部内容------->
            <div class="top">
                <div class="zichan">
                    <table width="510" border="0" cellpadding="0" cellspacing="0" class="tb_money">
                        <tr>
                            <td width="65" align="right">信用权益<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(3);"/></td>
                            <td width="104" class="num money_asset"><?=$dt_m ?: '0.00'?></td>
                            <td width="60" align="right">可用权益<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(1);"/></td>
                            <td width="104" class="num money_able"><?=$onelist->money?:'0.00'?></td>
                            <td width="60" align="right">冻结权益<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14"
                                                                  onclick="openTips(2);"/></td>
                            <td class="num money_lock"><?=$dj_m['money']?:'0.00'?></td>
                        </tr>
                        <tr>
                            <td align="right">总体权益<img src="<?=Url::base()?>/frontend/web/xnn/images/help.png" width="14" onclick="openTips(4);"/></td>
                            <td class="num money_can_buy"><?= $onelist->money * Common::getSysInfo(71) ?: '0.00' ?></td>
                            <td align="right">证券市值</td>
                            <td class="num money_cap"><?=$z ?: '0.00'?></td>
                            <td align="right">持仓盈亏</td>
                            <td class="num money_profit"><?=$profit['profit'] ?: '0.00'?></td>
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
                        延期总费用 <b class="money_extended_all" id="ycfy"><?=$jS['dy']?> 元</b><br/>

                        <b style="font-weight: normal" id="ycfykt">
                            <?php if($syBzj>0){echo '此刻保证金充足，请注意盘中变化';}elseif ($syBzj<0){echo '此刻保证金不足，欠缺'.abs($syBzj).'元'; }?>
                        </b>
                    </p>
                </div>
                <div class="button_more shuaxin"><a  onclick="window.location.reload()">手动刷新</a></div>
            </div>
            <section >
            <div class="mark_hall">

        <!-- 头部搜索 -->

        <div class="" style="width: 100%;font-size: 16px;margin: 15px;height: 20px;">

            <span class="fl"><i class="iconfont icon-gerenzhongxin size-15 personal_center"></i></span>

            <!-- <form method="post" action="<?=Url::toRoute('index/stocks')?>"> -->

            <input id="Symbol" class="fl size-9" data-role = "none" type="text" name="search" onkeyup="searchstock()" placeholder="输入股票代码或名称" style="width: 85%;font-size: 16px;margin-left: 20px;"/>

            <a id="queryStock" type="submit"  class="ui-btn color-w fr" onclick="searchstock()" style="cursor: pointer;color: #ff5a55;font-size: 16px;float: left">查询</a>

            <!-- </form> -->

        </div>

        <div id="message" style="display: none;"></div>

        <div class="clear"></div>

        <!--<h4 class="title size-9">



            <span class="fl">股票代码</span>

            <span class="fl">股票名称</span>

            <span class="fl">最新价</span>

            <span class="fl">涨跌幅</span>

            <span class="fl">操作</span>

            <div class="clear"></div>

        </h4>-->

                <table id="tbCX" width="100%" border="0" cellspacing="0" cellpadding="0" class="h_table">
                    <tr class="table_top" style="text-align: center;">
                        <td height="40px" style="color: #444;width: 20%">股票代码</td>
                        <td style="color: #444;width: 20%;">股票名称</td>
                        <td style="color: #444;width: 20%;">最新价</td>
                        <td style="color: #444;width: 20%;">涨跌幅</td>
                        <td style="color: #444;width: 20%;">操作</td>
                    </tr>
                    <tbody id="apply_list">
                    </tbody>
                </table>



        <!-- 加载首页成功 -->

        <ul id="stock_list" class="stock_list" >

           <?php foreach($data as $k=>$v){ ?>

        <li >
        <h4 class="title-content" id="code_<?=$v['code'] ?>" >
            <div  style="display: inline-block;width: 80%;float: left">
            <a href="<?=Url::toRoute(['user/stock','id'=>$v['id']])?>">
            <span class="fl"><?=$v['code'] ?></span>
            <span class="fl color-orange"><?=$v['name'] ?></span>
            <span class="fl new_price"><img src="http://m.eiaihe.cn/skin/images/load1.gif"/> </span>
            <span class="fl change"><i><img src="http://m.eiaihe.cn/skin/images/load1.gif"/> </i></span>
            </a>
            </div>

            <span class="" style="width: 16%">
                    <h5 class="choose-btn">
                    <span style="color: red"><a class=""  href="<?=Url::toRoute(['user/stock','id'=>$v['id']])?>"></i>申请</a> | </span>
                    <span class=" trade_add " onclick="trade_add(this)" itemid="<?=$v['id'] ?>"><i class="iconfont icon-buoumaotubiao11"></i>加入自选</span> 
                    <span style="display: none;" class=" trade_delete " onclick="trade_delete(this)" itemid="<?=$v['id'] ?>"><i class="iconfont icon-105"></i>删除自选</span>
                    </h5>
            </span>
            <div class="clear"></div>
        </h4>
         </li>



        <?php } ?>

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
          .title-content span {
            width: 25%;
            line-height: 3em;
            font-size: 1em;
            color: #666666;
            text-align: center;
        }
        .page {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            height: 32px;
        }
        .page li a {
            text-align: center;
            border: 1px solid #ddd;
            /* padding: 4px 10px; */
            color: #999;
            display: block;
        }
        .page ul {
            margin-right: 89px;
            float: right;
        }
        .page .pagination .active a{
            background-color: #64b2c9;
            color: #fff;
        }
        #message li{
            margin-left: 20px;
            width: 233px;
            height: 35px;
            line-height: 35px;
            display: block;
        }
        #message ul{
                position: absolute;
                z-index: 999;
                background: #fff;
                width: 233px;
                border: #ddd 2px solid;
                border-top: 0;
                margin-left: 20px;
                margin-bottom: 5px;
                color: #de2a33;
            }
        </style>
        <!-- <div class="jiazai_more"><a href="javascript:;">加载更多</a></div> -->

        <!-- <div class="jiazai_nomore"><a href="javascript:;">已经到底了！</a></div> -->

        <!-- <div class="clear"></div> -->

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

                                // console.log(search);

                                $.ajax({

                                    url:_thisSearchUrl,

                                    type: "post",

                                    data:{search:search},

                                    dataType: "json",

                                    success: function(data){//如果调用php成功
 
                                    if(data.length != 0){

                                        var lists = "<ul>";  
                                        $.each(data, function () {  
                                            var id = this.id;
                                            lists += "<a href='/user/stock?id="+id+"'><li>"+this.code+"&nbsp;&nbsp;&nbsp;&nbsp;"+this.name+"</li></a>";//遍历出每一条返回的数据  
                                        });  
                                        lists+="</ul>";  
  
                                        $("#message").html(lists).show();//将搜索到的结果展示出来  
  
                                        // $("li").click(function(){  
                                        //     $("#Symbol").val($(this).text());//点击某个li就会获取当前的值  
                                        //     $("#message").hide();  
                                        // })

                                     }else {  
                                            $("#message").hide();
                                               }
                                    }

                                });

                            };


    function trade_add(e){

            $(e).hide().next().show();

            $(".add_one").addClass("show");

            $(".remove_one").removeClass("show");

            var itemid=$(e).attr('itemid');

            // alert(itemid);

            $.ajax({



                url:'<?=Url::toRoute('user/myorder')?>',



                type: "get",



                data:{itemid:itemid},


                dataType: "json",

                success: function(data){//如果调用php成功

                  // alert(data);

                    if(data==1){



                        layer.msg('添加成功!');



                    }else if(data==2){



                        layer.msg('已添加!');



                    }else if(data==5){

                        

                    layer.msg('请先登录!');

                    top.location.href='<?=Url::toRoute('index/login')?>'





                    }else{

                        layer.msg('添加失败！');

                    }



                }



            });

        }

        function trade_delete(e) {

            $(e).hide().prev().show();

            $(".remove_one").addClass("show");

            $(".add_one").removeClass("show");

            var itemid=$(e).attr('itemid');

            $.ajax({



                url:'<?=Url::toRoute('user/del-myorder')?>',



                type: "get",



                data:{itemid:itemid},



                error: function(){



                    layer.msg('加载失败！')



                },



                dataType: "json",



                success: function(data){//如果调用php成功



                    if(data==1){

                        layer.msg('删除成功!');

                    }else if(data==5){



                    layer.msg('请先登录!');



                    window.location.href='<?=Url::toRoute('index/login')?>'



                    }else{

                        layer.msg('删除失败！');

                    }



                }



            });

        }



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

    var openTips = function (typeid) {
        switch (typeid) {
            case 1:
                var money_able = $(".money_able").html(), money_yue = $("#money_yue").val(), money_lock = $(".money_lock").html();
                layer.alert("可用资金 = 余额 - 冻结资金<br/><span style='color:red;'>请保持可用资金大于延期总费用,14:50分结算</span>", 4);
                break;
            case 2:
                var money_lock = $(".money_lock").html(), money_cash_lock = $("#money_cash_lock").val(),
                    money_today_yq = $("#money_today_yq").val(), money_stock_yk = $("#money_stock_yk").val();
                layer.alert("冻结资金 ＝ 已提现未付金额", 4);//+ 当日延期总费用金额(" + money_today_yq + ") + 持仓亏损到本金金额(" + money_stock_yk + ")
                break;
            case 3:
                layer.alert("动态资产 ＝ 可用资金 + 保证金 + 盈亏额 + 冻结资金", 4);//+ 当日延期总费用金额(" + money_today_yq + ") + 持仓亏损到本金金额(" + money_stock_yk + ")
                break;
            case 4:
                layer.alert("实盘最大可买额限制为1000万", 4);
                break;
            default:
                break;
        }
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
