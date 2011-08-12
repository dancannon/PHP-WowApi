<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Character extends AbstractProfileApi
{
    protected $fieldsWhitelist = array('guild', 'stats', 'talents', 'items', 'reputation', 'titles', 'professions', 'appearance', 'companions', 'mounts', 'pets', 'achievements', 'progression', 'pvp');

    public function getCharacter($realm, $character, $fields = array())
    {
        $this->setFields($fields);

        $character = $this->get($this->generatePath('character/:realm/:character', array(
            'realm' => $realm,
            'character' => $character,
        )));

        return $character;
    }


}
