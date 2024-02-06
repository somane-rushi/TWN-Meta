<?php

add_action('fm_post_page', function () use ($cf_functions) {
    $thisPage = 'about-page';
    $cf_functions::hide_editor('about-page');

    $mastHeadImage = new Fieldmanager_Media(array(
        'name' => 'about_masthead_image',
        'label' => 'The image to display as the hero of this page'
    ));
    $mastHeadImage->add_meta_box('Hero Image', 'page', 'normal');
    $cf_functions::showOnPage($mastHeadImage->name, $thisPage);
    
    $mastheadText = new Fieldmanager_TextField(array(
        'name' => 'about_masthead_text',
        'label' => 'The text to display over the Hero image',
    ));
    $mastheadText->add_meta_box('Hero Text', 'page', 'normal');
    $cf_functions::showOnPage($mastheadText->name, $thisPage);

    $mastheadCaption = new Fieldmanager_TextField(array(
        'name' => 'about_masthead_caption',
        'label' => 'The text to display under the hero image',
    ));
    $mastheadCaption->add_meta_box('Hero Caption', 'page', 'normal');
    $cf_functions::showOnPage($mastheadCaption->name, $thisPage);

    $aboutContentSection = new Fieldmanager_Group(array(
        'name' => 'about_content_blocks',
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
                        'header' => 'Header',
                        'paragraph' => 'Paragraph',
                        'image' => 'Image',
                        'list' => 'List',
                        'cta' => 'CTA'
                    )
                )
            ),
            'header' => new Fieldmanager_TextField(array(
                    'label' => 'Header',
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
            'image' => new Fieldmanager_Media(array(
                    'label' => 'Image',
                    'display_if' => array(
                        'src' => 'display_if_triggers',
                        'value' => 'image'
                    )
                )
            ),
            'list' => new Fieldmanager_Group(array(
                    'label' => 'List',
                    'display_if' => array(
                        'src' => 'display_if_triggers',
                        'value' => 'list'
                    ),
                    'extra_elements' => 0,
                    'limit' => 0,
                    'add_more_label' => 'Add a list item',
                    'sortable' => true,
                    'children' => array(
                        'list_item' => new Fieldmanager_TextField('List Item')
                    )
                )
            ),
            'cta' => new Fieldmanager_Group(array(
                    'label' => 'CTA',
                    'display_if' => array(
                        'src' => 'display_if_triggers',
                        'value' => 'cta',
                    ),
                    'limit' => 1,
                    'children' => array(
                        'cta_copy' => new Fieldmanager_TextField('CTA Copy'),
                        'cta_link' => new Fieldmanager_Link('CTA Link'),
                    )
                )
            )
        ),
    ));
    $aboutContentSection->add_meta_box('About Page Content Blocks', 'page', 'normal');
    $cf_functions::showOnPage($aboutContentSection->name, $thisPage);

    $aboutContactModule = new Fieldmanager_Group(array(
        'name' => 'about_contact_module',
        'label' => 'The CTA module at the bottom of the page',
        'children' => array(
            'on_off' => new Fieldmanager_Radios(array(
                'label' => 'Should the Contact CTA display on this page?',
                'default_value' => 'yes',
                'options' => array('yes','no')
            )),
        )
    ));
    $aboutContactModule->add_meta_box('Contact Module', 'page', 'normal');
    $cf_functions::showOnPage($aboutContactModule->name, $thisPage);
});
