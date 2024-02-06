<?php

namespace Fbapac_Site_Plugin;

class Home {

	/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-template/page-thailand';

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
				'name'     => "sectionfirst",
				'children' => array(
					'heading'     => new \Fieldmanager_Textfield( esc_html__( 'Heading', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
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
					'buttontext'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'buttonlink'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbapac' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
					'bgimage' => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbapac' ), array(
							'mime_type'    => 'image',
							'button_label' => esc_html__( 'Select JPG', 'fbapac' ),
					) ),				
				),
			) );
			$fm->add_meta_box( esc_html__( 'Thailand Section One', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "pillarone",
				'children' => array(
					 'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
			) );
			$fm->add_meta_box( esc_html__( 'Pillar One', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "pillartwo",
				'children' => array(
					'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
			) );
			$fm->add_meta_box( esc_html__( 'Pillar Two', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "pillarthree",
				'children' => array(
					'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
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
			) );
			$fm->add_meta_box( esc_html__( 'Pillar Three', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "pillarfour",
				'children' => array(
					'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbapac' ), array(
						'attributes' => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
						'description'     => esc_html__( '<br> <strong> <p> <span> allowed, other elements will be removed on save.', 'fbapac' ),
						'init_options'    => array(
							'paste_as_text'  => true,
							'valid_elements' => '<br /><strong><p><span>',
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
			) );
			$fm->add_meta_box( esc_html__( 'Pillar Four', 'fbapac' ), $this->post_type );
			
			$fm = new \Fieldmanager_Group( array(
				'name'     => "bloghome",
				'children' => array(
					'bloghead'     => new \Fieldmanager_Textfield( esc_html__( 'Blog Heading', 'fbapac' ),
									array( 'attributes' => array('style' => 'width:100%') )
					 ),
				),
			) );
			$fm->add_meta_box( esc_html__( 'Blog Section', 'fbapac' ), $this->post_type );
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbapacl_fm', $e->getMessage() );
		}

		return true;
	}
}