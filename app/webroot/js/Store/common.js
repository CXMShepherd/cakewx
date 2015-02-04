//common.js
function jsTrim(a) {
    return a.replace(/(^\s*)|(\s*$)/g, "")
}
function returnFloat0(a) {
    return a = Math.round(parseFloat(a))
}
function returnFloat1(a) {
    return a = Math.round(10 * parseFloat(a)) / 10, a.toString().indexOf(".") < 0 && (a = a.toString() + ".0"), a
}
function FormatNum(a) {
    if(a == null){ return 0;}
    return a = Math.abs(a.toString().indexOf(".") < 0 ? Math.abs(parseInt(a)) : (Math.round(100 * parseFloat(a)) / 100));
}
function getJsonLength(a) {
    var b = 0;
    for (c in a)
        b++;
    return b
}
function ShowAttention(a) {
    var b, c;
    $("#attention-dialog").html('<p class="attention">' + a + "</p>"),
    $("#attention-dialog").show(), b = $("#attention-dialog").height(),
    c = $(window).height() - 50, $("#attention-dialog").css("top", c / 2),
    $("#attention-dialog").css("margin-top", -b / 2), setTimeout(function() {
        $("#attention-dialog").hide(), $("#attention-dialog").css("top", -1e4)
    }, 1e3);
}
function showLoader(a) {
    $(".ui-mask").show(), $("#loader-dialog").html('<div class="ui-loading"></div><div class="loader-text-layout"><p class="loader-text">' + a + "</p>" + "</div>"), $("#loader-dialog").show();
    var b = $(window).height();
    $("#loader-dialog").css("top", b / 2), $("#loader-dialog").css("margin-top", -50)
}
function ShowProduct(a) {
     $("body").append('<div id="mcover"><div id="productbox" >' + a + "</div></div>");
    var b = $(window).height();
    $("#productbox").css("margin-top", "60px");
}
function hideLoader() {
    $(".ui-mask").hide(), $("#loader-dialog").hide(), $("#loader-dialog").css("top", -1e4)
}
//js全局变量的初始化
if(!window.localStorage) {
    alert("您的浏览器版本过低，不支持本系统，请更新浏览器后重试！");
}
var storage = window.localStorage;

window.addEventListener('push', function(){
    var scriptsList = document.querySelectorAll('script.js-custom');
    for(var i = 0; i < scriptsList.length; ++i) {
        eval(scriptsList[i].innerHTML);
    }
});