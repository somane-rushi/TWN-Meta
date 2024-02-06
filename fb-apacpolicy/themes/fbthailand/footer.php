<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thailand
 */

?>

	<!--footer Section-->
<footer class="footer-section">
	<div class="container-fluid">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        	<div class="row footer-logo">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 noPadding">
					<div class="footerImg">
						<a href="<?php echo esc_url( home_url( ) ); ?>"><img src="https://apacpolicy-fb-com-develop.go-vip.net/thailand/wp-content/uploads/sites/3/2022/06/meta-logo.png" alt="Meta Logo"></a>

						<!--<a href="<?php echo esc_url( home_url( ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/meta-logo.png' ); ?>" alt="Meta"></a>-->
					</div>
				</div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 noPadding">
					<div class="footerLinks">
                    	<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'footer_menu',
										'container'       => 'ul',
										'container_class' => '',
										'item_spacing'    => 'discard',
										'menu_class'      => '',
									)
								);
						?>
					</div>
				</div>
			</div>
            <div class="privacy-copyright-block">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-xs">
						<div class="copy-txt"><?php echo esc_html( gmdate( 'Y' ) ); ?> Meta</div>
					</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="privacy-txt">
                        	<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'footer_bot',
										'container'       => 'ul',
										'container_class' => '',
										'item_spacing'    => 'discard',
										'menu_class'      => '',
									)
								);
							?>
							<?php /*?><ul class="">
                            	<li><a href="https://www.facebook.com/legal/terms" target="_blank">Terms</a></li>
								<li><a href="https://www.facebook.com/policies/cookies/" target="_blank">Cookies</a></li>
								<li><a href="https://www.facebook.com/policy.php" target="_blank">Data Policy</a></li>
								<li><a href="https://about.facebook.com/" target="_blank">Meta</a></li>
							</ul><?php */?>
						</div>
					</div>
                    <div class="col-xs-12 hidden-lg hidden-md hidden-sm">
						<div class="copy-txt"><?php echo esc_html( gmdate( 'Y' ) ); ?> Meta</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
<script>
</script>
</body>
</html>
