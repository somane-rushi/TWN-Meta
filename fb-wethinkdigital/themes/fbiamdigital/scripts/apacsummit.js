
// Set the date we're counting down to
var countDownDate = new Date("Sep 29, 2021 12:50:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

	// Get today's date and time
	var now = new Date().getTime();
    
	// Find the distance between now and the count down date
	var distance = countDownDate - now;
    
	// If the count down is over, write some text 
	if (distance < 0) {
		clearInterval(x);
	}
	else
	{  
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		// Output the result in an element with id="demo"
		document.getElementById("dnum").innerHTML = days;
		document.getElementById("hnum").innerHTML = hours;
		document.getElementById("mnum").innerHTML = minutes;
		document.getElementById("snum").innerHTML = seconds;
	}
	
}, 1000);


jQuery('.owl_day1').owlCarousel({
    items: 5,
	loop: false,
	nav: true,
	navText: [
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/left.png'/>",
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/right.png'/>"
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
jQuery('.owl_day2').owlCarousel({
	items: 5,
	loop: false,
	nav: true,
	navText: [
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/left.png'/>",
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/right.png'/>"
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

jQuery('.owl_fireside').owlCarousel({
	items: 5,
    loop: false,
    nav: true,
	navText: [
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/left.png'/>",
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/right.png'/>"
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

jQuery('.owl_whatsapp').owlCarousel({
	items: 1,
    loop: false,
    nav: true,
	navText: [
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/left.png'/>",
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/right.png'/>"
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

jQuery('.owl_keynote').owlCarousel({
	items: 1,
    loop: true,
    nav: true,
	navText: [
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/left.png'/>",
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/right.png'/>"
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
jQuery('.owl_welcome').owlCarousel({
	items: 1,
	loop: true,
	nav: true,
	navText: [
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/left.png'/>",
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/right.png'/>"
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



jQuery('.owl_4').owlCarousel({
	items: 1,
    loop: true,
    nav: true,
	navText: [
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/left.png' />",
		"<img src='https://wethinkdigital.fb.com/wp-content/uploads/2021/09/right.png' />"
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

jQuery( ".htab" ).hover(function() {
  jQuery( this ).trigger('click');
});


jQuery(window).scroll(function() {
   var hT = jQuery('body').offset().top,
       hH = jQuery('#sagenda').outerHeight(),
       wH = jQuery(window).height(),
       wS = jQuery(this).scrollTop();
    console.log((hT-wH) , wS);
   if (wS > (hT+hH-wH)){
     //alert('you have scrolled to the h1!');
	jQuery(".book").addClass("psfx");
	}
});


window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: false,
      mirror: true
    })
});

