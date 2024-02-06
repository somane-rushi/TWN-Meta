<?php

//call function to remove text area
add_action('admin_init', 'remove_campaign_textarea');
function remove_campaign_textarea()
{
    remove_post_type_support('cntrspch_campaign', 'editor');
}
