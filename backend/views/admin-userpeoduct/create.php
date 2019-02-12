<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminUserpeoduct;
use backend\models\AdminRegions;

$modelLabel = new \backend\models\AdminUserpeoduct()
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

                            <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"
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
                            <label for="uname"
                                   class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'uname')->textInput(["class"=>"form-control","placeholder"=>"请输入用户名","id"=>'uname']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php
                        /*                        if(in_array($role_id, [1,5,6,7])) { */?>
                        <div class="form-group">
                            <label for="uname"
                                   class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-8">
                                <input type="text" name="password" class="form-control" placeholder="请输入密码" id="password">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php /*}
                        */?>
                        <div class="form-group">
                            <label for="vatation_code"
                                   class="col-sm-2 control-label">被邀请码</label>
                            <div class="col-sm-8">
                                <input type="text" name="vatation_code" id="vatation_code" class="form-control" readonly placeholder="请输入被邀请码" value="<?=$invitation?>">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!--<div class="form-group">
                            <label for="rate"
                                   class="col-sm-2 control-label">返佣金额/￥</label>
                            <div class="col-sm-8">
                                <?php /*echo $form->field($model,'commission')->textInput(["class"=>"form-control","placeholder"=>"返佣金额","id"=>'commission']) */?>
                            </div>
                        </div>
                        <div class="clear"></div>-->
                        <!--<div class="form-group">
                            <label for="rate"
                                   class="col-sm-2 control-label">返佣周期</label>
                            <div class="col-sm-8">
                                <?php /*echo $form->field($model,'commission_cycle')->textInput(["class"=>"form-control","placeholder"=>"返佣周期","id"=>'commission_cycle']) */?>
                            </div>
                        </div>
                        <div class="clear"></div>-->

                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="id_card" class="col-sm-2 control-label">身份证号</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'id_card')->textInput(["class"=>"form-control","placeholder"=>"请输入身份证号码","id"=>'id_card']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bank_name" class="col-sm-2 control-label">银行卡户名</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'bank_name')->textInput(["class"=>"form-control","placeholder"=>"请输入银行卡户名","id"=>'bank_name']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bank_name" class="col-sm-2 control-label">银行名称</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'bank_id')->textInput(["class"=>"form-control","placeholder"=>"请输入银行名称","id"=>'bank_id']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bank_code" class="col-sm-2 control-label">银行卡卡号</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'bank_code')->textInput(["class"=>"form-control","placeholder"=>"请输入银行卡卡号","id"=>'bank_code']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bank_code" class="col-sm-2 control-label">绑定银行卡手机号</label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model,'bank_tel')->textInput(["class"=>"form-control","placeholder"=>"绑定银行卡手机号","id"=>'bank_tel']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="province"
                                   class="col-sm-2 control-label">开户行地址</label>
                            <div class="col-sm-1">
                                <select class="form-control" style="width: 120px" name="AdminUserpeoduct[bank_province]" id="adminuserpeoduct-bank_province">
                                    <?php foreach ($province as $k => $val){ ?>
                                        <option <?php if($val['id'] == $model->bank_province){echo 'selected';}?> value="<?=$val['id']?>"><?=$val['name']?></option>
                                    <?php } ?>
                                </select>
                                <!--                                --><?php //echo $form->field($model, 'bank_province')->dropDownList(AdminRegions::getProvince(), ['style' => 'width:120px'], ['id' => 'province']); ?>
                            </div>

                            <div class="col-sm-1">
                                <select class="form-control" style="width: 120px" name="AdminUserpeoduct[bank_city]" id="adminuserpeoduct-bank_city">
                                    <?php foreach ($city as $k => $val){ ?>
                                        <option <?php if($val['id'] == $model->bank_city){echo 'selected';}?> value="<?=$val['id']?>"><?=$val['name']?></option>
                                    <?php } ?>
                                </select>
                                <!--                                --><?php //echo $form->field($model, 'bank_city')->dropDownList(AdminRegions::getRegion($model->bank_province), ['style' => 'width:120px'], ['id' => 'city']); ?>
                            </div>
                            <div class="col-sm-1">
                                <?php echo $form->field($model,'bank_address')->textInput(["class"=>"form-control","placeholder"=>$modelLabel->getAttributeLabel("bank_address"),"id"=>'bank_address']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>


                        <div class="clear"></div>

                        <div class="form-group">
                            <label for="contract" class="col-sm-2 control-label" >文档</label>
                            <div class="col-sm-6" >
                                <!--                                <input type="text" id="contract" name="license">-->
                                <?php echo $form->field($model,'license')->textInput(["class"=>"form-control","placeholder"=>"请打包上传所需文档","id"=>'license']) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="col-sm-2 control-label" >&nbsp;</label>
                            <div class="col-sm-8" id="photo_img">
                                <input type="file" name="uploadfile" id="uploadfile2" multiple class="file-loading" />
                                <span class="red" style="color: red;">*请打包上传所需文档</span>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="bank_code" class="col-sm-2 control-label">其他电子文档</label>
                            <div class="col-sm-8" id="other">
                                <input type="hidden" name="other_file" id="other_file" value="" >
                                <img file_num=""  class="preview1" id="ht_3" width="100" height="100" src="/backend/web/images/other.png">
                            </div>
                        </div>-->
                        <div class="clear"></div>
                        <div class="clear"></div>
                        <!--<div class="form-group">
                            <div class=" col-sm-offset-2 col-sm-8" style="color:red;">
                                请输入收取下级代理手续费
                            </div>
                        </div>-->
                        <!--<div class="clear"></div>
                        <div class="form-group" id="pro">
                            <label class="col-sm-2 control-label" >请选择产品</label>
                            <div class="col-sm-8">
                                <?php /*foreach($product as $key=>$value){
                                    echo $key%2==0?'<div>':'';
                                    if(isset($proid)){
                                        if (in_array($value->id, $proid)) {
                                            $check = "checked";
                                        } else {
                                            $check = "";
                                        }
                                    }
                                    */?>

                                    <label style="width: 150px;">
                                        <input id="<?/*=$key*/?>" type="checkbox" name="proid[]" value="<?/*=$value->id*/?>" <?/*=isset($check) ? $check : 'checked'*/?>>
                                        <label for="<?/*=$key*/?>"><?/*=$value->title*/?></label>
                                        <input checked id="<?/*=$key*/?>" type="checkbox" name="proid[]" value="<?/*=$value->id*/?>">
                                        <label for="<?/*=$key*/?>"><?/*=$value->title*/?></label>
                                    </label>
                                    <label style="margin-right: 120px;">
                                        <span>价格(笔)：</span>

                                        <?php /*if(isset($proid)){*/?>
                                        <input type="text" name="price[]" value="<?php /*if(in_array($value->id,$proid)){echo $pid_price[$value->id]?:'0';}*/?>" class="form-control" style="width: 120px;display: inline">
                                        <?php /*}else{ */?>
                                        <input type="text" name="price[]" class="form-control" style="width: 120px;display: inline">
                                        <?php /*}*/?>
                                        <?php
                        /*                                        if($value->code=='DAX') {
                                                                    echo '/欧元';
                                                                }else if($value->code=='HSI' || $value->code=='MHI') {
                                                                    echo '/港币';
                                                                }else {
                                                                    echo '/¥';
                                                                }
                                                                */?>
                                    </label>

                                <?php
                        /*                                    echo $key%2!=0?'</div>':'';
                                                        } */?>
                            </div>
                        </div>-->
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="resource" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <input type="button" value="保存" class="btn btn-primary" onclick="return sub()" >
                                <span>&nbsp;</span>
                                <?php echo Html::resetButton('重置', ['class' => "btn btn-primary"]); ?>
                                <span>&nbsp;</span>
                                <input type="button" value="返回" class="btn btn-primary" onclick="javascript:history.go(-1);" >
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
<div style="display: none">
    <input type="file" name="file" class="file" id="card_file" onchange="document.getElementById('textfield').value=this.value" />
    <a href="javascript:" onclick="upload_card()" class="cart_btn" >上传</a>
</div>
<script>
    $("#uploadfile2").fileinput({
        language: 'zh', //设置语言
        uploadUrl: "<?=Url::toRoute(['public/upload-file'])?>", //上传的地址
        allowedFileExtensions: [ 'rar', 'zip','doc','docx','pdf'],//接收的文件后缀
        //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
        uploadAsync: false, //默认异步上传
        showUpload: true, //是否显示上传按钮
        showRemove : true, //显示移除按钮
        showPreview : false, //是否显示预览
        showCaption: false,//是否显示标题
        browseLabel:'选择文件',
        browseClass: "btn btn-primary", //按钮样式
        dropZoneEnabled: false,//是否显示拖拽区域
        maxFileCount: 1, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount:true,
//        maxFileSize: 6*1000,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    }).on("filebatchselected", function(event, files) {
            $(this).fileinput("upload");
        })
        .on("filebatchuploadsuccess", function(event, data) {
            var obj = data.response;
            var aa=JSON.stringify(obj.dir);
            var bb=aa.replace('"','');
            var cc=bb.replace('"','');
            $('#license').val(cc)
        });
</script>
<script>
    $(document).ready(function () {
        $('#adminuserpeoduct-bank_province').change(function () {
            $.get("<?php echo Url::toRoute('/admin-member/getcity'); ?>", //获取地区的URL
                {provice_id: $('#adminuserpeoduct-bank_province').val()},
                function (data) {
                    var options = '';
                    for (i in data) {
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    $("#adminuserpeoduct-bank_city").html(options); // 数据插入到地区下拉表！
                });
        })


//        $(function(){
//            $.get("<?php //echo Url::toRoute('admin-member/getcity'); ?>//", //获取地区的URL
//                {city_id: $('#adminuserpeoduct-bank_province').val()},
//                function (data) {
//                    var options = '';
//                    for (i in data) {
//                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
//                    }
//                    $("#adminuserpeoduct-bank_city").html(options); // 数据插入到地区下拉表！
//                }
//            );
//        })

    });
</script>

<script type="text/javascript">
    var card_type = ''
    var is_dt = 0;
    var other_num = 0;
    var file_num = 0;
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
                if(is_dt==1) {
                    var img = '<img style="margin-right: 10px;" file_path="'+json.dir+'" file_num="'+other_num+'" class="preview2" id="file_'+other_num+'"  width="100" height="100" src="'+json.dir+'">';
                    $('.preview1').before(img);
                } else if(is_dt==2){
                    $('#file_'+file_num).attr('src',json.dir);
                    $('#file_'+file_num).attr('file_path',json.dir);
                } else {
                    $('#'+card_type).attr('src',json.dir)
                    $('#'+card_type+'_pic').val(json.dir)
                }
            }
        }
    }

    $(function(){
        //单图
        $('.preview').on('click',function(){
            $('#card_file').click();
            card_type = $(this).attr('id')
            is_dt=0;
        })
        var card_file = document.getElementById("card_file");
        card_file.onchange=function () {
            $('.cart_btn').click()
        }

        //多图
        $(document).on('click','.preview2',function(){
            file_num = $(this).attr('file_num')
            is_dt=2;
            $('#card_file').click();
        })
    })
</script>
<script>
    $('.preview1').on('click',function(){
        other_num++;
        is_dt=1;
        $('#card_file').click();
    })
</script>
<script>
    function sub(){
        var uname = $('#uname').val();
        var eur_usd = $('#EUR-USD').val();
        var hkd_usd = $('#HKD-USD').val();
        var rmb_usd = $('#USD-RMB').val();
        var id_card = $('#id_card').val();
        var bank_name = $('#bank_name').val();
        var bank_code = $('#bank_code').val();
        var bank_province = $('#adminuserpeoduct-bank_province').val();
        var bank_city = $('#adminuserpeoduct-bank_city').val();
        var bank_address = $('#bank_address').val();
        var card_zm_pic = $('#card_zm_pic').val();
        var card_fm_pic = $('#card_fm_pic').val();
        var bank_pic_pic = $('#bank_pic_pic').val();
        if(!uname) {
            layer.tips('请输入信息', '#uname',{tips:3});
            $('#uname').focus();
            return false;
        }else if(!id_card){
            layer.tips('请输入信息', '#id_card',{tips:3});
            $('#id_card').focus();
            return false;
        }else if(!bank_name){
            layer.tips('请输入信息', '#bank_name',{tips:3});
            $('#bank_name').focus();
            return false;
        }else if(!bank_code){
            layer.tips('请输入信息', '#bank_code',{tips:3});
            $('#bank_code').focus();
            return false;
        }else if(!bank_province){
            layer.tips('请输入信息', '#bank_province',{tips:3});
            $('#bank_province').focus();
            return false;
        }else if(!bank_city){
            layer.tips('请输入信息', '#bank_city',{tips:3});
            $('#bank_city').focus();
            return false;
        }else if(!bank_address){
            layer.tips('请输入信息', '#bank_address',{tips:3});
            $('#bank_address').focus();
            return false;
        }
        var check_id = document.getElementsByName("proid[]");
        for(var i=0;i<check_id.length;i++){
            check_id[i].checked=true;
        }
        var price = document.getElementsByName("price[]");
        for(var i=0;i<price.length;i++){
            if(!price[i].value) {
                layer.msg('请输入产品价格');
                return false;
            }
        }
        var str = '';
        $('#other .preview2').each(function(){
            str += ','+$(this).attr('src');
        })

        $('#other_file').val(str);
        var zj_action = "<?=Yii::$app->controller->action->id?>";
        if(zj_action=='create'){
            $.post("<?=Url::toRoute(['admin-userpeoduct/cc-name'])?>",{uname:uname,_csrf:"<?=Yii::$app->request->csrfToken?>"},function(msg){
                if(msg==200){
                    layer.tips('用户名已被使用', '#uname',{tips:3});
                    $('#uname').focus();
                    return false;
                }else if(msg==600){
                    $("#form").submit();
                    $("#put_up").removeAttr("onclick");
                    return false;
                }
            });
            return false;
        }
        $("#form").submit();
        $("#put_up").removeAttr("onclick");
        return false;


    }
</script>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
