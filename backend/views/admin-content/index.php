<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminContent;
use backend\models\AdminSort;

$modelLabel = new \backend\models\AdminContent()
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
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">标题:</span>
                                        <input type="text" class="form-control" id="query[title]" name="query[title]"
                                               value="<?= isset($query["title"]) ? $query["title"] : "" ?>">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon" id="basic-addon1">分类名称:</span>
                                        <select name="query[cid]" id="query[cid]" style="height:34px;border: 1px solid #ccc;padding: 5px;">
                                            <option value="">请选择分类</option>
                                            <?php foreach ($cat as $list) { ?>
                                                <option <?= $query['cid'] == $list->id ? 'selected' : '' ?>
                                                    value="<?= $list->id ?>"><?= $list['name'] ?></option>

                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i
                                            class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                    <a class="btn btn-primary btn-sm"
                                       href="<?= Url::toRoute([$this->context->id . '/index']) ?>"> <i
                                            class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12">
                                <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <!--<button id="istop_btn" type="button" class="btn btn-xs btn-info">置顶</button>
                                <button id="canceltop_btn" type="button" class="btn btn-xs btn-info">取消置顶</button>
                                <button id="recommend_btn" type="button" class="btn btn-xs btn-info">推荐</button>
                                <button id="cancelrecommend_btn" type="button" class="btn btn-xs btn-info">取消推荐</button>-->
                                <form action="<?= Url::toRoute('admin-content/sort') ?>" id="sorting-form"
                                      method="post">
                                    <!--                                get的可以提交post提交报错-->
                                    <input name="_csrf" type="hidden" id="_csrf"
                                           value="<?= Yii::$app->request->csrfToken ?>">
                                    <table id="data_table" class="table table-bordered table-striped dataTable"
                                           role="grid" aria-describedby="data_table_info">
                                        <thead>
                                        <tr role="row">
                                            <th><input id="data_table_check" type="checkbox">
                                                <label
                                                    style="padding-left: 5px;"><?= $modelLabel->getAttributeLabel("sorting") ?>
                                            </th>
                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?= $modelLabel->getAttributeLabel("id") ?></th>
                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?= $modelLabel->getAttributeLabel("sortid") ?></th>
                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?= $modelLabel->getAttributeLabel("title") ?></th>
                                            <!--<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?/*= $modelLabel->getAttributeLabel("author") */?></th>-->
                                            <!--<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?/*= $modelLabel->getAttributeLabel("views") */?></th>
                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?/*= $modelLabel->getAttributeLabel("top") */?></th>
                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?/*= $modelLabel->getAttributeLabel("recommend") */?></th>-->
                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                                aria-sort="ascending"><?= $modelLabel->getAttributeLabel("addtime") ?></th>
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
                                                <td><label><input type="checkbox" value="<?= $list->id ?>"></label>
                                                    <!--<input type="text" name="sorting<?/*= $list->id */?>"
                                                           value="<?/*= $list->sorting ? $list->sorting : 0 */?>"
                                                           style="width: 30px;text-align: center">-->
                                                </td>
                                                <td><?= $list->id ?></td>
                                                <td><?= AdminSort::sort_name($list->sortid) ?></td>
                                                <td><?= $list->title ?></td>
                                                <!--<td><?/*= $list->author */?></td>-->
                                                <!--<td><?/*= $list->views */?></td>
                                                <td><?/*= AdminContent::dropDownList('is_judge', $list->top) */?></td>
                                                <td><?/*= AdminContent::dropDownList('is_judge', $list->recommend) */?></td>-->
                                                <td><?= date("Y-m-d H:i:s", $list->addtime) ?></td>
                                                <td class="center">
                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                    <a id="edit_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/update', 'id' => $list->id]) ?>">
                                                        <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                    <a id="delete_btn" onclick="deleteAction('<?= $list->id ?>')"
                                                       class="btn btn-danger btn-sm" href="javascript:;"> <i
                                                            class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                                                </td>
                                            <tr/>
                                            <?php
                                        }
                                        ?>
                                        </tbody>

                                    </table>
                                    <!--<button id="sorting_btn" onclick="sortingAction()" type="button"
                                            class="btn btn-xs btn-info">排序
                                    </button>-->
                            </div>
                        </div>
                        <!-- row end -->
                        </form>
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

<?php $this->beginBlock('footer'); ?>
<script>
    function searchAction() {
        $('#admin-search-form').submit();
    }

    function sortingAction() {
        $('#sorting-form').submit();
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

    //置顶
    function istopAction(id, judge) {
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
            admin_tool.confirm('请确认置顶操作', function () {
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute($this->context->id . '/istop')?>",
                    data: {"ids": ids, "judge": judge},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
//                        console.log();
                    },
                    success: function (data) {
                        admin_tool.alert('msg_info', '操作成功', 'success');
                        window.location.reload();
                    }
                });
            });
        }
        else {
            admin_tool.alert('msg_info', '请先选择置顶操作的数据', 'warning');
        }

    }


    //推荐
    function recommendAction(id, judge) {
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
            admin_tool.confirm('请确认推荐操作', function () {
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute($this->context->id . '/recommend')?>",
                    data: {"ids": ids, "judge": judge},
                    cache: false,
                    dataType: "json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
//                        console.log();
                    },
                    success: function (data) {
                        admin_tool.alert('msg_info', '操作成功', 'success');
                        window.location.reload();
                    }
                });
            });
        }
        else {
            admin_tool.alert('msg_info', '请先选择推荐操作的数据', 'warning');
        }

    }

    //置顶
    $('#istop_btn').click(function (e) {
        e.preventDefault();
        istopAction('', 1);
    });

    //取消置顶
    $('#canceltop_btn').click(function (e) {
        e.preventDefault();
        istopAction('', 0);
    });

    //推荐
    $('#recommend_btn').click(function (e) {
        e.preventDefault();
        recommendAction('', 1);
    });

    //取消推荐
    $('#cancelrecommend_btn').click(function (e) {
        e.preventDefault();
        recommendAction('', 0);
    });
</script>
<?php $this->endBlock(); ?>
