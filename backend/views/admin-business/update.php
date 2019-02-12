<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminBusiness;
$modelLabel=new \backend\models\AdminBusiness()
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
                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/index'])?>" class="btn btn-xs btn-primary">admin-businesses列表</a>
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
   <label for="account" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("account")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'account')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("account"),"id"=>'account']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="date" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("date")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'date')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("date"),"id"=>'date']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="success_account" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("success_account")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'success_account')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("success_account"),"id"=>'success_account']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="request" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("request")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'request')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("request"),"id"=>'request']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="exchange" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("exchange")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'exchange')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("exchange"),"id"=>'exchange']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="contract" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("contract")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'contract')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("contract"),"id"=>'contract']) ?>
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
