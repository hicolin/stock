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
                if ($role_id != 2 && $role_id != 7) { ?>
                    <div class="box-header">
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/create'])  ?>"
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
                        <div class="row" >
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">姓名:</span>
                                        <input type="text" class="form-control" id="query[realname]"
                                               name="query[realname]"
                                               value="<?= isset($query["realname"]) ? $query["realname"] : "" ?>">

                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">手机号:</span>
                                        <input type="text" class="form-control" id="query[tel]" name="query[tel]"
                                               value="<?= isset($query["tel"]) ? $query["tel"] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">实名状态:</span>
                                        <select name="query[state]" id="query[state]"
                                                style="height:34px;border: 1px solid #ccc;padding: 5px;">
                                            <option value="-1">全部</option>
                                            <?php foreach ($state as $k => $v) { ?>
                                                <option
                                                    value="<?= $k ?>" <?= $query['state'] == $k ? 'selected' : '' ?>><?= $v ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="input-group" style="margin: 5px;">
                                    <span class="input-group-addon">注册时间:</span>
                                    <input type="text" class="form-control" id="b_time"
                                           value="<?= !empty($query["b_time"]) ? $query["b_time"] : "" ?>"
                                           placeholder="点击选择时间" name="query[b_time]">
                                    <span class="input-group-addon">至:</span>
                                    <input type="text" class="form-control" id="e_time"
                                           value="<?= !empty($query["e_time"]) ? $query["e_time"] : "" ?>"
                                           placeholder="点击选择时间" name="query[e_time]">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="glyphicon glyphicon-zoom-in icon-white"></i>搜索
                                    </button>
                                    <a class="btn btn-primary btn-sm"
                                       href="<?= Url::toRoute([$this->context->id . '/' . Yii::$app->controller->action->id]) ?>"><i
                                            class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>

                        <hr/>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                if ($role_id != 2) { ?>
                                    <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <?php }
                                ?>
                                <a href="<?= Url::toRoute([$this->context->id . '/export','query'=>$query]) ?>"
                                   style="margin-left: 5px;">
                                    <button class="btn btn-xs btn-info">导出数据</button>
                                </a>

                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row" style="background-color: #797979 !important">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">ID
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("realname") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("tel") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("balance") ?>
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("state") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("pid") ?></th>
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
                                            <td><?= $list->realname ?: "未认证" ?></td>
                                            <td><?= $list->tel ?></td>
                                            <td><?= $list->money ?></td>
                                            <td>
                                                <?php
                                                if ($list->state == 2 && $role_id != 2) { ?>
                                                    <a id="view_btn"
                                                       onclick="check(3,'<?= $list->id ?>','<?= $list->tel ?>','<?= $list->xgj_name ?>','<?= $list->xgj_pwd ?>')"
                                                       class="btn btn-primary btn-sm" href="javascript:;"><i
                                                            class="glyphicon glyphicon-zoom-in icon-white"></i>通过</a>
                                                    <a id="view_btn"
                                                       onclick="check(0,'<?= $list->id ?>','<?= $list->tel ?>','<?= $list->xgj_name ?>','<?= $list->xgj_pwd ?>')"
                                                       class="btn btn-primary btn-sm" href="javascript:;"><i
                                                            class="glyphicon glyphicon-zoom-in icon-white"></i>不通过</a>
                                                <?php } else {
                                                    echo $state[$list->state];
                                                }
                                                ?>
                                            </td>
                                            <td><?= $list->pid ? : '156' ?></td>
                                            <td><?= date("Y-m-d H:i:s", $list->dates) ?></td>
                                            <td class="center">
                                                <?php if(isset($role_id) && ($role_id==1 || $role_id==8)):?>
                                                    <a  href="javascript:;" onclick="hangingMember('<?=$list->id?>')" class="btn btn-warning btn-sm">更改邀请人</a>
                                                <?php endif;?>
                                                <?php
                                                if ($role_id == 2) { ?>
                                                    <a id="view_btn"
                                                       class="btn btn-primary btn-sm" <?= !$list->xgj_name ? 'disabled' : '' ?>
                                                       href="<?= $list->xgj_name ? Url::toRoute([$this->context->id . '/detail', 'xgj_name' => $list->xgj_name]) : 'javascript:;' ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>交易明细</a>
                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <?php } else { ?>
                                                    <!--<a id="view_btn"
                                                       class="btn btn-primary btn-sm" <?/*= !$list->xgj_name ? 'disabled' : '' */?>
                                                       href="<?/*= $list->xgj_name ? Url::toRoute([$this->context->id . '/detail', 'xgj_name' => $list->xgj_name]) : 'javascript:;' */?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>交易明细</a>-->
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
                                    <button class="btn btn-success" style="border-right: none;float: left">会员总数</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$num?></span>
                                </div>
                                <div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">认证人数</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$rz ?></span>
                                </div>
                                <div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">未认证人数</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$wrz ?></span>
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
                                <div class="col-sm-7" style="<?=$this->context->action->id=='pay-number'?'display:none':''?>" >
                                    总余额/¥：<span style="color: #f00;font-size: 18px"><?=$sum['balance']?></span>&nbsp;&nbsp;&nbsp;&nbsp;

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

    <!--<div>
        <div style="margin-top:30px;text-align:center;" class="first">
            <div style="float:left;height:35px;line-height:35px;margin-left:7%;font-size:14px;">主账户：</div>
            <select style="margin-top: 8px;margin-left: 0;float: left" id="account">
                <?php
/*                foreach ($account as $list) { */?>
                    <option style="width: 100px;" value="<?/*= $list->id */?>"><?/*= $list->account */?></option>
                <?php /*}
                */?>
            </select>
            <div style="clear:both"></div>
            <div style="text-align:center;margin-top:25px">
                <input type="button" value="确　定" class="pay_up"
                       style="width:80px;height:30px;color:#fff;background:#14bc88;border:0px;border-radius:5px;">
            </div>
        </div>
    </div>-->
    <div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>会员转挂</h3>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(["id" => "admin-user-form", "class"=>"form-horizontal", "action"=>Url::toRoute("admin-member/hanging")]); ?>
                    <input type="hidden" class="form-control" id="uid" name="uid" />
                    <div id="role_div" class="form-group">
                        <label for="role" class="col-sm-2 control-label">角色分类</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="pre_id" id="role">
                                <?php foreach($user as $k=>$v):?>
                                    <option value="<?=$k?>"><?=$v?></option>
                                <?php endforeach;?>

                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a>
                    <a id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
                </div>
            </div>
        </div>
    </div>
    <?php $this->beginBlock('footer'); ?>
    <script>
        function  hangingMember(id){
            layer.confirm('是否确定更改邀请人?',{icon:3,btn:['是','否']},function(){
                layer.closeAll();
                $('#uid').val(id);

                $('#edit_dialog').modal('show');
            })
        }
        $('#edit_dialog_ok').click(function (e) {
            e.preventDefault();
            $('#admin-user-form').submit();
        });
    </script>
    <script>
        var account = '';
        var user_idss = '';
        var statess = '';
        function check(state, user_id, tel, xgj_name, xgj_pwd) {
            user_idss = user_id;
            statess = state;
            if (state == 3) {
                var html = $('.hidden').html();
                layer.open({
                    type: 1,
                    closeBtn: 0,
                    title: false,
                    offset: ['250px'],
                    shadeClose: true,
                    area: ['300px', '150px'],
                    content: html,
                });
            } else {
                change_fuc();
            }
        }

        $(document).on('click', '.pay_up', function () {
            account = $(this).parent('div').prevAll('select').val();
            alert(account)
            //layer.closeAll();
            change_fuc();
        })

        function change_fuc() {
            $.ajax({
                type: "POST",
                url: "<?= Url::toRoute($this->context->id . '/change')?>",
                data: {"state": statess, 'user_id': user_idss, 'account': account},
                cache: false,
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    //alert("出错了，" + textStatus);
                },
                success: function (data) {
                    if (data == 800) {
                        layer.alert('没有权限', {icon: 2});
                        return false;
                    } else if (data == 400) {
                        layer.alert('已经审核', {icon: 2});
                        window.location.reload();
                        return false;
                    } else if (data == 100 && statess == 0) {
                        window.location.reload();
                    } else if (data == 100 && statess == 3) {
                        var templateId = "141503";
                        $.ajax({
                            type: "POST",
                            url: "<?= Url::toRoute($this->context->id . '/get-info')?>",
                            data: {"id": user_idss},
                            cache: false,
                            dataType: "json",
                            error: function (xmlHttpRequest, textStatus, errorThrown) {
                                alert("出错了，" + textStatus);
                            },
                            success: function (data1) {
                                $.ajax({
                                    url: "/ucpass/ucpass2.php",
                                    type: 'post',
                                    data: {
                                        'tel': data1.tel,
                                        'templateId': templateId,
                                        'xgj_name': data1.xgj_name,
                                        'xgj_pwd': data1.xgj_pwd
                                    },
                                    dataType: 'text',
                                    //beforeSend:function(){},
                                    success: function (data2) {
                                        if (data2) {
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

    </script>
    <?php $this->endBlock(); ?>
