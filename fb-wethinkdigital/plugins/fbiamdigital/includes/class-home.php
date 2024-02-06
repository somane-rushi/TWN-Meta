<?php
namespace Fbiamdigital_Site_Plugin;
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
					'name'     => "wtdbanner",
					'children' => array(
						'banner'        => new \Fieldmanager_Media( 'Banner Image', array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select a Image', 'fbiamdigital' ),
							'description'  => 'File types: *.mp4',
						) ),
						'namehead'    => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbiamdigital' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						'nameheadmbl'    => new \Fieldmanager_RichTextArea( esc_html__( 'Heading For Mobile', 'fbiamdigital' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array(
								'required' => false,
							), 
						) ),
						'wel_btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
							'attributes'       => array('style' => 'width:100%'),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						'wel_btn_link'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbiamdigital' ), array(
							'attributes'       => array('style' => 'width:100%'),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						
					),
				) );
			$fm->add_meta_box( esc_html__( 'Banner Section', 'shembusiness' ), $this->post_type );
		
			$fm = new \Fieldmanager_Group( array(
					'name'     => "welcome",
					'children' => array(
						'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						'btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
							'attributes'       => array('style' => 'width:100%'),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						'btn_link'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbiamdigital' ), array(
							'attributes'       => array('style' => 'width:100%'),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						
					),
				) );
			$fm->add_meta_box( esc_html__( 'Welcome Section', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_dc",
				'children' => array(
					'mainheading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'descbot'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description Bottom', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'slide'       => new \Fieldmanager_Group( esc_html__( 'Slide', 'fbiamdigital' ), array(
							'add_more_label' => esc_html__( 'Add another Slide', 'fbiamdigital' ),
							'limit'          => 9,
							'extra_elements' => 0,
							'sortable'       => true,
							'collapsible'    => true,
							'group_is_empty' => function ( $values ) {
								return empty( $values['simage'] );
							},
							'children'       => array(
								'simage'        => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
									'description'  => esc_html__( 'Dimensions: 1400x600px', 'fbiamdigital' ),
								) ),
								'sdesc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
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
			$fm->add_meta_box( esc_html__( 'Digital Citizenship', 'fbiamdigital' ), $this->post_type );
			
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_res",
				'children' => array(
					'mainheading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'btntext'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'btnlink'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'resources'       => new \Fieldmanager_Group( esc_html__( 'Resources', 'fbiamdigital' ), array(
							'add_more_label' => esc_html__( 'Add another Resource', 'fbiamdigital' ),
							'limit'          => 9,
							'extra_elements' => 0,
							'sortable'       => true,
							'collapsible'    => true,
							'group_is_empty' => function ( $values ) {
								return empty( $values['boximage'] ) && empty( $values['heading'] );
							},
							'children'       => array(
								'boximage'        => new \Fieldmanager_Media( esc_html__( 'Image', 'fbiamdigital' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
									'description'  => esc_html__( 'Dimensions: 300x300px', 'fbiamdigital' ),
								) ),
								'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
									'attributes'       => array('style' => 'width:100%'),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
									'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
									'validation_rules' => array(
										'required' => true,
									),
								) ),
								'btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
									'attributes'       => array('style' => 'width:100%'),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								'popheading'        => new \Fieldmanager_Textfield( esc_html__( 'Popup Heading', 'fbiamdigital' ), array(
									'attributes'       => array('style' => 'width:100%'),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								'popdes'    => new \Fieldmanager_RichTextArea( esc_html__( 'Popup Description', 'fbiamdigital' ), array(
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
			$fm->add_meta_box( esc_html__( 'Resources', 'fbiamdigital' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
					'name'     => "quizzes",
					'children' => array( 
						'image'        => new \Fieldmanager_Media( 'Image', array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select a Image', 'fbiamdigital' ),
							'description'  => 'File types: *.mp4',
						) ),
						'qheading'    => new \Fieldmanager_RichTextArea( esc_html__( 'Heading', 'fbiamdigital' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						'desc'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						'btn_text'        => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ), array(
							'attributes'       => array('style' => 'width:100%'),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						'btn_link'        => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbiamdigital' ), array(
							'attributes'       => array('style' => 'width:100%'),
							'validation_rules' => array(
								'required' => false,
							),
						) ),
						
					),
				) );
			$fm->add_meta_box( esc_html__( 'Interactive Quizzes', 'fbiamdigital' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_counter",
				'children' => array(
					'mainheading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'note'        => new \Fieldmanager_Textfield( esc_html__( 'Note', 'fbiamdigital' ), array(
						'attributes'       => array('style' => 'width:100%'),
						'validation_rules' => array(
							'required' => false,
						),
					) ),
					'countbox'       => new \Fieldmanager_Group( esc_html__( 'Counter', 'fbiamdigital' ), array(
							'add_more_label' => esc_html__( 'Add another Item', 'fbiamdigital' ),
							'limit'          => 9,
							'extra_elements' => 0,
							'sortable'       => true,
							'collapsible'    => true,
							'group_is_empty' => function ( $values ) {
								return empty( $values['number'] );
							},
							'children'       => array(
								'boxicon'        => new \Fieldmanager_Media( esc_html__( 'Icon', 'fbiamdigital' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select an Image', 'fbiamdigital' ),
									'description'  => esc_html__( 'Dimensions: 235x320px', 'fbiamdigital' ),
								) ),
								'number'        => new \Fieldmanager_Textfield( esc_html__( 'Numbers', 'fbiamdigital' ), array(
									'attributes'       => array('style' => 'width:100%'),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								'numberpre'        => new \Fieldmanager_Textfield( esc_html__( 'Numbers Prefix', 'fbiamdigital' ), array(
									'attributes'       => array('style' => 'width:100%'),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
								'title'        => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbiamdigital' ), array(
									'attributes'       => array('style' => 'width:100%'),
									'validation_rules' => array(
										'required' => false,
									),
								) ),
										
								
							),
						)
					),
					
				),
			) );
			$fm->add_meta_box( esc_html__( 'Results to Date', 'fbiamdigital' ), $this->post_type );
			

			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}
		
		 
		
		try {
			
			$fm = new \Fieldmanager_Group( array(
					'name'     => "heading",
					'children' => array(
						'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
							'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
							'validation_rules' => array(
								'required' => true,
							),
						) ),
						
					),
				) );
			$fm->add_meta_box( esc_html__( 'Heading', 'fbiamdigital' ), $this->post_type );
			
			
			$fm = new \Fieldmanager_RichTextArea( array(
				'name'             => 'description',
				'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
				'validation_rules' => array(
					'required' => true,
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
			) );
			$fm->add_meta_box( esc_html__( 'Description', 'fbiamdigital' ), $this->post_type );
		
			
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_funfacts",
				'children' => array(
					'heading'        => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'description'    => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'funfacts'       => new \Fieldmanager_Group( esc_html__( 'Fun Fact', 'fbiamdigital' ), array(
							'add_more_label' => esc_html__( 'Add another fun fact', 'fbiamdigital' ),
							'limit'          => 9,
							'extra_elements' => 0,
							'sortable'       => true,
							'collapsible'    => true,
							'group_is_empty' => function ( $values ) {
								// https://github.com/alleyinteractive/wordpress-fieldmanager/issues/688
								return empty( $values['icon'] ) && empty( $values['heading'] ) && empty( $values['description'] );
							},
							'children'       => array(
								'icon'        => new \Fieldmanager_Media( esc_html__( 'Icon', 'fbiamdigital' ), array(
									'mime_type'    => 'image',
									'button_label' => esc_html__( 'Select an icon', 'fbiamdigital' ),
									'description'  => esc_html__( 'Dimensions: 60x60px or 120x120px', 'fbiamdigital' ),
								) ),
								'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ), array(
									'attributes'  => array(
										'placeholder' => '10%'
									)
								) ),
								'description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
									'attributes' => array(
										'size'     => 100,
										'required' => true,
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
								'cite'        => new \Fieldmanager_RichTextArea( esc_html__( 'Cite', 'fbiamdigital' ), array(
									'description'     => esc_html__( 'Only text/links and superscripts allowed, newlines and other elements will be removed on save.', 'fbiamdigital' ),
									'buttons_1'       => array( 'link', 'superscript' ),
									'buttons_2'       => array(),
									'init_options'    => array(
										'paste_as_text'  => true,
										'valid_elements' => 'a[!href|target=_blank],sup',
									),
									'editor_settings' => array(
										'quicktags'     => false,
										'media_buttons' => false,
									),
								) ),
							),
						)
					),
					'cite_reference' => new \Fieldmanager_RichTextArea( esc_html__( 'Cite References', 'fbiamdigital' ), array(
						'description'     => esc_html__( 'Only text/links and superscripts allowed, newlines and other elements will be removed on save.', 'fbiamdigital' ),
						'buttons_1'       => array( 'bold', 'link', 'superscript' ),
						'buttons_2'       => array(),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => 'a[!href|target=_blank],sup,strong,p,br',
						),
						'editor_settings' => array(
							'quicktags'     => false,
							'media_buttons' => false,
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Fun Facts', 'fbiamdigital' ), $this->post_type );


			$datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array( 'post_type' => 'story' ),
				'use_ajax'   => false,
			) );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_stories",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
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
					'featured'    => new \Fieldmanager_Group( esc_html__( 'Featured Stories', 'fbiamdigital' ), array(
						'description'    => esc_html__( 'Display up to 2 featured stories' ),
						'limit'          => 2,
						'add_more_label' => esc_html__( 'Add story', 'fbiamdigital' ),
						'sortable'       => true,
						'collapsible'    => true,
						'children'       => array(
							'post_id' => new \Fieldmanager_Autocomplete( 'Select story', array( 'datasource' => $datasource_post ) ),
						),
					) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Digital Voices', 'fbiamdigital' ), $this->post_type );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_resources",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
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
			$fm->add_meta_box( esc_html__( 'Resources', 'fbiamdigital' ), $this->post_type );

			// VIDEO HIGHTLIGHTS
			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_video_hightlights",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
					'videos' => new \Fieldmanager_Group(esc_html__('Videos', 'fbiamdigital'), [
						'children' => [
							'video' => new \Fieldmanager_Media('Video', ['mime_type' => 'video/mp4']),
							'bg' => new \Fieldmanager_Media(esc_html__('Background', 'fbiamdigital')),
							'title' => new \Fieldmanager_TextField(esc_html__('Title', 'fbiamdigital'))
						],
						'limit' => 3
					])
				),
			) );
			$fm->add_meta_box( esc_html__( 'Video Hightlights', 'fbiamdigital' ), $this->post_type );
			// END VIDEO HIGHTLIGHTS

			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_partners",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
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
			$fm->add_meta_box( esc_html__( 'Partners', 'fbiamdigital' ), $this->post_type );

			$fm = new \Fieldmanager_Group( array(
				'name'     => "section_committee",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
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
			$fm->add_meta_box( esc_html__( 'Committee', 'fbiamdigital' ), $this->post_type );

			$resource_datasource_post = new \Fieldmanager_Datasource_Post( array(
				'query_args' => array(
					'post_type'      => 'resource',
					'post_status'    => 'publish',
					'posts_per_page' => 100,
				),
				'use_ajax'   => true,
			) );
			$fm                       = new \Fieldmanager_Group( array(
				'name'     => "jumbotron",
				'children' => array(
					'jumbotron_bg'          => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbiamdigital' ), array(
						'mime_type'        => 'image',
						'description'      => esc_html__( 'Dimensions: 1024x197px', 'fbiamdigital' ),
						'button_label'     => esc_html__( 'Select an image', 'fbiamdigital' ),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'jumbotron_heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbiamdigital' ) ),
					'jumbotron_description' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
						'buttons_1'        => array( 'bold', 'italic', 'link' ),
						'buttons_2'        => array(),
						'init_options'     => array(
							'paste_as_text' => true,
						),
						'editor_settings'  => array(
							'quicktags'     => false,
							'media_buttons' => false,
						),
						'validation_rules' => array(
							'required' => true,
						),
					) ),
					'jumbotron_resource'    => new \Fieldmanager_Select( esc_html__( 'Link to Resource', 'fbiamdigital' ), array(
						'datasource'  => $resource_datasource_post,
						'first_empty' => true,
					) ),
					'jumbotron_button_text' => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbiamdigital' ) ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Announcement Box', 'fbiamdigital' ), $this->post_type );


		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
		}

		return true;
	}
}