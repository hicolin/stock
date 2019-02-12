<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSlides;
$modelLabel=new \backend\models\AdminSlides();
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
                            <a id="create_btn" href="<?=Url::toRoute('admin-slides/index')?>" class="btn btn-xs btn-primary">幻灯片管理列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                        <div class="form-group">
                         <label for="slide_id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_id")?></label>
                         <div class="col-sm-8">
                      <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->slide_id?></div>   </div>
                      </div>
                       <div class="clear"></div>
                      <div class="form-group">
                         <label for="slide_cid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_cid")?></label>
                         <div class="col-sm-8">
                      <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->slide_cid?></div>   </div>
                      </div>
                       <div class="clear"></div>
                      <div class="form-group">
                         <label for="slide_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_name")?></label>
                         <div class="col-sm-8">
                      <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->slide_name?></div>   </div>
                      </div>
                       <div class="clear"></div>
                      <div class="form-group">
                         <label for="slide_pic" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_pic")?></label>
                         <div class="col-sm-8">
                      <div class="form-control" style="height: auto;min-height: 34px;"><img onclick="lookimg(this.src)"  title="点击查看大图" width="30%" src="<?=$model->slide_pic?>"></div>   </div>
                      </div>
                       <div class="clear"></div>
                      <div class="form-group">
                         <label for="slide_url" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_url")?></label>
                         <div class="col-sm-8">
                      <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->slide_url?></div>   </div>
                      </div>
                       <div class="clear"></div>
                      <div class="form-group">
                         <label for="slide_des" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_des")?></label>
                         <div class="col-sm-8">
                      <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->slide_des?></div>   </div>
                      </div>
                       <div class="clear"></div>
                      <div class="form-group">
                         <label for="slide_content" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_content")?></label>
                         <div class="col-sm-8">
                      <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->slide_content?></div>   </div>
                      </div>
                       <div class="clear"></div>
                        <div class="form-group">
                            <label for="slide_content" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_content")?></label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;"><?=AdminSlides::dropDownList('is_show',$model->slide_status)?></div>   </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="listorder" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("listorder")?></label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->listorder?></div>   </div>
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
<script>
    function lookimg(str)
    {
        var newwin=window.open();
        newwin.document.write("<img src="+str+" />")
    }
</script>
<?php  $this->endBlock(); ?>
