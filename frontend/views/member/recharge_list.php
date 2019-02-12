
  <?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\widgets\LinkPager;
  ?>
  <link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
  <link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
  <!-- <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/withdrawal.css"> -->
  <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/recharge.css">
  <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/main(1).css">
  <script src="<?=Url::base()?>/backend/web/libs/moment.min.js"></script>
  <script src="<?=Url::base()?>/backend/web/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="<?=Url::base()?>/backend/web/plugins/datepicker/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/backend/web/dist/laydate/theme/default/laydate.css?v=5.0.9">
  <script src="<?=Url::base()?>/frontend/web/laydate/laydate.js"></script>

<div class="wal">
    <div class="con">
        <!-- left -->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!-- left end -->
        <style type="text/css">
        .frc-top input {
                font-size: 14px;
                width: 160px;
                padding-left: 10px;
                height: 30px;
                border: 1px solid #999;
                margin-left: 5px;
                margin-top: 10px;
            }
        .fl {
             float: left;
            }

        .frc-top img {
            vertical-align: middle;
            margin-left: 5px;
            margin-top: 10px;
                    }
        .frc-top i {
                display: block;
                width: 15px;
                height: 0;
                border-top: 1px solid #333;
                margin-left: 10px;
                margin-top: 26px;
                margin-right: 7px;
            }
        .frc-top span {
            font-size: 16px;
            color: #333;
            line-height: 3.1em;
        }
        input, select, textarea {
            margin: 0;
            padding: 0;
            outline: 0;
            color: #333;
            font-family: Microsoft Yahei;
        }
        .frc-top button {
            width: 80px;
            height: 32px;
            border: none;
            margin-left: 5px;
            background: #4164c7;
            color: #fff;
            font-size: 16px;
        }
        </style>
        <!-- right -->
        <div class="fr right">
            <div class="qhbox">
                <div class="menu menu0">
                    <ul class="style_head">
                        <li><a href="<?=Url::toRoute(['member/recharge'])?>" >第三方支付</a></li>
                        <li><a href="<?=Url::toRoute(['member/bank-giro'])?>">银行转账</a></li>
                        <li><a href="<?=Url::toRoute(['member/recharge-record'])?>"  class="current">充值记录</a></li>
                        <li><a href="<?=Url::toRoute(['member/bank-record'])?>" class="">银行转账记录</a></li>
                    </ul>
                    <span class="clear_f"></span></div>

                
                <div class="cn style_content style_content0">
                  <!--  <div class="frc-top" style="display: block;">
                        <form action="<?/*=Url::toRoute('member/recharge-record')*/?>" method="get" style="margin-left: 6%;">
                            <span class="fl">日期：</span>
                            <input name="begin_time" id="b_time" type="text" class="fl date_picker">
                            <img src="<?/*=Url::base()*/?>/frontend/web/img/rl.png" class="fl"/>
                            <i class="fl"></i>
                            <input name="end_time"  id="e_time" type="text" class="fl date_picker">
                            <img src="<?/*=Url::base()*/?>/frontend/web/img/rl.png" class="fl"/>
                            <span class="fl" style="margin-left: 20px;">充值方式：</span>
                            <select name="charge_type" style="height: 32px; margin-top: 10px;">
                                <option <?/*=$charge_type==1?'selected':''*/?> value="1">线上</option>
                                <option <?/*=$charge_type==2?'selected':''*/?> value="2">线下</option>
                            </select>
                            <input type="hidden" name="r" value="member/recharge-record">
                            <button type="submit" onclick="prompt()" >筛选</button>
                        </form>
                    </div> -->

                    <div class="ul" style="display: block;" id="nav_cont3">
                        <table cellpadding="0" cellspacing="0" class="tab" id="ajaxGetRechargeList">
                            <tbody>
                            <tr>
                                <td>流水号</td>
                                <td>充值方式 </td>
                                <td>充值金额(￥)</td>
                                <td>充值时间</td>
                                <td>状态</td>
                            </tr>
                           <?php
                        foreach ($model as $list) { ?>
                            <tr>
                                <td><?=$list->pay_ordersid?></td>
                                <td><?=$charge_type==1?$list->payname['pay_name']:'银行转账'?></td>
                                <td><?=$list->money?></td>
                                <td><?=date('Y-m-d H:i:s',$list->dates)?></td>
                                <td><?= $state[$list->state];?>
                                    <?php
                                    if($charge_type==1 && $list->state==0) {
                                        //echo "<a href='".Url::toRoute(['member/recharge-order','order_id'=>$list->id])."'><button id='go_pay'>去支付</button></a>";
                                    } else {
                                        //echo $state[$list->state];
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php }
                        ?>
                            </tbody>
                        </table>
                        <style type="text/css">
                            /*分页*/
                            .news-r-bot{height: 50px; text-align: center;margin-top: 20px;}
                            .news-r-bot ul{display:inline-block; }
                            .news-r-bot ul li{background: #fff;border: 1px solid #eee; float: left; margin: 0 3px; line-height: 30px;}
                            .news-r-bot ul li.active a{background: #4164c7;color: #fff;background: #4164c7; pointer-events: none;}
                            .news-r-bot ul li a{color: #999;font-size: 14px;display: block; padding: 0px 12px;}
                            .news-r-bot ul li span{display: none}
                            .news-r-bot  ul li:hover{background: #4164c7;border: 1px solid transparent;}
                            .news-r-bot ul li:hover a{color: #fff;}
                        </style>
                            <div class="news-r-bot">
                                <?= LinkPager::widget([
                                    'pagination' => $pages,
                                    'nextPageLabel' => '下一页',
                                    'prevPageLabel' => '上一页',
                                    'firstPageLabel' => '首页',
                                    'lastPageLabel' => '尾页',
                                ]); ?>
                            </div>
                    </div>
                </div>
                <span class="clear_f"></span></div>
        </div>
        <div class="clear"></div>
        <!-- right end -->
    </div>
</div>
<script>
    function prompt(){
        var trade_start_time = Date.parse(new Date($('#b_time').val()))/1000;
        var trade_end_time = Date.parse(new Date($('#e_time').val()))/1000;
        var take_start_time = Date.parse(new Date($('#togoods_start_time').val()))/1000;
        var take_end_time = Date.parse(new Date($('#togoods_end_time').val()))/1000;
        var exchange_time = Date.parse(new Date($('#exchange_time').val()))/1000;
        var check = $(".check:checked").val();
        if(trade_start_time>trade_end_time){
            layer.tips('起始时间不得大于结束时间！',"#end_time");return;
        }
        if(take_start_time>take_end_time){
            layer.tips('起始时间不得大于结束时间！',"#togoods_end_time");return;
        }
        if(trade_end_time>=take_start_time){
            layer.tips('提货开始时间必须大于预售结束时间！',"#togoods_start_time");return;
        }
        if(take_end_time>=exchange_time){
            layer.tips('交易时间必须大于提货结束时间！',"#exchange_time");return;
        }

        $('#form').submit();
    }
</script>
                   
<script type="text/javascript">
    laydate({elem: '#b_time',isdate: true,istime: true, format: 'YYYY-MM-DD hh:mm:ss'});
    laydate({elem: '#e_time',isdate: true,istime: true, format: 'YYYY-MM-DD hh:mm:ss'});

</script>
