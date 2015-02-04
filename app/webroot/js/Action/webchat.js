$(function(){
	
	// BootBox
	$(".bootbox-confirm").on(ace.click_event, function() {
		var url = $(this).attr('alt');
		bootbox.confirm("确定要删除么？", function(result) {
			if(result) {
				location.href= url;
			}
		});
	});
	
	$('#WX_code').click(function() {
		var iconCode = $(this).parent().find(".iconCode");
		var iconCodeLogo = $("#WX_codeLogo").val();
		var iconCodeUrl = $("#WX_codeUrl").val();
		var apiUrl = "http://qr.liantu.com/api.php?w=1000&text=" + iconCodeUrl + "&logo=" + iconCodeLogo;
		iconCode.html("<img width='300' src='" + apiUrl + "' />");
	});
	
	KindEditor.ready(function(K) {
		var editor = K.editor({
			uploadJson: UPLOAD_URL,
			allowFileManager : true,
		});
		K('#WX_icon').click(function() {
			var iconText = $('#WX_icon').parent().find('input');
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : iconText.val(),
					clickFn : function(url, title, width, height, border, align) {
						iconText.val(url);
						editor.hideDialog();
					}
				});
			});
		});
		K('#WX_iconSec').click(function() {
			var iconText = $('#WX_iconSec').parent().find('input');
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : iconText.val(),
					clickFn : function(url, title, width, height, border, align) {
						iconText.val(url);
						editor.hideDialog();
					}
				});
			});
		});
		K('#WX_img').click(function() {
			var iconText = $('#WX_img').parent().find('.iconText');
			var iconPreview = $('#WX_img').parent().find('.iconPreview');
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : iconText.val(),
					clickFn : function(url, title, width, height, border, align) {
						iconText.val(url);
						iconPreview.html("<img src='" + BASE_URL + url +"' width='320' />")
						editor.hideDialog();
					}
				});
			});
		});
		K('#WX_selectMultiImage').click(function() {
			var iconText = $('#WX_selectMultiImage').parent().find('.iconText');
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(urlList) {
						var div = K('#WX_imageView');
						var html = "";
						var imgvals = "";
						div.html('');
						K.each(urlList, function(i, data) {
							html = html + '<img width="320" height="120" src="' + BASE_URL + data.url + '">&nbsp;&nbsp;&nbsp;';
						});
						div.html(html);
						iconText.each(function(i) {
							$(this).val(urlList[i].url);
						});
						editor.hideDialog();
					}
				});
			});
		});			// 批量上传
	});
});