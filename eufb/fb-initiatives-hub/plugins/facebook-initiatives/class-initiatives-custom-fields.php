<?php
/**
 * Set Up Custom Fields for the Initiatives Theme to Use
 * @package facebook-initiatives
 */

/**
 * The instantiated version of this plugin's class
 */
$GLOBALS['initiatives_custom_fields'] = new Initiatives_Custom_Fields;

class Initiatives_Custom_Fields {
	
	public function __construct() {
		
		/**
		 * Create the new post types for key content on the site
		 */
		add_action( 'init', array( $this, 'partners_custom_post_type' ) );
		add_action( 'init', array( $this, 'team_members_custom_post_type' ) );
		
		/**
		 * Trigger each custom field and admin view action
		 */
		add_action( 'fm_term_category', array( $this, 'stories_custom_fields' ) );
		add_action( 'fm_post_post', array( $this, 'posts_custom_fields' ) );
		add_action( 'fm_post_page', array( $this, 'about_us_custom_fields' ) );
		
		//add order column
		add_filter( 'manage_edit-category_columns', array( $this, 'modify_columns' ) );
		add_filter( 'manage_category_custom_column', [ $this, 'column_content' ], 10, 3 );
		
	}
	
	
	public function modify_columns( $columns ) {
		// New columns to add to table
		$new_columns      = array(
			'order' => __( 'Order', 'facebook-initiatives-plugin' ),
		);
		$filtered_columns = array_merge( $columns, $new_columns );
		
		return $filtered_columns;
	}
	
	/**
	 * Display the rating in post list
	 *
	 * @param $column
	 */
	public function column_content( $content, $column_name, $term_id ) {
		$content = '-';
		
		switch ( $column_name ) {
			case 'order':
				$order = get_term_meta( $term_id, 'cat_position', true );
				if ( $order ) {
					$content = $order;
				}
				break;
		}
		
		return $content;
	}
	
	/**
	 * Stories
	 * Added meta to Category Taxonomy
	 */
	public function stories_custom_fields() {
		
		/* Title which allows for strong tags for the blue sections */
		$fm = new Fieldmanager_TextField(
			[
				'name'             => 'cat_position',
				'validation_rules' => [
					'required' => true,
				],
				'attributes'       => [
					'required' => true,
				],
			]
		);
		
		$fm->add_term_meta_box( __( 'Position', 'facebook-initiatives-plugin' ), array( 'category' ) );
		
		/* Title which allows for strong tags for the blue sections */
		$fm = new Fieldmanager_RichTextArea( array(
			'name'             => 'story_title',
			'editor_settings'  => array(
				'media_buttons' => false,
				'textarea_rows' => 2,
				'teeny'         => false,
			),
		) );
		$fm->add_term_meta_box( __( 'Story Title', 'facebook-initiatives-plugin' ), array( 'category' ) );

		/* Border colour picker */
		$fm = new Fieldmanager_Colorpicker( array(
			'name'          => 'border_colour',
			'default_value' => '#4367b1',
		) );
		$fm->add_term_meta_box( __( 'Story Border Colour', 'facebook-initiatives-plugin' ), 'category' );

		/* Featured image */
		$fm = new Fieldmanager_Group( array(
			'name'     => 'featured_images',
			'limit'    => 1,
			'label'    => 'Featured Images',
			'sortable' => false,
			'children' => array(
				'featured_image_desktop' => new Fieldmanager_Media(
					__( 'Desktop Featured Image', 'facebook-initiatives-plugin' ), [
						'button_label'       => __( 'Add Desktop Featured Image', 'facebook-initiatives-plugin' ),
						'description'        => __( 'Recommended Image Width: 1920 x 1080 px', 'facebook-initiatives-plugin' ),
						'modal_title'        => __( 'Add Desktop Featured Image', 'facebook-initiatives-plugin' ),
						'modal_button_label' => __( 'Select Image', 'facebook-initiatives-plugin' ),
						'preview_size'       => 'thumbnail',
						'validation_rules'   => [
							'required' => true,
						],
					]
				),
				'featured_image_mobile'  => new Fieldmanager_Media(
					__( 'Mobile Featured Image', 'facebook-initiatives-plugin' ), [
						'button_label'       => __( 'Add Mobile Featured Image', 'facebook-initiatives-plugin' ),
						'description'        => __( 'Recommended Dimensions: 600 x 900 px', 'facebook-initiatives-plugin' ),
						'modal_title'        => __( 'Add Mobile Featured Image', 'facebook-initiatives-plugin' ),
						'modal_button_label' => __( 'Select Image', 'facebook-initiatives-plugin' ),
						'preview_size'       => 'thumbnail',
						'validation_rules'   => [
							'required' => true,
						],
					]
				),
			),
		) );
		$fm->add_term_meta_box( __( 'Featured Images', 'facebook-initiatives-plugin' ), array( 'category' ) );

		// Field group for the quote
		// Quote
		//      Content (Textarea)
		//      Author ( Text input )
		//      Author job title ( Text input )
		$fm = new Fieldmanager_Group( array(
			'name'     => 'quote_one',
			'limit'    => 1,
			'label'    => 'Quote 1',
			'sortable' => false,
			'children' => array(
				'quote'                  => new Fieldmanager_TextArea(
					__( 'Quote', 'facebook-initiatives-plugin' )
				),
				'quote_author'           => new Fieldmanager_TextField(
					__( 'Quote Author', 'facebook-initiatives-plugin' )
				),
				'quote_author_job_title' => new Fieldmanager_TextField(
					__( 'Quote Author Job Title', 'facebook-initiatives-plugin' )
				),
			),
		) );
		$fm->add_term_meta_box( __( 'Quote Area 1', 'facebook-initiatives-plugin' ), 'category' );

		$fm = new Fieldmanager_Group( array(
			'name'     => 'quote_two',
			'limit'    => 1,
			'label'    => 'Quote 2',
			'sortable' => false,
			'children' => array(
				'quote'                  => new Fieldmanager_TextArea(
					__( 'Quote', 'facebook-initiatives-plugin' )
				),
				'quote_author'           => new Fieldmanager_TextField(
					__( 'Quote Author', 'facebook-initiatives-plugin' )
				),
				'quote_author_job_title' => new Fieldmanager_TextField(
					__( 'Quote Author Job Title', 'facebook-initiatives-plugin' )
				),
			),
		) );
		$fm->add_term_meta_box( __( 'Quote Area 2', 'facebook-initiatives-plugin' ), 'category' );
	}
	
	/**
	 * Posts
	 * Add a subtitle to posts meta
	 */
	public function posts_custom_fields() {

		// Post Subtitle - for display on hover
		$fm = new Fieldmanager_TextField( array(
			'name' => 'post_subtitle',
		) );
		$fm->add_meta_box( __( 'Subtitle', 'facebook-initiatives-plugin' ), 'post' );

		// Carousel Inner Image
		$fm = new Fieldmanager_Media( array(
			'name'               => 'inner_image',
			'button_label'       => __( 'Inner Image', 'facebook-initiatives-plugin' ),
			'modal_title'        => __( 'Add an Image', 'facebook-initiatives-plugin' ),
			'modal_button_label' => __( 'Select Image', 'facebook-initiatives-plugin' ),
			'preview_size'       => 'thumbnail',
		) );
		$fm->add_meta_box( __( 'Inner Image', 'facebook-initiatives-plugin' ), 'post' );

		// Carousel Inner Video
		$fm = new Fieldmanager_Link( array(
			'name'        => 'facebook_video_url',
			'description' => 'Will override Inner Image if set',
		) );
		$fm->add_meta_box( __( 'Video URL', 'facebook-initiatives-plugin' ), 'post' );
	}

	/**
	 * Partners
	 * Add meta to a page with the slug /partners only
	 */
	public function partners_custom_post_type() {
		
		register_post_type( 'partners',
			array(
				'labels'   => array(
					'name'          => __( 'Partners', 'facebook-initiatives-plugin' ),
					'singular_name' => __( 'Partner', 'facebook-initiatives-plugin' ),
				),
				'public'   => true,
				'supports' => array( 'title', 'thumbnail' ),
			)
		);
		
		// Url for the partner
		$fm = new Fieldmanager_TextField( array(
			'name' => 'partner_url',
		) );
		$fm->add_meta_box( __( 'Partner URL', 'facebook-initiatives-plugin' ), 'partners' );
		
	}
	
	/**
	 * About Us
	 * Add meta to a page with the slug /partners only
	 */
	public function about_us_custom_fields() {
		
		// Field group for the __stats area__ quote
		// All other quotes are in the widget group
		// Quote
		//      Content (Textarea)
		//      Author ( Text input )
		//      Author job title ( Text input )
		$fm = new Fieldmanager_Group( array(
			'name'     => 'stats_quote',
			'limit'    => 1,
			'label'    => __( 'Stats Area Quote', 'facebook-initiatives-plugin' ),
			'sortable' => false,
			'children' => array(
				'stats_quote'                  => new Fieldmanager_TextArea( __( 'Quote', 'facebook-initiatives-plugin' ) ),
				'stats_quote_author'           => new Fieldmanager_TextField( __( 'Quote Author', 'facebook-initiatives-plugin' ) ),
				'stats_quote_author_job_title' => new Fieldmanager_TextField( __( 'Quote Author Job Title', 'facebook-initiatives-plugin' ) ),
			),
		) );
		$fm->add_meta_box( __( 'Stats Area Quote', 'facebook-initiatives-plugin' ), 'category' );
	}
	
	/**
	 * Team Members
	 * Add meta to a page with the slug /partners only
	 */
	public function team_members_custom_post_type() {
		
		// Team Member
		// 		Image
		// 		Name
		// 		Job Title
		//		Location
		register_post_type( 'team-members',
			array(
				'labels'   => array(
					'name'          => __( 'Team Members', 'facebook-initiatives-plugin' ),
					'singular_name' => __( 'Team Member', 'facebook-initiatives-plugin' ),
				),
				'public'   => true,
				'supports' => array( 'title', 'thumbnail' ),
			)
		);
		
		// Team members for the partner
		$fm = new Fieldmanager_TextField( array(
			'name' => 'job_title',
		) );
		$fm->add_meta_box( __( 'Job Title', 'facebook-initiatives-plugin' ), 'team-members' );
		
	}
}
