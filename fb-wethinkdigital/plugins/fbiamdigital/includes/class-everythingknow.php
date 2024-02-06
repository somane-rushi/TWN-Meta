<?php

namespace Fbiamdigital_Site_Plugin;

class Everythingknow {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/everythingyouneedtoknow';

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
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),			
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
					
					'button_title' => new \Fieldmanager_Textfield( esc_html__( 'Link Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'file' => new \Fieldmanager_Media( array(
							'mime_type'    => 'all',
							'button_label' => esc_html__( 'Select a file', 'fbiamdigital' ),
							'description'  => 'File types: *.pdf, *.ppt, *.zip, *.jpg, *.png',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Page Content', 'fbiamdigital' ), $this->post_type );
			
			
			

		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}
}