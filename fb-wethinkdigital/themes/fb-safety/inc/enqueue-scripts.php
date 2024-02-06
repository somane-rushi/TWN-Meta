<?php
/**
 * fbsafety enqueue scripts
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'fbsafety_scripts' ) ) {

	add_action( 'wp_enqueue_scripts', 'fbsafety_scripts' );

	function fbsafety_scripts() {

		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );
		$css_version   = $theme_version;
		$js_version    = $theme_version;

		wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), $theme_version );
		
		//wp_enqueue_style( 'fbsafety-additional-styles', get_template_directory_uri() . '/css/additional-style.css', array(), $css_version );

		wp_enqueue_script( 'jquery' );
		
		wp_register_script( 'fbsafety-owl-scripts', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), $js_version, FALSE );
		
		wp_register_script( 'fbsafety-slide-menu-scripts', get_template_directory_uri() . '/js/slide-menu.js', array(), $js_version, FALSE );
		
		wp_register_script( 'fbsafety-scripts', get_template_directory_uri() . '/js/theme.js', array(), $js_version, FALSE );

    $ajax__arr = array(
      'ajaxurl'  => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'fbsafety--ajax' )
    );

    wp_localize_script( 'fbsafety-scripts', 'fbsafety', $ajax__arr );

    wp_register_script( 'fbsafety-search', get_template_directory_uri() . '/js/search.js', array(), $js_version, FALSE );

		wp_enqueue_script( 'fbsafety-owl-scripts' );
		wp_enqueue_script( 'fbsafety-slide-menu-scripts' );
		wp_enqueue_script( 'fbsafety-scripts' );
		wp_enqueue_script( 'fbsafety-search' );
	}

} 
