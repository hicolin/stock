<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminSlides */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-slides-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slide_cid')->textInput() ?>

    <?= $form->field($model, 'slide_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slide_pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slide_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slide_des')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slide_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'slide_status')->textInput() ?>

    <?= $form->field($model, 'listorder')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
