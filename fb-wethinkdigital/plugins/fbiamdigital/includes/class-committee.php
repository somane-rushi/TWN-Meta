<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Committee
 * @package Fbiamdigital_Site_Plugin
 */
class Committee {

	/**
	 * @var string
	 */
	var $post_type = 'committee';

	/**
	 * Committee constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_filter( 'admin_post_thumbnail_html', array( $this, 'custom_post_thumbnail_metabox_description' ), 10, 2 );
		add_filter( 'enter_title_here', array( $this, 'custom_title_placeholder' ), 10, 2 );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10,3 );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'Committee', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Committee', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Committee', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Committee', 'fbiamdigital' ),
			'archives'              => __( 'Committee', 'fbiamdigital' ),
			'attributes'            => __( 'Item Attributes', 'fbiamdigital' ),
			'parent_item_colon'     => __( 'Parent Item:', 'fbiamdigital' ),
			'all_items'             => __( 'All Members', 'fbiamdigital' ),
			'add_new_item'          => __( 'Add New Member', 'fbiamdigital' ),
			'add_new'               => __( 'Add New', 'fbiamdigital' ),
			'new_item'              => __( 'New Member', 'fbiamdigital' ),
			'edit_item'             => __( 'Edit Member', 'fbiamdigital' ),
			'update_item'           => __( 'Update Member', 'fbiamdigital' ),
			'view_item'             => __( 'View Member', 'fbiamdigital' ),
			'view_items'            => __( 'View Committee', 'fbiamdigital' ),
			'search_items'          => __( 'Search Members', 'fbiamdigital' ),
			'not_found'             => __( 'Not found', 'fbiamdigital' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fbiamdigital' ),
			'featured_image'        => __( 'Featured Image', 'fbiamdigital' ),
			'set_featured_image'    => __( 'Set featured image', 'fbiamdigital' ),
			'remove_featured_image' => __( 'Remove featured image', 'fbiamdigital' ),
			'use_featured_image'    => __( 'Use as featured image', 'fbiamdigital' ),
			'insert_into_item'      => __( 'Insert into item', 'fbiamdigital' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'fbiamdigital' ),
			'items_list'            => __( 'Items list', 'fbiamdigital' ),
			'items_list_navigation' => __( 'Items list navigation', 'fbiamdigital' ),
			'filter_items_list'     => __( 'Filter items list', 'fbiamdigital' ),
		);
		$args   = array(
			'label'               => __( 'Committee', 'fbiamdigital' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => 'committee',
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( $this->post_type, $args );
	}

	/**
	 * Add custom description for post thumbnail meta box
	 */
	public function custom_post_thumbnail_metabox_description( $content, $post_id ) {
		if ( $this->post_type !== get_post_type( $post_id ) ) {
			return $content;
		}
		$caption = '<p>' . esc_html__( 'Recommended size: 724x688px or 362x344px', 'fbiamdigital' ) . '</p>';

		return $content . $caption;
	}

	/**
	 * Add custom text for title placeholder
	 */
	public function custom_title_placeholder( $content, $post ) {
		if ( $this->post_type !== get_post_type( $post->ID ) ) {
			return $content;
		}

		return __( 'Enter name here' );
	}

	/**
	 * Don't allow single post type viewing
	 */
	public function redirect_single_to_archive() {
		if ( is_singular( $this->post_type ) ) {
			wp_safe_redirect( get_post_type_archive_link( $this->post_type ), 301 );
			exit();
		}
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		$fm = new \Fieldmanager_Textfield( array(
			'name'             => 'headline',
			'attributes'       => array(
				'size'        => 75,
				'placeholder' => 'e.g. Partnerships Manager & Creative Strategist',
			),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Headline', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_RichTextArea( array(
			'name'             => 'excerpt',
			'buttons_1'        => array( 'bold', 'italic' ),
			'buttons_2'        => array(),
			'init_options'     => array(
				'paste_as_text' => true,
			),
			'editor_settings'  => array(
				'quicktags'     => false,
				'media_buttons' => false,
			),
			'validation_rules' => array(
				'required' => true,
			),
			'description'      => 'Short description for committee members listing page',
		) );
		$fm->add_meta_box( esc_html__( 'Excerpt', 'fbiamdigital' ), $this->post_type );

		return true;
	}

	/**
	 * Setup archive page custom fields
	 */
	public function setup_archive_page() {
		add_action( 'after_setup_theme', array( $this, 'register_archive_submenu_page' ) );
		add_action( "fm_submenu_archive_{$this->post_type}", array( $this, 'archive_custom_fields' ) );
	}

	/**
	 * Register the admin submenu with FM
	 */
	public function register_archive_submenu_page() {
		try {
			\fm_register_submenu_page( "archive_{$this->post_type}", "edit.php?post_type={$this->post_type}", 'Archive Page' );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}

	/**
	 * Register custom fields for the archive page under a admin submenu
	 */
	public function archive_custom_fields() {
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading'           => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'description'       => new \Fieldmanager_TextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
					) ),
					'intro_heading'     => new \Fieldmanager_Textfield( esc_html__( 'Intro Heading', 'fbiamdigital' ) ),
					'intro_description' => new \Fieldmanager_RichTextArea( array(
						'buttons_1'       => array( 'bold', 'italic' ),
						'buttons_2'       => array(),
						'init_options'    => array(
							'paste_as_text' => true,
						),
						'editor_settings' => array(
							'quicktags'     => false,
							'media_buttons' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Excerpt', 'fbiamdigital' ), $this->post_type );
			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}
}