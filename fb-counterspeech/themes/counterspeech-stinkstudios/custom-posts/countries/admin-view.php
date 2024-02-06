<?php

//call function to remove text area
add_action('admin_init', 'remove_country_textarea');
function remove_country_textarea()
{
    remove_post_type_support('cntrspch_country', 'editor');
}
