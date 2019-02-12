<?php
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');?>
    <link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/user.css">
    <style>
        .logout{text-align: center}
        .logout a{display: inline-block;width: 80%;height: 0.4rem;line-height: .4rem; background: #393D49;border: none;
            border-radius: 5px; font-size: 0.15rem; color: #ffffff;margin-top: 0.1rem;
        }
    </style>
<?php $this->endBlock();?>

<?php $this->beginContent('@app/views/layouts/header.php');?>
<?php $this->endContent()?>

<!--main1-->
<div class="user_top">
    <div class="user_top_con">
        <div class="utc_main">
            <div class="utc_main_head">
                <?php if (Yii::$app->session['isLogin']) :?>
                    <img src="<?= $member['head_img'] ? Url::base().$member['head_img'] : Url::base()?>/mobile/web/images/tx.png" class="default_tx"/>
                    <span><?= substr_replace($member['usersname'],'****',3,4)?></span>
                <?php else : ?>
                    <img src="<?= Url::base()?>/mobile/web/images/tx.png" class="default_tx"/>
                    <a href="<?= Url::to(['index/login'])?>">登录</a>
                    <span>/</span>
                    <a href="<?= Url::to(['index/register'])?>">注册</a>
                <?php endif; ?>
            </div>
            <div class="utc_main_con">
                <?php if (Yii::$app->session['isLogin']) :?>
                    <h1><b><?= $member['money']?></b></h1>
                <?php else : ?>
                    <h1><b>-</b><b>-</b></h1>
                <?php endif; ?>
                    <h2>可用资金</h2>
            </div>
        </div>
        <div class="utc_bot">
            <div class="utc_bot_item fl">
                <a href="<?= Url::to(['user/recharge'])?>">
                    <i class="dmfont dm-chongzhi"></i>
                    <span>充值</span>
                </a>
            </div>
            <div class="utc_bot_item fl">
                <a href="<?= Url::to(['user/withdraw'])?>">
                    <i class="dmfont dm-tixian"></i>
                    <span>提现</span>
                </a>
            </div>
            <div class="clear"></div>
            <div class="rect"></div>
        </div>
    </div>
</div>
<!--main1 end-->

<!--main2-->
<div class="user_list">
    <ul>
        <li>
            <a href="<?= Url::to(['user/certificate'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/user_icon/smrz.png"/>
                <span>实名认证</span>
                <i class="dmfont dm-arrow-right fr"></i>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['index/help-center'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/user_icon/help_icon.png"/>
                <span>帮助中心</span>
                <i class="dmfont dm-arrow-right fr"></i>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['index/article-detail','id' => 35])?>">
                <img src="<?= Url::base()?>/mobile/web/images/user_icon/about_icon.png"/>
                <span>关于我们</span>
                <i class="dmfont dm-arrow-right fr"></i>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['user/change-login-pwd'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/user_icon/pwd_icon.png"/>
                <span>修改登录密码</span>
                <i class="dmfont dm-arrow-right fr"></i>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['user/change-money-pwd'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/user_icon/mon_icon.png"/>
                <span>修改资金密码</span>
                <i class="dmfont dm-arrow-right fr"></i>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['index/app-download'])?>">
                <img src="<?= Url::base()?>/mobile/web/images/app_download.png"/>
                <span>APP下载</span>
                <i class="dmfont dm-arrow-right fr"></i>
            </a>
        </li>
    </ul>
    <?php if(Yii::$app->session['isLogin']):?>
    <div class="logout">
        <a href="<?= Url::to(['user/logout'])?>">退出登录</a>
    </div>
    <?php endif;?>
</div>
<!--main2 end-->

<?php $this->beginContent('@app/views/layouts/footer.php');?>
<?php $this->endContent()?>