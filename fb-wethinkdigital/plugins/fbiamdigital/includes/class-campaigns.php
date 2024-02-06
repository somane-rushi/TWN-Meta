<?php

namespace Fbiamdigital_Site_Plugin;

Class Campaigns{
/**
	 * @var string
	 */
	var $post_type = 'page';

	/**
	 * @var string
	 */
	var $page_template = 'page-templates/campaigns';

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
    
        try{

            $fm = new \Fieldmanager_Group( array(
                'name'     => "banner_section",
					'children' => array(
					'banner_bgimage'  => new \Fieldmanager_Media( esc_html__( 'Backgroung Image', 'fbiamdigital' ), array(
					'mime_type'    => 'image',
					'button_label' => esc_html__( 'Select Image', 'fbiamdigital' ),
					'description'  => 'File types: *.jpg',
                ) ),
               
				
                'banner_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'fbiamdigital' ), array(
					'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 2 ),
					'validation_rules' => array(
						'required' => true,
                	),
					'description'     => esc_html__( 'Only newlines allowed.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
						),
						'editor_settings' => array(
							'default_editor' => 'html',
							'media_buttons' => false,
						)
				   ) ),
           		
				
				'mbanner_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Description For Mobile', 'fbiamdigital' ), array(
					'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 2 ),
					'validation_rules' => array(
						'required' => true,
                	),
					'description'     => esc_html__( 'Only newlines allowed.', 'fbiamdigital' ),
						'init_options'    => array(
							'paste_as_text'  => true,
						),
						'editor_settings' => array(
							'default_editor' => 'html',
							'media_buttons' => false,
						)
				   ) ),
				 
				 ),
           		
            ) );
        $fm->add_meta_box( esc_html__( 'Banner Section', 'fbiamdigital'), $this->post_type );

    $fm = new \Fieldmanager_Group( array(
        'name'     => "campaign",
        'children' => array(
            
            
            'campaign_heading' => new \Fieldmanager_Textfield( esc_html__( 'Title', 'wtd2022' ), array(
                'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
                'init_options'    => array(
                    'paste_as_text'  => true,
                    'valid_elements' => '<br />,class',
                ),
                'editor_settings' => array(
                    'default_editor' => 'html',
                    'media_buttons' => false,
                )
            ) ),
            'Campaign_content' => new \Fieldmanager_RichTextArea( esc_html__( 'Description', 'wtd2022' ), array(
                'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 2 ),
                'editor_settings' => array(
                    'default_editor' => 'html',
                    'media_buttons' => false,
                )
            ) ),
            'add_sec'          => new \Fieldmanager_Group(  array( 
                'description'    => esc_html__( '' ),
                'limit'          => 50,
                'add_more_label' => esc_html__( 'Select Section Type', 'wtd2022' ),	
                'attributes'       => array('style' => 'margin-bottom:50px'),			
                'children' => array(
                    'sec_type'  => new \Fieldmanager_Select( esc_html__( 'Select Section Type', 'wtd2022' ), array(
                        'options' => array(
                            'twocol_iltr'    => esc_html__( 'Image Left Text Right', 'wtd2022' ),
                            'twocol_irtl'    => esc_html__( 'Image Right Text Left', 'wtd2022' ),
                        ),
                    ) ),
                    // Image Right Text Left Component
                    'sec_twocol_irtl_fields'       => new \Fieldmanager_Group( array(
                        'display_if' => array(
                            'src'   => 'sec_type',
                            'value' => 'twocol_irtl',
                        ),
                        'children'   => array(
                            'campaign_left_title'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'wtd2022' ), array(
                                'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
                                'validation_rules' => array(
                                    'required' => true,
                                ),
                            ) ),

                            'campaign_left_text'    => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'wtd2022' ), array(
                                'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
                                'validation_rules' => array(
                                    'required' => true,
                                ),
                            ) ),
                            'campaign_right_thumbnail'          => new \Fieldmanager_Media( esc_html__( 'Image', 'wtd2022' ), array(
                                'mime_type'        => 'image',
                                'description'      => esc_html__( '', 'wtd2022' ),
                                'button_label'     => esc_html__( 'Select an Image', 'wtd2022' ),
                                'validation_rules' => array(
                                    'required' => false,
                                ),
                            ) ),
                            'campaign_lreadmore_btn' => new \Fieldmanager_Textfield( esc_html__( 'Know More text', 'wtd2022' ), array(
                                'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
                            ) ),
                            'campaign_lread_more' => new \Fieldmanager_Textfield( esc_html__( 'Know More Link', 'wtd2022' ), array(
                                'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
                            ) ),
                                    
                        ),
                    ) ),
                    
                    // Image Left Text Right Component
                    'sec_twocol_iltr_fields'       => new \Fieldmanager_Group( array(
                        'display_if' => array(
                            'src'   => 'sec_type',
                            'value' => 'twocol_iltr',
                        ),
                        'children'   => array(
                            'campaign_right_title'    => new \Fieldmanager_RichTextArea( esc_html__( 'Title', 'wtd2022' ), array(
                                'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
                                'validation_rules' => array(
                                    'required' => true,
                                ),
                            ) ),
                            'campaign_left_thumbnail'          => new \Fieldmanager_Media( esc_html__( 'Image', 'wtd2022' ), array(
                                'mime_type'        => 'image',
                                'description'      => esc_html__( '', 'wtd2022' ),
                                'button_label'     => esc_html__( 'Select an Image', 'wtd2022' ),
                                'validation_rules' => array(
                                    'required' => false,
                                ),
                            ) ),
                            'campaign_right_text'    => new \Fieldmanager_RichTextArea( esc_html__( 'Content', 'wtd2022' ), array(
                                'attributes'       => array( 'style' => 'max-width:100%;', 'cols' => 50, 'rows' => 3 ),
                                'validation_rules' => array(
                                    'required' => true,
                                ),
                            ) ),
                            'campaign_rreadmore_btn' => new \Fieldmanager_Textfield( esc_html__( 'Know More text', 'wtd2022' ), array(
                                'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
                            ) ),
                            'campaign_rread_more' => new \Fieldmanager_Textfield( esc_html__( 'Know More Link', 'wtd2022' ), array(
                                'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
                            ) ),
                        ),
                    ) ),
            
                    
                ),
            ) ),
            'campaign_read_more' => new \Fieldmanager_Textfield( esc_html__( 'More campaigns text', 'wtd2022' ), array(
                'attributes' => array( 'style' => 'max-width:100%;width:100%;', 'cols' => 50, 'rows' => 3 ),
            ) ),

        ),

        
    ));
    $fm->add_meta_box( esc_html__( 'Campaigns Section', 'fbiamdigital' ), $this->post_type );





    }
    catch ( \Exception $e ) {
    return new \WP_Error( 'fbiamdigital_fm', $e->getMessage() );
    }

    return true;

}
	
}