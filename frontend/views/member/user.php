<?php
use yii\helpers\Url;
?>
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/main(1).css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/details.css">
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
            <div class="usein1">
                <ul>
<!--                    <li><span class="span1"><b>*</b>昵称：</span> <span class="span2">--><?//=$member->nickname?><!--</span></li>-->
                    <li><span class="span1"><b>*</b>真实姓名：</span> <span class="span2"><?=$uname?></span></li>
                    <li><span class="span1"><b>*</b>身份证：</span> <span class="span2"><?=$member->cartid?></span></li>

                    <li style="display:none"><span class="span1"><b>*</b>手机号码：</span> 
                        <span class="span2"><?=$member->tel?></span> <span class="span3"></span></li>

                    <li><span class="span1"><b>*</b>邮箱地址：</span> <span class="span2"> <?=$member->email?></span></li>
                    <li><span class="span1"><b>*</b>性别：</span> <span class="span2">
                       <?php if($member->sex==0){ ?>
                                男
                        <?php } elseif ($member->sex==1) { ?>
                                女
                        <?php } ?>

                     </span></li>
                    <li><span class="span1"><b>*</b>最高学历：</span> <span class="span2">
                        <?php if($member->edu==0){ ?>
                            本科
                        <?php } ?>
                        <?php if($member->edu==1){ ?>
                            专科
                        <?php }elseif ($member->edu==2) { ?>
                            研究生
                        <?php }elseif ($member->edu==3) { ?>
                            硕士
                        <?php }elseif ($member->edu==4) { ?>
                            博士
                        <?php }elseif ($member->edu==5) { ?>
                            博士后
                        <?php }elseif ($member->edu==6) { ?>
                           其他
                        <?php } ?>
                     </span>

                     </li>
                    <li><span class="span1"><b>*</b>婚姻状况：</span> <span class="span2">
                            <?php /*if($member->marry==0){echo "未婚";}else {echo "已婚";}*/?>
                            <?= $member->marry==0?"已婚":"未婚"?>


                     </span></li>
<!--                    <li><span class="span1"><b>*</b>居住地址：</span> <span class="span2">-->
<!--                        -->
<!--                        --><?//=$province?>
<!--                        --><?//=$city?>
<!--                      --><?//=$member->address?>
<!--                          -->
<!--                      </span></li>-->
                </ul>
                <input type="button" value=" 修改信息" class="xgxi btn1"> 
            </div>

        </div>
        <div class="clear"></div>
        <!-- right end -->
    </div>
</div>
<script>
    $('.xgxi').click(function(){
        window.location.href="<?=Url::toRoute(['member/modify-user'])?>"
    })
</script>
