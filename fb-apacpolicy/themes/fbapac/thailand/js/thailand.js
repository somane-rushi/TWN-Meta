(function ($) {

    if ($('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            margin: 0,
            loop: true,
            nav: true,
            dots: true,
            smartSpeed: 500,
            autoplay: 5000,
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

