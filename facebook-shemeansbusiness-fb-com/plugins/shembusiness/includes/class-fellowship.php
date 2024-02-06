<?php

namespace Fbshemeansbusiness_Site_Plugin;

class Fellowship {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/fellowship';

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
				'name'     => "banner",
				'children' => array(
					'image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Banner Image', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_two",
				'children' => array(
					'sec_head'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'sec_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "secthr",
				'children' => array(
					'sec_thr_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'sec_thr_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Three', 'shembusiness' ), $this->post_type );
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
}