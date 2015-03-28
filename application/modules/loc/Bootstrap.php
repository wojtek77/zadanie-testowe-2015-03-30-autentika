<?php

class Loc_Bootstrap extends Zend_Application_Module_Bootstrap {

    protected function _init_autoloader() {
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'basePath' => APPLICATION_PATH,
            'namespace' => '',
        ));
        $resourceLoader->addResourceType('my', '/modules/loc/my', 'Loc_My');
    }
}
