<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Safeonline
 * @package Fbiamdigital_Site_Plugin
 */
class Safeonline {

	/**
	 * @var string
	 */
	var $post_type = 'stayingsafeonline';

	/**
	 * Safeonline constructor.
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
			'name'                  => _x( 'Staying Safe Online', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Staying Safe Online', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Staying Safe Online', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Staying Safe Online', 'fbiamdigital' ),
			'archives'              => __( 'Staying Safe Online', 'fbiamdigital' ),
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
			'slug'       => 'stayingsafeonline',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Staying Safe Online', 'fbiamdigital' ),
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
			'has_archive'         => 'stayingsafeonline',
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
			'description'      => 'Short description for safeonline listings page',
		) );
		$fm->add_meta_box( esc_html__( 'Content', 'fbiamdigital' ), $this->post_type );
		
		try {
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "safeonline_detail",
				'children' => array(
					'safe_subtitle'     => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'fbiamdigital' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'safe_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbdigitalscam' ), array(
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
			$fm->add_meta_box( esc_html__( 'Safeonline Details', 'fbiamdigital' ), $this->post_type );	
					
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
					'post_type'      => 'stayingsafeonline',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					
					'heading'            => new \Fieldmanager_Textfield( esc_html__( 'Banner Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'headingm'            => new \Fieldmanager_Textfield( esc_html__( 'Banner Heading For Mobile', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'bg_image' => new \Fieldmanager_Media( 'Banner Background Image', array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select a GIF', 'fbiamdigital' ),
								'description'  => 'File types: *.gif',
					) ),
					'banner_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
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
					'banner_contentm' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Content For Mobile', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
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
					'video_text'     => new \Fieldmanager_Textfield( esc_html__( 'Banner Video Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'security_video_fields'    => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'security_type',
							'value' => 'video',
						),
						'children'   => array(
							'file'        => new \Fieldmanager_Media( 'Banner Video File', array(
								'mime_type'    => 'all',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
							) ),
						),
					) ),
					'banner_fcolor' => new \Fieldmanager_Select( esc_html__( 'Banner Font Color', 'fbiamdigital' ), array(
						'options' => array(
							'purple' => esc_html__( 'Purple', 'fbiamdigital' ),
							'light_green'     => esc_html__( 'Light Green', 'fbiamdigital' ),
							'white'    => esc_html__( 'white', 'fbiamdigital' ),
						),
					) ),
					'text_direction' => new \Fieldmanager_Select( esc_html__( 'Direction for the page content', 'fbiamdigital' ), array(
						'options' => array(
							'left' => esc_html__( 'Left', 'fbiamdigital' ),
							'right' => esc_html__( 'Right', 'fbiamdigital' ),
						),
					) ),
					'main_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Main Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
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
					
					'dispaly_scam' => new \Fieldmanager_Checkbox( array(
						'label'       => __( 'Display Scam Filter section?', 'fbiamdigital' ),
						'description' => __( 'Check this box to display Scam Filter.', 'fbiamdigital' ),
					) ),
					
					'drop_select'  => new \Fieldmanager_Textfield( esc_html__( 'Dropdown Select Text', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'drop_shop'  => new \Fieldmanager_Textfield( esc_html__( 'Dropdown Shop Text', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'drop_scamsters'  => new \Fieldmanager_Textfield( esc_html__( 'Dropdown Scamsters Text', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
					
					'security_heading'  => new \Fieldmanager_Textfield( esc_html__( 'Scamsters Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'security_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Scamsters Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
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
					'security_scam_video_text' => new \Fieldmanager_Textfield( esc_html__( 'Security Video Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'security_scam_video_image' => new \Fieldmanager_Media( esc_html__( 'Security Video Image', 'fbdigitalscam' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'security_scam_video_fields' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'security_type',
							'value' => 'video',
						),
						'children'   => array(
							'file'   => new \Fieldmanager_Media( 'Security Video File', array(
								'mime_type'    => 'all',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
							) ),
						),
					) ),
					
					'fullvideo_text'     => new \Fieldmanager_Textfield( esc_html__( 'Scamsters Full Video Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'fullvideo_poster'  => new \Fieldmanager_Media( esc_html__( 'Scamsters Video Poster Image', 'fbdigitalscam' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'fullvideo_link'    => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'security_type',
							'value' => 'video',
						),
						'children'   => array(
							'file'        => new \Fieldmanager_Media( 'Scamsters Video File', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
							) ),
						),
					) ),
					'logo_header'     => new \Fieldmanager_Textfield( esc_html__( 'Scamsters Logo Header', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'jumbotron'          => new \Fieldmanager_Group(  array( esc_html__( 'Scamsters Logos', 'fbiamdigital' ),
					
						'description'    => esc_html__( 'Display up to 50 related logos' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Logo', 'fbiamdigital' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),			
						'children' => array(
							'parlogo'          => new \Fieldmanager_Media( esc_html__( 'Scamsters Logo', 'fbiamdigital' ), array(
								'mime_type'        => 'image',
								'description'      => esc_html__( 'Dimensions: 1024x197px', 'fbiamdigital' ),
								'button_label'     => esc_html__( 'Select an Logo', 'fbiamdigital' ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plogolink'     => new \Fieldmanager_Textfield( esc_html__( 'Scamsters Logo URL', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:500px'),
							) ),
							
						),
					) ),
					'download_secure_text' => new \Fieldmanager_Textfield( esc_html__( 'Scamsters Download Button Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'download_secure_link' => new \Fieldmanager_Textfield( esc_html__( 'Scamsters Download Button Link', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
					
					
					'shop_heading'            => new \Fieldmanager_Textfield( esc_html__( 'Shopping Scam Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'shop_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Shopping Scam Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
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
					'shop_video_text'     => new \Fieldmanager_Textfield( esc_html__( 'Shopping Video Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'shop_video_image'  => new \Fieldmanager_Media( esc_html__( 'Shopping Video Image', 'fbdigitalscam' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'shop_security_video_fields'    => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'security_type',
							'value' => 'video',
						),
						'children'   => array(
							'file'        => new \Fieldmanager_Media( 'Shopping Video File', array(
								'mime_type'    => 'all',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
							) ),
						),
					) ),
					'shop_fullvideo_text'     => new \Fieldmanager_Textfield( esc_html__( 'Shopping Full Video Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'shop_fullvideo_poster'  => new \Fieldmanager_Media( esc_html__( 'Shopping Full Video Poster Image', 'fbdigitalscam' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'shop_fullvideo_link'    => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'security_type',
							'value' => 'video',
						),
						'children'   => array(
							'file'        => new \Fieldmanager_Media( 'Shopping Full Video File', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
								'description'  => 'File types: *.mp4',
							) ),
						),
					) ),
					'shop_logo_header'     => new \Fieldmanager_Textfield( esc_html__( 'Shopping Logo Header', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'shop_jumbotron'          => new \Fieldmanager_Group(  array( esc_html__( 'Shopping Logos', 'fbiamdigital' ),
					
						'description'    => esc_html__( 'Display up to 50 related logos' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Logo', 'fbiamdigital' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),			
						'children' => array(
							'parlogo'          => new \Fieldmanager_Media( esc_html__( 'Shopping Logo', 'fbiamdigital' ), array(
								'mime_type'        => 'image',
								'description'      => esc_html__( 'Dimensions: 1024x197px', 'fbiamdigital' ),
								'button_label'     => esc_html__( 'Select an Logo', 'fbiamdigital' ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plogolink'     => new \Fieldmanager_Textfield( esc_html__( 'Shopping Logo URL', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:500px'),
							) ),
							
						),
					) ),
					'download_shop_text' => new \Fieldmanager_Textfield( esc_html__( 'Shopping Download Button Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'download_shop_link' => new \Fieldmanager_Textfield( esc_html__( 'Shopping Download Button Link', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
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