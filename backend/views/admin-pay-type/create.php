<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminPayType;
$modelLabel=new \backend\models\AdminPayType()
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
                        <div class="form-group"  style="display: none;">
   <label for="id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("id")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'id')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("id"),"id"=>'id']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="pay_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("pay_name")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'pay_name')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("pay_name"),"id"=>'pay_name']) ?>
   </div>
</div>
 <div class="clear"></div>
  <div class="form-group">
      <label for="sex"
             class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("type") ?></label>
      <div class="col-sm-8">
          <?php echo $form->field($model, 'type')->dropDownList(AdminPayType::dropDownList('type'),['style' => 'width:120px']) ?>
      </div>

  </div>

 <div class="clear"></div>
<div class="form-group">
   <label for="created_time" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("created_time")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'created_time')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("created_time"),"id"=>'created_time',"value"=>time()]) ?>
   </div>
</div>
 <div class="clear"></div>
 
<div class="form-group">
   <label for="status" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("status")?></label>
   <div class="col-sm-8">
    <?php echo $form->field($model, 'status')->dropDownList(AdminPayType::dropDownList('status'),['style' => 'width:120px']) ?>
   </div>
</div>

<div class="form-group">
   <label for="pay_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("setting")?></label>
   <div class="col-sm-8">
    <textarea name="AdminPayType[setting]" style="width: 550px;height: 250px;"></textarea>
<!-- 
   <?php echo $form->field($model,'setting')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("setting"),"id"=>'setting']) ?> -->

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
