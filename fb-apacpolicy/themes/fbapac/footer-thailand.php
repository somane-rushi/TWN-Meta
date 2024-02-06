<?php
/**
 * The template for displaying the footer (LOOKBACK pages)
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
        
<!--footer Section-->
<footer class="footer-section">
	<div class="container-fluid">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="row footer-logo">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="footerImg">
						<a href="#"><img src="<?php echo esc_url( get_template_directory_uri() . '/thailand/images/facebook-logo.png' ); ?>" alt="Thailand"></a>
					</div>
				</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="footerLinks ">
						<ul >
                        	<li><a href="#">Terms</a></li>
							<li><a href="#">Cookies</a></li>
							<li><a href="#">Data Policy</a></li>
							<li><a href="#">Faecbook</a></li>
						</ul>
					</div>
				</div>
			</div>
            <div class="privacy-copyright-block">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
						<div class="copy-txt">2021 FACEBOOK</div>
					</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="privacy-txt">
							<ul class="">
                            	<li><a href="#">Contact Information</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
					</div>
                    <div class="col-xs-12 hidden-lg hidden-md hidden-sm">
						<div class="copy-txt">2021 FACEBOOK</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>

<script>
            jQuery(document).ready(function() {
                jQuery("#bOne").click(function() {
                    jQuery("#social-sec").addClass("boxes-effect");
                });
                jQuery("#social-btn").click(function() {
                    jQuery("#social-sec").removeClass("boxes-effect");
                });
                jQuery("#bTwo").click(function() {
                    jQuery("#economic-sec").addClass("boxes-effect");
                });
                jQuery("#economic-btn").click(function() {
                    jQuery("#economic-sec").removeClass("boxes-effect");
                });
                jQuery("#bThree").click(function() {
                    jQuery("#digital-sec").addClass("boxes-effect");
                });
                jQuery("#digital-btn").click(function() {
                    jQuery("#digital-sec").removeClass("boxes-effect");
                });
                jQuery("#bFour").click(function() {
                    jQuery("#politics-sec").addClass("boxes-effect");
                });
                jQuery("#politics-btn").click(function() {
                    jQuery("#politics-sec").removeClass("boxes-effect");
                });
            });
            
        </script>
</body>
</html>