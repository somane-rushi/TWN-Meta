<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Events
 * @package Fbiamdigital_Site_Plugin
 */
class Events {

	/**
	 * @var string
	 */
	var $post_type = 'events';

	/**
	 * Events constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10, 3 );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Events', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Events', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Events', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Events', 'fbiamdigital' ),
			'archives'              => __( 'Events', 'fbiamdigital' ),
			'attributes'            => __( 'Item Attributes', 'fbiamdigital' ),
			'parent_item_colon'     => __( 'Parent Item:', 'fbiamdigital' ),
			'all_items'             => __( 'All Items', 'fbiamdigital' ),
			'add_new_item'          => __( 'Add New Item', 'fbiamdigital' ),
			'add_new'               => __( 'Add New', 'fbiamdigital' ),
			'new_item'              => __( 'New Item', 'fbiamdigital' ),
			'edit_item'             => __( 'Edit Item', 'fbiamdigital' ),
			'update_item'           => __( 'Update Item', 'fbiamdigital' ),
			'view_item'             => __( 'View Item', 'fbiamdigital' ),
			'view_items'            => __( 'View Items', 'fbiamdigital' ),
			'search_items'          => __( 'Search Item', 'fbiamdigital' ),
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
		$rewrite = array(
			'slug'       => 'events',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Events', 'fbiamdigital' ),
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
			'has_archive'         => 'events',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( $this->post_type, $args );
	}
	
	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		try {
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "events_detail",
				'children' => array(
					'welcome_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'evimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
									'description'  => 'File types: *.jpg',
					) ),
					'button_text'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'button_link'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbiamdigital' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Events Details', 'fbiamdigital' ), $this->post_type );	
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	
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
			$safeonline_datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array(
					'post_type'      => 'events',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'headingmb' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading For Mobile', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'bg_image' => new \Fieldmanager_Media( 'Banner Background Image', array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select a Image', 'fbiamdigital' ),
								'description'  => 'File types: *.gif, .jpg, .png',
					) ),
					'bg_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Description', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'headinglist'            => new \Fieldmanager_Textfield( esc_html__( 'List Event Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
					
					
				),
			) );
			
			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}
		
		return true;
	}
	
	
}