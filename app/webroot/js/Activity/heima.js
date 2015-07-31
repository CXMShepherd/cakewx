
$(function(){
    // $(".js-share").on("click",function(){
    //     $("#jiesuo")[0].play();
    // });
        $("#editForm").Validform({
            tiptype:3
        });

     $(".ui-alert").on("click",function(){
        $(this).hide();
        $(".zeo").show();
        $(".huizhang").show();
        $("#message")[0].play();
    });
     $(".ui-alert .icon").on("click",function(){
        $(this).hide();
        $(this).parent().hide();
        $(".zeo").show();
        $(".huizhang").show();
        $("#message")[0].play();
        var top = $(".huizhang").offset().top;
        $("#swiper-wrapper").animate({scrollTop:top+1000},1000);
    });
    // $(".ui-choose-teacher").each(function(){
    //     var that =$(this);
    //     that.on("webkitAnimationStart", function() {
    //         $("#message")[0].play();
    //     });
    // });
     $(".ui-choose-teacher").on("webkitAnimationStart", function(e) {
        $("#message" + ($(e.target).index() + 1))[0].play();
    });
    $(".share").on("click",function(){
        $(".gray_bg").show();
        $(".share_bg").show();
     });
    $(".gray_bg").on("click",function(){
        $(this).hide();
        $(".share_bg").hide();
    });
    $(".receive").on("click",function(){
        // $(this).html("领取成功");
        $(".gray_bg").show();
        $(".share_bg").show();
    });
    $("#shareout").on("click",function(){
        $(".gray_bg").show();
        $(".share_bg").show();
     });
    $(".gray_bg").on("click",function(){
        $(this).hide();
        $(".share_bg").hide();
    });


    var today=new Date();
    var hour=today.getHours();
    var minu=today.getMinutes();
    if(hour<10)hour="0"+hour;
    if(minu<10)minu="0"+minu;
    var js_time =$("#js_times");
    var jsTime =$("#js_time");
    var weekday=new Array(7);
    var today_box= $("#today");
    var month_box = $("#month");
    var month = today.getMonth()+1;
    var date = today.getDate();
    weekday[0]="星期日";
    weekday[1]="星期一";
    weekday[2]="星期二";
    weekday[3]="星期三";
    weekday[4]="星期四";
    weekday[5]="星期五";
    weekday[6]="星期六";
    today_box.html(weekday[today.getDay()]);

     js_time.html(hour+":"+minu);
    jsTime.html(hour+":"+minu);

    month_box.html(month+"月"+date+"日");
});




