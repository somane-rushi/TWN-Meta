<?php

class CNTRSPCH_Hero
{
    public function repeaterWithText($displayVal = null)
    {
        $theField =  new Fieldmanager_Group(
            array(
                'name' => 'hero_repeater_with_text',
                'label' => 'Hero',
                'children' => array(
                    'hero_banner_text' => new Fieldmanager_TextField('Main Hero Text'),
                    'images' => new Fieldmanager_Group(
                        array(
                            'limit' => 5,
                            'sortable' => true,
                            'label' => 'Hero Image and Subtext',
                            'add_more_label' => 'Add another hero image',
                            'collapsible' => true,
                            'children' => array(
                                'hero_image' => new Fieldmanager_Media(
                                    __('Hero Image', 'counterspeech-stinkstudios')
                                ),
                                'hero_subtext' => new Fieldmanager_TextField(
                                    __('Hero Caption', 'counterspeech-stinkstudios'),
                                    array(
                                        'attributes' => array('maxlength' => 140, 'style' => 'width:100%'),
                                    )
                                ),
                            )
                        )
                    )
                ),
            )
        );
        return $theField;
    }

    public function repeaterWithoutText($displayVal = null)
    {
        $theField =  new Fieldmanager_Group(
            array(
                'name' => 'hero_repeater_without_text',
                'limit' => 0,
                'sortable' => true,
                'add_more_label' => 'Add another hero image',
                'label' => 'Image',
                'children' => array(
                    'hero_image' => new Fieldmanager_Media(
                        __('Hero Image', 'counterspeech-stinkstudios')
                    ),
                ),
            )
        );
        return $theField;
    }
}
