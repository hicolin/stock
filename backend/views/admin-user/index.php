<?php
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use backend\models\AdminUser;
use yii\helpers\Url;

$modelLabel = new \backend\models\AdminUser();
?>

<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">用户管理</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="<?= Url::toRoute([$this->context->id . '/create']) ?>"
                                   class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-user-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => Url::toRoute('admin-user/index')]); ?>

                                <div class="col-lg-2 mar-10" style="margin-top: -8px">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon"><?=$modelLabel->getAttributeLabel('uname')?>:</span>
                                        <input type="text" class="form-control" id="query[uname]" name="query[uname]"
                                               value="<?= isset($query["uname"]) ? $query["uname"] : "" ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i
                                                class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                    <a class="btn btn-primary btn-sm" href="<?=Url::toRoute('admin-user/index')?>"> <i
                                                class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <!-- row end search -->
                        <hr/>
                        <!-- row start -->
                        <div class="row">
                            <div class="col-sm-12">
                            <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel('id') ?></th>
                                        <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel('uname')?></th>
                                        <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >上级</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >用户角色</th>
                                         <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel('vatation_code')?></th>
                                        <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel('last_ip')?></th>
                                        <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel('update_user')?></th>
                                        <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel('update_date')?></th>
                                       
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $row = 0;
                                    foreach ($models as $model) {
                                    ?>
                                    <tr id="rowid_<?=$model->id?>">
                                    <td><label><input type="checkbox" value="<?=$model->id?>"></label></td>
                                    <td><?=$model->id?></td>
                                    <td><?=$model->uname?></td>
                                    <td><?=AdminUser::getParentByUid($model->pid)?></td>
                                    <!--<td><?/*=$model->uname*/?></td>-->
                                    <td><?=AdminUser::getrolename($model->id);?></td>
                                    <td><?=$model->vatation_code?></td>
                                    <td><?=$model->last_ip?></td>
                                    <td><?=$model->update_user?></td>
                                    <td><?=$model->update_date?></td>
                                    <td class="center">
                                    <a id="edit_btn" class="btn btn-primary btn-sm" href="<?= Url::toRoute([$this->context->id . '/update','id'=>$model->id]) ?>"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                    <a id="delete_btn" onclick="deleteAction(<?=$model->id?>)" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                                    </td>
                                    <tr/>
                                    <?php } ?>


                                    </tbody>
                                    <!-- <tfoot></tfoot> -->
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
                                <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
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
<!-- /.content -->
<?php $this->beginBlock('footer'); ?>
<!-- <body></body>后代码块 -->
<script>
    function searchAction() {
        $('#admin-user-search-form').submit();
    }
    function viewAction(id) {
        initModel(id, 'view', 'fun');
    }

    function initModel(id, type, fun) {
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('admin-user/view')?>",
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
            var checkboxs = $('#data_table :checked');
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
                    url: "<?=Url::toRoute('admin-user/delete')?>",
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
        $('#admin-user-form').submit();
    });

    $('#create_btn').click(function (e) {
        e.preventDefault();
        initEditSystemModule({}, 'create');
    });

    $('#delete_btn').click(function (e) {
        e.preventDefault();
        deleteAction('');
    });
</script>
<?php $this->endBlock(); ?>