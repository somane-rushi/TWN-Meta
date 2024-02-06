<?php
namespace Fbmyanmar_Site_Plugin;
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
			$fm = new \Fieldmanager_Group( esc_html__( 'Select a section type', 'fbmy_fm' ), array(
				'name'           => 'body',
				'starting_count' => 1,
				'limit'          => 0,
				'add_more_label' => esc_html__( 'Add Section', 'fbmy_fm' ),
				'label_macro'    => array( esc_html__( 'Component: %s', 'fbmy_fm' ), 'component_type' ),
				'sortable'       => true,
				'collapsible'    => true,
				'group_is_empty' => function ( $values ) {
					return empty( $values['component_type'] );
				},
				'children'       => array(
					'component_type'              => new \Fieldmanager_Select( esc_html__( 'Type', 'fbmy_fm' ), array(
						'options' => array(
							'banimage'  => esc_html__( 'Banner Image', 'fbmy_fm' ),
							'fullsectxt'  => esc_html__( 'Full Section with Text', 'fbmy_fm' ),
							'ltri'	 => esc_html__( 'Left Text and Right Image', 'fbapacl_fm' ),
							'lirt'     => esc_html__( 'Left Image and Right Text', 'fbapacl_fm' ),
							'homenews'     => esc_html__( 'Home News', 'fbapacl_fm' ),
							
						),
					) ),
					
					// Banner Image
					'component_banimage'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'banimage',
						),
						'children'   => array(
							'image'   => new \Fieldmanager_Media( esc_html__( 'Background Image', 'fbmy_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbmy_fm' ),
							) ),
							'title' => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'fbapac' ), array(
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
					// Full Section with Text
					'component_fullsectxt'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'fullsectxt',
						),
						'children'   => array(
							'content' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbmy_fm' ), array(
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
					// Home News
					'component_homenews'       => new \Fieldmanager_Group( array(
						'display_if' => array(
							'src'   => 'component_type',
							'value' => 'homenews',
						),
						'children'   => array(
							'is_display' => new \Fieldmanager_Select( esc_html__( 'Want To Display News Slider?', 'fbmy_fm' ), array(
								'options' => array(
									'yes'  => esc_html__( 'Yes', 'fbmy_fm' ),
									'no'  => esc_html__( 'No', 'fbmy_fm' ),
								),
							) ),
							'title_blog' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbmy_fm' ), array(
								'validation_rules' => array( 'required' => false, ),
								'attributes' => array('style' => 'width:100%'),
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
							'boxalign' => new \Fieldmanager_Select( esc_html__( 'BOX ALIGNMENT', 'fbmy_fm' ), array(
								'options' => array(
									'homeBoxTop' => esc_html__( 'Top Box', 'fbmy_fm' ),
									'homeBoxLeftImage'     => esc_html__( 'Left Image Box', 'fbmy_fm' ),
									'homeBoxRightImage'     => esc_html__( 'Right Image Box', 'fbmy_fm' ),
									'homeBoxBottom'     => esc_html__( 'Bottom Box ', 'fbmy_fm' ),
								),
							) ),
							'title_ltri' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbmy_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							'description_ltri' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbmy_fm' ), array(
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
							'btntext_ltri'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbmy_fm' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
							'btnlink_ltri'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbmy_fm' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
							'file_ltri' => new \Fieldmanager_Media( 'Right Side Image', array(
									'mime_type'    => 'all',
									'button_label' => esc_html__( 'Select a Image', 'fbmy_fm' ),
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
							'image_lirt'   => new \Fieldmanager_Media( esc_html__( 'Left Side Image', 'fbmy_fm' ), array(
								'mime_type'    => 'image',
								'button_label' => esc_html__( 'Select an image', 'fbmy_fm' ),
							) ),
							'boxalign' => new \Fieldmanager_Select( esc_html__( 'BOX ALIGNMENT', 'fbmy_fm' ), array(
								'options' => array(
									'homeBoxTop' => esc_html__( 'Top Box', 'fbmy_fm' ),
									'homeBoxLeftImage'     => esc_html__( 'Left Image Box', 'fbmy_fm' ),
									'homeBoxRightImage'     => esc_html__( 'Right Image Box', 'fbmy_fm' ),
									'homeBoxBottom'     => esc_html__( 'Bottom Box', 'fbmy_fm' ),
								),
							) ),
							'title_lirt' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'fbmy_fm' ), array(
								'validation_rules' => array(
									'required' => false,
								),
								'attributes'       => array('style' => 'width:100%'),
							) ),
							
							'description_lirt' => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'fbmy_fm' ), array(
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
							'btntext_lirt'     => new \Fieldmanager_Textfield( esc_html__( 'Button Text', 'fbmy_fm' ),
										array( 'attributes'       => array('style' => 'width:100%') ) ),
							'btnlink_lirt'     => new \Fieldmanager_Textfield( esc_html__( 'Button Link', 'fbmy_fm' ),
												array( 'attributes'       => array('style' => 'width:100%') ) ),
						),
					) ),
					
					
					
					
					
				), // children
			) );
			$fm->add_meta_box( esc_html__( 'Sections', 'fbmy_fm' ), $this->post_type );
			
			
		} catch ( \Exception $e ) {
			return new \WP_Error( 'fbmy_fm', $e->getMessage() );
		}

		return true;
	}
}