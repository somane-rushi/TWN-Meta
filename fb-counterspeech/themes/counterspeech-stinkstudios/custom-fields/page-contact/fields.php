<?php

add_action('fm_post_page', function () use ($cf_functions) {
    $thisPage = 'contact-page';
    $cf_functions::hide_editor($thisPage);

    $contactContentSection = new Fieldmanager_Group(array(
        'name' => 'contact_content_blocks',
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
    $contactContentSection->add_meta_box('Contact Page Content Blocks', 'page', 'normal');
    $cf_functions::showOnPage($contactContentSection->name, $thisPage);

    $contactModalContentSection = new Fieldmanager_Group(array(
        'name' => 'contact_modal_content_blocks',
        'label' => 'CTA Modal Fields - site-wide',
        'children' => array(
            'intro_copy' => new Fieldmanager_TextArea('CTA Intro Copy'),
            'button_copy' => new Fieldmanager_TextField('CTA Button Copy'),
            'header' => new Fieldmanager_TextField('Contact Modal Header'),
            'text' => new Fieldmanager_TextArea('Contact Modal Intro Text'),
            'success' => new Fieldmanager_TextArea('Contact Modal Success Message'),
        ),
    ));
    $contactModalContentSection->add_meta_box('Contact Modal Content Blocks', 'page', 'normal');
    $cf_functions::showOnPage($contactModalContentSection->name, $thisPage);

    $contactContactForm = new Fieldmanager_RichTextArea(array(
        'name' => 'contact_contact_form',
        'label' => 'Use this WYSIWYG only in conjunction with the "add form" button and nothing else, it should only contain a shortcode'
    ));
    $contactContactForm->add_meta_box('Contact Form', 'page', 'normal');
    $cf_functions::showOnPage($contactContactForm->name, $thisPage);
});
