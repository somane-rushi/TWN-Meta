<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Shoppingscam
 * @package Fbiamdigital_Site_Plugin
 */
class Shoppingscam {

	/**
	 * @var string
	 */
	var $post_type = 'shoppingscam';

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
			'name'                  => _x( 'Shopping Scam', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Shopping Scam', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Shopping Scam', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Shopping Scam', 'fbiamdigital' ),
			'archives'              => __( 'Shopping Scam', 'fbiamdigital' ),
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
			'slug'       => 'shoppingscam',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Shopping Scam', 'fbiamdigital' ),
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
			'has_archive'         => 'shoppingscam',
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
			'description'      => 'Short description for scam listings page',
		) );
		$fm->add_meta_box( esc_html__( 'Scam Content', 'fbiamdigital' ), $this->post_type );
		
		try {
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "shopping_detail",
				'children' => array(
					'scam_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
									'description'  => 'File types: *.jpg',
					) ),
					'preview_img' => new \Fieldmanager_Media( 'Thumbnail Preview (Animated GIF)', array(
								'mime_type'    => 'image/gif',
								'button_label' => esc_html__( 'Select a GIF', 'fbiamdigital' ),
								'description'  => 'File types: *.gif',
					) ),
					'file'        => new \Fieldmanager_Media( 'Video File', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
					) ),
					'boxvideo_text'     => new \Fieldmanager_Textfield( esc_html__( 'Video Button Text', 'fbiamdigital' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Scam Details', 'fbiamdigital' ), $this->post_type );	
					
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

}