<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'risk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'do_time')->textInput() ?>

    <?= $form->field($model, 'in_time')->textInput() ?>

    <?= $form->field($model, 'single_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'single_income')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amoun_money')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
