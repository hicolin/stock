<?php

use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminOrder;

$modelLabel = new \backend\models\AdminOrder()
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
                            <a id="create_btn" href="<?= Url::toRoute('admin-order/index') ?>"
                               class="btn btn-xs btn-primary">订单列表</a>
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
                        <div class="form-group">
                            <label for="id"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("id") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'id')->textInput(["class" => "form-control", "disabled" => "disabled", "placeholder" => $modelLabel->getAttributeLabel("id"), "id" => 'id']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="goods_id"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("goods_id") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'goods_id')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("goods_id"), "id" => 'goods_id']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="user_id"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("user_id") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'user_id')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("user_id"), "id" => 'user_id']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_my_money"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_my_money") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'order_my_money')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("order_my_money"), "id" => 'order_my_money']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_ly_money"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_ly_money") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'order_ly_money')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("order_ly_money"), "id" => 'order_ly_money']) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zj_bzj"
                                   class="col-sm-2 control-label">追加保证金</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'zj_bzj')->textInput(["class" => "form-control", "placeholder" =>'追加保证金', "id" => 'zj_bzj']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_bl"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_bl") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'order_bl')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("order_bl"), "id" => 'order_bl']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_bl"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_zy_money") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'order_zy_money')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("order_zy_money"), "id" => 'order_bl']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_bl"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_zs_money") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'order_zs_money')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("order_zs_money"), "id" => 'order_bl']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_bl"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_charge") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'order_charge')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("order_charge"), "id" => 'order_bl']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_bl"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("created_time") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'created_time')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("created_time"), "id" => 'order_bl']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_bl"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'status')->dropDownList(["0" => "申请中", "1" => "持仓中", "2" => "已结算"], ['style' => 'width:120px']) ?>
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
