function provice(p, c, a) {
    $.ajax({
        url: "/tools/area_ajax.ashx?act=province&p=" + p,
        dataType: "text",
        type: "post",
        timeout: 6000,
        async: false,
        success: function (data) {
            $("#Province").append(data);
            city(c, a);
        }
    });
}
function city(c, a) {
    $("#City").html("");
    var id = $('#Province').find('option:selected').attr('data');
    alert(id);
    $.ajax({
        url: "/user/get-city",
        dataType: "text",
        type: "post",
        timeout: 6000,
        async: false,
        success: function (data) {
            $("#City").append(data);
            area(a);
        }
    });
}
function area(a) {
    $("#Area").html("");
    $.ajax({
        url: "/tools/area_ajax.ashx?act=area&cid=" + $('#City').find('option:selected').attr('data') + "&a=" + a,
        dataType: "text",
        type: "post",
        timeout: 6000,
        async: false,
        success: function (data) {
            $("#Area").append(data);
        }
    });
}