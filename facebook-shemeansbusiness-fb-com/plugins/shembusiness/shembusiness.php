<?php
/**
 * @wordpress-plugin
 * Plugin Name: She Means Business
 * Plugin URI: https://shemeansbusiness.com/
 * Description: Configures post types and admin fields
 * Version: 1.0.0
 * Author: TWN
 * Text Domain: shembusiness
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FBSMB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FBSMB_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );
if( !defined( 'FBSMB_ASSETS_URL' ) ) {
	define( 'FBSMB_ASSETS_URL', plugin_dir_path( __FILE__ ) .'assets/' );
}

include_once( plugin_dir_path( __FILE__ ) . '/script.php' );

/**
 * Class Fbshemeansbusiness_Site_Plugin
 */
class Fbshemeansbusiness_Site_Plugin {

	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialise the Fbshemeansbusiness_Site_Plugin class.
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Fbshemeansbusiness_Site_Plugin;
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
		require_once FBSMB_INCLUDES_DIR . '/class-utils.php';

		// Pages
		require_once FBSMB_INCLUDES_DIR . '/class-home.php';
		new \Fbshemeansbusiness_Site_Plugin\Home();
		require_once FBSMB_INCLUDES_DIR . '/class-region.php';
		new \Fbshemeansbusiness_Site_Plugin\Region();
		require_once FBSMB_INCLUDES_DIR . '/class-fellowship.php';
		new \Fbshemeansbusiness_Site_Plugin\Fellowship();
		require_once FBSMB_INCLUDES_DIR . '/class-traininghub.php';
		new \Fbshemeansbusiness_Site_Plugin\Traininghub();
		require_once FBSMB_INCLUDES_DIR . '/class-buyfromherpg.php';
		new \Fbshemeansbusiness_Site_Plugin\Buyfromherpg();
		

		// Custom post types
		require_once FBSMB_INCLUDES_DIR . '/class-learning-capsules.php';
		new \Fbshemeansbusiness_Site_Plugin\Learningcapsules();		
		require_once FBSMB_INCLUDES_DIR . '/class-testimonials.php';
		new \Fbshemeansbusiness_Site_Plugin\Testimonials();
		require_once FBSMB_INCLUDES_DIR . '/class-stories.php';
		new \Fbshemeansbusiness_Site_Plugin\Stories();
		require_once FBSMB_INCLUDES_DIR . '/class-partners.php';
		new \Fbshemeansbusiness_Site_Plugin\Partners();
		require_once FBSMB_INCLUDES_DIR . '/class-fellows.php';
		new \Fbshemeansbusiness_Site_Plugin\Fellows();
		require_once FBSMB_INCLUDES_DIR . '/class-buyfromher.php';
		new \Fbshemeansbusiness_Site_Plugin\Buyfromher();
		
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

Fbshemeansbusiness_Site_Plugin::init();
