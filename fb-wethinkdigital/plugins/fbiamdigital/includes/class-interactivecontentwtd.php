<?php

namespace Fbiamdigital_Site_Plugin;

class Interactivecontentwtd {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/interactivecontentwtd';

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
					'banner_title' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Title', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
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
					'mbanner_title' => new \Fieldmanager_RichTextArea( esc_html__( 'Banner Title For Mobile', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
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
			$fm->add_meta_box( esc_html__( 'Banner', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "videoarchive",
				'children' => array(
					'page_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
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
			) );
			$fm->add_meta_box( esc_html__( 'Video Archive', 'fbiamdigital' ), $this->post_type );
			//Display section
			$fm = new \Fieldmanager_Checkbox( 'Dispaly this Section?', array(
				'name'            => 'dis_sec',
				'checked_value'   => 1,
				'unchecked_value' => 0,
				'default_value'   => 0,
			) );
			$fm->add_meta_box( 'Dispalay Section', $this->post_type, 'side' );

			//Videos
			$fm = new \Fieldmanager_Group( array(
				'name'     => "video_sec",
				'children' => array(
					'Video_heading' => new \Fieldmanager_Textfield( esc_html__( 'Video Section Heading', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),

					'addvdo'       => new \Fieldmanager_Group( esc_html__( 'Add Video', 'fbiamdigital' ), array(
						'add_more_label' => esc_html__( 'Add another Video', 'fbiamdigital' ),
							'limit'          => 9,
							'extra_elements' => 0,
							'sortable'       => true,
							'collapsible'    => true,
							
							'children'       => array(
								'video_url' =>  new \Fieldmanager_TextArea( array(
									'label'       => __( 'Video URL', 'fbsafety' ),
									'description' => __( 'The full video URL.', 'fbsafety' ),
								) ),
								'thumbnail_title' => new \Fieldmanager_Textfield( esc_html__( 'Thumbnail Title', 'fbiamdigital' ), array(
									'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								'Video_thumb' => new \Fieldmanager_Media( esc_html__( 'Video Thumbnail Image', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
									'description'  => 'File types: *.jpg, .png',
								) ),
								'excerpt' => new \Fieldmanager_TextArea( esc_html__( 'Excerpt', 'fbiamdigital' ), array(
									'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								
							),
						)
					),
					
					
					


				),
			) );
			$fm->add_meta_box( esc_html__( 'Videos', 'fbiamdigital' ), $this->post_type );

			//Resource
			$fm = new \Fieldmanager_Group( array(
				'name'     => "res_sec",
				'children' => array(
					'resource_heading' => new \Fieldmanager_Textfield( esc_html__( 'Resource Heading', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),

					'addres'       => new \Fieldmanager_Group( esc_html__( 'Add Resource', 'fbiamdigital' ), array(
						'add_more_label' => esc_html__( 'Add another Resource', 'fbiamdigital' ),
							'limit'          => 9,
							'extra_elements' => 0,
							'sortable'       => true,
							'collapsible'    => true,
							
							'children'   => array(
								'res_title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'wtd2022' ), array(
									'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								) ),
								'res_excerpt'        => new \Fieldmanager_TextArea( esc_html__( 'Excerpt', 'fbiamdigital' ), array(
									'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
									'validation_rules' => array(
										'required' => false,
									),
								) ),

								'res_thumb' => new \Fieldmanager_Media( esc_html__( 'Thumbnail Image', 'fbdigitalscam' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select Image', 'fbdigitalscam' ),
									'description'  => 'File types: *.jpg, .png',
								) ),
								'file' => new \Fieldmanager_Media( array(
									'mime_type'    => 'all',
									'button_label' => esc_html__( 'Select a file', 'fbiamdigital' ),
									'description'  => 'File types: *.pdf, *.ppt, *.zip, *.jpg, *.png',
								) ),
								
								'size' => new \Fieldmanager_Textfield( esc_html__( 'Size', 'fbiamdigital' ), array(
									'description'      => 'File size in bytes',
									'validation_rules' => array(
										'number' => true,
									),
									'attributes'       => array(
										'type'        => 'number',
										'placeholder' => '1024',
									),
								) ),
								'cta_btn_txt' => new \Fieldmanager_Textfield( esc_html__( 'CTA Text', 'wtd2022' ), array(
									'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								) ),
								'typeofcontent_txt' => new \Fieldmanager_Textfield( esc_html__( 'Type of Content', 'wtd2022' ), array(
									'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
								) ),
								
							),
							
						)
					),
					
					
					


				),
			) );
			$fm->add_meta_box( esc_html__( 'Resources', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "faq",
				'children' => array(
					'title' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
						'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'addfaq'       => new \Fieldmanager_Group( esc_html__( 'Add FAQ', 'fbiamdigital' ), array(
						'add_more_label' => esc_html__( 'Add another FAQ', 'fbiamdigital' ),
							'limit'          => 9,
							'extra_elements' => 0,
							'sortable'       => true,
							'collapsible'    => true,
							'group_is_empty' => function ( $values ) {
								return empty( $values['que'] );
							},
							'children'       => array(
								'que' => new \Fieldmanager_Textfield( esc_html__( 'Question', 'fbiamdigital' ), array(
									'attributes'       => array('style' => 'width:100%'),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								'ans' => new \Fieldmanager_RichTextArea( esc_html__( 'Answer', 'fbiamdigital' ), array(
									'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
									'validation_rules' => array(
										'required' => true,
									),
								) ),
								
							),
						)
					),
					
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'FAQ Section', 'fbiamdigital' ), $this->post_type );
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}
}