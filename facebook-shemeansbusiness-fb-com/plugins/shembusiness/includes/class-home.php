<?php

namespace Fbshemeansbusiness_Site_Plugin;

class Home {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/home';

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
				'name'     => "home_content",
				'children' => array(
					'overview_vd'        => new \Fieldmanager_Media( 'Video File', array(
						'mime_type'    => 'video/mp4',
						'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
						'description'  => 'File types: *.mp4',
					) ),
					'wel_heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'wel_btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'wel_btn_link'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_slider",
				'children' => array(
					'sliderblocks'          => new \Fieldmanager_Group(  array( 
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Slide', 'shembusiness' ),	
						'attributes'       => array('style' => 'margin-bottom:50px'),			
						'children' => array(
							'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Slide Type', 'shembusiness' ), array(
								'options' => array(
									'image'       => esc_html__( 'Image', 'shembusiness' ),
									'video'       => esc_html__( 'Video', 'shembusiness' ),
								),
							) ),
							
							'sec_image_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'image',
								),
								'children'   => array(
									'slideimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
										'mime_type'        => 'image',
										'description'      => esc_html__( '', 'shembusiness' ),
										'button_label'     => esc_html__( 'Select an Image', 'shembusiness' ),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									'slide_link' => new \Fieldmanager_Textfield( esc_html__( 'Link', 'shembusiness' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
									
								),
							) ),
							
							'sec_video_fields' => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'video',
								),
								'children'   => array(
									'slidevd'        => new \Fieldmanager_Media( 'Video File', array(
										'mime_type'    => 'video/mp4',
										'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
										'description'  => 'File types: *.mp4',
									) ),
									
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Slider', 'shembusiness' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_two",
				'children' => array(
					'overview_heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'overview_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'overview_description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two - Program Overview', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_thr",
				'children' => array(
					
					'jumbotron'          => new \Fieldmanager_Group(  array( 				
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Video', 'shembusiness' ),				
						'children' => array(
							
							'vd_heading'        => new \Fieldmanager_Textfield( esc_html__( 'Video Title', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'vd_image'  => new \Fieldmanager_Media( esc_html__( 'Poster Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'vd_file'        => new \Fieldmanager_Media( 'Video File', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
								'description'  => 'File types: *.mp4',
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Three - Video Section', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_four",
				'children' => array(
					'filp_circle'          => new \Fieldmanager_Group(  array(					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Box', 'shembusiness' ),				
						'children' => array(
							'flip_image'  => new \Fieldmanager_Media( esc_html__( 'Front Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'flip_backimage'  => new \Fieldmanager_Media( esc_html__( 'Back Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'flip_title'        => new \Fieldmanager_Textfield( esc_html__( 'Popup Title', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'flip_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Popup Description', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Four (Flip Circle)', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_timeline",
				'children' => array(
					'time_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'time_subtitle'        => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'time_bgimage'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
					'add_timeline'          => new \Fieldmanager_Group(  array( 				
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Timeline', 'shembusiness' ),				
						'children' => array(
							'time_year'        => new \Fieldmanager_Textfield( esc_html__( 'Year', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'time_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'time_stitle'        => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'time_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Five (Timeline)', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_six",
				'children' => array(
					'train_heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'train_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'train_description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Six - Digital Marketing Training', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_seven",
				'children' => array(
					'learn_head'        => new \Fieldmanager_Textfield( esc_html__( 'Section Header', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'learn_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'learn_bgimage'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'learn_button'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'learn_blink'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
							
					'add_learnmodule'          => new \Fieldmanager_Group(  array( 					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Module', 'shembusiness' ),				
						'children' => array(
							'lea_icon'  => new \Fieldmanager_Media( esc_html__( 'Icon', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'lea_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'lea_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'lea_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Seven (Learning Modules)', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_eight",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'bgimage'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Eight - Business Resiliency Training', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_nine",
				'children' => array(
					'image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Nine', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "home_sec_ten",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'icon'  => new \Fieldmanager_Media( esc_html__( 'Upload Icon', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'content' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
						'description'     => esc_html__( 'Only newlines allowed, other elements will be removed on save.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><p><a><ul><li><hr><span>',
						),
						'editor_settings' => array(
                            'default_editor' => 'html',
							'media_buttons' => false,
						)
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Ten - Learn About', 'shembusiness' ), $this->post_type );
			

		} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
}