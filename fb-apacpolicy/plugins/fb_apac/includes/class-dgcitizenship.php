<?php

namespace Fbapac_Site_Plugin;

class Dgcitizenship {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-template/page-dgcitizenship';

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
				'name'     => "sectionone",
				'children' => array(
					
					'videoimage' => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'file' => new \Fieldmanager_Media( 'Video File', array(
							'mime_type'    => 'all',
							'button_label' => esc_html__( 'Select a video', 'fbapac' ),
							'description'  => 'File types: *.mp4',
					) ),				
				),
			) );
			$fm->add_meta_box( esc_html__( 'Dgcitizenship Section One', 'fbapac' ), $this->post_type );
		
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
					
									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Dgcitizenship Section Two', 'fbapac' ), $this->post_type );
			
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
					'image' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Dgcitizenship Section Three', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionfour",
				'children' => array(
					'titlepone' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( '<br> <strong> <p> <span> allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><strong><p><a><span>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'descriptionpone' => new \Fieldmanager_RichTextArea( esc_html__( 'Pillar 1 Description', 'fbapac' ), array(
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
					'pillarimagepone' => new \Fieldmanager_Media( esc_html__( 'Pillar 1 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'fullimagepone' => new \Fieldmanager_Media( esc_html__( 'Full 1 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),		
					'titleptwo' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( '<br> <strong> <p> <span> allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><strong><p><a><span>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'descriptionptwo' => new \Fieldmanager_RichTextArea( esc_html__( 'Pillar 2 Description', 'fbapac' ), array(
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
					'pillarimageptwo' => new \Fieldmanager_Media( esc_html__( 'Pillar 2 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'fullimageptwo' => new \Fieldmanager_Media( esc_html__( 'Full 2 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'titlepthree' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( '<br> <strong> <p> <span> allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><strong><p><a><span>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'descriptionpthree' => new \Fieldmanager_RichTextArea( esc_html__( 'Pillar 3 Description', 'fbapac' ), array(
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
					'pillarimagepthree' => new \Fieldmanager_Media( esc_html__( 'Pillar 3 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'fullimagepthree' => new \Fieldmanager_Media( esc_html__( 'Full 3 Image', 'fbapac' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
                    ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Dgcitizenship Section Four', 'fbapac' ), $this->post_type );
			
			
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
					'videoimage' => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'file' => new \Fieldmanager_Media( 'Video File', array(
							'mime_type'    => 'all',
							'button_label' => esc_html__( 'Select a video', 'fbapac' ),
							'description'  => 'File types: *.mp4',
					) ),				
				),
			) );
            $fm->add_meta_box( esc_html__( 'Dgcitizenship Section Five', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectioneight",
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
					'videoimage' => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'file' => new \Fieldmanager_Media( 'Video File', array(
							'mime_type'    => 'all',
							'button_label' => esc_html__( 'Select a video', 'fbapac' ),
							'description'  => 'File types: *.mp4',
					) ),				
				),
			) );
            $fm->add_meta_box( esc_html__( 'Dgcitizenship Section Six', 'fbapac' ), $this->post_type );
            
            	
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionsix",
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
									
				),
			) );
            $fm->add_meta_box( esc_html__( 'Dgcitizenship Section Seven', 'fbapac' ), $this->post_type );
            
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapacl_fm', $e->getMessage() );
		}
		
		try {
			$fm = new \Fieldmanager_Group( esc_html__( 'Add Slides', 'fbiamdigital' ), array(
				'name'           => 'body',
				'starting_count' => 1,
				'limit'          => 0,
				'add_more_label' => esc_html__( 'Add Slide', 'fbiamdigital' ),
				'label_macro'    => array( esc_html__( 'Component: %s', 'fbiamdigital' ), 'component_type' ),
				'sortable'       => true,
				'collapsible'    => true,
				'children'       => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'component_text_fields' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><strong><span>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					'buttontext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'buttonlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'bgimage' => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Slider', 'fbiamdigital' ), $this->post_type );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}
		
		try {
			$fm = new \Fieldmanager_Group( array(
				'name'     => "quotestitle",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
									array( 'attributes'       => array('style' => 'width:100%') ) ),	
				),
			) );
			$fm->add_meta_box( esc_html__( 'Quotes Title', 'fbapac' ), $this->post_type );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapac_fm', $e->getMessage() );
		}
		
		try {
			$fm = new \Fieldmanager_Group( esc_html__( 'Add Quotes', 'fbiamdigital' ), array(
				'name'           => 'quotes',
				'starting_count' => 1,
				'limit'          => 0,
				'add_more_label' => esc_html__( 'Add Quotes', 'fbiamdigital' ),
				'label_macro'    => array( esc_html__( 'Component: %s', 'fbiamdigital' ), 'component_type' ),
				'sortable'       => true,
				'collapsible'    => true,
				'children'       => array(
					'image' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Quotes', 'fbapac' ), $this->post_type );
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapac_fm', $e->getMessage() );
		}


		return true;
	}
}