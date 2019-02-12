<?php

use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use yii\helpers\Url;

use yii\helpers\Html;

use backend\models\AdminCharge;



$modelLabel = new \backend\models\AdminCharge();

?>

<?php $this->beginBlock('header'); ?>

<!-- <head></head>中代码块 -->

<?php $this->endBlock(); ?>

<style>

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

                            <a id="create_btn" href="<?= Url::toRoute('admin-charge/index') ?>"

                               class="btn btn-xs btn-primary">返回列表</a>

                        </div>

                    </div>

                </div>

                <!-- /.box-header -->



                <div class="box-body">



                    <div class="tab-content">

                        <div class="form-group">

                            <label for="id"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("id") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control" style="height: auto;min-height: 34px;"><?= $model->id ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="users_id"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("users_id") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->users_id ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="users_id"

                                   class="col-sm-2 control-label">信管家账号</label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $xgj_name ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="money"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("money") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->money ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="money"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("fee_money") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->fee_money ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="title"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("pay_type") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $pay_type[$model->pay_type] ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>





                        <div class="form-group">

                            <label for="title"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->title ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="dates"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("dates") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= date('Y-m-d H:i:s',$model->dates) ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="pay_ordersid"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("pay_ordersid") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->pay_ordersid ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="pay_ordersid"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("order_no") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->order_no ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="ip"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("ip") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control" style="height: auto;min-height: 34px;"><?= $model->ip ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="ip"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("state") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control" style="height: auto;min-height: 34px;"><?= $state[$model->state] ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="logo" class="col-sm-2 ">&nbsp;</label>

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

<?php $this->beginBlock('footer'); ?>

<?php $this->endBlock(); ?>

