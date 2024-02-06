<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Iamdigital
 * @package Fbiamdigital_Site_Plugin
 */
class Iamdigital {

	/**
	 * @var string
	 */
	var $post_type = 'iamdigital';

	/**
	 * Iamdigital constructor.
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
			'name'                  => _x( 'I Am Digital', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'I Am Digital', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'I Am Digital', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'I Am Digital', 'fbiamdigital' ),
			'archives'              => __( 'I Am Digital', 'fbiamdigital' ),
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
			'slug'       => 'iamdigital',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'I Am Digital', 'fbiamdigital' ),
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
			'has_archive'         => 'iamdigital',
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
			'name'                       => _x( 'Countries', 'Taxonomy General Name', 'fbiamdigital' ),
			'singular_name'              => _x( 'Country', 'Taxonomy Singular Name', 'fbiamdigital' ),
			'menu_name'                  => __( 'Country', 'fbiamdigital' ),
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
		register_taxonomy( 'pccountry', array( $this->post_type ), $args );
		
		$labelslan = array(
			'name'                       => _x( 'Language', 'Taxonomy General Name', 'fbiamdigital' ),
			'singular_name'              => _x( 'Language', 'Taxonomy Singular Name', 'fbiamdigital' ),
			'menu_name'                  => __( 'Language', 'fbiamdigital' ),
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
		$argslan   = array(
			'labels'            => $labelslan,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
		);
		register_taxonomy( 'pclanguage', array( $this->post_type ), $argslan );
	}
	
	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		
		$fm = new \Fieldmanager_Textfield( array(
			'name'             => 'subhead',
			'attributes'       => array( 'style' => 'width:100%;', 'rows' => 6 ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Sub Heading', 'fbiamdigital' ), $this->post_type );
		
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
				'name'           => 'pc_attachment',
				'group_is_empty' => function ( $values ) {
					return empty( $values['pc_type'] );
				},
				'children'       => array(
					'pc_type'            => new \Fieldmanager_Select( esc_html__( 'Type', 'fbiamdigital' ), array(
						'options' => array(
							'download' => esc_html__( 'PDF', 'fbiamdigital' ),
							'video'    => esc_html__( 'Video', 'fbiamdigital' ),
						),
					) ),
					// Downloadable
					'pc_download_fields' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'pc_type',
							'value' => 'download',
						),
						'children'   => array(
							'file' => new \Fieldmanager_Media( array(
								'mime_type'    => 'all',
								'button_label' => esc_html__( 'Select a file', 'fbiamdigital' ),
								'description'  => 'File types: *.pdf, *.ppt, *.zip, *.jpg, *.png',
							) ),
							'button_pdf'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ),
								array( 'attributes'       => array('style' => 'width:100%') ) ),
						),
					) ),
					// Video
					'pc_video_fields'    => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'pc_type',
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
							'button_video'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ),
								array( 'attributes'       => array('style' => 'width:100%') ) ),
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Fact Sheets', 'fbiamdigital' ), $this->post_type );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}
		
		
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
			$country_term_datasource = new \Fieldmanager_Datasource_Term( array(
				'taxonomy'               => 'pccountry',
				'taxonomy_save_to_terms' => false,
				'use_ajax'               => false,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'head_image' => new \Fieldmanager_Media( 'Banner Image', array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => esc_html__( 'Dimensions: 1920x622px', 'fbiamdigital') ,
					) ),
					'head_desc'        => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Description For Desktop', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'headm_desc'        => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Description For Mobile', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'heading'            => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'description'        => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'digi_image' => new \Fieldmanager_Media( 'Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 1280x270px', 'fbiamdigital') ,
					) ),
					'post_title'  => new \Fieldmanager_Textfield( esc_html__( 'Post Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'help_title'  => new \Fieldmanager_Textfield( esc_html__( 'Helpline Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
					'add1_title'  => new \Fieldmanager_Textfield( esc_html__( 'Address One Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add1_image' => new \Fieldmanager_Media( 'Address One Country Flag Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 75x75px', 'fbiamdigital') ,
					) ),
					'add1_text1'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address One Content 1', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add1_text2'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address One Content 2', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add1_text3'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address One Content 3', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					
					
					'add2_title'  => new \Fieldmanager_Textfield( esc_html__( 'Address Two Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add2_image' => new \Fieldmanager_Media( 'Address Two Country Flag Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 75x75px', 'fbiamdigital') ,
					) ),
					'add2_text'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Two Content 1', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add2_text2'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Two Content 2', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					
					'add3_title'  => new \Fieldmanager_Textfield( esc_html__( 'Address Two Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add3_image' => new \Fieldmanager_Media( 'Address Three Country Flag Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 75x75px', 'fbiamdigital') ,
					) ),
					'add3_text'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Three Content 1', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add3_text2'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Three Content 2', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					
					'add4_title'  => new \Fieldmanager_Textfield( esc_html__( 'Address Four Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add4_image' => new \Fieldmanager_Media( 'Address Four Country Flag Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 75x75px', 'fbiamdigital') ,
					) ),
					'add4_text'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Four Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add5_title'  => new \Fieldmanager_Textfield( esc_html__( 'Address Five Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add5_image' => new \Fieldmanager_Media( 'Address Five Country Flag Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 75x75px', 'fbiamdigital') ,
					) ),
					'add5_text'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Five Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add6_title'  => new \Fieldmanager_Textfield( esc_html__( 'Address Six Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add6_image' => new \Fieldmanager_Media( 'Address Six Country Flag Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 75x75px', 'fbiamdigital') ,
					) ),
					'add6_text'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Six Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					
					'add7_title'  => new \Fieldmanager_Textfield( esc_html__( 'Address Seven Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add7_image' => new \Fieldmanager_Media( 'Address One Country Flag Image', array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
						'description'  => esc_html__( 'Dimensions: 75x75px', 'fbiamdigital') ,
					) ),
					'add7_text1'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Seven Content 1', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add7_text2'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Seven Content 2', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'add7_text3'        => new \Fieldmanager_RichTextArea( esc_html__( 'Address Seven Content 3', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					
					'note'        => new \Fieldmanager_RichTextArea( esc_html__( 'Note', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( '<br> <p> <h3> <a> <sup> <strong> allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><h3><sup><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
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

