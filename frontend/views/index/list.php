<?php
use \common\helps\Tools;//使用工具类
use yii\helpers\Url;
?>
    <style>
        .title-content span {
            width: 25%;
            line-height: 3em;
            font-size: 1em;
            color: #666666;
            text-align: center;
        }
        .page {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            height: 32px;
        }
        .page li a {
            text-align: center;
            border: 1px solid #ddd;
            /* padding: 4px 10px; */
            color: #999;
            display: block;
        }
        .page ul {
            margin-right: 89px;
            float: right;
        }
        .page .pagination .active a{
            background-color: #64b2c9;
            color: #fff;
        }
    </style>
<?php foreach($data as $k=>$v){ ?>


        <li >
        <h4 class="title-content" id="code_<?=$v['code'] ?>" >
            <div  style="display: inline-block;width: 84%;float: left">
            <a href="<?=Url::toRoute(['user/stock','id'=>$v['id']])?>">
            <span class="fl"><?=$v['code'] ?></span>
            <span class="fl color-orange"><?=$v['name'] ?></span>
            <span class="fl new_price"><img src="http://m.eiaihe.cn/skin/images/load1.gif"/> </span>
            <span class="fl change"><i><img src="http://m.eiaihe.cn/skin/images/load1.gif"/> </i></span>
            </a>
            </div>

            <span class="" style="width: 16%">
                    <h5 class="choose-btn">
                    <span style="color: red"><a class=""  href="<?=Url::toRoute(['user/stock','id'=>$v['id']])?>"></i>申请</a>  </span>
                    <!-- <span class=" trade_add " onclick="trade_add(this)" itemid="<?=$v['id'] ?>"><i class="iconfont icon-buoumaotubiao11"></i>加入自选</span> -->
                    <!-- <span style="display: none;" class=" trade_delete " onclick="trade_delete(this)" itemid="<?=$v['id'] ?>"><i class="iconfont icon-105"></i>删除自选</span> -->
                    </h5>
            </span>
            <div class="clear"></div>
        </h4>
         </li>



        <?php } ?>