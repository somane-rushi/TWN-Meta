<?php

//call function to remove text area
add_action('admin_init', 'remove_resource_textarea');
function remove_resource_textarea()
{
    remove_post_type_support('cntrspch_resource', 'editor');
}
