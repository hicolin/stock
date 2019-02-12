
<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20180102.css"  rel="stylesheet" />
<link href="<?= Url::base() ?>/frontend/web/xnn/css/layout.css-v=20171204.css"  rel="stylesheet" />
<link href="<?= Url::base() ?>/frontend/web/xnn/css/pagestyle.css-v=20171204.css"  rel="stylesheet" />
<link href="<?= Url::base() ?>/frontend/web/xnn/css/personal.css-v=20171204.css"  rel="stylesheet" />
<link href="<?= Url::base() ?>/frontend/web/xnn/css/lrtk.css-v=20171204.css"  rel="stylesheet" />
<link href="<?= Url::base() ?>/frontend/web/xnn/css/index.css-v=20171204.css"  rel="stylesheet" />
<link href="<?= Url::base() ?>/frontend/web/xnn/css/chaogu.css-v=20171204.css"  rel="stylesheet" />
    <div class="clearborth"></div>
    
    <div class="w1000">
        <!------新闻资讯------->
        <div class="mainsonb" style="height: auto;">
            <div class="msbright">
                <div class="msbrightt">
                    <ul class="msbrtop">
                        <li class="adli cur"><a href="<?=Url::toRoute('news/list')?>" >新闻资讯</a></li>
                    </ul>
                    <ul class="msbrcon" id="msbc1">
                        
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="常见问题" href="<?=Url::toRoute('news/wenda')?>"  >常见问题</a></li>
                            
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="股票资讯" href="<?=Url::toRoute('news/stock')?>"  >股票资讯</a></li>
                            
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="行业新闻" href="<?=Url::toRoute('news/reports')?>"  >行业资讯</a></li>
                            
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="最新公告" href="<?=Url::toRoute('news/announce')?>"  class="cur">网站公告</a></li>
                            
                    </ul>
                </div>
            </div>
            <div class="msbleft" style="height: auto;">
                <div class="body" style="height: auto;">
                    <?php foreach($announce as $k=>$v){ ?>
                    <div class="clearborth"></div>
                    <a style="float: left;color: #666;padding: 0 5px 0 10px;max-width: 500px;display: block;line-height: 25px;" href="<?=Url::toRoute(['news/detail','id'=>$v['id']])?>"><?=$v['title']?></a>
                    <div style="float: right;font-size: 14px;color: #777;line-height: 25px;"><span>[<?=date('Y-m-d H:i:s',$v['addtime'])?>]</span></div>
                    <?php }?>
                </div>
                   

            </div>
            <div class="page">
                    <?= LinkPager::widget([
                        'pagination' => $pages,
                        
                    ]); ?>
            </div>
            <style type="text/css">
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

        </div>
    </div>

    <div class="clearborth"></div>
    <!--foot-kefu-->
    <div class="foot-kefu" style="display: none;">
        <div class="main f-clear">
            <div class="fl foot-kefu-tit">
                <strong>客服中心</strong>
                <p>service</p>
            </div>
            
        </div>
    </div>
    <!-- foot -->

    <script src="<?= Url::base() ?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js" ></script>
    <script src="<?= Url::base() ?>/frontend/web/xnn/scripts/layout.js" ></script>
    


