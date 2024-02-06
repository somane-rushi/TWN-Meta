<?php

add_action('fm_post_cntrspch_resource', function () {
    $showOnResourcePage = new Fieldmanager_Radios(array(
        'name' => 'resource_display_on_resources',
        'label' => 'Should this Resource display on the "Resources" index page',
        'options' => array( 'no', 'yes' ),
        'default_value' => 'yes',
    ));
    $showOnResourcePage->add_meta_box('Resource Display Toggle', 'cntrspch_resource', 'normal');

    $resourceType = new Fieldmanager_Radios(array(
        'name' => 'resource_type',
        'label' => 'What category does this resource fall under?',
        'options' => array(
            'resource' => 'Guide',
            'research' => 'Research',
            'toolkits' => 'Toolkits',
        )
    ));
    $resourceType->add_meta_box('Resource Type', 'cntrspch_resource', 'normal');

    $shortDescription = new Fieldmanager_Textarea(array(
        'name' => 'short_description',
        'label' => 'Add a short description',
        'attributes' => array('style' => 'width:80%; height:200px;'),
    ));
    $shortDescription->add_meta_box('Short Description', 'cntrspch_resource', 'normal');

    $languagesDataSource = get_terms(array(
        'taxonomy' => 'cntrspch_resource_language',
        'hide_empty' => false,
    ));
    
    $resourceUploads = new Fieldmanager_Group(array(
        'name' => 'resource_uploads',
        'label' => 'Resource Uploads',
        'add_more_label' => 'Add another file',
        'limit' => 0,
        'children' => array(
            'lang_options' => new Fieldmanager_Select(array(
                'label' => 'What language is this resource in?',
                'options' => array_map(function ($term) {
                    return array($term->name => $term->slug);
                }, $languagesDataSource),
            )),
            'resource_file' => new Fieldmanager_Media(array(
                'label' => 'Upload the file',
            )),
            'resource_website_link' => new Fieldmanager_TextField(array(
                'label' => 'Website URL',
            )),
        ),
    ));
    
    $resourceUploads->add_meta_box('Uploaded Resources', 'cntrspch_resource', 'normal');
});

// remove standard region metabox since we're replacing it above
add_action('admin_menu', function () {
    remove_meta_box('tagsdiv-cntrspch_resource_language', 'cntrspch_country', 'side');
});
