<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminOrder;

$modelLabel = new \backend\models\AdminOrder()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
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
                                <div class="form-group" style="margin: 5px;">
                                    <label><?= $modelLabel->getAttributeLabel("order_sn") ?>：</label>
                                    <input type="text" class="form-control" id="query[order_sn]" name="query[order_sn]" value="<?= isset($query["order_sn"]) ? $query["order_sn"] : "" ?>">
                                </div>
                                <div class="form-group" style="margin: 5px;">
                                    <label><?= $modelLabel->getAttributeLabel("user_id") ?>：</label>
                                    <select name="query[user_id]" class="form-control">
                                        <?php
                                        foreach ( $user  as $k=> $val ) {
                                            echo " <option value='$k'". ($k==$query['user_id']?'selected':'').">$val</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" style="margin: 5px;">
                                    <label><?= $modelLabel->getAttributeLabel("goods_id") ?>：</label>
                                    <select name="query[goods_id]" class="form-control">
                                        <?php
                                        foreach ( $product  as $k=> $val ) {
                                            echo " <option value='$k'". ($k==$query['goods_id']?'selected':'').">$val</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" style="margin: 5px;">
                                    <label><?= $modelLabel->getAttributeLabel("created_time") ?>：</label>
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
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12">
                                <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("order_sn") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("goods_id") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("user_id") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("order_deposit") ?>/$</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("created_time") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("status") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($model as $list) {
                                        ?>
                                        <tr id="rowid_$list->order_id">
                                            <td><label><input type="checkbox" value="<?= $list->order_id ?>"></label>
                                            </td>
                                            <td><?= $list->order_sn ?></td>
                                            <td><?= $list->product['title'] ?></td>
                                            <td><?= $list->member['usersname'] ?></td>
                                            <td><?= $list->order_deposit ?></td>
                                            <td><?= date('Y-m-d H:i',$list->created_time) ?></td>
                                            <td>
                                                <?php
                                                if($list->status==0) { ?>
                                                    <a id="view_btn" class="btn btn-primary btn-sm" onclick="change(<?=$list->order_id?>,2)"><i class="glyphicon glyphicon-edit icon-white"></i>通过</a>
                                                    <a id="view_btn" class="btn btn-primary btn-sm" onclick="change(<?=$list->order_id?>,1)"><i class="glyphicon glyphicon-edit icon-white"></i>不通过</a>
                                                <?php }else if($list->status==4) { ?>
                                                    <a id="view_btn" class="btn btn-primary btn-sm" onclick="change(<?=$list->order_id?>,5)"><i class="glyphicon glyphicon-edit icon-white"></i>同意终止</a>
                                                    <a id="view_btn" class="btn btn-primary btn-sm" onclick="change(<?=$list->order_id?>,6)"><i class="glyphicon glyphicon-edit icon-white"></i>不同意</a>
                                                <?php } else {
                                                    echo $order_status[$list->status];
                                                }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <a id="view_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->order_id]) ?>">
                                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <a id="edit_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/update', 'id' => $list->order_id]) ?>">
                                                    <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                <a id="delete_btn" onclick="deleteAction('<?= $list->order_id ?>')"
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

<?php $this->beginBlock('footer'); ?>
<script>
    function change(order_id,state) {
        admin_tool.confirm('确定此操作吗', function () {
            $.ajax({
                type: "POST",
                url: "<?= Url::toRoute($this->context->id . '/change-state')?>",
                data: {"order_id": order_id, 'state':state},
                cache: false,
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success: function (data) {
                    if(data==100) {
                        window.location.reload()
                    }
                }
            });
        })

    }

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
