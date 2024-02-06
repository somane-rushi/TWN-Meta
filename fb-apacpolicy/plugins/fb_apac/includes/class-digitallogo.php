<?php

namespace Fbapac_Site_Plugin;

/**
 * Class Digitallogo
 * @package Fbapac_Site_Plugin
 */
class Digitallogo {

	/**
	 * @var string
	 */
	var $post_type = 'digitallogo';

	/**
	 * Safeonline constructor.
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
			'name'                  => _x( 'Digital Logo', 'Post Type General Name', 'fbapac' ),
			'singular_name'         => _x( 'Digital Logo', 'Post Type Singular Name', 'fbapac' ),
			'menu_name'             => __( 'Digital Logo', 'fbapac' ),
			'name_admin_bar'        => __( 'Digital Logo', 'fbapac' ),
			'archives'              => __( 'Digital Logo', 'fbapac' ),
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
			'slug'       => 'digitallogo',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'digitallogo', 'fbapac' ),
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
			'has_archive'         => 'digitallogo',
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
				'name'     => "digilogo",
				'children' => array(
					'logourl'     => new \Fieldmanager_Textfield( esc_html__( 'Logo URL', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Digital Logo', 'fbapac' ), $this->post_type );	
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapac', $e->getMessage() );
		}

		return true;
	}

}