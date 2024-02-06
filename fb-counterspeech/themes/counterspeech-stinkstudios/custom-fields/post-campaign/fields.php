<?php

add_action('fm_post_cntrspch_campaign', function () {
    // ------- Relational Fields -------

    $campaignGIParentDataSource = new Fieldmanager_Datasource_Post(array(
        'query_args' => array( 'post_type' => 'cntrspch_gi', 'posts_per_page' => 200 ),
        'use_ajax' => false
    ));

    $campaignGIParent = new Fieldmanager_Select(null, array(
        'name'          => 'campaign_parent_gi',
        'datasource' => $campaignGIParentDataSource,
        'attributes'    => array( 'style' => 'width:100%' )
    ));
    $campaignGIParent->add_meta_box('Parent Initiative', 'cntrspch_campaign', 'side');

    $campaignCountryParentDataSource = new Fieldmanager_Datasource_Post(array(
        'query_args' => array( 'post_type' => 'cntrspch_country', 'posts_per_page' => 200, 'orderby' => 'title', 'order' => 'ASC' ),
        'use_ajax' => false
    ));

    $campaignCountryParent = new Fieldmanager_Select(null, array(
        'name'          => 'campaign_parent_country',
        'datasource' => $campaignCountryParentDataSource,
        'attributes'    => array( 'style' => 'width:100%' )
    ));
    $campaignCountryParent->add_meta_box('Parent Country', 'cntrspch_campaign', 'side');
    // ------- End Relational Fields -------

    $specificLocale = new Fieldmanager_TextField(array(
        'name' => 'campaign_locale',
        'label' => 'Where was the focus of this case study from a city/regional standpoint? Ex: "Weingarten, Germany"',
    ));
    $specificLocale->add_meta_box('Specific location', 'cntrspch_campaign', 'normal');

    $campaignHero = new Fieldmanager_Group(array(
        'name' => 'campaign_image',
        'label' => 'Case Study Image and Caption',
        'children' => array(
            'image' => new Fieldmanager_Media('Image'),
            'caption' => new Fieldmanager_TextField('Caption'),
        ),
    ));
    $campaignHero->add_meta_box('Case Study Image', 'cntrspch_campaign', 'normal');

    $campaignVideo = new Fieldmanager_TextField(array(
        'name' => 'campaign_video',
        'label' => 'Facebook Video Url',
    ));
    $campaignVideo->add_meta_box('Case study video', 'cntrspch_campaign', 'normal');

    $campaignMainText = new Fieldmanager_Group(array(
        'name' => 'campaign_description',
        'label' => 'Content Block',
        'limit' => 0,
        'sortable' => true,
        'collapsible' => true,
        'add_more_label' => 'Add another block',
        'extra_elements' => 0,
        'children' => array(
            'display_if_triggers' => new Fieldmanager_Select(
                'Select the content block type',
                array(
                    'options' => array(
                        'header' => 'Value Statement',
                        'paragraph' => 'Paragraph',
                    )
                )
            ),
            'header' => new Fieldmanager_TextField(array(
                    'label' => 'Value Statement',
                    'display_if' => array(
                        'src' => 'display_if_triggers',
                        'value' => 'header'
                    )
                )
            ),
            'paragraph' => new Fieldmanager_TextArea(array(
                    'label' => 'Paragraph',
                    'display_if' => array(
                        'src' => 'display_if_triggers',
                        'value' => 'paragraph'
                    )
                )
            ),
            )
        )
    );
    $campaignMainText->add_meta_box('Case Study Description', 'cntrspch_campaign', 'normal');


    $campaignMobileCta = new Fieldmanager_TextField(array(
        'name' => 'campaign_mobile_cta_description',
    ));
    $campaignMobileCta->add_meta_box('CTA Lead-In', 'cntrspch_campaign', 'normal');

    $campaignCTA = new Fieldmanager_Group(array(
        'name' => 'campaign_cta',
        'children' => array(
            'cta_copy' => new Fieldmanager_TextField('CTA Button'),
            'cta_link' => new Fieldmanager_Link('CTA Link'),
        )
    ));
    $campaignCTA->add_meta_box('Case Study CTA', 'cntrspch_campaign', 'normal');

    $campaignDataPoints = new Fieldmanager_Group(array(
        'name' => 'campaign_data_points',
        'label' => 'Data Point',
        'sortable' => 'true',
        'limit' => 3,
        'add_more_label' => 'Add another data point',
        'children' => array(
            'data_point' => new Fieldmanager_TextField('Data Point'),
            'data_label' => new Fieldmanager_TextField('Data Label'),
        ),
    ));
    $campaignDataPoints->add_meta_box('Data Points', 'cntrspch_campaign', 'normal');
});
