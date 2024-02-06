<?php

class CNTRSPCH_Map
{
    public function theField($name)
    {
        $theField =  new Fieldmanager_Group(array(
            'name' => $name,
            'label' => 'Map',
            'children' => array(
                'intro_text'         => new Fieldmanager_TextField('Intro Text'),
                'explainer_text'         => new Fieldmanager_TextField('Explainer Text'),
                'mobile_carousel_header' => new Fieldmanager_TextField('Mobile Carousel Header'),
                'mobile_countries' => new Fieldmanager_Zone_Field(array(
                    'label' => 'Choose the countries that should appear on the homepage mobile carousel',
                    'query_args' => array(
                        'post_type' => 'cntrspch_country',
                        'posts_per_page' => 200,
                    )
                )),
            ),
        ));
        return $theField;
    }
}
