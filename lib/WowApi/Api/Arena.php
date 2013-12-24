<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Arena extends AbstractProfileApi
{
    protected $fieldsWhitelist = array('members');

    protected $queryWhitelist = array('size', 'fields');

    protected $teamSizes = array('2v2', '3v3', '5v5', 'rbg');

    public function getArenaLadder($size)
    {
        $arenas = $this->get($this->generatePath('leaderboard/:size/', array(
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
