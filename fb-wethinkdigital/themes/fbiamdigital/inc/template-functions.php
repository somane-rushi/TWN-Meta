<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package fbiamdigital
 */

/**
 * Modify queries for custom post types
 *
 * @param WP_Query $query
 */
function fbiamdigital_post_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( array( 'story', 'resource' ) ) ) {
		$query->set( 'posts_per_page', 9 );

		if ( is_post_type_archive( 'resource' ) ) {
			$query->set( 'meta_key', 'wpfp_featured' );
			$query->set( 'orderby', array(
				'meta_value_num' => 'DESC',
				'title'          => 'ASC',
			) );
		}

		return;
	}

	if ( is_post_type_archive( array( 'partner', 'committee' ) ) ) {
		$query->set( 'posts_per_page', 8 );

		if ( is_post_type_archive( 'partner' ) ) {
			$query->set( 'order', 'ASC' );
			$query->set( 'orderby', 'title' );
		}

		return;
	}
	if ( is_post_type_archive( array( 'taknakscam' ) ) ) {
		$takyear = gmdate('Y');
		if(isset($_GET['taknakYear'])) { if( !empty($_GET['taknakYear']) ) { $takyear = sanitize_key($_GET['taknakYear']); } }
		$query->set( 'posts_per_page', 30 );
		if ( is_post_type_archive( 'taknakscam' ) ) {
			$query->set( 'tax_query', array(
				array(
					'taxonomy' => 'takyear',
					'field' => 'slug',
					'terms' => $takyear,
				)
			));
			$query->set( 'orderby', array(
				'id' => 'DESC',
			) );
		}
		return;
	}
	
}

add_action( 'pre_get_posts', 'fbiamdigital_post_query', 1 );

/**
 * GDPR plugin customizations
 */
function fbiamdigital_gdpr_plugin() {
	// Add GDPR plugin custom styles
	if ( wp_style_is( 'gdpr', 'enqueued' ) ) {
		$gdpr_plugin_custom_styles = '.gdpr .gdpr-preferences { display: none; } .gdpr .gdpr-content a { color: #fff; }';
		wp_add_inline_style( 'gdpr', $gdpr_plugin_custom_styles );
	}
}

add_action( 'wp_enqueue_scripts', 'fbiamdigital_gdpr_plugin' );

/**
 * Resources access lead submit handler
 */
function fbiamdigital_resources_access_form_submit_callback() {
	check_ajax_referer( 'resources_access_lead_submit', 'resources_access_form_nonce' );

	// Default form data
	$form_data = array(
		'first_name' => '',
		'last_name'  => '',
		'email'      => '',
		'company'    => '',
		'job_title'  => '',
		'agree'      => '',
	);

	// Sanitize our inputs
	foreach ( array_keys( $form_data ) as $name ) {
		$form_data[ $name ] = ! empty( $_POST[ $name ] ) ? sanitize_text_field( $_POST[ $name ] ) : '';
	}

	// Check if user has agreed, do not proceed otherwise
	if ( $form_data['agree'] !== 'YES' ) {
		wp_die( wp_json_encode( array(
			'status'  => 'error',
			'message' => 'user must agree to terms.',
		) ) );
	}

	// Add additional data for sending to salesforce
	$form_data['country'] = '';
	$form_data['lang']    = 'EN';

	// Send resource form data to Salesforce
	if ( 'production' === VIP_GO_ENV ) {
		fbiamdigital_post_salesforce_leads( $form_data );
	}

	wp_die( wp_json_encode( array(
		'status' => 'success',
	) ) );
}

add_action( 'wp_ajax_resources_access_lead_submit', 'fbiamdigital_resources_access_form_submit_callback' );
add_action( 'wp_ajax_nopriv_resources_access_lead_submit', 'fbiamdigital_resources_access_form_submit_callback' );

/**
 * Hook to output Google Tag Manager Code
 */
function fbiamdigital_gtm_code() {
	if ( VIP_GO_ENV === 'production' ) {
		// @formatter:off
		?>
<!-- Google Tag Manager -->
<script>
if (window.gdprSafeTrack) {
	window.gdprSafeTrack(function() {
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-KPLNN68');
	});
}
</script>
<!-- End Google Tag Manager -->
		<?php
		// @formatter:on
	}
}

add_action( 'wp_head', 'fbiamdigital_gtm_code' );

/**
 * Add active class to post type archive menu link when in single post page
 *
 * @param $classes
 * @param $item
 *
 * @return array
 */
function fbiamdigital_nav_menu_active_css_class( $classes, $item ) {
	// If on story or program single post, and our menu item is a post type archive link
	if ( is_singular( array( 'story', 'program' ) ) && $item->type === 'post_type_archive' ) {
		$post = get_queried_object();

		// Check that the current post type is same as the menu item post type
		// Partners are linked to programs via partner archive page
		if ( $post->post_type === $item->object ||
		     $post->post_type === 'program' && $item->object === 'partner'
		) {
			$classes[] = 'current-menu-item';
		}
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'fbiamdigital_nav_menu_active_css_class', 10, 2 );

/**
 * Add supported post types for featuring
 * @return array
 */
function fbiamdigital_wpfp_allowed_post_types() {
	return array( 'resource' );
}

add_filter( 'wpfp/allowed_post_types', 'fbiamdigital_wpfp_allowed_post_types' );

/**
 * Add custom body classes
 * @return array
 */
function fbiamdigital_body_class( $classes ) {
	$blog_details = get_blog_details();

	$country_lang_data = explode( '/', trim( $blog_details->path, '/' ) );
	$country_code      = '';

	if ( $blog_details->path === '/' ) {
		$country_code = 'intl';
	} else if ( count( $country_lang_data ) === 2 ) {
		$country_code = array_shift( $country_lang_data );
	}

	$classes[] = "site-{$country_code}";

	return $classes;
}

add_filter( 'body_class', 'fbiamdigital_body_class' );

/**
 * Alter different parts of the query
 *
 * @param array $clauses
 *
 * @return array $clauses
 */
function fbiamdigital_posts_clauses( $clauses ) {
	global $wpdb;

	$partner_archive_fields = get_option( 'archive_partner' );

	/**
	 * Order partner archive by a primary term (usually same country as site), and then
	 * by partner title.
	 */
	if (
		! is_admin() &&
		is_main_query() &&
		is_post_type_archive( 'partner' ) &&
		empty( get_query_var( 'country', false ) ) &&
		is_array( $partner_archive_fields ) && array_key_exists( 'primary_country_id', $partner_archive_fields ) &&
		! empty( intval( $partner_archive_fields['primary_country_id'] ) )
	) {
		$primary_term_id = intval( $partner_archive_fields['primary_country_id'] );

		$clauses['join']    = "
		LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
		LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
		LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
		";
		$clauses['orderby'] = "$wpdb->terms.term_id = $primary_term_id DESC," . $clauses['orderby'];
	}

	return $clauses;
}

add_filter( 'posts_clauses', 'fbiamdigital_posts_clauses', 20, 1 );

/**
 * Custom customizer settings
 *
 * @param $wp_customize WP_Customize_Manager
 */
function fbiamdigital_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'fbiamdigital_custom_logo', array(
		'type'      => 'theme_mod',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'fbiamdigital_custom_logo',
		array(
			'label'         => __( 'Logo', 'fbiamdigital' ),
			'section'       => 'title_tagline',
			'settings'      => 'fbiamdigital_custom_logo',
			'description'   => __( 'Logo image should have a height of at least 68 pixels.', 'fbiamdigital' ),
			'button_labels' => array(
				'select'       => __( 'Select logo' ),
				'change'       => __( 'Change logo' ),
				'remove'       => __( 'Remove' ),
				'default'      => __( 'Default' ),
				'placeholder'  => __( 'No logo selected' ),
				'frame_title'  => __( 'Select logo' ),
				'frame_button' => __( 'Choose logo' ),
			),
		)
	) );
}

add_action( 'customize_register', 'fbiamdigital_customize_register' );