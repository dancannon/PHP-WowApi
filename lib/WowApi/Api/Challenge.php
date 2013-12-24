<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Challenge extends AbstractProfileApi
{

    public function getLadder()
    {
        return $this->get('challenge/region');
    }

    public function getRealmLadder($realm)
    {
        $arena = $this->get($this->generatePath('challenge/:realm', array(
            'realm' => $realm,
        )));

        return $arena;
    }
}
