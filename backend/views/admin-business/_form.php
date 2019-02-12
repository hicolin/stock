<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminBusiness */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-business-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'success_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exchange')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_buy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_open')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deal_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deal_num')->textInput() ?>

    <?= $form->field($model, 'deal_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actual_date')->textInput() ?>

    <?= $form->field($model, 'actual_his')->textInput() ?>

    <?= $form->field($model, 'z_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'system')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'float_yk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'close_yk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jc_service')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
