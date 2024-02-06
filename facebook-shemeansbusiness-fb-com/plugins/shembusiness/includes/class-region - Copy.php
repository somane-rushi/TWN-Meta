<?php

namespace Fbshemeansbusiness_Site_Plugin;

/**
 * Class Region
 * @package Fbshemeansbusiness_Site_Plugin
 */
class Region {

	/**
	 * @var string
	 */
	var $post_type = 'region';

	/**
	 * Testimonials constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Region', 'Post Type General Name', 'shembusiness' ),
			'singular_name'         => _x( 'Region', 'Post Type Singular Name', 'shembusiness' ),
			'menu_name'             => __( 'Region', 'shembusiness' ),
			'name_admin_bar'        => __( 'Region', 'shembusiness' ),
			'archives'              => __( 'Region', 'shembusiness' ),
			'attributes'            => __( 'Item Attributes', 'shembusiness' ),
			'parent_item_colon'     => __( 'Parent Item:', 'shembusiness' ),
			'all_items'             => __( 'All Regions', 'shembusiness' ),
			'add_new_item'          => __( 'Add New Region', 'shembusiness' ),
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
			'slug'       => 'region',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Regions', 'shembusiness' ),
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
			'has_archive'         => 'region',
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
		$labels = array(
			'name'                       => _x( 'Country', 'Taxonomy General Name', 'shembusiness' ),
			'singular_name'              => _x( 'Country', 'Taxonomy Singular Name', 'shembusiness' ),
			'menu_name'                  => __( 'Country', 'shembusiness' ),
			'all_items'                  => __( 'All Items', 'shembusiness' ),
			'parent_item'                => __( 'Parent Item', 'shembusiness' ),
			'parent_item_colon'          => __( 'Parent Item:', 'shembusiness' ),
			'new_item_name'              => __( 'New Item Name', 'shembusiness' ),
			'add_new_item'               => __( 'Add New Item', 'shembusiness' ),
			'edit_item'                  => __( 'Edit Item', 'shembusiness' ),
			'update_item'                => __( 'Update Item', 'shembusiness' ),
			'view_item'                  => __( 'View Item', 'shembusiness' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'shembusiness' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'shembusiness' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'shembusiness' ),
			'popular_items'              => __( 'Popular Items', 'shembusiness' ),
			'search_items'               => __( 'Search Items', 'shembusiness' ),
			'not_found'                  => __( 'Not Found', 'shembusiness' ),
			'no_terms'                   => __( 'No items', 'shembusiness' ),
			'items_list'                 => __( 'Items list', 'shembusiness' ),
			'items_list_navigation'      => __( 'Items list navigation', 'shembusiness' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
		);
		register_taxonomy( 'region_country', array( $this->post_type ), $args );
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_banner",
				'children' => array(
					'overview_vd'        => new \Fieldmanager_Media( 'Video File', array(
						'mime_type'    => 'video/mp4',
						'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
						'description'  => 'File types: *.mp4',
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One Banner', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_slider",
				'children' => array(
					
					'add_highlights'          => new \Fieldmanager_Group(  array( 				
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add slide', 'shembusiness' ),				
						'children' => array(
							'slide_image'  => new \Fieldmanager_Media( esc_html__( 'Slider Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'slide_vd'        => new \Fieldmanager_Media( 'Popup Video', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
								'description'  => 'File types: *.mp4',
							) ),
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One Slider', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_tagline",
				'children' => array(
					'wel_heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'wel_btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'wel_btn_link'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "two_content",
				'children' => array(
					'rtitle'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'rsubtitle'     => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'rdesc'        => new \Fieldmanager_TextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two', 'shembusiness' ), $this->post_type );	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "thr_content",
				'children' => array(
					'htitle'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'hhightitle'     => new \Fieldmanager_Textfield( esc_html__( 'Hightlight Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'hbgimage'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
					'add_highlights'          => new \Fieldmanager_Group(  array(					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Highlight', 'shembusiness' ),				
						'children' => array(
							'high_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'high_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Three Highlights', 'shembusiness' ), $this->post_type );	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "four_content",
				'children' => array(
					'add_box'          => new \Fieldmanager_Group(  array( 				
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Box', 'shembusiness' ),				
						'children' => array(
							'box_title'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'box_link'        => new \Fieldmanager_Textfield( esc_html__( 'Link', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'box_image'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
								'attributes'       => array('style' => 'border-bottom: 1px solid #ccc;'),
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Four', 'shembusiness' ), $this->post_type );	
			
			} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
	
	
}

