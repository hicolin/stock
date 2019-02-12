<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminCharge;

$modelLabel = new \backend\models\AdminCharge()
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
                            <!-- <a id="create_btn" href="<? /*= Url::toRoute([$this->context->id . '/create']) */ ?>"
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

                                <div class="col-lg-2 mar-5">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">支付状态:</span>
                                        <select name="query[state]" class="form-control">
                                            <option value='-1'>请选择</option>
                                            <option value='0' <?=(isset($query["state"]) && $query["state"]==0) ? 'selected' : ''?>>未支付</option>
                                            <option value='1' <?=(isset($query["state"]) && $query["state"]==1) ? 'selected' : ''?>>已支付</option>
                                            <option value='2' <?=(isset($query["state"]) && $query["state"]==2) ? 'selected' : ''?>>失败</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">流水号:</span>
                                        <input type="text" class="form-control" id="query[pay_ordersid]" name="query[pay_ordersid]"
                                               value="<?= isset($query["pay_ordersid"]) ? $query["pay_ordersid"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">用户:</span>
                                        <input type="text" class="form-control" id="query[realname]" name="query[realname]"
                                               value="<?= isset($query["realname"]) ? $query["realname"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-5">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">充值方式:</span>
                                        <select name="query[status]" class="form-control">
                                            <option value='-1'>请选择</option>
                                            <option value='1' <?=(isset($query["status"]) && $query["status"]==1) ? 'selected' : ''?>>线上充值</option>
                                            <option value='2' <?=(isset($query["status"]) && $query["status"]==2) ? 'selected' : ''?>>线下充值</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">交易账号:</span>
                                        <input type="text" class="form-control" id="query[xgj_name]" name="query[xgj_name]"
                                               value="<?= isset($query["xgj_name"]) ? $query["xgj_name"] : "" ?>">
                                    </div>
                                </div>

                                <div class="input-group" style="margin: 5px;">
                                    <span class="input-group-addon">充值时间:</span>
                                    <input type="text" class="form-control" id="b_time" value="<?=!empty($query["b_time"]) ? $query["b_time"] : "" ?>"  placeholder="点击选择时间" name="query[b_time]">
                                    <span class="input-group-addon">至:</span>
                                    <input type="text" class="form-control" id="e_time" value="<?=!empty($query["e_time"]) ? $query["e_time"] : "" ?>"  placeholder="点击选择时间" name="query[e_time]">
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
                                <?php
                                if (in_array($role_id, [1, 6])) { ?>
                                    <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                    <a href="<?= Url::toRoute([$this->context->id . '/export','query'=>$query]) ?>">
                                        <button id="export_btns" type="button" class="btn btn-xs btn-info">导出数据</button>
                                    </a>
                                <?php }
                                ?>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>

                                       <!--  <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">交易账号
                                        </th> -->
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">用户
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("money") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("fee_money") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("pay_ordersid") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("order_no") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("pay_type") ?></th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">充值方式</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("dates") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("state") ?></th>
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
                                            <!-- <td><?= $list->member['xgj_name'] ?></td> -->
                                            <td><?= $list->member['realname'] ?></td>
                                            <td><?= $list->money ?></td>
                                            <td><?= $list->fee_money ?></td>
                                            <td><?= $list->pay_ordersid ?></td>
                                            <td><?= $list->order_no ?></td>
                                            <td><?= $pay_type[$list->pay_type] ?></td>

                                            <td><?= $list->status==1?'线上充值':'线下充值' ?></td>
                                            <td><?= date('Y-m-d H:i:s', $list->dates) ?></td>
                                            <td><?= $state[$list->state] ?></td>
                                            <td class="center">
                                                <a id="view_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <!--<a id="edit_btn" class="btn btn-primary btn-sm"
                                                   href="<?/*= Url::toRoute([$this->context->id . '/update', 'id' => $list->id]) */ ?>">
                                                    <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                <a id="delete_btn" onclick="deleteAction('<?/*= $list->id */ ?>')"
                                                   class="btn btn-danger btn-sm" href="javascript:;"> <i
                                                            class="glyphicon glyphicon-trash icon-white"></i>删除</a>-->
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
                        <!-- row end -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">总充值/¥</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$sum['money']?></span>
                                </div>
                                <div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">总手续费/¥</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$sum['fee_money'] ?></span>
                                </div>

                            </div>
                        </div>
                        <!-- row start -->
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



    $(function () {
        $('#export_btn').on('click', function () {
            //alert(1)
        })
    })
</script>
<?php $this->endBlock(); ?>
