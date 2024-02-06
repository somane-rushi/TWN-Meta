<?php

class CNTRSPCH_Video
{
    public function theField($displayVal)
    {
        $theField =  new Fieldmanager_Group(array(
            'name' => 'video',
            'label' => 'VIDEO',
            'extra_elements' => 0,
            'display_if' => isset($displayVal) ? array( // This works on most, but not all field types
                'src'   => 'display_if_triggers', // The name of the field which triggers the hide/show. Must be in the same set of children.
                'value' => $displayVal, // The value which determines if this field should be shown
            ) : null,
            'children' => array(
                'facebook_url' => new Fieldmanager_TextField(array(
                    'label' => 'Paste in the full Facebook URL for the video.'
                )),
                'cover_image' => new Fieldmanager_Media(array(
                    'label' => 'Cover image that overlays the video'
                ))
            ),
        ));
        return $theField;
    }
}
