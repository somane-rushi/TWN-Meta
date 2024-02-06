<?php
/**
 * GLOBAL FOOTER (every template)
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

  <footer class="main-footer">
    <div class="container">
      <div class="footer-top">
        
        <div class="footer-top-inner">
        
            <div class="footer-logo">
              <a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo-footer.png' ); ?>" alt="Facebook"></a>
            </div>
            
            <!--footer-top-nav-->
            <div class="footer-top-nav">
            <?php
              wp_nav_menu(
                array(
                  'theme_location'  => 'footer-top-nav',
                  'menu_class'      => 'footer-top-nav',
                  'menu_id'         => 'footer-top-nav',
                  'depth'           => 1
                )
              );
            ?>
            </div>
            <!--footer-top-nav-->
        
        </div>
        
      </div>

      <div class="footer-bottom footer-bottom-inner">
        <div class="footer-links">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'footer-main',
              'menu_class'      => 'footer-main',
              'menu_id'         => 'footer-main',
              'depth'           => 1
            )
          );
        ?>
        </div>
        <div class="credit"><?php echo esc_html( gmdate('Y') ); ?> FACEBOOK</div>
      </div>
    </div>
  </footer>