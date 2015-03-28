<?php

class Loc_Form_Comm extends Zend_Form {

    public function init() {
        
        $e = new Zend_Form_Element_Textarea('comment', array(
            'label' => 'Komentarz',
            'required' => true,
            'validators' => array(array('StringLength', false, array('max' => 300))),
            'attribs' => array('cols' => 50, 'rows' => 3),
        ));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('email', array(
            'label' => 'E-mail',
            'required' => true,
            'validators' => array('EmailAddress', array('StringLength', false, array('max' => 50))),
            'attribs' => array('size' => 50),
        ));
        $this->addElement($e);
        
        $this->addElement(new Zend_Form_Element_Submit('submit', array('label' => 'Dodaj')));
        
        
        /* ustawienie dla wszystkich elementow filtrow */
        $this->setElementFilters(array('StringTrim'));
    }
    
}
