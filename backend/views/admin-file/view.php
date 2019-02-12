<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminFile;
$modelLabel=new \backend\models\AdminFile();
?>
<?php  $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php  $this->endBlock(); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?=Url::toRoute('admin-file/index')?>" class="btn btn-xs btn-primary">软件列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                        <div class="form-group">
                      <label for="file_id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_id")?></label>
                      <div class="col-sm-8">
                   <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->file_id?></div>   </div>
                   </div>
                    <div class="clear"></div>
                   <div class="form-group">
                      <label for="file_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_name")?></label>
                      <div class="col-sm-8">
                   <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->file_name?></div>   </div>
                   </div>
                    <div class="clear"></div>
                   <div class="form-group">
                      <label for="file_desc" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_desc")?></label>
                      <div class="col-sm-8">
                   <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->file_desc?></div>   </div>
                   </div>
                    <div class="clear"></div>
                   <div class="form-group">
                      <label for="file_path" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_path")?></label>
                      <div class="col-sm-8">
                   <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->file_path?></div>   </div>
                   </div>
                    <div class="clear"></div>
                   <div class="form-group">
                      <label for="file_cover" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_cover")?></label>
                      <div class="col-sm-8">
                   <div class="form-control" style="height: auto;min-height: 34px;">
                       <img src="<?=$model->file_cover?>" style="max-height: 200px;" alt="">
                   </div>   </div>
                   </div>
                    <div class="clear"></div>
                   <div class="form-group">
                      <label for="sort" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("sort")?></label>
                      <div class="col-sm-8">
                   <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->sort?></div>   </div>
                   </div>
                    <div class="clear"></div>
                   <div class="form-group">
                      <label for="addtime" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("addtime")?></label>
                      <div class="col-sm-8">
                   <div class="form-control" style="height: auto;min-height: 34px;"><?=date('Y-m-d H:i:s',$model->addtime)?></div>   </div>
                   </div>
                    <div class="clear"></div>
                        <div class="form-group">
                            <label for="updatetime" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("updatetime")?></label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;"><?=($model->updatetime) ? date('Y-m-d H:i:s',$model->updatetime) : ""?></div>   </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="logo" class="col-sm-2 control-label" >&nbsp;</label>
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
<?php  $this->beginBlock('footer');  ?>
<?php  $this->endBlock(); ?>
