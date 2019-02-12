$(function () {

});

/**
 * 头像上传流程step4/4
 * 1.引入ajaxupload.js： <script type="text/javascript" src="__JS__/ajaxupload.js"></script>
 * 2.html图片预览及上传按钮：
 * <img id="avatar" src="{:get_user_avatar($user_info['id'],"middle")}" />
 * <label class="fileupload" onclick="upd_file(this,'avatar_file',{$user_info.id});">
 * <input type="file" style="cursor:pointer;" class="zfle" name="avatar_file" id="avatar_file"/>
 * </label>
 * <label class="fileuploading hide" ></label>
 * 3.上传触发事件js函数定义：function upd_file(obj,file_id,uid) ..
 * 4.上传服务端php处理：U("Index/Avatar/upload")
 *
 * @param obj
 * @param file_id
 * @param uid
 */
//头像上传step1/3
function upd_file(obj, file_id, uid) {
    $("input[name='" + file_id + "']").bind("change", function () {
        $(obj).hide();
        $(obj).parent().find(".fileuploading").removeClass("hide");
        $(obj).parent().find(".fileuploading").removeClass("show");
        $(obj).parent().find(".fileuploading").addClass("show");
        $.ajaxFileUpload
		(
			{
			    url: "/tools/upload_ajax.ashx?action=mobileupload&file_id=" + file_id + "&IsThumbnail=1",
			    secureuri: false,
			    fileElementId: file_id,
			    dataType: 'json',
			    success: function (data, status) {
			        $(obj).show();
			        $(obj).parent().find(".fileuploading").removeClass("hide");
			        $(obj).parent().find(".fileuploading").removeClass("show");
			        $(obj).parent().find(".fileuploading").addClass("hide");
			        if (data.status == 1) {
			            document.getElementById("avatar").src = data.thumb + "?r=" + Math.random();
			        }
			        else {
			            alert(data.msg);
			        }
			    },
			    error: function (data, status, e) {
			        $(obj).show();
			        $(obj).parent().find(".fileuploading").removeClass("hide");
			        $(obj).parent().find(".fileuploading").removeClass("show");
			        $(obj).parent().find(".fileuploading").addClass("hide");
			    }
			}
		);
        $("input[name='" + file_id + "']").unbind("change");
    });
}