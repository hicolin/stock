<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminAddBond;

$modelLabel = new \backend\models\AdminAddBond()
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
                            <a id="create_btn" href="<?= Url::toRoute('admin-add-bond/index') ?>"
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
                            <label for="user_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("user_id") ?></label>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'user_id')->dropDownList($user) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="order_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_id") ?></label>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'order_id')->dropDownList($order) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="deposit_amout"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("deposit_amout") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'deposit_amout')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("deposit_amout"), "id" => 'deposit_amout']) ?>
                                <sapn id="deposit_amout_des"></sapn>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="description"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("description") ?></label>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'description')->textarea(['rows'=>'5',"placeholder" => $modelLabel->getAttributeLabel("description")]) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="status"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status") ?></label>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'status')->dropDownList(['0'=>'已申请','1'=>'已通过'],['id'=>'status']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="created_time"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("created_time") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'created_time')->textInput(["class" => "form-control ECalendar", "placeholder" => $modelLabel->getAttributeLabel("created_time"), "id" => 'created_time']) ?>
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
    $('#deposit_amout').blur(function(){
        var val = parseFloat($(this).val())
        if(val%1000==0) {
            $('.btn ').attr("disabled",false);
            $('#deposit_amout').css('border','')
            $('#deposit_amout_des').html('');
        }else{
            $('#deposit_amout').css('border','1px solid red')
            $('#deposit_amout_des').html("<p style='color:red'>追加金额为1000的倍数</p>")
            $('.btn ').attr("disabled","disabled");
        }
    })

    $("#created_time").ECalendar({
        type:"time",   //模式，time: 带时间选择; date: 不带时间选择;
        stamp : true,   //是否转成时间戳，默认true;
        offset:[0,2],   //弹框手动偏移量;
        format:"yyyy-mm-dd hh:ii",   //格式 默认 yyyy-mm-dd hh:ii;
        skin:2,   //皮肤颜色，默认随机，可选值：0-8,或者直接标注颜色值;
        step:10,   //选择时间分钟的精确度;
        callback:function(v,e){

        } //回调函数
    });
</script>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
