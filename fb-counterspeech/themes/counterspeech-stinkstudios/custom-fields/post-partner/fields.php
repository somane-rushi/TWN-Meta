<?php

add_action('fm_post_cntrspch_partner', function () {
    $logo = new Fieldmanager_Media(array(
        'name' => 'partner_logo'
    ));
    $logo->add_meta_box('Partner Logo', 'cntrspch_partner', 'normal');

    $shortDescription = new Fieldmanager_Group(array(
        'name' => 'partner_group_module',
        'label' => '',
        'children' => array(
            'short_description' => new Fieldmanager_Textarea( __('Add a short description', 'counterspeech-stinkstudios'),
                  array(
                    'attributes' => array('style' => 'width:100%')
                  )
            ),
            'short_description_backcolor' => new Fieldmanager_TextField( __('Background Color (#Hex Color)', 'counterspeech-stinkstudios'),
                  array(
                    'attributes' => array('style' => 'width:100%')
                  )
            )
      
        )
    ));

    $shortDescription->add_meta_box('Short Description', 'cntrspch_partner', 'normal');


    $partnerCTALabel = new Fieldmanager_TextField(array(
        'name' => 'partner_cta_label',
        'label' => '',
        'attributes' => array('style' => 'width:100%')
    ));
    $partnerCTALabel->add_meta_box('CTA Label 1', 'cntrspch_partner', 'normal');

    
    $partnerUrl = new Fieldmanager_Link(array(
        'name' => 'partner_url',
        'label' => 'The URL for this partner\'s external page'
    ));
    $partnerUrl->add_meta_box('Partner URL 1', 'cntrspch_partner', 'normal');

    //
    $partnerCTALabel2 = new Fieldmanager_TextField(array(
        'name' => 'partner_cta_label2',
        'label' => '',
        'attributes' => array('style' => 'width:100%')
    ));
    $partnerCTALabel2->add_meta_box('CTA Label 2', 'cntrspch_partner', 'normal');

    
    $partnerUrl2 = new Fieldmanager_Link(array(
        'name' => 'partner_url2',
        'label' => 'The URL for this partner\'s external page'
    ));
    $partnerUrl2->add_meta_box('Partner URL 2', 'cntrspch_partner', 'normal');

    //
    $partnerCTALabel3 = new Fieldmanager_TextField(array(
        'name' => 'partner_cta_label3',
        'label' => '',
        'attributes' => array('style' => 'width:100%')
    ));
    $partnerCTALabel3->add_meta_box('CTA Label 3', 'cntrspch_partner', 'normal');

    
    $partnerUrl3 = new Fieldmanager_Link(array(
        'name' => 'partner_url3',
        'label' => 'The URL for this partner\'s external page'
    ));
    $partnerUrl3->add_meta_box('Partner URL 3', 'cntrspch_partner', 'normal');
});
