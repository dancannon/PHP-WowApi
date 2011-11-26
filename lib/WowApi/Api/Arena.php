<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Arena extends AbstractProfileApi
{
    protected $fieldsWhitelist = array('members');

    protected $queryWhitelist = array('size', 'fields');

    protected $teamSizes = array('2v2', '3v3', '4v4');

    public function getArenaLadder($battlegroup, $size, $count = 50)
    {
        $arenas = $this->get($this->generatePath('pvp/arena/:battlegroup/:size/', array(
            'battlegroup' => $battlegroup,
            'size' => $size,
        )));

        return $arenas;
    }

    public function getArenaTeam($realm, $teamSize, $name, $fields = array())
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
