<?php
/**
 * wethinkdigital2022 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wethinkdigital2022
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wethinkdigital2022_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wethinkdigital2022, use a find and replace
		* to change 'wethinkdigital2022' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wethinkdigital2022', get_template_directory() . '/languages' );

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
	/*register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'wethinkdigital2022' ),
		)
	);*/
	register_nav_menus( array(
		'main_nav'      => esc_html__( 'Main Navigation', 'wethinkdigital2022' ),
		'footer_nav'    => esc_html__( 'Footer Navigation', 'wethinkdigital2022' ),
		'lang_switcher' => esc_html__( 'Language Switcher', 'wethinkdigital2022' ),
		'bfooter_nav'    => esc_html__( 'Bottom Footer Navigation', 'wethinkdigital2022' ),
	) );

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
			'wethinkdigital2022_custom_background_args',
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
add_action( 'after_setup_theme', 'wethinkdigital2022_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wethinkdigital2022_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wethinkdigital2022_content_width', 640 );
}
add_action( 'after_setup_theme', 'wethinkdigital2022_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wethinkdigital2022_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wethinkdigital2022' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wethinkdigital2022' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wethinkdigital2022_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wethinkdigital2022_scripts() {
	wp_enqueue_style( 'wethinkdigital2022-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wethinkdigital2022-style', 'rtl', 'replace' );
	
	$siteurl = esc_url(get_site_url());
	$expurl = explode('/',$siteurl);
	$finalurl = '/'.$expurl[3].'/'.$expurl[4].'/';
	if($finalurl === (string)'/vn/vi/')
	{ wp_enqueue_style( 'wtd-font', get_template_directory_uri(). '/css/opt-vietnamese.css', array(), null ); }
	else if($finalurl === (string)'/in/hi-in/' || $finalurl === (string)'/in/mr-in/')
	{ wp_enqueue_style( 'wtd-font', get_template_directory_uri(). '/css/opt-devanagari.css', array(), null ); }
	else if($finalurl === (string)'/mn/mn-mn/' )
	{ wp_enqueue_style( 'wtd-font', get_template_directory_uri(). '/css/opt-cyrillic.css', array(), null ); }
	else if($finalurl === (string)'/pk/ur-pk/' )
	{ wp_enqueue_style( 'wtd-font', get_template_directory_uri(). '/css/opt-arabic.css', array(), null ); }
	else
	{ wp_enqueue_style( 'wtd-font', get_template_directory_uri(). '/css/opt-latin.css', array(), null ); }

	wp_enqueue_style( 'wtd-bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), null );
	wp_enqueue_style( 'shemb-fontawesome', get_template_directory_uri(). '/css/all.css', array(), null );
	wp_enqueue_style( 'wtd-owlcarousel', get_template_directory_uri(). '/css/owl.carousel.css', array(), null );
	wp_enqueue_style( 'wtd-magnificpopup', get_template_directory_uri(). '/css/magnific-popup.css', array(), null );
	wp_enqueue_style( 'wtd-style', get_template_directory_uri(). '/css/style.css', array(), null );
	wp_enqueue_style( 'wtd-css-style', get_template_directory_uri(). '/css/css-style.css', array(), null );
	
	wp_enqueue_script( 'wtd-jquery', get_template_directory_uri() . '/js/jquery.js', array(), null, true );
	wp_enqueue_script( 'wtd-bootstrapmin', get_template_directory_uri() . '/js/bootstrap.min.js', array(), null, true );
	wp_enqueue_script( 'wtd-owl-min', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), null, true );
	wp_enqueue_script( 'wtd-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array(), null, true );
	wp_enqueue_script( 'fbiamdigital-custompc', get_theme_file_uri( '/js/custompc.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-custommyscroll', get_theme_file_uri( '/js/custommyscroll.js' ), array(), null, true );
	if(isset($_REQUEST['countries']) || isset($_REQUEST['languages'])){
		wp_enqueue_script( 'fbiamdigital-pcscroll', get_theme_file_uri( '/js/custompcscroll.js' ), array(), null, true );
	}
	if(is_page('apacsummit')){
		wp_enqueue_style( 'wtd-aos', get_template_directory_uri(). '/css/aos.css', array(), null );
		wp_enqueue_script( 'wtd-aos', get_template_directory_uri() . '/js/aos.js', array(), null, true );
	}
	wp_enqueue_script( 'wtd-script', get_template_directory_uri() . '/js/script.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'wethinkdigital2022_scripts' );

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
//video post
function get_Video( $post_ids = array() ) {
	return new WP_Query( array(
		'post_type'   => 'videos',
		'post_status'  => 'publish',
		'posts_per_page' => 10, 
		'order' => 'ASC' 
	) );
}

/**
 * Wrapper function to include additional defaults for WP get_terms()
 *
 * @param $args
 *
 * @return array|int|WP_Error
 * @see get_terms()
 *
 */
function WTD_get_terms( $args ) {
	$defaults = array(
		'hide_empty'       => true,
		'include_children' => false,
	);
	$args = wp_parse_args( $args, $defaults );
	return get_terms( $args );
}
function add_query_vars_filter( $vars ){
  $vars[] = "countries";
  $vars[] = "languages";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );
/**
 * Format the stored values for resource attachments to an easy to
 * use array
 *
 * @param $field_group array The post meta custom field
 *
 * @return array
 */
function wethinkdigital2022_get_resource_attachment( $field_group ) {
	if ( ! empty( $field_group ) ) {
		$defaults = array(
			'url'           => '',
			'resource_type' => '',
			'size'          => '',
			'content_type'  => '',
			
		);

		foreach ( $field_group as $field_data ) {
			$type                           = $field_data['resource_type'];
			$downloadable_attachment_fields = $field_data["resource_{$type}_fields"];
			$size                           = '';
			if ( ! empty( $downloadable_attachment_fields['size'] ) && intval( $downloadable_attachment_fields['size'] ) > 0 ) {
				$size = size_format( $downloadable_attachment_fields['size'] );
			}

			switch ( $type ) {
				case 'download':
					return wp_parse_args( array(
						'url'           => wp_get_attachment_url( $downloadable_attachment_fields['file'] ),
						'resource_type' => $type,
						'size'          => $size,
						'content_type'  => $downloadable_attachment_fields['type'],
						'cta_btn_txt'   =>  $field_data['cta_btn_txt'],
						'typeofcontent' =>  $field_data['typeofcontent_txt'],
					), $defaults );
				case 'link':
					return wp_parse_args( array(
						'url'           => $downloadable_attachment_fields['url'],
						'resource_type' => $type,
						// Add check for legacy reasons as this is a new field
						'content_type'  => ! empty( $downloadable_attachment_fields['type'] ) ? $downloadable_attachment_fields['type'] : 'website',
						'cta_btn_txt'   =>  $field_data['cta_btn_txt'],
						'typeofcontent' =>  $field_data['typeofcontent_txt'],

					), $defaults );
				case 'video':
					return wp_parse_args( array(
						'url'           => wp_get_attachment_url( $downloadable_attachment_fields['file'] ),
						'resource_type' => $type,
						'preview_img'   => wp_get_attachment_url( $downloadable_attachment_fields['preview_img'] ),
						// Add check for legacy reasons as this is a new field
						'content_type'  => ! empty( $downloadable_attachment_fields['type'] ) ? $downloadable_attachment_fields['type'] : 'video',
						'cta_btn_txt'   =>  $field_data['cta_btn_txt'],
						'typeofcontent' =>  $field_data['typeofcontent_txt'],

					), $defaults );
				case 'content':
					return wp_parse_args( array(
						'con_fields'  => $downloadable_attachment_fields,
						'resource_type' => $type,
						'content_type'  => ! empty( $downloadable_attachment_fields['type'] ) ? $downloadable_attachment_fields['type'] : 'content',
						'cta_btn_txt'   =>  $field_data['cta_btn_txt'],
						'typeofcontent' =>  $field_data['typeofcontent_txt'],

						
					), $defaults );
			}
		}
	}

	return array();
}

/**
 * Build sites data for displaying in site selector
 * @return array
 */
function wethinkdigital2022_get_site_selector_data() {
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
				$country_code   = 'intl';
				$url            = get_site_url( 1 );
				$menu_item_name = _x( 'International', 'Countries', 'wethinkdigital2022' );
			} else if ( count( $country_lang_data ) === 2 ) {
				$country_code   = array_shift( $country_lang_data );
				$url            = get_site_url( 1, $country_code );
				if($country_code==='sg')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/sg/en-sg';
					}
				}
				if($country_code==='pk')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/pk/en-pk/';
					}
				}
				if($country_code==='pc')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/pc/en-us/';
					}
				}
				if($country_code==='my')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/my/bm-my/';
					}
				}
				if($country_code==='ph')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/ph/en-ph/';
					}
				}
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
			if (!empty($country_lang['code'])) { //cho '<br>'.$country_lang;
				//if($country_code==='my'){ sort($country_lang); print_r($country_lang); echo '@@@'; }
				//echo gettype($country_lang).'----'.$country_lang['code'];
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

/**
 * Get resources by audience
 *
 * @param $audience_term_slug
 *
 * @return WP_Query
 */
function wethinkdigital2022_get_suggested_resources() {
	return new WP_Query( array(
		'post_type'           => 'resource',
		'post_status'         => 'publish',
		'posts_per_page'      => 6,
		'meta_key'            => 'wpfp_featured',
		'orderby'             => array(
			'meta_value_num' => 'DESC',
			'title'          => 'ASC',
		),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	) );
}

/**
 * Retrieves Shopping scam
 *
 * @param array $post_ids
 *
 * @return WP_Query
 */
function get_shopscam( $post_ids = array() ) {
	return new WP_Query( array(
		'post_type'   => 'shoppingscam',
		'post_status'  => 'publish',
		'posts_per_page' => 30, 
		'order' => 'DESC' 
	) );
}

function mytheme_customize_register( $wp_customize ) {
    $wp_customize->add_setting('mobile_header_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mobile_header_logo', array(
        'label' => 'Mobile Header Logo',
        'section' => 'title_tagline', 
        'settings' => 'mobile_header_logo',
        'priority' => 8 
    )));

}
add_action( 'customize_register', 'mytheme_customize_register' );

/**
 * Wrapper function to include additional defaults for WP get_terms()
 *
 * @param $args
 *
 * @return array|int|WP_Error
 * @see get_terms()
 *
 */
function fbiamdigital_get_terms( $args ) {
	$defaults = array(
		'hide_empty'       => true,
		'include_children' => false,
	);

	$args = wp_parse_args( $args, $defaults );

	return get_terms( $args );
}
function get_firstlan( $tid )
{						
	$taxonomy_name = 'pccountry';
	$termchildren = get_term_children( $tid, $taxonomy_name );
	foreach ( $termchildren as $child ) {
		$fterm = get_term_by( 'id', $child, $taxonomy_name );
		if(strtolower($fterm->name)==='english')
		{ $englan = $fterm->slug; }
	}
	return $englan;
}




