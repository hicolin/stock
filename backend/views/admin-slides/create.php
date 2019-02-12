<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSlides;
$modelLabel=new \backend\models\AdminSlides();
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
                            <a id="create_btn" href="<?=Url::toRoute('admin-slides/index')?>" class="btn btn-xs btn-primary">幻灯片管理列表</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <?php $form=ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '<div class="span12 field-box">{input}</div>{error}',
                        ],
                        'options' => [
                            'class' => 'new_user_form inline-input',
                            'enctype'=>'multipart/form-data',
                        ],
                        'id'=>'form',

                    ])
                    ?>
                    <div class="tab-content">

                        <div class="form-group">
                           <label for="slide_cid" class="col-sm-2 control-label" >分类</label>
                           <div class="col-sm-2">
                           <?php echo $form->field($model,'slide_cid')->dropDownList(AdminSlides::slideCat()) ?>
                           </div>
                        </div>
                         <div class="clear"></div>
                        <div class="form-group">
                           <label for="slide_name" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_name")?></label>
                           <div class="col-sm-8">
                           <?php echo $form->field($model,'slide_name')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("slide_name"),"id"=>'slide_name']) ?>
                           </div>
                        </div>
                         <div class="clear"></div>
                        <div class="form-group">
                           <label for="slide_pic" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_pic")?></label>
                           <div class="col-sm-8" id="">
                               <input type="file" name="uploadfile" id="uploadfile" multiple class="file-loading" />
                           </div>
                        </div>
                         <div class="clear"></div>
                        <div class="form-group">
                           <label for="slide_url" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_url")?></label>
                           <div class="col-sm-8">
                           <?php echo $form->field($model,'slide_url')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("slide_url"),"id"=>'slide_url']) ?>
                           </div>
                        </div>
                         <div class="clear"></div>
                        <div class="form-group">
                           <label for="slide_des" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_des")?></label>
                           <div class="col-sm-8">
                           <?php echo $form->field($model,'slide_des')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("slide_des"),"id"=>'slide_des']) ?>
                           </div>
                        </div>
                         <div class="clear"></div>
                        <div class="form-group">
                           <label for="slide_content" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_content")?></label>
                           <div class="col-sm-8">
                           <?php echo $form->field($model,'slide_content')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("slide_content"),"id"=>'slide_content']) ?>
                           </div>
                        </div>
                         <div class="clear"></div>
                        <div class="form-group">
                            <label for="slide_status" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("slide_status")?></label>
                            <div class="col-sm-2">
                                <?php echo $form->field($model,'slide_status')->dropDownList(AdminSlides::dropDownList('is_show')) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="listorder" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("listorder")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'listorder')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("listorder"),"id"=>'listorder']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <?php echo $form->field($model,'slide_pic')->hiddenInput(['id'=>'slide_pic'])?>
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
        uploadUrl: "<?=Url::toRoute(['public/upload-image'])?>", //上传的地址
        allowedFileExtensions: [ 'jpg', 'png','gif','jpeg'],//接收的文件后缀
        //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
        uploadAsync: true, //默认异步上传
        showUpload: true, //是否显示上传按钮
        showRemove : true, //显示移除按钮
        showPreview : true, //是否显示预览
        showCaption: false,//是否显示标题
        maxFileSize: 3*1024,
        browseClass: "btn btn-primary", //按钮样式
        dropZoneEnabled: false,//是否显示拖拽区域
        maxFileCount: 1, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount:true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    }).on("fileuploaded", function (event, data, previewId, index) {
        var obj = data.response;
        var aa=JSON.stringify(obj.dir);
        var bb=aa.replace('"','');
        var cc=bb.replace('"','');
        $('#slide_pic').val(cc);
    });

</script>
<?php  $this->endBlock(); ?>
