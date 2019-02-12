<?php

use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use yii\helpers\Url;

use yii\helpers\Html;

use backend\models\AdminBusiness;

$modelLabel=new \backend\models\AdminBusiness();

?>

<?php  $this->beginBlock('header');  ?>

<!-- <head></head>中代码块 -->

<?php  $this->endBlock(); ?>

<style type="text/css">

    .form-control{

            border: 1px solid #f4f4f4;

        }

</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box">

                <div class="box-header">

                    <div class="box-tools">

                        <div class="input-group input-group-sm" style="width: 150px;">

                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/index'])?>" class="btn btn-xs btn-primary">返回列表</a>

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

   <label for="account" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("account")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->account?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="date" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("date")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->date?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="success_account" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("success_account")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->success_account?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="request" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("request")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->request?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="exchange" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("exchange")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->exchange?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="contract" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("contract")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->contract?></div>   </div>

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

