<?php

namespace Fbiamdigital_Site_Plugin;

class Apacsummit {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/apacsummit';

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
					// 'banner_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
					// 	'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
					// 	'validation_rules' => array(
					// 		'required' => false,
					// 	),
					// ) ),
					'banner_title' => new \Fieldmanager_RichTextArea( esc_html__( 'Sub Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 2 ),
						'validation_rules' => array(
							'required' => true,
						),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<sup><span><a>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Banner', 'fbiamdigital' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "eventbegins",
				'children' => array(
					'evnet_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'evnet_location' => new \Fieldmanager_Textfield( esc_html__( 'Location Text', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Event Begins', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "global_journey",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'journey_bgimage'  => new \Fieldmanager_Media( esc_html__( 'Backgroung Image', 'fbiamdigital' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'journey_subheading' => new \Fieldmanager_Textfield( esc_html__( 'Journey Sub Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'journey' => new \Fieldmanager_Group(  array( esc_html__( 'Journey', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add another journey', 'fbiamdigital' ),				
						'children' => array(
							'year' => new \Fieldmanager_Select( esc_html__( 'Select Year', 'fbiamdigital' ), array(
								'options' => array(
									'2019' => esc_html__( '2019', 'fbiamdigital' ),
									'2020' => esc_html__( '2020', 'fbiamdigital' ),
									'2021' => esc_html__( '2021', 'fbiamdigital' ),
								),
							) ),
							'flag'        => new \Fieldmanager_Media( esc_html__( 'Flag', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
								'description'  => esc_html__( 'Dimensions: 60x60px or 120x120px', 'fbiamdigital' ),
							) ),
							'countryname'     => new \Fieldmanager_Textfield( esc_html__( 'Country', 'fbiamdigital' ), array(
								'attributes'  => array( 'placeholder' => 'India', 'style' => 'width:100%' ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'jdate'     => new \Fieldmanager_Textfield( esc_html__( 'Date', 'fbiamdigital' ), array(
								'attributes'  => array( 'placeholder' => '23rd April', 'style' => 'width:100%' ),
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
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Global Journey', 'fbiamdigital' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "agendaone",
				'children' => array(
					'agenda_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'agenda_subtitle' => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
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
				),
			) );
			$fm->add_meta_box( esc_html__( 'Agenda Day 1', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "agendatwo",
				'children' => array(
					'agenda_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'agenda_subtitle' => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
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
				),
			) );
			$fm->add_meta_box( esc_html__( 'Agenda Day 2', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "community",
				'children' => array(
					'com_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Community', 'fbiamdigital' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "welnote_speakers",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add_welnote_speakers' => new \Fieldmanager_Group(  array( esc_html__( 'Welcome Note Speakers', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Keynote Speakers', 'fbiamdigital' ),				
						'children' => array(
							'pname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pdDesignation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'pimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
							'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink_text' => new \Fieldmanager_Textfield( esc_html__( 'Link Text', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink' => new \Fieldmanager_Textfield( esc_html__( 'Link URL', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Welcome Note Slider', 'fbiamdigital' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "panelist",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add_panelist'          => new \Fieldmanager_Group(  array( esc_html__( 'Panelists', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Panelist', 'fbiamdigital' ),				
						'children' => array(
							'pname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pdDesignation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'pimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
							'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink_text' => new \Fieldmanager_Textfield( esc_html__( 'Link Text', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink' => new \Fieldmanager_Textfield( esc_html__( 'Link URL', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Panelists Day 1', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "panelisttwo",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add_panelisttwo'          => new \Fieldmanager_Group(  array( esc_html__( 'Panelists Two', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Panelist', 'fbiamdigital' ),				
						'children' => array(
							'pname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pdDesignation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'pimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
							'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink_text' => new \Fieldmanager_Textfield( esc_html__( 'Link Text', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink' => new \Fieldmanager_Textfield( esc_html__( 'Link URL', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Panelists Day 2', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "keynote_speakers",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add_keynote_speakers' => new \Fieldmanager_Group(  array( esc_html__( 'Keynote Speakers', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Keynote Speakers', 'fbiamdigital' ),				
						'children' => array(
							'pname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pdDesignation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'pimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
							'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink_text' => new \Fieldmanager_Textfield( esc_html__( 'Link Text', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink' => new \Fieldmanager_Textfield( esc_html__( 'Link URL', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Keynote Speakers', 'fbiamdigital' ), $this->post_type );	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "fireside_speakers",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add_fireside_speakers' => new \Fieldmanager_Group(  array( esc_html__( 'Fireside Chat', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Fireside chat', 'fbiamdigital' ),				
						'children' => array(
							'pname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pdDesignation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'pimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
							'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink_text' => new \Fieldmanager_Textfield( esc_html__( 'Link Text', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink' => new \Fieldmanager_Textfield( esc_html__( 'Link URL', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Fireside chat', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "whatsApp_speakers",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'add_whatsApp_speakers' => new \Fieldmanager_Group(  array( esc_html__( 'WhatsApp Speaker', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add WhatsApp Speaker', 'fbiamdigital' ),				
						'children' => array(
							'pname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pdDesignation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'pimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
							'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink_text' => new \Fieldmanager_Textfield( esc_html__( 'Link Text', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'plink' => new \Fieldmanager_Textfield( esc_html__( 'Link URL', 'fbiamdigital' ), array(
								'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'WhatsApp Speaker', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "partner_journey",
				'children' => array(
					'pj_image'  => new \Fieldmanager_Media( esc_html__( 'Video Image', 'fbiamdigital' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'pj_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'pj_link_text' => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'pj_link' => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'pj_desc' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),			
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><span><b>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Partner journeys', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "lookbackvd",
				'children' => array(
					'look_image'  => new \Fieldmanager_Media( esc_html__( 'Video Image', 'fbiamdigital' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
						'description'  => 'File types: *.jpg',
					) ),
					'look_video' => new \Fieldmanager_Media( 'Video File', array(
						'mime_type'    => 'all',
						'button_label' => esc_html__( 'Select a video', 'fbiamdigital' ),
						'description'  => 'File types: *.mp4',
					) ),
					'look_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'WTD Loolback Section', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "gov_partner",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Section Heading', 'fbiamdigital' ),
							array( 'attributes'       => array('style' => 'width:100%') ) ),
					'add_gov_partner' => new \Fieldmanager_Group(  array( esc_html__( 'Testimonials', 'fbiamdigital' ),					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Partner', 'fbiamdigital' ),				
						'children' => array(
							'pname'        => new \Fieldmanager_Textfield( esc_html__( 'Name', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pdDesignation'     => new \Fieldmanager_Textfield( esc_html__( 'Designation', 'fbiamdigital' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'pcoutry'        => new \Fieldmanager_Textfield( esc_html__( 'Coutry', 'fbiamdigital' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'pimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
							'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Testimonials', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "speakerpagehead",
				'children' => array(
					'evnet_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Heading for Speaker Page', 'fbiamdigital' ), $this->post_type );
			

		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}
}