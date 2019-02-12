<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSetting;
use yii\bootstrap\Tabs;

$modelLabel = new \backend\models\AdminSetting()
?>
    


<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

    <!--<main id="content" role="main">

          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-lg-4">
                <h2 class="h4">发送账号选择方式</h2>
                <p>
                  <input id="checkbox" value="<?/*=$model63->val*/?>"  onclick="state()"  type="checkbox" <?/*=$model63->val==1?'checked':''*/?>  >

                </p>
                <div class="btn-group">
                    <span style="color:red">(*注意:勾选为短信发送，不勾选则为邮箱发送)</span>
                </div>
              </div>
                 </div>
              </div>
         
    </main>-->
<script type="text/javascript">
    function state(){
       
         //选中，返回true，没选中，返回false  
        var checkbox =$("#checkbox").val();

        var csrf= "<?=Yii::$app->request->csrfToken?>";
        $.ajax({
            type:'POST',
            url:'<?=Url::toRoute($this->context->id . '/sendtype')?>',
            data:{checkbox:checkbox,_csrf:csrf},
            success:function(data){
              
                if(data==100){

                    layer.msg('登录成功!',{time:2000},function(){
                               
                  });
                }

               
            }
        })

    }
</script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <!--<a id="create_btn" href="<?/*= Url::toRoute([$this->context->id . '/create']) */?>"
                               class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>-->
                            &nbsp;&nbsp;

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div> </div>
                <div class="box-body">
                    <div class="col-sm-12 row">
                        <table class="table table-bordered">
                            <?php
                            echo Tabs::widget([
                                'items' => [
                                     [
                                         'label' => $setting[1],
                                         'url' => Url::toRoute(['admin-setting/index', 'id' => 1]),
                                         'active' => $type == 1 ? true : ''
                                     ],

                                    [
                                        'label' => $setting[2],
                                        'url' => Url::toRoute(['admin-setting/index', 'id' => 2]),
                                        'active' => $type == 2 ? true : ''
                                    ],

//                                     [
//                                         'label' => $setting[3],
//                                         'url' => Url::toRoute(['admin-setting/index', 'id' => 3]),
//                                         'active' => $type == 3 ? true : ''
//                                     ],

                                    [
                                        'label' => $setting[4],
                                        'url' => Url::toRoute(['admin-setting/index', 'id' => 4]),
                                        'active' => $type == 4 ? true : ''
                                    ],

                                    [
                                        'label' => $setting[5],
                                        'url' => Url::toRoute(['admin-setting/index', 'id' => 5]),
                                        'active' => $type == 5 ? true : ''
                                    ],
                                    [
                                        'label' => $setting[6],
                                        'url' => Url::toRoute(['admin-setting/index', 'id' => 6]),
                                        'active' => $type == 6 ? true : ''
                                    ],
                                    [
                                        'label' => $setting[7],
                                        'url' => Url::toRoute(['admin-setting/index', 'id' => 7]),
                                        'active' => $type == 7 ? true : ''
                                    ],
                                    /*[
                                        'label' => $setting[8],
                                        'url' => Url::toRoute(['admin-setting/index', 'id' => 8]),
                                        'active' => $type == 8 ? true : ''
                                    ],  */
                                ],
                            ]);
                            ?>

                            <?php
                            foreach ($list as $k => $arr) { ?>
                                <!--<tr>
                            <th class="active col-sm-12" colspan="2" style="color: #3c8dbc;">
                                <? /*= $setting[$k]*/ ?>
                            </th>
                        </tr>-->
                                <?php foreach ($arr as $key => $arr1) { ?>

 
                                    <tr>
                                        <td class="col-sm-2">
                                            <label for="<?= $arr1['id'] ?>">
                                                <input readonly type="text" class="form-control setting" field="key"
                                                       id="<?= $arr1['id'] ?>" value="<?= $arr1['key'] ?>">
                                            </label>
                                            <?php
                                            if ($arr1['type'] == 5 && $arr1['status'] == 1) {
                                                echo "<label style='font-size: 12px;color: red'>PC端轮播图大小：<span style='font-size: 14px;'>1920*520</span></label>";
                                            }else if($arr1['type'] == 5 && $arr1['status'] == 0){
                                                echo "<label style='font-size: 12px;color: red'>手机端轮播图大小：<span style='font-size: 14px;'>1250*450</span></label>";
                                            }
                                            ?>
                                        </td>

                                        <td>


                                           <?php
                                                if ($arr1['type'] == 2) {?>
                                                        <?php if($arr1['status']== 1 && $arr1['id']==53){?>
                                                            <select name="key" id="<?=$arr1['id']?>" class="form-control pay" style="width: 20%">
                                                                <option value="1" <?=$arr1['val']==1 ?'selected':''?>>开启</option>
                                                                <option value="2" <?=$arr1['val']==2 ?'selected':''?>>关闭</option>
                                                            </select>

                                                        <?php } ?>

                                                    <?php if($arr1['status']== 1 && $arr1['id']==65){?>
                                                            <select name="key" id="<?=$arr1['id']?>" class="form-control pay" style="width: 20%">
                                                                <option value="1" <?=$arr1['val']==1 ?'selected':''?>>开启</option>
                                                                <option value="2" <?=$arr1['val']==2 ?'selected':''?>>关闭</option>
                                                            </select>

                                                        <?php } ?>

                                                    <?php if($arr1['id']==63 && $arr1['status']== 1){?>
                                                        <select name="key" id="<?=$arr1['id']?>" class="form-control pay" style="width: 20%">
                                                            <option value="1" <?=$arr1['val']==1 ?'selected':''?>>短信发送</option>
                                                            <option value="2" <?=$arr1['val']==2 ?'selected':''?>>邮箱发送</option>
                                                        </select>

                                                    <?php } ?>
                                                <?php }
                                            ?>                                            


                                            <?php if ($arr1['id'] == 1) { ?>
                                                <select name="key" id="<?=$arr1['id']?>" class="form-control pay" style="width: 20%">
                                                    <option value="1" <?=$arr1['val']==1 ?'selected':''?>>开启</option>
                                                    <option value="2" <?=$arr1['val']==2 ?'selected':''?>>关闭</option>
                                                </select>
                                            <?php } else { ?>

                                                <?php
                                                if ($arr1['type'] == 4) { ?>
                                                    <a class="change_img" id="<?= $arr1['id'] ?>"
                                                       style="width: 100px;height: 100px;"><img
                                                            id="img<?= $arr1['id'] ?>" width="100" height="100"
                                                            src="<?= $arr1['val'] ?: '/backend/web/images/default.jpg' ?>"></a>
                                                <?php } elseif ($arr1['type'] == 5) { ?>


                                                    <a class="change_img" id="<?= $arr1['id'] ?>"
                                                       style="width: 100%;height: 100px;"><img
                                                            id="img<?= $arr1['id'] ?>" height="100"
                                                            src="<?= $arr1['val'] ?: '/backend/web/images/default.jpg' ?>">
                                                    </a>
                                               

                                                <?php } elseif ($arr1['type'] == 6) { ?>
                                                    <input type="text" class="form-control setting" field="val"
                                                           id="<?= $arr1['id'] ?>" placeholder="<?= $arr1['key'] ?>"
                                                           value="<?= $arr1['val'] ?>">
                                                <?php } elseif ($arr1['type'] == 7) { ?>
                                                    <?php if($arr1['status']== 1){?>
                                                        <select name="key" id="<?=$arr1['id']?>" class="form-control pay" style="width: 20%">
                                                            <option value="1" <?=$arr1['val']==1 ?'selected':''?>>关闭</option>
                                                            <option value="2" <?=$arr1['val']==2 ?'selected':''?>>支付一</option>
                                                            <option value="3" <?=$arr1['val']==3 ?'selected':''?>>支付二</option>
                                                        </select>

                                                    <?php }else{?>
                                                        <input type="text" class="form-control setting" style="width: 30%" field="val"
                                                               id="<?= $arr1['id'] ?>" placeholder="<?= $arr1['key'] ?>"
                                                               value="<?= $arr1['val'] ?>">
                                                    <?php }?>
                                                <?php } else { ?>
                                                    <?php if($arr1['type'] == 2&& $arr1['status']== 1){

                                                    }else{ ?>

                                                     <input type="text" class="form-control setting" field="val"
                                                           id="<?= $arr1['id'] ?>" placeholder="<?= $arr1['key'] ?>"
                                                           value="<?= $arr1['val'] ?>">
                                                           
                                                    <?php }  ?>

                                                <?php }
                                                ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                        </table>
                    </div>
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


<div style="display: none">
    <input type="file" name="file" class="file" id="file"
           onchange="document.getElementById('textfield').value=this.value"/>
    <span onclick="UpladFile()" class="mybtn">上传</span>
</div>
<script type="text/javascript">
    $(".pay").change(function(){
        var val = $(this).val();
        var aid = $(this).attr('id');
        $.post('<?=Url::toRoute(['admin-setting/pay-update'])?>',{val:val,id:aid},function(data){
            if(data){
                window.location.reload();
            }
        })
    });
    var xhr;
    function createXMLHttpRequest() {
        if (window.ActiveXObject) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        else if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        }
    }

    function UpladFile() {
        var fileObj = document.getElementById("file").files[0];
        //服务器端的路径
        var FileController = "<?=Url::toRoute('/public/file')?>";
        var form = new FormData();
        //file可更改，在服务器端获取$_FILES['file']
        form.append("uploadfile", fileObj);
        createXMLHttpRequest();
        xhr.onreadystatechange = deal;
        xhr.open("post", FileController, true);
        xhr.send(form);
    }

    function deal() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200 || xhr.status == 0) {
                var result = xhr.responseText;
                var json = eval("(" + result + ")");
                $('#img' + img_id).attr('src', json.dir)
                $.ajax({
                    type: "POST",
                    url: "<?= Url::toRoute('admin-setting/ajax-update')?>",
                    data: {"val": json.dir, 'field': 'val', 'id': img_id},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                    success: function (data) {
                        //window.location.reload();
                    }
                });
                //alert(result)
                /*var json = eval("(" + result + ")");
                 alert('图片链接:\n'+json.file);*/
            }
        }
    }
</script>


<script>
    var img_id = 0;
    $(function () {

        $('.change_img').bind('click', function () {
            $('#img_id').val($(this).attr('id'))
            img_id = $(this).attr('id')
            $('#file').click()
        })
        var file = document.getElementById("file");
        file.onchange = function () {
            $('.mybtn').click()
        }
    })
    var vals = '';

    function initModel(id, type, fun) {
        $.ajax({
            type: "GET",
            url: "<?= Url::toRoute($this->context->id . '/view')?>",
            data: {"id": id},
            cache: false,
            dataType: "json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function (data) {
                initEditSystemModule(data, type);
            }
        });
    }
    function editAction(id) {
        initModel(id, 'edit');
    }

    function deleteAction(id) {
        var ids = [];
        if (!!id == true) {
            ids[0] = id;
        }
        else {
            var checkboxs = $('#data_table tbody :checked');
            if (checkboxs.size() > 0) {
                var c = 0;
                for (i = 0; i < checkboxs.size(); i++) {
                    var id = checkboxs.eq(i).val();
                    if (id != "") {
                        ids[c++] = id;
                    }
                }
            }
        }
        if (ids.length > 0) {
            admin_tool.confirm('请确认是否删除', function () {
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute($this->context->id . '/delrecord')?>",
                    data: {"ids": ids},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                    success: function (data) {
                        for (i = 0; i < ids.length; i++) {
                            $('#rowid_' + ids[i]).remove();
                        }
                        admin_tool.alert('msg_info', '删除成功', 'success');
                        window.location.reload();
                    }
                });
            });
        }
        else {
            admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
        }

    }

    function getSelectedIdValues(formId) {
        var value = "";
        $(formId + " :checked").each(function (i) {
            if (!this.checked) {
                return true;
            }
            value += this.value;
            if (i != $("input[name='id']").size() - 1) {
                value += ",";
            }
        });
        return value;
    }

    $('#edit_dialog_ok').click(function (e) {
        e.preventDefault();
        $('#admin-module-form').submit();
    });

    /* $('#create_btn').click(function (e) {
     e.preventDefault();
     initEditSystemModule({}, 'create');
     });*/

    $('#delete_btn').click(function (e) {
        e.preventDefault();
        deleteAction('');
    });
    $('.setting').focus(function () {
        vals = $(this).val();
    })
    $('.setting').blur(function () {
        var id = $(this).attr('id');
        var field = $(this).attr('field');
        var val = $(this).val();
        if (val == vals) {
            return 1
        } else {
            change(id, val, field)
        }
    })
    $(function () {
        $('.radio').bind("click", function (e) {
            var a = $(this).attr('checked')
            var id = $(this).attr('id')
            var val = $(this).val()
            if (!a) {
                change(id, val, 'val')
            }
            return
        })

    })
    function change(id, val, field) {
        $.ajax({
            type: "POST",
            url: "<?= Url::toRoute('admin-setting/ajax-update')?>",
            data: {"id": id, 'val': val, 'field': field},
            cache: false,
            dataType: "json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function (data) {
                window.location.reload();
            }
        });
    }

</script>

<?php $this->endBlock(); ?>
