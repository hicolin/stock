<?php
use yii\helpers\Url;
?>
<!--banner-->
<div class="index_banner" id="index_banner">
    <div class="bd">
        <ul>
            <?php foreach ($banners as $list):?>
            <li>
                <a href="javascript:;" target="_blank">
                    <img src="<?= Url::base().$list['val']?>" style="height: 2rem"/>
                </a>
            </li>
            <?php endforeach;?>
    </div>
    <div class="hd">
        <ul></ul>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        TouchSlide({
            slideCell: "#index_banner",
            titCell: ".hd ul",
            mainCell: ".bd ul",
            effect: "leftLoop",
            autoPage: true,
            autoPlay: true
        });
    });
</script>
<!--banner end-->

<!--main1-->
<div class="index_main1">
    <!--头条公告-->
    <div class="index_main1_top">
        <img src="<?= Url::base()?>/mobile/web/images/toutiao.png"  class="imt_img fl"/>
        <div class="imt_text_list fl" id="imt_text_list">
            <ul>
                <?php foreach ($announces as $list) : ?>
                <li>
                    <p style="height: .36rem;line-height: .36rem">
                        <a href="<?= Url::to(['index/article-detail','id' => $list['id'],'type' => 2])?>"><?= $list['title']?></a>
                    </p>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="clear"></div>
        <script type="text/javascript">
            function AutoScroll(obj) {
                $(obj).find("ul:first").animate({
                    marginTop: "-36px"
                }, 500, function () {
                    $(this).css({
                        marginTop: "0px"
                    }).find("li:first").appendTo(this);
                });
            }
            $(document).ready(function () {
                setInterval('AutoScroll("#imt_text_list")', 3000);
            });
        </script>
    </div>
</div>
<!--main1 end-->

<!--index_main2-->
<div class="index_main2">
    <div class="index_main2_top">
        <ul>
            <li>
                <a href="<?= Url::to(['quote/self-select'])?>">
                    <img src="<?= Url::base()?>/mobile/web/images/inm1_icon1.png"/>
                    <p>我的自选</p>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['index/news'])?>">
                    <img src="<?= Url::base()?>/mobile/web/images/inm1_icon2.png"/>
                    <p>新闻资讯</p>
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['index/help-center'])?>">
                    <img src="<?= Url::base()?>/mobile/web/images/inm1_icon3.png"/>
                    <p>帮助文档</p>
                </a>
            </li>
            <div class="clear"></div>
        </ul>
    </div>

    <div class="index_main2_bot">
        <div class="myChooseNav_list fl">
            <ul>
                <li>
                    <h1 class="green"><?= number_format($info[0]['new_price'], 2) ?></h1>
                    <p>上证<span class="green"><?= $info[0]['frice_fluctuation'] ?>%</span></p>
                </li>
                <li>
                    <h1 class="red"><?= number_format($info[1]['new_price'], 2)?></h1>
                    <p>深成<span class="red"><?= $info[1]['frice_fluctuation'] ?>%</span></p>
                </li>
                <li>
                    <h1 class="green"><?= number_format($info[2]['new_price'], 2)?></h1>
                    <p>沪深(300)<span class="green"><?= $info[2]['frice_fluctuation'] ?>%</span></p>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="myChooseNav_news fl tc">
            <a href="<?= Url::to(['index/quote', 'cate_id' => 38]) ?>">
                <i class="dmfont dm-gengduo"></i>
                <p>更多</p>
            </a>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="h5"></div>
<!--index_main2 end-->

<!--index_main3-->
<div class="index_main3">
    <h1><span></span>股票交易</h1>
    <div class="index_main3_con" id="scrollDiv2">
        <ul>
            <?php foreach ($transactions as $list) : ?>
            <li>
                <img src="<?= $list['member']['head_img'] ?  Url::base().$list['member']['head_img'] : Url::base()?>/mobile/web/images/inTx.png"/>
                <span><?= $list['user_tel']?>申购<?= $list['goods_name']?><i><?= $list['order_hander']?> 股</i></span>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<div class="h5"></div>
<script type="text/javascript">
    function AutoScroll(obj) {
        $(obj).find("ul:first").animate({
                marginTop: "-0.5rem"
            },
            500,
            function() {
                $(this).css({
                    marginTop: "0"
                }).find("li:first").appendTo(this);
            });
    }
    $(document).ready(function() {
        setInterval('AutoScroll("#scrollDiv2")', 4000);
    });
</script>
<!--index_main3 end-->


<!--index_main4-->
<div class="index_main4">
    <h1>
        <span></span>新闻资讯
        <a href="<?= Url::to(['index/news'])?>"><i class="dmfont dm-arrow-right fr"></i></a>
    </h1>
    <div class="index_main4_con">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ($news as $list) : ?>
                <div class="swiper-slide" style="width: 35%">
                    <div class="ss_news">
                        <a href="<?= Url::to(['index/article-detail', 'id' => $list['id'], 'type' => 2])?>">
                            <div class="ss_news_img">
                                <img src="<?= Url::base().$list['img']?>" style="height: 1.2rem;">
                            </div>
                            <div class="ss_news_text">
                                <h2><?= $list['title']?></h2>
                                <p class="tr"><?= date('Y-m-d',$list['addtime'])?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <!-- Add Pagination -->
            <!--<div class="swiper-pagination"></div>-->
        </div>
    </div>
</div>

<?php $this->beginContent('@app/views/layouts/footer.php');?>
<?php $this->endContent();?>

<script src="<?= Url::base()?>/mobile/web/js/swiper.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 2.6,
        spaceBetween: 15,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
<!--index_main4 end-->
