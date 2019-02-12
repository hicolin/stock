$(function () {
    $(".wxbox .wx").hover(function () {
        $(this).parent().find(".wxbx").show();
    });
    $(".wxbox").mouseleave(function () {
        $(this).find(".wxbx").hide();
    });
});
//======================提示框================
var TipMsg = {
    showTimer: null,
    popUp: function (icon, msg, abort, callback) {/*true或false,"提示",true为有取消按钮*/
        var cName;
        var callback = callback || function () { };
        if (icon == true) { cName = "true" }
        else if (icon == false) { cName = "false" } else { cName = "hide" }
        $("body").append('<div id="mark"></div><div id="alert"><h3>Tips<a href="javascript:;" onclick="TipMsg.closePop()"></a></h3><div class="tip_msg"><i class="' + cName + '"></i><div class="msg_con">' + msg + '</div></div><div class="al_btn"><button id="config">确定</button><button onclick="TipMsg.closePop()" id="abort">取消</button></div></div>');
        if (abort == true) { $("#abort").show(); }
        var win = $(window), off = $("#alert");
        off.css({ "left": (win.width() - off.width()) / 2 });
        $("#config").click(function () {
            TipMsg.closePop(callback);
        });
    },
    closePop: function (callback) {
        $("#mark,#alert").remove();
        if (callback) { callback(); }
    },
    position: function (msg, tag, timer, leftplus, topplus, direction) {/*"提示",$(this),2000,向左偏移,向上偏移,方向*/
        clearTimeout(this.showTimer);
        if ($("#tipBox").length == 0) { $("body").append('<div id="tipBox"></div>'); } else { $("#tipBox").show(); }
        var tagOff = tag.offset() || tag.position(), the = $("#tipBox");
        the.html('<div>' + msg + '</div>')
        var h = the.height() + 30;
        var _direction = direction || "up";
        if (leftplus == null) { leftplus = 0 }
        if (topplus == null) { topplus = 0 }
        if (_direction == "up") {
            the.css({ top: tagOff.top - h - 20, left: tagOff.left + leftplus }).removeClass("downTip leftTip rightTip");
            the.fadeIn(300).animate({ top: tagOff.top - h + topplus }, 300);
        } else if (_direction == "down") {
            the.css({ top: tagOff.top + tag.outerHeight() + 10, left: tagOff.left + leftplus }).addClass("downTip");
            the.fadeIn(300).animate({ top: tagOff.top + tag.outerHeight() + topplus }, 300);
        } else if (_direction == "left") {
            the.css({ top: tagOff.top + topplus, left: tagOff.left - tag.outerWidth() - 10 }).addClass("leftTip");
            the.fadeIn(300).animate({ left: tagOff.left - tag.outerWidth() - 10 + leftplus }, 300);
        } else if (_direction == "right") {
            the.css({ top: tagOff.top + topplus, left: tagOff.left + tag.outerWidth() + 10 + leftplus }).addClass("rightTip");
            the.fadeIn(300).animate({ left: tagOff.left + tag.outerWidth() + 10 + leftplus }, 300);
        }
        if (timer != -1) {
            the.hover(function () { clearTimeout(TipMsg.showTimer); }, function () {
                TipMsg.showTimer = setTimeout(function () {
                    the.fadeOut(300, function () { the.remove(); });
                }, timer);
            });
            TipMsg.showTimer = setTimeout(function () {
                the.fadeOut(300, function () { the.remove(); });
            }, timer);
        }
    },
    Dialog: function (icon, msg, timer) {/*true或false,"提示",时间*/
        var cName = icon == true ? "true" : "false";
        $("body").append('<div id="mark"></div><div id="automsg"><i class="' + cName + '"></i><span>' + msg + '</span></div>');
        var win = $(window), the = $("#automsg");
        the.css({ left: (win.width() - the.width()) / 2, top: (win.height() - the.height()) / 2 });
        setTimeout(function () { $("#mark,#automsg").remove(); }, timer);
    }
};
var changeTwoDecimal_f = function (floatvar) {
    var f_x = parseFloat(floatvar);
    if (isNaN(f_x)) {
        return '0.00';
    }
    var f_x = Math.round(f_x * 100) / 100;
    var s_x = f_x.toString();
    var pos_decimal = s_x.indexOf('.');
    if (pos_decimal < 0) {
        pos_decimal = s_x.length;
        s_x += '.';
    }
    while (s_x.length <= pos_decimal + 2) {
        s_x += '0';
    }
    return s_x;
}
//======================切换验证码
function ToggleCode(obj, codeurl) { $(obj).attr("src", codeurl + "?time=" + Math.random()); }
//======================来源网址
function getUrlParam(name) { var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); var r = window.location.search.substr(1).match(reg); if (r != null) return unescape(r[2]); return '/'; }
//======================cookie
function addCookie(name, value, expires) {
    var cookieString = name + "=" + escape(value);
    //判断是否设置过期时间 
    if (expires > 0) {
        var date = new Date();
        //date.setTime(date.getTime+expiresHours*60*60*1000); 
        date.setTime(date.getTime() + expires * 60 * 1000);
        cookieString = cookieString + "; expires=" + date.toGMTString() + ";path=/";
        //expires ="+ expiration.toGMTString()+";path=/;domain=local host; secure"; 
    }
    document.cookie = cookieString;
}
function deleteCookie(name) {
    var expdate = new Date();
    expdate.setTime(expdate.getTime() - 1);
    addCookie(name, "", expdate);
}
function getCookie(name) {
    var strCookie = document.cookie;
    var arrCookie = strCookie.split("; ");
    for (var i = 0; i < arrCookie.length; i++) {
        var arr = arrCookie[i].split("=");
        if (arr[0] == name)
            return arr[1];
    }
    return "";
}
//======================基于dialog插件提示框
function jsprint(msg) {
    parent.dialog({
        title: '提示',
        content: msg,
        cancelValue: '确定',
        cancel: function () { }
    }).showModal();
    return false;
}
function jsprinturl(msg, url) {
    parent.dialog({
        title: '提示',
        content: msg,
        okValue: '确定',
        ok: function () {
            if (url.length > 2) {
                window.location.href = url;
            }
        },
        onclose: function () {
            if (url.length > 2) {
                window.location.href = url;
            }
        }
    }).showModal();
    return false;
}
/*验证银行卡号*/
//银行卡号校验
//Description:  银行卡号Luhm校验
//Luhm校验规则：16位银行卡号（19位通用）:
// 1.将未带校验位的 15（或18）位卡号从右依次编号 1 到 15（18），位于奇数位号上的数字乘以 2。
// 2.将奇位乘积的个十位全部相加，再加上所有偶数位上的数字。
// 3.将加法和加上校验位能被 10 整除。
function bankcardCheck(bankno) {
    if (bankno.length < 7) {
        //$("#banknoInfo").html("银行卡号长度必须在16到19之间");
        return false;
    }else{
        return true;
    }
    var num = /^\d*$/;  //全数字
    if (!num.exec(bankno)) {
        //$("#banknoInfo").html("银行卡号必须全为数字");
        return false;
    }
    //开头6位
    var strBin = "10,18,30,35,37,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,58,60,62,65,68,69,84,87,88,94,95,98,99";
    if (strBin.indexOf(bankno.substring(0, 2)) == -1) {
        //$("#banknoInfo").html("银行卡号开头6位不符合规范");
        return false;
    }

    var lastNum = bankno.substr(bankno.length - 1, 1);//取出最后一位（与luhm进行比较）
    var first15Num = bankno.substr(0, bankno.length - 1);//前15或18位
    var newArr = new Array();
    for (var i = first15Num.length - 1; i > -1; i--) {    //前15或18位倒序存进数组
        newArr.push(first15Num.substr(i, 1));
    }
    var arrJiShu = new Array();  //奇数位*2的积 <9
    var arrJiShu2 = new Array(); //奇数位*2的积 >9
    var arrOuShu = new Array();  //偶数位数组
    for (var j = 0; j < newArr.length; j++) {
        if ((j + 1) % 2 == 1) {//奇数位
            if (parseInt(newArr[j]) * 2 < 9)
                arrJiShu.push(parseInt(newArr[j]) * 2);
            else
                arrJiShu2.push(parseInt(newArr[j]) * 2);
        }
        else //偶数位
            arrOuShu.push(newArr[j]);
    }
    var jishu_child1 = new Array();//奇数位*2 >9 的分割之后的数组个位数
    var jishu_child2 = new Array();//奇数位*2 >9 的分割之后的数组十位数
    for (var h = 0; h < arrJiShu2.length; h++) {
        jishu_child1.push(parseInt(arrJiShu2[h]) % 10);
        jishu_child2.push(parseInt(arrJiShu2[h]) / 10);
    }
    var sumJiShu = 0; //奇数位*2 < 9 的数组之和
    var sumOuShu = 0; //偶数位数组之和
    var sumJiShuChild1 = 0; //奇数位*2 >9 的分割之后的数组个位数之和
    var sumJiShuChild2 = 0; //奇数位*2 >9 的分割之后的数组十位数之和
    var sumTotal = 0;
    for (var m = 0; m < arrJiShu.length; m++) {
        sumJiShu = sumJiShu + parseInt(arrJiShu[m]);
    }
    for (var n = 0; n < arrOuShu.length; n++) {
        sumOuShu = sumOuShu + parseInt(arrOuShu[n]);
    }
    for (var p = 0; p < jishu_child1.length; p++) {
        sumJiShuChild1 = sumJiShuChild1 + parseInt(jishu_child1[p]);
        sumJiShuChild2 = sumJiShuChild2 + parseInt(jishu_child2[p]);
    }
    //计算总和
    sumTotal = parseInt(sumJiShu) + parseInt(sumOuShu) + parseInt(sumJiShuChild1) + parseInt(sumJiShuChild2);
    //计算Luhm值
    var k = parseInt(sumTotal) % 10 == 0 ? 10 : parseInt(sumTotal) % 10;
    var luhm = 10 - k;
    if (lastNum == luhm) {
        //$("#banknoInfo").html("Luhm验证通过");
        return true;
    }
    else {
        //$("#banknoInfo").html("银行卡号必须符合Luhm校验");
        return false;
    }
}
//==========================验证身份证
function ValidateIdCard(sId) {
    var aCity = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江 ", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北 ", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏 ", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外 " }
    var iSum = 0;
    var info = "";
    sId = sId.replace(/x$/i, "a");
    if (aCity[parseInt(sId.substr(0, 2))] == null) { return false };
    sBirthday = sId.substr(6, 4) + "-" + Number(sId.substr(10, 2)) + "-" + Number(sId.substr(12, 2));
    var d = new Date(sBirthday.replace(/-/g, "/"))
    if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate())) { return false };
    for (var i = 17; i >= 0; i--) iSum += (Math.pow(2, i) % 11) * parseInt(sId.charAt(17 - i), 11)
    if (iSum % 11 != 1) { return false };
    return true;
}
//=======================验证手机
function ValidateMobile(mobile) {
    var ismobi = /^(((1[0-9]{2}))+\d{8})$/.test(mobile);
    if (!ismobi || isNaN(mobile) || mobile.length != 11) {
        return false;
    }
    return true;
}
//======================验证邮箱
function ValidateEmail(email) {
    var isemail = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/.test(email);
    if (!isemail) {
        return false;
    }
    return true;
}
//验证QQ号码5-13位
function ValidateQQ(qq) {
    var filter = /^\s*[.0-9]{5,13}\s*$/;
    if (!filter.test(qq)) {
        return false;
    } else {
        return true;
    }
}
//========================刷新消息
function refreshmsg(id, t) {
    if (t > 0) {
        t--;
        addCookie("refreshid", id, 4)//刷新的id
        addCookie("refresht", t, 4)//刷新的时间
        setTimeout("refreshmsg('" + id + "'," + t + ");", 1000);
        $("#" + id).html("过" + t + "秒后重新发送");
        $('#code1').removeAttr('onclick');
    } else {
        $("#" + id).html("获取短信验证码");
        $("#code1").attr("onclick", "refreshmsg('code1', 60);");
    }
}
//=========================判断金额框是否输入的是合法的数字
function validateMoney(a) {
    var reNum = /^(([1-9]\d*)|0)(\.(\d){1,2})?$/;
    if (!reNum.test($(a).val())) {
        $(a).val("");
    } else {
        if (parseFloat($(a).val()) > parseFloat($(a).attr("maxValue"))) {
            $(a).val($(a).attr("maxValue"));
        }
    }
}
//======================验证字符格式
function ValidateChar(str) {
    var isok = /^\w{6,24}$/.test(str);   /*字母数字下划线验证*/
    if (!isok || isNaN(isok)) {
        return false;
    }
    return true;
}
//=======================清空input
function clearInput() {
    $("#mobile").val(""); $("#pwd").val("");
}
//======================发送手机验证码================
function getsmscode() {
    var mobile = $("#mobile_phone").val(), code2 = $("#code2").val();
    /*电话验证*/
    if (!ValidateMobile(mobile)) {
        TipMsg.position("请输入正确的手机号码", $("#mobile_phone"), 2000, 0, 0); $("#mobile_phone").focus(); return;
    }
    if (code2.length < 1) {
        TipMsg.position("请输入图像验证码答案", $("#code2"), 2000, 0, 0); $("#code2").focus(); return;
    }
    $.ajax({
        type: "GET",
        url: "/tools/user_ajax.ashx",
        data: { act: 'smsSend', mobile: mobile, code2: code2 },
        dataType: "text",
        beforeSend: function () {
            TipMsg.position("验证码发送中请稍等...", $("#mobile_phone"), 2000, 0, 0); return;
        },
        error: function (result) {
            TipMsg.position("验证码发送出现错误", $("#mobile_phone"), 2000, 0, 0); return;
        },
        success: function (data) {
            var obj = eval('(' + data + ')');
            if (obj.status == "y") {
                $("#vCodeImg").trigger("click");
                TipMsg.position(obj.info, $("#mobile_phone"), 2000, 0, 0); return;
            }
            else {
                TipMsg.position(obj.info, $("#mobile_phone"), 2000, 0, 0); return;
            }
        }
    });
}

//=======================获取短信验证码
var getSmsCodeNew = function (btnid, vcodeid, mobile) {
    var disabled = $('#' + btnid).attr("disabled");
    if (disabled) {
        console.log('请勿频繁发送!');
        return;
    };
    try {
        var code2 = $("#" + vcodeid).val();
        if (!code2) throw "请输入验证码!";
        $.ajax({
            type: "GET",
            url: "/tools/user_ajax.ashx",
            data: { act: 'smsSend', mobile: mobile, code2: code2 },
            dataType: "text",
            beforeSend: function () {
                $('#' + btnid).attr("disabled", true);
            },
            error: function (result) {
                layer.alert("验证码发送出现错误！", 8);
                $('#' + btnid).attr("disabled", false);
            },
            success: function (data) {
                var obj = eval('(' + data + ')');
                if (obj.status == "y") {
                    layer.alert(obj.info, 1);
                    var seconds = 60;
                    var timer = setInterval(function () {
                        seconds--;
                        $('#' + btnid).val(seconds + 's后重新发送');
                        if (seconds <= 0) {
                            clearInterval(timer);
                            $('#' + btnid).attr("disabled", false);
                            $('#' + btnid).val('重新发送');
                        }
                    }, 1000);
                }
                else {
                    $('#' + btnid).attr("disabled", false);
                    layer.alert(obj.info, 8);
                }
            }
        });
    } catch (e) {       
        layer.alert(e);
    }
}

//=======================登录
function login() {
    var url = getUrlParam("url"), mobile = $("#mobile").val(), pwd = $("#pwd").val(), code = $("#code").val(), rb_name = 0,         vcode = $('#vcode').val();
    if ($('#rb_name').is(':checked')) {
        rb_name = 1;
    }
    if (mobile == "" || $("#pwd").val() == "") {
        $("#msgtips").show();
        $("#msgtips").text("请输入账号和密码！");
        return false;
    }
    $.ajax({
        type: "POST",
        url: $("#form1").attr("url"),
        dataType: "json",
        data: { "usersname": mobile, "password": pwd,rb_name:rb_name },
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            $("#btnSubmit").attr("disabled", true);
            $("#msgtips").show();
            $("#msgtips").text("正在登录，请稍候...");
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                if (url == "/") {
                    window.location.href = "/user/index";
                } else {
                    location.href = url;
                }
            } else {
                $("#btnSubmit").attr("disabled", false);
                $("#msgtips").text(data.info);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#msgtips").text("状态：" + textStatus + "；出错提示：" + errorThrown);
            $("#btnSubmit").attr("disabled", false);
        }
    });
}
//=======================注册
function reg() {
    var url = getUrlParam("url"), account_no = $("#account_no").val(), mobile = $("#mobile").val(),
        pwd = $("#pwd").val(), code_mobile = $("#code_mobile").val(), ref_mobile = $("#ref_mobile").val(), agents_num = $("#agents_num").val();
    //if (!ValidateChar(account_no)) {
    //    $("#account_no").focus();
    //    TipMsg.position("登录账号由6-24位的字母数字或下划线组成！", $("#account_no"), 2000, 0, 0);
    //    return;
    //}
    /*电话验证*/
    if (!ValidateMobile(mobile)) {
        $("#mobile").focus();
        TipMsg.position("请输入正确的手机号码！", $("#mobile"), 2000, 0, 0);
        return;
    }
    if (!ValidateChar(pwd)) {
        $("#pwd").focus();
        TipMsg.position("密码由6-24位的字母数字或下划线组成！", $("#pwd"), 2000, 0, 0);
        return;
    }
    if (code_mobile.length != 6) {
        TipMsg.position("请输入正确的短信验证码！", $("#code_mobile"), 2000, 0, 0);
        $("#code_mobile").focus();
        return;
    }
    //if (ref_mobile != "") {
    //    /*推荐人电话验证*/
    //    if (!ValidateMobile(ref_mobile)) {
    //        $("#ref_mobile").focus();
    //        TipMsg.position("推荐人手机号码不正确！", $("#ref_mobile"), 2000, 0, 0);
    //        return;
    //    }
    //}
    if (agents_num.length < 6) {
        $("#agents_num").focus();
        TipMsg.position("请输入正确的邀请码！", $("#agents_num"), 2000, 0, 0);
        return;
    }
    if (!$('#agree').is(':checked')) {
        TipMsg.position("必须同意注册协议才能注册", $("#agree"), 2000, 0, 0);
        $("#agree").focus();
        return;
    }
    $.ajax({
        type: "POST",
        url: $("#form1").attr("url"),
        dataType: "json",
        data: { "tel": mobile, "pwd": pwd, vercode: code_mobile, vatation_code: agents_num },
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            $("#btnSubmit").attr("disabled", true);
            $("#msgtips").show();
            $("#msgtips").text("正在注册，请稍候...");
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                alert(data.info);
                window.location.href = "/index/login";
            } else {
                $("#btnSubmit").attr("disabled", false);
                TipMsg.position(data.info, $("#btnSubmit"), 2000, 0, 0);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#msgtips").text("状态：" + textStatus + "；出错提示：" + errorThrown);
            $("#btnSubmit").attr("disabled", false);
        }
    });
}
//======================检验是否注册================
function checkreg(){
     var mobile = $("#mobile").val();
     $.ajax({
        type: "POST",
        url: '/index/validate-tel',
        dataType: "text",
        data: { "tel": mobile},
        success: function (data) {
            if (data == 300) {
                $("#mobile").focus();
                $("#btnSubmit").css('disabled',true);
                TipMsg.position("该手机号已注册，请直接登录", $("#mobile"), 2000, 0, 0);
                // window.location.href="/index/login";
                setTimeout(function () {
                location.href = "/index/login";
                },2000);
                return;
            }
        },
    });

}
//======================注册验证码================
function reg_sms() {
    var mobile = $("#mobile").val(), code2 = $("#code2").val();
    // var templateId="140323";
    /*电话验证*/
    if (!ValidateMobile(mobile)) {
        TipMsg.position("请输入正确的手机号码！", $("#mobile"), 2000, 0, 0);
        $("#mobile").focus();
        return;
    }
    $.post("/index/message", { 'tel':mobile}, function (data) {
        $("#vCodeImg").trigger("click");
        refreshmsg("btnOnece", 60);
        TipMsg.position(data, $("#mobile"), 2000, 0, 0); return;
        //var obj = eval('(' + data + ')');
        //if (obj.status == "n") {
        //    TipMsg.position(obj.info, $("#mobile"), 2000, 0, 0); return;
        //} else {
        //    $("#vCodeImg").trigger("click");
        //    refreshmsg("btnOnece", 60);
        //    TipMsg.position(data, $("#mobile"), 2000, 0, 0); return;
        //}
    });
}
//======================找回密码验证码================
function findpwd_sms() {
    var mobile = $("#mobile").val(), code2 = $("#code2").val();
    /*电话验证*/
    if (!ValidateMobile(mobile)) {
        TipMsg.position("请输入正确的手机号码！", $("#mobile"), 2000, 0, 0);
        $("#mobile").focus();
        return;
    }
    if (code2.length < 1) {
        TipMsg.position("请输入图像验证码答案", $("#code2"), 2000, 0, 0); $("#code2").focus(); return;
    }
    $.get("/tools/user_ajax.ashx", { act: "smsSendPwd", mobile: mobile, code2: code2 }, function (data) {
        var obj = eval('(' + data + ')');
        if (obj.status == "n") {
            TipMsg.position(obj.info, $("#mobile"), 2000, 0, 0); return;
        } else {
            $("#vCodeImg").trigger("click");
            refreshmsg("btnOnece", 60);
            TipMsg.position(obj.info, $("#mobile"), 2000, 0, 0); return;
        }
    });
}
//======================刷新消息================
function refreshmsg(id, t) {
    if (t > 0) {
        t--;
        //addCookie("refreshid", id, 4)//刷新的id
        //addCookie("refresht", t, 4)//刷新的时间
        setTimeout("refreshmsg('" + id + "'," + t + ");", 1000);
        $("#" + id).val(t + "秒后重新发送");
        $("#" + id).attr("disabled", "disabled");
    } else {
        $("#" + id).val("重新发送");
        $("#" + id).removeAttr("disabled");
    }
}
//=======================忘记密码
function find_pwd() {
    var url = getUrlParam("url"), mobile = $("#mobile").val();
    if (!ValidateMobile(mobile)) {
        jsprint("请输入正确的手机号码!");
        return false;
    }
    $.ajax({
        url: "/tools/user_ajax.ashx?act=find_pwd",
        dataType: "text",
        type: "post",
        timeout: 6000,
        async: false,
        cache: false,
        data: $("#form1").serialize(),
        success: function (data) {
            var obj = eval('(' + data + ')');
            if (obj.status == "y") {
                jsprinturl("恭喜您，找回密码成功，请重新登录试试吧！", "/login.aspx");
            }
            else {
                jsprint(obj.info);
                return false;
            }
        }
    });
}
//=======================退出登录
function LoginOutAjax() {
    $.ajax({
        url: "/tools/user_ajax.ashx?act=loginout",
        dataType: "text",
        type: "GET",
        timeout: 6000,
        cache: false,
        success: function (data) {
            window.location.href = "/Default.aspx";
        }
    });
}
//=======================修改密码
function changePwd() {
    var _oldpwd = $.trim($("#oldPwd").val()), _newPwd1 = $.trim($("#newPwd1").val()), _newPwd2 = $.trim($("#newPwd2").val());
    if (_oldpwd.length < 6) {
        jsprint("密码最少６位哦");
        $("#oldPwd").focus();
        return;
    }
    if (_newPwd1.length < 6 || _newPwd1.length > 16 || !ValidateChar(_newPwd1)) {
        jsprint("密码由6-24位的字母数字或下划线组成");
        $("#newPwd1").focus();
        return;
    }
    if (_newPwd1 != "" && _newPwd1 != _newPwd2) {
        jsprint("两次输入密码不一致");
        return;
    }
    $.ajax({
        url: "/tools/user_ajax.ashx?act=pwd",
        dataType: "text",
        type: "post",
        timeout: 6000,
        async: false,
        cache: false,
        data: $("#form1").serialize(),
        success: function (data) {
            var obj = eval('(' + data + ')');
            if (obj.status == "old") {
                jsprint("旧密码不正确");
                return;
            }
            else if (obj.status == "y") {
                alert(obj.info);
                window.location.href = "/login.html";
                return;
            }
            else {
                jsprint(obj.info);
                return;
            }
        }
    });
}
//=======================链接地址
function gourl(url) {
    window.location.href = url;
}
//======================弹出窗口================
var openwin = function (tit, w, h, url) {
    top.dialog({
        title: tit,
        url: url,
        width: w,
        height: h,
        fixed: true,
        data: window //传入当前窗口
    }).showModal();
}
//=======================链接地址
function gopage(page) {
    $.ajax({
        type: "GET",
        url: "/tools/user_ajax.ashx",
        cache: false,
        data: { act: 'gopage', page: page, t: new Date() },
        success: function (data) {
            var obj = eval('(' + data + ')');
            if (obj.status == "l") {
                window.location.href = "/login.aspx";
                return;
            }
            else if (obj.status == "c") {
                jsprinturl(obj.info, "/Default.aspx");
                return false;
            }
            else {
                if (obj.info == "/Default.aspx") {
                    jsprint("请先选择股票账号!");
                }
                window.location.href = obj.info;
                return;
            }
        }
    });
}
//=======================当前栏目
function nav(id) {
    $(".li" + id).addClass("now");
}
//=======================修改资料
function upt_account() {
    var user_name = $("#user_name").val(), id_card = $("#id_card").val(), email = $("#email").val(),
        qq = $("#qq").val(), address = $("#address").val();
    if (user_name.length < 2) {
        $("#user_name").focus();
        TipMsg.position("请输入您的真实姓名！", $("#user_name"), 2000, 0, 0);
        return;
    }
    /*身份证验证*/
    if (id_card != "") {
        if (!ValidateIdCard(id_card)) {
            $("#id_card").focus();
            TipMsg.position("请输入正确的身份证号码！", $("#id_card"), 2000, 0, 0);
            return;
        }
    }
    /*邮箱验证*/
    if (email != "") {
        if (!ValidateEmail(email)) {
            $("#email").focus();
            TipMsg.position("请输入正确的邮件地址！", $("#email"), 2000, 0, 0);
            return;
        }
    }
    /*QQ验证*/
    if (!ValidateQQ(qq)) {
        $("#qq").focus();
        TipMsg.position("请输入正确的QQ号码！", $("#qq"), 2000, 0, 0);
        return;
    }
    if (address == "") {
        //$("#address").focus();
        //TipMsg.position("请输入地址！", $("#address"), 2000, 0, 0);
        //return;
    }
    $.ajax({
        type: "POST",
        url: $("#form1").attr("url"),
        dataType: "json",
        data: { "user_name": user_name, "id_card": id_card, "email": email, "qq": qq, "address": address },
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            $("#btnSubmit").attr("disabled", true);
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                TipMsg.position("保存成功", $("#btnSubmit"), 2000, 0, 0);
                return;
            } else {
                $("#btnSubmit").attr("disabled", false);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("状态：" + textStatus + "；出错提示：" + errorThrown);
            $("#btnSubmit").attr("disabled", false);
        }
    });
}
//=======================实名认证
function upt_name_true() {
    var user_name = $("#user_name").val(), id_card = $("#id_card").val(), id_card_ck = $("#id_card_ck").val(),
        back_value = $("#back_value").val(), hold_value = $("#hold_value").val();
    if (user_name.length < 2) {
        $("#user_name").focus();
        TipMsg.position("请输入您的真实姓名！", $("#user_name"), 2000, 0, 0);
        return;
    }
    /*身份证验证*/
    if (!ValidateIdCard(id_card)) {
        $("#id_card").focus();
        TipMsg.position("请输入正确的身份证号码！", $("#id_card"), 2000, 0, 0);
        return;
    }
    /*身份证验证*/
    if (id_card_ck != id_card) {
        $("#id_card_ck").focus();
        TipMsg.position("两次身份证号码输入不匹配！", $("#id_card_ck"), 2000, 0, 0);
        return;
    }
    //if (back_value.length < 12) {
    //    $("#back_image").focus();
    //    TipMsg.position("请上传身份证正面照！", $("#back_image"), 2000, 0, 0);
    //    return;
    //}
    //if (hold_value.length < 12) {
    //    $("#hold_image").focus();
    //    TipMsg.position("请上传身份证背面照！", $("#hold_image"), 2000, 0, 0);
    //    return;
    //}
    $.ajax({
        type: "POST",
        url: $("#form1").attr("url"),
        dataType: "json",
        data: { "user_name": user_name, "id_card": id_card, "id_card_ck": id_card_ck, "back_value": back_value, "hold_value": hold_value },
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            $("#btnSubmit").attr("disabled", true);
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                alert(data.info);
                location.href = "/user/account.aspx";
                TipMsg.position(data.info, $("#btnSubmit"), 2000, 0, 0);
                return;
            } else {
                TipMsg.position(data.info, $("#btnSubmit"), 2000, 0, 0);
                $("#btnSubmit").attr("disabled", false);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("状态：" + textStatus + "；出错提示：" + errorThrown);
            $("#btnSubmit").attr("disabled", false);
        }
    });
}
//=======================提现申请
function cash() {
    var amount = parseFloat($("#amount").val());
    if (isNaN(amount)) {
        TipMsg.position("请输入数字！", $("#amount"), 2000, 0, 0); $("#amount").focus(); return false;
    }
    if (amount < 100) {
        TipMsg.position("提现不得低于100元", $("#amount"), 2000, 0, 0); $("#amount").focus(); return false;
    }
    $.ajax({
        url: "/tools/user_follow_ajax.ashx?act=cash",
        dataType: "text",
        type: "post",
        async: false,
        data: $("#form1").serialize(),
        success: function (data) {
            var obj = eval('(' + data + ')');
            if (obj.status == "y") {
                alert(obj.info);
                location.reload();
            }
            else {
                TipMsg.position(obj.info, $("#amount"), 2000, 0, 0); return false;
            }
        }
    });
}
//在线充值
function recharge() {
    var money = parseFloat($("#money").val()), PaymentType = $('input[name="PayID"]:checked ').val(), pay_code = $('input[name="pay_code"]:checked ').val();
    if (isNaN(money)) {
        $("#money").focus();
        TipMsg.position("请输入充值金额！", $("#money"), 2000, 0, 0);
        return false;
    }
    if (money <= 0) {
        $("#money").focus();
        TipMsg.position("充值金额不能小于0元！", $("#money"), 2000, 0, 0);
        return false;
    }
    $("#money").val("");
    if (pay_code == "1") {
        window.open("/api/95epay/index.aspx?PaymentType=&amount=" + money, "_blank");
    } else {
        window.open("/api/fuiou/index.aspx?PaymentType=&amount=" + money, "_blank");
    }
}
//=======================找回密码
function findpwd() {
    alert(111)
    var url = getUrlParam("url"), mobile = $("#mobile").val(), code_mobile = $("#code_mobile").val();
    /*电话验证*/
    if (!ValidateMobile(mobile)) {
        $("#mobile").focus();
        TipMsg.position("请输入正确的注册手机号码！", $("#mobile"), 2000, 0, 0);
        return;
    }
    if (code_mobile.length != 4) {
        TipMsg.position("请输入正确的短信验证码！", $("#code_mobile"), 2000, 0, 0);
        $("#code_mobile").focus();
        return;
    }
    $.ajax({
        type: "POST",
        url: $("#form1").attr("url"),
        dataType: "json",
        data: { "mobile": mobile, code_mobile: code_mobile },
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            $("#btnSubmit").attr("disabled", true);
            $("#msgtips").show();
            $("#msgtips").text("正在注册，请稍候...");
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                alert(data.info);
                window.location.href = "/login.html";
            } else {
                $("#btnSubmit").attr("disabled", false);
                $("#msgtips").text(data.info);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#msgtips").text("状态：" + textStatus + "；出错提示：" + errorThrown);
            $("#btnSubmit").attr("disabled", false);
        }
    });
}
//=======================报名参加达人大赛
function join_talent() {
    if (confirm("您确定要加入达人大赛吗？")) {
        $.ajax({
            url: "/tools/user_ajax.ashx?act=join_talent",
            dataType: "text",
            type: "post",
            async: false,
            success: function (data) {
                var obj = eval('(' + data + ')');
                if (obj.status == "y") {
                    alert(obj.info);
                }
                else if (obj.status == "l") {
                    alert(obj.info);
                    window.location.href = "/login.html";
                }
                else {
                    alert(obj.info);
                }
            }
        });
    }
}
//=======================历史赛报
var talent_no_history = function (obj) {
    var val = parseInt($(obj).val());
    $.get("/tools/opt_ajax.ashx", { act: "talent_no_history", periods_no: val, t: new Date() }, function (data) {
        if (data != "") {
            $("#talent_list").html(data);
        }
    });
}
//=======================线下充值
function pay_by_bank() {
    var total = $("#total").val();
    var zzx = $("#remark").val();
    var pz = $("#pz").attr('src');
    if (total.length < 1) {
        $("#total").focus();
        layer.msg("请填写转账金额！");
        return;
    }
    if (isNaN(total)) {
        $("#total").focus();
        layer.msg("转账金额必须是数字！");
        return false;
    }
    if(!zzx){
        layer.msg("请填写转账信息！");
        return false;
    }
    if(pz==='/frontend/web/xnn/images/timg.jpg'){
        layer.msg("请上传支付凭证！");
        return false;
    }
    $.ajax({
        type: "get",
        url: "/user/line-recharge",
        dataType: "json",
        data: {money:total,remark:zzx,pz:pz},
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            layer.load(0, { shade: false, time: 2000 });
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                $("#total").val("");
                $("#remark").val("");
                layer.msg("提交成功，我们会第一时间进行处理");
                return;
            } else {
                layer.msg(data.info);return;
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            layer.alert("状态：" + textStatus + "；出错提示：" + errorThrown, 8);
        }
    });
}
//=======================微信充值
function pay_by_wechat() {
    var total = $("#wechat_total").val();
    if (total.length < 1) {
        $("#wechat_total").focus();
        layer.alert("请填写转账金额！", 8);
        return;
    }
    if (isNaN(total)) {
        $("#wechat_total").focus();
        layer.alert("转账金额必须是数字！", 8);
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/tools/user_follow_ajax.ashx?act=pay_by_wechat",
        dataType: "json",
        data: $("#form2").serialize(),
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            layer.load(0, { shade: false, time: 2000 });
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                $("#wechat_total").val("");
                $("#wxremark").val("");
                layer.alert("提交成功，我们会第一时间进行处理", 1);
                return;
            } else {
                layer.alert(data.info, 8);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            layer.alert("状态：" + textStatus + "；出错提示：" + errorThrown, 8);
        }
    });
}
//=======================支付宝充值
function pay_by_alipay() {
    var total = $("#alipay_total").val();
    if (total.length < 1) {
        $("#alipay_total").focus();
        layer.alert("请填写转账金额！", 8);
        return;
    }
    if (isNaN(total)) {
        $("#alipay_total").focus();
        layer.alert("转账金额必须是数字！", 8);
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/tools/user_follow_ajax.ashx?act=pay_by_alipay",
        dataType: "json",
        data: $("#form3").serialize(),
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            layer.load(0, { shade: false, time: 2000 });
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                $("#alipay_total").val("");
                $("#alipay_account").val("");
                layer.alert("提交成功，我们会第一时间进行处理", 1);
                return;
            } else {
                layer.alert(data.info, 8);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            layer.alert("状态：" + textStatus + "；出错提示：" + errorThrown, 8);
        }
    });
}
///认证支付充值
function pay_by_auth() {
    var money = parseFloat($("#auth_total").val());
    if (isNaN(money)) {
        TipMsg.position("请输入充值金额！", $("#auth_total"), 2000, 0, 0); $("#auth_total").focus(); return false;
    }
    if (money <= 0) {
        TipMsg.position("充值金额必须大于0！", $("#auth_total"), 2000, 0, 0); $("#auth_total").focus(); return false;
    }
    window.open("/api/unspay_auth/index.aspx?amount=" + money, "_blank")
}
///扫码充值
function pay_by_sm() {
    var total = $("#sm_total").val();
    var title = $("#smremark").val();
    var pz = $("#pz").attr('src');
    if(!title){
        layer.msg("请填写转账信息！");
        return false;
    }

    if (total.length < 1) {
        $("#sm_total").focus();
        layer.msg("请填写转账金额");
        return;
    }
    if (isNaN(total)) {
        $("#sm_total").focus();
        layer.msg("转账金额必须是数字");
        return false;
    }
    if(pz==='/frontend/web/xnn/images/timg.jpg'){
        layer.msg("请上传支付凭证！");
        return false;
    }
    $.ajax({
        type: "get",
        url: "/user/sao-recharge",
        dataType: "json",
        data: {money:total,remark:title,pz:pz},
        timeout: 20000,
        cache: false,
        beforeSend: function (XMLHttpRequest) {
            layer.load(0, { shade: false, time: 2000 });
        },
        success: function (data, textStatus) {
            if (data.status == "y") {
                $("#sm_total").val("");
                $("#smremark").val("");
                layer.msg("提交成功，我们会第一时间进行处理");
                return;
            } else {
                layer.msg(data.info);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            layer.alert("状态：" + textStatus + "；出错提示：" + errorThrown, 8);
        }
    });
}
//=======================推广用户列表
function reference_list_test(obj, type_id) {
    $(".paytype a").removeClass("on");
    $(obj).addClass("on");
    $.get("/tools/user_follow_ajax.ashx", { act: "reference_list", type_id: type_id, t: new Date() }, function (data) {
        if (data.trim().length > 32) {
            $("#list_data").html(data);
        } else {
            $("#list_data").html("<tr><td colspan='5'>暂无记录</td></tr>");
        }
    });
}
//=======================推广用户列表
var reference_list = function (obj, type_id) {
    $("#symdc3 .paytype a").removeClass("on");
    $(obj).addClass("on");
    $('#pager').sjAjaxPager({
        url: "/tools/user_follow_ajax.ashx?act=reference_list",
        pageSize: 10,
        pageIndex: 1,
        searchParam: { type_id: type_id },
        beforeSend: function () { },
        success: function (data) {
            if (data.total < 1) {
                $('#list_data').html("<tr><td colspan='3'>没有符合条件的记录...</td></tr>");
            } else {
                $("#list_data").html(data.items);
            }
            if (data.total > 10) {
                $("#pager").show();
            }
        },
        complete: function () {
        }
    });
}
//=======================推广用户列表
var reference_list_2 = function (obj, type_id) {
    $(".paytype a").removeClass("on");
    $(obj).addClass("on");
    $('#pager').sjAjaxPager({
        url: "/tools/user_follow_ajax.ashx?act=reference_money_list",
        pageSize: 10,
        pageIndex: 1,
        searchParam: { type_id: type_id },
        beforeSend: function () { },
        success: function (data) {
            if (data.total < 1) {
                $('#list_data').html("<tr><td colspan='4'>没有符合条件的记录...</td></tr>");
            } else {
                $("#list_data").html(data.items);
            }
            if (data.total > 10) {
                $("#pager").show();
            }
        },
        complete: function () {
        }
    });
}

function JPlaceholderFix() {
    //判断浏览器是否支持placeholder属性
    var supportPlaceholder = 'placeholder' in document.createElement('input'),

        placeholder = function (input) {

            var text = input.attr('placeholder'),
                defaultValue = input.defaultValue;

            if (!defaultValue) {

                input.val(text).addClass("phcolor");
            }

            input.focus(function () {

                if (input.val() == text) {

                    $(this).val("");
                }
            });
            input.blur(function () {

                if (input.val() == "") {

                    $(this).val(text).addClass("phcolor");
                }
            });

            //输入的字符不为灰色
            input.keydown(function () {
                $(this).removeClass("phcolor");
            });
        };

    //当浏览器不支持placeholder属性时，调用placeholder函数
    if (!supportPlaceholder) {
        $(':input[placeholder]').each(function () {
            text = $(this).attr("placeholder");
            if ($(this).attr("type") == "text") {
                placeholder($(this));
            }
        });
    }
}