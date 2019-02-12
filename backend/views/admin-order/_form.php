<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goods_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'order_sn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_my_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_ly_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_bl')->textInput() ?>

    <?= $form->field($model, 'order_zy_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_zs_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_charge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_hander')->textInput() ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <?= $form->field($model, 'begin_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'profit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loss')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
