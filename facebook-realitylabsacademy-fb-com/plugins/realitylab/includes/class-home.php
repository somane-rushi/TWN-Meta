<?php

namespace Fbrealitylabsacademy_Site_Plugin;

class Home {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/home';

	/**
	 * Home constructor.
	 */
	public function __construct() {
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
	}

	/**
	 * Register custom fields for this post type
	 */
	public function custom_fields() {
		if ( ! Utils::is_using_template( $this->page_template ) ) {
			return false;
		}

		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "secone",
				'children' => array(
					'one_title'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'one_description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'one_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'realitylab' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'realitylab' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'one_btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'realitylab' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'one_btn_link'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'realitylab' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectwo",
				'children' => array(
					'two_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'realitylab' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'realitylab' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'add_carousel'          => new \Fieldmanager_Group(  array( esc_html__( 'Add', 'realitylab' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Slide', 'realitylab' ),				
						'children' => array(
							'caro_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'caro_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'realitylab' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two - Carousel', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "secthree",
				'children' => array(
					'add_feature'          => new \Fieldmanager_Group(  array( esc_html__( 'Add Feature', 'realitylab' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Feature', 'realitylab' ),				
						'children' => array(
							'feat_icon'  => new \Fieldmanager_Media( esc_html__( 'Icon', 'realitylab' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'realitylab' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'feat_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'feat_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'realitylab' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'realitylab' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'feat_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'realitylab' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'feat_btntext'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'realitylab' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'feat_btnlink'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'realitylab' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Three - Features', 'realitylab' ), $this->post_type );
			


		} catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}

		return true;
	}
}