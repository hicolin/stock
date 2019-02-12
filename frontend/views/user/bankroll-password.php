<?php
use yii\helpers\Url;
?>

<link href="<?=Url::base()?>/frontend/web/xnn/css/layout.css-v=20180102.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/personal.css-v=20171204.css" rel="stylesheet" />
<link href="<?=Url::base()?>/frontend/web/xnn/css/index.css-v=20171204.css" rel="stylesheet" />
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/jquery/jquery-1.11.2.min.js"></script>
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layer.js"></script>

<div class="clearborth"></div>

<div class="nbody">
    <div class="nw1000">
        <!--member-left-->
        <?php $this->beginContent('@app/views/layouts/member-left.php')?>
        <?php $this->endContent()?>
        <!--end left-->
        <div class="nrightmore">
            <div class="zhsz">
                <h5><a href="<?=Url::toRoute(['user/revisepassword'])?>" style="background-color: #ddd; color: #777;">登录密码</a><a href="javascript:;" >交易密码</a></h5>
                <div class="jbzl">
                    <form method="post" id="form1" autocomplete="off">
                        <div class="jbzlcon">
                            <dl>
                                <label>密码</label><input id="pwd1" name="newPwd1" class="ztxt" type="password" value="" />
                            </dl>
                            <dl>
                                <label>确认密码</label><input id="pwd2" name="newPwd2" class="ztxt" type="password" value="" />
                            </dl>
                            <div class="xxtj">
                                <input type="button" value="保存" onclick="change()" id="subChange" /><span>所有资料均会严格保密。</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearborth"></div>
<!--foot-kefu-->
<div class="foot-kefu" style="display: none;">
    <div class="main f-clear">
        <div class="fl foot-kefu-tit">
            <strong>客服中心</strong>
            <p>service</p>
        </div>

    </div>
</div>
<!-- foot -->

<script src="<?=Url::base()?>/frontend/web/xnn/scripts/layout.js"></script>

<link href="<?=Url::base()?>/frontend/web/xnn/scripts/dialog/ui-dialog.css" rel="stylesheet" />
<script src="<?=Url::base()?>/frontend/web/xnn/scripts/dialog/dialog-min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#user").addClass("now");
        $("#pwd").addClass("ada");
        $("#pwd").parent().parent().css("display", "block");
        $("#pwd").parent().parent().prev().addClass("currentDd currentDt");
        $(".subNav").click(function () {
            $(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd")
            $(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt")
            // 修改数字控制速度， slideUp(500)控制卷起速度
            $(this).next(".navContent").slideToggle(500).siblings(".navContent").slideUp(500);
        });
    });
</script>
<script>
    function change() {
        var pwd1 = $('#pwd1').val();
        var pwd2 = $('#pwd2').val();
        if(pwd1=='') {
            layer.tips("请输入提现密码", "#pwd1", {tips:3,time:2000});
            return false;
        }else if(!(/^[a-z0-9]{6,10}$/g).test(pwd1)) {
            layer.tips('请输入正确的的提现密码', "#pwd1", {tips:3,time:2000});
            return false;
        }else if(pwd1!=pwd2) {
            layer.tips('两次输入的密码不一样', "#pwd2", {tips:3,time:2000});
            return false;
        }

        $.ajax({
            url  : "<?= Url::toRoute($this->context->id . '/bankroll-password')?>",
            type : 'post',
            data : {'pwd1':pwd1,'pwd2':pwd2},
            dataType:'text',
            success:function(data){
                if(data==300){
                    layer.tips('请输入正确的提现密码', '#pwd1', {tips:3,time:2000});
                    return false
                }else if(data==400){
                    layer.tips('两次密码不一样', '#pwd2', {tips:3,time:2000});
                    return false
                }else if(data==100){
                    layer.msg('修改成功',{time:3000},function(){

                        top.location.href ="<?=Url::toRoute('user/index')?>";

                    })
                }
            }
        });
    }
</script>
<div class="kefu">
    <ul>

        <li class="l3" style="display: none;">
            <a href="javascript:;"></a>
            <div class="hide3">
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><span>客服一</span><br/><i></i></a><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=&amp;site=qq&amp;menu=yes" target="_blank"><span>qq交流群</span><br/><i></i></a>
            </div>
        </li>
        <li class="l4"><a href="#page1" id="scrollTop"></a></li>
    </ul>
</div>
</body>
</html>
