<?php
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');?>
<link rel="stylesheet" type="text/css" href="<?= Url::base()?>/mobile/web/css/LArea.css">
<?php $this->endBlock();?>

<?php $this->beginContent('@app/views/layouts/header2.php');?>
<?php $this->endContent();?>

<!--main-->
<div class="certificate_main">
    <div class="cm_tips red">
        请填写实名认证身份证开户的银行卡，填写正确的银行账号及开户支行，如以上银行信息填写错误会导致提现不到账，如不清楚开户支行信息请拨打银行服务热线咨询。
    </div>
</div>

<form onsubmit="return false;">
    <div class="certificate_form">
        <ul>
            <li>
                <i class="dmfont dm-wode"></i>
                <input type="text" placeholder="开户人姓名" class="cert_name" value="<?= $member['realname']?>">
            </li>
            <li>
                <i class="dmfont dm-shenfenzheng"></i>
                <input type="text" placeholder="身份证号" class="cert_ID" value="<?= $member['cartid']?>">
            </li>
            <li>
                <i class="dmfont dm-shouji"></i>
                <input type="text" placeholder="手机号码" class="cert_phone" value="<?= $member['bank_tel']?>">
            </li>
            <li>
                <i class="dmfont dm-kaihuxing"></i>
                <input type="text" placeholder="开户银行" class="cert_bank" value="<?= $member['bankcode']?>">
            </li>
            <li>
                <i class="dmfont dm-yinhangqiahao"></i>
                <input type="text" placeholder="银行卡号" class="cert_bankCard" value="<?= $member['bankid']?>">
            </li>
            <li>
                <i class="dmfont dm-diqu"></i>
                <input id="cert_area" type="text" readonly="" placeholder="开户行地区" value="<?= $member['bankaddress']?>" class="cert_area"/>
                <input id="value1" type="hidden" value="20,234,504" />
            </li>
            <li class="no_border_bottom">
                <i class="dmfont dm-suoshuzhihang"></i>
                <input type="text" placeholder="所属支行" class="cert_bankZhi" value="<?= $member['bank_branch']?>">
            </li>
        </ul>
    </div>
    <div class="certificate_form_bot">
        <?php if ($member['state'] != 1) : ?>
            <button onclick="certificate()">保存</button>
        <?php else : ?>
            <button  style="background-color: #393D49">已认证</button>
        <?php endif; ?>
    </div>
</form>

<!--main end-->

<script src="<?= Url::base()?>/mobile/web/js/LAreaData1.js"></script>
<script src="<?= Url::base()?>/mobile/web/js/LAreaData2.js"></script>
<script src="<?= Url::base()?>/mobile/web/js/LArea.js"></script>
<script>
    var area1 = new LArea();
    area1.init({
        'trigger': '#cert_area',
        'valueTo': '#value1',
        'keys': {
            id: 'id',
            name: 'name'
        },
        'type': 1,
        'data': LAreaData
    });
    area1.value=[28,0,7];
</script>

<?php $this->beginBlock('footer')?>
<script>
    $(function () {
       var state = '<?= $member['state']?>';
       if (state == 1) {  // 已认证
           $('input').attr('disabled','disabled');
       }
    });
    
    function certificate() {
        var name = $('.cert_name').val();
        var idCard = $('.cert_ID').val();
        var bankTel = $('.cert_phone').val();
        var bank = $('.cert_bank').val();
        var bankNo = $('.cert_bankCard').val();
        var area = $('.cert_area').val();
        var branch = $('.cert_bankZhi').val();
        var _csrf = '<?= Yii::$app->request->csrfToken?>';
        if (!name) {
            layerMsg('开户人姓名不能为空');return;
        }
        if (!IDCARD_TEMP.test(idCard)) {
            layerMsg('身份证号不正确');return;
        }
        if (!TEL_TEMP.test(bankTel)) {
            layerMsg('手机号码不正确');return;
        }
        if (!bank) {
            layerMsg('开户银行不能为空');return;
        }
        if (!BANKNO_TEMP.test(bankNo)) {
            layerMsg('银行卡号不正确');return;
        }
        if (!area) {
            layerMsg('开户行地区不能为空');return;
        }
        if (!branch) {
            layerMsg('所属支行不能为空');return;
        }
        layerLoad();
        $.post('<?= Url::to(['user/certificate'])?>', {name: name, idCard: idCard, bankTel: bankTel, bank: bank,
        bankNo: bankNo, area: area, branch: branch, _csrf: _csrf}, function (res) {
            layer.closeAll();
            layerMsg(res.msg);
            if (res.status === 200) {
                setTimeout(function () {
                    location.href = '<?= Url::to(['index/user'])?>';
                }, 2000)
            }
        }, 'json')
    }
</script>
<?php $this->endBlock()?>
