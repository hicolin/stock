<?php
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\AdminSlides;
$modelLabel=new \backend\models\AdminSlides()
?>
<?php  $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php  $this->endBlock(); ?>
<?php if(Yii::$app->session->hasFlash('error')):?>
    <script>
        layer.msg("<?=Yii::$app->session->getFlash('error')?>",{icon:0,time:1000})
    </script>
<?php endif?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?=Url::toRoute('admin-slides/create')?>" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                            &nbsp;&nbsp;
                            <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <!-- row start search-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php ActiveForm::begin(['id' => 'admin-module-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>'']); ?>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon" id="basic-addon1">编号:</span>
                                        <input type="text" class="form-control" id="query[slide_id]" name="query[slide_id]"  value="<?=isset($query["slide_id"]) ? $query["slide_id"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon" id="basic-addon1">分类ID:</span>
                                        <input type="text" class="form-control" id="query[slide_cid]" name="query[slide_cid]"  value="<?=isset($query["slide_cid"]) ? $query["slide_cid"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 mar-10">
                                    <div class="input-group" style="margin: 5px;">
                                        <span class="input-group-addon" id="basic-addon1">标题:</span>
                                        <input type="text" class="form-control" id="query[slide_name]" name="query[slide_name]"  value="<?=isset($query["slide_name"]) ? $query["slide_name"] : "" ?>">
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top: 7px">
                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="glyphicon glyphicon-zoom-in icon-white"></i>搜索
                                    </button>

                                    <a class="btn btn-primary btn-sm"
                                       href="<?= Url::toRoute([$this->context->id . '/' . Yii::$app->controller->action->id]) ?>">
                                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>清空</a>
                                </div>
                                <?php  ActiveForm::end(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                    <thead>
                                    <tr role="row">
                                        <th><input id="data_table_check" type="checkbox"></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("slide_id")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("slide_cid")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("slide_name")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("slide_des")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("slide_url")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("slide_status")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("listorder")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("slide_pic")?></th>
                                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       foreach ($model as $list) {
                                       echo '<tr id="rowid_'.$list->slide_id.'">';
                                       echo '<td><label><input type="checkbox" value="'.$list->slide_id.'"></label></td>';
                                       echo '<td>'.$list->slide_id.'</td>';
                                       echo '<td>'.$list->slide_cid.'</td>';
                                       echo '<td>'.$list->slide_name.'</td>';
                                       echo '<td>'.$list->slide_des.'</td>';
                                       echo '<td>'.$list->slide_url.'</td>';
                                       echo '<td>'.AdminSlides::dropDownList('is_show',$list->slide_status).'</td>';
                                       echo '<td>'.$list->listorder.'</td>';
                                           if($list->slide_pic!=null){
                                               ?>
                                               <td class="center">
                                                   <a href="javascript:;" onclick="lookimg('<?=$list->slide_pic?>')" class="btn btn-warning">查看</a>
                                               </td>
                                               <?php
                                           }else{
                                               ?>
                                               <td class="center">

                                               </td>
                                               <?php
                                           }
                                       echo '<td class="center">';
                                       echo '<a id="view_btn" class="btn btn-primary btn-sm" href="'.Url::toRoute(['admin-slides/view','id'=>$list->slide_id]).'"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>  ';
                                       echo ' <a id="edit_btn" class="btn btn-primary btn-sm" href="'.Url::toRoute(['admin-slides/update','id'=>$list->slide_id]).'"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>  ';
                                       echo '  <a id="delete_btn" onclick="deleteAction('.$list->slide_id.')" class="btn btn-danger btn-sm" href="javascript:;"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                                       echo '</td>';
                                       echo '<tr/>';
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
                                        从<?=  $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?=  ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?=  $pages->totalCount?> 条记录</div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate" style="text-align: right;padding-right: 50px;">
                                    <?=  LinkPager::widget([
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

<?php $this->beginBlock('footer');  ?>
<script>
    function searchAction(){
        $('#admin-module-search-form').submit();
    }

    function initModel(id, type, fun){
        $.ajax({
            type: "GET",
            url: "<?= Url::toRoute('admin-slides/view')?>",
            data: {"id":id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function(data){
                initEditSystemModule(data, type);
            }
        });
    }
    function editAction(id){
        initModel(id, 'edit');
    }

    function deleteAction(id){
        var ids = [];
        if(!!id == true){
            ids[0] = id;
        }
        else{
            var checkboxs = $('#data_table tbody :checked');
            if(checkboxs.size() > 0){
                var c = 0;
                for(i = 0; i < checkboxs.size(); i++){
                    var id = checkboxs.eq(i).val();
                    if(id != ""){
                        ids[c++] = id;
                    }
                }
            }
        }
        if(ids.length > 0){
            admin_tool.confirm('请确认是否删除', function(){
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute('admin-slides/delrecord')?>",
                    data: {"ids":ids},
                    cache: false,
                    dataType:"json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        if(xmlHttpRequest.responseText=='prohibit'){
                            alert( '抱歉,您没有权限操作');
                        }else{
                            alert("出错了，" + textStatus);
                        }
                    },
                    success: function(data){
                        if(data=='prohibit'){
                            admin_tool.alert('msg_info', '抱歉,您没有权限操作', 'error');
                            return false;
                        }
                        for(i = 0; i < ids.length; i++){
                            $('#rowid_' + ids[i]).remove();
                        }
                        admin_tool.alert('msg_info', '删除成功', 'success');
                        window.location.reload();
                    }
                });
            });
        }
        else{
            admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
        }

    }

    function getSelectedIdValues(formId)
    {
        var value="";
        $( formId + " :checked").each(function(i)
        {
            if(!this.checked)
            {
                return true;
            }
            value += this.value;
            if(i != $("input[name='id']").size()-1)
            {
                value += ",";
            }
        });
        return value;
    }

    $('#edit_dialog_ok').click(function (e) {
        e.preventDefault();
        $('#admin-module-form').submit();
    });


    $('#delete_btn').click(function (e) {
        e.preventDefault();
        deleteAction('');
    });

</script>
<script>
    function lookimg(str)
    {
        var newwin=window.open();
        newwin.document.write("<img src="+str+" />")
    }
</script>
<?php $this->endBlock(); ?>

