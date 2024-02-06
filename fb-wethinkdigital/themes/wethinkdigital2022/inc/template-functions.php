<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wethinkdigital2022
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wethinkdigital2022_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'wethinkdigital2022_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wethinkdigital2022_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wethinkdigital2022_pingback_header' );

/**
 * Modify queries for custom post types
 *
 * @param WP_Query $query
 */
function fbiamdigital_post_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( is_post_type_archive( array( 'story' ) ) ) {
		$query->set( 'posts_per_page', 9 );
		if ( is_post_type_archive( 'resource' ) ) {
			$query->set( 'meta_key', 'wpfp_featured' );
			$query->set( 'orderby', array(
				'meta_value_num' => 'DESC',
				'title'          => 'ASC',
			) );
		}
		return;
	}
	if ( is_post_type_archive( array( 'resource' ) ) ) {
		$query->set( 'posts_per_page', 9 );
		if ( is_post_type_archive( 'resource' ) ) {
			$query->set( 'meta_key', 'wpfp_featured' );
			$query->set( 'orderby', array(
				'meta_value_num' => 'DESC',
				'date'           => 'DESC',
			) );
		}
		return;
	}
	if ( is_post_type_archive( array( 'partner', 'committee' ) ) ) {
		$query->set( 'posts_per_page', 8 );
		if ( is_post_type_archive( 'partner' ) ) {
			$query->set( 'order', 'ASC' );
			$query->set( 'orderby', 'title' );
		}
		return;
	}
}

add_action( 'pre_get_posts', 'fbiamdigital_post_query', 1 );

function wtd_custom_infinite_more() { 
	$getpostype = get_post_type();
	if ( ! empty( $getpostype ) ) {
		if ( $getpostype==='resource' || $getpostype==='partner') {
		?>
			<script type="text/javascript">
				var btntext;
				btntext = jQuery('#loadvalue').text();
				infiniteScroll.settings.text = btntext;
			</script>
		<?php }
	}
	else
	{
		?> <script type="text/javascript"> infiniteScroll.settings.text = 'Load More'; </script><?php
	}
}
add_action( 'wp_footer', 'wtd_custom_infinite_more',9999 );
