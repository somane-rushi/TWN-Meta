<?php

class CNTRSPCH_Url
{
    public function theField($displayVal)
    {
        $theField =  new Fieldmanager_Group(array(
            'label' => 'URL',
            'collapsible'    => true,
            'children' => array(
                'url'         => new Fieldmanager_Link(),
            ),
            'display_if' => isset($displayVal) ? array( // This works on most, but not all field types
                'src'   => 'display_if_triggers', // The name of the field which triggers the hide/show. Must be in the same set of children.
                'value' => $displayVal, // The value which determines if this field should be shown
            ) : null,
        ));
        return $theField;
    }
}
