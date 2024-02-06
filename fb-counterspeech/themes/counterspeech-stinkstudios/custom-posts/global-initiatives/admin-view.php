<?php

//call function to remove text area
add_action('admin_init', 'remove_gi_textarea');
function remove_gi_textarea()
{
    remove_post_type_support('cntrspch_gi', 'editor');
}
