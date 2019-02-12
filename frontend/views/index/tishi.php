<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no"
          name="viewport" id="viewport"/>
    <link href="<?= Url::base() ?>/mobile/web/css/main.css-v=20180205.css" rel="stylesheet"/>

    <title></title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <style type="text/css">
        .cmt {
            width: 95%;
            margin: 30px auto;
            background: #fff;
        }

        .cmt .title {
            color: #555555;
            font-size: 22px;
            line-height: 75px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-weight: 700;
        }

        .cmt .nr {
            color: #555555;
            font-size: 14px;
            line-height: 34px;
            padding: 20px 10px 50px 10px;
        }
        .agr_warp table{width: 100%;}
    </style>

</head>
<body>
<div class="m-head">
    <div class="head f-clear">
        <a href="javascript:HistoryBack();" class="fl head-back"></a>
        <span id="pageindex">首页</span>
        <a href="javascript:reload();" class="fr head-refresh"></a>
    </div>
</div>

<div class="m-body">
    <div class="cmt" style="border: 1px solid #ddd;">
        <div class="nr">
            <div class="agr_warp">
                <?=$detail->contact?>
            </div>
        </div>
    </div>
</div>
<a href="/" style="display: inline-block;
    height: 38px;
    width: 100%;
    line-height: 38px;
    background-color: #009688;
    color: #fff;
    white-space: nowrap;
    text-align: center;
    font-size: 14px;
    border: none;
    border-radius: 2px;
    cursor: pointer;
    position: fixed;
    left: 0;
    bottom:0;">确定</a>

<script src="<?= Url::base() ?>/mobile/web/scripts/jquery-1.11.2.min.js"></script>
<script src="<?= Url::base() ?>/mobile/web/scripts/layer-v1.8.5/layer/layer.min.js"></script>

<script type="text/javascript">
    $(function () {
        $("#pageindex").html("信息");
    });
</script>

<script type="text/javascript">
    ///返回上一页
    function HistoryBack() {
        if ((navigator.userAgent.indexOf('MSIE') >= 0) && (navigator.userAgent.indexOf('Opera') < 0)) { // IE

            if (history.length > 1) {
                window.history.go(-1);
            } else {
                window.location.href = '/';
            }
        } else { //非IE浏览器
            if (navigator.userAgent.indexOf('Firefox') >= 0 ||
                navigator.userAgent.indexOf('Opera') >= 0 ||
                navigator.userAgent.indexOf('Safari') >= 0 ||
                navigator.userAgent.indexOf('Chrome') >= 0 ||
                navigator.userAgent.indexOf('WebKit') >= 0) {
                if (window.history.length > 2) {
                    window.history.go(-1);
                } else {
                    window.location.href = '/';
                }
            } else {//未知的浏览器
                if (history.length > 1) {
                    window.history.go(-1);
                } else {
                    window.location.href = '/';
                }
            }
        }
    }
    ///重新加载
    function reload() {
        window.location.reload();
    }
</script>

