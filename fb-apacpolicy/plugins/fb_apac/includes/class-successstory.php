<?php

namespace Fbapac_Site_Plugin;

/**
 * Class Successstory
 * @package Fbapac_Site_Plugin
 */
class Successstory {

	/**
	 * @var string
	 */
	var $post_type = 'success-story';

	/**
	 * Safeonline constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_term_story_region", array( $this, 'custom_fields_cateogry' ) );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10 );
		$this->setup_archive_page();		
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Success Story', 'Post Type General Name', 'fbapac' ),
			'singular_name'         => _x( 'Success Story', 'Post Type Singular Name', 'fbapac' ),
			'menu_name'             => __( 'Success Story', 'fbapac' ),
			'name_admin_bar'        => __( 'Success Story', 'fbapac' ),
			'archives'              => __( 'Success Story', 'fbapac' ),
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
			'slug'       => 'success-story',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'success-story', 'fbapac' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => 'success-story',
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
			'name'                       => _x( 'Region', 'Taxonomy General Name', 'shembusiness' ),
			'singular_name'              => _x( 'Region', 'Taxonomy Singular Name', 'shembusiness' ),
			'menu_name'                  => __( 'Region', 'shembusiness' ),
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
		register_taxonomy( 'story_region', array( $this->post_type ), $args );
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		
		try {
				$fm = new \Fieldmanager_Group( array(
					'name'     => "storydata",
					'children' => array(
						'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbapac' ), array(
							'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
							'description' => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbapac' ),
							'init_options'    => array(
								'paste_as_text'  => true,
								'valid_elements' => '<br /><p><a><strong>',
							),
							'editor_settings' => array(
								'default_editor' => 'html',
								'media_buttons' => false,
							)
						) ),
						'btntext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
							array( 'attributes'       => array('style' => 'width:100%') ) ),
						'btnlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
							array( 'attributes'       => array('style' => 'width:100%') ) ),
						'image'   => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapacl_fm' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
						) ),
						
					),
				) );
				$fm->add_meta_box( esc_html__( 'Story Content', 'fbapac' ), $this->post_type );
						
			} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapac', $e->getMessage() );
		}

		return true;
	}
	
	public function custom_fields_cateogry() {
		
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "cat_image",
				'children' => array(
				'cimage'  => new \Fieldmanager_Media( esc_html__( '', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select Image', 'fbapac' ),
							'description'  => 'File types: *.jpg',
						) ),
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Image', 'fbapac' ) , 'story_region' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'fbapac', $e->getMessage() );
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
					'post_type'      => 'success-story',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'slide' => new \Fieldmanager_Group( esc_html__( 'Banner Slider', 'fbapacl_fm' ), array(
							'add_more_label' => esc_html__( 'Add another slide', 'fbapacl_fm' ),
							'limit'          => 50,
							'sortable'       => true,
							'collapsible'    => true,
							'group_is_empty' => function ( $values ) {
								return empty( $values['sec_type'] );
							},
							'children'       => array(
								'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Slide Type', 'shembusiness' ), array(
									'options' => array(
										'image'       => esc_html__( 'Image', 'shembusiness' ),
										'video'       => esc_html__( 'Video', 'shembusiness' ),
									),
								) ),
								'sec_image_fields'       => new \Fieldmanager_Group( array(
									'display_if' => array(
										'src'   => 'sec_type',
										'value' => 'image',
									),
									'children'   => array(
										'image_banner' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								) ),
								
								'sec_video_fields' => new \Fieldmanager_Group( array(
									'display_if' => array(
										'src'   => 'sec_type',
										'value' => 'video',
									),
									'children'   => array(
										'vimage_banner' => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbapac' ), array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
									) ),
									'vd_banner' => new \Fieldmanager_Media( esc_html__( 'Video', 'fbapac' ), array(
										'mime_type'    => 'all',
										'button_label' => esc_html__( 'Select a video', 'fbapac' ),
										'description'  => 'File types: *.mp4',
									) ),
										
									),
								) ),
								
								
							),
						)
					),
					
					'imagesec' => new \Fieldmanager_Group( esc_html__( 'Image Section', 'fbapacl_fm' ), array(
							'collapsible'    => true,
							'children'       => array(
								'image_banner' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
								) ),
								'image_heading' => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
									array( 'attributes' => array('style' => 'width:100%') ) ),
								'image_desc' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
									'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
									'validation_rules' => array( 'required' => false, ),
								) ),
							),
						)
					),
					
					'alltab' => new \Fieldmanager_Group( esc_html__( 'All Region', 'fbapacl_fm' ), array(
							'collapsible'    => true,
							'children'       => array(
								'all_img' => new \Fieldmanager_Media( esc_html__( 'All Region Image', 'fbapac' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
								) ),
								'all_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
									'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
							),
						)
					),
					
					
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