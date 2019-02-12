<?php
use yii\helpers\Url;
?>
<!--距离底部距离为了底部菜单栏-->
<div class="paddingBottom65"></div>

<!--foot-->
<div class="foot">
    <ul>
        <li>
            <a href="<?= Url::to(['index/index'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/foot_icon/foot1_1.png"/>
                <p>首页</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['index/quote'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/foot_icon/foot2_1.png"/>
                <p>大厅</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['index/transaction'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/foot_icon/foot3_1.png"/>
                <p>交易</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['index/user'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/foot_icon/foot4_1.png"/>
                <p>我的</p>
            </a>
        </li>
    </ul>
</div>
<!--foot end-->

<!--active-->
<script>
    var relUrl = getUrlRelativePath();
    if (relUrl == '/quote/self-select') {
        relUrl = '/quote/index';
    }
    var olis =  $('.foot li a');
    olis.each(function (index,item) {
        var href = $(this).attr('href');
        if(href == relUrl){
            var src = $(this).find('img').attr('src');
            src = src.substring(0,src.length - 5);
            src = src + '2.png';
           $(this).find('img').attr('src',src);
        }
    });

    /**
     * 获取当前相对路径
     * @returns {string}
     */
    function getUrlRelativePath()
    {
        var url = document.location.toString();
        var arrUrl = url.split("//");
        var start = arrUrl[1].indexOf("/");
        var relUrl = arrUrl[1].substring(start);//stop省略，截取从start开始到结尾的所有字符
        if(relUrl.indexOf("?") != -1){
            relUrl = relUrl.split("?")[0];
        }
        return relUrl;
    }
</script>