$(function () {
    tabChange();
    //实盘左侧菜单
    $(".subNav").click(function () {
        //0买入 1=撤单  高亮时不能再点
        if ($(this).index() <= 1 && $(this).attr("class").indexOf("currentDd") > 0) {
            return;
        }
        //子列表收缩  修改数字控制速度， slideUp(500)控制卷起速度
        //$(this).siblings(".navContent").slideUp(500);
        //$(this).next(".navContent").slideToggle(500);

        //按钮组高亮切换
        $(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd");
        $(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt");

        //
        $(this).siblings(".subNav").find('a').removeClass('ada');
        $(this).find('a').addClass('ada');

        //触发该按钮组下的第一个子链接
        //$(this).next(".navContent").find('a:first').click();
    });
    //默认打开买入
    var stock_code = $("#stock_code_val").val();
    if (stock_code.length == 6) {
        $('#btnBuy a').click();
        $('#btnBuy').click();

        search(stock_code);
    } else {
        $('#btnSearch').click();
        $('#btnBuy').click();
        //$('#btnStock').click();
    }
});
//左侧标签初始化
function tabChange() {
    var navs = $(".subNavBox").find('a'), contentBoxs = $('.tabcon');
    opts = {
        curNavIndex: 0
    }
    navs.each(function (i) {
        var _this = $(this);
        _this.click(function () {
            opts.curNavIndex = navs.index(_this); //=i
            //navToContentBox
            navs.removeClass('ada');
            contentBoxs.hide().eq(opts.curNavIndex).show();
            _this.addClass('ada');
            //refresh();
        });
    });
    $(".navContent a").click(function () {
        $("#stockNavBox .subNav a").removeClass("ada");
        $("#stockNavBox .subNav").removeClass("currentDd currentDt");
        $(this).parent().parent().prev().addClass('currentDd currentDt');
    });
}

//左侧标签切换
function SelectCurrentTab(id) {
    var navs = $(".subNavBox").find('a'), contentBoxs = $('.tabcon');
    var curr = $(".subNavBox").find('a#' + id);
    opts.curNavIndex = navs.index($(curr)[0]);
    //navs.removeClass('currentDd').removeClass('currentDt');
    //内容切换
    contentBoxs.hide().eq(opts.curNavIndex).show();
    //curr.addClass('currentDd').addClass('currentDt');
    //父标签切换
    curr.parent().parent().prev('.subNav').click();
    //$('a#'+id).parents(".navContent").prev(".subNav").trigger('click');
}
// function iFrameHeight() {
//     var ifm = document.getElementById("mainframe");
//     var subWeb = document.frames ? document.frames["mainframe"].document : ifm.contentDocument;
//     if (ifm != null && subWeb != null) {
//         ifm.height = subWeb.body.scrollHeight;
//         ifm.width = subWeb.body.scrollWidth;
//     }
// }