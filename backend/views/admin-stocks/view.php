<?php

use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use yii\helpers\Url;

use yii\helpers\Html;

use backend\models\AdminStocks;

$modelLabel=new \backend\models\AdminStocks();

?>

<?php  $this->beginBlock('header');  ?>

<!-- <head></head>中代码块 -->

<?php  $this->endBlock(); ?>

<style type="text/css">

    .form-control{

            border:1px solid #f4f4f4;

        }

</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box">

                <div class="box-header">

                    <div class="box-tools">

                        <div class="input-group input-group-sm" style="width: 150px;">

                            <a id="create_btn" href="<?=Url::toRoute('admin-stocks/index')?>" class="btn btn-xs btn-primary">股票列表</a>

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

   <label for="cid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cid")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->cid?></div>   </div>

</div>

<!--  <div class="clear"></div>

<div class="form-group">

   <label for="recom" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("recom")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->recom?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="status" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("status")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->status?></div>   </div>

</div> -->

 <!-- <div class="clear"></div>

<div class="form-group">

   <label for="hits" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("hits")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->hits?></div>   </div>

</div>

 <div class="clear"></div>

<div class="form-group">

   <label for="template" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("template")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->template?></div>   </div>

</div> -->

 <div class="clear"></div>

<div class="form-group">

   <label for="ip" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("ip")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->ip?></div>   </div>

</div>

 <div class="clear"></div>


<div class="form-group">

   <label for="adminid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("adminid")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->adminid?></div>   </div>

</div>

 <div class="clear"></div>


<div class="form-group">

   <label for="name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("name")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->name?></div>   </div>

</div>

 <div class="clear"></div>


<div class="form-group">

   <label for="code" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("code")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><?=$model->code?></div>   </div>

</div>

 <div class="clear"></div>


<div class="form-group">

   <label for="display" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("display")?></label>

   <div class="col-sm-8">

<div class="form-control" style="height: auto;min-height: 34px;"><td><?php if($model['display']==1){?>上架<?php }else{?>下架<?php }?></td></div>   </div>

</div>





 <div class="clear"></div>

                        <div class="form-group">

                            <label for="logo" class="col-sm-2" >&nbsp;</label>

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

