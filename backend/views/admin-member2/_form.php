<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-member-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usersname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userspwd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xgj_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xgj_pwd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'moneyFreeze')->textInput() ?>

    <?= $form->field($model, 'recom_id')->textInput() ?>

    <?= $form->field($model, 'isopen')->textInput() ?>

    <?= $form->field($model, 'dates')->textInput() ?>

    <?= $form->field($model, 'logdates')->textInput() ?>

    <?= $form->field($model, 'logip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lognums')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'edu')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cartid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cartfiles')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailcheck')->textInput() ?>

    <?= $form->field($model, 'emailcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marry')->textInput() ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'rndcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userspay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userspay2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bankid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bankcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bankaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfstatus')->textInput() ?>

    <?= $form->field($model, 'payordersid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
