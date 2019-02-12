<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminContent;
use backend\models\AdminSort;
$modelLabel=new \backend\models\AdminContent();
?>
<?php  $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php  $this->endBlock(); ?>
<style type="text/css">
    .form-control{
            border:1px solid #f4f4f4;
        }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/index'])?>" class="btn btn-xs btn-primary">内容列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                    <div class="form-group">
   <label for="sortid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("sortid")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=AdminSort::sort_name($model->sortid)?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="title" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("title")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->title?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="keyword" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("keyword")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->keyword?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="describe" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("describe")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->describe?></div>   </div>
</div>


<div class="clear"></div>

<div class="form-group">
   <label for="views" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("views")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->views?></div>   </div>
</div>



 <div class="clear"></div>
<div class="form-group">
    <label for="author" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("author")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->author?></div>   </div>
</div>


 <div class="clear"></div>
 <div class="form-group">
   <label for="addtime" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("addtime")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=date("Y-m-d H:i:s",$model->addtime)?></div>   </div>
</div>
 <div class="clear"></div>

<div class="form-group">
   <label for="top" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("top")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=AdminContent::dropDownList('is_judge',$model->top)?></div>   </div>
</div>
 <div class="clear"></div>
 <div class="form-group">
   <label for="recommend" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("recommend")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=AdminContent::dropDownList('is_judge',$model->recommend)?></div>   </div>
</div>
 <div class="clear"></div>
 <div class="form-group">
   <label for="sorting" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("sorting")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->sorting?></div>   </div>
</div>
 <div class="clear"></div>
  <div class="form-group">
   <label for="img" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("img")?></label>
   <div class="col-sm-8">
<a  target="_blank"><img src="<?=$model->img?>" style="width: 120px;height: 80px;"></a>
   </div>
</div>
 <div class="clear"></div>


 
<div class="form-group">
   <label for="contact" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("contact")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->contact?></div>   </div>
</div>
 <div class="clear"></div>
                        <div class="form-group">
                            <label for="logo" class="col-sm-2 " >&nbsp;</label>
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
