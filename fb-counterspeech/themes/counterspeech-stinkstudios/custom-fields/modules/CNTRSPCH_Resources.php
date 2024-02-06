<?php

class CNTRSPCH_Resources
{
    public function theField($name)
    {
        $theField =  new Fieldmanager_Group(array(
            'name' => $name,
            'label' => 'Resources',
            'children' => array(
                'header_text'       => new Fieldmanager_TextField('Header Text'),
                'section_copy'      => new Fieldmanager_TextField('Section Copy'),
                'resources_cta'     => new Fieldmanager_TextField('Resources CTA Copy'),
                'resources_image'   => new Fieldmanager_Media('Resources Image')
            ),
        ));
        return $theField;
    }
}
