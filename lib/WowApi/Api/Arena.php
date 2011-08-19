<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Arena extends AbstractProfileApi
{    
    protected $fieldsWhitelist = array('members');
    
    public function getArena($name, $realm, $size, $fields = array())
    {
        $this->setFields($fields);
        
        $arena = $this->get($this->generatePath('/pvp/arena/:realm/:size/:name', array(
            'realm' => $realm,
            'size' => $size,
            'name' => $name,
        )));
        
        return $arena;
    }
    
    public function getArenaLadder($battlegroup, $size, $count = 50)
    {
        /**
         * @todo Add support for the count field, it caps at 2000
         */
        $arena = $this->get($this->generatePath('/pvp/arena/:battlegroup/:size/', array(
            'battlegroup' => $battlegroup,
            'size' => $size,
        )));
        
        return $arena;
    }
}
