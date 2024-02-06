<?php
/**
 * Support subdirectory multisite with 2 directory segment
 * e.g.
 * site.com/ph/tl
 * site.com/ph/en-us
 *
 * @see https://vip.wordpress.com/documentation/multisite-on-vip-go/#subdirectory-multisites-with-two-segment-paths
 */
function fbiamdigital_site_by_path_segments_count() {
	return 2;
}

add_filter( 'site_by_path_segments_count', 'fbiamdigital_site_by_path_segments_count', 99 );

add_action( 'ms_network_not_found', function ( $domain, $path ) {
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		return;
	}
	landing_pages_redirect( $domain, $path );
}, 8, 2 );

add_action( 'ms_site_not_found', function ( $network, $domain, $path ) {
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		return;
	}
	landing_pages_redirect( $domain, $path );
}, 8, 3 );

/**
 * Redirect domains to their landing pages
 *
 * @param $domain
 * @param $path
 */
function landing_pages_redirect( $domain, $path ) {
	$domain_list = [
		[ 'soydigital.fb.com', 'wethinkdigital.fb.com/ar/es-ar/' ],
		[ 'soydigitalco.fb.com', 'wethinkdigital.fb.com/co/es-co/' ],
		[ 'digitaltayo.fb.com', 'wethinkdigital.fb.com/ph/en-us/' ],
		[ 'soydigitalcr.fb.com', 'wethinkdigital.fb.com/cr/es-cr/' ],
		[ 'soydigitalmx.fb.com', 'wethinkdigital.fb.com/mx/es-mx/' ],
	];

	$domain = str_replace( 'www.', '', $domain );

	foreach ( $domain_list as $redirects ) {
		list( $compare_domain, $redirect_domain ) = $redirects;
		if ( $compare_domain === $domain ) {
			$protocol = ( is_ssl() ) ? 'https' : 'http';
			$url      = $protocol . '://' . $redirect_domain;
			header( "Location: $url", true, 301 );
			exit();
		}
	}
}
