<?php
/**
 * fbdigital functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fbdigital
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'fbdigital_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fbdigital_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on fbdigital, use a find and replace
		 * to change 'fbdigital' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fbdigital', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'fbdigital' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'fbdigital_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		
		
		// Register Menus
		register_nav_menus( array(
			'main_nav'      => esc_html__( 'Main Navigation', 'fbdigital' ),
			'lang_switcher' => esc_html__( 'Language Switcher', 'fbdigital' ),
		) );
	
	}
endif;
add_action( 'after_setup_theme', 'fbdigital_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fbdigital_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fbdigital_content_width', 640 );
}
add_action( 'after_setup_theme', 'fbdigital_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fbdigital_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fbdigital' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fbdigital' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fbdigital_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fbdigital_scripts() {
	wp_enqueue_style( 'fbdigital-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fbdigital-style', 'rtl', 'replace' );
	wp_enqueue_style( 'fbdigital-fontawesome', get_theme_file_uri( '/css/all.css' ), array(), null );
	wp_enqueue_style( 'fbdigital-bootstrap', get_theme_file_uri( '/css/bootstrap.css' ), array(), null );
	wp_enqueue_style( 'fbdigital-animate', get_theme_file_uri( '/css/animate.css' ), array(), null );
	wp_enqueue_style( 'fbdigital-stylenew', get_theme_file_uri( '/css/style.css' ), array(), null );
	wp_enqueue_style( 'fbdigital-responsive', get_theme_file_uri( '/css/responsive.css' ), array(), null );

	wp_enqueue_script( 'fbdigital-jquery', get_theme_file_uri( '/js/jquery.js' ), array(), null, true );
	wp_enqueue_script( 'fbdigital-bootstrap', get_theme_file_uri( '/js/bootstrap.min.js' ), array(), null, true );
	wp_enqueue_script( 'fbdigital-wow', get_theme_file_uri( '/js/wow.js' ), array(), null, true );
	wp_enqueue_script( 'fbdigital-scrollspy', get_theme_file_uri( '/js/scrollspy.js' ), array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'fbdigital_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* code */

/**
 * Build sites data for displaying in site selector
 * @return array
 */
function fbiamdigital_get_site_selector_data() {
	$countries_mapping = require dirname( __FILE__ ) . '/inc/i18n/countries.php';
	$langs_mapping = require dirname( __FILE__ ) . '/inc/i18n/country_langs.php';
	$sites_data = array(
		'current' => array(),
		'all'     => array(),
		'current_country_code' => 'intl'
	);

	$sites = get_sites( array(
		'public' => '1',
	) );

	$blog = get_blog_details();
	$current_blog_id = get_current_blog_id();
	$langs = explode('/', preg_replace('/^\/|\/$/', '',$blog->path));

	if ( ! empty( $sites ) ) {
		foreach ( $sites as $site ) {
			$country_lang_data = explode( '/', trim( $site->path, '/' ) );
			$country_code      = '';
			$url               = '';
			$menu_item_name    = '';
			$country_lang	   = array();

			if ( $site->path === '/' ) {
				$country_code   = 'en-us';
				$url            = get_site_url( 1 );
				$menu_item_name = _x( 'International', 'Countries', 'fbdigital' );
			} else if ( count( $country_lang_data ) === 2 ) {
				$country_code   = array_shift( $country_lang_data );
				$url            = get_site_url( 1, $country_code );
				$menu_item_name = array_key_exists( strtoupper( $country_code ), $countries_mapping ) ? $countries_mapping[ strtoupper( $country_code ) ] : false;
				$country_lang['code'] = array_shift($country_lang_data);
				$country_lang['name'] = isset($langs_mapping[$country_lang['code']]) ? $langs_mapping[$country_lang['code']] : '';
			}
			if ( empty( $menu_item_name ) ) {
				continue;
			}
			if (!empty($sites_data['all'][$country_code])) {
				$site_data = $sites_data['all'][$country_code];
			} else {
				$site_data = array(
					'url'          => trailingslashit( $url ),
					'name'         => $menu_item_name,
					'country_code' => $country_code,
					'country_lang' => array()
				);
			}
			if (!empty($country_lang['code'])) {
				$site_data['country_lang'][$country_lang['code']] = $country_lang;
			}
			
			$sites_data['all'][ $country_code ] = $site_data;
			if ( $current_blog_id === $site->id ) {
				$sites_data['current_country_code'] = $country_code;
			}
		}
		if (!empty($sites_data['current_country_code'])) {
			$sites_data['current'] = $sites_data['all'][$sites_data['current_country_code']];
			$sites_data['current_lang'] = isset($langs[1]) ? preg_replace( '/-([a-z]+)/', '', strtolower($langs[1])) : null;
		}

		if ( ! empty( $sites_data['all'] ) ) {
			$intl = $sites_data['all']['intl'];
			unset( $sites_data['all']['intl'] );
			ksort( $sites_data['all'] );
			array_unshift( $sites_data['all'], $intl );
		}
	}
	return $sites_data;
}

function fbiamdigital_fb_fixel_script() {
	$sites_data        = fbiamdigital_get_site_selector_data();
	$current_site_data = $sites_data['current'];
	if ($current_site_data['country_code'] == 'tw'):
	?>
	<script>
	if (window.gdprSafeTrack) {
		window.gdprSafeTrack(function() {
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
		});
		window.gdprSafeTrack(function() {
			fbq('init', '1308902952648177');
			fbq('track', 'PageView');
		});
	}
	</script>
	
	<noscript><img height="1" width="1"src="https://www.facebook.com/tr?id=1308902952648177&ev=PageView&noscript=1"/></noscript>
	<?php 
	endif;
};

add_action('fbiamdigital_fb_fixel_script', 'fbiamdigital_fb_fixel_script');

/**
 * Send resource form data to Salesforce
 *
 * @param array $form_data
 *
 * @return bool
 */
function fbiamdigital_post_salesforce_leads( $form_data = array() ) {
	$params = array(
		'oid'             => '00DA0000000K9kF',
		'retURL'          => 'https://facebook.com',
		'recordType'      => '0121H000000ztFx',
		'00NA0000009lwUU' => 'I_Am_Digital_Website',

		'00N1200000Apo7B' => $form_data['country'], // country
		'00NA0000008sE9x' => $form_data['lang'], // language
		'00NA0000009URvF' => $form_data['agree'], // agree
		'first_name'      => $form_data['first_name'],
		'last_name'       => $form_data['last_name'],
		'email'           => $form_data['email'],
		'company'         => $form_data['company'],
		'title'           => $form_data['job_title'],
	);

	$response = wp_safe_remote_post( esc_url( 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8' ), array(
		'method' => 'POST',
		'body'   => $params,
	) );

	if ( is_wp_error( $response ) ) {
		return false;
	} else {
		return true;
	}
}