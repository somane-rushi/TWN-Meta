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
        
  <footer class="lookback-footer">
    <div class="container">
      <div class="footer-top">
        <div class="footer-logo">
          <a href="/"><img src="<?php echo esc_url( get_template_directory_uri() . '/lookback/img/logo-footer.png' ); ?>" alt="Facebook"></a>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="footer-links">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'footer-lookback',
              'menu_class'      => 'footer-lookback',
              'menu_id'         => 'footer-lookback',
              'depth'           => 1
            )
          );
        ?>
        </div>
        <div class="credit"><?php echo esc_attr( gmdate('Y') ); ?> FACEBOOK</div>
      </div>
    </div>
  </footer>
        
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>