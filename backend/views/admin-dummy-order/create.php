<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminDummyOrder;

$modelLabel = new \backend\models\AdminDummyOrder()
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

                            <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"
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
                        <div class="form-group">
                            <label for="user_name"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("user_name") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'user_name')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("user_name"), "id" => 'user_name']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="money"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("money") ?>/$</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'money')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("money"), "id" => 'money']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="profit"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("profit") ?>/%</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'profit')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("profit"), "id" => 'profit']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="profit_money"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("profit_money") ?>/$</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'profit_money')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("profit_money"), "id" => 'profit_money']) ?>
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
<script>
    $(function(){

        var money = 0;
        var profit = 0;
        var profit_money = 0;
        $('#money').blur(function(){
            money = $(this).val()
            deal()
        })
        $('#profit').blur(function(){
            profit = $(this).val()
            deal()
        })
        function deal(){
            if(money && profit) {
                $('#profit_money').val(parseFloat(money*profit/100))
                //$('#profit_money').val(money*profit/100)
            }
        }

    })
</script>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
