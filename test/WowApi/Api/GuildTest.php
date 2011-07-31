<?php

use WowApi\Client;

class GuildTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \WowApi\AbstractApi\Guild
     */
    protected $api;

    protected function setUp()
    {
        $this->api = Shared::Client()->getGuildApi();
    }

    protected function tearDown()
    {
    }

    function testGetGuild()
    {
        $guild = $this->api->getGuild('Dragonblight', 'Quintessential');
        $this->assertArrayHasKey('name', $guild);
        $this->assertArrayHasKey('realm', $guild);
        $this->assertArrayHasKey('level', $guild);
        $this->assertArrayHasKey('side', $guild);
        $this->assertArrayHasKey('achievementPoints', $guild);
        $this->assertArrayHasKey('lastModified', $guild);
    }

    /**
     * @expectedException        WowApi\Exception\NotFoundException
     * @expectedExceptionMessage Guild not found.
     */
    function testGetNonExistentCharacter()
    {
        $this->api->getGuild('Dragonblight', 'DoesntExist');
    }

    /**
     * @expectedException        WowApi\Exception\NotFoundException
     * @expectedExceptionMessage Realm not found.
     */
    function testGetNonExistentRealm()
    {
        $this->api->getGuild('DoesntExist', 'Quintessential');
    }

    /**
     * @expectedException        WowApi\Exception\NotFoundException
     * @expectedExceptionMessage Realm not found.
     */
    function testGetNonExistentRealmAndGuild()
    {
        $this->api->getGuild('DoesntExist', 'DoesntExist');
    }
}
?>
