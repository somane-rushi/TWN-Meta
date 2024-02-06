<?php
/**
 * Template part = Lookback, Mobile Menu
 * Displayed on page-lookback
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

include( locate_template( 'lookback/template-parts/data-part_regions.php') );
?>

<div class="header-menu desktop">
<?php
  wp_nav_menu(
    array(
      'theme_location'  => 'header-lookback',
      'menu_class'      => 'header-lookback',
      'menu_id'         => 'header-lookback',
      'depth'           => 1
    )
  );
?>
</div>

<div id="header-menu-desktop-expand" class="lookback-submenu">
    <div class="expand-inner">
        <span class="span-menu-title">
            <h4>Countries</h4>
        </span>
        <ul>
    <?php
    if ( ! empty($regions__array) ):
        foreach ($regions__array as $region) :
            $region_link  = fbapac_fm_get_data($region, 'link');
            $region_title = fbapac_fm_get_data($region, 'title');
    ?>
            <li><a href="<?php echo esc_url($region_link); ?>" rel="noopener"><?php echo esc_html($region_title); ?></a></li>
    <?php
        endforeach;
    endif;
    ?>
        </ul>
    </div>
</div>

<a class="burger-menu" href="javascript:void(0);">
    <span class="burger-inner top"></span>
    <span class="burger-inner center"></span>
    <span class="burger-inner bottom"></span>
</a>

<div class="mobile-menu">
    <ul>
        <li><a href="<?php echo esc_url( home_url( '/lookback/' ) ); ?>" title="Lookback Home" rel="noopener">>Home</a></li>
<?php
if ( ! empty($regions__array) ):
    foreach ($regions__array as $region) :
        $region_link  = fbapac_fm_get_data($region, 'link');
        $region_title = fbapac_fm_get_data($region, 'title');
?>
                <li><a href="<?php echo esc_url($region_link); ?>" rel="noopener"><?php echo esc_html($region_title); ?></a></li>
<?php
    endforeach;
endif;
?>
        
    </ul>
</div>
