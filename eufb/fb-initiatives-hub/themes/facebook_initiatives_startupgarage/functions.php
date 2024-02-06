<?php

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
				'menu-languages' => esc_html__( 'Language picker', '_s' ),
				'menu-main'      => esc_html__( 'Main navigation', '_s' ),
				'menu-mobile'    => esc_html__( 'Main navigation (Mobile)', '_s' ),
				'menu-mobile-2'  => esc_html__( 'Language picker (Mobile) ', '_s' ),
				'menu-mobile-3'  => esc_html__( 'Apply (Mobile) ', '_s' ),
				'menu-footer'    => esc_html__( 'Footer link', '_s' ),
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
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'facebook_initiatives_setup' );
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
/**
 * Enqueue scripts and styles.
 */
function facebook_initiatives_scripts_2() {
	wp_enqueue_style( 'facebook-initiatives-style', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime( get_template_directory() . '/assets/css/main.css' ) );

	wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.2.1.min.js', filemtime( get_template_directory() . '/assets/js/jquery-3.2.1.min.js' ), true );
	wp_register_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', filemtime( get_template_directory() . '/assets/js/jquery-3.2.1.min.js' ), true );
	wp_register_script( 'vendor', get_template_directory_uri() . '/assets/js/vendor.min.js', filemtime( get_template_directory() . '/assets/js/jquery-3.2.1.min.js' ), true );
	wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', filemtime( get_template_directory() . '/assets/js/slick.min.js' ), true );

	wp_enqueue_script( 'facebook-initiatives-script', get_template_directory_uri() . '/assets/js/main.js', array(
		'jquery',
		'popper',
		'vendor',
		'slick'
	), filemtime( get_template_directory() . '/assets/js/main.js' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'facebook_initiatives_scripts_2' );

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

/**
 *  Add GTM container code
 *
 */
function add_gtm_container_code_2() {
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

add_action( 'wp_head', 'add_gtm_container_code_2' );

function gtm_add_2() {
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_html( GOOGLE_TAG_MANAGER_ID ); ?>"
		        height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}

add_action( 'after_body', 'gtm_add_2' );
