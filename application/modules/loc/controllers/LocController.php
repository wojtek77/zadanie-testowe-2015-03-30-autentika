<?php

class Loc_LocController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        
        $form = new Loc_Form_LocSearch();
        if ($form->isValid($_GET)) {
            $address = $form->getElement('address')->getValue();
            $search = array('address' => $address);
        } else {
            $search = array();
        }
        
        $locTable = new Loc_Model_DbTable_Loc();
        $this->view->locs = $locTable->locs($search);
        $this->view->form = $form;
    }

    public function viewAction() {
        
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $locTable = new Loc_Model_DbTable_Loc();
        $loc = $locTable->loc($id);
        if (!isset($loc)) {
            throw new Zend_Controller_Action_Exception('Nie istnieje dana lokalizacja');
        }
        
        $commTable = new Loc_Model_DbTable_Comm();
        
        /* zmiany w bazie danych zwiazane z komentarzami */
        $form = new Loc_Form_Comm();
        if ($request->isPost()) {
            /* dodawanie komentarza */
            if (isset($_POST['comment'])) {
                if ($form->isValid($request->getPost())) {
                    $values = $form->getValues();
                    $values += array('loc_id' => $id);
                    $r = $commTable->insert($values);
                    if ($r) {
                        /* odswiezenie strony aby nie mozna bylo powtornie dodac tych samych danych */
                        $this->_helper->redirector->gotoSimple('view', null, null, array('id' => $id));
                    } else {
                        $this->_helper->FlashMessenger('Błąd dodawania komentarza');
                    }
                }
            /* usuwanie komentarza */
            } elseif(isset($_POST['del'])) {
                $r = $commTable->delete(array('comm_id = ?' => (int)$_POST['del']));
                if ($r) {
                    /* odswiezenie strony aby nie mozna bylo powtornie dodac tych samych danych */
                    $this->_helper->redirector->gotoSimple('view', null, null, array('id' => $id));
                } else {
                    $this->_helper->FlashMessenger('Błąd usuwania komentarza');
                }
            }
        }
        
        $this->view->loc = $loc;
        $this->view->form = $form;
        $this->view->comm = $commTable->comms($id);
    }

    public function addAction() {
        
        $request = $this->getRequest();
        $form = new Loc_Form_Loc();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $values = $form->getValues();
                $ll = My_GoogleMap::latitudeLongitude($values['address']);
                if (isset($ll)) {
                    $values += (array) $ll;
                    $locTable = new Loc_Model_DbTable_Loc();
                    $r = $locTable->insert($values);
                    if ($r) {
                        $link = preg_replace('/add$/', "view/id/$r", $this->view->serverUrl(true));
                        //mail('wojtek77@o2.pl', 'zadanie testowe', "Zapis nowej lokalizacji '{$values['name']}' do bazy $link");
                        $this->_helper->redirector->gotoSimple('index');
                    }
                } else {
                    $this->_helper->FlashMessenger('Problem z uzyskaniem współrzędnych adresu');
                }
            }
        }
        $this->view->form = $form;
    }

}
