<?php
namespace Fbapac_Site_Plugin;
class Builder {
	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-template/page-builder';

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
			$fm = new \Fieldmanager_Group( esc_html__( 'Select a section type', 'fbapacl_fm' ), array(
				'name'           => 'body',
				'starting_count' => 1,
				'limit'          => 0,
				'add_more_label' => esc_html__( 'Add Section', 'fbapacl_fm' ),
				'label_macro'    => array( esc_html__( 'Component: %s', 'fbapacl_fm' ), 'component_type' ),
				'sortable'       => true,
				'collapsible'    => true,
				'group_is_empty' => function ( $values ) {
					return empty( $values['component_type'] );
				},
				'children'       => array(
					'component_type'              => new \Fieldmanager_Select( esc_html__( 'Type', 'fbapacl_fm' ), array(
						'options' => array(
							'banslider'  => esc_html__( 'Banner Slider', 'fbapacl_fm' ),
							'fullsecti'  => esc_html__( 'Full Section with Text and Image', 'fbapacl_fm' ),
							'fullsectt'  => esc_html__( 'Full Section with Text and Title', 'fbapacl_fm' ),
							'fullvd'	 => esc_html__( 'Full Video', 'fbapacl_fm' ),
							'ltiri'    => esc_html__( 'Left Title and Right Text', 'fbapacl_fm' ),
							'ltri'	 => esc_html__( 'Left Text and Right Image', 'fbapacl_fm' ),
							'lirt'     => esc_html__( 'Left Image and Right Text', 'fbapacl_fm' ),
							'liri'     => esc_html__( 'Left Image and Right Image', 'fbapacl_fm' ),
							'tcwf'     => esc_html__( 'Two column with Flip', 'fbapacl_fm' ),
							'pillartwo'     => esc_html__( 'Pillar Two', 'fbapacl_fm' ),
							'pillarthr'     => esc_html__( 'Pillar Three', 'fbapacl_fm' ),
							'pillarfr'     => esc_html__( 'Pillar Four', 'fbapacl_fm' ),
							'slideltri'	 => esc_html__( 'Slider Left Text and Right Image', 'fbapacl_fm' ),
							'carthrimg'	 => esc_html__( 'Carousel with 3 image', 'fbapacl_fm' ),
							'digipartner'	 => esc_html__( 'Digital Partners', 'fbapacl_fm' ),
							'carblog'	 => esc_html__( 'Blog Carousel', 'fbapacl_fm' ),
						),
					) ),
					
					// Banner Slider
					'component_banslider'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'banslider',
						),
						'children'   => array(
							'slide' => new \Fieldmanager_Group( esc_html__( 'Slide', 'fbapacl_fm' ), array(
									'add_more_label' => esc_html__( 'Add another slide', 'fbapacl_fm' ),
									'limit'          => 50,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['vd_banner'] );
									},
									'children'       => array(
										'vimage_banner' => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbapac' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'vd_banner' => new \Fieldmanager_Media( esc_html__( 'Video', 'fbapac' ), array(
												'mime_type'    => 'all',
												'button_label' => esc_html__( 'Select a video', 'fbapac' ),
												'description'  => 'File types: *.mp4',
										) ),
											
											
									),
								)
							),
							
						),
					) ),
					
					// Full Section with Text and Image
					'component_fullsecti'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'fullsecti',
						),
						'children'   => array(
							'title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'subheading' => new \Fieldmanager_RichTextArea( esc_html__( 'Sub Heading', 'fbapac' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( '<br> and <strong> allowed, other elements will be removed on save.', 'fbapac' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><strong>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbapac' ), array(
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
							'buttontext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
							'buttonlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
							'image'   => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapacl_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
							) ),
						),
					) ),
					
					// Full Section with Text and Title Component
					'component_fullsectt'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'fullsectt',
						),
						'children'   => array(
							'bgcolor_fullsectt' => new \Fieldmanager_Select( esc_html__( 'Background Color *', 'fbapacl_fm' ), array(
								'options' => array(
									'white' => esc_html__( 'White', 'fbapacl_fm' ),
									'red' => esc_html__( 'Red', 'fbapacl_fm' ),
									'orange'     => esc_html__( 'Orange', 'fbapacl_fm' ),
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'title_fullsectt' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'desc_fullsectt' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbapac' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbapac' ),
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
					
					// Full Video Component
					'component_fullvd'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'fullvd',
						),
						'children'   => array(
							'videoimage_fullvd' => new \Fieldmanager_Media( esc_html__( 'Video Poster Image', 'fbapac' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
							) ),
							'file_fullvd' => new \Fieldmanager_Media( 'Video File', array(
									'mime_type'    => 'all',
									'button_label' => esc_html__( 'Select a video', 'fbapac' ),
									'description'  => 'File types: *.mp4',
							) ),
							
						),
					) ),
					
					// Left Title and Right Text
					'component_ltiri'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'ltiri',
						),
						'children'   => array(
							'title_ltiri' => new \Fieldmanager_Textfield( esc_html__( 'Left Side Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'desc_ltiri' => new \Fieldmanager_RichTextArea( esc_html__( 'Right Side Content', 'fbapac' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbapac' ),
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
					// Left Text and Right Image
					'component_ltri' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'ltri',
						),
						'children'   => array(
							'bgcolor' => new \Fieldmanager_Select( esc_html__( 'Background Color *', 'fbiamdigital' ), array(
								'options' => array(
									'red' => esc_html__( 'Red', 'fbapacl_fm' ),
									'orange'     => esc_html__( 'Orange', 'fbapacl_fm' ),
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'fontcolor' => new \Fieldmanager_Select( esc_html__( 'Font Color *', 'fbapacl_fm' ), array(
								'options' => array(
									'red' => esc_html__( 'Red', 'fbapacl_fm' ),
									'orange'     => esc_html__( 'Orange', 'fbapacl_fm' ),
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'title_ltri' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'description_ltri' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbapac' ), array(
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
							'btntext_ltri'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
							'btnlink_ltri'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'image_ltri'   => new \Fieldmanager_Media( esc_html__( 'Right Side Image', 'fbapacl_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
							) ),
							'videoimage_ltri' => new \Fieldmanager_Media( esc_html__( 'Right Side Video Poster Image', 'fbapac' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
							) ),
							'file_ltri' => new \Fieldmanager_Media( 'Right Side Video File', array(
									'mime_type'    => 'all',
									'button_label' => esc_html__( 'Select a video', 'fbapac' ),
									'description'  => 'File types: *.mp4',
							) ),
						),
					) ),
					
					// Left Image and Right Text
					'component_lirt' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'lirt',
						),
						'children'   => array(
							'bgcolor' => new \Fieldmanager_Select( esc_html__( 'Background Color', 'fbiamdigital' ), array(
								'options' => array(
									'red' => esc_html__( 'Red', 'fbapacl_fm' ),
									'orange'     => esc_html__( 'Orange', 'fbapacl_fm' ),
								),
							) ),
							'fontcolor' => new \Fieldmanager_Select( esc_html__( 'Font Color', 'fbapacl_fm' ), array(
								'options' => array(
									'red' => esc_html__( 'Red', 'fbapacl_fm' ),
									'orange' => esc_html__( 'Orange', 'fbapacl_fm' ),
								),
							) ),
							'image_lirt'   => new \Fieldmanager_Media( esc_html__( 'Left Side Image', 'fbapacl_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
							) ),
							'videoimage_lirt' => new \Fieldmanager_Media( esc_html__( 'Left Side Video Poster Image', 'fbapac' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
							) ),
							'file_lirt' => new \Fieldmanager_Media( 'Left Side Video File', array(
									'mime_type'    => 'all',
									'button_label' => esc_html__( 'Select a video', 'fbapac' ),
									'description'  => 'File types: *.mp4',
							) ),
							'title_lirt' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'description_lirt' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbapac' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description' => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbapac' ),
								'init_options'    => array(
									'paste_as_text'  => true,
									'valid_elements' => '<br /><p><a><strong>',
								),
								'editor_settings' => array(
									'default_editor' => 'html',
									'media_buttons' => false,
								)
							) ),
							'btntext_ltri'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
							'btnlink_ltri'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
						),
					) ),
					
					// Left Image and Right Image
					'component_liri' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'liri',
						),
						'children'   => array(
							'image_left'   => new \Fieldmanager_Media( esc_html__( 'Left Side Image', 'fbapacl_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
							) ),
							'title_left' => new \Fieldmanager_Textfield( esc_html__( 'Left Side Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'image_right'   => new \Fieldmanager_Media( esc_html__( 'Right Side Image', 'fbapacl_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
							) ),
							'title_right' => new \Fieldmanager_Textfield( esc_html__( 'Right Side Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							
						),
					) ),
					
					// Two column with Flip
					'component_tcwf' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'tcwf',
						),
						'children'   => array(
							'bgcolor' => new \Fieldmanager_Select( esc_html__( 'Background Color *', 'fbapacl_fm' ), array(
								'options' => array(
									'brown' => esc_html__( 'Brown', 'fbapacl_fm' ),
									'orange'     => esc_html__( 'Orange', 'fbapacl_fm' ),
									'darkorange' => esc_html__( 'Dark Orange', 'fbapacl_fm' ),
									'beige'     => esc_html__( 'Beige', 'fbapacl_fm' ),
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'fncolor' => new \Fieldmanager_Select( esc_html__( 'Font Color *', 'fbapacl_fm' ), array(
								'options' => array(
									'brown' => esc_html__( 'Brown', 'fbapacl_fm' ),
									'white'     => esc_html__( 'White', 'fbapacl_fm' ),
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'heading' => new \Fieldmanager_Textfield( esc_html__( 'Section Heading', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'image_left'   => new \Fieldmanager_Media( esc_html__( 'Left Side Image', 'fbapacl_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
							) ),
							'title_left' => new \Fieldmanager_Textfield( esc_html__( 'Left Side Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'desc_left' => new \Fieldmanager_RichTextArea( esc_html__( 'Left Side Content', 'fbapac' ), array(
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
							'bgcolor_right' => new \Fieldmanager_Select( esc_html__( 'Background Color *', 'fbapacl_fm' ), array(
								'options' => array(
									'brown' => esc_html__( 'Brown', 'fbapacl_fm' ),
									'orange'     => esc_html__( 'Orange', 'fbapacl_fm' ),
									'darkorange' => esc_html__( 'Dark Orange', 'fbapacl_fm' ),
									'beige'     => esc_html__( 'Beige', 'fbapacl_fm' ),
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'fncolor_right' => new \Fieldmanager_Select( esc_html__( 'Font Color *', 'fbapacl_fm' ), array(
								'options' => array(
									'brown' => esc_html__( 'Brown', 'fbapacl_fm' ),
									'white'     => esc_html__( 'White', 'fbapacl_fm' ),
								),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'image_right'   => new \Fieldmanager_Media( esc_html__( 'Right Side Image', 'fbapacl_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbapacl_fm' ),
							) ),
							'title_right' => new \Fieldmanager_Textfield( esc_html__( 'Right Side Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'desc_right' => new \Fieldmanager_RichTextArea( esc_html__( 'Right Side Content', 'fbapac' ), array(
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
					) ),
					
					// Pillar Two
					'component_pillartwo' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'pillartwo',
						),
						'children'   => array(
							'p2one' => new \Fieldmanager_Group( esc_html__( 'Pillar One', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),
							'p2two' => new \Fieldmanager_Group( esc_html__( 'Pillar Two', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),							
						),
					) ),
					// Pillar Three
					'component_pillarthr' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'pillarthr',
						),
						'children'   => array(
							'p3one' => new \Fieldmanager_Group( esc_html__( 'Pillar One', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),
							'p3two' => new \Fieldmanager_Group( esc_html__( 'Pillar Two', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),
							'p3thr' => new \Fieldmanager_Group( esc_html__( 'Pillar Three', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),							
						),
					) ),
					
					// Pillar Four
					'component_pillarfr' => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'pillarfr',
						),
						'children'   => array(
							'pone' => new \Fieldmanager_Group( esc_html__( 'Pillar One', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),
							'ptwo' => new \Fieldmanager_Group( esc_html__( 'Pillar Two', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),
							'pthr' => new \Fieldmanager_Group( esc_html__( 'Pillar Three', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),
							'pfr' => new \Fieldmanager_Group( esc_html__( 'Pillar Four', 'fbapacl_fm' ), array(
									'sortable'       => true,
									'collapsible'    => true,
									'children'       => array(
										'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbapac' ), array(
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
										 'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( '<br> <strong> <p> <h3> <ul> <li> <span> allowed, other elements will be removed on save.', 'fbapac' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><strong><p><h3><a><ul><li><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'pillarimage' => new \Fieldmanager_Media( esc_html__( 'Pillar Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										'fullimage' => new \Fieldmanager_Media( esc_html__( 'Full Image', 'fbapac' ), array(
											'mime_type'    => 'image',
											'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
										
									),
								)
							),
							
						),
					) ),
					
					// Slider Left Text and Right Image Component
					'component_slideltri'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 slides', 'fbapacl_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'slideltri',
						),
						'children'    => array(
							'slide_testi' => new \Fieldmanager_Group( esc_html__( 'Slide', 'fbapacl_fm' ), array(
									'add_more_label' => esc_html__( 'Add another slide', 'fbapacl_fm' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['bgimage'] );
									},
									'children'       => array(
										'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'desc' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
								)
							),
						),
					) ),
					
					
					// Carousel with 3 Image Component
					'component_carthrimg'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'slides', 'fbapacl_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'carthrimg',
						),
						'children'    => array(
							'title'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							'slide' => new \Fieldmanager_Group( esc_html__( 'Slide', 'fbapacl_fm' ), array(
									'add_more_label' => esc_html__( 'Add another slide', 'fbapacl_fm' ),
									'limit'          => 50,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['cimage'] );
									},
									'children'       => array(
										'cimage' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
											
											
									),
								)
							),
						),
					) ),
					
					// Digital Partners Component
					'component_digipartner'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'digipartner',
						),
						'children'   => array(
							'title_fullsectt' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbapacl_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'desc_fullsectt' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbapac' ), array(
								'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'description'     => esc_html__( '<br /><p><a><strong> allowed, other elements will be removed on save.', 'fbapac' ),
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
					
					//Blog Carousel
					'component_carblog'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'carblog',
						),
						'children'   => array(
							'bloghead'     => new \Fieldmanager_Textfield( esc_html__( 'Blog Heading', 'fbapac' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
						),
					) ),
					
					
					'component_gallery'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 6 slides', 'fbapacl_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'gallery',
						),
						'children'    => array(
							'slide' => new \Fieldmanager_Group( esc_html__( 'Slide', 'fbapacl_fm' ), array(
									'add_more_label' => esc_html__( 'Add another slide', 'fbapacl_fm' ),
									'limit'          => 6,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['cimage'] );
									},
									'children'       => array(
										'cimage' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbapac' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
										) ),
									),
								)
							),
						),
					) ),
					
					
					
				), // children
			) );
			$fm->add_meta_box( esc_html__( 'Sections', 'fbapacl_fm' ), $this->post_type );
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapacl_fm', $e->getMessage() );
		}

		return true;
	}
}