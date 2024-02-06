<?php

// Make sure the GOOGLE_TAG_MANAGER_ID is defined
if ( ! defined( 'GOOGLE_TAG_MANAGER_ID' ) ) {
	define( 'GOOGLE_TAG_MANAGER_ID', '' );
}

/**
 * facebook-initiatives functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package facebook-initiatives
 */

if ( ! function_exists( 'facebook_initiatives_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function facebook_initiatives_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on facebook-initiatives, use a find and replace
		 * to change 'facebook-initiatives' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'facebook-initiatives', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', '_s' ),
				'menu-2' => esc_html__( 'Secondary', '_s' ),
				'menu-3' => esc_html__( 'Third', '_s' ),
				'menu-4' => esc_html__( 'Fouth', '_s' ),
				'menu-5' => esc_html__( 'Fifth', '_s' ),
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'facebook_initiatives_custom_background_args', array(
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
			'custom-logo', array(
				'width'       => 406,
				'height'      => 46,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'facebook_initiatives_setup' );

/**
 * Create a Customizer setting for the light version of the logo
 */
function light_logo_customizer_setting( $wp_customize ) {
	$wp_customize->add_setting( 'custom_logo_light' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_light',
		array(
			'label'    => __( 'Upload Light Logo', 'facebook-initiatives' ),
			'section'  => 'title_tagline',
			'settings' => 'custom_logo_light',
		)
	) );
}

add_action( 'customize_register', 'light_logo_customizer_setting' );

/**
 * Create a Customizer setting for the about us section
 */
function about_us_customizer_setting( $wp_customize ) {
	$wp_customize->add_setting( 'show_about_us', array(
		'default' => '1',
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'show_about_us',
			array(
				'label'    => __( 'Show About Us section', 'facebook-initiatives' ),
				'section'  => 'static_front_page',
				'settings' => 'show_about_us',
				'type'     => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting( 'about_us_blue', array(
		'default' => '0',
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'about_us_blue',
			array(
				'label'    => __( 'Make Partner section blue', 'facebook-initiatives' ),
				'section'  => 'static_front_page',
				'settings' => 'about_us_blue',
				'type'     => 'checkbox',
			)
		)
	);
}

add_action( 'customize_register', 'about_us_customizer_setting' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function facebook_initiatives_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'facebook_initiatives_content_width', 640 );
}

add_action( 'after_setup_theme', 'facebook_initiatives_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function facebook_initiatives_scripts() {
	wp_enqueue_style( 'facebook-initiatives-style', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime( get_template_directory() . '/assets/css/main.css' ) );
	wp_enqueue_script( 'facebook-initiatives-script', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime( get_template_directory() . '/assets/js/main.js' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'facebook_initiatives_scripts' );

add_filter(
	'walker_nav_menu_start_el', function ( $item_output, $item, $depth, $args ) {
	if ( 'menu-2' === $args->theme_location ) {
		$item_output = str_replace( '<a ', '<a data-smooth-scroll ', $item_output );
	}

	return $item_output;
}, 10, 4
);

/**
 *  Add GTM container code
 *
 */
function add_gtm_container_code() {
	echo "<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>";
	echo '
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push(
{\'gtm.start\': new Date().getTime(),event:\'gtm.js\'}
);var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'' . esc_js( GOOGLE_TAG_MANAGER_ID ) . '\');</script>
<!-- End Google Tag Manager -->
	';

}

add_action( 'wp_head', 'add_gtm_container_code' );
function add_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'Cookies',
			'id'            => 'cookies',
			'before_widget' => '<div class="cookies-container">',
			'after_widget'  => '<div class="dismiss" id="dismiss" onClick="hideCookies();"></div></div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}
add_action( 'widgets_init', 'add_widgets_init' );
function gtm_add() {
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo rawurlencode( GOOGLE_TAG_MANAGER_ID ); ?>"
		        height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}

add_action( 'after_body', 'gtm_add' );

/**
 * Custom walker for Dot Menu.
 */
class Initiatives_Dot_Menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$anchor_link = array_filter( explode( '/', $item->url ) );
		$anchor_link = end( $anchor_link );

		$output .= sprintf(
			"\n
			<li><a data-smooth-scroll href='%s' data-section='%s'>
				<span class='label'>%s</span><span class='dot'></span></a></li>
			\n",
			esc_url( $item->url ),
			esc_attr( $anchor_link ),
			esc_html( $item->title )
		);
	}
}

class Initiatives_Expand_Menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$anchor_link = array_filter( explode( '/', $item->url ) );
		$anchor_link = end( $anchor_link );

		$output .= sprintf( "\n<li><a data-smooth-scroll href='%s' data-section='%s'><span class='label'>%s</span></a></li>\n",
			esc_url( $item->url ),
			esc_attr( $anchor_link ),
			esc_html( $item->title )
		);
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/assets/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/assets/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/assets/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/assets/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/assets/inc/jetpack.php';
}

function facebook_after_body() {
	?>
	<div id="fb - root"></div>
	<script>(function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<?php
}

add_action( 'after_body', 'facebook_after_body' );

// TinyMCE Editor -----------------------------------------------------------------

// Add the new Style dropdown to the editor
function my_mce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons', 'my_mce_buttons' );

// Setup new styles
function my_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(
		array(
			'title' => 'Blue',
			'inline' => 'span',
			'classes' => 'blue-secondary',
		),
	);
	$init_array['style_formats'] = wp_json_encode( $style_formats );
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

// Add style to preview
function wpdocs_theme_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

/**
 * @param $locale
 *
 * @return string
 */
function facebook_theme_localized( $locale ) {
    if ( class_exists( 'Mlp_Helpers' ) ) {
        $lang = Mlp_Helpers::get_current_blog_language();
        if ( $lang ) {
            $locale = $lang;
        }
    }

    return $locale;
}

add_filter( 'theme_locale', 'facebook_theme_localized' );
