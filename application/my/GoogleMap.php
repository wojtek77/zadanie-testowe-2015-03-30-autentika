<?php

/**
 * @author Wojciech Brüggemann <wojtek77@o2.pl>
 */
class My_GoogleMap {
    
    /**
     * Funkcja zwraca szerokosc i dlugosc geograficzna dla danego adresu
     * @param string $address
     * @return stdClass|null
     */
    static public function latitudeLongitude($address) {
        
        /*
         * usuniecie polskich ogonkow
         * bo inaczej nie dziala wyszukiwanie
         */
        $address = My_Coding::removePolishCharactersFromUtf8($address);
        
        $client = new Zend_Http_Client('http://maps.googleapis.com/maps/api/geocode/json');
        $client->setParameterGet('sensor', 'false'); // Do we have a GPS sensor? Probably not on most servers.
        $client->setParameterGet('address', urlencode($address)); // Should now be '1600+Amphitheatre+Parkway,+Mountain+View,+CA'
        
        $response = $client->request('GET'); // We must send our parameters in GET mode, not POST
        if ($response->getStatus() == 200) {
            $body = $response->getBody();
            $body = json_decode($body);
            if (isset($body->results[0])) {
                return $body->results[0]->geometry->location;
            }
        }
        return null;
    }
}
