function which_hero_img(cl){
	if ( jQuery(cl)[0]) {
		var desktopi = jQuery(cl).attr('data-desktop');
		var mobilei  = jQuery(cl).attr('data-mobile');
	}
	if (jQuery(window).width() < 500) {
		jQuery(cl).css("background-image", "url(" + mobilei + ")");
	} else {
		jQuery(cl).css("background-image", "url(" + desktopi + ")");
	}
}

jQuery(document).ready(function($) {

	if ( $('.page-banner')[0] ) {
		var imgtype = $('.page-banner').attr('data-imgtype');
		if (undefined !== imgtype) {
			if ('light' == imgtype) {
				$('.header-inner-bottom-logo').addClass('lighter-img');
				$('.main-header .header-container .header-inner .header-menu ul li a').addClass('lighter-img');
			}
		}
	}

	// deselect radio button in module search section
	$(document).on("click", "input[name='module']", function(){
		thisRadio = $(this);
		if (thisRadio.hasClass("Checked")) {
			thisRadio.removeClass("Checked");
			thisRadio.prop('checked', false);
		} else { 
			thisRadio.prop('checked', true);
			thisRadio.addClass("Checked");
		};
	})

	// sidebar (download)
	$('.download--resources-guidelines').click(function(e){
		e.preventDefault();
		var which = $(this).attr('data-which');
		var selected = [];
		$('#' + which + ' input:checked').each(function() {
		  selected.push( $(this).attr('data-num') );
		});
		$.each( selected, function( i, v ){
			var tid = '#' + which + '-download-' + v;
			if ( $(tid)[0] ) {
				$(tid)[0].click();
			}
		});
	});

	// sidebar (print)
	$('.print--resources-guidelines').click(function(e){
		e.preventDefault();
		var href = $(this).attr('data-which');
		if ('' !== href && undefined !== href) {
			var w = window.open( href, '_blank' ); 
			w.print(); 
		}
	});

	// main content (download, resources pg only)
	$('.downloadall').click(function(e){
		e.preventDefault();
		var which = $(this).attr('data-which');
		if ( $(window).width() > 767 ) {
			$('.' + which).each(function() {
			  $(this)[0].click();
			});
		} else {
			$('.mobile-' + which).each(function() {
			  $(this)[0].click();
			});
		}
	});

	// main content (print, resources pg only)
	$('.printall').click(function(e){
		e.preventDefault();
		var href = $(this).attr('data-which');
		if ('' !== href && undefined !== href) {
			var w = window.open( href, '_blank' ); 
			w.print(); 
		}
	});

	// main content (print, resources pg only)
	$('.print--now').click(function(e){
		e.preventDefault();
		var href = $(this).attr('href');
		if ('' !== href && undefined !== href) {
			var w = window.open( href, '_blank' ); 
			w.print(); 
		}
	});

	// featured module section (homepage)
	function ul_lis_same_height() {
		if ( $('.feature-module-desc-inner')[0] ) {
			maxHeight = 10;
			$('.feature-module-desc-inner ul li').each(function(){
		   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
			});
			$('.feature-module-desc-inner ul li').height(maxHeight);
		}
	}
	ul_lis_same_height();
	$(window).on('resize', function(){
		ul_lis_same_height();
	});

	$('.collapsable-title').click(function(e){
		e.preventDefault();
		var the_id = $(this).attr('data-which');
		if ( $(this).hasClass('closed') ) {
			$(this).removeClass('closed');
		} else {
			$(this).addClass('closed');
		}
		if ( $('#' + the_id).hasClass('collapsed') ) {
			$('#' + the_id).removeClass('collapsed');
		} else {
			$('#' + the_id).addClass('collapsed');
		}
		
	});

	if ( $('#steering-committee')[0]) {

		$('.full-profile').fadeOut(1);

		$('.open-a-member').click( function(e){
			e.preventDefault();
			$('.full-profile').removeClass('displayed').fadeOut(1);
			var which = $(this).attr('data-which');
			$('#' + which).addClass('displayed displayed-desktop').fadeIn(1000);
		});

		$('.modal-close-btn').click( function(e){
			e.preventDefault();
			$('.full-profile').removeClass('displayed').fadeOut(1);
		});

		function display_c_profiles_mobile(){
			if ( $(window).width() < 768 ) {
				$('.full-profile').addClass('displayed is-mobile').fadeIn(1);
			} else {
				$('.full-profile').each(function(i, obj) {
					$(this).removeClass('is-mobile');
					if ( !$(this).hasClass('displayed-desktop') ){
						$(this).fadeOut(1);
					}
				});
			}
		}
		display_c_profiles_mobile();
		$(window).on('resize', function(){
			display_c_profiles_mobile();
		});		

	}

	$('.highlighted .inner ul li').each( function(){
    $(this.firstChild).wrap('<span></span>');
  });

});


jQuery(window).load(function(){

	jQuery('.header-inner-bottom-right ul li.menu-item-has-children').mouseenter(function(){
		jQuery('#page').addClass('nav-sub-menu-on');
	});
	
	jQuery('.header-inner-bottom-right ul li.menu-item-has-children').mouseleave(function(){
		jQuery('#page').removeClass('nav-sub-menu-on');
	});
	
	jQuery('.featured-carousel-init').owlCarousel({
    loop:false,
    margin:20,
    nav:true,
    responsive:{
        0:{
            items:1,
			margin:0
        },
        600:{
            items:3,
			margin:10
        },
        1000:{
            items:4
        }
    }
	});
	
	jQuery('ul.featured-carousel-nav-init li').click(function(){
		var index = jQuery(this).index();
		jQuery('ul.featured-carousel-nav-init li').removeClass('current');
		jQuery(this).addClass('current');
		jQuery('.featured-carousel-panes').removeClass('active');
		jQuery('.featured-carousel-panes').eq(index).addClass('active');
		return false
	});

	jQuery('#featured-carousel-nav-select').change(function(){
		var selected = jQuery('#featured-carousel-nav-select option:selected');
		var index    = jQuery(selected).attr('data-index') ? parseInt( jQuery(selected).attr('data-index') ) : 0;
		jQuery('.featured-carousel-panes').removeClass('active');
		jQuery('.featured-carousel-panes').eq(index).addClass('active');
		return false
	});

	jQuery('.floated-tab').click(function(){
		
		jQuery(this).toggleClass('current');
		
		if(jQuery(this).hasClass('current')){
			
			jQuery('.floated-tab-panes').hide();
			jQuery('.floated-tab').removeClass('current');
			
			jQuery(this).addClass('current');
			
			var activeTab = jQuery(this).attr("dataId"); 
			jQuery("#"+activeTab).show();
			
		}else if(!jQuery(this).hasClass('current')){
			jQuery(this).removeClass('current');
			jQuery('.floated-tab-panes').hide();
			jQuery('.floated-tab').removeClass('current');
		}
		
	});

	//sticky menu
	jQuery('.sticky-menu span').click(function(){
		jQuery(this).toggleClass('active');
		jQuery('.sticky-menu ul').toggleClass('current');
	});

	// Mega Menu	
	jQuery("#header-main > li.menu-item.menu-item-has-children a").click( function(e){
		var closest_ul = jQuery(this).closest('ul');
		if ( ! jQuery(closest_ul).hasClass('sub-menu') ) {
			e.stopPropagation();
			e.preventDefault();
			jQuery("#header-main").removeClass('active-menu');
			jQuery("#header-main li").removeClass('menu-hover');
			jQuery(".sub-menu").css({"height":0}).removeClass('active');
			jQuery('#the--menu--blur').removeClass('active');
			jQuery('body').removeClass('no--scroll');
			var item_pos  = jQuery(this).position();
			var item_left = item_pos.left;
			jQuery("#header-main").removeClass('active-menu');
			var the_li = jQuery(this).parent('li');
			jQuery("#header-main").addClass('active-menu');
			var sub_menu = jQuery(".sub-menu", the_li);
			var li_num = parseInt( jQuery("li", sub_menu).length );
			var li_diff = li_num - 2;
			var sub_menu_height = parseInt( 100 + (li_diff * 45) );
			if (sub_menu_height < 100 ) {
				sub_menu_height = 100;
			}
			jQuery(sub_menu).css({"left":item_left,"height":sub_menu_height}).addClass('active');
			jQuery('.mega-button').addClass('active');
			jQuery('#the--menu--blur').addClass('active');
			jQuery('body').addClass('no--scroll');
		}
	});
	// Added no_submenu class for header main menu
	jQuery("#header-main li.menu-item.no_submenu a").hover( function(e){
		e.stopPropagation();
		close_the_main_menu()
	});
	// close btn
	jQuery(".mega-button").on("click",function(e){
		e.stopPropagation();
		e.preventDefault();
		close_the_main_menu()
	});
	// mouseleave close
	jQuery(".header-menu.desktop").mouseleave(function(){
		close_the_main_menu();
	});

	function close_the_main_menu() {
		jQuery("#header-main").removeClass('active-menu');
		jQuery("#header-main li").removeClass('menu-hover');
		jQuery(".sub-menu").css({"height":0}).removeClass('active');
		jQuery('.mega-button').removeClass('active');
		jQuery('#the--menu--blur').removeClass('active');
		jQuery('body').removeClass('no--scroll');
	}

	// select and deselect on module local resources page
	jQuery('.available-content.acc_container .selectall:button').click(function(){
		var which = jQuery(this).attr('data-which');
		jQuery('input.' + which + ':checkbox').attr('checked','checked').prop("checked", true);
	});
	jQuery('.available-content.acc_container .deselectall:button').click(function(){
		var which = jQuery(this).attr('data-which');
		jQuery('input.' + which + ':checkbox').removeAttr('checked');
	});
	jQuery('.available-content.acc_container input:checkbox').click(function(){
		jQuery(this).attr('checked','checked');
	});

	// search results button
	jQuery('.search-results-button').click(function(e){
		e.preventDefault();
		if (jQuery('.more-search-results-body .result-box').hasClass('active')) {
			jQuery('.more-search-results-body .result-box').removeClass('active');
			jQuery('.more-search-results-body .result-box').hide();
			jQuery('.search-results-button i').removeClass('fa-minus');
			jQuery('.search-results-button i').addClass('fa-plus');
		}
		else{
			jQuery('.more-search-results-body .result-box').addClass('active').show();
			jQuery('.search-results-button i').removeClass('fa-plus').addClass('fa-minus');
		}
	});

	// header search btn
	jQuery('header .search-btn').hover(function(e){
		jQuery('header .header-right').toggleClass('active');
		jQuery('.on-search-hover').toggleClass('toggle');
	});

	jQuery('header .search-btn').on('click', function(e){
		e.preventDefault();
		if ( jQuery('header .header-right').hasClass('active') ) {
			if ( jQuery('#sf--header .search-field').val().length !== 0 ) {
				jQuery( "#sf--header" ).submit();
			}
		}
	});

	
// Accordion
// accordion class has just one parent as accordion
// accordion_2 has child elements that has accordion functionality added
// Eg: module-page-local-resources-and-guidelines
		var acc     = document.getElementsByClassName("accordion");
		var panel   = document.getElementsByClassName('panel');
		var acc_2   = document.getElementsByClassName("accordion_2");
		var panel_2 = document.getElementsByClassName('panel_2');
		
		for (var i = 0; i < acc.length; i++) {
			acc[i].onclick = function() {
					this.classList.toggle("active");
					this.nextElementSibling.classList.toggle("show");
			}
		}
		for (var i = 0; i < acc_2.length; i++) {
			acc_2[i].onclick = function() {
					this.classList.toggle("active");
					this.nextElementSibling.classList.toggle("show");
			}
		}

		function setClass(els, className, fnName) {
			for (var i = 0; i < els.length; i++) {
				els[i].classList[fnName](className);
			}
		}
		
	
});

function mobile_scroll_to_overview_links() {
	if (jQuery('.the--links')[0]) {
		if ( jQuery(window).width() < 768 ) {
			jQuery('.the--links').animate({
				scrollLeft: jQuery("a.active").offset().left - 50
			}, 1000);
		}
	}
}

document.addEventListener("DOMContentLoaded", function () {
	const menuElement = document.getElementById('mobile-menu');
	const menu = new SlideMenu(menuElement,{
	position: 'left'	
	});
});

function module_sidebar_follow_me() {
  var $sidebar   = jQuery('#a-module-sidebar'), 
  		offset     = $sidebar.offset(),
      $window    = jQuery(window),
   		$section   = jQuery('#a-module-sidebar-contain'),
  		$sidebar   = jQuery('#a-module-sidebar'),
  		sdbr_hght  = $sidebar.outerHeight(true),
  		sctn_hght  = $section.outerHeight(true),
  		dble_hght  = sdbr_hght * 2,
      topPadding = 25,
      the_total  = offset.top + topPadding;
  $window.scroll(function() {
  	if (jQuery(window).width() > 767) {
  		sctn_hght  = $section.outerHeight(true);
	  	if (sctn_hght > dble_hght) {
		    if ($window.scrollTop() > the_total) {
		    	jQuery('#the-available-resources').addClass('is-scrolling');
		    	$sidebar.css({'position':'fixed', 'top': '0'});
		    	if ($window.scrollTop() > the_total + sctn_hght - 75 - sdbr_hght) {
		    		jQuery('#the-available-resources').removeClass('is-scrolling');
		    		$sidebar.css({'position':'absolute', 'top': 'unset', 'bottom': '0'});
		    	}
		    } else {
		    	jQuery('#the-available-resources').removeClass('is-scrolling');
		    	$sidebar.css({'position':'relative', 'top': 'unset', 'bottom': 'unset'});
		    }
		  }
		} else {
			jQuery('#the-available-resources').removeClass('is-scrolling');
		 	jQuery('#a-module-sidebar').css({'position':'relative', 'top': 'unset', 'bottom': 'unset'});
		}
  });
}

jQuery(document).ready(function($){
	if ( $('#a-module-sidebar')[0] ) {
		module_sidebar_follow_me();
		$(window).on('resize', function(){
			module_sidebar_follow_me();
		});
	}
});

