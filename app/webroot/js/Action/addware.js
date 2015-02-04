var options = eval($('#LN_options').val());
var options = options ? options : {'text': { 'addText': '添加图文', 'selectText': '选择图文', 'changeText': '更换图文' }, 'simple': 1};
(function($) {
    if (!$.outerHTML) {
        $.extend({
            outerHTML: function(ele) {
                var $return = undefined;
                if (ele.length === 1) {
                    $return = ele[0].outerHTML;
                }
                else if (ele.length > 1) {
                    $return = {};
                    ele.each(function(i) {
                        $return[i] = $(this)[0].outerHTML;
                    })
                };
                return $return;
            }
        });
        $.fn.extend({
            outerHTML: function() {
                return $.outerHTML($(this));
            }
        });
    }
})(jQuery);

$(document).ready(function() {
    var tempdata = $("#FPreTwj").val().split(',');
    var com = '', s = '';
    $.each(tempdata, function(index, value) {
        s += com + '"'+value+'"';
        com = ',';
    });
    var pdata = 'ids=['+s+']';

    $(".u-chooses").parent().show();
    $("#addTw").show();
    $.ajax({
        url: ADMIN_WC_URL + "mPic?_a=getTwj",
        async: false,
        data: pdata,
        type: 'POST',
        success: function(data, status) {
			var jdata = JSON.parse(data);
			$("#aj_box").html(jdata);
			$("#aj_box .media_preview_area").each(function(key, val) {
				var t_id, t_form;
	            t_id = $(this).attr('id');
	            t_form = $("#t_form").val();
	            t_form = t_form ? t_form : 'WxDataKds';
				$(this).append("<input type=\"hidden\" name=\"data[" + t_form + "][FTwj][]\" value=\"" + t_id +"\" />");
				
			});
			$(".u-chooses").html($("#aj_box").html());
			$("#aj_box").html("");
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
});
/*
$("#addTw").on("click", function() {
    var url = options.simple ? ADMIN_WC_URL + "mPic?_a=twj" : ADMIN_WC_URL + "mPic?_a=twj&_val=multi";
    $.ajax({
        url: url,
        async: false,
        type: 'POST',
        success: function(data, status){
            $("#aj_box").html(JSON.parse(data));
            bootbox.dialog({
                message: $("#ajcont").html(),
                title: options.text.selectText,
                buttons: {
                    success: {
                        label: "确定",
                        className: "btn-primary",
                        callback: function() {
                            //console.log(Atempids);
                            var selehtm = '',tmpid;
                            $.each(Atempids, function(key,val) {
                                var t_id = $('#'+val).attr('id');
                                tmpid = t_id;
                                var t_form = $("#t_form").val();
                                t_form = t_form ? t_form : 'WxDataKds';
                                $('#'+val).append("<input type=\"hidden\" name=\"data[" + t_form + "][FTwj][]\" value=\"" + t_id +"\" />");
                                selehtm += $('#'+val).outerHTML() + "&nbsp;";
                            });
                            $(".u-chooses").empty();
                            $(".u-chooses").prepend(selehtm);
                            $(".u-chooses").find(".com_mask, .icon_item_selected").remove();
                            $("#addTw").text(options.text.changeText);
                            $("#FPreTwj").attr("value", tmpid);
                        }
                    },
                }
            });
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
});
*/
function prebootbox(event) {
    var data = [],editid;
    var purl = '',swnode = $(this).parent().parent().parent();
    editid = swnode.attr("id");//修改id传入，更新id列表
    purl = event.data.atype == "switem" ?  ADMIN_WC_URL + "mPic?_a=twj&_val=multi" : ADMIN_WC_URL + "mPic?_a=twj";
    tmptype = event.data.atype;
    $.ajax({
        url: purl,
        async: false,
        type: 'POST',
        data : data,
        success: function(data, status){
            $("#aj_box").html(JSON.parse(data));
            bootbox.dialog({
                message: $("#ajcont").html(),
                title: options.text.selectText,
                buttons: {
                    success: {
                        label: "确定",
                        className: "btn-primary",
                        callback: function() {
                            var selehtm = '',comm = '', t_ids, tempids;
                            $.each(Atempids, function(key,val){
                                var t_id, t_form;
                                t_id = $('#'+val).attr('id');
                                t_form = $("#t_form").val();
                                t_ids = t_id + comm;
                                t_form = t_form ? t_form : 'WxDataKds';
                                if(!$('#'+val).find(":input").length) {
                                    $('#'+val).append("<input type=\"hidden\" name=\"data[" + t_form + "][FTwj][]\" value=\"" + t_id +"\" />");
                                    selehtm += $('#'+val).outerHTML() + "&nbsp;";
                                } else {
                                    selehtm += $('#'+val).outerHTML();
                                }
                                comm = ',';
                            });
                            $("#addTw").text(options.text.changeText);
                            $("#FPreTwj").attr("value", t_ids);
                            if(tmptype == "switem"){
                                $("#addTw").prev().append(selehtm);
                                $(".icon_item_selected").html("<span class='delitem'>删除</span><span class='pipe'>|</span><span class='editem'>修改</span>");
                            } else {
                                $(".icon_item_selected").html("<span class='delitem'>删除</span><span class='pipe'>|</span><span class='editem'>修改</span>");
                                swnode.replaceWith(selehtm);
                            }
                        }
                    }
                }
            });
        },
        error: function(){
            bootbox.alert("系统出错。");
        }
    });
}

// 更换图文集
$(document).on("click","#addTw",{atype:"switem"}, prebootbox);
$(".u-chooses").on("click",".editem",{atype:"editem"}, prebootbox);
$(".u-chooses").on("click",".delitem", function() {
    var delbox = $(this).parent().parent().parent();
    delbox.remove();
});