<?php
/**
 * @wordpress-plugin
 * Plugin Name: Reality Lab Academy
 * Plugin URI: http://realitylabsacademy.com/
 * Description: Configures post types and admin fields
 * Version: 1.0.0
 * Author: TWN
 * Text Domain: realitylab
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FBRLA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FBRLA_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );
if( !defined( 'FBRLA_ASSETS_URL' ) ) {
	define( 'FBRLA_ASSETS_URL', plugin_dir_path( __FILE__ ) .'assets/' );
}

include_once( plugin_dir_path( __FILE__ ) . '/script.php' );

/**
 * Class Fbrealitylabsacademy_Site_Plugin
 */
class Fbrealitylabsacademy_Site_Plugin {

	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialise the Fbrealitylabsacademy_Site_Plugin class.
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Fbrealitylabsacademy_Site_Plugin;
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
		require_once FBRLA_INCLUDES_DIR . '/class-utils.php';

		// Pages
		require_once FBRLA_INCLUDES_DIR . '/class-home.php';
		new \Fbrealitylabsacademy_Site_Plugin\Home();
		require_once FBRLA_INCLUDES_DIR . '/class-foundation.php';
		new \Fbrealitylabsacademy_Site_Plugin\Foundation();
		
		// Custom post types
		require_once FBRLA_INCLUDES_DIR . '/class-course.php';
		new \Fbrealitylabsacademy_Site_Plugin\Course();
		
		require_once FBRLA_INCLUDES_DIR . '/class-glossary.php';
		new \Fbrealitylabsacademy_Site_Plugin\Glossary();

	}

	/**
	 * Add our hooks
	 */
	private function hooks() {
		add_action( 'init', array( $this, 'custom_post_type_support' ) );
		add_filter( 'wpseo_metabox_prio', array( $this, 'deprioritise_yoast_meta' ) );
		add_action( 'admin_menu', array( $this, 'custom_admin_menu' ) );
		add_action( 'template_redirect', array( $this, 'handle_redirects' ), 100 );
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

Fbrealitylabsacademy_Site_Plugin::init();
