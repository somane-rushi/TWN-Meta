jQuery(document).ready(function() {


	jQuery('.vid-play').on('click', function(ev) {
		jQuery(".video-cover").hide();
		jQuery(".video-caption").hide();

		jQuery("#youtubeVideo").find("iframe")[0].src += "&autoplay=1";
		ev.preventDefault();
	});

	jQuery('.vid-play-btn').on('click', function(ev) {
		jQuery(".fullvideo-overlay").hide();

		jQuery("#fullVideo").find("iframe")[0].src += "&autoplay=1";
		ev.preventDefault();
	});

});

document.addEventListener("DOMContentLoaded", function () {
	const menuElement = document.getElementById('mobile-menu');
	const menu = new SlideMenu(menuElement,{
		position: 'left'	  
	});
});
