<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminTongji;

$modelLabel = new \backend\models\AdminTongji()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<style>
    #data_table tr th{
        text-align: center;
    }
    #data_table tr td{
        text-align: center;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                <div class="input-group" style="margin: 5px;">
                                    <span class="input-group-addon">起始时间:</span>
                                    <input type="text" class="form-control" id="b_time"
                                           value="<?= !empty($query["b_time"]) ? $query["b_time"] : "" ?>"
                                           placeholder="选择开始时间" name="query[b_time]">
                                    <span class="input-group-addon">至:</span>
                                    <input type="text" class="form-control" id="e_time"
                                           value="<?= !empty($query["e_time"]) ? $query["e_time"] : "" ?>"
                                           placeholder="选择终止时间" name="query[e_time]">
                                </div>

                                <div class="form-group">
                                    <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i
                                            class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                    <a class="btn btn-primary btn-sm"
                                       href="<?= Url::toRoute([$this->context->id . '/' . Yii::$app->controller->action->id]) ?>"><i
                                            class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>

                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <hr/>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <hr/>
                                    <div class="col-sm-12">
                                        <?php
                                        if (in_array($role_id, [1, 6, 7])) { ?>
                                            <!--<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除
                                            </button>-->
                                        <?php }
                                        /*if (in_array($role_id, [1, 6])) { */?><!--
                                            <a id="excel_btn" href="javascript:;"
                                               class="btn btn-xs btn-primary">导入数据</a>
                                            <a href="<?/*= Url::toRoute(['admin-housekeeper/download-file', 'file' => '/backend/web/excel/tongji.csv']) */?>">
                                                <button id="excel_btn" type="button" class="btn btn-xs btn-primary">
                                                    模板下载
                                                </button>
                                            </a>
                                        --><?php /*}
                                        */?>
                                        <table id="data_table" class="table table-bordered table-striped dataTable"
                                               role="grid" aria-describedby="data_table_info">
                                            <thead>
                                            <tr role="row">

                                                <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                    aria-sort="ascending">时间
                                                </th>
                                                <th tabindex="0" aria-controls="data_table" rowspan="1"
                                                    colspan="2"
                                                    aria-sort="ascending">会员
                                                </th>

                                                <th tabindex="0" aria-controls="data_table" rowspan="1" colspan=3"
                                                    aria-sort="ascending">财务
                                                </th>

                                                <!--<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                    aria-sort="ascending">操作
                                                </th>-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr id="rowid_$list->id">

                                                <td>

                                                </td>
                                                <td>客户</td>
                                                <td>
                                                    代理
                                                </td>


                                                <td>
                                                    充值/¥
                                                </td>
                                                <td>提现/¥</td>
                                                <td>
                                                    返佣
                                                </td>
                                                <!--<td class="center">
                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<? /*= Url::toRoute(['admin-tongji/view', 'id' => $key, 'jy_time' => $jy_time]) */ ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>

                                                </td>-->
                                            <tr/>
                                            <tr id="rowid_$list->id">

                                                <td>
                                                    <?php
                                                    if (!empty($query["e_time"]) && !empty($query["b_time"])) {
                                                        echo $query["b_time"] . '至' . $query["e_time"];
                                                    } elseif (!empty($query["b_time"]) && empty($query["e_time"])){
                                                        echo $query["b_time"] . '至今';
                                                    }elseif (empty($query["b_time"]) && !empty($query["e_time"])){
                                                        echo  '网站出生至' . $query["e_time"];
                                                    }else{
                                                        echo  '网站出生至今';
                                                    }
                                                    ?>

                                                </td>
                                                <td><?= $num ?></td>
                                                <td>
                                                    <?= $daiLi ?>
                                                </td>
                                                <td><?= $Rmoney['money'] ?: '0' ?>元</td>
                                                <td><?= $withdraw ?: '0' ?>元</td>
                                                <td><?= $fy ?: '0' ?>元</td>
                                                <!--<td class="center">
                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<? /*= Url::toRoute(['admin-tongji/view', 'id' => $key, 'jy_time' => $jy_time]) */ ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>

                                                </td>-->
                                            <tr/>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <!-- row end -->

                                <!-- row start -->

                                <!-- row end -->
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
<div style="display: none">
    <input type="file" name="file" class="file" id="file"
           onchange="document.getElementById('textfield').value=this.value"/>
    <span onclick="UpladFile()" class="mybtn">上传</span>
</div>
<?php $this->beginBlock('footer'); ?>
<script>

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
                        if (data == 800) {
                            layer.alert('没有权限', {icon: 2});
                            return false;
                        }
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

</script>

<script>
    function searchAction() {
        $('#admin-search-form').submit();
    }

    $(function () {

        $('#excel_btn').bind('click', function () {
            var role_id = "<?=$role_id?>";
            if (role_id == 1 || role_id == 6) {
                layer.load(1)
                $('#file').click()
            } else {
                layer.alert('没有权限', {icon: 2});
                return false;
            }

        })
        var file = document.getElementById("file");
        file.onchange = function () {
            $('.mybtn').click()
        }
    })

</script>

<script type="text/javascript">
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
                ;
                var json = eval("(" + result + ")");
                $.ajax({
                    type: "GET",
                    url: "/phpexcel/export.php",
                    data: {"file": json.dir},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        layer.closeAll('loading');
                        alert("出错了，" + textStatus);
                        return false;
                        window.location.reload();
                    },
                    success: function (data) {
                        $.ajax({
                            type: "POST",
                            url: "<?= Url::toRoute('admin-member/update-profit')?>",
                            data: {"data": data},
                            cache: false,
                            dataType: "json",
                            error: function (xmlHttpRequest, textStatus, errorThrown) {
                                layer.closeAll('loading');
                                alert("出错了，" + textStatus);
                            },
                            success: function (data1) {
                                layer.closeAll('loading');
                                if (data1 == 100) {
                                    layer.alert('导入成功', {icon: 1});
                                    //window.location.reload();
                                }
                            }
                        });
                    }
                });
                //alert(result)
                /*var json = eval("(" + result + ")");
                 alert('图片链接:\n'+json.file);*/
            }
        }
    }
</script>
<?php $this->endBlock(); ?>
