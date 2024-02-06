<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package fbiamdigital
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
 
function fbiamdigital_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'         => 'click', // always use click
		'wrapper'      => false, // don't wrap our loaded content
		'container'    => 'content',
		'click_handle' => true, // use our custom button
		'render'       => 'fbiamdigital_infinite_scroll_render',
	) );
}

add_action( 'after_setup_theme', 'fbiamdigital_jetpack_setup' );

/*function jetpack_infinite_scroll_query_args( $args ) {
	$args['taxonomy'] = 'pccountry';
	$args['field'] = 'slug';
	$args['terms'] = 'fiji-hindi';
	return $args;
}
add_filter( 'infinite_scroll_query_args', 'jetpack_infinite_scroll_query_args' );*/

/**
 * Custom render function for Infinite Scroll.
 */
function fbiamdigital_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_type() );
		endif;
	}
}

/**
 * Custom infinite scroll JS settings
 *
 * @param $settings
 *
 * @return mixed
 */
function fbiamdigital_infinite_scroll_js_settings( $settings ) {
	$settings['google_analytics'] = true;

	return $settings;
}

add_filter( 'infinite_scroll_js_settings', 'fbiamdigital_infinite_scroll_js_settings' );

/**
 * Remove infinite scroll default styles
 */

function fbiamdigital_remove_infinite_scroll_styles() {
	wp_dequeue_style( 'the-neverending-homepage' );
}

add_action( 'wp_print_styles', 'fbiamdigital_remove_infinite_scroll_styles' );
add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 );
