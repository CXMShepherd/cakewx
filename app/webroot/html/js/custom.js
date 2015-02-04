/* *************************************** */  
/* Revolution slider */
/* *************************************** */ 

jQuery(document).ready(function() {
	   jQuery('.tp-banner').revolution(
		{
			delay:9000,
			startheight:550,
			
			hideThumbs:10,
			
			navigationType:"none",	
			
			
			hideArrowsOnMobile:"on",
			
			touchenabled:"on",
			onHoverStop:"on",
			
			navOffsetHorizontal:0,
			navOffsetVertical:20,
			
			stopAtSlide:-1,
			stopAfterLoops:-1,

			shadow:0,
			
			fullWidth:"on",
			fullScreen:"off"
		});
});


/* *************************************** */
// One page navigation 
/* *************************************** */

$('.nav').onePageNav({
    currentClass: 'active',
    changeHash: true,
    scrollSpeed: 1000,
    scrollThreshold: 0.1,
    easing: 'swing'
});

/* **************************************************** */
/* Hide navigation menu in reponsiveness after clicking */
/* **************************************************** */  

$(function(){ 
	
	var $navMain = $(".navbar-collapse");

	$(window).resize(function(){
		if($(window).width() <= 765){
			$navMain.on("click", "a", null, function () {
				if(!$(this).hasClass("dd-menu"))
					$navMain.collapse('hide');
			});
		}
	});
});


/* *************************************** */ 
/* Nice Scroll */
/* *************************************** */ 


$("html").niceScroll({
	cursorcolor:"#555",
	cursoropacitymin:0.2,
	cursoropacitymax:0.3,
	cursorwidth:10,
	cursorborder:"0px",
	cursorborderradius:"0px",
	cursorminheight:50,
	zindex:100000,
	mousescrollstep:40
});


/* *************************************** */  
/* Parallax */
/* *************************************** */  

$(document).ready(function(){
	$('.testi-parallax').stellar();
	$('.q1-parallax').stellar();
	$('.q3-parallax').stellar();
});


/* *************************************** */  
/* Isotope */
/* *************************************** */  

var $container = $('#portfolio');

// Initialize isotope
$container.imagesLoaded( function(){
  $container.fadeIn(1000).isotope({
    layoutMode : 'fitRows',
    itemSelector : '.p-element'
  });
});

// Filter items when filter link is clicked

$('#filters a').click(function(){
	var selector = $(this).attr('data-filter');
	$container.isotope({ filter: selector });
	return false;
});  


/* *************************************** */
// Masonry JS
/* *************************************** */

// initialize Masonry
var $box = $('#container').masonry();
// layout Masonry again after all images have loaded
$box.imagesLoaded( function() {
	$box.masonry();
});

/* *************************************** */
/* Blog section image lightbox */
/* *************************************** */

$(document).ready(function() {
	$('.lightbox').magnificPopup({
		type: 'image'
	});
});


/* *************************************** */
/* Works or Portfolio lightbox gallery */
/* *************************************** */

$(document).ready(function() {
	$('.p-hover').magnificPopup({
		delegate: 'a', 
		type: 'image',
		gallery:{
			enabled:true
		}
	});
});

/* *************************************** */
/* About Us */
/* *************************************** */

$('.about-item .about-number').waypoint(function(down) {
	if(!$(this).hasClass("finish"))
	{
		$(this).countTo();
		$(this).addClass('finish');
	}
},{ offset: '80%' });


/* *************************************** */
/* Testimonials */
/* *************************************** */

$('.carousel').carousel();

/* *************************************** */
// GMAP JS
/* *************************************** */

$('#my_map').gMap({
	address: "Rainham Marshes RSPB Nature Reserve, London",
	zoom: 13,
	markers:[
		{
			address: "Rainham Marshes RSPB Nature Reserve, London",
			html: "<h5>Charlie</h5><p>19 Kummy Street<br />Kanchepuram<br />Chennai - 625003</p>",
			popup: true
		}
	]
});


/* *************************************** */
// Scroll to top
/* *************************************** */

$(".totop").hide();

$(function(){
	$(window).scroll(function(){
		if ($(this).scrollTop()>300)
		{
			$('.totop').fadeIn();
		} 
		else
		{
			$('.totop').fadeOut();
		}
	});
	$('.totop a').click(function (e) {
		e.preventDefault();
		$('body,html').animate({scrollTop: 0}, 500);
	});
 });
 
/* *************************************** */
// Animations
/* *************************************** */

/* Service items */

$('.services-item').waypoint(function(down){
	$(this).addClass('animated fadeInUp');
}, { offset: '60%' });

/* Quote one */

$('.quote-one h3').waypoint(function(down){
	$(this).addClass('animated bounceIn');
}, { offset: '60%' });

/* Quote Three */

$('.quote-three h2').waypoint(function(down){
	$(this).addClass('animated bounceIn');
}, { offset: '60%' });

/* About us */

$('.about-w').waypoint(function(down){
	$(this).addClass('animated fadeInUp');
}, { offset: '60%' });

/* Team */

$('.team-member').waypoint(function(down){
	$(this).addClass('animated bounceIn');
}, { offset: '60%' });

/* Clients */

$('.client-item').waypoint(function(down){
	$(this).addClass('animated bounceIn');
}, { offset: '60%' });

/* Contact */

$('.info-item').waypoint(function(down){
	$(this).addClass('animated fadeInUp');
}, { offset: '60%' });