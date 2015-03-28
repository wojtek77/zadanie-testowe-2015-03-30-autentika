<?php

class Loc_Model_DbTable_Comm extends Zend_Db_Table_Abstract {

    protected $_name = 'comm';
    
    
    /**
     * Metoda zwraca komentarze dla danej lokalizacji
     * @param int $locId    ID lokalizacji
     * @param string $order sortowanie
     * @return Zend_Db_Table_Rowset
     */
    public function comms($locId, $order = 'comm_id DESC') {
        return $this->fetchAll(array('loc_id = ?' => $locId), $order);
    }
}
