
/*
** FancyBox
*/
jQuery(document).ready(function($) {
	$(".fancybox").fancybox();
});

/*
** Masonry
*/
jQuery(document).ready(function($) {

	var $container = $('.gallery');
	  
	$container.imagesLoaded( function(){
		$container.masonry({
			itemSelector : 'dl.gallery-item'
		});
	});
  
});

/*
** Responsive Menu
*/
jQuery(document).ready(function($) {
	$('.openresponsivemenu').click(function() {
		$('.container-menu').toggleClass("responsivemenu");
	});
});
