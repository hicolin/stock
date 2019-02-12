<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminTongji;
$modelLabel=new \backend\models\AdminTongji()
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

                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/index'])?>" class="btn btn-xs btn-primary">admin-tongjis列表</a>
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
   <label for="xgj_id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("xgj_id")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'xgj_id')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("xgj_id"),"id"=>'xgj_id']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="group" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("group")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'group')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("group"),"id"=>'group']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="jy_time" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("jy_time")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'jy_time')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("jy_time"),"id"=>'jy_time']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="entrust" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("entrust")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'entrust')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("entrust"),"id"=>'entrust']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="deal_num" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("deal_num")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'deal_num')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("deal_num"),"id"=>'deal_num']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="request_num" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("request_num")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'request_num')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("request_num"),"id"=>'request_num']) ?>
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
