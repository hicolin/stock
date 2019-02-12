<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminLink;

$modelLabel = new \backend\models\AdminLink()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute(['admin-link/'.$view]) ?>"
                               class="btn btn-xs btn-primary">返回列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '<div class="span12 field-box">{input}</div>{error}',
                        ],
                        'options' => [
                            'class' => 'new_user_form inline-input',
                        ],
                        'id' => 'form',
                    ])
                    ?>
                    <div class="tab-content">
                        <div class="form-group">
                            <label for="link_url"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_url") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'link_url')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("link_url"), "id" => 'link_url']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="link_name"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_name") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'link_name')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("link_name"), "id" => 'link_name']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="link_status"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_status") ?></label>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'link_status')->dropDownList(
                                    ['1'=>'显示','0'=>'不显示']
                                ) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="link_type"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("link_type") ?></label>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'link_type')->dropDownList(
                                    ['1'=>'友情链接','2'=>'合作伙伴']
                                ) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="link_image" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("link_image")?></label>
                            <div class="col-sm-8" id="site_link_image">
                                <?=$model->link_image?'<img style="max-width:120px;height:80px" src="' . $model->link_image . '">':'暂未上传'?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link_image" class="col-sm-2 control-label"></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'link_image')->hiddenInput(["id"=>'link_image']) ?>
                                <input type="file" name="uploadfile" id="uploadfile" multiple class="file-loading" />
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="resource" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <?php echo Html::submitButton('保存', ['class' => "btn btn-primary"]); ?>
                                <span>&nbsp;</span>
                                <?php echo Html::resetButton('重置', ['class' => "btn btn-primary"]); ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script>
    $("#uploadfile").fileinput({
        language: 'zh', //设置语言
        uploadUrl: "<?=Url::toRoute(['public/upload'])?>", //上传的地址
        allowedFileExtensions: ['jpg', 'gif', 'png','jpng'],//接收的文件后缀
        //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
        uploadAsync: true, //默认异步上传
        showUpload: true, //是否显示上传按钮
        showRemove : true, //显示移除按钮
        showPreview : true, //是否显示预览
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        dropZoneEnabled: false,//是否显示拖拽区域
        maxFileCount: 1, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount:true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    });
    $('#uploadfile').on('fileerror', function(event, data, msg) {
        //alert(data);
    });
    //异步上传返回结果处理
    $("#uploadfile").on("fileuploaded", function (event, data, previewId, index) {
        var obj = data.response;
        var aa=JSON.stringify(obj.dir);
        var  bb=aa.replace('"','');
        var cc=bb.replace('"','');
        var html="<img style='max-width: 250px;' src='"+cc+"'>";
        $("#site_link_image").html(html);
        $('#link_image').val(cc);
        $("#link_image").fileinput({});
    });
</script>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
