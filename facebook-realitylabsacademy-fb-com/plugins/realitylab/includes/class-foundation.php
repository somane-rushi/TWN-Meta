<?php

namespace Fbrealitylabsacademy_Site_Plugin;

class Foundation {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/foundation';

	/**
	 * Foundation constructor.
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
						'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
						'required' => false,
						),
					) ),
					'one_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'realitylab' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'realitylab' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectwo",
				'children' => array(
					'two_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'two_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
						'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two - Get Started', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "secthree",
				'children' => array(
					'three_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'three_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'realitylab' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
						'required' => false,
						),
					) ),
					'three_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'realitylab' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'realitylab' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Three - At the end', 'realitylab' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "secfor",
				'children' => array(
					'for_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'realitylab' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'for_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'realitylab' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'realitylab' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Four', 'realitylab' ), $this->post_type );
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'realitylab_fm', $e->getMessage() );
		}

		return true;
	}
	
	
}