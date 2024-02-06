// about page script
//Video Carousol
$('#aboutvideocrousel').owlCarousel({
autoplay:false,
    loop: true,
    margin: 30,
    dots: false,
    nav: true,
    items: 1,
  navText : ["<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
            "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"],
})

// testimonial 
        $('.aknlogslider').owlCarousel({
                        items: 1,
                        loop: true,
                       nav: true,
          navText: [
            "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
            "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
          ],
                        center: true,
                        autoplay: false,
                        dots: false,
                        dotsClass: "false",
                        responsive: {
                            0: {
                                items: 1
                            },
                            550: {
                                items: 1
                            },
                            768: {
                                items: 1
                            },
                            1025: {
                                items: 1
                            }
                        }
                    });
        
        $( ".htab" ).hover(function() {
          $( this ).trigger('click');
        });
        
        $(".tackback").click(function(){
        var btnid = $(this).attr('id');
        //alert (btnid);
        $('.countrybackbanner').attr('id', btnid);
        });
    
/// video popup
$(function() {
    $('.popup-youtube, .popup-vimeo').magnificPopup({
        //disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
});

if($('div.counnumbers').length) {
	$(window).scroll(counterScroll);
	var viewed = false;
	
	function isScrolledIntoView(elem) {
		var docViewTop = $(window).scrollTop();
		var docViewBottom = docViewTop + $(window).height();
	
		var elemTop = $(elem).offset().top;
		var elemBottom = elemTop + $(elem).height();
	
		return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}
	
	function counterScroll() {
	  if (isScrolledIntoView($(".counnumbers")) && !viewed) {
		  viewed = true;
		 $('.counter-count').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 1000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});
	  }
	}
}

$('#digCit').owlCarousel({
	autoplay:false,
    loop: true,
	margin: 30,
	dots: false,
	nav: true,
	items: 1,
	navText : ["<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
				"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"],
});

$('#resdigCit').owlCarousel({
	autoplay:false,
    loop: true,
	margin: 30,
	dots: true,
	nav: true,
	items: 1,
	navText : ["<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
				"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"],
});
$('#resdigCitar').owlCarousel({
	autoplay:false,
    loop: true,
	margin: 30,
	dots: true,
	nav: true,
	items: 1,
	navText : ["<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
				"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"],
});



/**  apacsummit **/
/*
window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: false,
      mirror: true
    })
  });
*/

$('.owl_welcome').owlCarousel({
                items: 1,
                loop: true,
               nav: false,
  navText: [
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
  ],
                center: false,
                autoplay: false,
                dots: false,
                dotsClass: "false",
                responsive: {
                    0: {
                        items: 1
                    },
                    550: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    1025: {
                        items: 1
                    }
                }
            });


$('.owl_keynote').owlCarousel({
                items: 1,
                loop: true,
               nav: false,
  navText: [
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
  ],
                center: false,
                autoplay: false,
                dots: false,
                dotsClass: "false",
                responsive: {
                    0: {
                        items: 1
                    },
                    550: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    1025: {
                        items: 1
                    }
                }
            });



 $('.owl_4').owlCarousel({
                items: 1,
                loop: true,
               nav: true,
  navText: [
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
  ],
                center: true,
                autoplay: false,
                dots: false,
                dotsClass: "false",
                responsive: {
                    0: {
                        items: 1
                    },
                    550: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    1025: {
                        items: 1
                    }
                }
            });


$('.owl_day1').owlCarousel({
                items: 5,
                loop: false,
               nav: true,
  navText: [
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
  ],
                center: false,
                autoplay: false,
                dots: false,
                dotsClass: "false",
                responsive: {
                    0: {
                        items: 1
                    },
                    550: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1025: {
                        items: 3
                    }
                }
            });



$('.owl_day2').owlCarousel({
                items: 5,
                loop: false,
               nav: true,
  navText: [
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
  ],
                center: false,
                autoplay: false,
                dots: false,
                dotsClass: "false",
                responsive: {
                    0: {
                        items: 1
                    },
                    550: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1025: {
                        items: 3
                    }
                }
            });


$('.owl_fireside').owlCarousel({
                items: 5,
                loop: false,
               nav: true,
  navText: [
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
  ],
                center: false,
                autoplay: false,
                dots: false,
                dotsClass: "false",
                responsive: {
                    0: {
                        items: 1
                    },
                    550: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1025: {
                        items: 3
                    }
                }
            });


$('.owl_whatsapp').owlCarousel({
                items: 1,
                loop: false,
               nav: false,
  navText: [
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"
  ],
                center: false,
                autoplay: false,
                dots: false,
                dotsClass: "false",
                responsive: {
                    0: {
                        items: 1
                    },
                    550: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    1025: {
                        items: 1
                    }
                }
            });


// taknak page script
//secure img crousel 
$('#secureimgcrousel').owlCarousel({
    autoplay:false,
        loop: true,
        margin: 30,
        dots: true,
        nav: true,
        items: 1,
      navText : ["<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
                "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"],
    })

    //scamimgcrousel
    $('#scamimgcrousel').owlCarousel({
        autoplay:false,
            loop: true,
            margin: 30,
            dots: false,
            nav: true,
            items: 1,
          navText : ["<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/left.png'/>",
                    "<img src='https://wethinkdigital.fb.com/wp-content/uploads/2022/05/right.png'/>"],
        })

       // Digital Citizens video tab 
       $(function() {
        $('.tabs-nav a').on('click', function() {
        $('.triangle-container').remove();
          show_content($(this).index());
        });
        
        show_content(0);
      
        function show_content(index) {
          // Make the content visible
          $('.tabs .content.visible').removeClass('visible');
          $('.tabs .content:nth-of-type(' + (index + 1) + ')').addClass('visible');
      
          // Set the tab to selected
          $('.tabs-nav a.selected').removeClass('selected');
          $('.tabs-nav a:nth-of-type(' + (index + 1) + ')').addClass('selected');
          // Add arrow
          $( 'tabs-nav a.selected').append( "<div class='triangle-container'><img src='http://rebornshare.com/right-arrow-red.png'></div>" );
          // How to remove the arrow and only show it on the selected tab?
        }
      }); 