<?php

namespace Fbapac_Site_Plugin;

class Covid19 {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-template/page-covid19';

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
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( '<br> <a> <strong> allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'btntext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'btnlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'bgimage' => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),				
				),
			) );
			$fm->add_meta_box( esc_html__( 'Covid19 Section One', 'fbapac' ), $this->post_type );
		
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectiontwo",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),

					'btntext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'btnlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'videoimage' => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'file' => new \Fieldmanager_Media( 'Video File', array(
							'mime_type'    => 'all',
							'button_label' => esc_html__( 'Select a video', 'fbapac' ),
							'description'  => 'File types: *.mp4',
					) ),	
					'bgimage' => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
				) ),				
				),
			) );
            $fm->add_meta_box( esc_html__( 'Covid19 Section Two', 'fbapac' ), $this->post_type );
            
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionthree",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><strong><ul><li>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'btntext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'btnlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'bgimage' => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),				
				),
			) );
			$fm->add_meta_box( esc_html__( 'Covid19 Section Three', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionfour",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'btntext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'btnlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					
					'bgimage' => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
				) ),				
				),
			) );
			
            $fm->add_meta_box( esc_html__( 'Covid19 Section Four', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionfive",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><strong>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'btntext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'btnlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					
					'bgimage' => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
				) ),				
				),
			) );
            $fm->add_meta_box( esc_html__( 'Covid19 Section Five', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionsix",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
					'boxoneheading'     => new \Fieldmanager_Textfield( esc_html__( 'Box 1 Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),					
					'boxonedescription' => new \Fieldmanager_RichTextArea( esc_html__( 'Box 1 Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><strong><ul><li>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'boxoneimage' => new \Fieldmanager_Media( esc_html__( 'Box 1 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),	
					'boxtwoheading'     => new \Fieldmanager_Textfield( esc_html__( 'Box 2 Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),					
					'boxtwodescription' => new \Fieldmanager_RichTextArea( esc_html__( 'Box 2 Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><strong><ul><li>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'boxtwoimage' => new \Fieldmanager_Media( esc_html__( 'Box 2 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),			
				),
			) );
			$fm->add_meta_box( esc_html__( 'Inovation Section Six', 'fbapac' ), $this->post_type );
		
		
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapacl_fm', $e->getMessage() );
		}

		return true;
	}
}