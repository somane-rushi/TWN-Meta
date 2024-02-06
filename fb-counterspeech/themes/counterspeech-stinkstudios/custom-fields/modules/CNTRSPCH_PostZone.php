<?php

class CNTRSPCH_PostZone
{
    public function theField($name, $label, $post_type)
    {
        $theField =  new Fieldmanager_Zone_Field(array(
            'name' => $name,
            'label' => $label,
            'query_args' => array(
                'post_type' => $post_type,
                'posts_per_page' => 200,
                'meta_key' => 'gi_global_local',
                'meta_value' => 'global'
            )
        ));
        return $theField;
    }
}
