<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminHousekeeper;

$modelLabel = new \backend\models\AdminHousekeeper()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'template' => '<div  class="span12 field-box">{input}</div>{error}',
    ],
    'action' => ['admin-housekeeper/import'],
    'method' => 'post',
    'options' => [
        'class' => 'new_user_form inline-input',
        'enctype' => 'multipart/form-data',
    ],
    'id' => 'form',
])
?>

<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
<input name="file" type="file" id="file_btn" class="btn btn-warning" />
<input id="addBtn" type="submit" name="submit" class="btn btn-success btn-lg" style="margin:20px 200px;text-align:center;" value="批量导入用户数据">

<?php ActiveForm::end(); ?>
<?php $this->beginBlock('footer'); ?>

<?php $this->endBlock(); ?>
