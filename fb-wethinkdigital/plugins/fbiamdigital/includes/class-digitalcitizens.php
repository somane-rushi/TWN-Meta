<?php

namespace Fbiamdigital_Site_Plugin;

class Digitalcitizens {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/digital_citizens';

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
			$fm = new \Fieldmanager_Group( esc_html__( 'Select a section type', 'fbiamdigital' ), array(
				'name'           => 'body',
				'starting_count' => 1,
				'limit'          => 0,
				'add_more_label' => esc_html__( 'Add Section', 'fbiamdigital' ),
				'label_macro'    => array( esc_html__( 'Component: %s', 'fbiamdigital' ), 'component_type' ),
				'sortable'       => true,
				'collapsible'    => true,
				'group_is_empty' => function ( $values ) {
					return empty( $values['component_type'] );
				},
				'children'       => array(
					'component_type'              => new \Fieldmanager_Select( esc_html__( 'Type', 'fbiamdigital' ), array(
						'options' => array(
							'banner'  => esc_html__( 'Page Banner', 'fbiamdigital' ),
							'fullwidth'  => esc_html__( 'Full Width Section', 'fbiamdigital' ),
							'limgrtxt'	 => esc_html__( 'Left Image Right Text Section', 'fbiamdigital' ),
							'logo'	 => esc_html__( 'Logo Section', 'fbiamdigital' ),
							'videosec'	 => esc_html__( 'Video Section', 'fbiamdigital' ),
							'scarousel'	 => esc_html__( 'Single Carousel Section', 'fbiamdigital' ),
							'scarouselar'=> esc_html__( 'AR Carousel Section', 'fbiamdigital' ),
						),
					) ),
					
					// Page Banner
					'component_banner'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'banner',
						),
						'children'   => array(
							'image_banner'   => new \Fieldmanager_Media( esc_html__( 'Banner Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbiamdigital' ),
							) ),
							'title_banner' => new \Fieldmanager_RichTextArea( esc_html__( 'Title For Desktop', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							'mtitle_banner' => new \Fieldmanager_RichTextArea( esc_html__( 'Title For Mobile', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							'content_banner' => new \Fieldmanager_RichTextArea( esc_html__( 'Content For Desktop', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							'contentm_banner' => new \Fieldmanager_RichTextArea( esc_html__( 'Content For Mobile', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
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
					) ),
					// Full Width
					'component_fullwidth'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'fullwidth',
						),
						'children'   => array(
							'bgfull' => new \Fieldmanager_Select( esc_html__( 'Select Background Color', 'fbiamdigital' ), array(
								'options' => array(
									'white' => esc_html__( 'White', 'fbiamdigital' ),
									'grey' => esc_html__( 'Grey', 'fbiamdigital' ),
								),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'textalignfull' => new \Fieldmanager_Select( esc_html__( 'Select Alignment', 'fbiamdigital' ), array(
								'options' => array(
									'left' => esc_html__( 'Left', 'fbiamdigital' ),
									'center' => esc_html__( 'Center', 'fbiamdigital' ),
								),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'contentfull' => new \Fieldmanager_RichTextArea( esc_html__( 'Content For Desktop', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							
						),
					) ),
					
					// Left Image Right Text Section
					'component_limgrtxt'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'limgrtxt',
						),
						'children'   => array(
							'title_lirt'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							'image_lirt'   => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbiamdigital' ),
							) ),
							'contentlirt' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
								'init_options'    => array(
									'paste_as_text'  => true,
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							
						),
					) ),
					
					// Logo
					'component_logo'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 slides', 'fbiamdigitall_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'logo',
						),
						'children'    => array(
							'titlelogo'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							'slide_slider_vd' => new \Fieldmanager_Group( esc_html__( 'Logo', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add Logos', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['logoimage'] );
									},
									'children'       => array(
										'logotitle'     => new \Fieldmanager_Textfield( esc_html__( 'Logo Title', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'logoimage' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
										'logourl'     => new \Fieldmanager_Textfield( esc_html__( 'Logo URL', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
									),
								)
							),
						),
					) ),
					
					// Video Section Section
					'component_videosec'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 Video', 'fbiamdigitall_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'videosec',
						),
						
							
						'children'    => array(
							'more_videosec' => new \Fieldmanager_Group( esc_html__( 'Videos', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add Video', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['vd_file'] );
									},
									'children'       => array(
										'vtitle'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'content_dv' => new \Fieldmanager_RichTextArea( esc_html__( 'Short Content', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'contentdt_dv' => new \Fieldmanager_RichTextArea( esc_html__( 'Long Content', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'vdimage' => new \Fieldmanager_Media( esc_html__( 'Video Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
										'vd_file' => new \Fieldmanager_Media( 'Video File', array(
											'mime_type'    => 'all',
											'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
											'description'  => 'File types: *.mp4',
										) ),
										
									),
								)
							),

							'vid_download_btn'     => new \Fieldmanager_Textfield( esc_html__( 'Download Button Text', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							'vid_download_link'     => new \Fieldmanager_Textfield( esc_html__( 'Videos Download Button Link', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
						),
						
						

					) ),
					
					// Single Carousel
					'component_scarousel'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 slides', 'fbiamdigitall_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'scarousel',
						),
						'children'    => array(
							'titlesc'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							
							'slide_scarousel' => new \Fieldmanager_Group( esc_html__( 'Carousel', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add Slide', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['scimage'] );
									},
									'children'       => array(
										'contentsc' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'scimage' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
									),
								)
							),
							'tipstorecharge_dwld_btn'     => new \Fieldmanager_Textfield( esc_html__( 'Download Button Text', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),

							'tipstorecharge_dwld_link'     => new \Fieldmanager_Textfield( esc_html__( 'Download Button Link', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
						),
					) ),
					
					//AR carousel
					'component_scarouselar'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 slides', 'fbiamdigitall_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'scarouselar',
						),
						'children'    => array(
							'artitlesc'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							
							'ar_slide_scarousel' => new \Fieldmanager_Group( esc_html__( 'Carousel', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add Slide', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['arscimage'] );
									},
									'children'       => array(
										'arcontentsc' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'arscimage' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
									),
								)
							),
							

							
						),
					) ),
					
					
					
				), // children
			) );
			$fm->add_meta_box( esc_html__( 'Sections', 'fbiamdigital' ), $this->post_type );
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital', $e->getMessage() );
		}
		
		return true;
	}
}