jQuery('.carousel-one').owlCarousel({
        items: 1,
        margin: 30,
        nav: false,
        dots: true,
		loop:true,
		autoplay:false,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });