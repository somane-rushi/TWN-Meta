<?php
/**
 * thailand functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thailand
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'fbthailand_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fbthailand_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thailand, use a find and replace
		 * to change 'thailand' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fbthailand', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'fbthailand' ),
				'lang_switcher' => esc_html__( 'Language Switcher', 'fbthailand' ),
				'footer_menu' => esc_html__( 'Footer Menu', 'fbthailand' ),
				'footer_bot' => esc_html__( 'Footer Bottom Menu', 'fbthailand' ),
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
				'thailand_custom_background_args',
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
	}
endif;
add_action( 'after_setup_theme', 'fbthailand_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fbthailand_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fbthailand_content_width', 640 );
}
add_action( 'after_setup_theme', 'fbthailand_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fbthailand_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fbthailand' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fbthailand' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fbthailand_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fbthailand_scripts() {
	wp_enqueue_style( 'thailand-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'thailand-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'fbthailand_scripts' );

function fbapac_thailand_assets() {
	
	global $post;
    $post_slug = $post->post_name;
	
	$thailand_version = '0.1';
	
	if($post_slug !='rediscover-thailand' and $post_slug !='rediscover-thailand-new' ){
	wp_enqueue_style( 'thailand-fontawesome', get_template_directory_uri() . '/css/all.css', array(), $thailand_version);
	wp_enqueue_style( 'thailand-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), $thailand_version);
	wp_enqueue_style( 'thailand-owl-styles', get_template_directory_uri() . '/css/owl.css', array(), $thailand_version);
    wp_enqueue_style( 'thailand-styles', get_template_directory_uri() . '/css/thailand.css', array(), $thailand_version);
	wp_enqueue_style( 'thailand-responsive', get_template_directory_uri() . '/css/responsive.css', array(), $thailand_version);
        
	wp_enqueue_script( 'thailand-jquery', get_template_directory_uri() . '/js/jquery.js', array(), $thailand_version, TRUE );
	wp_enqueue_script( 'thailand-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), $thailand_version, TRUE );
    wp_enqueue_script( 'thailand-owl-scripts', get_template_directory_uri() . '/js/owl.js', array(), $thailand_version, TRUE );
    wp_enqueue_script( 'thailand-scripts', get_template_directory_uri() . '/js/thailand.js', array(), $thailand_version, TRUE );
	}else{
//  
wp_enqueue_style( 'animate-styles', get_template_directory_uri() . '/css/animate.css?v=1.1', array(), $thailand_version);	
   wp_enqueue_style( 'aos-styles', get_template_directory_uri() . '/css/aos.css?v=1.1', array(), $thailand_version);

 wp_enqueue_style( 'thailand-bootstrap', get_template_directory_uri() . '/css/bootstrap.css?v=1.1', array(), $thailand_version);	
   wp_enqueue_style( 'css-styles', get_template_directory_uri() . '/css/css-style.css?v=1.17', array(), $thailand_version);
 wp_enqueue_style( 'thailand-owl-styles', get_template_directory_uri() . '/css/owl.carousel.css?v=1.1', array(), $thailand_version);
wp_enqueue_style( 'thailand-styles', get_template_directory_uri() . '/css/thailand.css', array(), $thailand_version);
wp_enqueue_style( 'magnific-popup-styles', get_template_directory_uri() . '/css/magnific-popup.css?v=1.1', array(), $thailand_version);

		
		
	wp_enqueue_script( 'thailand-jquery', get_template_directory_uri() . '/js/jquery.js', array(), $thailand_version, TRUE );
	wp_enqueue_script( 'thailand-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), $thailand_version, TRUE );
    wp_enqueue_script( 'thailand-owl-scripts', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), $thailand_version, TRUE );
    wp_enqueue_script( 'thailand-script', get_template_directory_uri() . '/js/script.js?v=3', array(), $thailand_version, TRUE );
	 wp_enqueue_script( 'aos-scripts', get_template_directory_uri() . '/js/aos.js?v=1', array(), $thailand_version, TRUE );
	   wp_enqueue_script( 'thailand-scripts', get_template_directory_uri() . '/js/thailand.js', array(), $thailand_version, TRUE );
	   wp_enqueue_script( 'magnific-popup-scripts', get_template_directory_uri() . '/js/magnific-popup.js', array(), $thailand_version, TRUE );

	}



}
add_action('wp_enqueue_scripts', 'fbapac_thailand_assets');

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

function get_DigitalLogo( $post_ids = array() ) {
	return new WP_Query( array(
		'post_type'   => 'digitallogo',
		'post_status'  => 'publish',
		'posts_per_page' => 80, 
		'order' => 'ASC' 
	) );
}

/**
 * Fetch Story Region
 */
function story_region() {
	return get_terms( array(
		'taxonomy' => 'story_region',
		'orderby' => 'name',
		'order' => 'ASC',
		'hide_empty' => false,
	) );
}

/**
 * Fetch Story Post based on Region
 */
function getstory_post($catname) {

	$args = array(
		'post_type' => 'success-story',
		'orderby' => 'id',
		'order' => 'ASC',
		'post_status'  => 'publish',
		'posts_per_page' => 100, 
		'ignore_sticky_posts' => 1,
		'tax_query' => array(
			array(
				'taxonomy' => 'story_region',
				'field' => 'slug',
				'terms' => $catname
			 )
		)
	);
	$query = new WP_Query( $args );
	return $query;
}
/**
 * Fetch Story Post
 */
function getstory_postall() {

	$args = array(
		'post_type' => 'success-story',
		'orderby' => 'id',
		'order' => 'ASC',
		'post_status'  => 'publish',
		'posts_per_page' => 100,
		'ignore_sticky_posts' => 1,
	);
	
	$query = new WP_Query( $args );
	return $query;
}

