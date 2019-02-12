<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminMember;
use common\helps\Tools;
use backend\controllers\PublicController;

$modelLabel = new \backend\models\AdminMember()
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
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-search-form', 'method' => 'get', 'options' => ['class' => 'form-inline'], 'action' => '']); ?>
                                <div class="form-group" style="margin: 5px;">
                                    <label>交易时间：</label>
                                    <input type="text" class="form-control ECalendar" id="b_time" name="query[b_time]" value="<?= $query["b_time"] ? date('Y-m-d H:i',$query["b_time"]) : "" ?>"> -
                                    <input type="text" class="form-control ECalendar" id="e_time" name="query[e_time]" value="<?= $query["e_time"] ? date('Y-m-d H:i',$query["e_time"]) : "" ?>">
                                </div>
                                <div class="form-group">
                                    <a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
                                    <a class="btn btn-primary btn-sm" href="<?= Url::toRoute([$this->context->id . '/detail','xgj_name'=>$xgj_name]) ?>"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <!--<th><input id="data_table_check" type="checkbox"></th>-->
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">交易日</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">交易合约</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">手数</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">买卖</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">实际日期</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">成交时间</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">开平</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">手续费</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">平仓盈亏</th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1"
                                            aria-sort="ascending">币种</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($model as $list) {
                                        ?>
                                        <tr id="rowid_$list->id">
                                           <!-- <td><label><input type="checkbox" value="<?/*= $list->id */?>"></label></td>-->
                                            <td><?= date('Y-m-d',$list->jy_time)?></td>
                                            <td><?= $list->contract ?></td>
                                            <td><?= $list->amount ?></td>
                                            <td><?= $list->transaction ?></td>
                                            <td><?= date('Y-m-d',$list->sj_time) ?></td>
                                            <td><?= date('H:i:s',$list->cj_time) ?></td>
                                            <td><?= $list->kaiping ?></td>
                                            <td><?= $list->charge ?></td>
                                            <td><?= $list->pc_yingkui ?></td>
                                            <td><?= $list->currency?></td>
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

    $("#b_time").ECalendar({
        type:"date",   //模式，time: 带时间选择; date: 不带时间选择;
        stamp : true,   //是否转成时间戳，默认true;
        offset:[0,2],   //弹框手动偏移量;
        format:"yyyy-mm-dd",   //格式 默认 yyyy-mm-dd hh:ii;
        skin:2,   //皮肤颜色，默认随机，可选值：0-8,或者直接标注颜色值;
        step:10,   //选择时间分钟的精确度;
        callback:function(v,e){

        } //回调函数
    });

    $("#e_time").ECalendar({
        type:"date",   //模式，time: 带时间选择; date: 不带时间选择;
        stamp : true,   //是否转成时间戳，默认true;
        offset:[0,2],   //弹框手动偏移量;
        format:"yyyy-mm-dd",   //格式 默认 yyyy-mm-dd hh:ii;
        skin:2,   //皮肤颜色，默认随机，可选值：0-8,或者直接标注颜色值;
        step:10,   //选择时间分钟的精确度;
        callback:function(v,e){

        } //回调函数
    });

</script>
<?php $this->endBlock(); ?>
