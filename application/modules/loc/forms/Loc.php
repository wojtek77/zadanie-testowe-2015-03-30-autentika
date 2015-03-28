<?php

class Loc_Form_Loc extends Zend_Form {

    public function init() {
        
        $this->addElementPrefixPath('Loc_My_Validate', APPLICATION_PATH.'/modules/loc/my/validate', 'validate');
        
        
        $e = new Zend_Form_Element_Text('name', array(
            'label' => 'Nazwa',
            'required' => true,
            'validators' => array(array('StringLength', false, array('max' => 50))),
            'attribs' => array('size' => 50),
        ));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Textarea('description', array(
            'label' => 'Opis',
            'required' => true,
            'validators' => array(array('StringLength', false, array('max' => 300))),
            'attribs' => array('cols' => 50, 'rows' => 3),
        ));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('address', array(
            'label' => 'Adres',
            'required' => true,
            'validators' => array(array('StringLength', false, array('max' => 50))),
            'attribs' => array('size' => 50),
        ));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('email', array(
            'label' => 'E-mail',
            'required' => true,
            'validators' => array('EmailAddress', array('StringLength', false, array('max' => 50))),
            'attribs' => array('size' => 50),
        ));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('from', array(
            'label' => 'Data "Od"',
            'required' => true,
            'validators' => array(array('Date', false, array()), 'LocDate'),
        ));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('to', array(
            'label' => 'Data "Do"',
            'required' => true,
            'validators' => array(array('Date', false, array()), 'LocDate'),
        ));
        $this->addElement($e);
        
        
        $this->addElement(new Zend_Form_Element_Submit('submit', array('label' => 'Dodaj')));
        
        
        /* ustawienie dla wszystkich elementow filtrow */
        $this->setElementFilters(array('StringTrim'));
    }

}
