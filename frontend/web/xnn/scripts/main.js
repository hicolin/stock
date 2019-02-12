/**
 * Created by Administrator on 2016/7/6.
 */
$(function () {
    $(".headtop-nav .wx").hover(function () {
        $(this).find(".wx-box").show();
    }, function () {
        $(this).find(".wx-box").hide();
    });
    $(document).keyup(function (event) {
        if (event.keyCode == 13) {
            var stock_code = $("#stock_code").val();
            if (stock_code.length == 6) {
                search(stock_code);
            }
        }
    });
})
function setTab(name, cur, length) {
    for (var i = 1; i <= length; i++) {
        var nav = $("#" + name + i);
        var con = $("#con_" + name + "_" + i);
        i == cur ? nav.addClass("hover") : nav.removeClass("hover");
        i == cur ? con.removeClass("hide").addClass("block") : con.addClass("hide").removeClass("block");
    }
}
var search = function (stock_code) {
    $.ajax({
        url: "/tools/opt_ajax.ashx?act=stock_api&code=" + stock_code + "&t=" + new Date(),
        dataType: "text",
        type: "GET",
        timeout: 6000,
        success: function (data) {
            var api = data.split(',');
            if (api.length > 30) {
                hideCode();
                $(".stock_code").html("（" + stock_code + "）");//股票代码
                $(".stock_name").html(api[0]);//股票名字
                $(".sale5_p").html(Number(api[29]).toFixed(2));//“卖五”报价
                $(".sale5_g").html(parseInt(parseFloat(api[28]) / 100));//“卖五”申请4695股，即X手；
                $(".sale4_p").html(Number(api[27]).toFixed(2));
                $(".sale4_g").html(parseInt(parseFloat(api[26]) / 100));
                $(".sale3_p").html(Number(api[25]).toFixed(2));
                $(".sale3_g").html(parseInt(parseFloat(api[24]) / 100));
                $(".sale2_p").html(Number(api[23]).toFixed(2));
                $(".sale2_g").html(parseInt(parseFloat(api[22]) / 100));
                $(".sale1_p").html(Number(api[21]).toFixed(2));
                $(".sale1_g").html(parseInt(parseFloat(api[20]) / 100));
                $(".buy1_p").html(Number(api[11]).toFixed(2));//“买五”报价
                $(".buy1_g").html(parseInt(parseFloat(api[10]) / 100));//“买五”申请4695股，即X手；
                $(".buy2_p").html(Number(api[13]).toFixed(2));
                $(".buy2_g").html(parseInt(parseFloat(api[12]) / 100));
                $(".buy3_p").html(Number(api[15]).toFixed(2));
                $(".buy3_g").html(parseInt(parseFloat(api[14]) / 100));
                $(".buy4_p").html(Number(api[17]).toFixed(2));
                $(".buy4_g").html(parseInt(parseFloat(api[16]) / 100));
                $(".buy5_p").html(Number(api[19]).toFixed(2));
                $(".buy5_g").html(parseInt(parseFloat(api[18]) / 100));
                $("#stock_code").val("");
                $("#stock_code_val").val(stock_code);
                //$("#stock_chart_k").html("<iframe id='mainframe2' name='mainframe' mainframe='0' frameborder='0' src='http://finance.qq.com/products/portfolio/zxgHQdetail.htm?mkType=sz&type=GP-A&name=&symbol=" + api[33] + stock_code + "' width='560' height='400' style='margin: 60px 0 0 50px;'></iframe>");
                //$("#stock_chart_k").html("<iframe id='mainframe2' name='mainframe' mainframe='0' frameborder='0' src='http://stockpage.10jqka.com.cn/HQ_v3.html#hs_" + stock_code + "' width='650' height='510' style='margin: 1px 0 0 1px;'></iframe>");
                $("#stock_chart_k").html("<iframe id='mainframe2' name='mainframe' mainframe='0' frameborder='0' src='/tools/k_t_line.aspx?code=" + stock_code + "' width='100%' height='510' style='margin: 1px 0 0 1px;'></iframe>");
            }
        }
    });
}
var hideCode = function () {
    $(".codesearch").css("display", "none");
    $(".codesearchtxt").css("display", "block");
}
var showCode = function () {
    $(".codesearch").css("display", "inline-block");
    $(".codesearchtxt").css("display", "none");
}
var ljcp = function () {
    var stock_code = $("#stock_code_val").val();
    window.location.href = "/stock.html?stock_code=" + stock_code;
}