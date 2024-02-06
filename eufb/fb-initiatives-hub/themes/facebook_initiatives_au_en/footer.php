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
  <div class="footer-wrapper">
    <div class="row justify-content-between flex-column flex-lg-row">
        <div class="col-lg-5 order-2 order-lg-1 footer-col">
            <span class="foo-logo"><img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/foo-logo.png"></span>
        </div>
        <div class="col-lg-7 order-1 order-lg-2  footer-col">
			
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

    <div class="row justify-content-between flex-column flex-lg-row footer-bottom">
      <div class="col-lg-5 order-2 order-lg-1 foo-bottom-col">
        <div class="copyright"><?php echo esc_html( gmdate( 'Y' ) ); ?> Facebook</div>
      </div>
      <div class="col-lg-7 order-1 order-lg-2 foo-bottom-col">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'foo-bottom-menu',
              'menu_id'         => 'foo-bottom-menu',
              'fallback_cb'     => false,
              'container_class' => 'footer-bottom-links'
            )
          );
        ?>
      </div>
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
<script type="text/javascript">
  var cookies_layer=document.getElementById('cookies_layer')
  if(typeof cookies_layer !== "undefined" && cookies_layer)
  {
    cookies_layer.className = 'slideup';
    function hideCookies() {
      cookies_layer.className = '';
    }
  }

</script>
</body>
</html>
