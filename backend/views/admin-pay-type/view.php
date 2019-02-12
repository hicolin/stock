<?php

use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use yii\helpers\Url;

use yii\helpers\Html;

use backend\models\AdminPayType;

$modelLabel=new \backend\models\AdminPayType();

?>

<?php  $this->beginBlock('header');  ?>

<!-- <head></head>中代码块 -->

<?php  $this->endBlock(); ?>

<style type="text/css">

    .form-control{border: 1px solid #f4f4f4;}

</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box">

                <div class="box-header">

                    <div class="box-tools">

                        <div class="input-group input-group-sm" style="width: 150px;">

                            <a id="create_btn" href="<?=Url::toRoute('admin-pay-type/index')?>" class="btn btn-xs btn-primary">返回列表</a>

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

   <label for="pay_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("pay_name")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->pay_name?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="type" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("type")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->type?></div>   </div>

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

                            <label for="logo" class="col-sm-2 " >&nbsp;</label>

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

