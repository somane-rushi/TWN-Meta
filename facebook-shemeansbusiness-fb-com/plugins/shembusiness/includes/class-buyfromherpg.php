<?php

namespace Fbshemeansbusiness_Site_Plugin;

class Buyfromherpg {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/buyfromher';

	/**
	 * Page constructor.
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
					'banner_vd'        => new \Fieldmanager_Media( 'Video File', array(
						'mime_type'    => 'video/mp4',
						'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
						'description'  => 'File types: *.mp4',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Banner Video', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_two",
				'children' => array(
					'sectwo_title'        => new \Fieldmanager_Textfield( esc_html__( 'Section Title', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'sectwo_poster'  => new \Fieldmanager_Media( esc_html__( 'Poster Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'sectwo_vd'        => new \Fieldmanager_Media( 'Video File', array(
						'mime_type'    => 'video/mp4',
						'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
						'description'  => 'File types: *.mp4',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_thr",
				'children' => array(
					'secthr_img'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'secthr_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'secthr_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Three', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_four",
				'children' => array(
					'secfr_img'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'secfr_title'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'secfr_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'secfr_insta'        => new \Fieldmanager_Textfield( esc_html__( 'Instagram Username', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'secfr_instaln'        => new \Fieldmanager_Textfield( esc_html__( 'Instagram Link', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'secfr_website'        => new \Fieldmanager_Textfield( esc_html__( 'Website Text', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'secfr_websiteln'        => new \Fieldmanager_Textfield( esc_html__( 'Website Link', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Four', 'shembusiness' ), $this->post_type );
			
			
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
}