<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminTiying;

$modelLabel = new \backend\models\AdminTiying()
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
                           <!-- <a id="create_btn" href="<?/*= Url::toRoute([$this->context->id . '/create']) */?>"
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
                                <div class="form-group" style="margin: 5px;">
                                    <label><?= $modelLabel->getAttributeLabel("state") ?>：</label>
                                    <select name="query[state]" class="form-control">
                                        <option value='-1'>请选择</option>
                                        <option value='0'>未审核</option>
                                        <option value='1'>成功</option>
                                        <option value='2'>失败</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin: 5px;">
                                    <label><?= $modelLabel->getAttributeLabel("users_id") ?>：</label>
                                    <input type="text" class="form-control" id="query[order_sn]" name="query[users_id]" value="<?= isset($query["users_id"]) ? $query["users_id"] : "" ?>">
                                </div>
                                <div class="form-group" style="margin: 5px;">
                                    <label><?= $modelLabel->getAttributeLabel("dates") ?>：</label>
                                    <input type="text" class="form-control ECalendar" id="b_time" name="query[b_time]" value="<?= $query["b_time"] ? date('Y-m-d H:i',$query["b_time"]) : "" ?>"> -
                                    <input type="text" class="form-control ECalendar" id="e_time" name="query[e_time]" value="<?= $query["e_time"] ? date('Y-m-d H:i',$query["e_time"]) : "" ?>">
                                </div>
                                <div class="form-group">
                                    <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                    <a class="btn btn-primary btn-sm" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <a href="<?=Url::toRoute($this->context->id . '/export')?>"><button id="export_btn" type="button" class="btn btn-xs btn-info">导出数据</button></a>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("id") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("users_id") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("money") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("title") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("bank_id") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("bank_code") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("hsname") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("state") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("dates") ?></th>
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
                                            <td><?= $list->member['usersname'] ?></td>
                                            <td><?= $list->money ?></td>
                                            <td><?= $list->title ?></td>
                                            <td><?= $list->bank_id ?></td>
                                            <td><?= $list->bank_code ?></td>
                                            <td><?= $list->hsname ?></td>
                                            <td>
                                                <?php
                                                if($list->state==0) {
                                                    echo '审核';
                                                } else {
                                                    echo $list->state==1?'成功':'失败';
                                                }
                                                ?>
                                            </td>
                                            <td><?= date('Y-m-d H:i:s',$list->dates) ?></td>
                                            <td class="center">
                                                <a id="view_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <?php
                                                if($list->state==0) { ?>
                                                    <a onclick="change(1,<?= $list->id ?>)" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>通过</a>
                                                    <a onclick="change(2,<?= $list->id ?>)" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>不通过</a>
                                                <?php }
                                                ?>
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

    function change(state,id) {
        admin_tool.confirm('确定审核吗?', function () {
            $.ajax({
                type: "GET",
                url: "<?= Url::toRoute('admin-tiying/change-state')?>",
                data: {"state": state, "id": id},
                cache: false,
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success: function (data) {
                    if(data==100) {
                        window.location.reload();
                    }
                }
            });
        })
        return


    }

    $("#b_time").ECalendar({
        type:"time",   //模式，time: 带时间选择; date: 不带时间选择;
        stamp : true,   //是否转成时间戳，默认true;
        offset:[0,2],   //弹框手动偏移量;
        format:"yyyy-mm-dd hh:ii",   //格式 默认 yyyy-mm-dd hh:ii;
        skin:2,   //皮肤颜色，默认随机，可选值：0-8,或者直接标注颜色值;
        step:10,   //选择时间分钟的精确度;
        callback:function(v,e){

        } //回调函数
    });

    $("#e_time").ECalendar({
        type:"time",   //模式，time: 带时间选择; date: 不带时间选择;
        stamp : true,   //是否转成时间戳，默认true;
        offset:[0,2],   //弹框手动偏移量;
        format:"yyyy-mm-dd hh:ii",   //格式 默认 yyyy-mm-dd hh:ii;
        skin:2,   //皮肤颜色，默认随机，可选值：0-8,或者直接标注颜色值;
        step:10,   //选择时间分钟的精确度;
        callback:function(v,e){

        } //回调函数
    });

</script>
<?php $this->endBlock(); ?>
