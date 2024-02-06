<?php

namespace Fbshemeansbusiness_Site_Plugin;

/**
 * Class Region
 * @package Fbshemeansbusiness_Site_Plugin
 */
class Region {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/regions';
	/**
	 * Testimonials constructor.
	 */
	public function __construct() {
		//add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( "fm_post_{$this->post_type}", array( $this, 'custom_fields' ) );
		//add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
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
				'name'     => "sec_banner",
				'children' => array(
					'overview_vd'        => new \Fieldmanager_Media( 'Video File', array(
						'mime_type'    => 'video/mp4',
						'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
						'description'  => 'File types: *.mp4',
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One Banner', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_slider",
				'children' => array(
					
					'add_slide'          => new \Fieldmanager_Group(  array( 				
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add slide', 'shembusiness' ),				
						'children' => array(
							'slide_image'  => new \Fieldmanager_Media( esc_html__( 'Slider Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'slide_vd'        => new \Fieldmanager_Media( 'Popup Video', array(
								'mime_type'    => 'video/mp4',
								'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
								'description'  => 'File types: *.mp4',
							) ),
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section One Slider', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_tagline",
				'children' => array(
					'wel_heading'    => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
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
				'name'     => "two_content",
				'children' => array(
					'rtitle'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'rsubtitle'     => new \Fieldmanager_Textfield( esc_html__( 'Sub Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'rdesc'        => new \Fieldmanager_TextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two', 'shembusiness' ), $this->post_type );	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "thr_content",
				'children' => array(
					'htitle'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'hbgimage'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
					'add_highlights'          => new \Fieldmanager_Group(  array(					
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Highlight', 'shembusiness' ),				
						'children' => array(
							'high_title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'high_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
							'hig_images'          => new \Fieldmanager_Group(  array(					
								'description'    => esc_html__( '' ),
								'limit'          => 20,
								'add_more_label' => esc_html__( 'Add Images', 'shembusiness' ),				
								'children' => array(
									'himg'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
										'mime_type'    => 'image',
										'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
										'description'  => 'File types: *.jpg, .png',
									) ),
									
								),
							) ),
							
							
							
						),
					) ),
					
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Three Highlights', 'shembusiness' ), $this->post_type );	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "two_col_img",
				'children' => array(
					'title'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'img1link'     => new \Fieldmanager_Textfield( esc_html__( 'Image 1 Link', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image'  => new \Fieldmanager_Media( esc_html__( 'Left side Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'img2link'     => new \Fieldmanager_Textfield( esc_html__( 'Image 2 Link', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image2'  => new \Fieldmanager_Media( esc_html__( 'Right side Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Image Section', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "four_content",
				'children' => array(
					'add_box'          => new \Fieldmanager_Group(  array( 				
						'description'    => esc_html__( '' ),
						'limit'          => 20,
						'add_more_label' => esc_html__( 'Add Box', 'shembusiness' ),				
						'children' => array(
							'box_title'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'box_link'        => new \Fieldmanager_Textfield( esc_html__( 'Link', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'box_image'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
								'attributes'       => array('style' => 'border-bottom: 1px solid #ccc;'),
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Four', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "two_col_irtl",
				'children' => array(
					'title'     => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array( 'required' => false, ),
					) ),
					'btn_text'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'btn_link'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'shembusiness' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Image Right Text Left Side', 'shembusiness' ), $this->post_type );	
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "one_col_text",
				'children' => array(
					'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array( 'required' => false, ),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Text Section', 'shembusiness' ), $this->post_type );	
			
			
			} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
	
	
}

