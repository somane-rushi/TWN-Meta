<?php

add_action('fm_post_page', function () use ($cf_functions) {
    $thisPage = 'resources-page';
    $cf_functions::hide_editor('resources-page');

    $mastHeadImage = new Fieldmanager_Media(array(
        'name' => 'resource_masthead_image',
        'label' => 'The image to display as the hero of this page'
    ));
    $mastHeadImage->add_meta_box('Hero Image', 'page', 'normal');
    $cf_functions::showOnPage($mastHeadImage->name, $thisPage);
    
    $mastheadText = new Fieldmanager_TextField(array(
        'name' => 'resource_masthead_text',
        'label' => 'The text to display over the Hero image',
    ));
    $mastheadText->add_meta_box('Hero Text', 'page', 'normal');
    $cf_functions::showOnPage($mastheadText->name, $thisPage);

    $mastheadCaption = new Fieldmanager_TextField(array(
        'name' => 'resource_masthead_caption',
        'label' => 'The text to display under the hero image',
    ));
    $mastheadCaption->add_meta_box('Hero Caption', 'page', 'normal');
    $cf_functions::showOnPage($mastheadCaption->name, $thisPage);

    $resourceIntroText = new Fieldmanager_TextArea(array(
        'name' => 'resources_intro_text',
        'label' => 'The intro text to display just below the hero'
    ));
    $resourceIntroText->add_meta_box('Resource Page intro text', 'page', 'normal');
    $cf_functions::showOnPage($resourceIntroText->name, $thisPage);

    $resourceSectionTitle = new Fieldmanager_TextField(array(
        'name' => 'resource_section_title',
        'label' => 'The header for the "Guide" section'
    ));
    $resourceSectionTitle->add_meta_box('Guide Section Title', 'page', 'normal');
    $cf_functions::showOnPage($resourceSectionTitle->name, $thisPage);

    $guideSectionBgcolor = new Fieldmanager_TextField(array(
        'name' => 'guide_section_bgcolor',
        'label' => 'Background Color (#Hex Color)'
    ));
    $guideSectionBgcolor->add_meta_box('Guide Background Color', 'page', 'normal');
    $cf_functions::showOnPage($guideSectionBgcolor->name, $thisPage);

    /*
    $resourceSectionContent = new Fieldmanager_Group(array(
        'name' => 'resource_section_content_blocks',
        'label' => 'Content Block',
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
        ),
    ));
    $resourceSectionContent->add_meta_box('Resource Section Content', 'page', 'normal');
    $cf_functions::showOnPage($resourceSectionContent->name, $thisPage);
    */

    $researchSectionTitle = new Fieldmanager_TextField(array(
        'name' => 'research_section_title',
        'label' => 'The header for the "Research" section'
    ));
    $researchSectionTitle->add_meta_box('Research Section Title', 'page', 'normal');
    $cf_functions::showOnPage($researchSectionTitle->name, $thisPage);

    $researchSectionBgcolor = new Fieldmanager_TextField(array(
        'name' => 'research_section_bgcolor',
        'label' => 'Background Color (#Hex Color)'
    ));
    $researchSectionBgcolor->add_meta_box('Research Background Color', 'page', 'normal');
    $cf_functions::showOnPage($researchSectionBgcolor->name, $thisPage);

    /*
    $researchSectionContent = new Fieldmanager_Group(array(
        'name' => 'research_section_content_blocks',
        'label' => 'Content Block',
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
        ),
    ));
    $researchSectionContent->add_meta_box('Research Section Content', 'page', 'normal');
    $cf_functions::showOnPage($researchSectionContent->name, $thisPage);
    */

    $toolkitSectionTitle = new Fieldmanager_TextField(array(
        'name' => 'toolkits_section_title',
        'label' => 'The header for the "Toolkits" section'
    ));
    $toolkitSectionTitle->add_meta_box('Toolkits Section Title', 'page', 'normal');
    $cf_functions::showOnPage($toolkitSectionTitle->name, $thisPage);

    $toolkitSectionBgcolor = new Fieldmanager_TextField(array(
        'name' => 'toolkits_section_bgcolor',
        'label' => 'Background Color (#Hex Color)'
    ));
    $toolkitSectionBgcolor->add_meta_box('Toolkits Background Color', 'page', 'normal');
    $cf_functions::showOnPage($toolkitSectionBgcolor->name, $thisPage);

    $downloadCTA = new Fieldmanager_TextField(array(
        'name' => 'download_cta',
        'label' => 'The copy for resource/research download CTAs'
    ));
    $downloadCTA->add_meta_box('Download(s) CTA', 'page', 'normal');
    $cf_functions::showOnPage($downloadCTA->name, $thisPage);

    $resourcesContactModule = new Fieldmanager_Group(array(
        'name' => 'resources_contact_module',
        'label' => 'The CTA module at the bottom of the page',
        'children' => array(
            'on_off' => new Fieldmanager_Radios(array(
                'label' => 'Should the Contact CTA display on this page?',
                'default_value' => 'yes',
                'options' => array('yes','no')
            )),
        )
    ));
    $resourcesContactModule->add_meta_box('Contact Module', 'page', 'normal');
    $cf_functions::showOnPage($resourcesContactModule->name, $thisPage);
});
