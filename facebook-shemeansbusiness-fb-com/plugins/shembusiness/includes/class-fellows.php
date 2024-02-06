<?php

namespace Fbshemeansbusiness_Site_Plugin;

/**
 * Class Fellow
 * @package Fbshemeansbusiness_Site_Plugin
 */
class Fellows {

	/**
	 * @var string
	 */
	var $post_type = 'fellows';

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
			'name'                  => _x( 'Fellows', 'Post Type General Name', 'shembusiness' ),
			'singular_name'         => _x( 'Fellows', 'Post Type Singular Name', 'shembusiness' ),
			'menu_name'             => __( 'Fellows', 'shembusiness' ),
			'name_admin_bar'        => __( 'Fellows', 'shembusiness' ),
			'archives'              => __( 'Fellows', 'shembusiness' ),
			'attributes'            => __( 'Item Attributes', 'shembusiness' ),
			'parent_item_colon'     => __( 'Parent Item:', 'shembusiness' ),
			'all_items'             => __( 'All Fellows', 'shembusiness' ),
			'add_new_item'          => __( 'Add New Fellow', 'shembusiness' ),
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
			'slug'       => 'fellows',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Fellows', 'shembusiness' ),
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
			'has_archive'         => 'fellows',
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
				'name'     => "fellow",
				'children' => array(
					'sname'    => new \Fieldmanager_RichTextArea( esc_html__( 'Name', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'sbusiness'    => new \Fieldmanager_RichTextArea( esc_html__( 'Business Name', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
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
			$fm->add_meta_box( esc_html__( 'Fellow Detail ', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "storypopup",
				'children' => array(
					'smtitle'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'smloc'     => new \Fieldmanager_Textfield( esc_html__( 'Location', 'shembusiness' ),
						array( 'attributes'       => array('style' => 'width:100%') ) ),
						
					'popupblocks'          => new \Fieldmanager_Group(  array( 
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Section', 'shembusiness' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),			
						'children' => array(
							'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Section Type', 'shembusiness' ), array(
								'options' => array(
									'fullheading'       => esc_html__( 'Heading', 'shembusiness' ),
									'fulltext'       => esc_html__( 'Text', 'shembusiness' ),
									'twocol_iltr'    => esc_html__( 'Image Left Text Right', 'shembusiness' ),
									'twocol_irtl'    => esc_html__( 'Image Right Text Left', 'shembusiness' ),
									'singleimg'       => esc_html__( 'Single Image', 'shembusiness' ),
									'social'       => esc_html__( 'Social Link', 'shembusiness' ),
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
							// Text Component
							'sec_fullheading_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'fullheading',
								),
								'children'   => array(
									'popfullheading'    => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'shembusiness' ), array(
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
							// Image Component
							'sec_twocol_img_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'singleimg',
								),
								'children'   => array(
									'singimage'          => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
										'mime_type'        => 'image',
										'description'      => esc_html__( '', 'shembusiness' ),
										'button_label'     => esc_html__( 'Select an Image', 'shembusiness' ),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
								),
							) ),
							
							'sec_twocol_social_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'social',
								),
								'children'   => array(
									'weblink'     => new \Fieldmanager_Textfield( esc_html__( 'Website Link', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
									'fb'     => new \Fieldmanager_Textfield( esc_html__( 'Facebook', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
									'insta'     => new \Fieldmanager_Textfield( esc_html__( 'Instagram', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
								),
							) ),
							
								
							
							
						),
					) ),
				
				),
			) );
			$fm->add_meta_box( esc_html__( 'Popup Content', 'shembusiness' ), $this->post_type );
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
	
	
}