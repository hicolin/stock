<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminChargexx;
$modelLabel=new \backend\models\AdminChargexx()
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

                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/index'])?>" class="btn btn-xs btn-primary">返回</a>
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

                            <?php $user_info=$_GET['user_info'];?>
</div>
 <div class="clear"></div>

<div class="form-group">
    <label for="realname" class="col-sm-2 control-label" >姓名</label>
    <div class="col-sm-8">
        <input type="text" id="realname" value='<?=isset($user_info['realname'])?$user_info["realname"]:null?>' class="form-control" name="realname" placeholder="真实姓名">
    </div>
    <div class="clear"></div>
    <label for="bank_tel" class="col-sm-2 control-label" >银行卡认证手机号</label>
    <div class="col-sm-8">
        <input type="text" id="bank_tel" value='<?=isset($user_info['bank_tel'])?$user_info["bank_tel"]:null?>' class="form-control" name="bank_tel" placeholder="银行卡认证手机号">
    </div>
    <div class="clear"></div>
   <label for="usersname" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("users_id")?></label>
   <div class="col-sm-8">
       <input type="text" id="usersname" value='<?=isset($user_info['usersname'])?$user_info["usersname"]:null?>' class="form-control" name="usersname" placeholder="会员账号">
   </div>

</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="money" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("money")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'money')->textInput(["class"=>"form-control","value"=>isset($user_info['AdminChargexx']["money"])?:null,"placeholder"=>$modelLabel->getAttributeLabel("money"),"id"=>'money']) ?>
   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="title" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("title")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'title')->textInput(["class"=>"form-control","value"=>isset($user_info['AdminChargexx']["title"])?:null,"placeholder"=>$modelLabel->getAttributeLabel("title"),"id"=>'title']) ?>
   </div>
</div>
  <div class="clear"></div>
  <div class="form-group">
   <label for="pay_type" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("pay_type")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'pay_type')->textInput(["class"=>"form-control","value"=>isset($user_info['AdminChargexx']["pay_type"])?:null,"placeholder"=>$modelLabel->getAttributeLabel("pay_type"),"id"=>'pay_type']) ?>
   </div>
</div>


 <div class="clear"></div>
<div class="form-group">
   <label for="pay_ordersid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("pay_ordersid")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'pay_ordersid')->textInput(["class"=>"form-control","value"=>isset($user_info['AdminChargexx']["pay_ordersid"])?:null,"placeholder"=>$modelLabel->getAttributeLabel("pay_ordersid"),"id"=>'pay_ordersid']) ?>
   </div>
</div>
                        <div class="clear"></div>
<div class="form-group">
   <label for="pay_ordersid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("title")?></label>
   <div class="col-sm-8">
   <?php echo $form->field($model,'title')->textInput(["class"=>"form-control","value"=>isset($user_info['AdminChargexx']["title"])?:null,"placeholder"=>$modelLabel->getAttributeLabel("title"),"id"=>'title']) ?>
   </div>
</div>

</div>
 <div class="clear"></div>
                        <div class="form-group">
                            <label for="resource" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <?php echo Html::submitButton('保存', ['class' =>"btn btn-primary",'id'=>'put_up']); ?>
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
<script>
    $("#put_up").click(function () {
        var usersname = $("#usersname").val();
        var money = $("#money").val();
        if (!usersname) {
            layer.msg('请输入会员账号');
            return false
        }else if (!usersname) {
            layer.msg('请输入金额');
            return false
        } else {
            $("#form").submit();
        }

    })
</script>
<?php if(!empty($_GET['msg'])){?>
    <script type="text/javascript">
        $(function(){
            layer.msg('<?=$_GET['msg']?>', {
                skin:0,
                icon:2,
                shift: 4, //动画类型
                area:['250px' , 'auto'],
                border: [10 , 0.3 , '99999'],
            });
        })
    </script>
<?php }?>
<?php  $this->beginBlock('footer');  ?>
<?php  $this->endBlock(); ?>
