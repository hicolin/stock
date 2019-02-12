<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no"
          name="viewport" id="viewport"/>
    <link href="<?= Url::base() ?>/mobile/web/css/main.css-v=20180205.css" rel="stylesheet"/>

    <title>股池</title>

</head>
<body onload="getMarket()">
<div class="m-head">
    <div class="head f-clear">
        <a href="javascript:HistoryBack();" class="fl head-back"></a>
        <span id="pageindex">股池</span>
        <a href="javascript:reload();" class="fr head-refresh"></a>
    </div>
</div>

<div class="m-body">
    <div class="optional">
        <div class="optional-top" style="position: relative;">
            <input id="stock_code" type="hidden"/>
            <input type="text" class="optional-inp" id="txtMySelfCode" onkeyup="searchstock()" placeholder="输入股票代码或名称"/>
            <span id="txtMySelfName"
                  style="padding-left: 5px; position: absolute; right: 30%; height: 3.5rem; line-height: 3.5rem; font-size: 1.5rem;"></span>
                  <a class="ico-search fr" href="javascript:" onclick="searchstock();" style="margin-top: 0.8rem;"></a>
            <!-- <a href="javascript:" class="optional-add" onclick="AddMySelfStock()" id="btnSaveSelfStock">搜索</a> -->
        </div>
        <ul style="display: none;margin-top: 10px;" id="keyup_d" class="sokeyup">

        </ul>
        <table class="optional-tab">
            <tr>
                <th>名称</th>
                <th>代码</th>
                <th>现价</th>
                <th>涨幅</th>
                <th>操作</th>
            </tr>
            <tbody id="stock_pool">
        </table>
        <table>
        <ul id="stock_list" class="stock_list">
           <?php $this->beginContent('@app/views/index/list.php',['data'=>$data]); ?>

           <?php $this->endContent(); ?>
        </ul>

        </table>
    <div class="jiazai_more"><a href="javascript:;">加载更多</a></div>

        <div class="jiazai_nomore"><a href="javascript:;">已经到底了！</a></div>

        <div class="clear"></div>
    </div>
</div>
<?php $this->beginContent('@app/views/layouts/foot.php'); ?>
<?php $this->endContent(); ?>
<script src="<?= Url::base() ?>/mobile/web/scripts/jquery-1.11.2.min.js"></script>
<script src="<?= Url::base() ?>/mobile/web/scripts/layer-v1.8.5/layer/layer.min.js"></script>
<script src="<?= Url::base() ?>/mobile/web/scripts/layer-v1.8.5/layer/layer.min.js"></script>
<script src="<?= Url::base() ?>/mobile/web/scripts/layout.js"></script>
<script src="<?= Url::base() ?>/mobile/web/scripts/page.js"></script>
<style type="text/css">
    .title-content2 span{width: 25%;text-align: center;font-size: 1.5rem;}
    .title-content3 span{width: 50%;text-align: center;font-size: 1.5rem;}
    .jiazai_more, .jiazai_nomore{
    float: left;
    width: 100%;
    text-align: center;
    height: 30px;
    line-height: 30px;
    background: #C89C47;
    margin-bottom: 15px;

 }
 #keyup_d p{

  margin-left: 10px;
 width: 233px;
 height: 35px;
 line-height: 35px;
 display: block;
 color: #de2a33;

 }
 #keyup_d li{

  margin-left: 10px;
 width: 233px;
 height: 35px;
 line-height: 35px;
 display: block;
color: #de2a33;

 }
#keyup_d ul{
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
<script type="text/javascript">
    $(function () {

        getMarket();

    });
      
      function trade_add(e){

            $(e).hide().next().show();

            
            var itemid=$(e).attr('itemid');

            $.ajax({

                url:'<?=Url::toRoute('user/myorder')?>',

                type: "get",

                data:{itemid:itemid},

                dataType: "json",

                success: function(data){//如果调用php成功

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
    $(".personal_center").click(function(){

        window.location.href='<?=Url::toRoute('user/page')?>';

    });

var _thisPage=1;

var _thisPages=1;

var _maxPage=177;

var _thisUrl="<?=Url::toRoute(['index/stocks'])?>";

var _thisSearchUrl="<?=Url::toRoute('index/find-stocks')?>";

var _thisMarketlist="<?=$marketlist?>";

                            function searchstock(){

                                var search=$('#txtMySelfCode').val();
                                console.log(search)

                                if(search==''){

                                   window.location.href='<?=Url::toRoute('index/stocks')?>';

                                   return false;

                                }

                                $.ajax({

                                    url:_thisSearchUrl,

                                    type: "post",

                                    data:{search:search},

                                    

                                    dataType: "json",

                                    success: function(data){//如果调用php成功

                                        console.log(data)

                                    if(data.length != 0){

                                        var lists = "<ul>";  

                                        $.each(data, function () {  

                                            var id = this.id;

                                            lists += "<a href='/user/purchase?id="+id+"'><li>"+this.code+"&nbsp;&nbsp;&nbsp;&nbsp;"+this.name+"</li></a>";//遍历出每一条返回的数据  

                                        });  

                                        lists+="</ul>";  

                                        $("#keyup_d").html(lists).show();//将搜索到的结果展示出来  
                                     }else {  

                                            $("#keyup_d").html("<p style='font-size:16px;'>暂无数据</p>").show();

                                               }

                                    }

                                });

                            };

                                        $(window).scroll(function(){

                                            $(".designer_tab p").slideUp();

                                            var scrollTop = $(this).scrollTop();

                                            var scrollHeight = $(document).height();

                                            var windowHeight = $(this).height();

                                            if(scrollTop + windowHeight >= scrollHeight ){

                                                Load();

                                            }

                                        });

                                        $(".jiazai_more").click(function(){
                                            // console.log(_thisPage)

                                            Load();

                                        });

                                    var load_Lock=false;

                                        function Load() {

                                            if(load_Lock)return;

                                            load_Lock=true;

                                            if(_thisPage<=_maxPage){

                                                $.ajax({

                                                    type: "get",

                                                    data:{page:_thisPage+1},

                                                    error: function(){

                                                        load_Lock=false;

                                                        layer.msg('加载失败！')



                                                    },

                                                    dataType: "json",

                                                    success: function(data){

                                                    console.log(data._thisPage);

                                                        load_Lock=false;

                                                        if(data.status==1){

                                                            _thisPage+=1;

                                                            _thisMarketlist+=","+data.marketlist;

                                                            $("#stock_list").append(data.html);

                                                            getMarket();

                                                            $(".jiazai_more").css("display","block");

                                                        }



                                                    }



                                                });



                                            }else{

                                                $(".jiazai_more").hide();

                                                $(".jiazai_nomore").show();

                                            }

                                        }

       function getMarket(e) {

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

<script type="text/javascript">
    ///返回上一页
    function HistoryBack() {
        if ((navigator.userAgent.indexOf('MSIE') >= 0) && (navigator.userAgent.indexOf('Opera') < 0)) { // IE

            if (history.length > 1) {
                window.history.go(-1);
            } else {
//                window.location.href = '/';
                window.history.go(-1);
            }
        } else { //非IE浏览器
            if (navigator.userAgent.indexOf('Firefox') >= 0 ||
                    navigator.userAgent.indexOf('Opera') >= 0 ||
                    navigator.userAgent.indexOf('Safari') >= 0 ||
                    navigator.userAgent.indexOf('Chrome') >= 0 ||
                    navigator.userAgent.indexOf('WebKit') >= 0) {
                if (window.history.length > 2) {
                    window.history.go(-1);
                } else {
//                    window.location.href = '/';
                    window.history.go(-1);
                }
            } else {//未知的浏览器
                if (history.length > 1) {
                    window.history.go(-1);
                } else {
//                    window.location.href = '/';
                    window.history.go(-1);
                }
            }
        }
    }
    ///重新加载
    function reload() {
        window.location.reload();
    }
</script>
</body>
</html>
