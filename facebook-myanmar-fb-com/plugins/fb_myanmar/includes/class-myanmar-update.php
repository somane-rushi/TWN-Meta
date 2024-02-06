<?php

namespace Fbmyanmar_Site_Plugin;

/**
 * Class Myanmarupdate
 * @package Fbmyanmar_Site_Plugin
 */
class Myanmarupdate {

	/**
	 * @var string
	 */
	var $post_type = 'myanmar-update';

	/**
	 * Testimonials constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10, 3 );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Myanmar Update', 'Post Type General Name', 'fbmy_fm' ),
			'singular_name'         => _x( 'Myanmar Update', 'Post Type Singular Name', 'fbmy_fm' ),
			'menu_name'             => __( 'Myanmar Update', 'fbmy_fm' ),
			'name_admin_bar'        => __( 'Myanmar Update', 'fbmy_fm' ),
			'archives'              => __( 'Myanmar Update', 'fbmy_fm' ),
			'attributes'            => __( 'Item Attributes', 'fbmy_fm' ),
			'parent_item_colon'     => __( 'Parent Item:', 'fbmy_fm' ),
			'all_items'             => __( 'All Updates', 'fbmy_fm' ),
			'add_new_item'          => __( 'Add New Update', 'fbmy_fm' ),
			'add_new'               => __( 'Add New', 'fbmy_fm' ),
			'new_item'              => __( 'New Item', 'fbmy_fm' ),
			'edit_item'             => __( 'Edit Item', 'fbmy_fm' ),
			'update_item'           => __( 'Update Item', 'fbmy_fm' ),
			'view_item'             => __( 'View Item', 'fbmy_fm' ),
			'view_items'            => __( 'View Items', 'fbmy_fm' ),
			'search_items'          => __( 'Search Item', 'fbmy_fm' ),
			'not_found'             => __( 'Not found', 'fbmy_fm' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fbmy_fm' ),
			'featured_image'        => __( 'Featured Image', 'fbmy_fm' ),
			'set_featured_image'    => __( 'Set featured image', 'fbmy_fm' ),
			'remove_featured_image' => __( 'Remove featured image', 'fbmy_fm' ),
			'use_featured_image'    => __( 'Use as featured image', 'fbmy_fm' ),
			'insert_into_item'      => __( 'Insert into item', 'fbmy_fm' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'fbmy_fm' ),
			'items_list'            => __( 'Items list', 'fbmy_fm' ),
			'items_list_navigation' => __( 'Items list navigation', 'fbmy_fm' ),
			'filter_items_list'     => __( 'Filter items list', 'fbmy_fm' ),
		);
		$rewrite = array(
			'slug'       => 'myanmar-update',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Myanmar Update', 'fbmy_fm' ),
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
			'has_archive'         => 'myanmar-update',
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
				'name'     => "newsup",
				'children' => array(
					'sdescription'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbmy_fm' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'sdeschome'    => new \Fieldmanager_RichTextArea( esc_html__('Description for Home Carousel','fbmy_fm'), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'simage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbmy_fm' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbmy_fm' ),
						'description'  => 'File types: *.jpg',
					) ),
					'btntext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbmy_fm' ),
						array( 'attributes'       => array('style' => 'width:100%') ) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Updates Content', 'fbmy_fm' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "newspopup",
				'children' => array(
					'popupblocks'          => new \Fieldmanager_Group(  array(
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Section', 'fbmy_fm' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),
						'collapsible'    => true,	
						'group_is_empty' => function ( $values ) {
							return empty( $values['sec_type'] );
						},		
						'children' => array(
							'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Section Type', 'fbmy_fm' ), array(
								'options' => array(
									'fullheading'       => esc_html__( 'Heading', 'fbmy_fm' ),
									'fulltext'       => esc_html__( 'Text', 'fbmy_fm' ),
								),
							) ),
							
							// Text Component
							'sec_fulltext_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'fulltext',
								),
								'children'   => array(
									'popfulltext'    => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbmy_fm' ), array(
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
									'popfullheading'    => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbmy_fm' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
								),
							) ),
							
							
							
							
						),
					) ),
				
				),
			) );
			$fm->add_meta_box( esc_html__( 'Popup Content', 'fbmy_fm' ), $this->post_type );
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'fbmy_fm', $e->getMessage() );
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
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
	
	/**
	 * Register custom fields for the archive page under a admin submenu
	 */
	public function archive_custom_fields() {
		
		try {
			$safeonline_datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array(
					'post_type'      => 'myanmar-update',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );
			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'image'   => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbmy_fm' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select an image', 'fbmy_fm' ),
					) ),
					'title'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'fbmy_fm' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbmy_fm' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					
				),
			) );
			
			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbmy_fm', $e->getMessage() );
		}
	
		return true;
	}


}