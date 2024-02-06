<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class videos
 * @package Fbiamdigital_Site_Plugin
 */
class Videos {

	/**
	 * @var string
	 */
	var $post_type = 'videos';

	/**
	 * Events constructor.
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
			'name'                  => _x( 'Videos', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Videos', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Videos', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Videos', 'fbiamdigital' ),
			'archives'              => __( 'Videos', 'fbiamdigital' ),
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
			'slug'       => 'videos',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Videos', 'fbiamdigital' ),
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
			'has_archive'         => 'videos',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'taxonomies'         => array( 'category', 'post_tag' ),
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
				'name'           => 'resource_attachment',
				'children'   => array(
					'toggle' => new \Fieldmanager_Checkbox( array(
						'label'       => __( 'Display this section?', 'fbsafety' ),
						'description' => __( 'Check this box to display this section.', 'fbsafety' ),
					) ),
					'video_url' =>  new \Fieldmanager_TextArea( array(
						'label'       => __( 'Video URL', 'fbsafety' ),
						'description' => __( 'The full video URL.', 'fbsafety' ),
					) ),
					'thumbnail_title' => new \Fieldmanager_Textfield( esc_html__( 'Thumbnail Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Video Fields', 'fbiamdigital' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_TextArea( array(
				'name'             => 'excerpt',
				'attributes'       => array( 'style' => 'width:100%;', 'rows' => 6 ),
				'validation_rules' => array(
					'required' => true,
				),
				'description'      => 'Short description for resource listings page',
			) );
			$fm->add_meta_box( esc_html__( 'Excerpt', 'fbiamdigital' ), $this->post_type );
					
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	
	}
	
}