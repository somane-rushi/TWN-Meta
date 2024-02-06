<?php
/*
 Plugin Name: VIP Go Deprecate Shared Plugins
 Description: Move shared plugins to local site
 Author: WordPress.com VIP
 Version: 1.0.0

 This file was created in order to move VIP Go shared plugins into your own repository.
 We encourage you to move the code from this file into your theme at a later date.

 See this documentation to do this:
 https://vip.wordpress.com/documentation/vip-go/deprecating-shared-plugins-on-vip-go/

 If you have any questions, please contact us
 */

 // This constant will allow us to move VIP Go shared plugins into this repository.
 // This constant can be removed after the migration has been fully completed.
 // For details: https://vip.wordpress.com/documentation/vip-go/deprecating-shared-plugins-on-vip-go/
define( 'WPCOM_VIP_DISABLE_SHARED_PLUGINS', true );

function wpcomvip_fbc_load_plugins() {
	// use the local version of fieldmanager
	wpcom_vip_load_plugin( 'fieldmanager' );
}
add_action( 'muplugins_loaded', 'wpcomvip_fbc_load_plugins' );