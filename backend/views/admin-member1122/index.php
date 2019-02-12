<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminMember;
use common\helps\Tools;
use backend\controllers\PublicController;
use backend\controllers\AdminUserpeoductController;

$modelLabel = new \backend\models\AdminMember()
?>
<?php $this->beginBlock('header'); ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php
                if($role_id !=2 && $role_id != 7) { ?>
                    <div class="box-header">
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/create']) ?>"
                                   class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                <div class="form-group" style="margin: 5px;">
                                    <label>姓名:</label>
                                    <input type="text" class="form-control" id="query[realname]" name="query[realname]"
                                           value="<?= isset($query["realname"]) ? $query["realname"] : "" ?>">
                                    <label>手机号:</label>
                                    <input type="text" class="form-control" id="query[tel]" name="query[tel]"
                                           value="<?= isset($query["tel"]) ? $query["tel"] : "" ?>">
                                    <label>交易账号:</label>
                                    <input type="text" class="form-control" id="query[xgj_name]" name="query[xgj_name]"
                                           value="<?= isset($query["xgj_name"]) ? $query["xgj_name"] : "" ?>">
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
                                if($role_id!=2) { ?>
                                    <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <?php }
                                ?>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">代理关系</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("usersname") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("realname") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("xgj_name") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("money") ?>/$</th>
                                        <!--<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">可用资金/$</th>-->


                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("profit_money") ?>/$</th>
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
                                            <td><?= AdminUserpeoductController::getInfo($list->vatation_code2) ?></td>
                                            <td><?= $list->usersname ?></td>
                                            <td><?= $list->realname ?></td>
                                            <td><?= $list->xgj_name ?></td>
                                            <td><?= $list->money ?></td>
                                            <!--<td><?/*= $ky_money[$list->xgj_name] */?></td>-->
                                            <td><?= $list->profit_money?></td>
                                            <td><?= date("Y-m-d H:i:s", $list->dates) ?></td>
                                            <td>
                                                <?php
                                                if($list->state == 2 && $role_id != 2) { ?>
                                                    <a id="view_btn" onclick="check(3,'<?=$list->id?>','<?=$list->tel?>','<?=$list->xgj_name?>','<?=$list->xgj_pwd?>')" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>通过</a>
                                                    <a id="view_btn" onclick="check(0,'<?=$list->id?>','<?=$list->tel?>','<?=$list->xgj_name?>','<?=$list->xgj_pwd?>')" class="btn btn-primary btn-sm" href="javascript:;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>不通过</a>
                                                <?php } else {
                                                    echo $state[$list->state];
                                                }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                if($role_id==2) { ?>
                                                    <a id="view_btn" class="btn btn-primary btn-sm" <?=!$list->xgj_name?'disabled':''?>
                                                       href="<?= $list->xgj_name?Url::toRoute([$this->context->id . '/detail', 'xgj_name' => $list->xgj_name]):'javascript:;' ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>交易明细</a>
                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <?php } else { ?>
                                                    <a id="view_btn" class="btn btn-primary btn-sm" <?=!$list->xgj_name?'disabled':''?>
                                                       href="<?= $list->xgj_name?Url::toRoute([$this->context->id . '/detail', 'xgj_name' => $list->xgj_name]):'javascript:;' ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>交易明细</a>
                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                    <a id="edit_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/update', 'id' => $list->id]) ?>">
                                                        <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                    <a id="delete_btn" onclick="deleteAction('<?= $list->id ?>')"
                                                       class="btn btn-danger btn-sm" href="javascript:;"> <i
                                                                class="glyphicon glyphicon-trash icon-white"></i>删除</a>
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
                                    <button class="btn btn-success" style="border-right: none;float: left">今日新增会员</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$data['today_num']?></span>
                                </div>
                                <div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">会员总数</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$data['num']?></span>
                                </div>
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
    function check(state,user_id,tel,xgj_name,xgj_pwd) {

        $.ajax({
            type: "POST",
            url: "<?= Url::toRoute($this->context->id . '/change')?>",
            data: {"state": state, 'user_id':user_id},
            cache: false,
            dataType: "json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                //alert("出错了，" + textStatus);
            },
            success: function (data) {
                if(data==800) {
                    layer.alert('没有权限', {icon: 2});
                    return false;
                }else if(data==400) {
                    layer.alert('已经审核', {icon: 2});
                    window.location.reload();
                    return false;
                }else if(data==100 && state==0) {
                    window.location.reload();
                }else if(data==100 && state==3) {
                    var templateId = "141503";
                    $.ajax({
                       type: "POST",
                       url: "<?= Url::toRoute($this->context->id . '/get-info')?>",
                       data: {"id": user_id},
                       cache: false,
                       dataType: "json",
                       error: function (xmlHttpRequest, textStatus, errorThrown) {
                           alert("出错了，" + textStatus);
                       },
                       success: function (data1) {
                           $.ajax({
                               url  : "/ucpass/ucpass2.php",
                               type : 'post',
                               data : {'tel':tel,'templateId':templateId,'xgj_name':data1.xgj_name,'xgj_pwd':data1.xgj_pwd},
                               dataType:'text',
                               //beforeSend:function(){},
                               success: function (data2) {
                                   if(data2) {
                                       window.location.reload();
                                   }
                               }
                           });
                       }
                   });

                   //window.location.reload();
               }
            }
        });
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
