$(function () {
    //为ID为div1的div同时绑定普通的单双击事件
    $("#stock_code").dblclick(function () {
        keyup(event);
    });
    document.onclick = function (e) {
        var e = e ? e : window.event;
        var tar = e.srcElement || e.target;
        if (tar.id != "search" && tar.id != "keyup_d") {
            $("#keyup_d").hide();
        }
    }
});
//搜索
function keypress() {
    $('#stock_code').bind('keypress', function (event) {
        if (event.keyCode == "13") {
            var stock_code = $("#stock_code").val();
            search(stock_code);
            $("#keyup_d").hide();
        }
    });
}
function keyup_click(id) {
    $("#keyup_d").hide();
    var kw = $("#l_" + id).html();
    kw = encodeURI(kw);
    document.getElementById("stock_code").value = kw;
}
function keyup(event) {
    if (window.event) {
        var key = window.event.keyCode;
    } else {
        var key = event.which;
    }
    if (key != 38 && key != 40 && key != 13 && key != 8) {
        var kw = $("#stock_code").val();
        $.ajax({
            url: "/tools/opt_ajax.ashx?act=stock_code&code=" + escape(kw) + "&time=" + Math.random(),
            dataType: "text",
            type: "get",
            timeout: 6000,
            success: function (data) {
                if (data != '') {
                    $("#keyup_d").html(data);
                    $("#keyup_d").show();
                } else {
                    $("#keyup_d").hide();
                }
            }
        });
    }
}
function refresh() {
    var stock_code = $("#stock_code").val();
    if (stock_code.length != 6) {
        return;
    }
    $.ajax({
        url: "/tools/opt_ajax.ashx?act=stock_api&code=" + stock_code,
        dataType: "text",
        type: "GET",
        timeout: 6000,
        success: function (data) {
            var api = data.split(',');
            if (api.length > 30) {
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
                $(".price_now").html(Number(api[3]).toFixed(2));
            }
        }
    });
}