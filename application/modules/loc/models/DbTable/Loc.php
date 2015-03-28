<?php

class Loc_Model_DbTable_Loc extends Zend_Db_Table_Abstract {

    protected $_name = 'loc';
    
    
    /**
     * Metoda zwraca liste lokalizacji
     * @param array $search parametry wyszukiwania
     * @return Zend_Db_Table_Rowset
     */
    public function locs($search = array()) {
        $select = $this->select()->setIntegrityCheck(false)
                ->from($this->_name);
        
        /*
         * szukanie adresow w odleglosci 2 km od wskazanego miejsca
         * http://gis.stackexchange.com/questions/31628/find-points-within-a-distance-using-mysql
         */
        if (isset($search['address'])) {
            $ll = My_GoogleMap::latitudeLongitude($search['address']);
            if (isset($ll)) {
                $lat = $ll->lat;
                $lng = $ll->lng;
                $select->columns(array(
                    'distance' => new Zend_Db_Expr(
                                    "6371 * acos (
                                        cos ( radians($lat) )
                                        * cos( radians( lat ) )
                                        * cos( radians( lng ) - radians($lng) )
                                        + sin ( radians($lat) )
                                        * sin( radians( lat ) )
                                      )"
                                    ),
                ));
                $select->having('distance <= 2');
            }
        }
        
        return $this->fetchAll($select);
    }
    
    /**
     * Metoda zwraca dane lokalizacji
     * @param int $id ID lokalizacji
     * @return Zend_Db_Table_Row|null
     */
    public function loc($id) {
        return $this->fetchRow(array('loc_id = ?' => $id));
    }
}
