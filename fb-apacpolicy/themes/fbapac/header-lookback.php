<?php
/**
 * The header for our theme (LOOKBACK pages)
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

nocache_headers();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="cache-control" content="no-cache" />
  <meta charset="<?php echo esc_attr( get_bloginfo('charset') ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="shortcut icon" href="<?php echo esc_url(get_stylesheet_directory_uri(). '/images/favicon.ico'); ?>" >
  <?php wp_head(); ?>
</head>

<body <?php body_class('lookback--sections'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'fb_file_repository'); ?></a>

    <header class="header lookback-header">
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/lookback/' ) ); ?>" title="Lookback Home" rel="noopener">
                <img class="desktop" src="<?php echo esc_url( get_template_directory_uri() . '/lookback/img/logo-header.png' ); ?>" alt="Facebook" />
                <img class="mob" src="<?php echo esc_url( get_template_directory_uri() . '/lookback/img/logo-mobile.png' ); ?>" alt="Facebook" />
            </a>
        </div>

        <?php
            get_template_part( 'lookback/template-parts/menu-all' );
        ?>

    </header>
    