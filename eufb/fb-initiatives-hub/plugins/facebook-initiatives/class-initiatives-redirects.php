<?php
/**
 * Redirect the native pages to internal anchor links
 * @package facebook-initiatives
 */
$initiatives_redirects = new Initiatives_Redirects;
class Initiatives_Redirects {
	public function __construct() {
		add_action( 'template_redirect', array( $this, 'handle_redirects' ) );
	}
	public function handle_redirects() {
		global $post;
		// Handle Categories (Stories) like /category/how-were-driving-digital-transformation
		if ( is_category() ) {
			$category     = get_the_category();
			$redirect_url = get_site_url( null, '#' . $category[0]->slug );
			wp_safe_redirect( $redirect_url );
			exit();
		}
		// Handle pages like /about-us and posts like /how-were-making-advancements-in-ai
		if ( is_page() && ! is_front_page() || is_single() && ! is_front_page() ) {
			$redirect_url = get_site_url( null, '#' . $post->post_name );
			wp_safe_redirect( $redirect_url );
			exit();
		}
		// Added catch all to redirect date based, author based, tag based, author based archives
		if ( ! is_front_page() ) {
			wp_safe_redirect( home_url() );
			exit();
		}
	}
}