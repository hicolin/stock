<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminTixian;
use backend\controllers\PublicController;

$modelLabel = new \backend\models\AdminTixian();
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<style>
    .cover{
        background-color: #666;
        position: fixed;
        z-index: 99;
        left: 0;
        top: 0;
        display: none;
        width: 100%;
        height: 100%;
        opacity: 0.5;
    }
</style>
<div class="cover" style="display: none"></div>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute('admin-tixian/index') ?>"
                               class="btn btn-xs btn-primary">返回列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                        <div class="form-group">
                            <label for="id"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("id") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;"><?= $model->id ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="users_id"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("users_id") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->users_id ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="users_id"
                                   class="col-sm-2 control-label">交易账号</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $xgj_name ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="users_id"
                                   class="col-sm-2 control-label">姓名</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $realname ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="money"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("money") ?>/¥</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->money ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">手续费/¥</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;">
                                    <?php if($model->state!=0){?>
                                        <?= $model->service_money ?>
                                    <?php }else{?>
                                    <input id="service_money" type="text" name="service_money" >
                                    <?php }?>
                                    </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="ip"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("ip") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;"><?= $model->ip ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bank_id"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bank_id") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->bank_id ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bank_code"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bank_code") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= ($role_id==1 || $role_id==8)?$model->bank_code:substr_replace($model->bank_code,'****',5,10) ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="state"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("state") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;">
                                    <?php
                                    if($model->state==0) {
                                        echo '审核中';
                                    } else {
                                        echo $model->state==1?'成功':'失败';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="dates"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("dates") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;"><?= date('Y-m-d H:i:s',$model->dates) ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form-group">
                            <label for="dates"
                                   class="col-sm-2 control-label"> 代付方式：</label>
                            <select name="changetype" id="changetype" style="width: 130px;height: 28px;">

                                <?php foreach ($payType as $key => $value) { ?>
                                    <option value="<?=$value->id?>"> <?=$value->pay_name?></option>
                                <?php } ?>
                            </select>
                        </div>

                            <div class="form-group">
                                <label for="dates"
                                       class="col-sm-2 control-label">审核</label>
                                <div class="col-sm-8">
                                    <?php
                                    if($model->state===0) { ?>
                                    <a onclick="wtDf(1,<?= $model->id ?>)" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>代付打款</a>
                                    <?php if(in_array($role_id,[1,2,8])){?>
                                    <a onclick="change(1,<?= $model->id ?>)" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>线下支付</a>
                                    <?php }?>
                                    <a onclick="change(2,<?= $model->id ?>)" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>不通过</a>
                                    <?php }
                                    ?>
                                    <?php
                                    if($model->state!=0 && $model->title=='银生') { ?>
                                        <a onclick="ckYsb('<?=$model->id?>')" class="btn btn-primary">查看代付结果</a>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="clear"></div>

                        <div class="form-group">
                            <label for="logo" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;border: none;">
                                    <a href="javascript:history.back(-1)" class="btn btn-primary"> 返&nbsp;回</a>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script>

    function wtDf(state,id){
        admin_tool.confirm('确定通过并且打款吗？',function(){
            var service_money = $("#service_money").val();
            var payType = $("#changetype").val();
            alert(payType);return
            var url = '';
            if(payType==3){
                url = '<?=Url::toRoute(['admin-tixian/return'])?>';
            }else if(payType==4 || payType==5){
                url = '<?=Url::toRoute(['admin-tixian/ysb'])?>';
            }
            //alert(service_money);
            $.ajax({
                type:"POST",
                url:url,
                cache:false,
                data:{state:state,id:id,service_money:service_money,payType:payType,_csrf:'<?=Yii::$app->request->csrfToken?>'},
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success:function(msg){
                    if(msg.code){
                        alert(msg.msg);
                        window.location.reload();
                    }
                }
            });
        })
    }
    function ckYsb(id){
        admin_tool.confirm('确定查看代付结果吗？',function(){
            $.ajax({
                type:"POST",
                url:'<?=Url::toRoute(['admin-tixian/ysjg'])?>',
                cache:false,
                data:{id:id,_csrf:'<?=Yii::$app->request->csrfToken?>'},
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success:function(msg){
                    if(msg.code){
                        alert(msg.msg);
                        //window.location.reload();
                    }
                }
            });
        })
    }
    function change(state,id) {
        $('.cover').show();
        layer.confirm('确定审核吗?', function () {
            layer.closeAll('dialog');
            if(state==2){
                layer.prompt({title:'请输入不通过原因',formType:2},function(reason,index){
                    if(reason.length>10){
                        layer.msg('原因最多不能超过10个字符');
                        return;
                    }
                    $.ajax({
                        type: "GET",
                        url: "<?= Url::toRoute('admin-tixian/change-state')?>",
                        data: {"state": state, "id": id,"service_money":service_money,"reason":reason},
                        cache: false,
                        dataType: "json",
                        error: function (xmlHttpRequest, textStatus, errorThrown) {
                            alert("出错了，" + textStatus);
                        },
                        success: function (data) {
                            if(data==800) {
                                layer.alert('没有权限', {icon: 2});
                                return false;
                            }else if(data==100) {
                                window.location.reload();
                            }else if(data==400){
                                layer.alert('审核失败', {icon: 2});
                                return false;
                            }
                        }
                    });
                })
            }else{
                var service_money = $("#service_money").val();
                $.ajax({
                    type: "GET",
                    url: "<?= Url::toRoute('admin-tixian/change-state')?>",
                    data: {"state": state, "id": id,"service_money":service_money},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                    success: function (data) {
                        if(data==800) {
                            layer.alert('没有权限', {icon: 2});
                            return false;
                        }else if(data==100) {
                            window.location.reload();
                        }else if(data==400){
                            layer.alert('审核失败', {icon: 2});
                            return false;
                        }
                    }
                });
            }

        });
        $('.cover').hide();
    }
</script>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
