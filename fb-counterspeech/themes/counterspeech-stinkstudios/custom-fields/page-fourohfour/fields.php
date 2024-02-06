<?php

add_action('fm_post_page', function () use ($cf_functions) {
    $thisPage = '404-page';
    $cf_functions::hide_editor($thisPage);

    $fourOhFourContent = new Fieldmanager_Group(array(
        'name' => 'four_oh_four_content_blocks',
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
    $fourOhFourContent->add_meta_box('404 Page Content', 'page', 'normal');
    $cf_functions::showOnPage($fourOhFourContent->name, $thisPage);

    $fourOhFourCTA = new Fieldmanager_TextField(array(
        'name' => 'four_oh_four_cta',
        'label' => 'The text for the CTA that directs the user back home',
    ));
    $fourOhFourCTA->add_meta_box('404 CTA', 'page', 'normal');
    $cf_functions::showOnPage($fourOhFourCTA->name, $thisPage);
});
