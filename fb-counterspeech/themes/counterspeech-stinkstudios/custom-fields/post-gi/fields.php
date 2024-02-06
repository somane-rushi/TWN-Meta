<?php

add_action('fm_post_cntrspch_gi', function () use ($cf_functions) {
   $safe_post_id = intval($_REQUEST['post']);
   
    if (! $safe_post_id) {
        $safe_post_id = 'foobar';
    }

    $globalLocalDesignation = new Fieldmanager_Select(array(
        'name' => 'gi_global_local',
        'label' => 'Is this a global or local initiative',
        'options' => array(
            'local' => 'Local',
            'global' => 'Global'
        ),
    ));
    $globalLocalDesignation->add_meta_box('Global / Local Designation', 'cntrspch_gi', 'side');



    $shortDescription = new Fieldmanager_Textarea(array(
        'name' => 'short_description',
        'label' => 'Add a short description that is displayed when this Initiative is pulled onto the homepage *Not applicable for local initiatives*',
        'attributes' => array('style' => 'width:80%'),
    ));
    $shortDescription->add_meta_box('Homepage Description', 'cntrspch_gi', 'normal');

    $giHomepageImage = new Fieldmanager_Media(array(
        'name' => 'gi_homepage_image',
        'label' => 'Add an image that will be displayed when this initiative is pulled onto the homepage *Not applicable for local initiatives*'
    ));
    $giHomepageImage->add_meta_box('Homepage Image', 'cntrspch_gi', 'normal');

    $giHero = new Fieldmanager_Group(array(
        'name' => 'gi_hero',
        'label' => '',
        'children' => array(
            'caption' => new Fieldmanager_TextField('Hero Text', array('attributes' => array('style' => 'width:100%'))),
            'image' => new Fieldmanager_Media('Hero Image'),
            
        )
    ));
    $giHero->add_meta_box('Hero Image and Caption', 'cntrspch_gi', 'normal');

    $giIntroText = new Fieldmanager_RichTextArea(array(
        'name' => 'intro_text',
        'label' => ''
    ));
    $giIntroText->add_meta_box('Under Hero Section Description', 'cntrspch_gi', 'normal');

    $middleModule = new Fieldmanager_Group(array(
        'name' => 'middle_module',
        'label' => '',
        'children' => array(
            'middle_background_color'       => new Fieldmanager_TextField('Background Color (#Hex Color)'),
            'middle_title' => new Fieldmanager_TextField('Title', array('attributes' => array('style' => 'width:100%'))),
            'middle_desc' => new Fieldmanager_RichTextArea('Description'),
            
        )
    ));
    $middleModule->add_meta_box('Middle Content', 'cntrspch_gi', 'normal');


    //Hero Module
    $twoColumnModule = new Fieldmanager_Group(array(
        'name' => 'two_column_module',
        'label' => '',
        'children' => array(
            'content_col_one' =>  new Fieldmanager_RichTextArea(array(
                'label' => 'Column One'
            )),
            'content_col_two' => new Fieldmanager_RichTextArea(array(
                'label' => 'Column Two'
            ))
        )
    ));
    
    $twoColumnModule->add_meta_box('Two Column Content', 'cntrspch_gi', 'normal');

    $featuredCampaignLabels = new Fieldmanager_TextField(array(
        'name' => 'gi_featured_campaign_label',
        'label' => '',
        'attributes' => array('style' => 'width:100%')
    ));
    $featuredCampaignLabels->add_meta_box('Featured Case Study Label', 'cntrspch_gi', 'normal');


    $featuredCampaigns = new Fieldmanager_Group(array(
        'name' => 'new_featured_campaigns',
        'limit' => 3,
        'sortable' => true,
        'label' => 'New Case Study',
        'label_macro' => array( 'Case Study: %s', 'cp_title' ),
        'add_more_label' => 'Add another Case Study',
        'children' => array(
            'cp_image' => new Fieldmanager_Media( 'Image' ),
            'cp_header_text_color' => new Fieldmanager_Textfield( 'Header Text Color (#Hex)', array('attributes' => array('style' => 'width:100%')) ),
            'cp_header' => new Fieldmanager_Textfield( 'Header', array('attributes' => array('style' => 'width:100%')) ),
            'cp_title' => new Fieldmanager_Textfield( 'Title', array('attributes' => array('style' => 'width:100%')) ),
            'cp_description_left' => new Fieldmanager_RichTextarea('Description Left'),
            'cp_description_right' => new Fieldmanager_RichTextarea('Description Right')
        )
    ));
    
    $featuredCampaigns->add_meta_box('Featured Case Studies', 'cntrspch_gi', 'normal');

    $previousWinners = new Fieldmanager_Group(array(
        'name' => 'three_column_module',
        'label' => 'Winners Block',
        'children' => array(
            'bottom_section_title' => new Fieldmanager_TextField('Section Title', array('attributes' => array('style' => 'width:100%'))),
            'wn_group' => new Fieldmanager_Group(
                array(
                'limit' => 3,
                'sortable' => true,
                'label' => 'New Winners',
                'label_macro' => array( 'Winners: %s', 'wn_title' ),
                'add_more_label' => 'Add another winner',
                'children' => array(
                    'wn_image' => new Fieldmanager_Media( 'Image' ),
                    'wn_title' => new Fieldmanager_Textfield( 'Title', array('attributes' => array('style' => 'width:100%')) ),
                     'wn_url' => new Fieldmanager_Textfield( 'Website URL', array('attributes' => array('style' => 'width:100%')) ),
                    'wn_description' => new Fieldmanager_RichTextarea('Description')
                )
            )
        )
        )
    ));
    
    $previousWinners->add_meta_box('Three Column Block', 'cntrspch_gi', 'normal');


    $giPartnersHeader = new Fieldmanager_TextField(array(
        'name' => 'gi_partners_header',
        'label' => 'The heading just before the "Partners" section *Not applicable for local initiatives*',
    ));
    $giPartnersHeader->add_meta_box('Partners Header', 'cntrspch_gi', 'normal');

    $giPartners = new Fieldmanager_Zone_Field(array(
        'name' => 'gi_partner',
        'label' => 'Add and reorder your partners *Not applicable for local initiatives*',
        'query_args' => array(
            'post_type' => 'cntrspch_partner',
            'posts_per_page' => 50,
        )
    ));
    $giPartners->add_meta_box('Associated Partners', 'cntrspch_gi', 'normal');



    $mediumDescription = new Fieldmanager_Group(array(
        'name' => 'medium_description',
        'label' => 'Add a short description that will be used for this initiative on country pages if a localized description is not added below for that specific country - think of this as a fallback',
        'limit' => 0,
        'sortable' => true,
        'collapsible' => true,
        'add_more_label' => 'Add another paragraph',
        'extra_elements' => 0,
        'children' => array(
            'paragraph' => new Fieldmanager_TextArea(array(
                    'label' => 'Paragraph',
                )
            ),
            )
        )
    );
    $mediumDescription->add_meta_box('Country Feature Description', 'cntrspch_gi', 'normal');


    $giCountryDataSource = new Fieldmanager_Datasource_Post(array(
        'query_args' => array(
            'post_type' => 'cntrspch_country',
            'posts_per_page' => 50,
            ),
        'use_ajax' => false,
    ));

    $giLocalizedDescriptions = new Fieldmanager_Group(array(
        'name' => 'gi_localized_descriptions',
        'label' => 'Provide different descriptions of this initiative depending on the country feature page where it appears',
        'limit' => 0,
        'add_more_label' => 'Add another Country landing description',
        'save_empty' => false,
        'extra_elements' => 0,
        'children' => array(
            'country_localization' => new Fieldmanager_Group(array(
                'children' => array(
                    'country' => new Fieldmanager_Select(array(
                        'datasource' => $giCountryDataSource,
                        'label' => 'What country is this for',
                    )),
                    'description' => new Fieldmanager_Group(array(
                    'limit' => 0,
                    'sortable' => true,
                    'collapsible' => true,
                    'add_more_label' => 'Add another paragraph',
                    'extra_elements' => 0,
                    'children' => array(
                        'paragraph' => new Fieldmanager_TextArea(array(
                            'label' => 'Paragraph',
                            )
                        ),
                        )
                    )
                )
                ),
            )),
        ),
    ));

    $giLocalizedDescriptions->add_meta_box('Country landing description', 'cntrspch_gi', 'normal');
    $cf_functions::clearMeta($giLocalizedDescriptions->name);
});
