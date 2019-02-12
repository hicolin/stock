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
      <?php $this->beginContent('@app/views/layouts/member-left.php')?>
      <?php $this->endContent()?>
    <!-- left end --> 
    
    <!-- right -->
    <div class="fr right">
      <div class="qhbox">
        <div class=" menu0">
          <ul class="style_head">
            <li><a   href=" " class="current">推广链接</a></li>
            <li><a   href=" ">我的用户</a></li>
          </ul>
          <span class="clear_f"></span> </div>
        <div class="cn style_content style_content0">
              <div class="spread_link">
                    <p class="spread_msg">以下网址是您对外界进行推广的地址，您可以通过朋友、QQ、微信、博客、论坛或自己的网站进行推广，所有通过该地址访问过来的人，注册后就都属于您的用户，而当这些用户在本站注册时，您就可以赚取积分了</p>
                    <div class="spread_line">
                        <p id="spread_link">您的推广链接： <span id="sp_link">http://pz.cn/register/register?yqm=<?=$onelist->vatation_code?></span> </p>
                        <button id="copy_link" onclick="copy(&quot;sp_link&quot;,&quot;链接复制成功&quot;)">复制链接</button>
                    </div>
                </div>
                    <script>
                      function copy(id,msg){
                          const range = document.createRange();
                          range.selectNode(document.getElementById(id));
                          const selection = window.getSelection();
                          if(selection.rangeCount > 0) selection.removeAllRanges();
                          selection.addRange(range);
                          document.execCommand('copy');
                          layer.msg(msg,{icon:1,shift:6,skin:'layui-layer-bai',time:1000});
                      }
                   </script>
        </div>
        <span class="clear_f"></span> </div>
    </div>
      <div class="clear"></div>
    <!-- right end --> 
  </div>
</div>
