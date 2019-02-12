<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminHousekeeper;

$modelLabel = new \backend\models\AdminHousekeeper();
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute('admin-housekeeper/index') ?>"
                               class="btn btn-xs btn-primary">返回列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                        <div class="form-group">
                            <label for="xgj_id"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("xgj_id") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->xgj_id ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="xgj_name"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("xgj_name") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->xgj_name ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="xgj_pwd"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("xgj_pwd") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->xgj_pwd ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="states"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("states") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->states ?></div>
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
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
