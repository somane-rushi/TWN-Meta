<?php

namespace Fbshemeansbusiness_Site_Plugin;

class Traininghub {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/traininghub';

	/**
	 * Page constructor.
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
					'banbgimage'  => new \Fieldmanager_Media( esc_html__( 'Background Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'bantitle' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'banimage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Banner Image', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "sec_two",
				'children' => array(
					'sec_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Section Two', 'shembusiness' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "learnbox",
				'children' => array(
					'head'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
					'add_learnbox'          => new \Fieldmanager_Group(  array( 				
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
							'box_image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg, .png',
							) ),
							'box_link'        => new \Fieldmanager_Textfield( esc_html__( 'Link', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							'box_desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;width:100%', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
							
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Boxes', 'shembusiness' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "train",
				'children' => array(
					'capblocks'          => new \Fieldmanager_Group(  array( 
						'description'    => esc_html__( '' ),
						'limit'          => 50,
						'add_more_label' => esc_html__( 'Add Capsules', 'shembusiness' ),
						'attributes'       => array('style' => 'margin-bottom:50px'),			
						'children' => array(
							'title'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'shembusiness' ), array(
								'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
								'validation_rules' => array(
									'required' => true,
								),
							) ),
							'timage'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
								'description'  => 'File types: *.jpg',
							) ),
							'buttontext' => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'shembusiness' ), array(
								'attributes'       => array('style' => 'width:100%'),
								'validation_rules' => array(
									'required' => false,
								),
							) ),
						
							'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Type', 'shembusiness' ), array(
								'options' => array(
									'view'       => esc_html__( 'Vedio', 'shembusiness' ),
									'download'   => esc_html__( 'Download', 'shembusiness' ),
									'navigate'   => esc_html__( 'Navigate Link', 'shembusiness' ),
								),
							) ),
							
							'sec_view_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'view',
								),
								'children'   => array(
									'view_vd'        => new \Fieldmanager_Media( 'Video File', array(
										'mime_type'    => 'video/mp4',
										'button_label' => esc_html__( 'Select a video', 'shembusiness' ),
										'description'  => 'File types: *.mp4',
									) ),
								),
							) ),
							'sec_download_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'download',
								),
								'children'   => array(
									'downloadlink'        => new \Fieldmanager_Media( 'Download File', array(
										'mime_type'    => 'all',
										'button_label' => esc_html__( 'Select a File', 'shembusiness' ),
										'description'  => '',
									) ),
								),
							) ),
							'sec_link_fields'       => new \Fieldmanager_Group( array(
								'display_if' => array(
									'src'   => 'sec_type',
									'value' => 'navigate',
								),
								'children'   => array(
									'linkn'        => new \Fieldmanager_Textfield( esc_html__( 'Navigate Link', 'shembusiness' ), array(
										'attributes'       => array('style' => 'width:100%'),
										'validation_rules' => array(
											'required' => false,
										),
									) ),
								),
							) ),
							
						),
					) ),
					
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Training Capsules', 'shembusiness' ), $this->post_type );
			
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "partners",
				'children' => array(
					'title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'shembusiness' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'image'  => new \Fieldmanager_Media( esc_html__( 'Image', 'shembusiness' ), array(
						'mime_type'    => 'image',
						'button_label' => esc_html__( 'Select Image', 'shembusiness' ),
						'description'  => 'File types: *.jpg, .png',
					) ),
					'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'shembusiness' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Training sessions with local partners', 'shembusiness' ), $this->post_type );
			
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'shembusiness_fm', $e->getMessage() );
		}

		return true;
	}
}