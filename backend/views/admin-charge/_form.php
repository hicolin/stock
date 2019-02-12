<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminCharge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-charge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usersId')->textInput() ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dates')->textInput() ?>

    <?= $form->field($model, 'pay_ordersId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip')->textInput() ?>

    <?= $form->field($model, 'pay_type')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
