/*======================自选池==============================*/
function StockPoolCallback(page_id) {
    StockPoolData(page_id);
}
function StockPoolData(pageindx) {
    var listcount = $("#stock_pool_count").val();
    $.get("/tools/user_follow_ajax.ashx", { act: "stock_pool_list", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 5) {
            $("#pager_stock_pool").css("display", "none");
        } else {
            $("#pager_stock_pool").css("display", "block");
        }
        $("#stock_pool_list").html(data);
    });
    $("#pager_stock_pool").pagination(listcount, {
        callback: StockPoolCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 5,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}

/*======================历史委托==============================*/
function ApplyHistoryCallback(page_id) {
    ApplyHistoryData(page_id);
}
function ApplyHistoryData(pageindx) {
    var listcount = $("#apply_history_count").val();
    $.getJSON("/tools/user_follow_ajax.ashx", { act: "apply_list_history", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 15) {
            $("#pager_apply_history").css("display", "none");
        } else {
            $("#pager_apply_history").css("display", "block");
        }
        var strHtml = "";
        $.each(data.items, function (i, v) {
            strHtml += "<tr class='" + (v.deal_status == 1 ? "blue" : "red") + "' height='32'><td>" + v.stock_code + "</td><td>" + v.stock_name + "</td><td>" + (v.deal_type == 1 ? "卖出" : "买入") + "</td><td>" + v.times + "</td><td>" + v.entrust_price + "</td>";
            strHtml += "<td>" + v.entrust_num + "</td><td>" + v.deal_num + "</td><td>" + v.deal_price + "</td><td>" + v.deal_no + "</td><td>" + v.holder_no + "</td></tr>";
        });
        $("#apply_list_history").html(strHtml);
    });
    $("#pager_apply_history").pagination(listcount, {
        callback: ApplyHistoryCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 15,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}
/*======================历史交易==============================*/
function DealHistoryCallback(page_id) {
    DealHistoryData(page_id);
}
function DealHistoryData(pageindx) {
    var listcount = $("#deal_history_count").val();
    $.getJSON("/tools/user_follow_ajax.ashx", { act: "deal_history", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 15) {
            $("#pager_deal_history").css("display", "none");
        } else {
            $("#pager_deal_history").css("display", "block");
        }
        var strHtml = "";
        $.each(data.items, function (i, v) {
            strHtml += "<tr class='" + (v.deal_type == 1 ? "blue" : "red") + "' height='32'><td>" + v.stock_code + "</td><td>" + v.stock_name + "</td><td>" + (v.deal_type == 1 ? "卖出" : "买入") + "</td><td>" + v.times + "</td><td>" + v.deal_price + "</td>";
            strHtml += "<td>" + v.deal_num + "</td><td>" + v.deal_money + "</td></tr>";
        });
        $("#deal_history").html(strHtml);
    });
    $("#pager_deal_history").pagination(listcount, {
        callback: DealHistoryCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 15,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}

/*======================资金流水==============================*/
function MoneyCallback(page_id) {
    MoneyData(page_id);
}
function MoneyData(pageindx) {
    var listcount = $("#money_count").val();
    $.getJSON("/tools/user_follow_ajax.ashx", { act: "money_list", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 14) {
            $("#pager_money").css("display", "none");
        } else {
            $("#pager_money").css("display", "block");
        }
        var strHtml = "";
        $.each(data.items, function (i, v) {
            strHtml += "<tr class='red' height='32'><td>" + v.id + "</td><td>" + v.time + "</td><td>" + v.balance_begin + "</td><td>" + v.deal_money + "</td><td>" + v.deposit_money + "</td>";
            strHtml += "<td>" + v.balance_money + "</td><td>" + v.deal_type + "：" + v.remark + "&nbsp;</td><td>" + v.stock_code + "&nbsp;</td><td>" + v.stock_name + "&nbsp;</td></tr>";
        });
        $("#money_list").html(strHtml);
    });
    $("#pager_money").pagination(listcount, {
        callback: MoneyCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 14,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}

/*======================平仓记录==============================*/
function InterestCallback(page_id) {
    InterestData(page_id);
}
function InterestData(pageindx) {
    var listcount = $("#interest_count").val();
    $.getJSON("/tools/user_follow_ajax.ashx", { act: "interest_list", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 15) {
            $("#pager_interest").css("display", "none");
        } else {
            $("#pager_interest").css("display", "block");
        }
        var strHtml = "";
        $.each(data.items, function (i, v) {
            strHtml += "<tr class='singular " + (v.profit_price >= 0 ? "red" : "green") + "' height='32'><td>" + v.stock_code + "</td><td>" + v.stock_name + "</td><td>" + v.times + "</td><td>" + v.buy_price + "</td><td>" + v.buy_cost + "</td><td>" + v.deal_price + "</td><td>" + v.deal_num + "</td>";
            strHtml += "<td>" + v.deal_money + "</td><td>" + v.profit_price + "</td></tr>";
        });
        $("#interest_list").html(strHtml);
        $("#txtprofit_price").html(data.profit_price);
    });
    $("#pager_interest").pagination(listcount, {
        callback: InterestCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 15,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}

/*======================达人大赛==============================*/
function TalentCallback(page_id) {
    TalentData(page_id);
}
function TalentData(pageindx) {
    var listcount = $("#talent_count").val();
    $.get("/tools/user_follow_ajax.ashx", { act: "talent_list", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 14) {
            $("#pager_talent").css("display", "none");
        } else {
            $("#pager_talent").css("display", "block");
        }
        $("#talent_list").html(data);
    });
    $("#pager_talent").pagination(listcount, {
        callback: TalentCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 14,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}

/*======================充值==============================*/
function rechargeCallback(page_id) {
    rechargeData(page_id);
}
function rechargeData(pageindx) {
    var listcount = $("#recharge_count").val();
    $.get("/tools/user_ajax.ashx", { act: "recharge_list", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 10) {
            $("#pager_recharge").css("display", "none");
        } else {
            $("#pager_recharge").css("display", "block");
        }
        $("#recharge_list").html(data);
    });
    $("#pager_recharge").pagination(listcount, {
        callback: rechargeCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 10,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}
/*======================提现==============================*/
function cashCallback(page_id) {
    cashData(page_id);
}
function cashData(pageindx) {
    var listcount = $("#cash_count").val();
    $.get("/tools/user_ajax.ashx", { act: "cash_list", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 10) {
            $("#pager_cash").css("display", "none");
        } else {
            $("#pager_cash").css("display", "block");
        }
        $("#cash_list").html(data);
    });
    $("#pager_cash").pagination(listcount, {
        callback: cashCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 10,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}


/*======================交割记录==============================*/
function stock_hisCallback(page_id) {
    stock_hisData(page_id);
}
function stock_hisData(pageindx) {
    var listcount = $("#stock_his_count").val();
    $.getJSON("/tools/user_follow_ajax.ashx", { act: "stock_his_list", p: (pageindx + 1), t: new Date() }, function (data) {
        if (listcount <= 15) {
            $("#pager_stock_his").css("display", "none");
        } else {
            $("#pager_stock_his").css("display", "block");
        }
        var strHtml = "";
        $.each(data.items, function (i, v) {
            strHtml += "<tr class='singular " + (v.profit_money >= 0 ? "red" : "green") + "' height='32'><td>" + v.stock_code + "</td><td>" + v.stock_name + "</td>"
            strHtml += "<td>" + v.buy_num + "</td><td>" + v.buy_price + "</td><td>" + v.deal_money + "</td><td>" + v.sale_num + "</td><td>" + v.sale_price + "</td>";
            strHtml += "<td>" + v.sale_money + "</td><td style='font-weight:bold;'>" + v.profit_money + "</td></tr>";
        });
        $("#stock_his_list").html(strHtml);
        $("#txtprofit_price").html(data.profit_price);
    });
    $("#pager_stock_his").pagination(listcount, {
        callback: stock_hisCallback,
        prev_text: '上一页',
        next_text: '下一页',
        items_per_page: 15,
        num_display_entries: 2,
        current_page: pageindx,
        num_edge_entries: 1
    });
}