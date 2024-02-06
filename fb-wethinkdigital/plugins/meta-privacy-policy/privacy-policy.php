<?php
/*
Plugin Name: Meta Privacy Policy Generator
Description: Creates privacy page based on custom information via a Short Code. Information can be updated under Settings --> Meta Privacy Policy.
Tags: Privacy Policy
Author: NJI Media
Author URI: https://njimedia.com

Requires PHP: 7.2
Version: 1.0.0
License: GPL v2 or later
*/

if ( ! defined( 'ABSPATH' ) ) exit;

function privacy_policy_fn()
{
	if (defined('FM_VERSION')) {

		$dir = dirname(__FILE__) . '/inc/';

		require_once($dir . '/class/class-pp-helper.php');
		require_once($dir . '/class/class-pp-submenu.php');
		require_once($dir . '/class/class-pp-shortcode.php');
		require_once($dir . '/class/class-pp-preview.php');
		require_once($dir . '/class/class-pp-template.php');

	} else {
	}
}
add_action('after_setup_theme', 'privacy_policy_fn');