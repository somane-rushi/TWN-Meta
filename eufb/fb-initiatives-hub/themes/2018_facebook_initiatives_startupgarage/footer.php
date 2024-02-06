<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>
</main>
<!--Footer starts here-->
<footer class="footer container">
	<div class="row justify-content-between flex-column flex-lg-row">
		<div class="col-lg-5">
			<img src="<?php facebook_image_include( '/assets/images/en/footer_fb_icon.png' ); ?>" alt="">
			<p class="copyright grey-dark"> Facebook <?php echo esc_html( date( 'Y' ) ); ?></p>
		</div>
		<div class="col-lg-5">

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'menu-footer',
					'menu_id'         => 'menu-footer',
					'fallback_cb'     => false,
					'container_class' => 'footer-links'
				)
			);
			?>
		</div>
	</div>
</footer>
<?php if ( is_active_sidebar( 'cookies' ) ) : ?>
    <div id="cookies_layer" class="cookies" role="complementary">
		<?php dynamic_sidebar( 'cookies' ); ?>
    </div><!-- #primary-sidebar -->
<?php endif; ?>
<!--Footer ends here-->
<?php wp_footer(); ?>
<?php if ( is_active_sidebar( 'cookies' ) ) : ?>
<script type="text/javascript">
    document.getElementById('cookies_layer').className = 'slideup';
    function hideCookies() {
        document.getElementById('cookies_layer').className = '';
    }
</script>
<?php endif; ?>
</body>
</html>
