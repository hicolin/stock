<?php

use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use yii\helpers\Url;

use yii\helpers\Html;

use backend\models\AdminStocks;

$modelLabel=new \backend\models\AdminStocks()

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

                            <a id="create_btn" href="<?=Url::toRoute('admin-stocks/index')?>" class="btn btn-xs btn-primary">admin-stocks列表</a>

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

   <label for="cid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cid")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'cid')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("cid"),"id"=>'cid']) ?>

   </div>

</div>

<div class="clear"></div>

<div class="form-group">
    <label for="cid"
           class="col-sm-2 control-label">子分类</label>
    <div class="col-sm-8">
        <?php echo $form->field($model,'cate_id')->dropDownList($categories, ['style' => 'width:25%']) ?>
    </div>
</div>
<div class="clear"></div>


   <div class="form-group">

   <label for="recom" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("recom")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'recom')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("recom"),"id"=>'recom']) ?>

   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="status" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("status")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'status')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("status"),"id"=>'status']) ?>

   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="hits" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("hits")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'hits')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("hits"),"id"=>'hits']) ?>

   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="template" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("template")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'template')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("template"),"id"=>'template']) ?>

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

   <label for="adminid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("adminid")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'adminid')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("adminid"),"id"=>'adminid']) ?>

   </div>

</div>


 <div class="clear"></div>

<div class="form-group">

   <label for="name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("name")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'name')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("name"),"id"=>'name']) ?>

   </div>

</div>


 <div class="clear"></div>

<div class="form-group">

   <label for="code" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("code")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'code')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("code"),"id"=>'code']) ?>

   </div>

</div>


 <div class="clear"></div>

<div class="form-group">

   <label for="display" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("display")?></label>

   <div class="col-sm-8">

   <?php echo $form->field($model,'display')->dropDownList(["1" => "上架", "0" => "下架"], ['style' => 'width:120px']) ?>

   

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

