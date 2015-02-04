$(function(){
	K.create('#editor', {
		width: '600px',
    minWidth: '600px',
		height: '300px',
		items: [
		        'source', '|', 'undo', 'redo', '|', 'preview', 'template', 'code', 'cut', 'copy', 'paste',
		        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
		        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
		        'superscript', 'clearhtml', 'selectall', '/',
		        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
		        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
		        'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'link', 'unlink'
		],
		allowImageUpload: true,
		uploadJson: UPLOAD_URL + '?prefix',
		allowFileManager : false,
		afterUpload: function(url) {
			url = BASE_URL + url;
		}
	});
});
	