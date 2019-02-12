<?php

use yii\helpers\Url;

?>
<!-- Main content -->

<section class="content">
    <!-- Small boxes (Stat box) -->
    <?php if ($role_id == 1): ?>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $count_orders ?></h3>

                        <p>订单总数</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= Url::toRoute('admin-order/index') ?>" class="small-box-footer">更多 <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $sum_daili ?><sup style="font-size: 20px"></sup></h3>

                        <p>代理总数</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= Url::toRoute('admin-userpeoduct/index') ?>" class="small-box-footer">更多 <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= $count_members ?></h3>

                        <p>会员总数</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?= Url::toRoute('admin-member/index') ?>" class="small-box-footer">更多 <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $sum_charge ?: '0' ?></h3>

                        <p>入金总数</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= Url::toRoute('admin-charge/index') ?>" class="small-box-footer">更多 <i
                                class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div style="width: 100%;display: block;">
            <div id="memberCharts" style="display:block; width:50%; height: 500px;float: left;"></div>
            <div id="orderCharts" style="display:block; width:50%; height: 500px;float: left;"></div>
        </div>
    <?php endif; ?>
    <!-- /.row -->
    <!-- Main row -->

    <!-- /.row (main row) -->

    <?php
    if ($role_id == 2) { ?>
        <div class="box-header with-border">
            <h3 class="box-title">代理信息</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 220px;">用户名：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$model->uname ?>"></td>
                </tr>
                <tr>
                    <td style="width: 220px;">银行卡户名：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$model->bank_name ?>"></td>
                </tr>
                <tr>
                    <td style="width: 220px;">银行卡名称：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$model->bank_code ?>"></td>
                </tr>
                <tr>
                    <td style="width: 220px;">开户行地址：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$bank_address ?>"></td>
                </tr>
                <tr>
                    <td style="width: 220px;">综合手续费返佣比例/%：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$adminUser->rate ?>"></td>
                </tr>
                <tr>
                    <td style="width: 220px;">递延手续费返佣比例/%：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$adminUser->dy_rate ?>"></td>
                </tr>
                <tr>
                    <td style="width: 220px;">总金额：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$model->commission_member+$model_money['money'] ?>"></td>
                </tr>
                <tr>
                    <td style="width: 220px;">可提现金额：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$model->commission_member ?>"></td>
                    <td>
                        <a href="javascript:;" onclick="adminWithdraw()" class="btn-sm btn btn-warning">提现</a>
                    </td>
                </tr>
                <tr>
                    <td style="width: 220px;">邀请码：</td>
                    <td style="width: 1200px;"><input id="code" readonly style="width: 600px;border: none" type="text"
                                                      value="<?=$code ?>"></td>
                    <td>
                        <button onclick="js_copy('code')">点击复制</button>
                    </td>
                </tr>
                <tr>
                    <td style="width: 220px;">开户链接：</td>
                    <td style="width: 1200px;"><input id="vacation" readonly style="width: 600px;border: none"
                                                      type="text" value="<?= $url ?>"></td>
                    <td>
                        <button onclick="js_copy('vacation')">点击复制</button>
                    </td>
                </tr>
                <tr>
                    <td style="width:220px;">二维码</td>
                    <td style="width: 1175px;"><img src="<?= Url::toRoute(['admin-userpeoduct/qrcode','vatation_code'=>$code]) ?>"></td>
                </tr>
            </table>
        </div>
    <?php }
    ?>
</section>

<script type="text/javascript">
    function js_copy(id) {
        var e = document.getElementById(id);//对象是content ，通过js取值
        e.select(); //选择对象
        document.execCommand("Copy"); //执行浏览器复制命令
        layer.msg('复制成功', {icon: 1, time: 1000});
    }

    //指定图标的配置和数据
    var option_member = {
        title: {
            text: '会员注册人数'
        },
        tooltip: {},
        legend: {
            data: ['用户来源']
        },
        xAxis: {
            splitLine: {
                show: false
            },
            data: ["<?=date("m-d", strtotime("-4 day"))?>", "<?=date("m-d", strtotime("-3 day"))?>", "<?=date("m-d", strtotime("-2 day"))?>", "<?=date("m-d", strtotime("-1 day"))?>", "<?=date('m-d')?>"]
        },
        yAxis: {
            // max:6,
            minInterval: 2,
            splitLine: {
                show: false
            },

        },
        series: [{
            name: '当日注册总数',
            type: 'line',
            smooth: true,
            data: [<?=$member_count[0]?>,<?=$member_count[1]?>,<?=$member_count[2]?>,<?=$member_count[3]?>,<?=$member_count[4]?>]
        }]
    };
    var myChart_member = echarts.init(document.getElementById('memberCharts'));
    myChart_member.setOption(option_member);


    var option_order = {
        title: {
            text: '订单总数统计'
        },
        tooltip: {},
        legend: {
            data: ['用户来源']
        },
        xAxis: {
            splitLine: {
                show: false
            },
            data: ["<?=date("m-d", strtotime("-4 day"))?>", "<?=date("m-d", strtotime("-3 day"))?>", "<?=date("m-d", strtotime("-2 day"))?>", "<?=date("m-d", strtotime("-1 day"))?>", "<?=date('m-d')?>"]
        },
        yAxis: {
            // max:6,
            minInterval: 2,
            splitLine: {
                show: false
            },

        },
        series: [{
            name: '当日订单数',
            type: 'line',
            smooth: true,
            data: [<?=$order_count[0]?>,<?=$order_count[1]?>,<?=$order_count[2]?>,<?=$order_count[3]?>,<?=$order_count[4]?>]
        }]
    };
    var myChart_order = echarts.init(document.getElementById('orderCharts'));
    myChart_order.setOption(option_order);
</script>
<script>
    function adminWithdraw() {
        var money = '<?=$model->commission_member?>';
        layer.prompt({title:'请输入提现金额',formType:3},function (text,index) {
            if(isNaN(text)){
                layer.msg('转账金额必须是数字');
                return;
            }
            if(text<=0){
                layer.msg('请输入正确的金额');
                return;
            }
            if(text*100>money*100){
                layer.msg('输入的金额不可以大于当前余额');
                return;
            }
            layer.close(index);
            $.post('<?=Url::toRoute(['site/withdraw'])?>',{money:text,_csrf:'<?=Yii::$app->request->csrfToken?>'},function (data) {
                if(data.status=='y'){
                    layer.msg(data.msg,{icon:1,time:1000},function () {
                        window.location.reload();
                    })
                }else{
                    layer.msg(data.msg);
                }
            },'json')
        })
    }
</script>
<!-- /.content -->