<?php
/**
 * Plugin Name: Facebook Initiatives
 * Plugin URI: https://rehab.studio
 * Description: A plugin to define the content types for the Facebook Initiatives website.
 * Author: Rehab Studio
 * Author URI: https://vip.wordpress.com
 * Version: 0.0.1
 * License: GPLv2
 * Text Domain: facebook-initiatives
 * Domain Path: /languages
 *
 * Usage:
 * - Network enable this plugin along with the 2018 Facebook Initiatives theme
 */

// Load the language textdomain
function facebook_initiatives_load_plugin_textdomain() {
	load_plugin_textdomain( 'facebook-initiatives-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );
	
}
add_action( 'plugins_loaded', 'facebook_initiatives_load_plugin_textdomain' );

require_once( __DIR__ . '/class-initiatives-redirects.php' );
require_once( __DIR__ . '/class-initiatives-custom-fields.php' );
require_once( __DIR__ . '/class-initiatives-stats-widget.php' );
require_once( __DIR__ . '/class-initiatives-footnote-widget.php' );