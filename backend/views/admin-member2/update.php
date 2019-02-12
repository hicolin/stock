<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminMember;
use backend\models\AdminRegions;

$modelLabel = new \backend\models\AdminMember()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<style type="text/css">
    .tips {
        color: red;
    }

    .form-group {
        margin: 0
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
                               class="btn btn-xs btn-primary">会员列表</a>
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
                       <!-- <div class="form-group">
                            <label for="realname" class="col-sm-2 control-label tips">*&nbsp;号必填</label>
                        </div>-->
                        <div class="form-group">
                            <label for="realname"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("realname") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'realname')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("realname"), "id" => 'realname']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="usersname"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("usersname") ?>
                                &nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'usersname')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("usersname"), "id" => 'usersname']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form-group">
                            <label for="userspwd"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("userspwd") ?></label>
                            <div class="col-sm-8">
                                <input type="password" name="userspwd" placeholder="******" class="form-control">
                            </div>
                        </div>
                        <div class="clear"></div>
                       <!-- <div class="form-group">
                            <label for="vatation_code"
                                   class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("vatation_code") */?></label>
                            <div class="col-sm-8">
                                <?php /*echo $form->field($model, 'vatation_code')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("vatation_code"), "id" => 'vatation_code', 'disabled' => true]) */?>
                            </div>
                        </div>
                        <div class="clear"></div>-->
                        <div class="form-group">
                            <label for="vatation_code2"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("vatation_code2") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'vatation_code2')->textInput(["class" => "form-control", 'readonly'=>'readonly',"placeholder" => $modelLabel->getAttributeLabel("vatation_code2"), "id" => 'vatation_code2',]) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="xgj_name"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("xgj_name") ?></label>
                            <div class="col-sm-8">
                                <input type="text" name="xgj_name" class="form-control"
                                       value="<?php echo $model->xgj_name; ?>">
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form-group">
                            <label for="tel"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("tel") ?>
                                &nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'tel')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("tel"), "id" => 'tel']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="money"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("money") ?>
                                &nbsp;<i class="tips"></i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="money"
                                       value="<?php echo $model->money; ?>">
                            </div>
                        </div>

                       <!-- <div class="form-group">
                       <div class="clear"></div>
                            <label for="money"
                                   class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("money") */?>
                                &nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" disabled class="form-control" name="money"
                                       value="<?php /*echo $model->money; */?>">
                            </div>
                        </div>-->
                        <!--<div class="clear"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">可用资金/$&nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" disabled class="form-control" value="<?/*=$ky_money*/?>">
                            </div>
                            <div class="clear"></div>
                        </div>-->

                        <!--<div class="form-group">
                            <label for="money"
                                   class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("profit_money") */?>
                                &nbsp;<i class="tips">*</i></label>
                            <div class="col-sm-8">
                                <?php /*echo $form->field($model, 'profit_money')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("profit_money"), "id" => 'profit_money']) */?>
                            </div>
                        </div>-->
                        <div class="clear"></div>

                        <div class="form-group">
                            <label for="email"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("email") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'email')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("email"), "id" => 'email']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <div class="form-group">
                            <label for="edu"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("edu") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'edu')->dropDownList(["0" => "本科", "1" => "专科", "2" => "研究生", "3" => "硕士", "4" => "博士", "5" => "博士后"], ['style' => 'width:120px']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <?php
/*                        if($role_id==1) { */?><!--
                            <div class="form-group">
                                <label for="edu"
                                       class="col-sm-2 control-label">主账户</label>
                                <div class="col-sm-2">
                                    <?php /*echo $form->field($model, 'account_id')->dropDownList($account_list) */?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        --><?php /*}
                        */?>

                        <div class="form-group">
                            <label for="bank_name"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bank_name") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'bank_name')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("bank_name"), "id" => 'bank_name']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bankid"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bankid") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'bankid')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("bankid"), "id" => 'bankid']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <label for="bankcode"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bankcode") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'bankcode')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("bankcode"), "id" => 'bankcode']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>


                       <!-- <div class="form-group">
                            <label for="province"
                                   class="col-sm-2 control-label">开户行地址</label>
                            <div class="col-sm-1">
                                <?php /*echo $form->field($model, 'bank_province')->dropDownList(AdminRegions::getProvince(), ['style' => 'width:120px'], ['id' => 'province']); */?>
                            </div>
                            <div class="col-sm-1">
                                <?php /*echo $form->field($model, 'bank_city')->dropDownList(AdminRegions::getRegion($model->bank_province), ['style' => 'width:120px'], ['id' => 'city']); */?>
                            </div>
                        </div><div class="clear"></div>-->

                        <div class="form-group">
                            <label for="bankaddress"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("bankaddress") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'bankaddress')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("bankaddress"), "id" => 'bankaddress']) ?>
                            </div>
                        </div>
                        <div class="clear"></div>



                        <div class="form-group">
                            <label for="cartid" class="col-sm-2 control-label">开户行详细地址</label>
                            <div class="col-sm-8">
                                <span class="form-control"><?= $bank_province ?><?= $bank_city ?><?= $model->bankaddress ?></span>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!--<div class="form-group">
                            <label for="cartid" class="col-sm-2 control-label">银行卡照片</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="bank_pic" id="file_bank_pic" value="<?/*= $model->bank_pic */?>">
                                <img class="preview" id="bank_pic" width="100" height="150"
                                     src="<?/*= $model->bank_pic */?>">
                            </div>
                        </div>
                        <div class="clear"></div>-->
                        <div class="form-group">
                            <label for="cartid"
                                   class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cartid") ?></label>
                            <div class="col-sm-8">
                                <?php echo $form->field($model, 'cartid')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("cartid"), "id" => 'cartid']) ?>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="cartfiles"
                                   class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("cartfiles") */?></label>
                            <div class="col-sm-8" id="site_cartfiles">
                                <input type="hidden" id="cartfiles" name="cartfiles" zm="<?/*= $card_pic['zm'] */?>"
                                       fm="<?/*= $card_pic['fm'] */?>" case=""
                                       value="<?/*= $card_pic['zm'] . ',' . $card_pic['fm']  */?>">
                                <img class="preview" id="zm" width="100" height="100"
                                     src="<?/*= $card_pic['zm'] ?: '/frontend/web/images/card_zm.jpg' */?>">
                                <img class="preview" id="fm" style="margin-left: 100px;" width="100" height="100"
                                     src="<?/*= $card_pic['fm'] ?: '/frontend/web/images/card_fm.jpg' */?>">
                                <img class="preview" id="case" style="margin-left: 100px;" width="100" height="100"
                                     src="<?/*= $card_pic['case'] ?: '/frontend/web/images/card_case.jpg' */?>">
                            </div>
                        </div>-->
                    </div>
                    <div class="clear"></div>
                    <!--<div class="form-group">
                        <label for="province"
                               class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("address") */?></label>
                        <div class="col-sm-1">
                            <?php /*echo $form->field($model, 'province')->dropDownList(AdminRegions::getProvince(), ['style' => 'width:120px'], ['id' => 'provice']); */?>
                        </div>
                        <div class="col-sm-1">
                            <?php /*echo $form->field($model, 'city')->dropDownList(AdminRegions::getRegion($model->province), ['style' => 'width:120px'], ['id' => 'city']); */?>
                        </div>
                        <div class="col-sm-1" id="city">
                            <?php /*if ($model->area) {
                                echo $form->field($model, 'area')->dropDownList(AdminRegions::getRegion($model->city), ['style' => 'width:120px'], ['id' => 'city']);
                            } */?>
                        </div>
                        <div class="col-sm-5">
                            <?php /*echo $form->field($model, 'address')->textInput(["class" => "form-control", "placeholder" => $modelLabel->getAttributeLabel("address"), "id" => 'address']) */?>
                        </div>
                    </div>-->
<!--                    <div class="clear"></div>-->
                   <!-- <div class="form-group">
                        <label for="marry"
                               class="col-sm-2 control-label"><?php /*echo $modelLabel->getAttributeLabel("marry") */?></label>
                        <div class="col-sm-8">
                            <?php /*echo $form->field($model, 'marry')->dropDownList(["0" => "未婚", "1" => "已婚"], ['style' => 'width:120px']) */?>
                        </div>
                    </div><div class="clear"></div>-->

                    <div class="form-group">
                        <label for="state"
                               class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("state") ?></label>
                        <div class="col-sm-8">
                            <?php echo $form->field($model, 'state')->dropDownList($state, ['style' => 'width:120px']) ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php
                    if($model->state==2) { ?>
                    <div class="form-group">
                        <label for="state" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <a id="view_btn"
                               onclick="check(3,'<?= $model->id ?>','<?= $model->tel ?>','<?= $model->xgj_name ?>','<?= $model->xgj_pwd ?>')"
                               class="btn btn-primary btn-sm" href="javascript:;"><i
                                        class="glyphicon glyphicon-zoom-in icon-white"></i>通过</a>
                            <a id="view_btn"
                               onclick="check(0,'<?= $model->id ?>','<?= $model->tel ?>','<?= $model->xgj_name ?>','<?= $model->xgj_pwd ?>')"
                               class="btn btn-primary btn-sm" href="javascript:;"><i
                                        class="glyphicon glyphicon-zoom-in icon-white"></i>不通过</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php }
                    ?>

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
<div style="display: none">
    <input type="file" name="file" class="file" id="card_file"
           onchange="document.getElementById('textfield').value=this.value"/>
    <a href="javascript:" onclick="upload_card()" class="cart_btn">上传</a>
</div>
<input type="hidden" id="user_ss">
<input type="hidden" id="state_ss">
<div class="hidden" style="display:none;">
    <div>
        <div style="margin-top:30px;text-align:center;" class="first">
            <div style="float:left;height:35px;line-height:35px;margin-left:7%;font-size:14px;">主账户：</div>
            <select style="margin-top: 8px;margin-left: 0;float: left" id="account">
                <?php
                foreach ($account as $list) { ?>
                    <option style="width: 100px;" value="<?=$list->id?>"><?=$list->account?></option>
                <?php }
                ?>
            </select>
        <div style="clear:both"></div>
        <div style="text-align:center;margin-top:25px">
            <input type="button" value="确　定" class="pay_up" style="width:80px;height:30px;color:#fff;background:#14bc88;border:0px;border-radius:5px;">
        </div>
    </div>
</div>
<?php $this->beginBlock('footer'); ?>
<?php $this->endBlock(); ?>
<script type="text/javascript">
    var card_type = ''
    var xhr;
    function createXMLHttpRequest() {
        if (window.ActiveXObject) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        else if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        }
    }

    function upload_card() {
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

    function card() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200 || xhr.status == 0) {
                var result = xhr.responseText;
                var json = eval("(" + result + ")");
                $('#' + card_type).attr('src', json.dir)
                $('#cartfiles').attr(card_type, json.dir)
                var file_zm = $('#cartfiles').attr('zm')
                var file_fm = $('#cartfiles').attr('fm')
                var file_case = $('#cartfiles').attr('case')
                $('#cartfiles').val(file_zm + ',' + file_fm + ',' + file_case)
                var src = $("#bank_pic").attr('src')
                $('#file_bank_pic').val(src)
            }
        }
    }
</script>
<script>

    //修改身份证照片
    $(function () {
        $('.preview').on('click', function () {
            $('#card_file').click();
            card_type = $(this).attr('id')
        })
        var card_file = document.getElementById("card_file");
        card_file.onchange = function () {
            $('.cart_btn').click()
        }
    })
    var account = '';
    function check(state,user_id,tel,xgj_name,xgj_pwd) {
        $('#state_ss').val(state);
        $('#user_ss').val(user_id);
        if(state==3) {
            var html = $('.hidden').html();
            layer.open({
                type: 1,
                closeBtn:0,
                title: false,
                offset:['250px'],
                shadeClose: true,
                area:['300px','150px'],
                content:html,
            });
        }else{
            change_fuc();
        }
    }

    $('.pay_up').on('click',function(){
        account = $(this).parent('div').prevAll('select').val();
        //layer.closeAll();
        change_fuc();
    })

    function change_fuc() {
        var statess = $('#state_ss').val();
        var user_idss = $('#user_ss').val();
        $.ajax({
            type: "POST",
            url: "<?= Url::toRoute($this->context->id . '/change')?>",
            data: {"state": statess, 'user_id':user_idss, 'account':account},
            cache: false,
            dataType: "json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                //alert("出错了，" + textStatus);
            },
            success: function (data) {
                if(data==800) {
                    layer.alert('没有权限', {icon: 2});
                    return false;
                }else if(data==400) {
                    layer.alert('已经审核', {icon: 2});
                    window.location.reload();
                    return false;
                }else if(data==100 && statess==0) {
                    window.location.reload();
                }else if(data==100 && statess==3) {
                    var templateId = "141503";
                    $.ajax({
                        type: "POST",
                        url: "<?= Url::toRoute($this->context->id . '/get-info')?>",
                        data: {"id": user_idss},
                        cache: false,
                        dataType: "json",
                        error: function (xmlHttpRequest, textStatus, errorThrown) {
                            alert("出错了，" + textStatus);
                        },
                        success: function (data1) {
                            $.ajax({
                                url  : "/ucpass/ucpass2.php",
                                type : 'post',
                                data : {'tel':data1.tel,'templateId':templateId,'xgj_name':data1.xgj_name,'xgj_pwd':data1.xgj_pwd},
                                dataType:'text',
                                //beforeSend:function(){},
                                success: function (data2) {
                                    if(data2) {
                                        window.location.reload();
                                    }
                                }
                            });
                        }
                    });

                    //window.location.reload();
                }
            }
        });
    }
</script>


<script>
    $(document).ready(function () {
        $('#adminmember-province').change(function () {
            $.get("<?php echo Url::toRoute('admin-member/getcity'); ?>", //获取地区的URL
                {provice_id: $('#adminmember-province').val()},
                function (data) {
                    var options = '';
                    for (i in data) {
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    $("#adminmember-city").html(options); // 数据插入到地区下拉表！
                });
        })


        $('#adminmember-city').change(function () {
            $.get("<?php echo Url::toRoute('admin-member/getarea'); ?>", //获取地区的URL
                {city_id: $('#adminmember-city').val()},
                function (data) {
                    var options = '';
                    for (i in data) {
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    if (options) {
                        $("#city").show();
                        $("#adminmember-area").html(options); // 数据插入到地区下拉表！
                    }
                    else {
                        $("#city").hide();
                        $("#adminmember-area").html("");//清空数据
                    }

                });
        })
    });


    $(document).ready(function () {
        $('#adminmember-bank_province').change(function () {
            $.get("<?php echo Url::toRoute('admin-member/getcity'); ?>", //获取地区的URL
                {provice_id: $('#adminmember-bank_province').val()},
                function (data) {
                    var options = '';
                    for (i in data) {
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }
                    $("#adminmember-bank_city").html(options); // 数据插入到地区下拉表！
                });
        })


        $('#adminmember-bank_city').change(function () {
            $.get("<?php echo Url::toRoute('admin-member/getarea'); ?>", //获取地区的URL
                {city_id: $('#adminmember-bank_city').val()},
                function (data) {
                    var options = '';
                    for (i in data) {
                        options += "<option value=" + i + ">" + data[i] + "</option>"; //遍历赋值
                    }

                });
        })
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
        $("#site_cartfiles").html(html);
        $('#cartfiles').val(cc);
        $("#uploadfile").fileinput({});
    });

</script>