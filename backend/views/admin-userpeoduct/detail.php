<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminUserpeoduct;
use backend\controllers\AdminUserpeoductController;
$modelLabel = new \backend\models\AdminUserpeoduct()
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
                            <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/index']) ?>"
                               class="btn btn-xs btn-primary">返回列表</a>
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
                                    <label>交易日：</label>
                                    <input type="text" class="form-control ECalendar" id="b_time" name="query[b_time]" value="<?= $query["b_time"] ? date('Y-m-d H:i',$query["b_time"]) : "" ?>"> -
                                    <input type="text" class="form-control ECalendar" id="e_time" name="query[e_time]" value="<?= $query["e_time"] ? date('Y-m-d H:i',$query["e_time"]) : "" ?>">
                                </div>
                                <div class="form-group" style="margin: 5px;">
                                    <label>姓名：</label>
                                    <input type="text" class="form-control" id="name" name="query[name]" value="<?= $query["name"] ? $query["name"] : "" ?>">
                                </div>
                                <div class="form-group" style="margin: 5px;">
                                    <label>交易账号：</label>
                                    <input type="text" class="form-control" id="xgj_name" name="query[xgj_name]" value="<?= $query["xgj_name"] ? $query["xgj_name"] : "" ?>">
                                </div>
                                <div class="form-group">
                                    <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                    <a class="btn btn-primary btn-sm" href="<?= Url::toRoute([$this->context->id . '/detail','id'=>yii::$app->request->get('id')]) ?>"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                if( in_array($role_id, [1,5,6,7])) { ?>
                                    <!--<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>-->
                                <?php }
                                ?>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <!--<th><input id="data_table_check" type="checkbox"></th>-->
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">交易日</th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">姓名</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">用户手机号</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">交易账号</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">交易合约</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">手数</th>
                                        <!--<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">买卖</th>-->
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">实际日期</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">成交时间</th>
                                        <!--<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">开平</th>-->
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">手续费</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">平仓盈亏</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">佣金/¥</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">状态</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($model as $list) {
                                        ?>
                                        <tr id="rowid_$list->order_id">
                                            <!--<td><label><input type="checkbox" value="<?/*= $list->id */?>"></label></td>-->
                                            <td><?= date('Y-m-d',$list->jy_time) ?></td>
                                            <td><?= $list->member['realname'] ?></td>
                                            <td><?= $list->member['usersname'] ?></td>
                                            <td><?= $list->member['xgj_name'] ?></td>
                                            <td><?= $list->contract ?></td>
                                            <td><?= $list->amount ?></td>
                                           <!-- <td><?/*= $list->transaction */?></td>-->
                                            <td><?= $list->sj_time ?></td>
                                            <td><?= $list->cj_time ?></td>
                                            <!--<td><?/*= $list->kaiping */?></td>-->
                                            <td><?= $list->charge ?></td>
                                            <td><?= $list->pc_yingkui ?></td>
                                            <td><?= $list->commission_money ?></td>
                                            <td><?php if($list->status==0){?>
                                             <?php if($list->uid==$uid){?>
                                            <button onclick="sqTx(<?=$list->id?>)" class="btn btn-xs btn-warning">申请提现</button><?php }else{echo '未申请';}?>

                                                <?php }elseif($list->status==1){?>
                                                审核中
                                                <?php }elseif($list->status==2){?>
                                                提现成功
                                                <?php }elseif($list->status==3){?>
                                                    <?php if($list->uid==$uid){?>
                                                    <button onclick="sqTx(<?=$list->id?>)" class="btn btn-xs btn-warning">再次申请</button><?php }else{echo '审核失败';}?>
                                                <?php }?>
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
    function sqTx(id){
        alert(id);
    }
    function searchAction() {
        $('#admin-search-form').submit();
    }

    function change(id,state) {
        if(state==10) {
            layer.prompt({title: '请输入登录密码', formType: 1}, function(text, index){
                layer.close(index);
                post_change(id,state,text)
            });
        } else {
            var text = 0;
            post_change(id,state,text)
        }
        //layer.alert('没有权限', {icon: 2});
        //return false;
    }

    function post_change(id,state,text) {
        $.ajax({
            type: "GET",
            url: "<?= Url::toRoute($this->context->id . '/change')?>",
            data: {"id": id,"state":state,'pwd':text},
            cache: false,
            dataType: "text",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function (data) {
                if(data==800) {
                    layer.alert('没有权限', {icon: 2});
                    return false;
                } else if(data==100) {
                    window.location.reload();
                } else if(data==200) {
                    layer.alert('审核失败', {icon: 2});
                    return false;
                }
            }
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
