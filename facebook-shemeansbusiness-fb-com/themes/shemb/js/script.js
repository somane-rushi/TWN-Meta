(function ($) {
    if ($('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            margin: 0,
            loop: true,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            autoplay: true,
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

})(window.jQuery);
/*******/
(function ($) {
    if ($('.team-carousel').length) {
        $('.team-carousel').owlCarousel({
            margin: 0,
            loop: true,
            nav: false,
            dots: false,
            smartSpeed: 500,
            autoplay: true,
            navText: ['<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 3,
                    autoplay: false
                },
                800: {
                    items: 3,
                    autoplay: false
                },
                1024: {
                    items: 3,
                    autoplay: false
                }
            }
        });
    }
})(window.jQuery);
/*******/
(function ($) {
    if ($('.team-carousel2').length) {
        $('.team-carousel2').owlCarousel({
            margin: 0,
            loop: true,
            nav: false,
            dots: false,
            smartSpeed: 500,
            autoplay: true,
            navText: ['<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                600: {
                    items: 3
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


(function ($) {
    if ($('.country-banner').length) {
        $('.country-banner').owlCarousel({
            margin: 30,
            loop: true,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            autoplay: true,
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
})(window.jQuery);

document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll('.dropdown-menu').forEach(function (element) {
		element.addEventListener('click', function (e) {
			e.stopPropagation();
		});
	})
	if (window.innerWidth < 992) {
		document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
			everydropdown.addEventListener('hidden.bs.dropdown', function () {

				this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
					everysubmenu.style.display = 'none';
		        });
		     })
		});
		document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
			element.addEventListener('click', function (e) {
				let nextEl = this.nextElementSibling;
				if (nextEl && nextEl.classList.contains('submenu')) {
					e.preventDefault();
					console.log(nextEl);
					if (nextEl.style.display == 'block') { nextEl.style.display = 'none'; } 
					else { nextEl.style.display = 'block'; }
				}
			});
		})
	}
});

$( ".linkTab" ).hover(function() {
	$( this ).trigger('click');
});

$( document ).ready(function() {
    var current_url = location.href;
	var url =  current_url.split("#");
	var main = $("#nav-"+url[1]+"-tab").attr("data-parent");
	$("#nav-"+main+"-tab").tab('show');
	$("#nav-"+url[1]+"-tab").tab('show');
});

$(function() {
    $('.popup-youtube, .popup-vimeo').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
});

var videoSlider = $('#homebancrousel');
videoSlider.owlCarousel({
	loop: true,
	margin: 0,
	nav: true,
	navText: ['<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>'],
	dots: true,
	items: 1
});

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


//

