<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminFile;
$modelLabel=new \backend\models\AdminFile()
?>
<?php  $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php  $this->endBlock(); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?=Url::toRoute('admin-file/index')?>" class="btn btn-xs btn-primary">软件列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <?php                    $form=ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '<div class="span12 field-box">{input}</div>{error}',
                        ],
                        'options' => [
                            'class' => 'new_user_form inline-input',
                        ],
                        'id'=>'form',
                    ])
                    ?>
                    <div class="tab-content">
                        <div class="form-group">
                            <label for="file_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_name")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'file_name')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("file_name"),"id"=>'file_name']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="file_desc" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_desc")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'file_desc')->textarea(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("file_desc"),"id"=>'file_desc']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="file_path" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_path")?></label>
                            <div class="col-sm-8" >
                                <?php echo $form->field($model,'file_path')->textInput(["class"=>"form-control","placeholder"=>'点击上传文件',"id"=>'file_path']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="file_path" class="col-sm-2 control-label" >&nbsp;</label>
                            <div class="col-sm-4" >
                                <input type="file" name="uploadfile" id="uploadfile" multiple class="file-loading" />
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="file_cover" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("file_cover")?></label>
                            <div class="col-sm-8" id="up_cover">
                               <?=($model->file_cover) ? '<img style="max-height: 100px;" src="'.$model->file_cover.'">' : "暂未上传！"?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="file_cover" class="col-sm-2 control-label" >&nbsp;</label>
                            <div class="col-sm-8" >
                                <input type="hidden" id="file_cover" value="<?=$model->file_cover?>" name="AdminFile[file_cover]">
                                <input type="file" name="uploadfile" id="uploadfile2" multiple class="file-loading" />
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="sort" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("sort")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'sort')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("sort"),"id"=>'sort']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form-group">
                            <label for="resource" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <?php echo Html::submitButton('保存', ['class' =>"btn btn-primary"]); ?>
                                <span>&nbsp;</span>
                                <?php echo Html::resetButton('重置', ['class' =>"btn btn-primary"]); ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php  ActiveForm::end();?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<?php  $this->beginBlock('footer');  ?>
<script>
    $("#uploadfile").fileinput({
        language: 'zh', //设置语言
        uploadUrl: "<?=Url::toRoute(['public/file'])?>", //上传的地址
        allowedFileExtensions: ['txt', 'zip', 'rar','exe','apk'],//接收的文件后缀
        //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
        uploadAsync: false, //默认异步上传
        showUpload: true, //是否显示上传按钮
        showRemove : true, //显示移除按钮
        showPreview : false, //是否显示预览
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        dropZoneEnabled: false,//是否显示拖拽区域
        maxFileCount: 1, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount:true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    }).on("filebatchselected", function(event, files) {
        $(this).fileinput("upload");
    }).on("fileuploaded", function (event, data, previewId, index) {
        var obj = data.response;
        var aa=JSON.stringify(obj.dir);
        var  bb=aa.replace('"','');
        var cc=bb.replace('"','');
        $('#file_path').val(cc);
    }).on("filebatchuploadsuccess", function (event, data, previewId, index) {
        var obj = data.response;
        var aa=JSON.stringify(obj.dir);
        var  bb=aa.replace('"','');
        var cc=bb.replace('"','');
        $('#file_path').val(cc);
    });
    $('#uploadfile').on('fileerror', function(event, data, msg) {
        //alert(data);
    });
    //异步上传返回结果处理

</script>
<script>
    $("#uploadfile2").fileinput({
        language: 'zh', //设置语言
        uploadUrl: "<?=Url::toRoute(['public/upload'])?>", //上传的地址
        allowedFileExtensions: ['jpg', 'gif', 'png','mp4'],//接收的文件后缀
        //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
        uploadAsync: false, //默认异步上传
        showUpload: true, //是否显示上传按钮
        showRemove : true, //显示移除按钮
        showPreview : false, //是否显示预览
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        dropZoneEnabled: false,//是否显示拖拽区域
        maxFileCount: 1, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount:true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    }).on("filebatchselected", function(event, files) {
        $(this).fileinput("upload");
    }).on("fileuploaded", function (event, data, previewId, index) {
        var obj = data.response;
        var aa=JSON.stringify(obj.dir);
        var  bb=aa.replace('"','');
        var cc=bb.replace('"','');
        $('#file_path').val(cc);
    }).on("filebatchuploadsuccess", function (event, data, previewId, index) {
        var obj = data.response;
        var aa=JSON.stringify(obj.dir);
        var  bb=aa.replace('"','');
        var cc=bb.replace('"','');
        $('#file_cover').val(cc);
        $("#up_cover").html('<img style="max-height: 100px;" src="'+cc+'">')
    });

</script>
<?php  $this->endBlock(); ?>
