<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUserpeoduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-userpeoduct-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'proid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_province')->textInput() ?>

    <?= $form->field($model, 'bank_city')->textInput() ?>

    <?= $form->field($model, 'bank_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_zm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_fm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proxy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'license')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ht_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ht_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ht_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_file')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
