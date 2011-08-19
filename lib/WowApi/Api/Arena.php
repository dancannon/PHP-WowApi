<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Arena extends AbstractProfileApi
{
    protected $fieldsWhitelist = array('members');

    protected $queryWhitelist = array('size', 'fields');

    protected $teamSizes = array('2v2', '3v3', '4v4');

    public function getArenas($realm, $teamSize, $size=null)
    {
        if($size) {
            $this->setQueryParam('size', $size);
        }

        $arenas = $this->get($this->generatePath('arena/:realm/:teamSize', array(
            'realm' => $realm,
            'teamSize' => $teamSize,
        )));

        return $arenas;
    }

    public function getArena($name, $realm, $teamSize, $fields = array())
    {
        $this->setFields($fields);

        $arena = $this->get($this->generatePath('arena/:realm/:teamSize/:name', array(
            'realm' => $realm,
            'teamSize' => $teamSize,
            'name' => $name,
        )));

        return $arena;
    }
}
