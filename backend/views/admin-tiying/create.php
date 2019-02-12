<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminTiying;
$modelLabel=new \backend\models\AdminTiying()
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

                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/index'])?>" class="btn btn-xs btn-primary">返回列表</a>
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
   <label for="users_id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("users_id")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'users_id')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("users_id"),"id"=>'users_id']) ?>
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
   <label for="title" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("title")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'title')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("title"),"id"=>'title']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="dates" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("dates")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'dates')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("dates"),"id"=>'dates']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="ip" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("ip")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'ip')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("ip"),"id"=>'ip']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="bank_id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("bank_id")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'bank_id')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("bank_id"),"id"=>'bank_id']) ?>
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
