import _throttle from 'lodash.throttle';
import Rellax from 'rellax';

//------------------
//--- Functions ----
//------------------

(function($) {
    jQuery.fn.extend({
        isOnScreen: function() {
            let win = $(window);

            let viewport = {
                top : win.scrollTop() - 100,
                left : win.scrollLeft()
            };

            viewport.right = viewport.left + win.width();
            viewport.bottom = viewport.top + win.height();
        
            let bounds = this.offset();
            bounds.right = bounds.left + this.outerWidth();
            bounds.bottom = bounds.top + this.outerHeight();
            return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
        }
    });
})(jQuery);

jQuery(document).ready(function($){

    if ($('.rellax').length > 0) {
        var rellax = new Rellax('.rellax', {
            center: true
        });
    }
 
    //------------------
    //--- Typography ---
    //------------------

    let $moveLeftFadeIn = $('.js-in-viewport--move-left-fade-in');
    let $growLineFromLeft = $('.js-in-viewport--grow-line-from-left');
    let $mentoringBullet = $('.mentoring-bullet-item');
    let $moveUpFadeIn = $('.js-in-viewport--move_up_fade_in');
    let $fadeIn = $('.js-in-viewport--fade-in');
    let $blocksFadeIn = $('.js-in-viewport--blocks-animate-in');

    $(document).scroll(_throttle(function() {

        $moveLeftFadeIn.each(function () {
            if ($(this).isOnScreen()) {
                $(this).addClass('move-left-fade-in');
            }
        })

        $growLineFromLeft.each(function () {
            if ($(this).isOnScreen()) {
                $(this).addClass('grow-line-from-left');
            }
        })

        $mentoringBullet.each(function () {
            if ($(this).isOnScreen()) {
                $(this).addClass('animate-complete');
            }
        })

        $moveUpFadeIn.each(function () {
            if ($(this).isOnScreen()) {
                $(this).addClass('move_up_fade_in');
            }
        })

        $fadeIn.each(function () {
            if ($(this).isOnScreen()) {
                $(this).addClass('fade-in');
            }
        })

        $blocksFadeIn.each(function () {
            if ($(this).isOnScreen()) {
                $(this).addClass('blocks-animate-in');
            }
        })
    }));

    //------------------
    //--- Nav/Header ---
    //------------------

    $('.navbar-menu-btn').click(function () {
        $('.navbar-offcanvas').addClass('show');
    });

    $('.navbar-offcanvas-close').click(function () {
        $('.navbar-offcanvas.show').removeClass('show');
    });

    //------------------
    //--- Hero ---------
    //------------------

    let prevScrollStop = 0;

    $(document).scroll(_throttle(function() {

        let backgroundOpacity = Math.min(0.1 + 0.5 * $(this).scrollTop() / 150, 0.9);
        let headlineOpacity = Math.max(1 - $(this).scrollTop() / 210, 0);

        let scrollFromTop = $(window).scrollTop();
        let navTrigger = '600';

        $('.hero__overlay--primary').css({'opacity': backgroundOpacity});
        $('.hero__overlay--light').css({'opacity': backgroundOpacity});

        $('.hero .col').css({'opacity': headlineOpacity});
        $('.hero .col').css({'opacity': headlineOpacity});

        if (scrollFromTop >= navTrigger) {
            if (prevScrollStop > scrollFromTop) {
                $('header').removeClass('header--hidden');
            } else {
                $('header').addClass('header--hidden');
            }
        } else {
            $('header').removeClass('header--hidden');
        }

        prevScrollStop = scrollFromTop;
    }));

    //------------------
    //--- Quotes -------
    //------------------

    $('.quotes-slider').slick({
        fade: true,
        asNavFor: '.quotes-slider-nav',
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                }
            }
        ]
    });
    $('.quotes-slider-nav').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.quotes-slider',
        centerPadding: '35%',
        arrows: false,
        focusOnSelect: true,
        centerMode: true,
        infinite: false,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    arrows: true,
                    centerMode: true,
                    slidesToShow: 1,
                    centerPadding: '35%',
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: true,
                    slidesToShow: 1,
                    centerPadding: '35%',
                }
            }
        ]
    });

    //----------------------
    //- Startups Slider ----
    //----------------------

    $('.meet-startups-slider').slick({
        centerMode: true,
        centerPadding: '0',
        slidesToShow: 1,
        dots: true,
        infinite: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.startupsGridModal').on('show.bs.modal', function () {
        $(this).find('.meet-startups-modal-slider').hide()
    });

    $('.startupsGridModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var slide = button.data('slide') // Extract info from data-* attributes

        $(this).find('.meet-startups-modal-slider').show();
        $(this).find('.meet-startups-modal-slider').slick({
            initialSlide: slide,
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 1,
            dots: true,
            infinite: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '0',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 1
                    }
                }
            ]
        })
    });

    $('.startupsGridModal').on('hidden.bs.modal', function () {
        $(this).find('.meet-startups-modal-slider').slick('unslick')
    });

    //-------------------
    //- Logo Slider -----
    //-------------------

    $('.logo-slider').slick({
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        slidesToShow: 4,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    //-------------------
    //- Analytics -------
    //-------------------

    $('.section-apply-container .btn-cta').click(function (event) {
        if (window.gdprSafeTrack) {
            window.gdprSafeTrack(function () {
                ga('send', 'event', {
                    eventCategory: 'Outbound Link',
                    eventAction: 'click',
                    eventLabel: event.target.href,
                    transport: 'beacon',
                });
            });
        }
    });

    //Force the document to fire scroll event, this captures elements for isInView that are already in view onload
    $(function () {
        $(document).scroll();
    });
});