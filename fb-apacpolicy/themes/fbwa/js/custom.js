
jQuery(window).load(function(){
	
	jQuery(".chosen-select").chosen();
	
	jQuery(window).scroll(function() {    
		var scrollH = jQuery(window).scrollTop();
		var HeaderH = jQuery('.header-wrap').outerHeight();
	
		 
		if ( scrollH >= HeaderH ) {			
			jQuery(".header-wrap").addClass("fixed");
		}else{
			jQuery(".header-wrap").removeClass("fixed");
		}
	});
	
	var scrollH = jQuery(window).scrollTop();
	var HeaderH = jQuery('.header-wrap').outerHeight();

	 
	if ( scrollH >= HeaderH ) {			
		jQuery(".header-wrap").addClass("fixed");
	}else{
		jQuery(".header-wrap").removeClass("fixed");
	}
	
	
	jQuery('a[href*="#"]:not([href="#"])').click(function() {
        var headerHeight = jQuery('.header-outer').outerHeight();
     var target = jQuery(this.hash);
       jQuery('html,body').stop().animate({
         scrollTop: target.offset().top - HeaderH
       }, 'linear');   
     }); 
	 
	 var hash= window.location.hash
		 if ( hash == '' || hash == '#' || hash == undefined ) return false;
		 var target = jQuery(hash);
		  
	   
		 target = target.length ? target : jQuery('[name=' + hash.slice(1) +']');
		 if (target.length) {
		   jQuery('html,body').stop().animate({
			 scrollTop: target.offset().top - HeaderH //offsets for fixed header
		   }, 1000);
    }

	/*
		jQuery('.close-bar').click(function(){
			jQuery('.info-bar').fadeOut();
		}); 
	*/
	
	jQuery('.cta-scroll').click(function(){
    jQuery('html, body').animate(
        {scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top}, 
        	500 );
    	return false;
	});
	
	/*size_li = jQuery("#loadmore-content .more-row").size();
    x=5;
    jQuery('#loadmore-content .more-row:lt('+x+')').fadeIn();
    jQuery('#loadmore-cta').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        jQuery('#loadmore-content .more-row:lt('+x+')').fadeIn();
		return false;
    });*/
	
		
});
