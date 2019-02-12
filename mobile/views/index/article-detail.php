<?php
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--main-->
<div class="help_center_detail_main">
<!--    <p>本网站的宗旨是在不违反中华人民共和国法律法规的前提下，尽可能地为中国广大投资者提供专业的国际化水准的交易平台和金融产品。 禁止使用本网站从事洗钱、走私、商业贿赂等一切非法交易活动，若发现此类事件，本站将冻结账户，立即报送公安机关。-->
<!--    </p>-->
    <p><?= htmlspecialchars_decode($article['contact'])?></p>
</div>
<!--main end-->