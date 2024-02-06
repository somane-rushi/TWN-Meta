<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Resource
 * @package Fbiamdigital_Site_Plugin
 */
class Resource {

	/**
	 * @var string
	 */
	var $post_type = 'resource';

	/**
	 * Resource constructor.
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
			'name'                  => _x( 'Resources', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Resource', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Resources', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Resource', 'fbiamdigital' ),
			'archives'              => __( 'Resources', 'fbiamdigital' ),
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
			'slug'       => 'resources',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Resource', 'fbiamdigital' ),
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
			'has_archive'         => 'resources',
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
			'name'                       => _x( 'Audiences', 'Taxonomy General Name', 'fbiamdigital' ),
			'singular_name'              => _x( 'Audience', 'Taxonomy Singular Name', 'fbiamdigital' ),
			'menu_name'                  => __( 'Audience', 'fbiamdigital' ),
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
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
		);
		register_taxonomy( 'audience', array( $this->post_type ), $args );

		$labels = array(
			'name'                       => _x( 'Topics', 'Taxonomy General Name', 'fbiamdigital' ),
			'singular_name'              => _x( 'Topic', 'Taxonomy Singular Name', 'fbiamdigital' ),
			'menu_name'                  => __( 'Topic', 'fbiamdigital' ),
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
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
		);
		register_taxonomy( 'topic', array( $this->post_type ), $args );
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
			'description'      => 'Short description for resource listings page',
		) );
		$fm->add_meta_box( esc_html__( 'Excerpt', 'fbiamdigital' ), $this->post_type );

		try {
			$fm = new \Fieldmanager_Group( array(
				'name'           => 'resource_attachment',
				'group_is_empty' => function ( $values ) {
					// https://github.com/alleyinteractive/wordpress-fieldmanager/issues/688
					return empty( $values['resource_type'] );
				},
				'children'       => array(
					'resource_type'            => new \Fieldmanager_Select( esc_html__( 'Type', 'fbiamdigital' ), array(
						'options' => array(
							'download' => esc_html__( 'Downloadable', 'fbiamdigital' ),
							'link'     => esc_html__( 'External Link', 'fbiamdigital' ),
							'video'    => esc_html__( 'Video', 'fbiamdigital' ),
							'content'  => esc_html__( 'Content', 'fbiamdigital' ),
						),
					) ),
					
					'cta_btn_txt' => new \Fieldmanager_Textfield( esc_html__( 'CTA Text', 'wtd2022' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
					) ),
					'typeofcontent_txt' => new \Fieldmanager_Textfield( esc_html__( 'Type of Content', 'wtd2022' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
					) ),

					'resource_content_fields'          => new \Fieldmanager_Group(  array( 
						'display_if' => array(
							'src'   => 'resource_type',
							'value' => 'content',
						),
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Section', 'fbiamdigital' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),
						'group_is_empty' => function ( $values ) {
							// https://github.com/alleyinteractive/wordpress-fieldmanager/issues/688
							return empty( $values['sec_type'] );
						},			
						'children' => array(
							'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Section Type', 'fbiamdigital' ), array(
								'options' => array(
									'downloadlink'       => esc_html__( 'Download Link', 'fbiamdigital' ),
									'fulltext'       => esc_html__( 'Full Content', 'fbiamdigital' ),
									'accordian'       => esc_html__( 'Accordian', 'fbiamdigital' ),
								),
							) ),
							
							// Download Link Component
							
							'sec_downloadlink_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'downloadlink',
								),
								'children'   => array(
									'con_dwntext'     => new \Fieldmanager_Textfield( esc_html__( 'Download Text', 'fbiamdigital' ),
										array( 'attributes' => array('style' => 'width:100%') )
									),
									'con_dwnlink' => new \Fieldmanager_Media( array(
										'mime_type'    => 'all',
										'button_label' => esc_html__( 'Select a file for Download', 'fbiamdigital' ),
										'description'  => 'File types: *.pdf, *.ppt, *.zip, *.jpg, *.png',
									) ),
									
								),
							) ),
							
							// Text Component
							'sec_fulltext_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'fulltext',
								),
								'children'   => array(
									'con_title'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
										array( 'attributes' => array('style' => 'width:100%') )
									),
									'con_des' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
										'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
										'init_options'    => array(
											'paste_as_text'  => true,
											'valid_elements' => '<br /><p><a><strong><h1><h2><h3><h4><span><b>',
										),
										'editor_settings' => array(
											'default_editor' => 'html',
											'media_buttons' => false,
										)
									) ),
									
								),
							) ),
							
							// accordian Component
							'sec_accordian_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'accordian',
								),
								'children'   => array(
									'con_accor' => new \Fieldmanager_Group( esc_html__( 'Accordian', 'fbiamdigital' ), array(
											'add_more_label' => esc_html__( 'Add accordian slide', 'fbiamdigital' ),
											'limit'          => 20,
											'sortable'       => true,
											'collapsible'    => true,
											'group_is_empty' => function ( $values ) {
												return empty( $values['acc_title'] );
											},
											'children'       => array(
												'acc_title'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ),
													array( 'attributes' => array('style' => 'width:100%') )
												),
												'acc_text' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
													'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
													'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
													'editor_settings' => array(
														'default_editor' => 'html',
														'media_buttons' => true,
													)
												) ),
												'acc_file'        => new \Fieldmanager_Media( 'Video File', array(
													'mime_type'    => 'all',
													'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
													'description'  => 'File types: *.mp4',
												) ),
												
												
											),
										)
									),
									
									
								),
							) ),
							
							
						),
						
						
					) ),
					
					
					
					// Downloadable
					'resource_download_fields' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'resource_type',
							'value' => 'download',
						),
						'children'   => array(
							'file' => new \Fieldmanager_Media( array(
								'mime_type'    => 'all',
								'button_label' => esc_html__( 'Select a file', 'fbiamdigital' ),
								'description'  => 'File types: *.pdf, *.ppt, *.zip, *.jpg, *.png',
							) ),
							'type' => new \Fieldmanager_Select( 'Type of content', array(
								'description' => 'The type of file or its contents (especially if you uploaded a .ZIP)',
								'options'     => array(
									'learning_module'         => esc_html_x( 'Learning Module', 'Resource File Content Type', 'fbiamdigital' ),
									'learning_module_package' => esc_html_x( 'Learning Module (Package)', 'Resource File Content Type', 'fbiamdigital' ),
									'infographic'             => esc_html_x( 'Infographic', 'Resource File Content Type', 'fbiamdigital' ),
									'guide' => esc_html_x( 'Guide', 'Resource File Content Type', 'fbiamdigital' ),
								),
							) ),
							'size' => new \Fieldmanager_Textfield( esc_html__( 'Size', 'fbiamdigital' ), array(
								'description'      => 'File size in bytes',
								'validation_rules' => array(
									'number' => true,
								),
								'attributes'       => array(
									'type'        => 'number',
									'placeholder' => '1024',
								),
							) ),
							
						),
						
					) ),
					// External Link
					'resource_link_fields'     => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'resource_type',
							'value' => 'link',
						),
						'children'   => array(
							'type' => new \Fieldmanager_Select( 'Type of content', array(
								'description' => 'The type of website',
								'options'     => array(
									'website'      => esc_html_x( 'Website', 'Resource Website Content Type', 'fbiamdigital' ),
									'lesson_plans' => esc_html_x( 'Lesson Plans (Website)', 'Resource Website Content Type', 'fbiamdigital' ),
								),
							) ),
							'url'  => new \Fieldmanager_Textfield( esc_html__( 'URL', 'fbiamdigital' ), array(
								'attributes'       => array(
									'size'        => 50,
									'placeholder' => 'https://',
								),
								'validation_rules' => array(
									'required' => true,
									'url'      => true,
								),
							) ),
							
						),
						
					) ),
					// Video
					'resource_video_fields'    => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'resource_type',
							'value' => 'video',
						),
						'children'   => array(
							'preview_img' => new \Fieldmanager_Media( 'Thumbnail Preview (Animated GIF)', array(
								'mime_type'    => 'image/gif',
								'button_label' => esc_html__( 'Select a GIF', 'fbiamdigital' ),
								'description'  => 'File types: *.gif',
							) ),
							'file'        => new \Fieldmanager_Media( 'Video File', array(
								'mime_type'    => 'all',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
							) ),
							
						),
						
					) ),
					
					// Content
					'resource_content11_fields'    => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'resource_type',
							'value' => 'content11',
						),
						'children'   => array(
							'con_dwntext'     => new \Fieldmanager_Textfield( esc_html__( 'Download Text', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							'con_dwnlink' => new \Fieldmanager_Media( array(
								'mime_type'    => 'all',
								'button_label' => esc_html__( 'Select a file for Download', 'fbiamdigital' ),
								'description'  => 'File types: *.pdf, *.ppt, *.zip, *.jpg, *.png',
							) ),
							'con_title'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							'con_des' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong><h1><h2><h3><h4><span><b>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							'con_accor' => new \Fieldmanager_Group( esc_html__( 'Accordian', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add accordian slide', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['acc_title'] );
									},
									'children'       => array(
										'acc_title'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ),
											array( 'attributes' => array('style' => 'width:100%') )
										),
										'acc_text' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong><h1><h2><h3><h4><span><b>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
									),
								)
							),
							
							
						),
						
					) ),
					
					
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Resource', 'fbiamdigital' ), $this->post_type );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		$fm = new \Fieldmanager_Checkbox( 'Featured', array(
			'name'            => 'wpfp_featured',
			'checked_value'   => 1,
			'unchecked_value' => 0,
			'default_value'   => 0,
		) );
		$fm->add_meta_box( 'Featured', $this->post_type, 'side' );

		$fm = new \Fieldmanager_Textfield( array(
			'name'        => 'custom_tag',
			'description' => 'If this post is featured, this will show instead of "Featured" text.',
			'attributes'  => array(
				'size'        => 50,
				'placeholder' => 'e.g. New',
			),
		) );
		$fm->add_meta_box( 'Custom Tag', $this->post_type );

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
			$resource_datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array(
					'post_type'      => 'resource',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading'            => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'description'        => new \Fieldmanager_TextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'filter_heading'     => new \Fieldmanager_Textfield( esc_html__( 'Filter Heading', 'fbiamdigital' ), array(
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'filter_description' => new \Fieldmanager_RichTextArea( esc_html__( 'Filter Description', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'morebtn_res' => new \Fieldmanager_Textfield( esc_html__( 'Resource Load more button text', 'fbiamdigital' ), array(
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'jumbotron'          => new \Fieldmanager_Group( esc_html__( 'Announcement Box', 'fbiamdigital' ), array(
						'children' => array(
							'jumbotron_bg'          => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbiamdigital' ), array(
								'mime_type'        => 'image',
								'description'      => esc_html__( 'Dimensions: 1024x197px', 'fbiamdigital' ),
								'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'jumbotron_heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
							'jumbotron_description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'buttons_1'        => array( 'bold', 'italic', 'link' ),
								'buttons_2'        => array(),
								'init_options'     => array(
									'paste_as_text' => true,
								),
								'editor_settings'  => array(
									'quicktags'     => false,
									'media_buttons' => false,
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'jumbotron_resource'    => new \Fieldmanager_Select( esc_html__( 'Link to Resource', 'fbiamdigital' ), array(
								'datasource'  => $resource_datasource_post,
								'first_empty' => true,
							) ),
							'jumbotron_button_text' => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ) ),
						),
					) ),
					
					
					'kidresource'          => new \Fieldmanager_Group( esc_html__( 'Kid Announcement Box', 'fbiamdigital' ), array(
						'children' => array(
							'kidres_bg'          => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbiamdigital' ), array(
								'mime_type'        => 'image',
								'description'      => esc_html__( 'Dimensions: 1024x197px', 'fbiamdigital' ),
								'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'kidres_heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
							'kidres_description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'buttons_1'        => array( 'bold', 'italic', 'link' ),
								'buttons_2'        => array(),
								'init_options'     => array(
									'paste_as_text' => true,
									'valid_elements' => '<br /><a><strong>',
								),
								'editor_settings'  => array(
									'quicktags'     => false,
									'media_buttons' => false,
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'kidres_button_text' => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ) ),
							'kidres_button_link' => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbiamdigital' ) ),
						),
					) ),
					
					'wtdresfilter'  => new \Fieldmanager_Group( esc_html__( 'WTD Resource Filter Text', 'fbiamdigital' ), array(
						'children' => array(
							'wtd_aud' => new \Fieldmanager_Textfield( esc_html__( 'Audiences Default Text', 'fbiamdigital' ) ),
							'wtd_topic' => new \Fieldmanager_Textfield( esc_html__( 'Topics Default Text', 'fbiamdigital' ) ),
							
						),
					) ),
					
					
					'wtdresource'          => new \Fieldmanager_Group( esc_html__( 'WTD Banner', 'fbiamdigital' ), array(
						'children' => array(
							'wtdres_bg'          => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbiamdigital' ), array(
								'mime_type'        => 'image',
								'description'      => esc_html__( 'Dimensions: 1920x625', 'fbiamdigital' ),
								'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'wtdres_head' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Title', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong><span>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							'wtdresm_head' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Title For Mobile', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong><span>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							
							'wtdres_weldesc' => new \Fieldmanager_RichTextArea( esc_html__( 'Welcome Description', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong><span>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							
						),
					) ),
					
					
					'wtdreslist'          => new \Fieldmanager_Group( esc_html__( 'WTD Resources', 'fbiamdigital' ), array(
						'children' => array(
							'mainheading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'resources'       => new \Fieldmanager_Group( esc_html__( 'Resources', 'fbiamdigital' ), array(
								'add_more_label' => esc_html__( 'Add another Resource', 'fbiamdigital' ),
								'limit'          => 9,
								'extra_elements' => 0,
								'sortable'       => true,
								'collapsible'    => true,
								'group_is_empty' => function ( $values ) {
									return empty( $values['boximage'] ) && empty( $values['heading'] );
								},
								'children'       => array(
									'boximage'        => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
										'description'  => esc_html__( 'Dimensions: 300x300px', 'fbiamdigital' ),
									) ),
									'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
									'btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'popheading'        => new \Fieldmanager_Textfield( esc_html__( 'Popup Heading', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'popdes'    => new \Fieldmanager_RichTextArea( esc_html__( 'Popup Description', 'fbiamdigital' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
											
									
								),
							)
						),
							
							
						),
					) ),
					
					'wtdmreslist'          => new \Fieldmanager_Group( esc_html__( 'WTD Resource Listing', 'fbiamdigital' ), array(
						'children' => array(
							
							'wtdmres_head' => new \Fieldmanager_RichTextArea( esc_html__( 'Listing Title', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong><span>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							
						),
					) ),
					
					'wtdfaq'          => new \Fieldmanager_Group( esc_html__( 'FAQ Section', 'fbiamdigital' ), array(
						'children' => array(
							'title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'addfaq'       => new \Fieldmanager_Group( esc_html__( 'Add FAQ', 'fbiamdigital' ), array(
								'add_more_label' => esc_html__( 'Add another FAQ', 'fbiamdigital' ),
								'limit'          => 9,
								'extra_elements' => 0,
								'sortable'       => true,
								'collapsible'    => true,
								'group_is_empty' => function ( $values ) {
									return empty( $values['que'] ) && empty( $values['ans'] );
								},
								'children'       => array(
									'que'        => new \Fieldmanager_Textfield( esc_html__( 'Question', 'fbiamdigital' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'ans'    => new \Fieldmanager_RichTextArea( esc_html__( 'Answer', 'fbiamdigital' ), array(
										'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
										'validation_rules' => array(
											'required' => true,
										),
									) ),
											
									
								),
							)
						),
							
							
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