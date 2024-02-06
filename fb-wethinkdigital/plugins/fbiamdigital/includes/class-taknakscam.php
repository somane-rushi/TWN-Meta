<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Taknakscam
 * @package Fbiamdigital_Site_Plugin
 */
class Taknakscam {

	/**
	 * @var string
	 */
	var $post_type = 'taknakscam';

	/**
	 * Safeonline constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10, 3 );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Taknak Scam', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Taknak Scam', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Taknak Scam', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Taknak Scam', 'fbiamdigital' ),
			'archives'              => __( 'Taknak Scam', 'fbiamdigital' ),
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
			'slug'       => 'taknakscam',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Taknak Scam', 'fbiamdigital' ),
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
			'has_archive'         => 'taknakscam',
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
			'name'                       => _x( 'Year', 'Taxonomy General Name', 'fbiamdigital' ),
			'singular_name'              => _x( 'Year', 'Taxonomy Singular Name', 'fbiamdigital' ),
			'menu_name'                  => __( 'Year', 'fbiamdigital' ),
			'all_items'                  => __( 'All Items', 'fbiamdigital' ),
			'parent_item'                => __( 'Parent Item', 'fbiamdigital' ),
			'parent_item_colon'          => __( 'Parent Item:', 'fbiamdigital' ),
			'new_item_name'              => __( 'New Item Name', 'fbiamdigital' ),
			'add_new_item'               => __( 'Add New Item', 'fbiamdigital' ),
			'edit_item'                  => __( 'Edit Item', 'fbiamdigital' ),
			'update_item'                => __( 'Update Item', 'fbiamdigital' ),
			'view_item'                  => __( 'View Item', 'fbiamdigital' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'fbiamdigital' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'fbiamdigital' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'fbiamdigital' ),
			'popular_items'              => __( 'Popular Items', 'fbiamdigital' ),
			'search_items'               => __( 'Search Items', 'fbiamdigital' ),
			'not_found'                  => __( 'Not Found', 'fbiamdigital' ),
			'no_terms'                   => __( 'No items', 'fbiamdigital' ),
			'items_list'                 => __( 'Items list', 'fbiamdigital' ),
			'items_list_navigation'      => __( 'Items list navigation', 'fbiamdigital' ),
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
		register_taxonomy( 'takyear', array( $this->post_type ), $args );
		
	}
	

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		
		try {
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "scam_detail",
				'children' => array(
					'description'        => new \Fieldmanager_RichTextArea( esc_html__( 'Contents', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'scam_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
									'description'  => 'File types: *.gif, .jpg, .png',
					) ),
					'preview_img' => new \Fieldmanager_Media( 'Thumbnail Preview (Animated GIF)', array(
								'mime_type'    => 'image/gif',
								'button_label' => esc_html__( 'Select a GIF', 'fbiamdigital' ),
								'description'  => 'File types: *.gif, .jpg, .png',
					) ),
					'file'        => new \Fieldmanager_Media( 'Video File', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Details', 'fbiamdigital' ), $this->post_type );	
					
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
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
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
					'post_type'      => 'taknakscam',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );
			
			

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
				
					'addsec' => new \Fieldmanager_Group( esc_html__( 'Add Section', 'fbiamdigital' ), array(
						'add_more_label' => esc_html__( 'Add another Year', 'fbiamdigital' ),
						'limit'          => 9,
						'extra_elements' => 0,
						'sortable'       => true,
						'collapsible'    => true,
						'group_is_empty' => function ( $values ) {
							return empty( $values['tmy_year'] );
						},
						'children'       => array(
							
							'tmy_year'            => new \Fieldmanager_Select( esc_html__( 'Year', 'fbiamdigital' ), array(
								'options' => array(
									'2021' => esc_html__( '2021', 'fbiamdigital' ),
									'2022' => esc_html__( '2022', 'fbiamdigital' ),
									'2023' => esc_html__( '2023', 'fbiamdigital' ),
									'2024' => esc_html__( '2024', 'fbiamdigital' ),
								),
							) ),
							
							// 2021
							'tmy_2021_fields' => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'tmy_year',
									'value' => '2021',
								),
								'children'   => array(
									'banner_image' => new \Fieldmanager_Media( 'Banner Image', array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'scrollinks' => new \Fieldmanager_Group(  array( esc_html__( 'Menu Links', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Menu Link', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle'     => new \Fieldmanager_Textfield( esc_html__( 'Link Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),							
										),
									) ),
									'heading'  => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
									'welcome_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									
									'featurebox' => new \Fieldmanager_Group(  array( esc_html__( 'Feature Box', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Feature Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'fcontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br />',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											'flinks' => new \Fieldmanager_RichTextArea( esc_html__( 'Links', 'fbiamdigital' ), array(
												'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
										),
									) ),
									'box_image'  => new \Fieldmanager_Media( esc_html__( 'Box Image', 'fbdigitalscam' ), array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'box_text' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text Before Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'box_text_after' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text After Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'ibox' => new \Fieldmanager_Group(  array( esc_html__( 'Information Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'iimages' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'ititle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'icontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											
										),
									) ),
									'post_header' => new \Fieldmanager_Textfield( esc_html__( 'Post Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'story_header' => new \Fieldmanager_Textfield( esc_html__( 'Story Telling Image Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'stories' => new \Fieldmanager_Group(  array( esc_html__( 'Story Image', 'fbiamdigital' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Image', 'fbiamdigital' ),
										'sortable'       => true,				
										'children' => array(
											'simage'          => new \Fieldmanager_Media( esc_html__( 'Story Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											
										),
									) ),
									'videobox' => new \Fieldmanager_Group(  array( esc_html__( 'Video Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Video Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'video_poster'  => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
											'video_file' => new \Fieldmanager_Media( 'Video File', array(
												'mime_type'    => 'all',
												'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
												'description'  => 'File types: *.mp4',
											) ),	
											'video_title' => new \Fieldmanager_Textfield( esc_html__( 'Video Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:100%'),
												'validation_rules' => array(
													'required' => false,
												),
											) ),
											'video_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
													'validation_rules' => array(
														'required' => false,
													),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),	
											
										),
									) ),
									'secure_title' => new \Fieldmanager_Textfield( esc_html__( 'Security Tips Title', 'fbiamdigital' ), array(
										'attributes' => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'secure_image' => new \Fieldmanager_Group(  array( esc_html__( 'Secure Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Secure Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Secure Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
										),
									) ),
									'msg_header' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
											'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options' => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br />',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
									'msg_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Message Content', 'fbiamdigital' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><p><a><strong> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'scames_image' => new \Fieldmanager_Group(  array( esc_html__( 'Scam Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Scam Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Scam Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),	
											
										),
									) ),
									'scames_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Scames Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><a><strong><ul><li> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><a><strong><ul><li>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'logo_header' => new \Fieldmanager_Textfield( esc_html__( 'Logo Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'jumbotron'=> new \Fieldmanager_Group(  array( esc_html__( 'Logos', 'fbiamdigital' ),
					
										'description'    => esc_html__( 'Display up to 3 related stories' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Logo', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,			
										'children' => array(
											'parlogo'          => new \Fieldmanager_Media( esc_html__( 'Logo', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Logo', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'plogolink'     => new \Fieldmanager_Textfield( esc_html__( 'Logo URL', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),
											
										),
									) ),
									
									
								),
							) ),
							
							// 2022
							'tmy_2022_fields' => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'tmy_year',
									'value' => '2022',
								),
								'children'   => array(
									
									'banner_image' => new \Fieldmanager_Media( 'Banner Image', array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'scrollinks' => new \Fieldmanager_Group(  array( esc_html__( 'Menu Links', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Menu Link', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle'     => new \Fieldmanager_Textfield( esc_html__( 'Link Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),							
										),
									) ),
									'heading'  => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
									'welcome_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									
									'featurebox' => new \Fieldmanager_Group(  array( esc_html__( 'Feature Box', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Feature Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'fcontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br />',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											'flinks' => new \Fieldmanager_RichTextArea( esc_html__( 'Links', 'fbiamdigital' ), array(
												'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
										),
									) ),
									'box_image'  => new \Fieldmanager_Media( esc_html__( 'Box Image', 'fbdigitalscam' ), array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'box_text' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text Before Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'box_text_after' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text After Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'ibox' => new \Fieldmanager_Group(  array( esc_html__( 'Information Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'iimages' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'ititle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'icontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											
										),
									) ),
									'post_header' => new \Fieldmanager_Textfield( esc_html__( 'Post Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'story_header' => new \Fieldmanager_Textfield( esc_html__( 'Story Telling Image Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'stories' => new \Fieldmanager_Group(  array( esc_html__( 'Story Image', 'fbiamdigital' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Image', 'fbiamdigital' ),				
										'children' => array(
											'simage'          => new \Fieldmanager_Media( esc_html__( 'Story Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											
										),
									) ),
									'videobox' => new \Fieldmanager_Group(  array( esc_html__( 'Video Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Video Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'video_poster'  => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
											'video_file' => new \Fieldmanager_Media( 'Video File', array(
												'mime_type'    => 'all',
												'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
												'description'  => 'File types: *.mp4',
											) ),	
											'video_title' => new \Fieldmanager_Textfield( esc_html__( 'Video Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:100%'),
												'validation_rules' => array(
													'required' => false,
												),
											) ),
											'video_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
													'validation_rules' => array(
														'required' => false,
													),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),	
											
										),
									) ),
									'secure_title' => new \Fieldmanager_Textfield( esc_html__( 'Security Tips Title', 'fbiamdigital' ), array(
										'attributes' => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'secure_image' => new \Fieldmanager_Group(  array( esc_html__( 'Secure Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Secure Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Secure Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
										),
									) ),
									'msg_header' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
											'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options' => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br />',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
									'msg_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Message Content', 'fbiamdigital' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><p><a><strong> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'scames_image' => new \Fieldmanager_Group(  array( esc_html__( 'Scam Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Scam Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Scam Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),	
											
										),
									) ),
									'scames_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Scames Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><a><strong><ul><li> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><a><strong><ul><li>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'logo_header' => new \Fieldmanager_Textfield( esc_html__( 'Logo Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'jumbotron'=> new \Fieldmanager_Group(  array( esc_html__( 'Logos', 'fbiamdigital' ),
					
										'description'    => esc_html__( 'Display up to 3 related stories' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Logo', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,			
										'children' => array(
											'parlogo'          => new \Fieldmanager_Media( esc_html__( 'Logo', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Logo', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'plogolink'     => new \Fieldmanager_Textfield( esc_html__( 'Logo URL', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),
											
										),
									) ),
									
									
								),
							) ),
							
							// 2023
							'tmy_2023_fields' => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'tmy_year',
									'value' => '2023',
								),
								'children'   => array(
									'banner_image' => new \Fieldmanager_Media( 'Banner Image', array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'scrollinks' => new \Fieldmanager_Group(  array( esc_html__( 'Menu Links', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Menu Link', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle'     => new \Fieldmanager_Textfield( esc_html__( 'Link Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),							
										),
									) ),
									'heading'  => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
									'welcome_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									
									'featurebox' => new \Fieldmanager_Group(  array( esc_html__( 'Feature Box', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Feature Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'fcontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br />',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											'flinks' => new \Fieldmanager_RichTextArea( esc_html__( 'Links', 'fbiamdigital' ), array(
												'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
										),
									) ),
									'box_image'  => new \Fieldmanager_Media( esc_html__( 'Box Image', 'fbdigitalscam' ), array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'box_text' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text Before Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'box_text_after' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text After Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'ibox' => new \Fieldmanager_Group(  array( esc_html__( 'Information Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'iimages' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'ititle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'icontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											
										),
									) ),
									'post_header' => new \Fieldmanager_Textfield( esc_html__( 'Post Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'story_header' => new \Fieldmanager_Textfield( esc_html__( 'Story Telling Image Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'stories' => new \Fieldmanager_Group(  array( esc_html__( 'Story Image', 'fbiamdigital' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Image', 'fbiamdigital' ),				
										'children' => array(
											'simage'          => new \Fieldmanager_Media( esc_html__( 'Story Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											
										),
									) ),
									'videobox' => new \Fieldmanager_Group(  array( esc_html__( 'Video Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Video Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'video_poster'  => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
											'video_file' => new \Fieldmanager_Media( 'Video File', array(
												'mime_type'    => 'all',
												'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
												'description'  => 'File types: *.mp4',
											) ),	
											'video_title' => new \Fieldmanager_Textfield( esc_html__( 'Video Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:100%'),
												'validation_rules' => array(
													'required' => false,
												),
											) ),
											'video_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
													'validation_rules' => array(
														'required' => false,
													),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),	
											
										),
									) ),
									'secure_title' => new \Fieldmanager_Textfield( esc_html__( 'Security Tips Title', 'fbiamdigital' ), array(
										'attributes' => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'secure_image' => new \Fieldmanager_Group(  array( esc_html__( 'Secure Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Secure Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Secure Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
										),
									) ),
									'msg_header' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
											'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options' => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br />',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
									'msg_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Message Content', 'fbiamdigital' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><p><a><strong> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'scames_image' => new \Fieldmanager_Group(  array( esc_html__( 'Scam Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Scam Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Scam Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),	
											
										),
									) ),
									'scames_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Scames Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><a><strong><ul><li> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><a><strong><ul><li>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'logo_header' => new \Fieldmanager_Textfield( esc_html__( 'Logo Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'jumbotron'=> new \Fieldmanager_Group(  array( esc_html__( 'Logos', 'fbiamdigital' ),
					
										'description'    => esc_html__( 'Display up to 3 related stories' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Logo', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,			
										'children' => array(
											'parlogo'          => new \Fieldmanager_Media( esc_html__( 'Logo', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Logo', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'plogolink'     => new \Fieldmanager_Textfield( esc_html__( 'Logo URL', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),
											
										),
									) ),
								
								),
							) ),
							
							// 2024
							'tmy_2023_fields' => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'tmy_year',
									'value' => '2024',
								),
								'children'   => array(
									'banner_image' => new \Fieldmanager_Media( 'Banner Image', array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'scrollinks' => new \Fieldmanager_Group(  array( esc_html__( 'Menu Links', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Menu Link', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle'     => new \Fieldmanager_Textfield( esc_html__( 'Link Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),							
										),
									) ),
									'heading'  => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
									'welcome_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									
									'featurebox' => new \Fieldmanager_Group(  array( esc_html__( 'Feature Box', 'fbiamdigital' ),
										'limit'          => 10,
										'add_more_label' => esc_html__( 'Add Feature Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'ftitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'fcontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br />',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											'flinks' => new \Fieldmanager_RichTextArea( esc_html__( 'Links', 'fbiamdigital' ), array(
												'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
										),
									) ),
									'box_image'  => new \Fieldmanager_Media( esc_html__( 'Box Image', 'fbdigitalscam' ), array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
										'description'  => 'File types: *.gif, .jpg, .png',
									) ),
									'box_text' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text Before Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'box_text_after' => new \Fieldmanager_RichTextArea( esc_html__( 'Box Text After Dropdwon', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options' => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><strong><a><span>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'ibox' => new \Fieldmanager_Group(  array( esc_html__( 'Information Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'iimages' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'ititle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
												'attributes' => array('style' => 'width:500px'),
											) ),
											'icontent' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
												'validation_rules' => array(
													'required' => false,
												),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options'    => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),
											
										),
									) ),
									'post_header' => new \Fieldmanager_Textfield( esc_html__( 'Post Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'story_header' => new \Fieldmanager_Textfield( esc_html__( 'Story Telling Image Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'stories' => new \Fieldmanager_Group(  array( esc_html__( 'Story Image', 'fbiamdigital' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Image', 'fbiamdigital' ),				
										'children' => array(
											'simage'          => new \Fieldmanager_Media( esc_html__( 'Story Image', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Image', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											
										),
									) ),
									'videobox' => new \Fieldmanager_Group(  array( esc_html__( 'Video Box', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Video Box', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'video_poster'  => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
											'video_file' => new \Fieldmanager_Media( 'Video File', array(
												'mime_type'    => 'all',
												'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
												'description'  => 'File types: *.mp4',
											) ),	
											'video_title' => new \Fieldmanager_Textfield( esc_html__( 'Video Title', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:100%'),
												'validation_rules' => array(
													'required' => false,
												),
											) ),
											'video_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
												'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
													'validation_rules' => array(
														'required' => false,
													),
												'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
												'init_options' => array(
													'paste_as_text'  => true,
													'valid_elements' => '<br /><a><strong>',
												),
												'editor_settings' => array(
													'default_editor' => 'html',
													'media_buttons' => false,
												)
											) ),	
											
										),
									) ),
									'secure_title' => new \Fieldmanager_Textfield( esc_html__( 'Security Tips Title', 'fbiamdigital' ), array(
										'attributes' => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'secure_image' => new \Fieldmanager_Group(  array( esc_html__( 'Secure Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Secure Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Secure Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),
										),
									) ),
									'msg_header' => new \Fieldmanager_RichTextArea( esc_html__( 'Video Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
											'validation_rules' => array(
											'required' => false,
										),
										'description' => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options' => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br />',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
									'msg_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Message Content', 'fbiamdigital' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><p><a><strong> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'scames_image' => new \Fieldmanager_Group(  array( esc_html__( 'Scam Image', 'fbiamdigital' ),					
										'limit'          => 30,
										'add_more_label' => esc_html__( 'Add Scam Image', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,				
										'children' => array(
											'secimage'  => new \Fieldmanager_Media( esc_html__( 'Scam Image', 'fbdigitalscam' ), array(
													'mime_type'    => 'image',
													'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
													'description'  => 'File types: *.gif, .jpg, .png',
											) ),	
											
										),
									) ),
									'scames_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Scames Content', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => false,
										),
										'description'     => esc_html__( '<br /><a><strong><ul><li> Tags allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><a><strong><ul><li>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									'logo_header' => new \Fieldmanager_Textfield( esc_html__( 'Logo Header', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'jumbotron'=> new \Fieldmanager_Group(  array( esc_html__( 'Logos', 'fbiamdigital' ),
					
										'description'    => esc_html__( 'Display up to 3 related stories' ),
										'limit'          => 50,
										'add_more_label' => esc_html__( 'Add Logo', 'fbiamdigital' ),
										'sortable'       => true,
										'collapsible'    => true,			
										'children' => array(
											'parlogo'          => new \Fieldmanager_Media( esc_html__( 'Logo', 'fbiamdigital' ), array(
												'mime_type'        => 'image',
												'button_label'     => esc_html__( 'Select an Logo', 'fbiamdigital' ),
												'validation_rules' => array(
													'required' => true,
												),
											) ),
											'plogolink'     => new \Fieldmanager_Textfield( esc_html__( 'Logo URL', 'fbiamdigital' ), array(
												'attributes'       => array('style' => 'width:500px'),
											) ),
											
										),
									) ),
								
								),
							) ),
							
							
									
						),
					) ),
					
					
					
					
					
				),
				
			) );
			
			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}
		
		return true;
	}
}