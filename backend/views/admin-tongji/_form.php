<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminTongji */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-tongji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'xgj_id')->textInput() ?>

    <?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jy_time')->textInput() ?>

    <?= $form->field($model, 'entrust')->textInput() ?>

    <?= $form->field($model, 'deal_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bourse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kaiping')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valence')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'amount_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sj_time')->textInput() ?>

    <?= $form->field($model, 'cj_time')->textInput() ?>

    <?= $form->field($model, 'account')->textInput() ?>

    <?= $form->field($model, 'xitong_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'charge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yingkui')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pc_yingkui')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jc_charge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
