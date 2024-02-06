<?php

namespace Fbshemeansbusiness_Site_Plugin;

/**
 * Class Learningcapsules
 * @package Fbshemeansbusiness_Site_Plugin
 */
class Learningcapsules {

	/**
	 * @var string
	 */
	var $post_type = 'learningcapsules';

	/**
	 * Safeonline constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10 ,3 );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Learning Capsules', 'Post Type General Name', 'shembusiness' ),
			'singular_name'         => _x( 'Learning Capsules', 'Post Type Singular Name', 'shembusiness' ),
			'menu_name'             => __( 'Learning Capsules', 'shembusiness' ),
			'name_admin_bar'        => __( 'Learning Capsules', 'shembusiness' ),
			'archives'              => __( 'Learning Capsules', 'shembusiness' ),
			'attributes'            => __( 'Item Attributes', 'shembusiness' ),
			'parent_item_colon'     => __( 'Parent Item:', 'shembusiness' ),
			'all_items'             => __( 'All Items', 'shembusiness' ),
			'add_new_item'          => __( 'Add New Item', 'shembusiness' ),
			'add_new'               => __( 'Add New', 'shembusiness' ),
			'new_item'              => __( 'New Item', 'shembusiness' ),
			'edit_item'             => __( 'Edit Item', 'shembusiness' ),
			'update_item'           => __( 'Update Item', 'shembusiness' ),
			'view_item'             => __( 'View Item', 'shembusiness' ),
			'view_items'            => __( 'View Items', 'shembusiness' ),
			'search_items'          => __( 'Search Item', 'shembusiness' ),
			'not_found'             => __( 'Not found', 'shembusiness' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'shembusiness' ),
			'featured_image'        => __( 'Featured Image', 'shembusiness' ),
			'set_featured_image'    => __( 'Set featured image', 'shembusiness' ),
			'remove_featured_image' => __( 'Remove featured image', 'shembusiness' ),
			'use_featured_image'    => __( 'Use as featured image', 'shembusiness' ),
			'insert_into_item'      => __( 'Insert into item', 'shembusiness' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'shembusiness' ),
			'items_list'            => __( 'Items list', 'shembusiness' ),
			'items_list_navigation' => __( 'Items list navigation', 'shembusiness' ),
			'filter_items_list'     => __( 'Filter items list', 'shembusiness' ),
		);
		$rewrite = array(
			'slug'       => 'learningcapsules',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Learning Capsules', 'shembusiness' ),
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
			'has_archive'         => 'learningcapsules',
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
				'name'     => "capsule",
				'children' => array(
					'captitle'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'capimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
									'description'  => 'File types: *.jpg',
					) ),
					'capvd'        => new \Fieldmanager_Media( 'Video File', array(
							'mime_type'    => 'video/mp4',
							'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
							'description'  => 'File types: *.mp4',
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Learning Capsule Details', 'shembusiness' ), $this->post_type );	
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
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
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
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
					'post_type'      => 'archcapsule',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading'            => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
				
				
					
				),
			) );
			
			
			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}
	
		
		
		return true;
	}
	
	
	
}