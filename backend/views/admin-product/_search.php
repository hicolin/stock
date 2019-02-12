<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'risk') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'do_time') ?>

    <?= $form->field($model, 'in_time') ?>

    <?php // echo $form->field($model, 'single_money') ?>

    <?php // echo $form->field($model, 'single_income') ?>

    <?php // echo $form->field($model, 'amoun_money') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
