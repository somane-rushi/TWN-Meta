(function ($) {

    if ($('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            margin: 0,
            loop: true,
            nav: true,
            dots: true,
            smartSpeed: 500,
            autoplay: false,
            navText: ['<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 1
                },
                1024: {
                    items: 1
                }
            }
        });
    }
    
    if ($('.quoteCarousel').length) {
        $('.quoteCarousel').owlCarousel({
            margin: 0,
            loop: true,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            autoplay: 20000,
            navText: ['<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 3
                },
                1024: {
                    items: 3
                }
            }
        });
    }


})(window.jQuery);

jQuery(document).ready(function() {
	jQuery("#bOne").click(function() {
		jQuery("#social-sec").addClass("boxes-effect");
	});
	jQuery("#social-btn").click(function() {
		jQuery("#social-sec").removeClass("boxes-effect");
	});
	jQuery("#bTwo").click(function() {
		jQuery("#economic-sec").addClass("boxes-effect");
	});
	jQuery("#economic-btn").click(function() {
		jQuery("#economic-sec").removeClass("boxes-effect");
	});
	jQuery("#bThree").click(function() {
		jQuery("#digital-sec").addClass("boxes-effect");
	});
	jQuery("#digital-btn").click(function() {
		jQuery("#digital-sec").removeClass("boxes-effect");
	});
	jQuery("#bFour").click(function() {
		jQuery("#politics-sec").addClass("boxes-effect");
	});
	jQuery("#politics-btn").click(function() {
		jQuery("#politics-sec").removeClass("boxes-effect");
	});
});

function chnlang(val,url){
	var res = url.split("/");
	var furl = res[0]+'//'+res[2];
	if(val==='en'){ rurl= furl+'/thailand'; }
	else if(val==='th'){ rurl=furl+'/thailand-th'; }
	window.location.href = rurl;
}
            

/******/

var videoSlider = $('#homebancrousel');
videoSlider.owlCarousel({
    autoplay: true,
	loop: true,
	margin: 0,
	nav: true,
	navText: ['<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>'],
	dots: true,
	items: 1,
    autoplayTimeout:2500,
    autoplayHoverPause:true
});

$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})

videoSlider.on('translate.owl.carousel', function (e) {
	$('.owl-item .item video').each(function () {
    	$(this).get(0).pause();
  	});
});

videoSlider.on('translated.owl.carousel', function (e) {
	if ($('.owl-item.active').find('video').length !== 0) {
    	$('.owl-item.active .item video').get(0).play();
	}
});