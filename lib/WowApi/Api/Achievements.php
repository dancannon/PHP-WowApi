<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Achievements extends AbstractApi
{
    public function getCharacterAchievements()
    {
        return $this->get('data/character/achievements');
    }

    public function getGuildAchievements()
    {
        return $this->get('data/guild/achievements');
    }
}
