jQuery(document).ready(function() { 
	var owl = $('.sucess-slider');
    owl.owlCarousel({
		loop: true,
		autoplay: false,
        margin: 0,
        nav: false,
        dots: true,
        dotsData: true,
        navText: ['', ''],
		transitionStyle : "fade",
		animateIn: 'flipIn',
        responsive: {
			0: {
				items: 1
			},
			480: {
				items: 1
			},
			767: {
				items: 1
			},
			1000: {
				items: 1
			}
		}
	});
    owl.on('mousewheel', '.owl-stage', function(e) {
		if (e.deltaY > 0) {
			owl.trigger('next.owl');
		} else {
			owl.trigger('prev.owl');
		}
		e.preventDefault();
	});
	$( '.owl-dot' ).on( 'click', function() {
		owl.trigger('to.owl.carousel', [$(this).index(), 300]);
		$( '.owl-dot' ).removeClass( 'active' );
		$(this).addClass( 'active' );
	});
	
}); 

jQuery(function($) {
	'use strict';
    document.getElementsByTagName('html')[0].className += ' ' +(~window.navigator.userAgent.indexOf('MSIE') ? 'ie' : 'no-ie');
	var $example = $('#example');
	var $frame = $example.find('.frame');
	window.frr = $frame;
	var sly = new Sly($frame, {
		horizontal: 1,
		itemNav: 'basic',
		activateMiddle: 0,
		smart: 1,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 0,
		scrollBar: $example.find('.scrollbar'),
		scrollBy: 1,
		speed: 500,
		moveBy: 500,
		elasticBounds: 1,
		dragHandle: 1,
		dynamicHandle: 1,
	}).init();
});
		

    