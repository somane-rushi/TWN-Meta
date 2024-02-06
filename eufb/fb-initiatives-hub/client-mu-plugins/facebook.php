<?php
/**
 * Facebook Tweaks
 *
 * @package     FacebookTweaks
 * @author      Jonathan Harris
 * @copyright   2018 Rehab
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Facebook Tweaks
 * Plugin URI:  https://www.facebook.com
 * Description: Tweaks for WordPress for the facebook project
 * Version:     1.0.0
 * Author:      Jonathan Harris
 * Author URI:  https://www.spacedmonkey.com
 * Text Domain: facebook-tweaks
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Add support for SVG logo upload
 *
 * @param $mimes
 *
 * @return $mimes array
 */
function facebook_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'facebook_mime_types' );

/**
 * If not site icon is set, default in theme.
 *
 * @param $url
 * @param $size
 *
 * @return string
 */
function facebook_site_icon( $url, $size ) {
	if ( ! $url ) {
		if ( file_exists( get_theme_file_path( "assets/images/icons/icon-{$size}x{$size}.png" ) ) ) {
			$url = get_theme_file_uri( "assets/images/icons/icon-{$size}x{$size}.png" );
		} elseif ( file_exists( get_theme_file_path( 'assets/images/icons/icon.png' ) ) ) {
			$url = get_theme_file_uri( 'assets/images/icons/icon.png' );
		}
	}

	return $url;
}

add_filter( 'get_site_icon_url', 'facebook_site_icon', 10, 2 );

add_filter(
	'jetpack_open_graph_fallback_description', function ( $current ) {
		return trim( convert_chars( wptexturize( get_bloginfo( 'description' ) ) ) );
	}
);
add_filter(
	'jetpack_open_graph_image_default', function ( $current ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $image ) {
			$current = array_shift( $image );
		}
	}

		return $current;
	}
);

/**
 * @param string $path
 */
function facebook_image_include( $path = '' ) {
	$uri  = get_theme_file_uri( $path );
	$time = filemtime( get_theme_file_path( $path ) );
	$url  = add_query_arg( array(
		'ver' => $time
	), $uri );
	echo esc_url( $url );
}

/**
 * @param string $path
 */
function facebook_image_url( $path = '' ) {
	$uri  = get_theme_file_uri( $path );
	$time = filemtime( get_theme_file_path( $path ) );
	$url  = add_query_arg( array(
		'ver' => $time
	), $uri );
	return  $url;
}

