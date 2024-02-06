<?php
/**
 * @wordpress-plugin
 * Plugin Name: Facebook I am Digital
 * Plugin URI: https://iamdigital.fb.com/
 * Description: Configures post types and admin fields
 * Version: 1.0.0
 * Author: YongZhen Low
 * Author URI: https://wearesection.com
 * Text Domain: fbiamdigital
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FBIAD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FBIAD_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );

/**
 * Class Fbiamdigital_Site_Plugin
 */
class Fbiamdigital_Site_Plugin {

	/**
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialise the Fbiamdigital_Site_Plugin class.
	 * @return object
	 */
	public static function init() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Fbiamdigital_Site_Plugin;
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
		new \Fbiamdigital_Site_Plugin\Home();
		require_once FBIAD_INCLUDES_DIR . '/class-aboutwtd.php';
		new \Fbiamdigital_Site_Plugin\Aboutwtd();
		require_once FBIAD_INCLUDES_DIR . '/class-interactivecontentwtd.php';
		new \Fbiamdigital_Site_Plugin\Interactivecontentwtd();
		require_once FBIAD_INCLUDES_DIR . '/class-campaigns.php';
		new \Fbiamdigital_Site_Plugin\Campaigns();
		require_once FBIAD_INCLUDES_DIR . '/class-digitalcitizens.php';
		new \Fbiamdigital_Site_Plugin\Digitalcitizens();

		// Custom post types
		require_once FBIAD_INCLUDES_DIR . '/class-story.php';
		require_once FBIAD_INCLUDES_DIR . '/class-resource.php';
		require_once FBIAD_INCLUDES_DIR . '/class-kid-resource.php';
		require_once FBIAD_INCLUDES_DIR . '/class-partner.php';
		require_once FBIAD_INCLUDES_DIR . '/class-program.php';
		require_once FBIAD_INCLUDES_DIR . '/class-committee.php';
		require_once FBIAD_INCLUDES_DIR . '/class-safeonline.php';
		require_once FBIAD_INCLUDES_DIR . '/class-shoppingscam.php';
		require_once FBIAD_INCLUDES_DIR . '/class-iamdigital.php';
		require_once FBIAD_INCLUDES_DIR . '/class-taknakscam.php';
		require_once FBIAD_INCLUDES_DIR . '/class-events.php';
		require_once FBIAD_INCLUDES_DIR . '/class-homeevents.php';
		require_once FBIAD_INCLUDES_DIR . '/class-apacsummit.php';
		require_once FBIAD_INCLUDES_DIR . '/class-interactivecontent.php';
		require_once FBIAD_INCLUDES_DIR . '/class-videos.php';
		require_once FBIAD_INCLUDES_DIR . '/class-everythingknow.php';
		new \Fbiamdigital_Site_Plugin\Story();
		new \Fbiamdigital_Site_Plugin\Resource();
		new \Fbiamdigital_Site_Plugin\Kidresource();
		new \Fbiamdigital_Site_Plugin\Partner();
		new \Fbiamdigital_Site_Plugin\Program();
		new \Fbiamdigital_Site_Plugin\Committee();
		new \Fbiamdigital_Site_Plugin\Safeonline();
		new \Fbiamdigital_Site_Plugin\Shoppingscam();
		new \Fbiamdigital_Site_Plugin\Iamdigital();
		new \Fbiamdigital_Site_Plugin\Taknakscam();
		new \Fbiamdigital_Site_Plugin\Events();
		new \Fbiamdigital_Site_Plugin\Homeevents();
		new \Fbiamdigital_Site_Plugin\Apacsummit();
		new \Fbiamdigital_Site_Plugin\Videos();
		new \Fbiamdigital_Site_Plugin\Interactivecontent();
		new \Fbiamdigital_Site_Plugin\Everythingknow();
	}

	/**
	 * Add our hooks
	 */
	private function hooks() {
		add_action( 'init', array( $this, 'custom_post_type_support' ),10,3 );
		add_filter( 'wpseo_metabox_prio', array( $this, 'deprioritise_yoast_meta' ), 10 , 3 );
		add_action( 'admin_menu', array( $this, 'custom_admin_menu' ), 10 , 3 );
		add_action( 'template_redirect', array( $this, 'handle_redirects' ), 100, 3 );
		add_filter( 'epr_post_types', array( $this, 'epr_post_types' ), 10 , 3 );
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

Fbiamdigital_Site_Plugin::init();
