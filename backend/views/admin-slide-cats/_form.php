<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminSlideCats */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-slide-cats-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_idname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cat_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
