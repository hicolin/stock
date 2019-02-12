<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$modelLabel=new \backend\models\AdminSort();
?>
<?php  $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php  $this->endBlock(); ?>
<style>
    table tr{
        border: 1px solid #DDDDDD;
    }
    table tr td{
        border: 1px solid #DDDDDD;
    }
</style>
<script src="<?=Url::base()?>/backend/web/js/utils.js"></script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a id="create_btn" href="<?=Url::toRoute([$this->context->id.'/create'])?>" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</a>
                            &nbsp;&nbsp;

                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <!-- /.box-header -->

                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                        <div class="col-sm-12">
                            <table id="data_table" class="table" >

                                <tr role="row">
                                <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("name")?>
                                    <a href="javascript:;" style="font-size: 12px;color: #666;" onclick="expandAll(this)">[全部展开]</a>
                                </th>
                                <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("level")?></th>
                                <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><?=$modelLabel->getAttributeLabel("addtime")?></th>
                                    <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                                </tr>
                                <?php foreach($model2 as $list):?>
                                    <tr <?=($list['level']!=1) ? 'style="display:none;"' : '';?>  id="<?=$list['level']-1?>_<?=$list['id']?>" class="<?=$list['level']-1?>">
                                        <td style="padding-left: 10px;">
                                            <?=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$list['level']-1)?>
                                            <img id="icon_<?=$list['level']-1?>_<?=$list['id']?>" src="<?=Url::base()?>/backend/web/images/menu_plus.gif" onclick="rowClicked(this)">
                                            <span <!--onclick="searchAction('<?=$list['id']?>')"--> ><?=$list['name']?></span>
                                        </td>
                                      <!--  <td><?/*=$list['id']*/?></td>-->
                                      <!--  <td><?/*=$list['pid']*/?></td>-->
                                        <td><?=$list['level']?></td>
                                        <td><?=date('Y-m-d : H:i',$list['addtime'])?></td>
                                        <td class="center">
                                            <a id="view_btn"  class="btn btn-primary btn-sm" href="<?=Url::toRoute([$this->context->id.'/create','id'=>$list['id']])?>"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>添加子分类</a>
                                            <a id="edit_btn"  class="btn btn-primary btn-sm" href="<?=Url::toRoute([$this->context->id.'/update','id'=>$list['id']])?>"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>
                                            <a id="delete_btn" onclick="deleteAction('<?=$list['id']?>','<?=$list['level']-1?>')"  class="btn btn-danger btn-sm" href="javascript:;"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                                        </td>
                                    </tr>

                                <?php endforeach;?>
                            </table>
                            <div style="display: none;">
                                <?php ActiveForm::begin(['id' => 'admin-module-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('admin-content/index')]); ?>
                                <div class="form-group" style="margin: 5px;">
                                    <input type="text" id="query" name="query[category_id]" value="">
                                </div>
                                <?php ActiveForm::end(); ?>
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

    function searchAction(cat){
        $('#query').val(cat);
        $('#admin-module-search-form').submit();
    }
    function deleteAction(id,lev){
                if(confirm('您确定删除该分类吗?')==true){
                    $.ajax({
                        type: "GET",
                        url: "<?=Url::toRoute($this->context->id.'/delrecord')?>",
                        data: {"id":id},
                        cache: false,
                        dataType:"json",
                        error: function (xmlHttpRequest, textStatus, errorThrown) {
                            alert("出错了，" + textStatus);
                        },
                        success: function(data){
                            if(data.status==1){
                                $('#'+lev+'_' + id).remove();
                            }else if(data.status==0){
                                alert(data.msg);
                            }

                        }
                    });
                }
    }

    var imgPlus = new Image();
    imgPlus.src = "<?=Url::base()?>/backend/web/images/menu_plus.gif";
    /**
     * 折叠分类列表
     */
    function rowClicked(obj)
    {
        // 当前图像
        img = obj;
        // 取得上二级tr>td>img对象
        obj = obj.parentNode.parentNode;
        // 整个分类列表表格
        var tbl = document.getElementById("data_table");

        // 当前分类级别
        var lvl = parseInt(obj.className);

        // 是否找到元素
        var fnd = false;
        var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : (Browser.isIE) ? 'block' : 'table-row' ;


        // 遍历所有的分类
        for (i = 0; i < tbl.rows.length; i++)
        {
            var row = tbl.rows[i];
            if (row == obj)
            {
                // 找到当前行
                fnd = true;
                //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
            }
            else
            {
                if (fnd == true)
                {

                    var cur = parseInt(row.className);
                    var icon = 'icon_' + row.id;
                    if (cur > lvl)
                    {
                        row.style.display = sub_display;
                        if (sub_display != 'none')
                        {
                            var iconimg = document.getElementById(icon);
                            iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                        }
                    }
                    else
                    {
                        fnd = false;
                        break;
                    }
                }
            }
        }

        for (i = 0; i < obj.cells[0].childNodes.length; i++)
        {
            var imgObj = obj.cells[0].childNodes[i];
            if (imgObj.tagName == "IMG" && imgObj.src != '<?=Url::base()?>/backend/web/images/menu_arrow.gif')
            {
                imgObj.src = (imgObj.src == imgPlus.src) ? '<?=Url::base()?>/backend/web/images/menu_minus.gif' : imgPlus.src;
            }
        }
    }
    /**
     * 展开或折叠所有分类
     * 直接调用了rowClicked()函数，由于其函数内每次都会扫描整张表所以效率会比较低，数据量大会出现卡顿现象
     */
    var expand = false;
    function expandAll(obj)
    {
        var selecter;

        if(expand)
        {
            // 收缩
            selecter = "img[src*='menu_minus.gif'],img[src*='menu_plus.gif']";
            $(obj).html("[全部展开]");
            $(selecter).parents("tr[class!='0']").hide();
            $(selecter).attr("src", "<?=Url::base()?>/backend/web/images/menu_plus.gif");
        }
        else
        {
            // 展开
            selecter = "img[src*='menu_plus.gif'],img[src*='menu_minus.gif']";
            $(obj).html("[全部收缩]");
            $(selecter).parents("tr").show();
            $(selecter).attr("src", "<?=Url::base()?>/backend/web/images/menu_minus.gif");
        }

        // 标识展开/收缩状态
        expand = !expand;
    }
</script>
<?php $this->endBlock(); ?>
