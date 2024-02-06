<?php

class CNTRSPCH_UnformattedText
{
    public function theFieldWithoutHeader($name)
    {
        $theField =  new Fieldmanager_Group(array(
            'name' => isset($name) ? $name : null,
            'label' => 'Text Block',
            'limit' => 0,
            'add_more_label' => 'Add another paragraph',
            'extra_elements' => 0,
            'collapsible'    => true,
            'children' => array(
                'text'         => new Fieldmanager_TextArea('Paragraph Block'),
            ),
        ));
        return $theField;
    }
    public function theFieldWithHeader($name)
    {
        $theField =  new Fieldmanager_Group(array(
            'name' => isset($name) ? $name : null,
            'label' => 'Text Block',
            'collapsible'    => true,
            'children' => array(
                'heading_text'         => new Fieldmanager_TextField('Heading'),
                'text'         => new Fieldmanager_TextArea('Copy'),
            ),
        ));
        return $theField;
    }
}
