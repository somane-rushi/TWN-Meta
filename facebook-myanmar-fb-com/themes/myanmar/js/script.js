$('#homeCarousel').owlCarousel({
		autoplay:false,
        loop: true,
        margin: 30,
        dots: true,
        nav: true,            
        navText : [
                    "<img src='https://myanmar-fb-com-preprod.go-vip.net/wp-content/uploads/2022/08/left.png'/>",
                    "<img src='https://myanmar-fb-com-preprod.go-vip.net/wp-content/uploads/2022/08/right.png'/>"
        ],
        responsive: {
            0: {
				items: 1
            },
            550: {
                items: 2
            },
            768: {
                items: 2
            },
            1025: {
                items: 3
            }
        }
});

$(window).scroll(testScroll);
        var viewed = false;

        function isScrolledIntoView(elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();

            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        function testScroll() {
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
	