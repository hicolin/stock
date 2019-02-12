/**
* 页面加载
*/
$(function () {
    $("#default").addClass("now");
    $("#talent_no").change(function () {
        talent_no_history(this);
    });
    search("000001");
});
/*
* banner图滚动
*/
jQuery("#slide-fade").slide({
    titCell: ".hd ul", mainCell: ".bd ul", effect: "leftLoop", autoPlay: true, autoPage: true, trigger: "mouseover",
    startFun: function (i) {
        var curLi = jQuery("#slide-fade .bd li").eq(i);
        var top;
        if (!!curLi.attr("_src")) {
            curLi.css("background-image", curLi.attr("_src")).removeAttr("_src");
        }
        for (var ii = 0; ii < $("#slide-fade .bd li").length; ii++) {
            $("#slide-fade .hd li").eq(ii).html($("#slide-fade .bd li").eq(ii).attr("title"));
        }
        $(".i-dot").animate({
            left: (jQuery("#slide-fade .hd li").eq(i).position().left) + "px"
        }, 200);
    }
});
/**
* 顶部新闻滚动
*/
jQuery("#topNews").slide({ mainCell: ".bd ul", effect: "topLoop", trigger: "mouseover", delayTime: 1000, autoPlay: true });

/**
* 流动弹窗
*/
function zblfAnimate() {
    var width = $(window).width();
    var height = $(window).height();
    $("#floats").show();
    $("#floats").animate({
        top: height,
        left: width
    }, 30000, 'linear').animate({
        top: height - 200,
        left: 0
    }, 0).animate({
        top: -200,
        left: width
    }, 30000, 'linear').animate({
        top: 0,
        left: 0
    }, 0);
}
//$(function () {
//    zblfAnimate();
//    var timer = setInterval(zblfAnimate, 60000);
//    $("#floats").hover(function () {
//        $("#floats").stop(true);
//        clearInterval(timer);
//    }, function () {
//        timer = setInterval(zblfAnimate, 0);
//        if ($(this).is(":hidden")) {
//            $("#floats").stop(true, true);
//            clearInterval(timer);
//        }
//    });
//    $("#floats").find(".x-close").click(function () {
//        $("#floats").stop(true, true);
//        $("#floats").hide();
//        clearInterval(timer);
//    });
//});