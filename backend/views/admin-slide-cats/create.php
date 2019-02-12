<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSlideCats;
$modelLabel=new \backend\models\AdminSlideCats()
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
                    <?php                    $form=ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '<div class="span12 field-box">{input}</div>{error}',
                        ],
                        'options' => [
                            'class' => 'new_user_form inline-input',
                        ],
                        'id'=>'form',
                    ])
                    ?>
                    <div class="tab-content">

<div class="form-group">
   <label for="cat_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_name")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'cat_name')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("cat_name"),"id"=>'cat_name']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="cat_idname" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_idname")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'cat_idname')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("cat_idname"),"id"=>'cat_idname']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="cat_remark" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_remark")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'cat_remark')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("cat_remark"),"id"=>'cat_remark']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="cat_status" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_status")?></label>
   <div class="col-sm-1">
       <?php echo $form->field($model,'cat_status')->dropDownList(AdminSlideCats::dropDownList("is_show"))?>
   </div>
</div>
 <div class="clear"></div>
                        <div class="form-group">
                            <label for="resource" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <?php echo Html::submitButton('保存', ['class' =>"btn btn-primary"]); ?>
                                <span>&nbsp;</span>
                                <?php echo Html::resetButton('重置', ['class' =>"btn btn-primary"]); ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php  ActiveForm::end();?>
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
