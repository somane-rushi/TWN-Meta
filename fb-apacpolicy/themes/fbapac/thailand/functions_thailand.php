<?php
/**
 * Custom FUNCTIONS relating to the Thailand section of the site
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   TWN
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


/**
 * Assets: styles & scripts
 *
 * @return void
 */
function fbapac_thailand_assets() {
    //if ( is_page_template('thailand/page-thailand.php') ) {
        $thailand_version = '0.2';
		
		wp_enqueue_style( 'thailand-fontawesome', get_template_directory_uri() . '/thailand/css/all.css', array(), $thailand_version);
		wp_enqueue_style( 'thailand-bootstrap', get_template_directory_uri() . '/thailand/css/bootstrap.css', array(), $thailand_version);
		wp_enqueue_style( 'thailand-owl-styles', get_template_directory_uri() . '/thailand/css/owl.css', array(), $thailand_version);
        wp_enqueue_style( 'thailand-styles', get_template_directory_uri() . '/thailand/css/thailand.css', array(), $thailand_version);
		wp_enqueue_style( 'thailand-responsive', get_template_directory_uri() . '/thailand/css/responsive.css', array(), $thailand_version);
        
		wp_enqueue_script( 'thailand-jquery', get_template_directory_uri() . '/thailand/js/jquery.js', array(), $thailand_version, TRUE );
		wp_enqueue_script( 'thailand-bootstrap', get_template_directory_uri() . '/thailand/js/bootstrap.min.js', array(), $thailand_version, TRUE );
        wp_enqueue_script( 'thailand-owl-scripts', get_template_directory_uri() . '/thailand/js/owl.js', array(), $thailand_version, TRUE );
        wp_enqueue_script( 'thailand-scripts', get_template_directory_uri() . '/thailand/js/thailand.js', array(), $thailand_version, TRUE );
   // }
}
add_action('wp_enqueue_scripts', 'fbapac_thailand_assets');






