<?php

//call function to remove text area
add_action('admin_init', 'remove_partner_textarea');
function remove_partner_textarea()
{
    remove_post_type_support('cntrspch_partner', 'editor');
}
