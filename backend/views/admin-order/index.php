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
                <!--<div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?/*= Url::toRoute([$this->context->id . '/create']) */?>"
                               class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                            &nbsp;&nbsp;

                        </div>
                    </div>
                </div>-->
                <!-- /.box-header -->


                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">


                                <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => Url::toRoute('admin-order/index')]); ?>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">订单ID:</span>
                                        <input type="text" class="form-control" id="query[id]"
                                               name="query[id]"
                                               value="<?= isset($query["id"]) ? $query["id"] : "" ?>">

                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">用户号码:</span>
                                        <input type="text" class="form-control" id="query[user_tel]"
                                               name="query[user_tel]"
                                               value="<?= isset($query["user_tel"]) ? $query["user_tel"] : "" ?>">

                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">股票名称:</span>
                                        <input type="text" class="form-control" id="query[goods_name]"
                                               name="query[goods_name]"
                                               value="<?= isset($query["goods_name"]) ? $query["goods_name"] : "" ?>">

                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon">认购状态:</span>
                                        <select name="query[status]" id="query[status]"
                                                style="height:34px;border: 1px solid #ccc;padding: 5px;">
                                            <option value="-2">全部</option>
                                            <?php foreach ($status as $k => $v) { ?>
                                                <option
                                                    value="<?= $k ?>" <?= isset($query['status']) && $query['status'] == $k ? 'selected' : '' ?>><?= $v ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>


                                <div class="input-group" style="margin: 5px;">
                                    <span class="input-group-addon">申请时间:</span>
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
                        <div class="row">
                            <hr/>
                            <div class="col-sm-12">
                                <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                                <a href="<?= Url::toRoute([$this->context->id . '/export', 'query' => $query]) ?>">
                                    <button style="padding: 0 20px;" class="btn btn-xs btn-info">导出数据</button>

                                </a>
                                <a href="<?= Url::toRoute(['admin-order/index','query[status]'=>2]) ?>">
                                    <div style="display: inline-block;float: right;">
                                        <button style="margin-right: 10px;" class="btn btn-success"
                                                style="border-right: none;">已结算
                                        </button>
                                    </div>
                                </a>
                                <a href="<?= Url::toRoute(['admin-order/index','query[status]'=>1]) ?>">
                                    <div style="display: inline-block;float: right;">
                                        <button style="margin-right: 10px;" class="btn btn-success"
                                                style="border-right: none;">持仓中
                                        </button>
                                    </div>
                                </a>
                                <a href="<?= Url::toRoute(['admin-order/index','query[status]'=>0]) ?>">
                                    <div style="display: inline-block;float: right;">
                                        <button style="margin-right: 10px;" class="btn btn-success"
                                                style="border-right: none;">申请中
                                        </button>
                                    </div>
                                </a>
                                <a href="<?= Url::toRoute('admin-order/index') ?>">
                                    <div style="display: inline-block;float: right;">
                                        <button style="margin-right: 10px;" class="btn btn-success"
                                                style="border-right: none;">全部
                                        </button>
                                    </div>
                                </a>
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">单号</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">姓名</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("user_tel") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">推荐人</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("goods_name") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("goods_code") ?></th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("order_my_money") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">卖出价格</th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">买入数量</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">可用数量</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">卖出数量</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("order_ly_money") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">追加保证金</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("order_charge") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">递延费</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">盈亏</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">卖出盈亏</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">委托编号</th>

                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending"><?= $modelLabel->getAttributeLabel("begin_time") ?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">结算时间</th>
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
                                        <tr id="rowid_$list->id" class="sn_<?= $list->order_sn ?>">
                                            <td><label><input type="checkbox" value="<?= $list->id ?>"></label></td>
                                            <td ><?= $list->order_sn ?></td><!--姓名-->
                                            <td><?= $list->member['realname'] ?></td><!--姓名-->
                                            <td><?= $list->user_tel ?></td><!--用户号码-->
                                            <td><?= \backend\models\AdminUser::getName($list->member['pid']?:'156') ?></td><!--推荐人-->
                                            <td><?= $list->goods_name ?></td><!--股票名称-->
                                            <td><?= $list->goods_code ?></td><!--股票代码-->
                                            <td><?= $list->order_my_money ?></td><!--买入价格-->
                                            <td><?= $list->sale_money?:'--' ?></td><!--卖出价格-->
                                            <td><?= $list->order_hander?></td><!--买入手数-->
                                            <td><?= $list->left_hander?></td><!--剩余手数-->
                                            <td><?= $list->sale_hander ?></td><!--卖出数量-->
                                            <td><?= $list->order_ly_money ?></td><!--履约保证金-->
                                            <td><?= $list->zj_bzj?:'--' ?></td><!--追加保证金-->
                                            <td><?= $list->order_charge ?></td><!--手续费-->
                                            <td><?= $list->dy?:'--' ?></td><!--递延费-->
                                            <td><?= $list->profit ?></td><!--盈亏-->
                                            <td><?= $list->mc_yk?:'--' ?></td><!--卖出盈亏-->
                                            <td><?= $list->tdx_orderNo ?></td><!--委托编号-->
                                            <td><?= date('Y-m-d H:i:s', $list->begin_time) ?></td><!--持仓开始时间-->
                                            <td><?= $list->end_time?date('Y-m-d H:i:s', $list->end_time):'尚未结算'; ?></td><!--结算时间-->
                                            <td><?=$status[$list->status]?></td><!--状态-->
                                            <td class="center">
                                                <!-- Split button -->

                                                <?php /*if($role_id==1 && $list->status<2):*/?><!--
                                                    <?php /*if($list->status==1){*/?>
                                                        <?php /*if(time()-$list->begin_time>86400):*/?>
                                                <button onclick="Handle('<?/*=$list->status*/?>','<?/*=$list->id*/?>')" class="btn btn-warning">处理策略</button>
                                                            <?php /*endif;*/?>
                                                <?php /*}else{ */?>
                                                        <button onclick="Handle('<?/*=$list->status*/?>','<?/*=$list->id*/?>')" class="btn btn-warning">处理策略</button>
                                                <?php /*}*/?>
                                                --><?php /*endif;*/?>

                                                <a id="view_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/view', 'id' => $list->id]) ?>">
                                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                                <a id="edit_btn" class="btn btn-primary btn-sm"
                                                   href="<?= Url::toRoute([$this->context->id . '/update', 'id' => $list->id]) ?>">
                                                    <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                            </td>
                                        <tr/>
                                        <?php
                                    }
                                    ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <script>
                            $(function () {
                                //给属于统一客户的订单数据加上背景色
                                var kinds = [];
                                $("#data_table tr").each(function () {
                                    var _class = $(this).attr("class");
                                    if(kinds.indexOf(_class) == -1){
                                        kinds.push(_class);
                                    }else{
                                        $(this).css("background",'rgba(236, 240, 245)');
                                    }
                                });

                            });
                        </script>

                        <!-- row end -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <div class="search ">
                                    <button class="btn btn-success" style="border-right: none;float: left">订单总数</button>
                                    <span class="form-control"
                                          style="border-left: none;width: 140px;float: left"><?= $num ?></span>
                                </div>
                                <div class="search ">
                                    <button class="btn btn-success" style="border-right: none;float: left">持仓订单</button>
                                    <span class="form-control"
                                          style="border-left: none;width: 140px;float: left"><?= $cc ?></span>
                                </div>
                                <div class="search ">
                                    <button class="btn btn-success" style="border-right: none;float: left">结算订单</button>
                                    <span class="form-control"
                                          style="border-left: none;width: 140px;float: left"><?= $js ?></span>
                                </div>
                                <div class="search ">
                                    <button class="btn btn-success" style="border-right: none;float: left">手续费</button>
                                    <span class="form-control"
                                          style="border-left: none;width: 140px;float: left"><?= $money['charge'] ?></span>
                                </div>
                                <div class="search ">
                                    <button class="btn btn-success" style="border-right: none;float: left">递延费</button>
                                    <span class="form-control"
                                          style="border-left: none;width: 140px;float: left"><?= $money['dy'] ?></span>
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
    function Handle(state,id){
        var str = '';
        if(state==1 || state==-1){
            str = '是否将该持仓卖出？';
        }else if(state==0){
            str = '是否进行买入？';
        }
        layer.confirm(str,{
            btn:['确定','取消']
        },function (){
            layer.closeAll('dialog');
            layer.load(2);
            $.post('<?=Url::toRoute($this->context->id."/handle")?>',
                {state:state,id:id,_csrf:'<?=Yii::$app->request->csrfToken?>'},
                function(data){
                    layer.closeAll('loading');
                    if(data.state){
                        layer.msg(data.msg,{time:1000,icon:1},function(){
                            window.location.reload();
                        })
                    }
                },'json')
        })


    }
</script>
<?php $this->endBlock(); ?>
