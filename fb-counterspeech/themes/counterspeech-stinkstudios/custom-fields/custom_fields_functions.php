<?php
class CNTRSPCH_CF_Functions
{
    public static function showOnPage($fieldName, $templateName)
    {
        add_action('add_meta_boxes', function () use ($fieldName, $templateName) {
            global $post;
            $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
            $fullTemplateName = 'page-templates/' . $templateName . '.php';
            if ($pageTemplate !==  $fullTemplateName) {
                remove_meta_box('fm_meta_box_' . $fieldName, 'page', 'normal');
            }
        });
    }
    // this clears the meta field before the new one is saved or else fieldmanager ends up sort of confusingly merging the two with a ton of empty fields
    public static function clearMeta($fieldName)
    {
        add_action('save_post', function () use ($fieldName) {
            global $post;
            $theId = $post->ID;
            delete_post_meta($theId, $fieldName);
        }, 1);
    }

    public static function hide_editor($templateName)
    {
        add_action('add_meta_boxes', function () use ($templateName) {
            global $post;
            $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
            $fullTemplateName = 'page-templates/' . $templateName . '.php';
            if ($pageTemplate === $fullTemplateName) {
                remove_post_type_support('page', 'editor');
            }
        });
    }
}
