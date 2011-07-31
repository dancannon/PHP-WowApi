<?php

use WowApi\Client;

class CharacterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \WowApi\AbstractApi\Character
     */
    protected $api;

    protected function setUp()
    {
        $this->api = Shared::Client()->getCharacterApi();
    }

    protected function tearDown()
    {

    }

    function testGetCharacter()
    {
        $character = $this->api->getCharacter('Dragonblight', 'Shankill');
        $this->assertArrayHasKey('name', $character);
        $this->assertArrayHasKey('realm', $character);
        $this->assertArrayHasKey('class', $character);
        $this->assertArrayHasKey('race', $character);
        $this->assertArrayHasKey('gender', $character);
        $this->assertArrayHasKey('level', $character);
        $this->assertArrayHasKey('achievementPoints', $character);
        $this->assertArrayHasKey('thumbnail', $character);
        $this->assertArrayHasKey('lastModified', $character);
    }

    /**
     * @expectedException        WowApi\Exception\NotFoundException
     * @expectedExceptionMessage Character not found.
     */
    function testGetNonExistentCharacter()
    {
        $this->api->getCharacter('Dragonblight', 'DoesntExist');
    }

    /**
     * @expectedException        WowApi\Exception\NotFoundException
     * @expectedExceptionMessage Realm not found.
     */
    function testGetNonExistentRealm()
    {
        $this->api->getCharacter('DoesntExist', 'Shankill');
    }

    /**
     * @expectedException        WowApi\Exception\NotFoundException
     * @expectedExceptionMessage Realm not found.
     */
    function testGetNonExistentRealmAndCharacter()
    {
        $this->api->getCharacter('DoesntExist', 'DoesntExist');
    }
}
?>
