<?php
/**
 * @wordpress-plugin
 * Plugin Name: Facebook Digital
 * Plugin URI: https://iamdigital.fb.com/
 * Description: Configures post types and admin fields
 * Version: 1.0.0
 * Author: TWN
 * Author URI: https://thinkwhynot.com/
 * Text Domain: fbdigital
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FBIAD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FBIAD_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );

/**
 * Class fbdigitalscam_Site_Plugin
 */
class fbdigitalscam_Site_Plugin {

	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialise the fbdigitalscam_Site_Plugin class.
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new fbdigitalscam_Site_Plugin;
			self::$instance->setup();
		}

		return self::$instance;
	}

	/**
	 * Sets up all the appropriate hooks and actions within our plugin.
	 */
	private function setup() {
		$this->includes();
		$this->hooks();
	}

	/**
	 * Require and instantiate classes
	 */
	private function includes() {
		// Utils
		require_once FBIAD_INCLUDES_DIR . '/class-utils.php';

		// Pages
		require_once FBIAD_INCLUDES_DIR . '/class-home.php';
		new \fbdigitalscam_Site_Plugin\Home();

		// Custom post types
		/*require_once FBIAD_INCLUDES_DIR . '/class-story.php';
		require_once FBIAD_INCLUDES_DIR . '/class-resource.php';
		require_once FBIAD_INCLUDES_DIR . '/class-partner.php';
		require_once FBIAD_INCLUDES_DIR . '/class-program.php';
		require_once FBIAD_INCLUDES_DIR . '/class-committee.php';
		new \fbdigitalscam_Site_Plugin\Story();
		new \fbdigitalscam_Site_Plugin\Resource();
		new \fbdigitalscam_Site_Plugin\Partner();
		new \fbdigitalscam_Site_Plugin\Program();
		new \fbdigitalscam_Site_Plugin\Committee();*/
	}

	/**
	 * Add our hooks
	 */
	private function hooks() {
		add_action( 'init', array( $this, 'custom_post_type_support' ) );
		add_filter( 'wpseo_metabox_prio', array( $this, 'deprioritise_yoast_meta' ) );
		add_action( 'admin_menu', array( $this, 'custom_admin_menu' ) );
		add_action( 'template_redirect', array( $this, 'handle_redirects' ), 100 );
		add_filter( 'epr_post_types', array( $this, 'epr_post_types' ) );
	}

	/**
	 * Customize post type support
	 */
	/*public function custom_post_type_support() {
		remove_post_type_support( 'page', 'editor' );
		remove_post_type_support( 'page', 'thumbnail' );
	}*/

	/**
	 * Move yoast metaboxes below our custom fields
	 * @return string
	 */
	public function deprioritise_yoast_meta() {
		return 'low';
	}

	/**
	 * Customize admin menu
	 */
	/*public function custom_admin_menu() {
		remove_menu_page( 'edit.php' ); // Posts
		remove_menu_page( 'edit-comments.php' ); // Comments
	}*/

	/**
	 * Redirects
	 */
	public function handle_redirects() {
		// We don't have a listing page for program and a single page for partner, redirecting them permanently should help with SEO
		// Canonical listing page should be partner archive
		if ( is_singular( 'partner' ) || is_post_type_archive( 'program' ) ) {
			wp_safe_redirect( get_post_type_archive_link( 'partner' ), 301 );
			die();
		}
	}

	/**
	 * Filters post types that use EPR plugin redirects
	 * @return array
	 */
	function epr_post_types() {
		return array(
			'partner',
		);
	}

}

fbdigitalscam_Site_Plugin::init();