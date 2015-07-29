// (function(Slider) {
//     Slider.prototype.initAnimation = function() {
//         var $apply = $(".js-agreement"),
//             startSlideAnimation = function(swiper) {
//                 var $activeSlide = $(swiper.activeSlide());
//                 $activeSlide.children().removeClass("hide");
//             },
//             hideAllSlideAnimation = function(swiper) {
//                 var $activeSlide = $(swiper.activeSlide());
//                 for (var i = 0, l = swiper.slides.length; i < l; ++i) {
//                     $(swiper.slides[i]).children().addClass("hide");
//                 }
//             },
//             hideApplyAnimation = function() {
//                 $apply.children().addClass("hide");
//             };

//         this.swiper.addCallback("FirstInit", function(swiper) {
//             setTimeout(function() {
//                 startSlideAnimation(swiper);
//             }, 300);
//         });

//         this.swiper.addCallback("SlideReset", function(swiper, direction) {
//             startSlideAnimation(swiper);
//         });

//         this.swiper.addCallback("SlideChangeEnd", function(swiper, direction) {

//             $(swiper.slides[2]).on("touchmove mousewheel mousemove",function(e){
//                 e.preventDefault();
//                 e.stopPropagation();
//             });
//             hideAllSlideAnimation(swiper);
//             hideApplyAnimation();
//             startSlideAnimation(swiper);
//         });

//         hideAllSlideAnimation(this.swiper);
//     };
// })(MobileSlider);

// $(function() {
//     if ($("body").height() > 1000) {
//         $("body").addClass("gt1000");
//     }
//     var $powerScroll = $(".js-power-scroll");
//     // new tab at pc
//     if (!/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())) {
//         $powerScroll.find("a").attr("target", "_blank");
//     }
//     $powerScroll.find(".js-select").each(function(){
//         var that = $(this);
//     });

//     $powerScroll.on("click",".slide-choose .ui-teacher-list li",function(){
//         // ajax ..
//         // swiper.appendSlide("") ...
//         // swiper.swipeNext() ...
//     });
//     $powerScroll.on("click",".js-share",function(){
//         // ajax ..
//         // swiper.appendSlide("") ...
//         // swiper.swipeNext() ...
//     });
//      $powerScroll.on("click",".ui-alert",function(){
//         $(this).hide();
//         $(".zeo").show();
//         $(".huizhang").show();
//     });   
//      $powerScroll.on("click",".ui-alert .icon",function(){
//         $(this).hide();
//         $(this).parent().hide();
//         $(".zeo").show();
//         $(".huizhang").show(5000);
        
//     });
//     $powerScroll.on("click",".share",function(){
//         $(".gray_bg").show();
//         $(".share_bg").show();
//      });
//     $(".gray_bg").on("click",function(){
//         $(this).hide();
//         $(".share_bg").hide(5000);
//     })
//     $powerScroll.on("click",".receive",function(){
//         $(this).html("领取成功");
//     })
//     $powerScroll.on("change","input[type='file']",function(){
//         var parent = $(this).closest(".picture-uploader");
//         var preview = parent.find(".picture-preview");
//         var opts = {
//             maxSize : 10240
//         };
//         //支持html5的浏览器,比如高版本的firefox、chrome、ie10
//         if (this.files && this.files[0]) {
//             if (!sizeCheck(this.files[0].size)) {
//                 return false;
//             }
//             var reader = new FileReader();
//             reader.onload = function (e) {
//                 callback(e.target.result);
//             };
//             reader.readAsDataURL(this.files[0]);

//         }

//         function sizeCheck(imageSize){
//             if( (imageSize/1024) > opts.maxSize) {
//                 alert('图片大小不能超过'+opts.maxSize+'K');
//                 return false;
//             }else{
//                 return true;
//             }
//         }
//         function callback(image){
//             preview.css("background-image","url("+ image +")");
//         }
//     });
//     $powerScroll = null;
// });
// var myiScroll;
// function loaded(){
//     // myiScroll = new IScroll('#group_scroll',{
//     //     mouseWheel: true,
//     //     click: true
//     // });
// }
  
$(function(){
    $(".js-share").on("click",function(){
        $("#jiesuo")[0].play();
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
    });
    $(".ui-choose-teacher").on("webkitAnimationStart", function() {
        $("#message")[0].play();
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
        $(this).html("领取成功");
        $(".suss").show();
    })
});
window.onload=function(){
    var today=new Date();
    var hour=today.getHours();
    var minu=today.getMinutes();
    if(hour<10)hour="0"+hour;
    if(minu<10)minu="0"+minu;
    var js_time =document.getElementById("js_times");
    var weekday=new Array(7);
    var today_box= document.getElementById("today");
    var month_box = document.getElementById("month");
    var month = today.getMonth();
    var date = today.getDate();
    weekday[0]="星期日";
    weekday[1]="星期一";
    weekday[2]="星期二";
    weekday[3]="星期三";
    weekday[4]="星期四";
    weekday[5]="星期五";
    weekday[6]="星期六";
    today_box.innerHTML=weekday[today.getDay()];
     js_time.innerHTML=hour+":"+minu;
    month_box.innerHTML = month+"月"+date+"日";
} 


