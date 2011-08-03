<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Arena extends AbstractProfileApi
{    
    protected $fieldsWhitelist = array('members');
    
    public function getArena($name, $realm, $size, $fields = array())
    {
        $this->setFields($fields);
        
        $arena = $this->get($this->generatePath('arena/:realm/:size/:name', array(
            'realm' => $realm,
            'size' => $size,
            'name' => $name,
        )));
        
        return $arena;
    }
}
