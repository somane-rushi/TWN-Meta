<?php

namespace Fbiamdigital_Site_Plugin;

class Interactivecontent {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/interactivecontent';

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
					'banner_image'  => new \Fieldmanager_Media( esc_html__( 'Backgroung Image', 'fbiamdigital' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'banner_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Banner', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "videoarchive",
				'children' => array(
					'page_title' => new \Fieldmanager_Textfield( esc_html__( 'Page Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes' => array( 'size'     => 100,'required' => true, ),
						'init_options'    => array( 'paste_as_text'  => true, 'valid_elements' => '<br />',),
						'editor_settings' => array(
							'default_editor' => 'html', 'media_buttons' => false,
						)
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Video Archive', 'fbiamdigital' ), $this->post_type );
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}
}