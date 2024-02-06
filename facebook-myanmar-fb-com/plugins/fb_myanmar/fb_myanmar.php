<?php
/**
 * @wordpress-plugin
 * Plugin Name: Facebook Myanmar
 * Plugin URI: https://myanmar.fb.com/
 * Description: Configures post types and admin fields
 * Version: 1.0.0
 * Author: TWN
 * Author URI: https://thinkwhynot.com/
 * Text Domain: myanmar
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FBMY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FBMY_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );
if( !defined( 'FBMY_ASSETS_URL' ) ) {
	define( 'FBMY_ASSETS_URL', plugin_dir_path( __FILE__ ) .'assets/' );
}

include_once( plugin_dir_path( __FILE__ ) . '/script.php' );

/**
 * Class Fbmyanmar_Site_Plugin
 */
class Fbmyanmar_Site_Plugin {

	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialise the Fbmyanmar_Site_Plugin class.
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Fbmyanmar_Site_Plugin;
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
		require_once FBMY_INCLUDES_DIR . '/class-utils.php';
		
		// Pages
		require_once FBMY_INCLUDES_DIR . '/class-builder.php';
		new \Fbmyanmar_Site_Plugin\Builder();
		require_once FBMY_INCLUDES_DIR . '/class-myanmar-update.php';
		new \Fbmyanmar_Site_Plugin\Myanmarupdate();
	}

	/**
	 * Add our hooks
	 */
	private function hooks() {
		add_action( 'init', array( $this, 'custom_post_type_support' ),10 , 3 );
		add_filter( 'wpseo_metabox_prio', array( $this, 'deprioritise_yoast_meta' ), 10 , 3  );
		add_action( 'admin_menu', array( $this, 'custom_admin_menu' ), 10 , 3  );
		/*add_action( 'template_redirect', array( $this, 'handle_redirects' ), 100,3 );*/
	}

	/**
	 * Customize post type support
	 */
	public function custom_post_type_support() {
		remove_post_type_support( 'page', 'editor' );
		remove_post_type_support( 'page', 'thumbnail' );
	}

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
	public function custom_admin_menu() {
		remove_menu_page( 'edit.php' ); // Posts
		remove_menu_page( 'edit-comments.php' ); // Comments
	}

}

Fbmyanmar_Site_Plugin::init();
