<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminLink;

$modelLabel = new \backend\models\AdminLink();
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
                            <a id="create_btn" href="<?= Url::toRoute('admin-link/'.$view) ?>"
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
                            <label for="link_url"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_url") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->link_url ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="link_name"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_name") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->link_name ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="link_status"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_status") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->link_status?'显示':'不显示' ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="link_type"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_type") ?></label>
                            <div class="col-sm-8">
                                <div class="form-control"
                                     style="height: auto;min-height: 34px;"><?= $model->link_type==1?'友情链接':'合作伙伴' ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php
                        if($model->link_image) { ?>
                            <div class="form-group">
                                <label for="link_image"
                                       class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_image") ?></label>
                                <div class="col-sm-8">
                                    <div class="form-control" style="height: auto;min-height: 34px;">
                                        <img style="max-width:120px;height:80px" src="<?= $model->link_image ?>"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        <?php }
                        ?>
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
