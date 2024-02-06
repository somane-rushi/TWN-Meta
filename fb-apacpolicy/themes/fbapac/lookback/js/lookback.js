jQuery(document).ready(function($){

	// desktop menu
	$('.lookback-menu-toggle').hover(
	  function() {
	    $('#header-menu-desktop-expand').addClass('expanded');
	  }
	);
	$('#header-menu-desktop-expand').on('mouseleave', function() {
		$('#header-menu-desktop-expand').removeClass('expanded');
	});

	// hide home link on homepage
	if ($('.page-template.page-template-page-lookback')[0]) {
		$('.lookback-menu-homelink').hide();
	}

	// hero play video
	$('#play-hero-video').click( function(e){
		e.preventDefault();
		$('#hero-video-modal').addClass('expanded');
		$('#the-hero-video').get(0).play();
	});

	// hero close video
	$('#close-video-modal').click( function(e){
		e.preventDefault();
		$('#hero-video-modal').removeClass('expanded');
		$('#the-hero-video').get(0).pause();
	});

	// by the numbers animation
	$('#by-the-numbers ul.tabs li').hover(function(){
		$('ul.tabs li').removeClass('current');
		$('#by-the-numbers .tab-content-preview .tab-content').removeClass('current');
		var tab_id = $(this).attr('data-tab');
		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	});

	$('.fbcarousel').owlCarousel({
	    loop:true,
	    margin:0,
	    dots: false,
	    nav:true,
	    items:1
	});

	$('.lfcarousel').owlCarousel({
	    loop:true,
	    margin:0,
	    dots: false,
	    nav:true,
	    items:1
	});

	// Burger Menu
	jQuery('.burger-menu').click(function(){
  	jQuery(this).toggleClass('active');	
  	jQuery('.mobile-menu').toggleClass('active');
  });

	// Resize divs w/ same class
	function resize__divs(classname) {
	  var wwidth = jQuery(window).width();
	  if (wwidth > 767) {
	    var divHeight = -1;
	    jQuery('.' + classname).each(function() {
	      divHeight = divHeight > jQuery(this).height() ? divHeight : jQuery(this).height();
	    });
	    jQuery('.' + classname).each(function() {
	      jQuery(this).css( 'min-height', divHeight + 50 );
	    });
	  }
	}

	$(window).scroll(function() {    
	    var scroll = $(window).scrollTop();
	    if (scroll >= 50) {
	     	$(".lookback-header").addClass("scrolling");
	    }
	});

	function which_hero_img(cl){
		if ( $(cl)[0]) {
			var desktopi = $(cl).attr('data-desktop');
			var mobilei  = $(cl).attr('data-mobile');
		}
		if (jQuery(window).width() < 768) {
			$(cl).css("background-image", "url(" + mobilei + ")");
		} else {
			$(cl).css("background-image", "url(" + desktopi + ")");
		}
	}

	which_hero_img('section.hero');
	$(window).resize(function(){
		which_hero_img('section.hero');
	});

	$('.box-column').click(
	  function() {
	    $(this).toggleClass('flip-toggle');
	  }
	);

});