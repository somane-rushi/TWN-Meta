<?php

/**
 * Hi there, VIP dev!
 *
 * vip-config.php is where you put things you'd usually put in wp-config.php. Don't worry about database settings
 * and such, we've taken care of that for you. This is just for if you need to define an API key or something
 * of that nature.
 *
 * Happy Coding!
 *
 * - The WordPress.com VIP Team
 **/


define( 'VIP_MAINTENANCE_MODE', true );

if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true) {
	// debug jetpack ONLY locally..
	define( 'JETPACK_DEV_DEBUG', true);
}

if ( defined( 'WPCOM_IS_VIP_ENV' ) && WPCOM_IS_VIP_ENV ) {
	//  is running on VIP
} else {
	define( 'WP_CRON_CONTROL_SECRET', 'secret_crontime_bananza' );
}

if ( ! defined( 'VIP_JETPACK_IS_PRIVATE' ) ) {
	define( 'VIP_JETPACK_IS_PRIVATE', true );
}
