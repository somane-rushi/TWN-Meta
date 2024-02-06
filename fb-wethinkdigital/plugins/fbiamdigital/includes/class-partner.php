<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Partner
 * @package Fbiamdigital_Site_Plugin
 */
class Partner {

	/**
	 * @var string
	 */
	var $post_type = 'partner';

	/**
	 * Partner constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'rest_api_init', array( $this, 'custom_rest_api_attributes' ) );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Partners', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Partner', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Partners', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Partner', 'fbiamdigital' ),
			'archives'              => __( 'Partners', 'fbiamdigital' ),
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
			'slug'       => 'partners',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'                 => __( 'Partner', 'fbiamdigital' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'show_in_rest'          => true,
			'rest_base'             => 'partner',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'can_export'            => true,
			'has_archive'           => 'partners',
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
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
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'show_tagcloud'     => false,
		);
		register_taxonomy( 'country', array( $this->post_type ), $args );
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		$fm = new \Fieldmanager_TextArea( array(
			'name'             => 'excerpt',
			'attributes'       => array( 'style' => 'width:100%', 'rows' => 3 ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Excerpt', 'fbiamdigital' ), $this->post_type );
		$fm = new \Fieldmanager_Textfield( array(
			'name'             => 'partner-link',
			'attributes'       => array( 'style' => 'width:100%', 'rows' => 3 ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Partner Website Link', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_Media( array(
			'name'             => 'footer_logo',
			'mime_type'        => 'image',
			'description'      => esc_html__( 'Used when displaying in footer. Dimensions: 100x40px or 200x80px', 'fbiamdigital' ),
			'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Footer Logo', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_Checkbox( array(
			'name' => 'is_featured',
			'label' => 'Enable'
		) );
		$fm->add_meta_box( esc_html__( 'Featured', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_TextField( array(
			'name' => 'featured_priority',
			'label' => 'Priority',
			'description' => esc_html__( 'Lowest number has highest priority (1 - highest priority, 30 - lowest priority)', 'fbiamdigital' ),
		) );
		$fm->add_meta_box( esc_html__( 'Featured priority', 'fbiamdigital' ), $this->post_type );

		$datasource_post = new \Fieldmanager_Datasource_Post( array(
			'query_args' => array(
				'post_type'      => 'program',
				'post_status'    => 'publish',
				'posts_per_page' => 100,
			),
			'use_ajax'   => true,
			'reciprocal' => 'partners',
		) );
		$fm              = new \Fieldmanager_Select( array(
			'name'             => 'program',
			'datasource'       => $datasource_post,
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Link to program', 'fbiamdigital' ), $this->post_type, 'side' );

		return true;
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
				'taxonomy'               => 'country',
				'taxonomy_save_to_terms' => false,
				'use_ajax'               => false,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading'            => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbiamdigital' ), array(
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
					'mbanner_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Content For Mobile', 'fbiamdigital' ), array(
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
					'description'        => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
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
					'primary_country_id' => new \Fieldmanager_Select( 'Primary Country', array(
						'datasource'  => $country_term_datasource,
						'first_empty' => true,
						'description' => __( 'If selected, partners will be ordered by this country first', 'fbiamdigital' ),
					) ),
					'enable_enhancement_sort' => new \Fieldmanager_Checkbox( array(
						'label' => 'Enable enhancement order partners'
					) ),
					
					'wtdparfilter'  => new \Fieldmanager_Group( esc_html__( 'Partner Filter Text', 'fbiamdigital' ), array(
						'children' => array(
							'par_head' => new \Fieldmanager_Textfield( esc_html__( 'Filter Heading', 'fbiamdigital' ) ),
							'par_drop' => new \Fieldmanager_Textfield( esc_html__( 'Dropdown Default Text', 'fbiamdigital' ) ),
							'morebtn_par' => new \Fieldmanager_Textfield( esc_html__( 'Load more button text', 'fbiamdigital' ) ),	
						),
					) ),

					
					// Councillor Section
					'councillorsec'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( ' slides', 'fbiamdigital' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'councillor',
						),
						'children'    => array(
							'councillor_heading'     => new \Fieldmanager_Textfield( esc_html__( 'Councillor Section Heading', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
							'councillor' => new \Fieldmanager_Group( esc_html__( 'Councillor', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add another Councillor', 'fbiamdigital' ),
									'limit'          => 200,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['councillor_image'] );
									},
									'children'       => array(
										'councillor_image' => new \Fieldmanager_Media( esc_html__( 'Councillor Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
										'councillor_title'     => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'councillor_designation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'councillor_desc' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
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
								)
							),
						),
					) ),
					// partner logo section
					'plogo_header' => new \Fieldmanager_Textfield( esc_html__( 'Partner Logo Header', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'part_logo'=> new \Fieldmanager_Group(  array( esc_html__( 'Partner Logos', 'fbiamdigital' ),
	
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Partner Logo', 'fbiamdigital' ),
						'sortable'       => true,
						'collapsible'    => true,			
						'children' => array(
							'p_title'     => new \Fieldmanager_Textfield( esc_html__( 'Partner Title', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:500px'),
							) ),
							'logo_img'          => new \Fieldmanager_Media( esc_html__( 'Logo Image', 'fbiamdigital' ), array(
								'mime_type'        => 'image',
								'button_label'     => esc_html__( 'Select an Logo', 'fbiamdigital' ),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'plogo_link'     => new \Fieldmanager_Textfield( esc_html__( 'Partner Logo URL', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:500px'),
							) ),
							
						),
					) ),
					// end partner


					
				),
			) );
			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}

	/**
	 * Add custom rest API attributes to our model
	 */
	public function custom_rest_api_attributes() {
		register_rest_field( 'partner', 'footer_logo', array(
			'get_callback'    => function ( $object ) {
				// Retrieve a list of attachment IDs
				$footer_logo_id = get_post_meta( $object['id'], 'footer_logo', true );

				if ( ! empty( $footer_logo_id ) ) {
					return wp_get_attachment_url( $footer_logo_id );
				}

				return '';
			},
			'update_callback' => null,
			'schema'          => array(
				'description' => __( 'Footer Logo URL' ),
				'type'        => 'string',
			),
		) );
	}
}