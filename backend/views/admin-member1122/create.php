<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminMember;
use backend\models\AdminRegions;
$modelLabel=new \backend\models\AdminMember()
?>
<?php  $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php  $this->endBlock(); ?>
<style type="text/css">
.tips{color: red;}
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/index'])?>" class="btn btn-xs btn-primary">会员列表</a>
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
                    <label for="realname" class="col-sm-2 control-label tips" >*&nbsp;号必填</label>
                    </div>
                    
                    <div class="form-group">
                            <label for="realname" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("realname")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'realname')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("realname"),"id"=>'realname']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="usersname" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("usersname")?>&nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'usersname')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("usersname"),"id"=>'usersname']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="nickname" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("nickname")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'nickname')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("nickname"),"id"=>'nickname']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="sex" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("sex")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'sex')->dropDownList(["0"=>"男","1"=>"女"], ['style'=>'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="userspwd" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("userspwd")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'userspwd')->passwordInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("userspwd"),"id"=>'password']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="vatation_code" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("vatation_code")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'vatation_code')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("vatation_code"),"id"=>'vatation_code','value'=>$code,'disabled'=>true]) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="vatation_code2" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("vatation_code2")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'vatation_code2')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("vatation_code2"),"id"=>'vatation_code2']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="tel" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("tel")?>&nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'tel')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("tel"),"id"=>'tel']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!--<div class="form-group">
                            <label for="money" class="col-sm-2 control-label" ><?php /*echo $modelLabel->getAttributeLabel("money")*/?>&nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <?php /*echo $form->field($model,'money')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("money"),"id"=>'money']) */?>
                            </div>
                        </div>
                        <div class="clear"></div>-->
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("email")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'email')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("email"),"id"=>'email']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="emailcheck" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("emailcheck")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'emailcheck')->dropDownList(["0"=>"未审核","1"=>"已审核"], ['style'=>'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="edu" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("edu")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'edu')->dropDownList(["0"=>"本科","1"=>"专科","2"=>"研究生","3"=>"硕士","4"=>"博士","5"=>"博士后"], ['style'=>'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bank_name"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bank_name") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'bank_name')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("bank_name"), "id" => 'bank_name']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bankid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("bankid")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'bankid')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("bankid"),"id"=>'bankid']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bankaddress" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("bankaddress")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'bankaddress')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("bankaddress"),"id"=>'bankaddress']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="cartid" class="col-sm-2 control-label">银行卡照片</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="bank_pic" id="file_bank_pic" value="<?=$model->bank_pic?>" >
                                <img class="preview" id="bank_pic" width="100" height="150" src="<?=$model->bank_pic?>">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="cartid" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cartid")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'cartid')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("cartid"),"id"=>'cartid']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                         <div class="form-group">
                            <label for="cartfiles" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("cartfiles")?></label>
                             <div class="col-sm-8" id="site_cartfiles">
                                 <input type="hidden" id="cartfiles" name="cartfiles" zm="" fm="" case="" value="">
                                 <img class="preview" id="zm" width="100" height="100" src="/frontend/web/images/card_zm.jpg">
                                 <img class="preview" id="fm" style="margin-left: 100px;" width="100" height="100" src="/frontend/web/images/card_fm.jpg">
                                 <!--<img class="preview" id="case" style="margin-left: 100px;" width="100" height="100" src="/frontend/web/images/card_case.jpg">-->
                             </div>
                        </div>

                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="province" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("address")?></label>
                            <div class="col-sm-1">
                                <?php echo $form->field($model,'province')->dropDownList(AdminRegions::getProvince(), ['style'=>'width:120px'],['id'=>'provice']); ?>
                            </div>
                            <div class="col-sm-1">
                                <?php echo $form->field($model,'city')->dropDownList(AdminRegions::getRegion(1), ['style'=>'width:120px'],['id'=>'city']); ?>
                            </div>
                            <div class="col-sm-1" id="city" style="display: none;">
                                <?php echo $form->field($model,'area')->dropDownList(AdminRegions::getRegion(2), ['style'=>'width:120px'],['id'=>'city']); ?>
                            </div>
                            <div class="col-sm-5">
                                <?php echo $form->field($model,'address')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("address"),"id"=>'address']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!--<div class="form-group">
                            <label for="isopen" class="col-sm-2 control-label" ><?php /*echo $modelLabel->getAttributeLabel("isopen")*/?></label>
                            <div class="col-sm-8">
                                <?php /*echo $form->field($model,'isopen')->dropDownList(["0"=>"未开户","1"=>"已开户"], ['style'=>'width:120px']) */?>
                            </div>
                        </div>
                        <div class="clear"></div>-->
                        <div class="form-group">
                            <label for="marry" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("marry")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'marry')->dropDownList(["0"=>"未婚","1"=>"已婚"], ['style'=>'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="state" class="col-sm-2 control-label" ><?php echo $modelLabel->getAttributeLabel("state")?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'state')->dropDownList([0 => "未认证", 1 => "禁用",2=>'申请认证',3=>'已认证'], ['style' => 'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php echo $form->field($model,'dates')->hiddenInput(['value'=>time()]) ?>
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
<div style="display: none">
    <input type="file" name="file" class="file" id="card_file" onchange="document.getElementById('textfield').value=this.value" />
    <a href="javascript:" onclick="upload_card()" class="cart_btn" >上传</a>
</div>
<?php  $this->beginBlock('footer');  ?>
<?php  $this->endBlock(); ?>
<script type="text/javascript">
    var card_type = ''
    var xhr;
    function createXMLHttpRequest()
    {
        if(window.ActiveXObject)
        {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        else if(window.XMLHttpRequest)
        {
            xhr = new XMLHttpRequest();
        }
    }

    function upload_card()
    {
        var fileObj = document.getElementById("card_file").files[0];
        //服务器端的路径
        var FileController = "<?=Url::toRoute('/public/file')?>";
        var form = new FormData();
        //file可更改，在服务器端获取$_FILES['file']
        form.append("uploadfile", fileObj);
        createXMLHttpRequest();
        xhr.onreadystatechange = card;
        xhr.open("post", FileController, true);
        xhr.send(form);
    }

    function card()
    {
        if(xhr.readyState == 4)
        {
            if (xhr.status == 200 || xhr.status == 0)
            {
                var result = xhr.responseText;
                var json = eval("(" + result + ")");
                $('#'+card_type).attr('src',json.dir)
                $('#cartfiles').attr(card_type,json.dir)
                var file_zm = $('#cartfiles').attr('zm')
                var file_fm = $('#cartfiles').attr('fm')
                var file_case = $('#cartfiles').attr('case')
                $('#cartfiles').val(file_zm+','+file_fm+','+file_case)
                var src = $("#bank_pic").attr('src')
                $('#file_bank_pic').val(src)
            }
        }
    }
</script>
<script type="text/javascript">
    //修改身份证照片
    $(function(){
        $('.preview').on('click',function(){
            $('#card_file').click();
            card_type = $(this).attr('id')
        })
        var card_file = document.getElementById("card_file");
        card_file.onchange=function () {
            $('.cart_btn').click()
        }
    })

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
        $("#site_cartfiles").html(html);
        $('#cartfiles').val(cc);
        $("#uploadfile").fileinput({});
    });



    $(document).ready(function(){
        $('#adminmember-province').change(function() {
            $.get("<?php echo Url::toRoute('admin-member/getcity'); ?>", //获取地区的URL
                { provice_id: $('#adminmember-province').val()},
                function(data){
                    var options = '';
                    for(i in data){
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    $("#adminmember-city").html(options); // 数据插入到地区下拉表！
                });
        })



        $('#adminmember-city').change(function() {
            $.get("<?php echo Url::toRoute('admin-member/getarea'); ?>", //获取地区的URL
                { city_id: $('#adminmember-city').val()},
                function(data){
                    var options = '';
                    for(i in data){
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    if(options){
                        $("#city").show();
                        $("#adminmember-area").html(options); // 数据插入到地区下拉表！
                    }
                    else{
                        $("#city").hide();
                        $("#adminmember-area").html("");//清空数据
                    }

                });
        })
    });
</script>