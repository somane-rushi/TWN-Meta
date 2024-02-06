<?php
/**
 * @wordpress-plugin
 * Plugin Name: Facebook apac Thiland
 * Plugin URI: https://apacpolicy.fb.com/
 * Description: Configures post types and admin fields
 * Version: 1.0.0
 * Author: TWN
 * Author URI: https://thinkwhynot.com/
 * Text Domain: apacpolicy
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FBIAD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FBIAD_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );

/**
 * Class Fbapac_Site_Plugin
 */
class Fbapac_Site_Plugin {

	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialise the Fbapac_Site_Plugin class.
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Fbapac_Site_Plugin;
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
		new \Fbapac_Site_Plugin\Home();
		require_once FBIAD_INCLUDES_DIR . '/class-economic.php';
		new \Fbapac_Site_Plugin\Economic();
		
		
		require_once FBIAD_INCLUDES_DIR . '/class-dgcitizenship.php';
		new \Fbapac_Site_Plugin\Dgcitizenship();
		
		
		require_once FBIAD_INCLUDES_DIR . '/class-rediscovethailand.php';
		new \Fbapac_Site_Plugin\Rediscovethailand();
			
		
		require_once FBIAD_INCLUDES_DIR . '/class-inovation.php';
		new \Fbapac_Site_Plugin\Inovation();
		require_once FBIAD_INCLUDES_DIR . '/class-covid19.php';
		new \Fbapac_Site_Plugin\Covid19();
		require_once FBIAD_INCLUDES_DIR . '/class-builder.php';
		new \Fbapac_Site_Plugin\Builder();

		// Custom post types
		require_once FBIAD_INCLUDES_DIR . '/class-digitallogo.php';
		new \Fbapac_Site_Plugin\Digitallogo();

		require_once FBIAD_INCLUDES_DIR . '/class-leadership.php';
		new \Fbapac_Site_Plugin\Leadership();
		
		require_once FBIAD_INCLUDES_DIR . '/class-successstory.php';
		new \Fbapac_Site_Plugin\Successstory();
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

Fbapac_Site_Plugin::init();
