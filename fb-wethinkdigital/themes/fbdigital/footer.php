<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fbdigital
 */

?>

<footer class="footer-section">
	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="footer-logo">
				<a href="<?php echo site_url(); ?>"><img src="https://wethinkdigital-fb-preprod.go-vip.net/wp-content/uploads/2021/04/facebook-logo.png" alt="FB Digital"></a>
			</div>
            <div class="privacy-copyright-block">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<div class="copy-txt">2021 FACEBOOK</div>
					</div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
						<div class="privacy-txt">
							<a href="#">Privacy Policy</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

</div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php wp_footer(); ?>

    <script>
        new WOW().init();
    </script>
	<script>
		// Repeat demo content
		var $body = $('body');
		var $box = $('.box');
		for (var i = 0; i < 20; i++) {
			$box.clone().appendTo($body);
		}
		WOW.prototype.addBox = function(element) {
			this.boxes.push(element);
		};

		// Init WOW.js and get instance
	    var wow = new WOW();
	    wow.init();

	    // Attach scrollSpy to .wow elements for detect view exit events,
	    // then reset elements and add again for animation
		$('.wow').on('scrollSpy:exit', function() {
			$(this).css({
			  'visibility': 'hidden',
			  'animation-name': 'none'
			}).removeClass('animated');
			wow.addBox(this);
		}).scrollSpy();

	</script>
    <script>
	
        $(document).ready(function() {
            function alignModal() {
                var modalDialog = $(this).find(".modal-dialog");
                // Applying the top margin on modal to align it vertically center
                modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
            }
            $(".modal").on("shown.bs.modal", alignModal);

            var $videoSrc;
            $('.video-btn').click(function() {
                $videoSrc = $(this).data("src");
            });
            // when the modal is opened autoplay it  
            $('#myModal').on('shown.bs.modal', function(e) {
                // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
                $("#video").attr('src', $videoSrc + "?autoplay=1&amp;controls=1&amp;modestbranding=1&amp;showinfo=0");
            })

            // stop playing the youtube video when I close the modal
            $('#myModal').on('hide.bs.modal', function(e) {
                // a poor man's stop video
                $("#video").attr('src', $videoSrc);
            })
            $(window).on("resize", function() {
                $(".modal:visible").each(alignModal);
            });
            // document ready  

        });

    </script>

    <script>
        $("#loan").click(function() {
            $('html, body').animate({
                scrollTop: $("#loansection").offset().top
            }, 2000);
        });
        $("#lottery").click(function() {
            $('html, body').animate({
                scrollTop: $("#lotterysection").offset().top
            }, 2000);
        });
        $("#ecommerce").click(function() {
            $('html, body').animate({
                scrollTop: $("#ecommercesection").offset().top
            }, 2000);
        });
        $("#romantic").click(function() {
            $('html, body').animate({
                scrollTop: $("#romanticsection").offset().top
            }, 2000);
        });
        $("#job").click(function() {
            $('html, body').animate({
                scrollTop: $("#jobsection").offset().top
            }, 2000);
        });
    </script>

</body>
</html>
