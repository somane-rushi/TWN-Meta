<?php

namespace Fbapac_Site_Plugin;

class Rediscovethailandnew {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-template/page-rediscovethailandnew';

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
					
					'img' => new \Fieldmanager_Media( esc_html__( 'Banner Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
							
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Banner Image', 'fbapac' ), $this->post_type );
		
		
		
		$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionvideo",
				'children' => array(
				
				'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
					'file' => new \Fieldmanager_Media( 'Video File', array(
							'mime_type'    => 'all',
							'button_label' => esc_html__( 'Select a video', 'fbapac' ),
							'description'  => 'File types: *.mp4',
					) ),	
					'img' => new \Fieldmanager_Media( esc_html__( 'Cover Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
							
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Video section', 'fbapac' ), $this->post_type );
		
		
		
		
		
		
		
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
					'date'     => new \Fieldmanager_Textfield( esc_html__( 'Date', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'venue'     => new \Fieldmanager_Textfield( esc_html__( 'Venue', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					
									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Section Two', 'fbapac' ), $this->post_type );
			
			
			
		
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionthree",
				'children' => array(
					'heading1'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					
					'heading2'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					'heading3'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image3' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					'heading4'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image4' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Section Three', 'fbapac' ), $this->post_type );	
	



	$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionvirtour",
				'children' => array(
				'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title1'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description1' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode1' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),					
				




	'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title2'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description2' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode2' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),

									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Across  Thaiand', 'fbapac' ), $this->post_type );	














	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionnorthernregion",
				'children' => array(
				'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title1'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description1' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode1' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),					
				




	'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title2'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description2' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode2' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),

									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Northern Region', 'fbapac' ), $this->post_type );	
			
	
	$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionnortheasternregion",
				'children' => array(
				'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title1'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description1' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode1' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),					
				




	'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title2'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description2' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode2' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),

									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Northeastern Region', 'fbapac' ), $this->post_type );	
			
			
			
				$fm = new \Fieldmanager_Group( array(
				'name'     => "sectioncentralregion",
				'children' => array(
				'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title1'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description1' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode1' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),					
				




	'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title2'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description2' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode2' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),

									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Central Region', 'fbapac' ), $this->post_type );	
			
			
			
				$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionssouthernregion",
				'children' => array(
				'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title1'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description1' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode1' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),					
				




	'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
			    'title2'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'description2' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					) )	,

                  'barcode2' => new \Fieldmanager_Media( esc_html__( 'Bar Code', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),

									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Southern Region', 'fbapac' ), $this->post_type );	
			


















	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionfour",
				'children' => array(
					
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Main Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
										
					'title1'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subtitle1'     => new \Fieldmanager_Textfield( esc_html__( 'Sub Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'insta1'     => new \Fieldmanager_Textfield( esc_html__( 'Instagram Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					
					'description1' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					
					
					
					'title2'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
						'subtitle2'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					
					'insta2'     => new \Fieldmanager_Textfield( esc_html__( 'Instagram Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
										
					'description2' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					
					
					
					'title3'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
						'subtitle3'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'insta3'     => new \Fieldmanager_Textfield( esc_html__( 'Instagram Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
				'description3' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image3' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					
					
					'title4'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subtitle4'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),	
					'insta4'     => new \Fieldmanager_Textfield( esc_html__( 'Instagram Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
				'description4' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image4' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					
					
					'title5'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'subtitle5'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),	
					'insta5'     => new \Fieldmanager_Textfield( esc_html__( 'Instagram Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				
				'description5' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image5' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					
					
					
					
									
				),
			) );
			$fm->add_meta_box( esc_html__( 'Meet the creators', 'fbapac' ), $this->post_type );	
			
			
			
			
			
			
	$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionfive",
				'children' => array(
					
					'maintitle'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
									
					'maindescription' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					
					
					
					
					
					
					
					
					'title1'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
									
					'description1' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image1' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					'link1'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
										
					
					
					'title2'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
						
					'description2' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image2' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					
					'link2'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
					
					
					
					'title3'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					
					'description3' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image3' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'link3'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
					
					
					
					'title4'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					
					'description4' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
					
					'image4' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'link4'     => new \Fieldmanager_Textfield( esc_html__( 'Video Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
					
							
				),
			) );
			$fm->add_meta_box( esc_html__( 'Behind the Scene', 'fbapac' ), $this->post_type );	
					
			
			
			
			
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionsix",
				'children' => array(
				
				'title'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				'image' => new \Fieldmanager_Media( esc_html__( 'Logo', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
													
										
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
			$fm->add_meta_box( esc_html__( 'Rediscovethailandnew Tech Partner', 'fbapac' ), $this->post_type );
			
			
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sectionseven",
				'children' => array(
				
				'title'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
				
'add_Posts1' => new \Fieldmanager_Group(  array( esc_html__( 'partners', 'fbapac' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Partner', 'fbapac' ),				
						'children' => array(		
										
				'image' => new \Fieldmanager_Media( esc_html__( 'Logo', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),
					'link'     => new \Fieldmanager_Textfield( esc_html__( 'Enter link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
				
),
) ),
	
				
									
				),
			) );
			$fm->add_meta_box( esc_html__( 'OUR PARTNERS', 'fbapac' ), $this->post_type );
			
			
			
	$fm = new \Fieldmanager_Group( array(
				'name'     => "sectioneight",
				'children' => array(
					'title'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
										
					'add_Posts1' => new \Fieldmanager_Group(  array( esc_html__( 'feeds', 'fbapac' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Feedback', 'fbapac' ),				
						'children' => array(
							
						'image1'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbapac' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
														
							'description1'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
						'author'     => new \Fieldmanager_Textfield( esc_html__( 'Posted By', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
						
						
						
						
																
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Feedback', 'fbapac' ), $this->post_type );


			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}
		
		


		return true;
	}
}