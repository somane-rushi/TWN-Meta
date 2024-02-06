<?php

add_action('fm_term_cntrspch_region', function () {
    $fm = new Fieldmanager_TextField(array(
        'name' => 'order',
        'attributes' => array('style' => 'width:40px', 'maxlength' => 2),
    ));
    $fm->add_term_meta_box('Order', 'cntrspch_region');
});
