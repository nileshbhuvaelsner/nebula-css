// Small misc functions not worth creating another file for.
var $ = jQuery.noConflict();

//Get window width
var window_widht = $(window).width();

/* Script on ready
------------------------------------------------------------------------------*/
$( document ).ready( function() {
	//do jQuery stuff when DOM is ready

	//Home hero slider
	$('.home-hero-slider').slick({
		slidesToShow: 1,
		infinite: true,
		dots: false,
		arrows: false,
		autoplay: true,
		// fade: true,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 1,
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});
} );

/* Script on load
------------------------------------------------------------------------------*/
$( window ).on( 'load', function() {
	// page is fully loaded, including all frames, objects and images
} );

/* Script on scroll
------------------------------------------------------------------------------*/
$( window ).on( 'scroll', function() {
} );

/* Script on resize
------------------------------------------------------------------------------*/
$( window ).on( 'resize', function() {
} );

/* Script all functions
------------------------------------------------------------------------------*/

// Search ajax call delay script
(function($){
	$.fn.extend({
		donetyping: function(callback,timeout){
			timeout = timeout || 1e3; // 1 second default timeout
			var timeoutReference,
				doneTyping = function(el){
					if (!timeoutReference) return;
					timeoutReference = null;
					callback.call(el);
				};
			return this.each(function(i,el){
				var $el = $(el);
				$el.is(':input') && $el.on('keyup keypress paste',function(e){
					if (e.type=='keyup' && e.keyCode!=8) return;
					if (timeoutReference) clearTimeout(timeoutReference);
					timeoutReference = setTimeout(function(){
						doneTyping(el);
					}, timeout);
				}).on('blur',function(){
					doneTyping(el);
				});
			});
		}
	});
})(jQuery);


// Header sticky on scroll script
// var main_header     = document.getElementById("main_header");
// var page    		= document.getElementById("page");
// var sticky      	= main_header.offsetTop;
// var mobile_menu     = document.getElementById("mbnav__state");

// function headerStickyFunction() {
// 	if (window.pageYOffset >= (sticky + 1)) {
// 		main_header.classList.add("sticky");
// 		page.classList.add("scrolled");
// 		//mobile_menu.classList.add("sticky");
// 	} else {
// 		main_header.classList.remove("sticky");
// 		page.classList.remove("scrolled");
// 		//mobile_menu.classList.remove("sticky");
// 	}
// }