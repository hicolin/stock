const TEL_TEMP = /^1[3-9]\d{9}$/;
const IDCARD_TEMP = /^\d{18}|\d{17}x$/i;
const BANKNO_TEMP = /^([1-9]{1})(\d{14,18})$/;
const CODE_TEMP = /^\d{4}$/;
const SMS_URL = '/index/send-sms';

function layerMsg(content,time){
    time = time || 2;
    layer.open({
        content: content,
        skin: 'msg',
        time: time
    })
}

function layerLoad() {
    layer.open({
        type: 2,
        shadeClose: false
    })
}

function sendSms() {
    var tel = $('.send-tel').val();
    if (!TEL_TEMP.test(tel)) {
        layerMsg('手机号码不正确');
        return;
    }
    layer.open({type: 2, shadeClose: false});
    layerLoad();
    $.get(SMS_URL, {tel: tel}, function (res) {
        layer.closeAll();
        if (res.status === 200) {
            countDown();
        }
        layerMsg(res.msg);
    }, 'json')
}

function countDown() {
    var oCode = $('.send-code');
    var count = 60;
    var timer = setInterval(function () {
        if (count > 0) {
            count--;
            oCode.html(count + ' S ').removeAttr('onclick').css({color: 'red'});
        } else {
            clearInterval(timer);
            oCode.html('获取验证码').attr('onclick', 'sendSms()').css({color: '#3b87f1'});
        }
    }, 1000)
}

