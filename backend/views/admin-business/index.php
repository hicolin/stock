<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminBusiness;

$modelLabel = new \backend\models\AdminBusiness()
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
                            <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/create']) ?>"
                               class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                            &nbsp;&nbsp;

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                    <div class="col-lg-2 mar-10">
                                        <div class="input-group" style="margin: 5px;">
                                            <span class="input-group-addon" id="basic-addon1">成交时间:</span>
                                            <input type="text" class="form-control" id="query[actual_his]"
                                                   name="query[actual_his]"
                                                   value="<?= isset($query["actual_his"]) ? $query["actual_his"] : "" ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mar-10">
                                        <div class="input-group" style="margin: 5px;">
                                            <span class="input-group-addon" id="basic-addon1">主账号:</span>
                                            <input type="text" class="form-control" id="query[z_account]"
                                                   name="query[z_account]"
                                                   value="<?= isset($query["z_account"]) ? $query["z_account"] : "" ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm"><i
                                                class="glyphicon glyphicon-zoom-in icon-white"></i>搜索
                                        </button>

                                        <a class="btn btn-primary btn-sm"
                                           href="<?= Url::toRoute([$this->context->id . '/' . Yii::$app->controller->action->id]) ?>">
                                            <i class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-sm-12">
                                <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <button id="import_btn" class="btn btn-xs btn-warning" style="margin-left: 5px;">导入数据
                                </button>
                                <a href="<?= Url::toRoute([$this->context->id . '/export', 'query' => $query]) ?>"
                                   style="margin-left: 5px;">
                                    <button class="btn btn-xs btn-info">导出数据</button>
                                </a>
                                <a href="<?= Url::toRoute(['public/download-file', 'file' => '/backend/web/excel/temp.xlsx']) ?>"
                                   style="margin-left: 5px;">
                                    <button class="btn btn-xs btn-info">模板下载</button>
                                </a>
                                <button onclick="scFy()" class="btn btn-xs btn-warning" style="margin-left: 5px;">生成返佣
                                </button>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("id") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("account") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("date") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("success_account") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("request") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">返佣是否计算</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($model as $list) {
                                        ?>
                                        <tr id="rowid_$list->id">
                                            <td><label><input type="checkbox" value="<?= $list->id ?>"></label></td>
                                            <td><?= $list->id ?></td>
                                            <td><?= $list->account ?></td>
                                            <td><?= $list->date ?></td>
                                            <td><?= $list->success_account ?></td>
                                            <td><?= $list->request ?></td>
                                            <td><?= $list->is_fy==0?'未计算':'已计算' ?></td>
                                            <td class="center">
                                                <a id="view_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <!--<a id="edit_btn" class="btn btn-primary btn-sm"
                                                   href="<?/*= Url::toRoute([$this->context->id . '/update', 'id' => $list->id]) */?>">
                                                    <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>-->
                                                <a id="delete_btn" onclick="deleteAction('<?= $list->id ?>')"
                                                   class="btn btn-danger btn-sm" href="javascript:;"> <i
                                                        class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                                            </td>
                                        </tr>
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
<input type="file" onChange="ajaxFileUpload()" id="hiddenFile" name="file" style="display: none;">
<?php $this->beginBlock('footer'); ?>
<script>
    function scFy() {
        layer.confirm("确定生成返佣？", {
            btn: ['确定', '取消']
        }, function () {
            layer.close();
            window.location.href = "<?=Url::toRoute(['admin-business/commission'])?>";
        })
    }
    $(function () {
        $('#import_btn').bind('click', function () {
            $('#hiddenFile').click()
        })
    });
    function ajaxFileUpload() {
        layer.load(2);
        $.ajaxFileUpload
        (
            {
                url: "<?=Url::toRoute(['/public/file1', 'type' => 'file'])?>", //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: 'hiddenFile', //文件上传域的ID
                dataType: 'JSON', //返回值类型 一般设置为json
                success: function (data)  //服务器成功响应处理函数
                {
                    // console.log(data)
                    var obj = jQuery.parseJSON(data);
                    if (obj.status != 200) {
                        layer.closeAll();
                        layer.msg('导入失败', {icon: 5});
                    } else {
                        layer.load(2);
                        $.ajax({
                            type: "get",
                            url: "<?= Url::toRoute($this->context->id . '/import')?>",
                            data: {"path": obj.path},
                            cache: false,
                            dataType: "text",
                            error: function (xmlHttpRequest, textStatus, errorThrown) {
                                layer.closeAll();
                                layer.msg('系统出错！', {icon: 5});
                            },
                            success: function (msg) {
                                // console.log(msg)
                                var bj = jQuery.parseJSON(msg);
                                layer.closeAll('loading');
                                if (bj.status == 500) {
                                    layer.msg('导入失败！', {icon: 5}, function () {
                                        window.location.reload();
                                    });
                                } else if (bj.status == 200) {
                                    layer.msg('导入成功！', {icon: 1}, function () {
                                        window.location.reload();
                                    });
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
<?php $this->endBlock(); ?>