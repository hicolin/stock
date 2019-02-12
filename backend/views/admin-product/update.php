<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminProduct;

$modelLabel = new \backend\models\AdminProduct()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute('admin-product/index') ?>"
                               class="btn btn-xs btn-primary">返回列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '<div class="span12 field-box">{input}</div>{error}',
                        ],
                        'options' => [
                            'class' => 'new_user_form inline-input',
                        ],
                        'id' => 'form',
                    ])
                    ?>
                    <div class="tab-content">
                        <input type="hidden" name="cid" value="<?= $_REQUEST['cid'] ?>">

                        <div class="form-group">
                            <label for="title"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'title')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("title"), "id" => 'title']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="pid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cat_id")?></label>
                            <div class="col-sm-2">
                                <!--  --><?php /*echo $form->field($model,'pid')->dropDownList($tree) */?>
                                <select name="AdminProduct[cat_id]" id="" class="form-control">
                                    <?php foreach($tree as $v):?>
                                        <option <?=($model->cat_id==$v->id) ? 'selected' : '';?>  value="<?=$v->id?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$v['level']-1).$v->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="code"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("code") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'code')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("code"), "id" => 'code']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="resource" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <?php echo Html::submitButton('保存', ['class' => "btn btn-primary"]); ?>
                                <span>&nbsp;</span>
                                <?php echo Html::resetButton('重置', ['class' => "btn btn-primary"]); ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
