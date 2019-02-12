<?php

use yii\bootstrap\ActiveForm;

use yii\widgets\LinkPager;

use yii\helpers\Url;

use yii\helpers\Html;

use backend\models\AdminChargexx;



$modelLabel = new \backend\models\AdminChargexx()

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
                        <?php if($role_id==1):?>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?= Url::toRoute([$this->context->id . '/create']) ?>" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                            &nbsp;&nbsp
                        </div>
                        <?php endif;?>
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

                                        <span class="input-group-addon">状态:</span>


                                       <select name="query[state]" class="form-control">

                                        <option value='-1'>请选择</option>

                                        <?php foreach ($state as $k => $v) { ?>

                                                <option  value="<?= $k ?>" <?= $query['state'] == $k ? 'selected' : '' ?>><?= $v ?></option>

                                            <?php } ?>

                                    </select>

                                    </div>

                                </div>

                                <div class="col-lg-2 mar-10">

                                    <div class="input-group" style="margin: 5px;">

                                        <span class="input-group-addon">会员账号:</span>

                                        <input type="text" class="form-control" id="query[order_sn]" name="query[users_id]" value="<?= isset($query["users_id"]) ? $query["users_id"] : "" ?>">
                                       
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





                        <hr>

                        <div class="row">

                            <div class="col-sm-12">

                                <?php

                                if(in_array($role_id, [1,6])) { ?>

                                    <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>

                                    <a href="<?=Url::toRoute([$this->context->id . '/export','query'=>$query]) ?>">

                                        <button id="export_btns" type="button" class="btn btn-xs btn-info">导出数据</button></a>

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

                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("users_id") ?></th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"

                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("money") ?></th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"

                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("title") ?></th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"

                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("pay_type") ?></th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"

                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("img_url") ?></th>

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

                                            <td><?= $list->pay_type ?></td>

                                            <td><a href="#" onclick="Ckpz('<?= $list->img_url ?>')">查看凭证</a></td>

                                            <td><?php

                                                if($list->state==0){

                                                    echo '未审核';

                                                } else {

                                                    echo $list->state==1?'成功':'失败';

                                                }

                                                ?></td>

                                            <td><?= date('Y-m-d H:i:s',$list->dates) ?></td>

                                            <td class="center">

                                                <a id="view_btn" class="btn btn-primary btn-sm"

                                                   href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">

                                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>

                                                <?php

                                                if($list->state==0 && in_array($role_id, [1,6])) { ?>

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

                        <div class="row" style="margin-top: 10px;">

                            <div class="col-sm-12">

                                <div class="search col-sm-4">

                                    <button class="btn btn-success" style="border-right: none;float: left">总充值/¥</button><span class="form-control" style="border-left: none;width: 140px;float: left" ><?=$sum?></span>

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



    function change(state,id) {

        admin_tool.confirm('确定审核吗?', function () {

            $.ajax({

                type: "GET",

                url: "<?= Url::toRoute('admin-chargexx/change-state')?>",

                data: {"state": state, "id": id},

                cache: false,

                dataType: "json",

                error: function (xmlHttpRequest, textStatus, errorThrown) {

                    alert("出错了，" + textStatus);

                },

                success: function (data) {

                    if(data==800) {

                        layer.alert('没有权限', {icon: 2});

                        return false;

                    }else if(data==100) {

                        window.location.reload();

                    }

                }

            });

        })

        return
    }

    function Ckpz(img) {
        layer.open({
            type:1,
            title:false,
            area:['1000px','700px'],
            content:'<img src="'+img+'">'
        })
    }

</script>





<?php $this->endBlock(); ?>

