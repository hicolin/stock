<?php
use yii\helpers\Url;
?>
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/details.css">
<script src="<?= Url::base() ?>/backend/web/js/ajaxfileupload.js"></script>
<div class="wal">
    <div class="con">
        <!-- left -->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!-- left end -->

        <!-- right -->
        <div class="fr right">
            <div class="title">
                <div class="tit">个人基础信息</div>
            </div>
            <div class="usein2">
                <div class="con">
            <form action="" onsubmit="return login_form();" method="post">
                        <ul>
                <li><span class="span1">昵称：</span><span class="span2">

                <input class="text" name="nickname" id="nickname" type="text">
                </span>
                </li>

                <li><span class="span1">头像：</span><span class="span2">
                <img  id="add_photo1" src="<?= $member->head_img?>" class="img pic" type="pic" width="45" height="45"?>
                <input type="hidden" name="pic" id="pic">
                <input type="file" onChange="ajaxFileUpload()" id="hiddenFile" name="file" style="display: none;">
                        <input type="hidden" id="img9"   class="fluid_photo1"name="img9"  value = "<?= $member->head_img?>">
                </span>
                </li>

                <li><span class="span1"><b>*</b>性别：</span> <span class="span2">
                <input type="radio" value="0" <?php if($member->sex==0) echo "checked"?> name="sex" id="sex1">
                <label for="sex1"> 男</label>
                <input type="radio" value="1" name="sex"   <?php if($member->sex==1) echo "checked"?> id="sex2">
                <label for="sex2"> 女</label>
                </span></li>
                <li><span class="span1"><b>*</b>最高学历：</span><span class="span2">
                <select id="education1" name="edu" title="">
                    <?=$member->edu?>
                    <option value="0" <?=$member->edu==0?'selected':''?>>本科</option>
                    <option value="1" <?=$member->edu==1?'selected':''?>>大专</option>
                    <option value="2" <?=$member->edu==2?'selected':''?>>研究生</option>
                    <option value="3" <?=$member->edu==3?'selected':''?>>硕士</option>
                    <option value="4" <?=$member->edu==4?'selected':''?>>博士</option>
                    <option value="5" <?=$member->edu==5?'selected':''?>>博士后</option>
                    <option value="6" <?=$member->edu==6?'selected':''?>>其他</option>
                </select>
                </span></li>
                <li>
                <span class="span1"><b>*</b>所在省：</span>
                <span class="span2">
                <select id="c1" name="c1"  title="">
                     <option value="0" >请选择省份</option>
                     <?php foreach($province as $list){?>
                       <option value="<?=$list->id?>" <?=$member->province==$list->id?'selected':''?>><?=$list->name?></option>                                 
                   <?php }?>
                </select>

                </span>
             </li>
                     <li><span class="span1"><b>*</b>所在市：</span><span class="span2">
                <select id="c2" name="c2" title="请选择一个选项~!">
        
                    
                </select>
                </span></li>
                            <li><span class="span1"><b>*</b>婚姻状况：</span><span class="span2">
                <input type="radio" value="0" name="marry" id="marry1" <?php if($member->marry==0) echo "checked"?>>
                <label for="marry1"> 已婚</label>
                <input type="radio"  value="1" name="marry" id="marry2" <?php if($member->marry==1) echo "checked"?>>
                <label for="marry2"> 未婚</label>
                </span></li>
                <?php  if(!isset($member->email)&&empty($member->email)){ ?>
                    <li><span class="span1"><b>*</b>邮箱：</span><span class="span2">
                    <input name="email" value="" class="text" type="text" id="email" title="">
                    </span></li> 
                <?php }  ?>

                        <li><span class="span1"><b>*</b>居住地：</span>

                            <span class="span2">
                <input name="address" id="address" value="" class="text" type="text" title="">
                </span></li>
                            <input type="submit" value="确定" class="btn1">
                            <input type="button" class="btn2 qxxg" value="取消">
                        </ul>
            </form>

                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!-- right end -->
    </div>
</div>

<script type="text/javascript">
    function login_form() {
        var nickname = $("#nickname").val();
        var education1 = $("#education1").val();
        var c1 = $("#c1").val();
        var c2 = $("#c2").val();
        var email = $("#email").val();
        var address = $("#address").val();
        if (nickname == "") {
            layer.tips('请正确填写昵称~2-16:!', $("#nickname"), {tips: 2, time: 2000});
            return false;
        }

        else if (education1 == "") {
            layer.tips('请选择一个选项~!', $("#education1"), {tips: 2, time: 2000});
            return false;
        }

        else if (c1 == "") {
            layer.tips('请选择一个选项~!', $("#c1"), {tips: 2, time: 2000});
            return false;
        }

        else if (c2 == "") {
            layer.tips('请选择一个选项~!', $("#c2"), {tips: 2, time: 2000});
            return false;
        }

        else if (email == "") {
            layer.tips('请正确填写邮箱~2-36!', $("#email"), {tips: 2, time: 2000});
            return false;
        }

        else if (address == "") {
            layer.tips('请正确填写居住地~2-36!', $("#address"), {tips: 2, time: 2000});
            return false;
        }

        else {
            return true;
        }
    }

    var type = '';
    $(".img").click(function(){
        type = $(this).attr('type');
        $("#hiddenFile").click();
    });
    $('.change_img').click(function(){
        type = $(this).attr('type');
        $('#hiddenFile').click();
    });
    function ajaxFileUpload() {
        $.ajaxFileUpload
        (
            {
                url: "<?=Url::toRoute(['public/file'])?>", //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: 'hiddenFile', //文件上传域的ID
                dataType: 'JSON', //返回值类型 一般设置为json
                success: function (data)  //服务器成功响应处理函数
                {
                    var obj = jQuery.parseJSON(data);

                    if (obj.status == 200) {
                        $("#add_photo1").attr('src',"/" + obj.path);

                        $("#img9").val("/" +obj.path);
                        $("#hiddenFile").attr('value',"/" +obj.path);
                    }
                }
            }
        );
        return false;
    }
</script>
<script>
    $(function(){
        $('#c1').change(function(){
            var province = $(this).val();

            $.ajax({
                type:"post",
                data:{'id':province},
                url:"<?=Url::toRoute('member/get-city')?>",
                success:function(msg){
                     $('#c2').html(msg);


                }
            })
        });


    })

</script>