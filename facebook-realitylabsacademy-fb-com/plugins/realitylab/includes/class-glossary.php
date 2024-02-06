<?php

namespace Fbrealitylabsacademy_Site_Plugin;

/**
 * Class Glossary
 * @package Fbrealitylabsacademy_Site_Plugin
 */
class Glossary {

	/**
	 * @var string
	 */
	var $post_type = 'glossary';

	/**
	 * Course constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
		add_action( 'template_redirect', array( $this, 'redirect_single_to_archive' ), 10 );
		$this->setup_archive_page();
	}

	/**
	 *  Register the post type
	 */
	public function register_post_type() {
		$labels  = array(
			'name'                  => _x( 'Glossary', 'Post Type General Name', 'realitylab' ),
			'singular_name'         => _x( 'Glossary', 'Post Type Singular Name', 'realitylab' ),
			'menu_name'             => __( 'Glossary', 'realitylab' ),
			'name_admin_bar'        => __( 'Glossary', 'realitylab' ),
			'archives'              => __( 'Glossary', 'realitylab' ),
			'attributes'            => __( 'Item Attributes', 'realitylab' ),
			'parent_item_colon'     => __( 'Parent Item:', 'realitylab' ),
			'all_items'             => __( 'All Glossary', 'realitylab' ),
			'add_new_item'          => __( 'Add New Glossary', 'realitylab' ),
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
			'slug'       => 'glossary',
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Glossary', 'realitylab' ),
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
			'has_archive'         => 'glossary',
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
			'name'                       => _x( 'Glossary Category', 'Taxonomy General Name', 'realitylab' ),
			'singular_name'              => _x( 'Glossary Category', 'Taxonomy Singular Name', 'realitylab' ),
			'menu_name'                  => __( 'Glossary Category', 'realitylab' ),
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
		register_taxonomy( 'glossary_category', array( $this->post_type ), $args );
	}
	
	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		try {
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "glossarylist",
				'children' => array(
					'gterm' => new \Fieldmanager_Textfield( esc_html__( 'Term', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;' ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'gdefinition'    => new \Fieldmanager_RichTextArea( esc_html__( 'Definition', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'gacronym' => new \Fieldmanager_Textfield( esc_html__( 'Acronym', 'realitylab' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;' ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Details', 'realitylab' ), $this->post_type );
					
			} catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
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
			$glossary_datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array(
					'post_type'      => 'glossary',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );
			$fm = new \Fieldmanager_Group( array(
				'name'     => "archive_{$this->post_type}",
				'children' => array(
					'heading'            => new \Fieldmanager_Textfield( esc_html__( 'Page Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'sortheading'            => new \Fieldmanager_Textfield( esc_html__( 'Sort Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			
			$fm->activate_submenu_page();
		} 
		catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}
	
		
		
		return true;
	}
	
	
}
