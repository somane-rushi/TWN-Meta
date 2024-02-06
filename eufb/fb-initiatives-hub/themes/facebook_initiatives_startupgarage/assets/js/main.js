'use strict';

(function () {
    'use strict';

    jQuery(document).ready(function ($) {

        //Header
        $('.navbar-menu-btn').click(function () {
            $('.navbar-offcanvas').addClass('show');
        });

        $('.navbar-offcanvas-close').click(function () {
            $('.navbar-offcanvas.show').removeClass('show');
        });

        //Quotes page slider

        $('.quotes-slider').slick({
            fade: true,
            asNavFor: '.quotes-slider-nav',
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 960,
                settings: {
                    arrows: false
                }
            }, {
                breakpoint: 480,
                settings: {
                    arrows: false
                }
            }]
        });
        $('.quotes-slider-nav').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.quotes-slider',
            centerPadding: '35%',
            arrows: false,
            focusOnSelect: true,
            centerMode: true,
            responsive: [{
                breakpoint: 960,
                settings: {
                    arrows: true,
                    centerMode: true,
                    slidesToShow: 1,
                    centerPadding: '35%'
                }
            }, {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: true,
                    slidesToShow: 1,
                    centerPadding: '35%'
                }
            }]
        });

        // Startups page slider

        $('.meet-startups-slider').slick({
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 1,
            dots: true,
            infinite: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0',
                    slidesToShow: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }]
        });

        $('#startupsGridModal').on('show.bs.modal', function () {
            $('.meet-startups-modal-slider').hide();
        });

        $('#startupsGridModal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var slide = button.data('slide'); // Extract info from data-* attributes
            $('.meet-startups-modal-slider').show();
            $('.meet-startups-modal-slider').slick({
                initialSlide: slide,
                centerMode: true,
                centerPadding: '0',
                slidesToShow: 1,
                dots: true,
                infinite: true,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '0',
                        slidesToShow: 1
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 1
                    }
                }]
            });
        });

        $('#startupsGridModal').on('hidden.bs.modal', function () {
            $('.meet-startups-modal-slider').slick('unslick');
        });

        // GA tracking
        $('.section-apply-container .btn-cta').click(function (event) {
            if (window.gdprSafeTrack) {
                window.gdprSafeTrack(function () {
                    ga('send', 'event', {
                        eventCategory: 'Outbound Link',
                        eventAction: 'click',
                        eventLabel: event.target.href,
                        transport: 'beacon'
                    });
                });
            }
        });
    });
})();
//# sourceMappingURL=main.js.map
