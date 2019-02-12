<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminCommissionCharge;
$modelLabel=new \backend\models\AdminCommissionCharge()
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
                            <a id="create_btn" href="<?=Url::toRoute('admin-commission-charges/index')?>" class="btn btn-xs btn-primary">admin-commission-charges列表</a>
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
   <label for="id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("id")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'id')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("id"),"id"=>'id']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="uid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("uid")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'uid')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("uid"),"id"=>'uid']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="money" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("money")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'money')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("money"),"id"=>'money']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="create_time" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("create_time")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'create_time')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("create_time"),"id"=>'create_time']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="update_time" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'update_time')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("update_time"),"id"=>'update_time']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="state" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("state")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'state')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("state"),"id"=>'state']) ?>
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
