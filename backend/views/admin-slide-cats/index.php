<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSlideCats;

$modelLabel = new \backend\models\AdminSlideCats()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<?php if(Yii::$app->session->hasFlash('error')):?>
    <script>
        layer.msg("<?=Yii::$app->session->getFlash('error')?>",{icon:0,time:1000})
    </script>
<?php endif?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute('admin-slide-cats/create') ?>"
                               class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                            &nbsp;&nbsp;
                            <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <!-- row start search-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-module-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon" id="basic-addon1">编号:</span>
                                        <input type="text" class="form-control" id="query[cid]" name="query[cid]"
                                               value="<?= isset($query["cid"]) ? $query["cid"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon" id="basic-addon1">分类名称:</span>
                                        <input type="text" class="form-control" id="query[cat_name]" name="query[cat_name]"
                                               value="<?= isset($query["cat_name"]) ? $query["cat_name"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon" id="basic-addon1">分类标识:</span>
                                        <input type="text" class="form-control" id="query[cat_idname]"
                                               name="query[cat_idname]"
                                               value="<?= isset($query["cat_idname"]) ? $query["cat_idname"] : "" ?>">
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 7px">
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
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("cid") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("cat_name") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("cat_idname") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("cat_remark") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("cat_status") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($model as $list) {
                                        echo '<tr id="rowid_' . $list->cid . '">';
                                        echo '<td><label><input type="checkbox" value="' . $list->cid . '"></label></td>';
                                        echo '<td>' . $list->cid . '</td>';
                                        echo '<td>' . $list->cat_name . '</td>';
                                        echo '<td>' . $list->cat_idname . '</td>';
                                        echo '<td>' . $list->cat_remark . '</td>';
                                        echo '<td>' . AdminSlideCats::dropDownList('is_show', $list->cat_status) . '</td>';
                                        echo '<td class="center">';
                                        echo '<a id="view_btn" class="btn btn-primary btn-sm" href="' . Url::toRoute(['admin-slide-cats/view', 'id' => $list->cid]) . '"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a> ';
                                        echo ' <a id="edit_btn" class="btn btn-primary btn-sm" href="' . Url::toRoute(['admin-slide-cats/update', 'id' => $list->cid]) . '"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a> ';
                                        echo ' <a id="delete_btn" onclick="deleteAction(' . $list->cid . ')" class="btn btn-danger btn-sm" href="javascript:;"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                                        echo '</td>';
                                        echo '<tr/>';
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
<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>项目概况</h3>
            </div>
            <div class="modal-body">
                <div id="code_div" class="form-group">
                    <label for="cid"
                           class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cid") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cid" name="AdminSlideCats[cid]" placeholder=""/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="code_div" class="form-group">
                    <label for="cat_name"
                           class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cat_name") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cat_name" name="AdminSlideCats[cat_name]"
                               placeholder=""/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="code_div" class="form-group">
                    <label for="cat_idname"
                           class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cat_idname") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cat_idname" name="AdminSlideCats[cat_idname]"
                               placeholder=""/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="code_div" class="form-group">
                    <label for="cat_remark"
                           class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cat_remark") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cat_remark" name="AdminSlideCats[cat_remark]"
                               placeholder=""/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="code_div" class="form-group">
                    <label for="cat_status"
                           class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cat_status") ?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cat_status" name="AdminSlideCats[cat_status]"
                               placeholder=""/>
                    </div>
                    <div class="clearfix"></div>
                </div>


            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('footer'); ?>
<script>
    function searchAction() {
        $('#admin-module-search-form').submit();
    }
    /*function viewAction(id){
     initModel(id, 'view', 'fun');
     }*/

    /* function initEditSystemModule(data, type){
     $("#cid").val(data.cid);
     $("#cid").attr({readonly:true,disabled:true});
     $("#cat_name").val(data.cat_name);
     $("#cat_name").attr({readonly:true,disabled:true});
     $("#cat_idname").val(data.cat_idname);
     $("#cat_idname").attr({readonly:true,disabled:true});
     $("#cat_remark").val(data.cat_remark);
     $("#cat_remark").attr({readonly:true,disabled:true});
     $("#cat_status").val(data.cat_status);
     $("#cat_status").attr({readonly:true,disabled:true});
     $('#edit_dialog').modal('show');
     }*/

    function initModel(id, type, fun) {
        $.ajax({
            type: "GET",
            url: "<?= Url::toRoute('admin-slide-cats/view')?>",
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
                    url: "<?=Url::toRoute('admin-slide-cats/delrecord')?>",
                    data: {"ids": ids},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        if(xmlHttpRequest.responseText=='prohibit'){
                            alert( '抱歉,您没有权限操作');
                        }else{
                            alert("出错了，" + textStatus);
                        }
                    },
                    success: function (data) {
                        if(data=='prohibit'){
                            admin_tool.alert('msg_info', '抱歉,您没有权限操作', 'error');
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
<?php $this->endBlock(); ?>
