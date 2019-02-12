<?php
use yii\helpers\Url;

?>
<link href="<?=Url::base()?>/frontend/web/zqcss/account.css" rel="stylesheet" type="text/css">
<link href="<?=Url::base()?>/frontend/web/zqcss/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/withdrawal.css">
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/frontend/web/zqcss/main(1).css">
<div class="wal">
    <div class="con">
        <!-- left -->
        <?php $this->beginContent('@app/views/layouts/member-left.php') ?>
        <?php $this->endContent() ?>
        <!-- left end -->

        <!-- right -->
        <div class="fr right">
            <div class="qhbox">
                <div class=" menu0">
                    <ul class="style_head">
                        <li><a id="nav1" onclick="tabNo('nav',1,4)" href="?cur=1" class="current">中期配资</a></li>
<!--                        <li><a id="nav4" onclick="tabNo('nav',4,4)" href="?cur=4">追加保证金</a></li>-->
                    </ul>
                    <script>setTimeout('tabNo("nav",1,4)', 1);</script>
                    <span class="clear_f"></span>
                </div>
                <div class="cn style_content style_content0">
                    <div style="display:block;" class="ul">

                        <table cellpadding="0" cellspacing="0" class="tab" id="ajaxGetWithfundingList1">

                            <tbody>
                            <tr>
                                <th>总操盘资金</th>
                                <th>亏损警戒线</th>
                                <th>亏损平仓线</th>
                                <th>手续费</th>
                                <th>配资时间</th>
                                <th>到期时间</th>
                                <th>状态</th>
                                <th class="th1">操作</th>
                            </tr>


                            </tbody>
                        </table>

                        <div id="noNews" style="margin:0px auto; width:100px">暂无数据......</div>
<!--                        <div class="pageDiv">-->
<!--                            <div class="page" style="padding-left:20px;">-->
<!--                                <span>1/0页</span> <a href="?cur=1&amp;page=1" class="pagePre"> 上一页 </a><a-->
<!--                                    href="?cur=1&amp;page=2" class="pageNext"> 下一页 </a></div>-->
<!--                            <span class="clear_f"></span>-->
<!--                        </div>-->


                    </div>


                </div>
                <span class="clear_f"></span>
            </div>
        </div>
        <div class="clear"></div>
        <!-- right end -->
    </div>
</div>
