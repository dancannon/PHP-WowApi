<?php

use WowApi\Client;

/**
 * TODO: Add tests
 */
class DataTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \WowApi\Client
     */
    protected $client;

    protected function setUp()
    {
        $this->client = Shared::Client();
    }

    protected function tearDown()
    {
    }

    function testGetClasses()
    {
        $this->markTestIncomplete();
    }

    function testGetPerks()
    {
        $this->markTestIncomplete();
    }

    function testGetRewards()
    {
        $this->markTestIncomplete();
    }

    function testGetItems()
    {
        $this->markTestIncomplete();
    }

    function testGetRaces()
    {
        $this->markTestIncomplete();
    }

    function testGetRecipe()
    {
        $api = $this->client->getRecipeApi();

        $recipe = $api->getRecipe(33994);

        $this->assertArrayHasKey("id", $recipe);
        $this->assertArrayHasKey("name", $recipe);
        $this->assertArrayHasKey("profession", $recipe);
        $this->assertArrayHasKey("icon", $recipe);

        $this->assertEquals(33994, $recipe["id"]);
    }

}

?>
