<?php

class CNTRSPCH_Initiatives
{
    public function theField($displayVal)
    {
        $theField =  new Fieldmanager_Group(array(
            'label' => 'Initiatives',
            'description' => 'All Global Initiatives will be displayed in this block',
        ));
        return $theField;
    }
}
