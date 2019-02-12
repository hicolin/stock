<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminContent;

$modelLabel = new \backend\models\AdminContent()
?>
<?php $this->beginBlock('header'); ?>
<script src="/common/widgets/ueditor/vendor/ueditor.config.js"></script>
<script src="/common/widgets/ueditor/vendor/ueditor.all.min.js"></script>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<style>
    #sorting {
        width: 120px;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"
                               class="btn btn-xs btn-primary">内容列表</a>
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
                            <label for="title"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sortid") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'sortid')->dropDownList($tree) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="title"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'title')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("title"), "id" => 'title']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="keyword"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("keyword") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'keyword')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("keyword"), "id" => 'keyword']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="author"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("author") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'author')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("author"), "id" => 'author']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="views"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("views") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'views')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("views"), "id" => 'views']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="describe"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("describe") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'describe')->textarea(['rows' => 3, "class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("describe"), "id" => 'describe']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="contact"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("contact") ?></label>
                            <div class="col-sm-8">
                                <script id="container" name="contact" type="text/plain"></script>
                            </div>
                        </div>
                        <div class="clear"></div>


                        <div class="form-group">
                            <label for="img"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("img") ?></label>
                            <div class="col-sm-8" id="site_img">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'img')->hiddenInput(["id" => 'img']) ?>
                                <input type="file" name="uploadfile" id="uploadfile" multiple class="file-loading"/>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="top"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("top") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'top')->dropDownList(["0" => "否", "1" => "是"], ['style' => 'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="top"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("recommend") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'recommend')->dropDownList(["0" => "否", "1" => "是"], ['style' => 'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="sorting"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sorting") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'sorting')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("sorting"), "id" => 'sorting']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php echo $form->field($model, 'addtime')->hiddenInput(['value' => time()]) ?>
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
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        initialFrameHeight: 300,

    });


    $("#uploadfile").fileinput({
        language: 'zh', //设置语言
        uploadUrl: "<?=Url::toRoute(['public/upload'])?>", //上传的地址
        allowedFileExtensions: ['jpg', 'gif', 'png', 'jpng'],//接收的文件后缀
        //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
        uploadAsync: true, //默认异步上传
        showUpload: true, //是否显示上传按钮
        showRemove: true, //显示移除按钮
        showPreview: true, //是否显示预览
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        dropZoneEnabled: false,//是否显示拖拽区域
        maxFileCount: 1, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount: true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    });
    $('#uploadfile').on('fileerror', function (event, data, msg) {
        //alert(data);
    });
    //异步上传返回结果处理
    $("#uploadfile").on("fileuploaded", function (event, data, previewId, index) {
        var obj = data.response;
        var aa = JSON.stringify(obj.dir);
        var bb = aa.replace('"', '');
        var cc = bb.replace('"', '');
        var html = "<img style='max-width: 250px;' src='" + cc + "'>";
        $("#site_img").html(html);
        $('#img').val(cc);
        $("#uploadfile").fileinput({});
    });
</script>