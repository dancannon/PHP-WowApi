<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Quests extends AbstractApi
{
    public function getQuest($questId)
    {
        $quest = $this->get($this->generatePath('quest/:questId', array(
            'questId' => (int)$questId)
        ));

        return $quest;
    }
}
