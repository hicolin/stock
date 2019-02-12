//=======================买入
function buy() {
    var stock_code = $("#stock_code").val(), name = $(".stock_name").html(), decl_price = $("#decl_price").val(), decl_num = $("#decl_num").val();
    if (stock_code.length != 6) {
        layer.alert("请先输入正确的股票代码！", 8);
        return false;
    }
    $.layer({
        shade: [0],
        area: ['auto', 'auto'],
        dialog: {
            msg: "证券名称：" + name + "<br/>股票代码：" + stock_code + "<br/>委托价格：" + decl_price + "<br/>委托数量：" + decl_num + "<br/>买卖方向：委托买入",
            btns: 2,
            type: 4,
            btn: ['确定', '取消'],
            yes: function () {
                layer.load("买入处理中，请稍后...", 2);
                $.ajax({
                    url: "/tools/user_follow_ajax.ashx?act=buy&t" + new Date(),
                    dataType: "text",
                    type: "post",
                    timeout: 6000,
                    data: $("#form1").serialize(),
                    success: function (data) {
                        if (data == "" || data == null) {
                            window.location.href = "/login.html";
                            return false;
                        }
                        var obj = eval('(' + data + ')');
                        if (obj.status == "y") {
                            $("input:radio[name='fenshu']").attr("checked", false);
                            layer.alert(obj.info, 1);
                            clearSearch();
                            apply_list();
                            return false;
                        }
                        else {
                            layer.alert(obj.info, 8);
                            return false;
                        }
                    }
                });
            }
        }
    });
}
//=======================卖出
function sale() {
    var stock_code = $("#stock_code").val(), name = $(".stock_name").html(), decl_price = $("#decl_price").val(), decl_num = $("#decl_num").val();
    if (stock_code.length != 6) {
        layer.alert("请先输入该账户持有的股票代码！", 8);
        return false;
    }
    $.layer({
        shade: [0],
        area: ['auto', 'auto'],
        dialog: {
            msg: "证券名称：" + name + "<br/>股票代码：" + stock_code + "<br/>委托价格：" + decl_price + "<br/>委托数量：" + decl_num + "<br/>买卖方向：委托卖出",
            btns: 2,
            type: 4,
            btn: ['确定', '取消'],
            yes: function () {
                layer.load("卖出处理中，请稍后...", 2);
                $.ajax({
                    url: "/tools/user_follow_ajax.ashx?act=sale&t" + new Date(),
                    dataType: "text",
                    type: "post",
                    timeout: 6000,
                    async: false,
                    cache: false,
                    data: $("#form1").serialize(),
                    success: function (data) {
                        if (data == "" || data == null) {
                            window.location.href = "/login.html";
                            return false;
                        }
                        var obj = eval('(' + data + ')');
                        if (obj.status == "y") {
                            $("#stocksGrouplist").val("");
                            layer.alert(obj.info, 1);
                            clearSearch();
                            stock_sale_list(0);
                            window.parent.apply_list();
                            return false;
                        }
                        else {
                            layer.alert(obj.info, 8);
                            return false;
                        }
                    }
                });
            }
        }
    });
}
//=======================合并卖出
function sale_all() {
    var stock_code = $("#stock_code").val(), name = $(".stock_name").html(), decl_price = $("#decl_price").val(), decl_num = $("#decl_num").val();
    if (stock_code.length != 6) {
        layer.alert("请先输入该账户持有的股票代码！", 8);
        return false;
    }
    $.layer({
        shade: [0],
        area: ['auto', 'auto'],
        dialog: {
            msg: "证券名称：" + name + "<br/>股票代码：" + stock_code + "<br/>委托价格：" + decl_price + "<br/>委托数量：" + decl_num + "<br/>买卖方向：合并卖出",
            btns: 2,
            type: 4,
            btn: ['确定', '取消'],
            yes: function () {
                layer.load("卖出处理中，请稍后...", 2);
                $.ajax({
                    url: "/tools/user_follow_ajax.ashx?act=sale_all&t" + new Date(),
                    dataType: "text",
                    type: "post",
                    timeout: 6000,
                    async: false,
                    cache: false,
                    data: $("#form1").serialize(),
                    success: function (data) {
                        if (data == "" || data == null) {
                            window.location.href = "/login.html";
                            return false;
                        }
                        var obj = eval('(' + data + ')');
                        if (obj.status == "y") {
                            $("#stocksGrouplist").val("");
                            layer.alert(obj.info, 1);
                            clearSearch();
                            stock_sale_list(0);
                            return false;
                        }
                        else {
                            layer.alert(obj.info, 8);
                            return false;
                        }
                    }
                });
            }
        }
    });
}
//=======================市价买入
function sjmr() {
    var price = $("#decl_price").attr("maxprice");
    if (isNaN(price)) {
        price = 0;
    }
    $("#decl_price").val(price);
    $.get("/tools/opt_ajax.ashx", { act: "max_num", now: price, t: new Date() }, function (data) {
        quantity = Number(data).toFixed(0);
        var q = quantity % 100, q_100 = quantity - q;//可买数量是否是100的倍数，不是则去最接近的
        $(".can_quantity").html(q_100);
    });
}
//=======================市价卖出
function sjmc() {
    var price = $("#decl_price").attr("minprice");
    if (isNaN(price)) {
        price = 0;
    }
    $("#decl_price").val(price);
}
//=======================增加价格
function addPrice() {
    var maxprice = parseFloat($("#decl_price").attr("maxprice")), minprice = parseFloat($("#decl_price").attr("minprice")),
         price = parseFloat($("#decl_price").val()), money_now = parseFloat($("#money_balance").val()), now = 0, quantity = 0;
    now = Number(price + 0.01).toFixed(2), q_100 = 0;
    if (now > maxprice) {
        now = maxprice;
    }
    if (now < minprice) {
        now = minprice;
    }
    if (isNaN(now)) {
        now = 0;
    }
    $("#decl_price").val(now);
    $.get("/tools/opt_ajax.ashx", { act: "max_num", now: now, t: new Date() }, function (data) {
        quantity = Number(data).toFixed(0);
        var q = quantity % 100, q_100 = quantity - q;//可买数量是否是100的倍数，不是则去最接近的
        $(".can_quantity").html(q_100);
    });
}
//=======================减少价格
function reducePrice() {
    var maxprice = parseFloat($("#decl_price").attr("maxprice")), minprice = parseFloat($("#decl_price").attr("minprice")),
        price = parseFloat($("#decl_price").val()), money_now = parseFloat($("#money_balance").val()), now = 0, quantity = 0;
    now = Number(price - 0.01).toFixed(2), q_100 = 0;
    if (now > maxprice) {
        now = maxprice;
    }
    if (now < minprice) {
        now = minprice;
    }
    if (isNaN(now)) {
        now = 0;
    }
    $("#decl_price").val(now);
    $.get("/tools/opt_ajax.ashx", { act: "max_num", now: now, t: new Date() }, function (data) {
        quantity = Number(data).toFixed(0);
        var q = quantity % 100, q_100 = quantity - q;//可买数量是否是100的倍数，不是则去最接近的
        $(".can_quantity").html(q_100);
    });
}
//=======================更改价格
function uptPrice() {
    var maxprice = parseFloat($("#decl_price").attr("maxprice")), minprice = parseFloat($("#decl_price").attr("minprice")),
         price = parseFloat($("#decl_price").val()), money_now = parseFloat($("#money_balance").val()),
         quantity = 0, q_100 = 0;
    if (price > maxprice) {
        price = maxprice;
    }
    if (price < minprice) {
        price = minprice;
    }
    if (isNaN(price)) {
        price = 0;
    }
    $("#decl_price").val(Number(price).toFixed(2));
    $.get("/tools/opt_ajax.ashx", { act: "max_num", now: price, t: new Date() }, function (data) {
        quantity = Number(data).toFixed(0);
        var q = quantity % 100, q_100 = quantity - q;//可买数量是否是100的倍数，不是则去最接近的
        $(".can_quantity").html(q_100);
    });
}
//=======================增加价格
function s_addPrice() {
    var maxprice = parseFloat($("#decl_price").attr("maxprice")), minprice = parseFloat($("#decl_price").attr("minprice")),
         price = parseFloat($("#decl_price").val()), now = 0;
    now = Number(price + 0.01).toFixed(2), q_100 = 0;
    if (now > maxprice) {
        now = maxprice;
    }
    if (now < minprice) {
        now = minprice;
    }
    if (isNaN(now)) {
        now = 0;
    }
    $("#decl_price").val(now);
}
//=======================减少价格
function s_reducePrice() {
    var maxprice = parseFloat($("#decl_price").attr("maxprice")), minprice = parseFloat($("#decl_price").attr("minprice")),
        price = parseFloat($("#decl_price").val()), now = 0;
    now = Number(price - 0.01).toFixed(2);
    if (now > maxprice) {
        now = maxprice;
    }
    if (now < minprice) {
        now = minprice;
    }
    if (isNaN(now)) {
        now = 0;
    }
    $("#decl_price").val(now);
}
//=======================更改价格
function s_uptPrice() {
    var maxprice = parseFloat($("#decl_price").attr("maxprice")), minprice = parseFloat($("#decl_price").attr("minprice")),
         price = parseFloat($("#decl_price").val());
    if (price > maxprice) {
        price = maxprice;
    }
    if (price < minprice) {
        price = minprice;
    }
    if (isNaN(price)) {
        price = 0;
    }
    $("#decl_price").val(price);
}
//=======================卖出验证数量
function onlynumsale() {
    var num = parseFloat($("#decl_num").val()), quantity = parseFloat($("#can_quantity").html());
    if (!isNaN(num)) {
        if (num < 1) {
            layer.alert("卖出数量不能小于0股！", 8);
            return;
        }
        if (num > quantity) {
            layer.alert("数量不能大于可卖数量！", 8);
            return;
        }
    }
}
//=======================买入验证数量
function onlynum() {
    var num = parseFloat($("#decl_num").val()), quantity = parseFloat($("#can_quantity").html());
    if (!isNaN(num)) {
        if (num > 0 && num % 100 != 0 && num) {
            layer.alert("数量只能是100的倍数！", 8);
            return;
        }
        if (num > quantity) {
            layer.alert("数量不能大于可买数量！", 8);
            return;
        }
    }
}
//=======================百分比快捷键
function percentnum(percent) {
    var quantity = parseFloat($(".can_quantity").html()), now_q = 0;
    switch (percent) {
        case 1:
            now_q = quantity;
            break;
        case 2:
            now_q = quantity / 2;
            break;
        case 3:
            now_q = quantity / 3;
            break;
        case 4:
            now_q = quantity / 4;
            break;
        case 5:
            now_q = quantity / 5;
            break;
    }
    if (now_q < 100) {
        layer.alert("数量只能是100的倍数！", 8);
        return;
    }
    var q = now_q % 100, c_q = now_q - q;//可买数量是否是100的倍数，不是则去最接近的
    $("#decl_num").val(Number(c_q).toFixed(0));
}
//=======================清除代码
function clearSearch() {
    $("#stock_code").val("");
    $(".stock_code").html("--");//股票代码
    $(".stock_name").html("--");//股票名字
    $("#decl_price").val("0");//当前价格
    $("#decl_num").val("0");//数量
    $("#decl_price").attr("maxprice", "0");//今日最高价
    $("#decl_price").attr("minprice", "0");//今日最低价
    $(".sale5_p").html("--");//“卖五”报价
    $(".sale5_g").html("--");//“卖五”申请4695股，即X手；
    $(".sale4_p").html("--");
    $(".sale4_g").html("--");
    $(".sale3_p").html("--");
    $(".sale3_g").html("--");
    $(".sale2_p").html("--");
    $(".sale2_g").html("--");
    $(".sale1_p").html("--");
    $(".sale1_g").html("--");
    $(".buy1_p").html("--");//“买五”报价
    $(".buy1_g").html("--");//“买五”申请4695股，即X手；
    $(".buy2_p").html("--");
    $(".buy2_g").html("--");
    $(".buy3_p").html("--");
    $(".buy3_g").html("--");
    $(".buy4_p").html("--");
    $(".buy4_g").html("--");
    $(".buy5_p").html("--");
    $(".buy5_g").html("--");
    $(".y_close").html("0.00");//昨收
    $(".t_open").html("0.00");//今开
    $(".t_max").html("0.00");//今日最高价
    $(".t_min").html("0.00");//今日最低价
    $(".price_now").html("0.00");//当前价
    $(".upstop").html("0.00");//涨停
    $(".downstop").html("0.00");//跌停
    $(".can_quantity").html("0.00");
    $("#decl_num").val(0);
}
//=======================自动提示，点击搜索
function keys(kw) {
    search(kw);
}

//=======================持仓记录
function stock_list(type) {
    $.getJSON("/tools/user_follow_ajax.ashx", { act: "stock_list", type: type, t: new Date() }, function (data) {
        var strHtml = "";
        $.each(data.items, function (i, v) {
            //<td>" + v.money_yke + "</td>
            strHtml += "<tr class='" + (v.money_ykl >= 0 ? "red" : "green") + "' ondblclick='" + (type == 0 ? "search" : "sale_click") + "(\"" + v.stock_code + "\"," + v.id + ");' height='32'><td>" + v.stock_code + "</td><td>" + v.stock_name + "</td><td>" + v.stock_num + "</td><td>" + v.deal_num + "</td>";
            strHtml += "<td>" + v.deal_price + "</td><td>" + v.now_price + "</td><td>" + v.now_money + "</td><td>" + v.zsjg + "</td><td>" + v.money_ykl + "%</td><td>" + v.money_yke + "</td>";
            strHtml += "<td>" + (v.deal_num > 0 ? "<a href='javascript:' onclick='ChangeStockSale(\"" + v.stock_code + "\"," + v.id + ");'>卖出</a>" : "&nbsp;") + "</td></tr>";
        });
        $("#stock_list").html(strHtml);
    });
}
//=======================合并持仓记录
function stock_list_all(type) {
    $.get("/tools/user_follow_ajax.ashx", { act: "stock_list_all", type: type, t: new Date() }, function (data) {
        $("#stock_list_all").html(data);
    });
}
function stock_sale_list() {
    $.get("/tools/user_follow_ajax.ashx", { act: "stock_sale_list", t: new Date() }, function (data) {
        $("#stock_list").html(data);
    });
}
//=======================委托记录(撤单)
function apply_list() {
    $.get("/tools/user_follow_ajax.ashx", { act: "apply_list", type: 0, t: new Date() }, function (data) {
        if (data.length > 12) {
            $("#apply_list").html(data);
        }
    });
}
//=======================当日委托记录
function apply_list_today() {
    $.get("/tools/user_follow_ajax.ashx", { act: "apply_list", type: 1, t: new Date() }, function (data) {
        if (data.length > 12) {
            $("#apply_list_today").html(data);
        }
    });
}

//=======================撤销委托记录
function apply_back(id) {
    if (parseInt(id) > 0) {
        $.ajax({
            url: "/tools/user_follow_ajax.ashx?act=apply_back&id=" + id + "&t" + new Date(),
            dataType: "text",
            cache: false,
            async: false,
            type: "GET",
            timeout: 6000,
            success: function (data) {
                if (data == "1") {
                    apply_list();
                    apply_list_today();
                    money_all();
                }
            }
        });
    }
}
//=======================当日成交记录
function deal_today() {
    $.get("/tools/user_follow_ajax.ashx", { act: "deal_today", t: new Date() }, function (data) {
        $("#deal_today").html(data);
    });
}
//=======================自选股单只查询
function GetMySelfStockinfo(code) {
    if (code.length != 6) {
        return;
    }
    $("#btnSaveSelfStock").attr("disabled", true);
    $("#txtMySelfName").val("加载中...");
    $.ajax({
        url: "/tools/opt_ajax.ashx?act=sina_api&code=" + code + "&t=" + new Date(),
        dataType: "text",
        type: "GET",
        timeout: 6000,
        success: function (data) {
            var api = data.split(',');
            if (api.length > 30) {
                $("#txtMySelfName").val(api[0]);
                $("#btnSaveSelfStock").attr("disabled", false);
            }
            else {
                layer.alert("没有查询到相关数据！", 8);
            }
        }
    });
}
//=======================添加自选股
function AddMySelfStock(obj) {
    var code = $("#txtMySelfCode").val(), name = $("#txtMySelfName").val(), stock_pool_count = $("#stock_pool_count").val();
    if (code.length != 6) {
        layer.alert("请输入正确的证券代码！", 8);
        return;
    }
    $("#btnSaveSelfStock").hide();
    $("#btnSaveSelfStock").after("<span class='red' id='selfAddLoading'>添加处理中...</span>");
    $.ajax({
        type: "post",
        url: "/tools/user_follow_ajax.ashx?act=add_myself_stock&code=" + code + "&name=" + name + "&t=" + new Date(),
        dataType: 'text',
        cache: false,
        timeout: 6000,
        success: function (data) {
            var obj = eval('(' + data + ')');
            if (obj.status == "y") {
                $("#stock_pool_count").val(parseInt(stock_pool_count) + 1);
                StockPoolData(0);
            }
            else {
                layer.alert(obj.info, 8);
            }
            $("#btnSaveSelfStock").show();
            $("#selfAddLoading").remove();
            return false;
        }
    });
}
//=======================删除自选股
function DelMySelfStock(sid, obj) {
    var code = $("#selfcode" + sid).text(), name = $("#selfname" + sid).text(), stock_pool_count = $("#stock_pool_count").val();

    $.layer({
        shade: [0],
        area: ['auto', 'auto'],
        dialog: {
            msg: "确定要删除此自选股吗?<br/>证券代码：" + code + "<br/>证券名称：" + name,
            btns: 2,
            type: 4,
            btn: ['确定', '取消'],
            yes: function () {
                layer.load("删除处理中，请稍后...", 2);

                $.ajax({
                    url: "/tools/user_follow_ajax.ashx?act=del_myself_stock&id=" + sid + "&t" + new Date(),
                    dataType: "text",
                    type: "get",
                    timeout: 6000,
                    async: false,
                    cache: false,
                    success: function (data) {
                        if (data == "" || data == null) {
                            window.location.href = "/login.html";
                            return false;
                        }
                        var obj = eval('(' + data + ')');
                        if (obj.status == "y") {
                            $("#stock_pool_count").val(parseInt(stock_pool_count) - 1);
                            StockPoolData(0);
                            return false;
                        }
                        else {
                            layer.alert(obj.info, 8);
                            return false;
                        }
                    }
                });
            }
        }
    });
}
//=======================卖出切换框
function ChangeSale() {

    $("#ChangeSale").html("<iframe id='mainframe' name='mainframe' mainframe='0' frameborder='0' src='sale.html' width='878'></iframe>");
}
function ChangeStockSale(code, id) {
    $(".cgright").find(".sec").css("display", "none");
    $("#ChangeSale").show();
    $("#ChangeSale").html("<iframe id='mainframe' name='mainframe' mainframe='0' frameborder='0' src='sale.html?code=" + code + "&id=" + id + "' width='878'></iframe>");
}
function sale_click(code, id) {
    $("#sales").trigger("click");
    $(".cgright").find(".sec").css("display", "none");
    $("#ChangeSale").show();
    $("#ChangeSale").html("<iframe id='mainframe' name='mainframe' mainframe='0' frameborder='0' src='sale.html?code=" + code + "&id=" + id + "' width='878'></iframe>");
}

function ChangeSaleAll() {
    $("#ChangeSaleAll").html("<iframe id='mainframe' name='mainframe' mainframe='0' frameborder='0' src='/sale_all.html' width='878'></iframe>");
}
function ChangeStockSaleAll(code) {
    $(".cgright").find(".sec").css("display", "none");
    $("#ChangeSaleAll").show();
    $("#ChangeSaleAll").html("<iframe id='mainframe' name='mainframe' mainframe='0' frameborder='0' src='/sale_all.html?code=" + code + "' width='878'></iframe>");
}
function sale_allclick(code) {
    $("#sales_all").trigger("click");
    $(".cgright").find(".sec").css("display", "none");
    $("#ChangeSaleAll").show();
    $("#ChangeSaleAll").html("<iframe id='mainframe' name='mainframe' mainframe='0' frameborder='0' src='/sale_all.html?code=" + code + "' width='878'></iframe>");
}
//=======================刷新
function Refbuy() {
    var stock_code = $("#stock_code").val();
    if (stock_code.length == 6) {
        search(stock_code);
    }
}

var ShowPALDetail = function (id, obj) {
    if ($(obj).hasClass("open")) {
        $(obj).removeClass("open");
        $(".dt" + id).css("display", "none");
    } else {
        $(obj).addClass("open");
        if (!$(obj).hasClass("jia")) {
            $.get("/tools/user_follow_ajax.ashx", { act: "get_sum_deposit_money", id: id, t: new Date() }, function (data) {
                $("#yq_money" + id).html(data);
                $(obj).addClass("jia");
            });
        }
        $(".dt" + id).css("display", "");
    }
}
//搜索
function keypress() {
    $('#stock_code').bind('keypress', function (event) {
        if (event.keyCode == "13") {
            var stock_code = $("#stock_code").val();
            if (stock_code.length == 6) {
                search(stock_code);
                $("#keyup_d").hide();
            }
        }
    });
}
var choosePrice = function (obj) {
    $("#decl_price").val($(obj).html());
}
var choosePriceBuy = function (obj) {
    var price = Number($(obj).html()).toFixed(2);
    $("#decl_price").val(price);
    $.get("/tools/opt_ajax.ashx", { act: "max_num", now: price, t: new Date() }, function (data) {
        quantity = Number(data).toFixed(0);
        var q = quantity % 100, q_100 = quantity - q;//可买数量是否是100的倍数，不是则去最接近的
        $(".can_quantity").html(q_100);
    });
}
//=======================资金查询
function money_all() {
    $.get("/tools/user_follow_ajax.ashx", { act: "money_all", t: new Date() }, function (data) {
        var api = data.split(',');
        if (api.length > 0) {
            var profit_pos = parseFloat(api[5]).toFixed(2), money_able = parseFloat(api[0]).toFixed(2), money_worn = parseFloat(money_able - profit_pos).toFixed(2);
            $(".money_asset").html(Number(api[3]).toFixed(2));
            $(".money_profit").html(Number(api[2]).toFixed(2));
            $(".money_lock").html(Number(api[7]).toFixed(2));
            $(".money_can_buy").html(Number(api[6]).toFixed(2));
            $(".money_cap").html(Number(api[1]).toFixed(2));
            $(".money_able").html(money_able);
            $("#money_balance").val(Number(api[6]).toFixed(2));
            $("#worn_green").css("display", "none");
            $("#worn_red").css("display", "none");

            $("#money_yue").val(Number(api[9]).toFixed(2));
            $("#money_cash_lock").val(Number(api[10]).toFixed(2));
            $("#money_today_yq").val(Number(api[11]).toFixed(2));
            $("#money_stock_yk").val(Number(api[12]).toFixed(2));

            if (money_able < 0 && profit_pos > 0) {
                $(".money_extended_all").html(profit_pos + "（需充" + Number(-(money_able - profit_pos)).toFixed(2) + "元），延期资金占用费:" + Number(api[8]).toFixed(2) + "元");
                $("#ycfykt").html("因股价波动，请多充值避免平仓！");
                $("#worn_red").css("display", "block");
            } else if (money_able >= 0 && profit_pos > 0) {
                if (eval(profit_pos) >= eval(money_able)) {
                    $(".money_extended_all").html(profit_pos + "（需充" + Number(profit_pos - money_able).toFixed(2) + "元），延期资金占用费:" + Number(api[8]).toFixed(2) + "元");
                    $("#ycfykt").html("因股价波动，请多充值避免平仓！");
                    $("#worn_red").css("display", "block");
                }
                else {
                    $(".money_extended_all").html(profit_pos + "（需充0元），延期资金占用费:" + Number(api[8]).toFixed(2) + "元");
                    $("#ycfykt").html("因股价波动，请多充值避免平仓！");
                    $("#worn_green").css("display", "block");
                }
            } else if (profit_pos < 0) {
                $(".money_extended_all").html(profit_pos + "（可退" + -profit_pos + "元），延期资金占用费:" + Number(api[8]).toFixed(2) + "元");
                $("#worn_green").css("display", "block");
            } else {
                $("#worn_green").css("display", "block");
            }

            //if (money_worn >= 0) {
            //    $("#worn_green").css("display", "block");
            //    if (profit_pos < 0) {
            //        $(".money_extended_all").html(profit_pos + "（可退" + -profit_pos + "元），延期资金占用费:" + Number(api[8]).toFixed(2) + "元");
            //    } else {
            //        $(".money_extended_all").html(profit_pos);
            //    }
            //    $("#ycfykt").html("此刻保证金充足，请注意盘中变化！");
            //} else {
            //    $(".money_extended_all").html(profit_pos + "（需充" + -money_able + "元），延期资金占用费:" + Number(api[8]).toFixed(2) + "元");
            //    $("#worn_red").css("display", "block");
            //    $("#ycfykt").html("因股价波动，请多充值避免平仓！");
            //}
        }
    });
    var tab_staock = $(".tab_staock").css('display'), tab_staock_all = $(".tab_staock_all").css('display');
    if (tab_staock == "block") {
        stock_list(1);
    }
    if (tab_staock_all == "block") {
        stock_list_all(0);
    }
}
var couldRun = true;
var money_all_fresh = function () {
    if (couldRun) {
        couldRun = false;
        money_all();
        // 3秒后将变为可运行
        setTimeout(function () { couldRun = true; }, 5000);
    }
}