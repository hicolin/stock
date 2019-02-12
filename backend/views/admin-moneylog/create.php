<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminMoneylog;
$modelLabel=new \backend\models\AdminMoneylog()
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
   <label for="money_left" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("money_left")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'money_left')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("money_left"),"id"=>'money_left']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="money_freeze" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("money_freeze")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'money_freeze')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("money_freeze"),"id"=>'money_freeze']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="typer" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("typer")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'typer')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("typer"),"id"=>'typer']) ?>
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
