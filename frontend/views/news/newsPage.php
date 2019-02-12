
<?php
use yii\helpers\Url;

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
                        <li class="adli"><a href="<?=Url::toRoute('news/list')?>" >新闻资讯</a></li>
                    </ul>
                    <ul class="msbrcon" id="msbc1">
                        
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="常见问题" href="<?=Url::toRoute('news/wenda')?>"  >常见问题</a></li>
                            
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="股票资讯" href="<?=Url::toRoute('news/stock')?>"  >股票资讯</a></li>
                            
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="行业新闻" href="<?=Url::toRoute('news/reports')?>"  >行业资讯</a></li>
                            
                                <li style="width: 100%; overflow: hidden; text-overflow: ellipsis;"><a title="最新公告" href="<?=Url::toRoute('news/announce')?>"  >网站公告</a></li>
                            
                    </ul>
                </div>
            </div>
            <div class="msbleft" style="height: auto;">
                <div class="body" style="height: auto;">
                    <div class="clearborth"></div>
                    <h1 style="text-align: center; font-size: 26px;"><?=$new->title?></h1>
                    <div style="text-align: center; margin-top: 10px;">
                        <span>发表时间：<?=date('Y-m-d H:i:s',$new->addtime)?></span>
                    </div>
                    <div style="height: auto; line-height: 30px; padding: 15px;">
                        <?=$new->contact?>
                    </div>
                    <div class="button_more button_more3"><a href="<?=Url::toRoute('news/list')?>" >返回列表</a></div>

                    <?php if($prev){ ?>
                        <div class="button_more"><a href="<?=Url::toRoute(['news/detail','id'=>$prev->id])?>" >下一封</a></div>
                    <?php }else{?>
                        <div class="button_more"><a href="javascript:">没有了</a></div>
                    <?php }?>
                    <div class="button_more"><a href="<?=Url::toRoute(['news/detail','id'=>$next->id])?>" >上一封</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearborth"></div>

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
    


