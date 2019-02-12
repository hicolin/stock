<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'link_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link_status')->textInput() ?>

    <?= $form->field($model, 'link_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
