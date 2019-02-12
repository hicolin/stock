<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminHousekeeper;
use backend\models\AdminUser;

$modelLabel = new \backend\models\AdminHousekeeper()
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
                            <!--<a id="create_btn" href="<? /*= Url::toRoute([$this->context->id . '/create']) */ ?>"
                               class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>-->
                            &nbsp;&nbsp;

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                <div class="col-lg-2 mar-10" style="margin-top: -8px">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">信管家账号:</span>
                                        <input type="text" class="form-control ECalendar" id="xgj_name" name="query[xgj_name]" value="<?= $query["xgj_name"] ? : "" ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                    <a class="btn btn-primary btn-sm" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">

                            <div class="col-sm-12">
                                <?php
                                if(in_array($role_id, [1,6,7])) {
                                    echo '<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>&nbsp;&nbsp;&nbsp;&nbsp;';
                                }

                                if(in_array($role_id, [1,6])) {
                                    echo '<button id="import_btn" type="button" class="btn btn-xs btn-primary">数据导入</button>&nbsp;&nbsp;&nbsp;&nbsp;';
                                }
                                ?>
                                <a href="<?=Url::toRoute(['admin-housekeeper/download-file','file'=>'/backend/web/excel/housekeeper.csv','name'=>'资管账号模板'])?>"><button id="excel_btn" type="button" class="btn btn-xs btn-primary">模板下载</button></a>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("xgj_name") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("xgj_pwd") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">用户</th>
                                             <!--<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?/*= $modelLabel->getAttributeLabel("agentid") */?></th>-->
                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("states") ?></th>
                                       
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($model as $list) {
                                        ?>
                                        <tr id="rowid_$list->xgj_id">
                                            <td><label><input type="checkbox" value="<?= $list->xgj_id ?>"></label></td>
                                            <!--<td><?/*= $list->xgj_id */?></td>-->
                                            <td><?= $list->xgj_name ?></td>
                                            <td><?= $list->xgj_pwd ? $list->xgj_pwd :'——' ?></td>
                                            <!--<td><?/*= $list->account['account'] */?></td>-->
                                            <td><?= $list->uid ? \backend\models\AdminMember::getName($list->uid) :'——' ?></td>
                                           <!-- <td><?php /*if($list->agentid){ echo AdminUser::getuserinfo($list->agentid)->uname;}  */?></td>-->
                                            <td>
                                                <?= $list->states ==0 ?'未使用':'已使用' ?>
                                                <!--<button xgj_id="<?/*= $list->xgj_id*/?>" states="<?/*= $list->states*/?>" class="btn_change btn-xs btn-success <?/*= $list->states ? 'glyphicon glyphicon-remove' : 'glyphicon glyphicon-ok' */?>"></button>-->
                                            </td>
                                            <td class="center">
                                                <a id="view_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->xgj_id]) ?>">
                                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <a id="edit_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/update', 'id' => $list->xgj_id]) ?>">
                                                    <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                <a id="delete_btn" onclick="deleteAction('<?= $list->xgj_id ?>')"
                                                   class="btn btn-danger btn-sm" href="javascript:;"> <i
                                                            class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                                            </td>
                                        <tr/>
                                        <?php
                                    }
                                    ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- row end -->

                        <!-- row start -->
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
                                    <div class="infos">
                                        从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>
                                        到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ? $pageCount : $pages->totalCount ?>
                                        共 <?= $pages->totalCount ?> 条记录
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate"
                                     style="text-align: right;padding-right: 50px;">
                                    <?= LinkPager::widget([
                                        'pagination' => $pages,
                                        'nextPageLabel' => '下一页',
                                        'prevPageLabel' => '上一页',
                                        'firstPageLabel' => '首页',
                                        'lastPageLabel' => '尾页',
                                    ]); ?>

                                </div>
                            </div>
                        </div>
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
    <input type="file" onChange="ajaxFileUpload()" id="hiddenFile" name="file" style="display: none;">
    <input type="file" name="file" class="file" id="file" onchange="document.getElementById('textfield').value=this.value" />
    <span onclick="UpladFile()" class="mybtn">上传</span>
</div>

<?php $this->beginBlock('footer'); ?>
<script>
    function searchAction() {
        $('#admin-search-form').submit();
    }
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
                        if(data==800) {
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

    /*改变状态
    * */
    $('.btn_change').on('click',function(){
        var states = $(this).attr('states')
        var xgj_id = $(this).attr('xgj_id')
        $.ajax({
            type: "GET",
            url: "<?= Url::toRoute($this->context->id . '/change-states')?>",
            data: {"states": states, 'xgj_id':xgj_id},
            cache: false,
            dataType: "json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function (data) {
                if(data==800) {
                    layer.alert('没有权限', {icon: 2});
                    return false;
                }
                $(this).attr('states',data)
                window.location.reload();

            }
        });
    })


    $(function(){

        $('#excel_btn').bind('click',function(){
            var role_id = "<?=$role_id?>";
            if(role_id==1 || role_id==6){
                $('#file').click()
            } else {
                layer.alert('没有权限', {icon: 2});
                return false;
            }
        })
        var file = document.getElementById("file");
        file.onchange=function(){
            $('.mybtn').click()
        }
    })

</script>



<script type="text/javascript">
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

    function UpladFile()
    {
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

    function deal()
    {
        if(xhr.readyState == 4)
        {
            if (xhr.status == 200 || xhr.status == 0)
            {
                var result = xhr.responseText;;
                var json = eval("(" + result + ")");
            
                $.ajax({
                    type: "GET",
                    url: "/phpexcel/index.php",
                    data: {"file": json.dir},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        //alert("出错了，" + textStatus);
                        //window.location.reload();
                    },
                    success: function (data) {
                        if(data==100) {
                        
                            window.location.reload();
                        }
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
    $(function(){
        $('#import_btn').bind('click',function(){
            $('#hiddenFile').click()
        })
    });
    function ajaxFileUpload() {
        layer.load(2);
        $.ajaxFileUpload
        (
            {
                url: "<?=Url::toRoute(['/public/file1','type'=>'file'])?>", //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: 'hiddenFile', //文件上传域的ID
                dataType: 'JSON', //返回值类型 一般设置为json
                success: function (data)  //服务器成功响应处理函数
                {
                    var obj = jQuery.parseJSON(data);
                    if(obj.status != 200) {
                        layer.closeAll();
                        layer.msg('导入失败',{icon:5});
                    }else {
                        layer.load(2);
                        $.ajax({
                            type: "get",
                            url: "<?= Url::toRoute($this->context->id . '/cmport')?>",
                            data: {"path": obj.path},
                            cache: false,
                            dataType: "text",
                            error: function (xmlHttpRequest, textStatus, errorThrown) {
                                layer.closeAll();
                                layer.msg('系统出错！',{icon:5});
                            },
                            success: function (msg) {
                                var bj = jQuery.parseJSON(msg);

                                layer.closeAll('loading');
                                if(bj.status == 500) {
                                    layer.msg('导入失败！',{icon:5});
                                }else if(bj.status == 200) {
                                    window.location.reload();
                                }
                            }
                        });
                    }
                }
            }
        );
        return false;
    }
</script>
<?php $this->endBlock(); ?>
