<?php

namespace Fbrealitylabsacademy_Site_Plugin;

/**
 * Class Course
 * @package Fbrealitylabsacademy_Site_Plugin
 */
class Course {

	/**
	 * @var string
	 */
	var $post_type = 'course';

	/**
	 * Course constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_term_course_category", array( $this, 'custom_fields_cateogry' ) );
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Courses', 'Post Type General Name', 'realitylab' ),
			'singular_name'         => _x( 'Courses', 'Post Type Singular Name', 'realitylab' ),
			'menu_name'             => __( 'Courses', 'realitylab' ),
			'name_admin_bar'        => __( 'Courses', 'realitylab' ),
			'archives'              => __( 'Courses', 'realitylab' ),
			'attributes'            => __( 'Item Attributes', 'realitylab' ),
			'parent_item_colon'     => __( 'Parent Item:', 'realitylab' ),
			'all_items'             => __( 'All Courses', 'realitylab' ),
			'add_new_item'          => __( 'Add New Courses', 'realitylab' ),
			'add_new'               => __( 'Add New', 'realitylab' ),
			'new_item'              => __( 'New Item', 'realitylab' ),
			'edit_item'             => __( 'Edit Item', 'realitylab' ),
			'update_item'           => __( 'Update Item', 'realitylab' ),
			'view_item'             => __( 'View Item', 'realitylab' ),
			'view_items'            => __( 'View Items', 'realitylab' ),
			'search_items'          => __( 'Search Item', 'realitylab' ),
			'not_found'             => __( 'Not found', 'realitylab' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'realitylab' ),
			'featured_image'        => __( 'Featured Image', 'realitylab' ),
			'set_featured_image'    => __( 'Set featured image', 'realitylab' ),
			'remove_featured_image' => __( 'Remove featured image', 'realitylab' ),
			'use_featured_image'    => __( 'Use as featured image', 'realitylab' ),
			'insert_into_item'      => __( 'Insert into item', 'realitylab' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'realitylab' ),
			'items_list'            => __( 'Items list', 'realitylab' ),
			'items_list_navigation' => __( 'Items list navigation', 'realitylab' ),
			'filter_items_list'     => __( 'Filter items list', 'realitylab' ),
		);
		$rewrite = array(
			'slug'       => 'course',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Courses', 'realitylab' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 8,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => 'course',
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
			'name'                       => _x( 'Course Category', 'Taxonomy General Name', 'realitylab' ),
			'singular_name'              => _x( 'Course Category', 'Taxonomy Singular Name', 'realitylab' ),
			'menu_name'                  => __( 'Course Category', 'realitylab' ),
			'all_items'                  => __( 'All Items', 'realitylab' ),
			'parent_item'                => __( 'Parent Item', 'realitylab' ),
			'parent_item_colon'          => __( 'Parent Item:', 'realitylab' ),
			'new_item_name'              => __( 'New Item Name', 'realitylab' ),
			'add_new_item'               => __( 'Add New Item', 'realitylab' ),
			'edit_item'                  => __( 'Edit Item', 'realitylab' ),
			'update_item'                => __( 'Update Item', 'realitylab' ),
			'view_item'                  => __( 'View Item', 'realitylab' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'realitylab' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'realitylab' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'realitylab' ),
			'popular_items'              => __( 'Popular Items', 'realitylab' ),
			'search_items'               => __( 'Search Items', 'realitylab' ),
			'not_found'                  => __( 'Not Found', 'realitylab' ),
			'no_terms'                   => __( 'No items', 'realitylab' ),
			'items_list'                 => __( 'Items list', 'realitylab' ),
			'items_list_navigation'      => __( 'Items list navigation', 'realitylab' ),
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
		register_taxonomy( 'course_category', array( $this->post_type ), $args );
	}
	
	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		try {
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "courseslist",
				'children' => array(
					'ctitle'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
						'required' => false,
						),
					) ),
					'slistimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'realitylab' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'realitylab' ),
									'description'  => 'File types: *.jpg',
					) ),
					'slistdesc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'For Listing', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "courses",
				'children' => array(
					'bimage'  => new \Fieldmanager_Media( esc_html__( 'Banner Image', 'realitylab' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'realitylab' ),
									'description'  => 'File types: *.jpg',
					) ),
					'vimage'  => new \Fieldmanager_Media( esc_html__( 'Video Image', 'realitylab' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'realitylab' ),
									'description'  => 'File types: *.jpg',
					) ),
					'video'  => new \Fieldmanager_Media( esc_html__( 'Course Video', 'realitylab' ), array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'realitylab' ),
								'description'  => 'File types: *.mp4',
					) ),
					'cdesc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Course Description', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'vdtime'     => new \Fieldmanager_Textfield( esc_html__( 'Time', 'realitylab' ),
								array( 'attributes'       => array('style' => 'width:100%') ) ),
					'vdcredits'     => new \Fieldmanager_Textfield( esc_html__( 'Credits', 'realitylab' ),
								array( 'attributes'       => array('style' => 'width:100%') ) ),
					'vdprogress'     => new \Fieldmanager_Textfield( esc_html__( 'Progress %', 'realitylab' ),
								array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Courses', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "starttest",
				'children' => array(
					'sttitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'stdesc' => new \Fieldmanager_Textfield( esc_html__( 'Content', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'btn_text' => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'btn_link' => new \Fieldmanager_Textfield( esc_html__( 'Button URL', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Start Test', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "downloadtest",
				'children' => array(
					'dwtitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'dwdesc' => new \Fieldmanager_Textfield( esc_html__( 'Content', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'dwbtn_text' => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'dw_file'  => new \Fieldmanager_Media( esc_html__( 'Download File', 'realitylab' ), array(
						'mime_type'    => 'all',
						'button_label' => esc_html__( 'Select PDF', 'realitylab' ),
						'description'  => 'File types: *.pdf',
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Download PDF', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "downloadassets",
				'children' => array(
					'dwatitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'dwabtn_text' => new \Fieldmanager_Textfield( esc_html__( 'Button/Link Text', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'dwa_file'  => new \Fieldmanager_Media( esc_html__( 'Download File', 'realitylab' ), array(
						'mime_type'    => 'all',
						'button_label' => esc_html__( 'Select File', 'realitylab' ),
						'description'  => '',
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Download assets', 'realitylab' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "tips",
				'children' => array(
					'tips_head' => new \Fieldmanager_Textfield( esc_html__( 'Section Heading', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'exp_name' => new \Fieldmanager_Textfield( esc_html__( 'Expert Name', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'exp_image'  => new \Fieldmanager_Media( esc_html__( 'Expert Image', 'realitylab' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'realitylab' ),
						'description'  => 'File types: *.jpg',
					) ),
					'exp_desc' => new \Fieldmanager_Textfield( esc_html__( 'Expert Content', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add_tips'          => new \Fieldmanager_Group(  array( esc_html__( 'Add Tips', 'realitylab' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Tips', 'realitylab' ),				
						'children' => array(
							'tips_title' => new \Fieldmanager_Textfield( esc_html__( 'Tips Title', 'realitylab' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'tips_image'  => new \Fieldmanager_Media( esc_html__( 'Tips Image', 'realitylab' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'realitylab' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'tips_video'  => new \Fieldmanager_Media( esc_html__( 'Tips Video', 'realitylab' ), array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'realitylab' ),
								'description'  => 'File types: *.mp4',
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Expert Tips', 'realitylab' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "readonlysec",
				'children' => array(
					'rsubtitle' => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'rdesc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Read Only Section', 'realitylab' ), $this->post_type );
			
			
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}

		return true;
	}
	
	public function custom_fields_cateogry() {
		
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "cat_time",
				'children' => array(
				'cattime'     => new \Fieldmanager_Textfield( esc_html__( '', 'realitylab' ),
							 array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Time', 'realitylab' ) , 'course_category' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "cat_credits",
				'children' => array(
				'catcreadits'     => new \Fieldmanager_Textfield( esc_html__( '', 'realitylab' ),
							 array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Credits', 'realitylab' ) , 'course_category' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}
		
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "cat_image",
				'children' => array(
				'cimage'  => new \Fieldmanager_Media( esc_html__( '', 'realitylab' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select Image', 'realitylab' ),
							'description'  => 'File types: *.jpg',
						) ),
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Image', 'realitylab' ) , 'course_category' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "catbnr_image",
				'children' => array(
				'bnimage'  => new \Fieldmanager_Media( esc_html__( '', 'realitylab' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select Image', 'realitylab' ),
							'description'  => 'File types: *.jpg',
						) ),
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Banner Image', 'realitylab' ) , 'course_category' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}
		
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "cat_sdesc",
				'children' => array(
				'cat_sdetail'    => new \Fieldmanager_RichTextArea( esc_html__( '', 'fbiamdigital' ), array(
					'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
					'validation_rules' => array(
						'required' => false,
					),
				) ),
				
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Short Description', 'realitylab' ) , 'course_category' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}
		
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "cat_description",
				'children' => array(
				'cat_desc'    => new \Fieldmanager_RichTextArea( esc_html__( '', 'fbiamdigital' ), array(
					'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
					'validation_rules' => array(
						'required' => false,
					),
				) ),
				
				),
			) );
			$fm->add_term_meta_box( esc_html__( 'Detail Description', 'realitylab' ) , 'course_category' );				
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}
			 
		return true;
	}
	
}
