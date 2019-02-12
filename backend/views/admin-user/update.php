<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminUser;

$modelLabel = new \backend\models\AdminUser()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<style type="text/css">
.tips{color: red;}
    .form-group{margin: 0}
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"
                               class="btn btn-xs btn-primary">管理员列表</a>
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
                    <label for="realname" class="col-sm-2 control-label tips" >*&nbsp;号必填</label>
                    </div>
                        <div class="form-group">
                            <label for="uname" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("uname")?><span style="color: red">*</span></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'uname')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("uname"),"id"=>'uname']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("password")?><span style="color: red">*</span></label>
                            <div class="col-sm-8">
                            <input type="password" name="password" placeholder="******" class="form-control">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="vatation_code" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("vatation_code")?></label>
                            <div class="col-sm-8">
                            <p class="form-control"><?=$model->vatation_code?></p>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >请选择角色<span style="color: red">*</span></label>
                            <div class="col-sm-8">
                            <select name="role" style="width: 120px" class="form-control" id="role">
                                <?php foreach($role as $key=>$value){ if($value->id==$user_role->role_id){
                                        $select = "selected";
                                    } else{
                                        $select = "";
                                        }?>
                                <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <style type="text/css">
                            .block{display: none;}
                        </style>
                        <?php if($user_role->role_id==2){ ?>
                        <div class="form-group" id="pro" >
                        <?php }else{ ?>
                        <div class="form-group" id="pro" style="display: none;">
                        <?php } ?>
                            <p style="color: red;padding-left: 11%">*德指单位为：欧元,美原油为：美金 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如果选择产品，价格必填，一一对应</p>
                            <label class="col-sm-2 control-label" >请选择产品</label>
                            <div class="col-sm-8">
                            <?php foreach($product as $key=>$value){ ?>
                            <?php if(in_array($value->id,$proid)){$check = "checked";} else { $check = "";}?>
                            <div>
                            <label style="width: 150px;">
                                <input type="checkbox" name="proid[]" value="<?=$value->id?>" <?=$check?> >
                                <label><?=$value->title?></label>
                            </label>
                            <label>
                                <span>价格(笔)：</span>
                                <input type="text" name="price[]" value="<?php if(in_array($value->id,$proid)){echo $pid_price[$value->id]?:'0';}?>" class="form-control" style="width: 120px;display: inline">
                            </label>
                            </div>
                            <?php } ?>
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
<script type="text/javascript">
    $("#role").change(function(){
        var value=$(this).val();
        if(value==2){
            $("#pro").show();
        }
        else{
            $("#pro").hide();
        }
    });
</script>