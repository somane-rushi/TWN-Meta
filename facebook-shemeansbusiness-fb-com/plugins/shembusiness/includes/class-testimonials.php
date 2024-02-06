<?php

namespace Fbshemeansbusiness_Site_Plugin;

/**
 * Class Testimonials
 * @package Fbshemeansbusiness_Site_Plugin
 */
class Testimonials {

	/**
	 * @var string
	 */
	var $post_type = 'testimonials';

	/**
	 * Testimonials constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Testimonials', 'Post Type General Name', 'shembusiness' ),
			'singular_name'         => _x( 'Testimonials', 'Post Type Singular Name', 'shembusiness' ),
			'menu_name'             => __( 'Testimonials', 'shembusiness' ),
			'name_admin_bar'        => __( 'Testimonials', 'shembusiness' ),
			'archives'              => __( 'Testimonials', 'shembusiness' ),
			'attributes'            => __( 'Item Attributes', 'shembusiness' ),
			'parent_item_colon'     => __( 'Parent Item:', 'shembusiness' ),
			'all_items'             => __( 'All Testimonials', 'shembusiness' ),
			'add_new_item'          => __( 'Add New Testimonial', 'shembusiness' ),
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
			'slug'       => 'testimonials',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Testimonials', 'shembusiness' ),
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
			'has_archive'         => 'testimonials',
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
				'name'     => "testi",
				'children' => array(
					'testi_position'     => new \Fieldmanager_Textfield( esc_html__( 'Position', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'testi_country'     => new \Fieldmanager_Textfield( esc_html__( 'Country', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'testi_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
									'description'  => 'File types: *.jpg',
					) ),
					'description'        => new \Fieldmanager_TextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Testimonials', 'shembusiness' ), $this->post_type );	
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}


}