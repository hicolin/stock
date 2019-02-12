<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminOrder;
$modelLabel=new \backend\models\AdminOrder();
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
                            <a id="create_btn" href="<?=Url::toRoute('admin-order/index')?>" class="btn btn-xs btn-primary">订单列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <div class="tab-content">
                        <div class="form-group">
   <label for="id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("id")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->id?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="goods_id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("goods_id")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->goods_id?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="user_id" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("user_id")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->user_id?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="order_my_money" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("order_my_money")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->order_my_money?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="order_ly_money" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("order_ly_money")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->order_ly_money?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="order_bl" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("order_bl")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->order_bl?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="order_zy_money" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("order_zy_money")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->order_zy_money?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="order_zs_money" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("order_zs_money")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->order_zs_money?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="order_charge" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("order_charge")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->order_charge?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="created_time" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("created_time")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->created_time?></div>   </div>
</div>
 <div class="clear"></div>
<div class="form-group">
   <label for="status" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("status")?></label>
   <div class="col-sm-8">
<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->status?></div>   </div>
</div>
 <div class="clear"></div>
                        <div class="form-group">
                            <label for="logo" class="col-sm-2 control-label" >&nbsp;</label>
                            <div class="col-sm-8">
                                <div class="form-control" style="height: auto;min-height: 34px;border: none;">
                                    <a href="javascript:history.back(-1)" class="btn btn-primary"> 返&nbsp;回</a>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

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
