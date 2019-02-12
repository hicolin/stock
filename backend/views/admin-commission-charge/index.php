<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminCommissionCharge;
use backend\controllers\AdminCommissionChargeController;

$modelLabel = new \backend\models\AdminCommissionCharge()
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                    <div class="col-lg-2 mar-10">
                                        <div class="input-group" style="margin: 5px;">
                                            <span class="input-group-addon">姓名:</span>
                                            <input type="text" class="form-control" id="query[name]" name="query[name]" value="<?= isset($query["name"]) ? $query["name"] : "" ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mar-5">
                                        <div class="input-group" style="margin: 5px;">
                                            <span class="input-group-addon">状态:</span>
                                            <select name="query[state]" class="form-control">
                                                <option value='-1'>请选择</option>
                                                <option value='0' <?=isset($query["state"])&&$query["state"]==0?'selected':''?>>待审核</option>
                                                <option value='1' <?=$query["state"]==1?'selected':''?>>通过</option>
                                                <option value='2' <?=$query["state"]==2?'selected':''?>>不通过</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">申请时间:</span>
                                        <input type="text" class="form-control" id="b_time" value="<?=!empty($query["b_time"]) ? $query["b_time"] : "" ?>"  placeholder="点击选择时间" name="query[b_time]">
                                        <span class="input-group-addon">至:</span>
                                        <input type="text" class="form-control" id="e_time" value="<?=!empty($query["e_time"]) ? $query["e_time"] : "" ?>"  placeholder="点击选择时间" name="query[e_time]">
                                    </div>

                                    <div class="form-group">
                                        <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                        <a class="btn btn-primary btn-sm" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12">
                                <?php
                                if($role_id == 1) { ?>
                                    <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <?php }
                                ?>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("id") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("uid") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("money") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">打款流水号</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("create_time") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">确定时间</th>
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
                                            <td><?= $list->id ?></td>
                                            <td><?= $list->info['uname'] ?></td>
                                            <td><?= $list->money ?></td>
                                            <td><?= $list->flow_count?:'未打款' ?></td>
                                            <td><?= date('Y-m-d H:i:s',$list->create_time) ?></td>
                                            <td><?= date('Y-m-d H:i:s',$list->update_time) ?></td>
                                            <td><?php if($list->state==0){?>审核中<?php }elseif($list->state==1){?>通过<?php  }else{?>不通过<?php }?></td>
                                            <td class="center">
                                                <?php
                                                if($list->state==0 && $list->uid != $admin_id) { ?>
                                                    <a id="edit_btn1" onclick="play_money(<?=$list->id?>)" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-edit icon-white"></i>确认打款</a>
                                                <?php }else{ ?>
                                                    <a style="padding-left: 15px;" id="edit_btn1" href="javascript:;">----</a>
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
                            <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">总佣金/¥</button><span class="form-control" style="border-left: none;width: 140px;float: left"><?=$sum?></span>
                                </div>
                                <!--<div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">当前权益总额/¥</button><span class="form-control" style="border-left: none;width: 140px;float: left" ></span>
                                </div>
                                <div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">可用资金总额/¥</button><span class="form-control" style="border-left: none;width: 140px;float: left" ></span>
                                </div>-->

                            </div>
                        </div>
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

    function play_money(id) {
        layer.prompt({title: '请输入打款流水账号', formType: 2}, function(text, index){
            layer.close(index);
            $.ajax({
                type: "GET",
                url: "<?= Url::toRoute($this->context->id . '/play-money')?>",
                data: {"id": id,'flow_count':text},
                cache: false,
                dataType: "text",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success: function (data) {
                    if(data==200) {
                        layer.alert('已经确认打款', {icon: 2});
                        return false;
                    }else if(data==300) {
                        layer.alert('确认失败', {icon: 2});
                        return false;
                    }else if(data==400) {
                        layer.alert('没有权限', {icon: 2});
                        return false;
                    }else if(data==100) {
                        window.location.reload();
                    }
                    return false;
                }
            });
        });
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

</script>

<?php $this->endBlock(); ?>
