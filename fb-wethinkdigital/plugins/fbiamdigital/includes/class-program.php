<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Program
 * @package Fbiamdigital_Site_Plugin
 */
class Program {

	/**
	 * @var string
	 */
	var $post_type = 'program';

	/**
	 * Program constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Programs', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Program', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Programs', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Program', 'fbiamdigital' ),
			'archives'              => __( 'Programs', 'fbiamdigital' ),
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
			'slug'       => 'programs',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Programs', 'fbiamdigital' ),
			'labels'              => $labels,
			'supports'            => array( 'title' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register custom taxonomies for this post type
	 */
	public function register_taxonomy() {
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		$fm = new \Fieldmanager_Media( array(
			'name'             => 'masthead_image',
			'mime_type'        => 'image',
			'description'      => esc_html__( 'Dimensions: 1024x372px', 'fbiamdigital' ),
			'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Masthead Image', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_RichTextArea( array(
			'name'             => 'body',
			'buttons_1'        => array( 'bold', 'italic', 'link' ),
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
		) );
		$fm->add_meta_box( esc_html__( 'Body', 'fbiamdigital' ), $this->post_type );
		
		$fm = new \Fieldmanager_Group( array(
			'name'     => "pvideo",
			'children' => array(
				'look_video' => new \Fieldmanager_Media( 'Video File', array(
					'mime_type'    => 'all',
					'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
					'description'  => 'File types: *.mp4',
				) ),
				'vimage'  => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbiamdigital' ), array(
					'mime_type'    => 'image',
					'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
					'description'  => 'File types: *.jpg, .png',
				) ),
				
			),
		) );
		$fm->add_meta_box( esc_html__( 'Program Video', 'fbiamdigital' ), $this->post_type );
		
		$fm = new \Fieldmanager_Group( array(
			'name'     => "vdcontent",
			'children' => array(
				'vd_title' => new \Fieldmanager_Textfield( esc_html__( 'Video Heading', 'fbiamdigital' ),
										array( 'attributes' => array('style' => 'width:100%') ) ),
				'description' => new \Fieldmanager_RichTextArea( esc_html__( '', 'fbiamdigital' ), array(
					'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),			
					'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
					'init_options' => array(
						'paste_as_text'  => true,
						'valid_elements' => '<br />',
					),
					'editor_settings' => array(
                        'default_editor' => 'html',
						'media_buttons' => false,
					)
				) ),
			),
		) );
		$fm->add_meta_box( esc_html__( 'Program Video Content', 'fbiamdigital' ), $this->post_type );
		

		return true;
	}
}