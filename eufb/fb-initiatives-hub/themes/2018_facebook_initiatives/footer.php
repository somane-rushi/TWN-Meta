<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package facebook-initiatives
 */

$theme_locations = get_nav_menu_locations();
?>

<footer class="footer">
	<a name="footer" data-scroll-anchor></a>
	<div class="container">
		<div class="footer__footer">
			<small class="footer__copyright">Facebook &copy; <?php echo esc_html( date( 'Y' ) ); ?> </small>

			<div class="footer__footnotes">
				<?php dynamic_sidebar( 'footnotes-area' ); ?>
			</div>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-5',
					'menu_id'        => 'footer-menu',
					'fallback_cb'    => false,
					'container'      => false,
					'menu_class'     => 'footer-menu',
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
<?php wp_footer(); ?>

</div><!--End Page-->
</div><!--End Page Wrap-->
<?php if ( is_active_sidebar( 'cookies' ) ) : ?>
<script type="text/javascript">
	document.getElementById('cookies_layer').className = 'slideup';
	function hideCookies() {
		document.getElementById('cookies_layer').className = '';
	}
</script>
<?php endif; ?>
</body>

<?php do_action( 'after_body' ); ?>

</html>
