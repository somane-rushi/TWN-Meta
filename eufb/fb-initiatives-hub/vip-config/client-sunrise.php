<?php
///forcibly remove www to avoid redirect issues
if (isset($_SERVER['HTTP_HOST']) && substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {// @codingStandardsIgnoreLine Need to use $_SERVER vars to catch it at this point
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI']); // @codingStandardsIgnoreLine
	exit;
}

add_filter( 'pre_site_option_ms_files_rewriting', '__return_zero' );

add_filter( 'mercator.sso.enabled', '__return_false' );
add_filter( 'mercator.sso.multinetwork.enabled', '__return_false' );

require_once WP_CONTENT_DIR . '/client-mu-plugins/mercator/mercator.php';
require_once WP_CONTENT_DIR . '/client-mu-plugins/mercator-redirect/redirect.php';

add_filter( 'mercator.redirect.enabled', '__return_true' );
add_filter( 'mercator.redirect.admin.enabled', '__return_true' );

add_action(
	'ms_network_not_found', function ( $domain, $path ) {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return;
		}
		landing_pages_redirect( $domain, $path );
		no_site_found_redirect( $domain, $path );
	}, 8, 2
);

add_action(
	'ms_site_not_found', function ( $network, $domain, $path ) {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return;
		}
		landing_pages_redirect( $domain, $path );
		no_site_found_redirect( $domain, $path );
	}, 8, 3
);

function no_site_found_redirect( $domain, $path ) {
	
	$domain = str_replace( 'www.', '', $domain );
	$sites = get_sites(
		[
			'domain' => $domain,
		]
	);

	if ( $sites ) {
		foreach ( $sites as $site ) {
			$is_primary = (int) get_blog_option( $site->blog_id, 'primary_site', 0 );
			if ( $is_primary ) {
				$protocol = ( is_ssl() ) ? 'https' : 'http';
				$url      = $protocol . '://' . $site->domain . $site->path;
				header( "Location: $url", true, 302 );
				exit();
			}
		}
	}
}

/**
 * @param $domain
 * @param $fullpath
 */
function landing_pages_redirect( $domain, $fullpath ) {

	$paths = explode( '/', $fullpath );
	$paths = array_filter( $paths );

	if ( ! $paths ) {
		return;
	}
	$path = array_shift( $paths );

	$domain_list = [
		[ 'france.fb.com', 'startupgarage', 'startupgarage.fb.com' ],
		[ 'germany.fb.com', 'digitaleslernzentrum', 'digitaleslernzentrum.fb.com/en' ],
		[ 'deutschland.fb.com', 'digitaleslernzentrum', 'digitaleslernzentrum.fb.com/de' ],
		[ 'india.fb.com', 'economicimpact', 'indiaeconomy.fb.com' ],
		[ 'nigeria.fb.com', 'nghub', 'nghub.fb.com' ],
		[ 'polska.fb.com', 'przestrzen', 'przestrzen.fb.com/pl' ],
		[ 'poland.fb.com', 'przestrzen', 'przestrzen.fb.com/en' ],
		[ 'brasil.fb.com', 'estacaohack', 'estacaohack.fb.com/pt-br' ],
		[ 'brazil.fb.com', 'estacaohack', 'estacaohack.fb.com/en' ],
		[ 'espana.fb.com', 'eshub', 'eshub.fb.com/es' ],
		[ 'india.fb.com', 'economy', 'indiaeconomy.fb.com' ],
		[ 'europeanunion.fb.com', 'eu', 'eu.fb.com' ],
	];

	$domain = str_replace( 'www.', '', $domain );

	foreach ( $domain_list as $redirects ) {
		list( $compare_domain, $compare_path, $redirect_domain ) = $redirects;
		if ( $compare_domain === $domain && $compare_path === $path ) {
			$protocol = ( is_ssl() ) ? 'https' : 'http';
			$url      = $protocol . '://' . $redirect_domain;
			header( "Location: $url", true, 302 );
			exit();
		}
	}
}
