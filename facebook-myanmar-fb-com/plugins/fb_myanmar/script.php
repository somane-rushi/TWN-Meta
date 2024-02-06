<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
/**
 * Scripts Class
 *
 * Handles Scripts and Styles enqueues functionality.
 *
 * @package She Means Business
 * @since 1.0.0
 */

// Admin class to handle admin side functionality
function wp_eam_register_admin_scripts( ) {
	wp_register_style( 'myanmarstyle', FBMY_ASSETS_URL.'fbMyanmar.css', array());		
	wp_enqueue_style( 'myanmarstyle' );	
}
add_action( 'admin_enqueue_scripts', 'wp_eam_register_admin_scripts');