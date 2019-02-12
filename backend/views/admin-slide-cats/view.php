<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSlideCats;
$modelLabel=new \backend\models\AdminSlideCats();
$model2=$model->attributes;
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
                            <a id="create_btn" href="<?=Url::toRoute('admin-slide-cats/index')?>" class="btn btn-xs btn-primary">幻灯片分类列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                        <div class="form-group">
   <label for="cid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cid")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;"><?=$model2["cid"]?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="cat_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_name")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;"><?=$model2["cat_name"]?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="cat_idname" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_idname")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;"><?=$model2["cat_idname"]?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="cat_remark" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_remark")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;"><?=$model2["cat_remark"]?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="cat_status" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_status")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;"><?=AdminSlideCats::dropDownList('is_show',$model2["cat_status"])?></div>   </div>
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
