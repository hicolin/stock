<?php

use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminUserpeoduct;
use backend\controllers\AdminUserpeoductController;
use common\helps\Tools;

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
                                        <span class="input-group-addon">层级:</span>
                                        <select name="query[pAgent]" id="" class="form-control">
                                            <?php foreach ($sonAgent as $k => $v): ?>
                                                <option <?= (isset($query["pAgent"]) && $query["pAgent"] == $k) ? 'selected' : '' ?>
                                                        value="<?= $k ?>"><?= $v ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">后台账号:</span>
                                        <input type="text" class="form-control" id="query[uname]" name="query[uname]"
                                               value="<?= isset($query["uname"]) ? $query["uname"] : "" ?>">
                                    </div>
                                </div>

                                <!--                                <div class="col-lg-2 mar-5">-->
                                <!--                                    <div class="input-group" style="margin: 5px;">-->
                                <!--                                        <span class="input-group-addon">提交返佣:</span>-->
                                <!--                                        <select name="query[state]" class="form-control">-->
                                <!--                                            <option -->
                                <? //=$query["state"]=='tt'?'selected':''?><!-- value="tt">请选择</option>-->
                                <!--                                            <option -->
                                <? //=!$query["state"]?'selected':''?><!-- value="0">未提交</option>-->
                                <!--                                            <option -->
                                <? //=$query["state"]==1?'selected':''?><!-- value="1">已提交</option>-->
                                <!--                                        </select>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <div class="form-group" style="margin-top: 10px;">
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
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                if (in_array($role_id, [1, 2, 3])) { ?>
                                    <!-- <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>-->
                                <?php }
                                ?>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <!--<th><input id="data_table_check" type="checkbox"></th>-->
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">id
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">层级关系
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">后台账号
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">综合手续费返佣比例/%
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">递延手续费返佣比例/%
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">返佣金额/￥
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">手续费/￥
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">递延费/￥
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">邀请码
                                        </th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">状态
                                        </th>
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
                                            <!-- <td><label><input name="count_money" type="checkbox" value="<?/*= $list->id */ ?>"></label></td>-->
                                            <td><?= $list->id ?></td>
                                            <!--<td><?/*= AdminUserpeoductController::getInfo($list->pid) */ ?></td>-->
                                            <td>
                                                <?php
                                                $p = \backend\models\AdminUser::getAllParentName($list->id);
                                                if (!empty($p)) {
                                                    krsort($p);
                                                    echo (implode("->", $p)) ? (implode("->", $p) . '->') : '';
                                                    echo \backend\models\Adminuser::findOne($list->id)->uname;
                                                }
                                                ?>
                                            </td>
                                            <td><?= $list->uname ?></td>
                                            <td><?= $list->rate ? $list->rate : '--' ?><?php if ($list->status == 10): ?>
                                                    <a id="edit_btn" onclick="szRate('<?= $list->id ?>','rate')"
                                                       class="btn btn-primary btn-sm" href="javascript:;"
                                                       style="margin-left: 10px;"><i
                                                                class="glyphicon glyphicon-edit icon-white"></i>设置比例</a>
                                                <?php endif; ?></td>
                                            <td><?= $list->dy_rate ? $list->dy_rate : '--' ?><?php if ($list->status == 10): ?>
                                                    <a id="edit_btn" onclick="szRate('<?= $list->id ?>','dy_rate')"
                                                       class="btn btn-primary btn-sm" href="javascript:;"
                                                       style="margin-left: 10px;"><i
                                                                class="glyphicon glyphicon-edit icon-white"></i>设置比例</a>
                                                <?php endif; ?></td>

                                            <td><?= $list->info['commission_member'] ?></td>
                                            <td><?= $list->info['commission_amount'] ?></td>
                                            <td><?= $list->info['commission_agent'] ?></td>

                                            <td><?= $list->vatation_code ?: '--' ?></td>
                                            <td><?php
                                                if ($list->status == 0) {
                                                    echo '待审核';
                                                } else if ($list->status == 1) {
                                                    echo '未通过';
                                                } else {
                                                    echo '通过';
                                                }
                                                ?></td>
                                            <td class="center">
                                                <?php
                                                if ($role_id == 2) { ?>
                                                    <?php if ($list->status == 10): ?>
                                                        <a id="view_btn" class="btn btn-primary btn-sm"
                                                           href="<?= Url::toRoute([$this->context->id . '/detail', 'id' => $list->id]) ?>">
                                                            <i class="glyphicon glyphicon-zoom-in icon-white"></i>返佣明细</a>
                                                    <?php endif; ?>

                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                    <?php
                                                    if ($list->status != 10) { ?>
                                                        <a id="edit_btn" class="btn btn-primary btn-sm"
                                                           href="<?= Url::toRoute([$this->context->id . '/update', 'id' => $list->info['id']]) ?>">
                                                            <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                    <?php }
                                                    ?>
                                                <?php } else {


                                                    if ($list->status == 0) { ?>
                                                        <a id="view_btn" onclick="change(<?= $list->id ?>,10)"
                                                           class="btn btn-primary btn-sm" href="javascript:;"><i
                                                                    class="glyphicon glyphicon-edit icon-white"></i>通过</a>
                                                        <a id="view_btn" onclick="change(<?= $list->id ?>,1)"
                                                           class="btn btn-primary btn-sm" href="javascript:;"><i
                                                                    class="glyphicon glyphicon-edit icon-white"></i>不通过</a>
                                                    <?php } else { ?>
                                                        <?php if ($list->status == 10): ?>
                                                            <a id="view_btn" class="btn btn-primary btn-sm"
                                                               href="<?= Url::toRoute([$this->context->id . '/commission-list', 'id' => $list->id]) ?>">
                                                                <i class="glyphicon glyphicon-zoom-in icon-white"></i>返佣明细</a>
                                                        <?php endif; ?>
                                                    <?php }
                                                    ?>

                                                    <a id="view_btn" class="btn btn-primary btn-sm"
                                                       href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>"><i
                                                                class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                    <?php if (empty($list->info['id'])) { ?>
                                                        <a id="edit_btn" class="btn btn-primary btn-sm"
                                                           href="#" disabled="disabled"><i
                                                                    class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                    <?php } else { ?>
                                                        <a id="edit_btn" class="btn btn-primary btn-sm"
                                                           href="<?= Url::toRoute([$this->context->id . '/update', 'id' => $list->info['id']]) ?>"><i
                                                                    class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                                    <?php } ?>
                                                    <a id="delete_btn" onclick="cjDelete('<?= $list->id ?>')"
                                                       class="btn btn-danger btn-sm" href="javascript:;"> <i
                                                                class="glyphicon glyphicon-trash icon-white"></i>删除</a>


                                                <?php } ?>
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
                                <div class="search col-sm-3">
                                    <button class="btn btn-success" style="border-right: none;float: left">返佣合计</button>
                                    <span id="money" class="form-control"
                                          style="border-left: none;width: 140px;float: left">￥<?= $data['money'] ?: 0 ?></span>
                                </div>
                                <!--<div class="search col-sm-3">
                                    <button class="btn btn-success" style="border-right: none;float: left">截佣合计</button><span id="agent_money" class="form-control" style="border-left: none;width: 140px;float: left" >￥<? /*=$data['money_agent']?:0*/ ?></span>
                                </div>-->
                                <!--<div class="search col-sm-3">
                                    <button class="btn btn-success" style="border-right: none;float: left">佣金总额</button><span id="count_money" class="form-control" style="border-left: none;width: 140px;float: left" >￥<? /*=$data['money']+$data['money_agent']*/ ?></span>
                                </div>-->
                                <!--<div class="search col-sm-4">
                                    <button class="btn btn-success" style="border-right: none;float: left">代理总数</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><? /*=$data['num']*/ ?></span>
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
    function cjDelete(id) {
        admin_tool.confirm('请确认是否删除', function () {
            $.ajax({
                type: "GET",
                url: "<?=Url::toRoute($this->context->id . '/cj')?>",
                data: {"id": id},
                cache: false,
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success: function (data) {
//                    alert(data);
                    if (data == 800) {
                        layer.alert('没有权限', {icon: 2});
                        return false;
                    } else if (data == 600) {
                        admin_tool.alert('msg_info', '删除成功', 'success');
                        window.location.reload();
                    }
                    //admin_tool.alert('msg_info', '删除成功', 'success');
                    //window.location.reload();
                }
            });
        });
    }

    function searchAction() {
        $('#admin-search-form').submit();
    }

    function sub_commission(id) {
        admin_tool.confirm('请确认是否提交返佣', function () {
            $.ajax({
                type: "GET",
                url: "<?= Url::toRoute($this->context->id . '/sub-commission')?>",
                data: {"id": id},
                cache: false,
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success: function (data) {
                    if (data == 100) {
                        //发送短信通知财务
                        var templateId = "161429";
                        var tel = "<?=Tools::getSetting(33)?>";
                        $.ajax({
                            url: "/ucpass/ucpass.php",
                            type: 'post',
                            data: {'tel': tel, 'templateId': templateId},
                            dataType: 'text',
                            success: function (data1) {
                                layer.confirm('提交成功', {
                                    btn: ['确定'] //按钮
                                }, function () {
                                    window.location.reload();
                                }, function (e) {
                                    layer.close(e);
                                    return false;
                                });
                            }
                            //beforeSend:function(){},
                        });

                        window.location.reload();
                    } else {
                        layer.alert('提交失败', {icon: 2});
                        return false;
                    }
                }
            });
        })
    }

    function change(id, state) {
        if (state == 10) {
            layer.prompt({title: '请输入登录密码', formType: 1}, function (text, index) {
                layer.close(index);
                post_change(id, state, text)
            });
        } else {
            var text = 0;
            post_change(id, state, text)
        }
        //layer.alert('没有权限', {icon: 2});
        //return false;
    }

    function post_change(id, state, text) {
        $.ajax({
            type: "GET",
            url: "<?= Url::toRoute($this->context->id . '/change')?>",
            data: {"id": id, "state": state, 'pwd': text},
            cache: false,
            dataType: "text",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function (data) {
                if (data == 800) {
                    layer.alert('没有权限', {icon: 2});
                    return false;
                } else if (data == 100) {
                    layer.prompt({title: '设置返佣比例%', formType: 3}, function (rate, index) {
                        $.post('<?=Url::toRoute($this->context->id . '/rate')?>', {
                            id: id,
                            rate: rate,
                            _csrf: '<?=Yii::$app->request->csrfToken?>'
                        }, function (msg) {
                            if (msg == 300) {
                                layer.msg('返佣比例不可以大于上级返佣比例')
                            } else if (msg == 600) {
                                layer.msg('设置成功', {time: 1000}, function () {
                                    window.location.reload();
                                })
                            }
                        })
                    });

                } else if (data == 200) {
                    layer.alert('审核失败', {icon: 2});
                    return false;
                }
            }
        });
    }

    function szRate(id, key) {
        layer.prompt({title: '设置返佣比例%', formType: 3}, function (rate, index) {
            $.post('<?=Url::toRoute($this->context->id . '/rate')?>', {
                id: id,
                rate: rate,
                key: key,
                _csrf: '<?=Yii::$app->request->csrfToken?>'
            }, function (msg) {
                if (msg == 300) {
                    layer.msg('返佣比例不可以大于上级返佣比例')
                } else if (msg == 600) {
                    layer.msg('设置成功', {time: 1000}, function () {
                        window.location.reload();
                    })
                }
            })
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


    function countAction() {
        var ids = [];
        var id = document.getElementsByName('count_money');
        for (var i = 0; i < id.length; i++) {
            if (id[i].checked)
                ids.push(id[i].value);
        }
        if (ids.length > 0) {
            $.ajax({
                type: "GET",
                url: "<?=Url::toRoute($this->context->id . '/count-commission')?>",
                data: {"ids": ids},
                cache: false,
                dataType: "json",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success: function (data) {
                    $('#money').html('￥' + data.money)
                    $('#agent_money').html('￥' + data.money_agent)
                    $('#count_money').html('￥' + data.money_count)
                }
            });
        }
    }
</script>

<script>
    function sub_agent(id) {
        admin_tool.confirm('请确认是否提交返佣', function () {
            $.ajax({
                type: "GET",
                url: "<?= Url::toRoute($this->context->id . '/agent-sub')?>",
                data: {"id": id},
                cache: false,
                dataType: "text",
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("出错了，" + textStatus);
                },
                success: function (data) {
                    if (data == 100) {
                        //发送短信通知财务
                        var templateId = "161429";
                        var tel = "<?=Tools::getSetting(33)?>";
                        $.ajax({
                            url: "/ucpass/ucpass.php",
                            type: 'post',
                            data: {'tel': tel, 'templateId': templateId},
                            dataType: 'text',
                            success: function (data1) {
                                layer.confirm('提交成功', {
                                    btn: ['确定'] //按钮
                                }, function () {
                                    window.location.reload();
                                }, function (e) {
                                    layer.close(e);
                                    return false;
                                });
                            }
                            //beforeSend:function(){},
                        });
                        //window.location.reload();
                        return
                    } else if (data == 200) {
                        layer.alert('下级没有全部提交', {icon: 2});
                        return false;
                    } else if (data == 300) {
                        layer.alert('返佣金额为0', {icon: 2});
                        return false;
                    } else if (data == 400) {
                        layer.alert('提交失败', {icon: 2});
                        return false;
                    }
                }
            });
        })
    }
</script>
<?php $this->endBlock(); ?>
