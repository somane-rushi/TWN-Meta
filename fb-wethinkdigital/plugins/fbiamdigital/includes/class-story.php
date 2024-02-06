<?php

namespace Fbiamdigital_Site_Plugin;

/**
 * Class Story
 * @package Fbiamdigital_Site_Plugin
 */
class Story {

	/**
	 * @var string
	 */
	var $post_type = 'story';

	/**
	 * Story constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Stories', 'Post Type General Name', 'fbiamdigital' ),
			'singular_name'         => _x( 'Story', 'Post Type Singular Name', 'fbiamdigital' ),
			'menu_name'             => __( 'Stories', 'fbiamdigital' ),
			'name_admin_bar'        => __( 'Story', 'fbiamdigital' ),
			'archives'              => __( 'Stories', 'fbiamdigital' ),
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
			'slug'       => 'voices',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Story', 'fbiamdigital' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'taxonomies'          => array( 'story_category' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => 'voices',
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
			'name'                       => _x( 'Categories', 'Taxonomy General Name', 'fbiamdigital' ),
			'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'fbiamdigital' ),
			'menu_name'                  => __( 'Category', 'fbiamdigital' ),
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
			'query_var'         => 'category',
		);
		register_taxonomy( 'story_category', array( $this->post_type ), $args );
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		$fm = new \Fieldmanager_Media( array(
			'name'             => 'author_profile',
			'mime_type'        => 'image',
			'description'      => esc_html__( 'Dimensions: 50x50px', 'fbiamdigital' ),
			'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Author Profile', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_Textfield( array(
			'name'             => 'author',
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( 'Author Name', $this->post_type );

		$fm = new \Fieldmanager_Textfield( array(
			'name'             => 'author_headline',
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( 'Author Headline', $this->post_type );

		$fm = new \Fieldmanager_Media( array(
			'name'             => 'masthead_image',
			'mime_type'        => 'image',
			'description'      => esc_html__( 'Dimensions: 1440x410px', 'fbiamdigital' ),
			'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Masthead Image', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_TextArea( array(
			'name'             => 'excerpt',
			'attributes'       => array( 'style' => 'width:100%;', 'rows' => 6 ),
			'validation_rules' => array(
				'required' => true,
			),
			'description'      => 'Short description for resource listings page',
		) );
		$fm->add_meta_box( esc_html__( 'Excerpt', 'fbiamdigital' ), $this->post_type );

		$fm = new \Fieldmanager_TextArea( array(
			'name'             => 'intro',
			'attributes'       => array( 'style' => 'width:100%', 'rows' => 3 ),
			'validation_rules' => array(
				'required' => true,
			),
		) );
		$fm->add_meta_box( esc_html__( 'Introduction', 'fbiamdigital' ), $this->post_type );

		try {
			$fm = new \Fieldmanager_Group( esc_html__( 'Select a component type', 'fbiamdigital' ), array(
				'name'           => 'body',
				'starting_count' => 1,
				'limit'          => 0,
				'add_more_label' => esc_html__( 'Add component', 'fbiamdigital' ),
				'label_macro'    => array( esc_html__( 'Component: %s', 'fbiamdigital' ), 'component_type' ),
				'sortable'       => true,
				'collapsible'    => true,
				'group_is_empty' => function ( $values ) {
					// https://github.com/alleyinteractive/wordpress-fieldmanager/issues/688
					return empty( $values['component_type'] );
				},
				'children'       => array(
					'component_type'              => new \Fieldmanager_Select( esc_html__( 'Type', 'fbiamdigital' ), array(
						'options' => array(
							'text'       => esc_html__( 'Text', 'fbiamdigital' ),
							'gallery'    => esc_html__( 'Image Gallery', 'fbiamdigital' ),
							'blockquote' => esc_html__( 'Blockquote', 'fbiamdigital' ),
							'video'      => esc_html__( 'Video', 'fbiamdigital' ),
						),
					) ),
					// Text Component
					'component_text_fields'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'text',
						),
						'children'   => array(
							'body' => new \Fieldmanager_RichTextArea( array(
								'buttons_1'        => array( 'bold', 'italic', 'link', 'bullist' ),
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
						),
					) ),
					// Gallery Component
					'component_gallery_fields'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 6 slides', 'fbiamdigital' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'gallery',
						),
						'children'    => array(
							'slide' => new \Fieldmanager_Group( esc_html__( 'Slide', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add another slide', 'fbiamdigital' ),
									'limit'          => 6,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										// https://github.com/alleyinteractive/wordpress-fieldmanager/issues/688
										return empty( $values['image'] );
									},
									'children'       => array(
										'image'   => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select an image', 'fbiamdigital' ),
											'description'  => esc_html__( 'Dimensions: 600x400px', 'fbiamdigital' ),
										) ),
										'caption' => new \Fieldmanager_Textfield( esc_html__( 'Caption', 'fbiamdigital' ), array(
											'name' => 'caption',
										) ),
									),
								)
							),
						),
					) ),
					// Blockquote Component
					'component_blockquote_fields' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'blockquote',
						),
						'children'   => array(
							'quote' => new \Fieldmanager_TextArea( esc_html__( 'Quotation', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'width:100%', 'rows' => 3 ),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'cite'  => new \Fieldmanager_Textfield( esc_html__( 'Cite', 'fbiamdigital' ), array(
								'validation_rules' => array(
									'required' => true,
								),
							) ),
						),
					) ),
					// Video Component
					'component_video_fields'      => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'video',
						),
						'children'   => array(
							'video' => new \Fieldmanager_Media( esc_html__( 'Video', 'fbiamdigital' ), array(
								'mime_type'    => 'video',
								'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
							) ),
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Body', 'fbiamdigital' ), $this->post_type );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		try {
			$datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array( 'post_type' => $this->post_type ),
				'use_ajax'   => true,
			) );
			$fm              = new \Fieldmanager_Group( array(
				'name'           => 'related',
				'description'    => esc_html__( 'Display up to 3 related stories' ),
				'limit'          => 3,
				'add_more_label' => esc_html__( 'Add story', 'fbiamdigital' ),
				'sortable'       => true,
				'collapsible'    => true,
				'children'       => array(
					'post_id' => new \Fieldmanager_Autocomplete( 'Select story', array( 'datasource' => $datasource_post ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Related Stories', 'fbiamdigital' ), $this->post_type );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

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
			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading'     => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbiamdigital' ), array(
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
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
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
				),
			) );
			$fm->activate_submenu_page();
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}
}