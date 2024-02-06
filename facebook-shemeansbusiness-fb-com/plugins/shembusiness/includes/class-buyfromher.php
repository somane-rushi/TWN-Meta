<?php

namespace Fbshemeansbusiness_Site_Plugin;

/**
 * Class Stories
 * @package Fbshemeansbusiness_Site_Plugin
 */
class Buyfromher {

	/**
	 * @var string
	 */
	var $post_type = 'buyherproduct';

	/**
	 * Testimonials constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_term_buyfromher_country", array( $this, 'custom_fields_cateogry' ) );
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Buy From Her', 'Post Type General Name', 'shembusiness' ),
			'singular_name'         => _x( 'Buy From Her', 'Post Type Singular Name', 'shembusiness' ),
			'menu_name'             => __( 'Buy From Her', 'shembusiness' ),
			'name_admin_bar'        => __( 'Buy From Her', 'shembusiness' ),
			'archives'              => __( 'Buy From Her', 'shembusiness' ),
			'attributes'            => __( 'Item Attributes', 'shembusiness' ),
			'parent_item_colon'     => __( 'Parent Item:', 'shembusiness' ),
			'all_items'             => __( 'All Buy From Her', 'shembusiness' ),
			'add_new_item'          => __( 'Add New Story', 'shembusiness' ),
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
			'slug'       => 'buyherproduct',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Buy From Her', 'shembusiness' ),
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
			'has_archive'         => 'buyherproduct',
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
		register_taxonomy( 'buyfromher_country', array( $this->post_type ), $args );
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "buyfromher",
				'children' => array(
					'bname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'bcou'        => new \Fieldmanager_Textfield( esc_html__( 'Country', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'business'        => new \Fieldmanager_Textfield( esc_html__( 'Business Name', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'simage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg',
					) ),
					'sdescription'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Buy From Her', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "herproduct",
				'children' => array(
					'bimage'  => new \Fieldmanager_Media( esc_html__( 'Banner Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg',
					) ),
					'bgimage'  => new \Fieldmanager_Media( esc_html__( 'Banner Background Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg',
					) ),
					'bname'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'bcountry'        => new \Fieldmanager_Textfield( esc_html__( 'Country', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
					'add_sec'          => new \Fieldmanager_Group(  array( 
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Select Section Type', 'shembusiness' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),			
						'children' => array(
							'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Section Type', 'shembusiness' ), array(
								'options' => array(
									'fulltext'       => esc_html__( 'Text', 'shembusiness' ),
									'twocol_iltr'    => esc_html__( 'Image Left Text Right', 'shembusiness' ),
									'twocol_irtl'    => esc_html__( 'Image Right Text Left', 'shembusiness' ),
								),
							) ),
							
							// Text Component
							'sec_fulltext_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'fulltext',
								),
								'children'   => array(
									'popfulltext'    => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'shembusiness' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
								),
							) ),
							
							// Image Right Text Left Component
							'sec_twocol_irtl_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'twocol_irtl',
								),
								'children'   => array(
									'poplefttext'    => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'shembusiness' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
									'poprimage'          => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
										'mime_type'        => 'image',
										'description'      => esc_html__( '', 'shembusiness' ),
										'button_label'     => esc_html__( 'Select an Image', 'shembusiness' ),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
											
								),
							) ),
							
							// Image Left Text Right Component
							'sec_twocol_iltr_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'twocol_iltr',
								),
								'children'   => array(
									'poplimage'          => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
										'mime_type'        => 'image',
										'description'      => esc_html__( '', 'shembusiness' ),
										'button_label'     => esc_html__( 'Select an Image', 'shembusiness' ),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'poprightttext'    => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'shembusiness' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
								),
							) ),
					
							
						),
					) ),
					
					
					'logo'  => new \Fieldmanager_Media( esc_html__( 'Logo', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg',
					) ),
					'instaname'        => new \Fieldmanager_Textfield( esc_html__( 'Instagram Username', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'instaln'        => new \Fieldmanager_Textfield( esc_html__( 'Instagram Link', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'fbln'        => new \Fieldmanager_Textfield( esc_html__( 'FB Link', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
					'socialsec'          => new \Fieldmanager_Group(  array( 
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add image', 'shembusiness' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),			
						'children' => array(
							'simage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg',
							) ),
							
						),
					) ),
				
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Product Detail', 'shembusiness' ), $this->post_type );
			
			
			} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}
		return true;
	}
	
	
	public function custom_fields_cateogry() {
		
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "cat_desc",
				'children' => array(
					'category_linktxt'    => new \Fieldmanager_RichTextArea( esc_html__( '', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Content', 'shembusiness' ) , 'buyfromher_country' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}
		
	}
	

}