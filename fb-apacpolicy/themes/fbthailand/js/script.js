

function addanimation() {
  var element = document.getElementById("pr1");
  element.classList.add("lastani");
}


function removeanimation() {
  var element = document.getElementById("pr1");
  element.classList.remove("lastani");
}


$(document).ready(function () {

  $('#partnerslider').owlCarousel({
            autoplay:true,
            loop: true,
            dots: true,
            nav: true,
            items: 4,
            transitionStyle: "fade",
          navText : ["<img class='carrow' src='https://apacpolicy-fb-com-develop.go-vip.net/thailand/wp-content/themes/fbthailand/images/next.png'/>",
                    "<img class='carrow' src='https://apacpolicy-fb-com-develop.go-vip.net/thailand/wp-content/themes/fbthailand/images/right.png'/>"],

responsive : {
    // breakpoint from 0 up
    0 : {
        items: 1,
    },
    // breakpoint from 480 up
    480 : {
       items: 1,
    },
    // breakpoint from 768 up
    768 : {
       items: 1,
    }
}
        
        
        })
})


window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: false,
      mirror: true
    })
  });

  function hover(element) {
    element.setAttribute('src', 'https://apacpolicy-fb-com-develop.go-vip.net/thailand/wp-content/themes/fbthailand/images/infill.png');
  }
  
  function unhover(element) {
    element.setAttribute('src', 'https://apacpolicy-fb-com-develop.go-vip.net/thailand/wp-content/themes/fbthailand/images/inslogo.png');
  }

  $(function() {
    $('.popup-youtube').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: true
    });
});
  
  