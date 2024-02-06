<?php

namespace fbdigitalscam_Site_Plugin;

class Utils {
	private static $instance;

	private function __construct() {
		/* Don't do anything, needs to be initialized via instance() method */
	}

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Utils;
		}

		return self::$instance;
	}

	/**
	 * Check if a page is using a specific template
	 *
	 * @param  string $template_name
	 *
	 * @return boolean
	 */
	public static function is_using_template( $template_name ) {
		if ( empty( $template_name ) ) {
			return false;
		}

		$post_get  = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : false;
		$post_post = isset( $_POST['post_ID'] ) ? intval( $_POST['post_ID'] ) : false;

		if ( ! empty( $post_get ) ) {
			$post_id = $post_get;
		} elseif ( ! empty( $post_post ) ) {
			$post_id = $post_post;
		} else {
			return false;
		}

		$current_page_template = get_page_template_slug( $post_id );
		if ( ! empty( $current_page_template ) ) {
			$current_page_template = explode( '.', $current_page_template );

			if ( $current_page_template[0] === $template_name ) {
				return true;
			}
		}

		return false;
	}
}

Utils::instance();