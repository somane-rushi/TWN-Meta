<?php
/**
 * Theme basic setup.
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'fbsafety_setup' );

if ( ! function_exists ( 'fbsafety_setup' ) ) {

	function fbsafety_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header-main'    => __( 'Header Main', 'fbsafety' ),
			'header-mobile'  => __( 'Header Mobile', 'fbsafety' ),
			'footer-top-nav' => __( 'Footer Top Nav', 'fbsafety' ),
			'footer-main'    => __( 'Footer Main', 'fbsafety' )
			
		) );

		// Switch default core markup to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Thumbnail basic support
		add_theme_support( 'post-thumbnails' );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );
		
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		//clean up unnecessary stuff
		head_cleaner_oninit();
		add_filter( 'the_generator', 'no_generator' );

	}
}
