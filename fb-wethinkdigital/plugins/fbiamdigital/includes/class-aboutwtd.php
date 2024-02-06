<?php

namespace Fbiamdigital_Site_Plugin;

class Aboutwtd {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/aboutwtd';

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
							'slider_vd'  => esc_html__( 'Slider with Video', 'fbiamdigital' ),
							'flip_circle'	 => esc_html__( 'Flip Circle', 'fbiamdigital' ),
							'journey'    => esc_html__( 'Global Journey', 'fbiamdigital' ),
							'testimonial'	 => esc_html__( 'Partners Slider', 'fbiamdigital' ),
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
							'title_banner' => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'fbiamdigital' ), array(
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
							
						),
					) ),
					// Slider with Video
					'component_slider_vd'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 slides', 'fbiamdigitall_fm' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'slider_vd',
						),
						'children'    => array(
							'title'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
								array( 'attributes' => array('style' => 'width:100%') )
					 		),
							'slide_slider_vd' => new \Fieldmanager_Group( esc_html__( 'Slide', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add another slide', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['slideimage'] );
									},
									'children'       => array(
										'slideimage' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
										'slidevd' => new \Fieldmanager_Media( esc_html__( 'Video', 'fbiamdigital' ), array(
												'mime_type'    => 'video/mp4',
												'button_label' => esc_html__( 'Select Video', 'fbiamdigital' ),
										) ),
									),
								)
							),
						),
					) ),
					// Flip Circle
					'component_flip_circle'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 slides', 'fbiamdigital' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'flip_circle',
						),
						'children'    => array(
							'slide_flip' => new \Fieldmanager_Group( esc_html__( 'Flip', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add another Flip', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['fimage'] );
									},
									'children'       => array(
										'fimage' => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
										'ftitle' => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'fdesc' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'flinktext'     => new \Fieldmanager_Textfield( esc_html__( 'Link Text', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'fpopuptitle'     => new \Fieldmanager_Textfield( esc_html__( 'Popup Title', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'fpopupdesc' => new \Fieldmanager_RichTextArea( esc_html__( 'Popup Description', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										
									),
								)
							),
						),
					) ),
					
					// Global Journey
					'component_journey'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( '', 'fbiamdigital' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'journey',
						),
						'children'    => array(
							'main_head'     => new \Fieldmanager_Textfield( esc_html__( 'Main Heading', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
							'main_note'     => new \Fieldmanager_Textfield( esc_html__( 'Note', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
							'main_image' => new \Fieldmanager_Media( esc_html__( 'Right Panel Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
							'coun_dt' => new \Fieldmanager_Group( esc_html__( 'Country Detail', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add another Country', 'fbiamdigital' ),
									'limit'          => 200,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['jimage'] );
									},
									'children'       => array(
										'selyear' => new \Fieldmanager_Select( esc_html__( 'Select Year', 'fbiamdigital' ), array(
											'options' => array(
												'2019' => esc_html__( '2019', 'fbiamdigital' ),
												'2020' => esc_html__( '2020', 'fbiamdigital' ),
												'2021' => esc_html__( '2021', 'fbiamdigital' ),
											),
											'validation_rules' => array(
												'required' => true,
											),
										) ),
										'jimage' => new \Fieldmanager_Media( esc_html__( 'Flag Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
										'jname'     => new \Fieldmanager_Textfield( esc_html__( 'Country Name', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										
										'jyear'     => new \Fieldmanager_Textfield( esc_html__( 'Year', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'jdesc' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										
									),
								)
							),
						),
					) ),
					
					
					
					// Partners Slider
					'component_testimonial'    => new \Fieldmanager_Group( array(
						'description' => esc_html__( 'Up to 20 slides', 'fbiamdigital' ),
						'display_if'  => array(
							'src'   => 'component_type',
							'value' => 'testimonial',
						),
						'children'    => array(
							'theading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
							'slide_testi' => new \Fieldmanager_Group( esc_html__( 'Slider', 'fbiamdigital' ), array(
									'add_more_label' => esc_html__( 'Add another Slide', 'fbiamdigital' ),
									'limit'          => 20,
									'sortable'       => true,
									'collapsible'    => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['timage'] );
									},
									'children'       => array(
										'timage' => new \Fieldmanager_Media( esc_html__( 'Flag Image', 'fbiamdigital' ), array(
												'mime_type'    => 'image',
												'button_label' => esc_html__( 'Select JPG', 'fbiamdigital' ),
										) ),
										'ttitle'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'tdesc' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
											'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
											'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
											'init_options'    => array(
												'paste_as_text'  => true,
												'valid_elements' => '<br /><p><a><strong><span>',
											),
											'editor_settings' => array(
												'default_editor' => 'html',
												'media_buttons' => false,
											)
										) ),
										'tname'     => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										'tpos'     => new \Fieldmanager_Textfield( esc_html__( 'Position', 'fbiamdigital' ),
											array( 'attributes'       => array('style' => 'width:100%') ) ),
										
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