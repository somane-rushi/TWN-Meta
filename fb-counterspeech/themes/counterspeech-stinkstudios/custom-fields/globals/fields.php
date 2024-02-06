<?php

$metaTags = new CNTRSPCH_MetaTags();

add_action('fm_post_page', function () use ($metaTags) {
    $tags = $metaTags->theField();
    $tags->add_meta_box('Meta Tags', 'page', 'normal');
});

add_action('fm_post_cntrspch_country', function () use ($metaTags) {
    $tags = $metaTags->theField();
    $tags->add_meta_box('Meta Tags', 'cntrspch_country', 'normal');
});

add_action('fm_post_cntrspch_gi', function () use ($metaTags) {
    $tags = $metaTags->theField();
    $tags->add_meta_box('Meta Tags', 'cntrspch_gi', 'normal');
});
