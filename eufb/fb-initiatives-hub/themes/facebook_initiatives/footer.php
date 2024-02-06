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
	<div class="container">
		<div class="footer__columns">
			<?php
			if ( has_nav_menu( 'menu-3' ) ) {

				$menu_obj = get_term( $theme_locations['menu-3'], 'nav_menu' );
				$items    = wp_get_nav_menu_items( $theme_locations['menu-3'] );
				?>
				<div class="footer__column">
					<h4 class="footer__column_heading"><?php echo esc_html( $menu_obj->name ); ?></h4>
					<select data-country-selector>
						<?php
							$counter = 0;
						foreach ( $items as $item ) {
							printf(
								"<option %s %s value='%s'>%s</option>",
								disabled( '#', $item->url, false ),
								selected( 0, $counter, false ),
								esc_attr( $item->url ),
								esc_attr( apply_filters( 'get_the_title', $item->post_title ) )
							);
							$counter++;
						}
						?>
					</select>
				</div>
			<?php } ?>
			<?php
			if ( has_nav_menu( 'menu-4' ) ) {
				$menu_obj        = get_term( $theme_locations['menu-4'], 'nav_menu' );
				?>
				<div class="footer__column footer__column--right">
					<h4 class="footer__column_heading"><?php echo esc_html( $menu_obj->name ); ?></h4>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-4',
							'menu_id'        => 'footer-right-menu',
							'fallback_cb'    => false,
							'container'      => false,
							'menu_class'     => 'footer-right-menu',
						)
					);
					?>
				</div>
			<?php } ?>
		</div>
		<div class="footer__footer">
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
			<small class="footer__copyright">Facebook &copy; <?php echo esc_html( date( 'Y' ) ); ?></small>
		</div>
	</div>
</footer>
<?php if ( is_active_sidebar( 'cookies' ) ) : ?>
    <div id="cookies_layer" class="cookies" role="complementary">
		<?php dynamic_sidebar( 'cookies' ); ?>
    </div><!-- #primary-sidebar -->
<?php endif; ?>
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
