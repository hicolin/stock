<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSort;
$modelLabel=new \backend\models\AdminSort()
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
                            <a id="create_btn" href="<?=Url::toRoute('admin-offers/index')?>" class="btn btn-xs btn-primary">admin-offers列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                        <div class="form-group">
   <label for="id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("id")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->id?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("name")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->name?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="pid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("pid")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->pid?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="level" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("level")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->level?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="price" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("price")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->price?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="addtime" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("addtime")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=date('Y-m-d H:i',$model->addtime)?></div>   </div>
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
