<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fbiamdigital_setup() {
	load_theme_textdomain( 'fbiamdigital', get_template_directory() . '/languages' );

	add_theme_support( 'starter-content', array(
		'posts'       => array(
			'home' => array(
				'template' => 'page-templates/home.php',
			),
		),
		'attachments' => array(
			'image-favicon' => array(
				'file' => get_theme_file_path( 'images/logo-fb-512.png' ),
			),
		),
		'theme_mods'  => array(
			'site_icon' => '{{image-favicon}}',
		),
		// The 'show_on_front' value can be 'page' to show a specified page, or 'posts' to show your latest posts.
		// Note: Use page ID symbolic references from the posts section above wrapped in {{double-curly-braces}}.
		'options'     => array(
			'show_on_front'   => 'page',
			'page_on_front'   => '{{home}}',
			'blogdescription' => '',
		),
		// Set up nav menus.
		'nav_menus'   => array(
			'main_nav'   => array(
				'name'  => 'Main Navigation',
				// We can't add post type archives yet, so let's use {{home}} so that WP generates a menu
				'items' => array(
					'page_home' => array(
						'type'      => 'post_type',
						'object'    => 'page',
						'object_id' => '{{home}}',
					),
				),
			),
			'footer_nav' => array(
				'name'  => 'Footer Navigation',
				'items' => array(
					'link_about'    => array(
						'title' => _x( 'About', 'Footer Navigation', 'fbiamdigital' ),
						'link'  => esc_url( 'https://www.facebook.com/about' ),
					),
					'link_safety'   => array(
						'title' => _x( 'Safety', 'Footer Navigation', 'fbiamdigital' ),
						'link'  => esc_url( 'https://www.facebook.com/safety' ),
					),
					'link_help'     => array(
						'title' => _x( 'Help', 'Footer Navigation', 'fbiamdigital' ),
						'link'  => esc_url( 'https://www.facebook.com/help' ),
					),
					'link_newsroom' => array(
						'title' => _x( 'Newsroom', 'Footer Navigation', 'fbiamdigital' ),
						'link'  => esc_url( 'https://newsroom.fb.com' ),
					),
					'link_privacy'  => array(
						'title' => _x( 'Privacy', 'Footer Navigation', 'fbiamdigital' ),
						'link'  => esc_url( ' https://www.facebook.com/privacy/explanation' ),
					),
					'link_cookies'  => array(
						'title' => _x( 'Cookies', 'Footer Navigation', 'fbiamdigital' ),
						'link'  => esc_url( 'https://www.facebook.com/policies/cookies' ),
					),
					'link_terms'    => array(
						'title' => _x( 'Terms', 'Footer Navigation', 'fbiamdigital' ),
						'link'  => esc_url( 'https://www.facebook.com/policies' ),
					),
				),
			),
		),
	) );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'title-tag' );

	// Register Menus
	register_nav_menus( array(
		'main_nav'      => esc_html__( 'Main Navigation', 'fbiamdigital' ),
		'footer_nav'    => esc_html__( 'Footer Navigation', 'fbiamdigital' ),
		'tfooter_nav'    => esc_html__( 'Top Footer Navigation', 'fbiamdigital' ),
		'lang_switcher' => esc_html__( 'Language Switcher', 'fbiamdigital' ),
	) );
}

add_action( 'after_setup_theme', 'fbiamdigital_setup' );

/**
 * Enqueue scripts and styles.
 */
function fbiamdigital_scripts() {
	
	global $post;
    $post_slug = $post->post_name;
	
	// Theme stylesheet.
	wp_enqueue_style( 'fbiamdigital-fontawesome', get_theme_file_uri( '/styles/vendor/fontawesome.min.css' ), array(), null );
	wp_enqueue_style( 'fbiamdigital-googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,700,700i&display=swap', array(), null );
	wp_enqueue_style( 'fbiamdigital-flickity', get_theme_file_uri( '/styles/vendor/flickity.min.css' ), array(), null );
	wp_enqueue_style( 'fbiamdigital-select2', get_theme_file_uri( '/styles/vendor/select2.css' ), array(), null );
	wp_enqueue_style( 'fbiamdigital-main', get_theme_file_uri( '/styles/main.css' ), array( 'fbiamdigital-fontawesome', 'fbiamdigital-googlefonts', 'fbiamdigital-flickity', 'fbiamdigital-select2' ), null );

	wp_enqueue_style( 'fbiamdigital-custom', get_theme_file_uri( '/styles/custom.min.css' ), array( 'fbiamdigital-fontawesome', 'fbiamdigital-googlefonts', 'fbiamdigital-flickity', 'fbiamdigital-select2' ), null );
	
	wp_enqueue_style( 'fbiamdigital-taknakscam', get_theme_file_uri( '/styles/custome-taknakscam.css' ), array(), null );
	wp_enqueue_style( 'fbiamdigital-owl', get_theme_file_uri( '/styles/owl.css' ), array(), null );
	

	// Scripts
	wp_enqueue_script( 'fbiamdigital-modernizr', get_theme_file_uri( '/scripts/vendor/modernizr-custom.min.js' ), array(), null );
	wp_enqueue_script( 'fbiamdigital-flickity', get_theme_file_uri( '/scripts/vendor/flickity.pkgd.min.js' ), array( 'jquery' ), null, true );
	wp_enqueue_script( 'fbiamdigital-select2', get_theme_file_uri( '/scripts/vendor/select2.full.min.js' ), array( 'jquery' ), null, true );
	wp_enqueue_script( 'fbiamdigital-iiv', get_theme_file_uri( '/scripts/vendor/iphone-inline-video.min.js' ), array( 'jquery' ), null, true );
	wp_enqueue_script( 'fbiamdigital-inview', get_theme_file_uri( '/scripts/vendor/jquery.inview.min.js' ), array( 'jquery' ), null, true );
	wp_enqueue_script( 'fbiamdigital-rellax', get_theme_file_uri( '/scripts/vendor/rellax.min.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-jquery-validate', get_theme_file_uri( '/scripts/vendor/jquery.validate.min.js' ), array( 'jquery-form' ), null, true );
	wp_enqueue_script( 'fbiamdigital-dompurify', get_theme_file_uri( '/scripts/vendor/purify.min.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-custompc', get_theme_file_uri( '/scripts/custompc.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-owljs', get_theme_file_uri( '/scripts/owl.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-owlscript', get_theme_file_uri( '/scripts/owlscript.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-custommyscroll', get_theme_file_uri( '/scripts/custommyscroll.js' ), array(), null, true );
	if(is_page(1791)){
	//wp_enqueue_script( 'fbiamdigital-jquery', get_theme_file_uri( '/scripts/jquery.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-bootstrap', get_theme_file_uri( '/scripts/bootstrap.min.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-fsbanner', get_theme_file_uri( '/scripts/fsbanner.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-prticle', get_theme_file_uri( '/scripts/particles.min.js' ), array(), null, true );
	wp_enqueue_script( 'fbiamdigital-script', get_theme_file_uri( '/scripts/script.js' ), array(), null, true );
	
	}
	wp_register_script( 'fbiamdigital-main', get_theme_file_uri( '/scripts/main.js' ), array(
		'wp-api',
		'jquery',
		'backbone',
		'fbiamdigital-flickity',
		'fbiamdigital-modernizr',
		'fbiamdigital-select2',
		'fbiamdigital-iiv',
		'fbiamdigital-inview',
		'fbiamdigital-rellax',
		'fbiamdigital-jquery-validate',
		'fbiamdigital-dompurify',
		'fbiamdigital-custompc',
	), null, true );
	
	wp_enqueue_script( 'fbiamdigital-fancyboxjs', get_theme_file_uri( '/scripts/jquery.fancybox.min.js' ), array(), null, true );
	wp_enqueue_style( 'fbiamdigital-fancybox', get_theme_file_uri( '/styles/jquery.fancybox.min.css' ), array(), null );
	
	if(isset($_REQUEST['countries']) || isset($_REQUEST['languages'])){
		wp_enqueue_script( 'fbiamdigital-pcscroll', get_theme_file_uri( '/scripts/custompcscroll.js' ), array(), null, true );
	}
	
	if($post_slug=='apacsummit' || $post_slug=='speakers'){
		wp_enqueue_style( 'fbiamdigital-apac-animate', get_theme_file_uri( '/styles/animate.css' ), array(), null );
		wp_enqueue_style( 'fbiamdigital-apac-aos', get_theme_file_uri( '/styles/aos.css' ), array(), null );
		wp_enqueue_style( 'fbiamdigital-apac-bootstrap', get_theme_file_uri( '/styles/bootstrap.min.css' ), array(), null );
		wp_enqueue_style( 'fbiamdigital-apac-style', get_theme_file_uri( '/styles/apacsummit.css' ), array(), null );;
		wp_enqueue_script( 'fbiamdigital-apacj-aos', get_theme_file_uri( '/scripts/aos.js' ), array(), null, true );
		wp_enqueue_script( 'fbiamdigital-apacj-bootstrap', get_theme_file_uri( '/scripts/bootstrap.min.js' ), array(), null, true );
		wp_enqueue_script( 'fbiamdigital-apacj-apacsummit', get_theme_file_uri( '/scripts/apacsummit.js' ), array(), null, true );
	}
	
	if($post_slug==='interactive-content'){
		wp_enqueue_style( 'fbiamdigital-apac-bootstrap', get_theme_file_uri( '/styles/bootstrap.min.css' ), array(), null );
		wp_enqueue_script( 'fbiamdigital-apacj-bootstrap', get_theme_file_uri( '/scripts/bootstrap.min.js' ), array(),null,true);
	}
	
	wp_enqueue_style( 'fbiamdigital-apac-scam', get_theme_file_uri( '/styles/security-scam.css' ), array(), null );
		
	$localize_data = array(
		'themeFileUri' => get_theme_file_uri(),
	);
	wp_localize_script( 'fbiamdigital-main', 'fbiamdigital', $localize_data );
	wp_enqueue_script( 'fbiamdigital-main' );
}

add_action( 'wp_enqueue_scripts', 'fbiamdigital_scripts' );

/**
 * Retrieves the first term object for a post
 *
 * @param int|object $post Post ID or object.
 * @param string     $taxonomy Taxonomy name.
 *
 * @return bool|WP_Term|WP_Error
 */
function fbiamdigital_get_the_first_term( $post, $taxonomy ) {
	$terms = get_the_terms( $post, $taxonomy );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		return $terms[0];
	}

	return false;
}

/**
 * Format the stored values for resource attachments to an easy to
 * use array
 *
 * @param $field_group array The post meta custom field
 *
 * @return array
 */
function fbiamdigital_get_resource_attachment( $field_group ) {
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
					), $defaults );
				case 'link':
					return wp_parse_args( array(
						'url'           => $downloadable_attachment_fields['url'],
						'resource_type' => $type,
						// Add check for legacy reasons as this is a new field
						'content_type'  => ! empty( $downloadable_attachment_fields['type'] ) ? $downloadable_attachment_fields['type'] : 'website',
					), $defaults );
				case 'video':
					return wp_parse_args( array(
						'url'           => wp_get_attachment_url( $downloadable_attachment_fields['file'] ),
						'resource_type' => $type,
						'preview_img'   => wp_get_attachment_url( $downloadable_attachment_fields['preview_img'] ),
						// Add check for legacy reasons as this is a new field
						'content_type'  => ! empty( $downloadable_attachment_fields['type'] ) ? $downloadable_attachment_fields['type'] : 'video',
					), $defaults );
			}
		}
	}

	return array();
}

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

/*function fbiamdigital_get_terms1( $args ) {
	$defaults = array(
		'hide_empty'       => true,
		'include_children' => false,
		'orderby' => 'id',
		'order' => 'ASC'
	);

	$args = wp_parse_args( $args, $defaults );

	return get_terms( $args );
}*/

/**
 * Retrieves `story` posts
 *
 * @param array $post_ids
 *
 * @return WP_Query
 */
function fbiamdigital_get_related_story_posts( $post_ids = array() ) {
	return new WP_Query( array(
		'post_type'           => 'story',
		'post_status'         => 'publish',
		'post__in'            => $post_ids,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'posts_per_page'      => 3,
	) );
}

/**
 * Returns an array of post IDs from `story` related field
 *
 * @param array $related_posts_meta
 *
 * @return array
 */
function fbiamdigital_parse_ids_from_related_story_post_meta( $related_posts_meta = array() ) {
	return array_map( function ( $p ) {
		return $p['post_id'];
	}, $related_posts_meta );
}

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
				$country_code   = 'intl';
				$url            = get_site_url( 1 );
				$menu_item_name = _x( 'International', 'Countries', 'fbiamdigital' );
			} else if ( count( $country_lang_data ) === 2 ) {
				$country_code   = array_shift( $country_lang_data );
				$url            = get_site_url( 1, $country_code );
				if($country_code==='sg')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/sg/en-sg/stayingsafeonline/';
					}
				}
				if($country_code==='pk')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/pk/ur-pk/stayingsafeonline/';
					}
				}
				if($country_code==='pc')
				{
					$siteurl = esc_url(get_site_url());
					$expurl = explode('/',$siteurl);
					
					if (!empty($expurl)){
						$finalurl = $expurl[0].'//'.$expurl[2];
						$url = $finalurl.'/pc/en-us/iamdigital/';
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

/**
 * Get resources by audience
 *
 * @param $audience_term_slug
 *
 * @return WP_Query
 */
function fbiamdigital_get_suggested_resources() {
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
 * Checks if homepage sections (excluding funfacts) have content
 *
 * @param $section
 *
 * @return bool
 */
function fbiamdigital_home_section_has_content( $section ) {
	return ! empty( $section['heading'] ) && ! empty( $section['description'] );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
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

add_filter( 'upload_size_limit', function() {
	return 1073741824 * 2; // pow( 2, 30 )
});

function is_template2() {
	return is_page_template('page-templates/home2.php');
}

function get_partners_enhancement_sort($param_country) {
	$init = $featured = $countrySelected = $rest = array(
		'post_type' => 'partner',
		'posts_per_page'   => -1,
		'post_status' => 'publish',		
		'orderby' => 'title',
		'order' => 'ASC'
	);

	// Filter by featured
	$featured['meta_query'] = array(
		array( 
			'key' => 'is_featured',
            'compare' => '=',
			'value' => '1'
		)
	);
	$featured['meta_key'] = 'featured_priority';
	$featured['meta_type'] = 'NUMERIC';
	$featured['orderby'] = 'meta_value_num';

	// Filter by country selected
	$countrySelected['tax_query'] = array(
		array (
			'taxonomy' => 'country',
			'field' => 'slug',
			'terms' => $param_country
		)
	);	
	$countrySelected['meta_query'] = array(
		'relation' => 'OR',
		array( 
			'key' => 'is_featured',
            'compare' => 'NOT EXISTS',
			'value' => ''
		),
		array( 
			'key' => 'is_featured',
            'compare' => '!=',
			'value' => '1'
		)
	);
	
	// Filter by rest
	$rest['tax_query'] = array(
		array (
			'taxonomy' => 'country',
			'field' => 'slug',
			'terms' => array( $param_country ),
			'operator' => 'NOT IN'
		)
	);
	$rest['meta_query'] = array(
        'relation' => 'OR',
		array( 
			'key' => 'is_featured',
            'compare' => 'NOT EXISTS',
			'value' => ''
		),
		array( 
			'key' => 'is_featured',
            'compare' => '!=',
			'value' => '1'
		)
	);

	$the_feature = new WP_Query( $featured );
	$the_country = new WP_Query( $countrySelected );
	$the_rest = new WP_Query( $rest );

	//create new empty query and populate it with the other two
	$the_query = new WP_Query();
	$the_query->posts = array_merge( $the_feature->posts, $the_country->posts, $the_rest->posts );

	//populate post_count count for the loop to work correctly
	$the_query->post_count = $the_feature->post_count + $the_country->post_count + $the_rest->post_count;

	return $the_query;
}

/**
 * Retrieves `kid resource` posts
 *
 * @param array $post_ids
 *
 * @return WP_Query
 */
function get_KidResources( $post_ids = array() ) {
	return new WP_Query( array(
		'post_type'   => 'kid-resource',
		'post_status'  => 'publish',
		'posts_per_page' => 80, 
		'order' => 'ASC' 
	) );
}

/**
 * Retrieves `Events` posts
 *
 * @param array $post_ids
 *
 * @return WP_Query
 */
function get_EventsHome( $post_ids = array() ) {
	return new WP_Query( array(
		'post_type'   => 'homeevents',
		'post_status'  => 'publish',
		'posts_per_page' => 2, 
		'order' => 'DESC' 
	) );
}

/**
 * Retrieves Video posts
 *
 * @param array $post_ids
 *
 * @return WP_Query
 */
function get_Video( $post_ids = array() ) {
	return new WP_Query( array(
		'post_type'   => 'videos',
		'post_status'  => 'publish',
		'posts_per_page' => 10, 
		'order' => 'ASC' 
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