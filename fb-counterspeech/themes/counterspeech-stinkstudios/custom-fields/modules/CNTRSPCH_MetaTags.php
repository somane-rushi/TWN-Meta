<?php

class CNTRSPCH_MetaTags
{
    public function theField()
    {
        $theField =  new Fieldmanager_Group(array(
            'name' => 'meta_tags',
            'label' => 'Social Media meta data for this page/post',
            'children' => array(
                'title' => new Fieldmanager_TextField(array(
                    'label' => 'The title of this page on the generated share card'
                )),
                'description' => new Fieldmanager_TextArea(array(
                    'label' => 'The description of the page to be displayed below the title'
                )),
                'image' => new Fieldmanager_Media(array(
                    'label' => 'The image to accompany the share card'
                )),
            ),
        ));
        return $theField;
    }
}
