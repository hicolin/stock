<?php

use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use yii\helpers\Url;

use yii\helpers\Html;

use backend\models\AdminMember;

use backend\models\AdminRegions;



$modelLabel = new \backend\models\AdminMember();

?>

<?php $this->beginBlock('header'); ?>

<!-- <head></head>中代码块 -->

<?php $this->endBlock(); ?>

<style>

    .form-control{

        border:1px solid #f4f4f4;

    }

    .control-label{

        text-align: inherit;

    }

    .form-group{

        width: 50%;

    }

</style>

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



                    <div class="tab-content">

                        <div class="form-group">

                            <label for="usersname"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("usersname") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->usersname ?></div>

                            </div>

                        </div>



                        <!--<div class="form-group">

                            <label for="nickname"

                                   class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("nickname") */?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?/*= $model->nickname */?></div>

                            </div>

                        </div>

                        <div class="clear"></div>-->

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="realname"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("realname") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->realname ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>



                        <div class="form-group">

                            <label for="vatation_code2"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("vatation_code") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->vatation_code ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="xgj_name"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("xgj_name") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->xgj_name ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <!--<div class="form-group">

                            <label for="xgj_pwd"

                                   class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("xgj_pwd") */?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?/*= $model->xgj_pwd */?></div>

                            </div>

                        </div>

                        <div class="clear"></div>-->

                        <div class="form-group">

                            <label for="tel"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("tel") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->tel ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="email"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("email") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->email ?></div>

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

                            <label for="bankid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bank_name") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->bank_name?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="bankaddress"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bankaddress") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->bankaddress ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="bankid"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bankid") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->bankid ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="bankid" class="col-sm-2 control-label">开户行详细地址</label>

                            <div class="col-sm-8">

                                <div class="form-control" style="height: auto;min-height: 34px;"><?=$model->bank_province?><?=$model->bank_city?><?=$model->bankaddress?></div>

                            </div>

                        </div>

                       <!-- <div class="clear"></div>

                        <div class="form-group">

                            <label for="bankid" class="col-sm-2 control-label">银行卡照片</label>

                            <div class="col-sm-8">

                                <img src="<?/*=$model->bank_pic*/?>" width="120" height="200" >

                            </div>

                        </div>-->

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="cartid"

                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cartid") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control"

                                     style="height: auto;min-height: 34px;"><?= $model->cartid ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="dates" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("dates") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control" style="height: auto;min-height: 34px;"><?= date("Y-m-d H:i:s", $model->dates) ?></div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="form-group">

                            <label for="state" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("state") ?></label>

                            <div class="col-sm-8">

                                <div class="form-control" style="height: auto;min-height: 34px;">

                                    <?=$state[$model->state]?>

                                </div>

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

