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

    /*  $(window).on("scroll", function() {
          if($(window).scrollTop() > 50) {
              $(".header").addClass("active");
          } else {
              //remove the background property so it comes transparent again (defined in your css)
              $(".header").removeClass("active");
          }
      });*/

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

    //-------------------
    //- Image Slider -----
    //-------------------

    function imageCarousel(){
        const imageSlider = $(".js-image-slider");
        const slickSettings = {
            arrows: false,
            autoplay: true,
            autoplaySpeed: 4000,
            infinite: true,
            slidesToShow: 1,
            dots: true
        }
        imageSlider.each(function(){
            const slider = $(this);
            const imageSliderImage = $(this).find('img');
            if (imageSliderImage.length > 1 ){
                slider.slick(slickSettings);
            }
        });
    }
    imageCarousel();

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
