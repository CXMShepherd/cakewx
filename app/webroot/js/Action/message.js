$(function(){
	$('#phoneMessage').click(function() {
		var phonenumber = $("#WXFPhoneNumber").val();
		if (phonenumber) {
			var pdata = new Object();
			pdata.phonenumber = phonenumber;
			pdata = JSON.stringify(pdata);
			$.ajax({
	            url: BASE_URL + "api/message",
	            async: false,
	            data: pdata,
				type: 'POST',
	            success: function(data, status){
					alert(data.msg);
	            },
	            error: function(){
	                alert("系统出错");
	            }
	        });
		} else {
			alert('请输入测试手机号');
		}
	});
});