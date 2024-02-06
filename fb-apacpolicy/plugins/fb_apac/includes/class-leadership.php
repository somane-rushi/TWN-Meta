<?php

namespace Fbapac_Site_Plugin;

/**
 * Class Leadership
 * @package Fbapac_Site_Plugin
 */
class Leadership {

	/**
	 * @var string
	 */
	var $post_type = 'leadership';

	/**
	 * Leadership constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10 );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Leadership', 'Post Type General Name', 'fbapac' ),
			'singular_name'         => _x( 'Leadership', 'Post Type Singular Name', 'fbapac' ),
			'menu_name'             => __( 'Leadership', 'fbapac' ),
			'name_admin_bar'        => __( 'Leadership', 'fbapac' ),
			'archives'              => __( 'Leadership ', 'fbapac' ),
			'attributes'            => __( 'Item Attributes', 'fbapac' ),
			'parent_item_colon'     => __( 'Parent Item:', 'fbapac' ),
			'all_items'             => __( 'All Items', 'fbapac' ),
			'add_new_item'          => __( 'Add New Item', 'fbapac' ),
			'add_new'               => __( 'Add New', 'fbapac' ),
			'new_item'              => __( 'New Item', 'fbapac' ),
			'edit_item'             => __( 'Edit Item', 'fbapac' ),
			'update_item'           => __( 'Update Item', 'fbapac' ),
			'view_item'             => __( 'View Item', 'fbapac' ),
			'view_items'            => __( 'View Items', 'fbapac' ),
			'search_items'          => __( 'Search Item', 'fbapac' ),
			'not_found'             => __( 'Not found', 'fbapac' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fbapac' ),
			'featured_image'        => __( 'Featured Image', 'fbapac' ),
			'set_featured_image'    => __( 'Set featured image', 'fbapac' ),
			'remove_featured_image' => __( 'Remove featured image', 'fbapac' ),
			'use_featured_image'    => __( 'Use as featured image', 'fbapac' ),
			'insert_into_item'      => __( 'Insert into item', 'fbapac' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'fbapac' ),
			'items_list'            => __( 'Items list', 'fbapac' ),
			'items_list_navigation' => __( 'Items list navigation', 'fbapac' ),
			'filter_items_list'     => __( 'Filter items list', 'fbapac' ),
		);
		$rewrite = array(
			'slug'       => 'leadership',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Leadership', 'fbapac' ),
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
			'has_archive'         => 'leadership',
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
		$fm = new \Fieldmanager_TextArea( array(
			'name'             => 'excerpt',
			'attributes'       => array( 'style' => 'width:100%;', 'rows' => 6 ),
			'validation_rules' => array(
				'required' => true,
			),
			'description'      => 'Short description for leadership listings page',
		) );
		$fm->add_meta_box( esc_html__( 'Content', 'fbapac' ), $this->post_type );
		
		try {
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "leadership_detail",
				'children' => array(
					'leader_subtitle'     => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Blog Content', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong><ul><li><h2><h3><h4><h5><h6><img>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
					'leader_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbapac' ),
									'description'  => 'File types: *.jpg',
					) ),
					'lpreview_img' => new \Fieldmanager_Media( 'Thumbnail Preview (Animated GIF)', array(
								'mime_type'    => 'image/gif',
								'button_label' => esc_html__( 'Select a GIF', 'fbapac' ),
								'description'  => 'File types: *.gif',
					) ),
					'file'        => new \Fieldmanager_Media( 'Video File', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'fbapac' ),
								'description'  => 'File types: *.mp4',
					) ),
					'boxvideo_text'     => new \Fieldmanager_Textfield( esc_html__( 'Video Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'rbtntext'     => new \Fieldmanager_Textfield( esc_html__( 'Read More Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'authorname'     => new \Fieldmanager_Textfield( esc_html__( 'Author Name', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'authorpost'     => new \Fieldmanager_Textfield( esc_html__( 'Aurthor Designation', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Leadership Details', 'fbapac' ), $this->post_type );	
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapac_fm', $e->getMessage() );
		}

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
			return new \WP_Error( 'fbapac_fm', $e->getMessage() );
		}

		return true;
	}

	/**
	 * Register custom fields for the archive page under a admin submenu
	 */
	public function archive_custom_fields() {
		try {
			$leadership_datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array(
					'post_type'      => 'leadership',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading'            => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'bg_image' => new \Fieldmanager_Media( 'Background Image', array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select a jpg', 'fbapac' ),
								
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Change Banner Image', 'fbapac' ), $this->post_type );	

			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapac_fm', $e->getMessage() );
		}

		return true;
	}
}