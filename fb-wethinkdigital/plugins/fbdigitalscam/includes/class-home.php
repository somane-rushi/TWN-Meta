<?php

namespace fbdigitalscam_Site_Plugin;

class Home {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/home-template';

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
				'name'     => "sectionfirst",
				'children' => array(
					'videolink'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section 1', 'fbdigitalscam' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectiontwo",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'title1'  => new \Fieldmanager_Textfield( esc_html__( 'Title 1', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image1'  => new \Fieldmanager_Media( esc_html__( 'Image 1', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
								) ),
					'title2'  => new \Fieldmanager_Textfield( esc_html__( 'Title 2', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image2'  => new \Fieldmanager_Media( esc_html__( 'Image 2', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
								) ),
					'title3'  => new \Fieldmanager_Textfield( esc_html__( 'Title 3', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image3'  => new \Fieldmanager_Media( esc_html__( 'Image 3', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
								) ),
					'title4'  => new \Fieldmanager_Textfield( esc_html__( 'Title 4', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image4'  => new \Fieldmanager_Media( esc_html__( 'Image 4', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
								) ),
					'title5'  => new \Fieldmanager_Textfield( esc_html__( 'Title 5', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image5'  => new \Fieldmanager_Media( esc_html__( 'Image 5', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
								) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section 2', 'fbdigitalscam' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "loan_scamster",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subheading'  => new \Fieldmanager_Textfield( esc_html__( 'Sub Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbdigitalscam' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbdigitalscam' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'videolabel'     => new \Fieldmanager_Textfield( esc_html__( 'Video Label', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'videolink'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Loan Scamster', 'fbdigitalscam' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "lottery_scamster",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subheading'  => new \Fieldmanager_Textfield( esc_html__( 'Sub Heading', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbdigitalscam' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbdigitalscam' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'videolabel'     => new \Fieldmanager_Textfield( esc_html__( 'Video Label', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'videolink'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Lottery Scamster', 'fbdigitalscam' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "romantic_scamster",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subheading'     => new \Fieldmanager_Textfield( esc_html__( 'Sub Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbdigitalscam' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbdigitalscam' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'videolabel'     => new \Fieldmanager_Textfield( esc_html__( 'Video Label', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'videolink'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Romantic Scamster', 'fbdigitalscam' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "job_scamster",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subheading'  => new \Fieldmanager_Textfield( esc_html__( 'Sub Heading', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbdigitalscam' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbdigitalscam' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'videolabel'     => new \Fieldmanager_Textfield( esc_html__( 'Video Label', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'videolink'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Job Scamster', 'fbdigitalscam' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "ecommerce_scamster",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subheading'     => new \Fieldmanager_Textfield( esc_html__( 'Sub Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbdigitalscam' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbdigitalscam' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br />',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'videolabel'     => new \Fieldmanager_Textfield( esc_html__( 'Video Label', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'videolink'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'E-Commerce Scamster', 'fbdigitalscam' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "all_scamster",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbdigitalscam' ),
									array( 'attributes'       => array('style' => 'width:100%') )
					 ),
					'videolabel'     => new \Fieldmanager_Textfield( esc_html__( 'Video Label', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'videolink'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbdigitalscam' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'gif'        => new \Fieldmanager_Media( esc_html__( 'GIF', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select GIF', 'fbdigitalscam' ),
								) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'The Scamsters', 'fbdigitalscam' ), $this->post_type );

		

		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbdigitalscam_fm', $e->getMessage() );
		}

		return true;
	}
}