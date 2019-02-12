<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\controllers\AdminUserpeoductController;

$modelLabel = new \backend\models\AdminUserPeoduct();
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<style>
    .form-control{
        border:1px solid #f4f4f4;
    }
    .control-label{
        text-align: inherit;
    }
    .form-group{
        width: 50%;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute($this->context->id.'/index') ?>"
                               class="btn btn-xs btn-primary">返回列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->uname ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->info['pwd'] ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">被邀请码</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->vatation_code2 ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">代理关系</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= AdminUserpeoductController::getAgentRelationship( $model->vatation_code2) ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">返佣金额/￥</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->info['commission_amount'] ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">身份证号</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->info['id_card'] ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">银行卡户名</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->info['bank_name'] ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">银行卡号</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->info['bank_code'] ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">开户行地址</label>
                        <div class="col-sm-8">
                            <div class="form-control" style="height: auto;min-height: 34px;"><?= $bank_address ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">所需电子文档</label>
                        <div class="col-sm-8">
                            <div class="form-control" style="height: auto;min-height: 34px;"><?= $model->info['license'] ?></div>
                        </div>
                        <?php if($model->info['license']!=null):?>
                        <div class="col-sm-2" >
                            <a href="<?=Url::toRoute(['public/download-file','file'=>$model->info['license'],'fileName'=>'所需文档'])?>" class="btn btn-primary">点击下载</a>
                        </div>
                        <?php endif;?>
                    </div>
                    <!--<div class="clear"></div>
                    <div class="form-group">
                        <label for="order_sn" class="col-sm-2 control-label">其他电子文档</label>
                        <div class="col-sm-8">
                            <?php
/*                            if($model->info['other_file']) {
                                $arr_file = explode(',',$model->info['other_file']);
                                foreach ($arr_file as $key=> $val) { */?>
                                    <img style="margin-right: 10px;" file_path="<?/*=$val*/?>" file_num="<?/*=$key*/?>" class="preview2" id="file_<?/*=$key*/?>"  width="100" height="100" src="<?/*=$val*/?>">
                                <?php /*}
                            }
                            */?>
                        </div>
                    </div>-->
                    <div class="clear"></div>
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">上次登录ip</label>
                        <div class="col-sm-8">
                            <div class="form-control"
                                 style="height: auto;min-height: 34px;"><?= $model->last_ip ?></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="tab-content">
                        <div class="form-group">
                            <label for="goods_id"
                                   class="col-sm-2 control-label">创建人</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->create_user ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_hander"
                                   class="col-sm-2 control-label">创建时间</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->create_date ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_deposit"
                                   class="col-sm-2 control-label">更新人</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->update_user ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_money"
                                   class="col-sm-2 control-label">更新时间</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->update_date ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_amount"
                                   class="col-sm-2 control-label">邀请码</label>
                            <div class="col-sm-6">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><input style="width: 200px;border: none;" readonly id="code" value="<?= $model->vatation_code ?>"></div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-control" style="height: auto;min-height: 34px;border: none"><button onclick="js_copy('code')">点击复制</button></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_pingcang"
                                   class="col-sm-2 control-label">开户链接</label>
                            <div class="col-sm-6">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><input style="width: 555px;border: none" readonly id="vatation_code" value="http://www.xinniuniu.cn/index/register?vatation_code2=<?=$model->vatation_code?>"></div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-control" style="height: auto;min-height: 34px;border: none"><button onclick="js_copy('vatation_code')">点击复制</button></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_account"
                                   class="col-sm-2 control-label">开户二维码</label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;border: none"><img width="80" src="<?= Url::toRoute(['/admin-userpeoduct/qrcode','vatation_code'=>$model->vatation_code]) ?>"></div>
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
    function js_copy(id){
        var e=document.getElementById(id);//对象是content ，通过js取值
        e.select(); //选择对象
        document.execCommand("Copy"); //执行浏览器复制命令
        layer.msg('复制成功',{time:1000,icon:1})
    }
</script>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
