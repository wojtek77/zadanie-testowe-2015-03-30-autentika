<?php

class Loc_Form_LocSearch extends Zend_Form {

    public function init() {
        
        $e = new Zend_Form_Element_Text('address', array(
            'label' => 'Podaj adres',
            'required' => true,
            'validators' => array(array('StringLength', false, array('max' => 50))),
            'attribs' => array('size' => 50),
            'decorators' => array('ViewHelper', 'Label'),
        ));
        $this->addElement($e);
        
        
        /* ustawienie dla wszystkich elementow filtrow */
        $this->setElementFilters(array('StringTrim'));
    }

}
