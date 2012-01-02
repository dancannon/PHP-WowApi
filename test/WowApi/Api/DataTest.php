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
        $api = $this->client->getClassesApi();

        $classes = $api->getClasses();

        $this->assertArrayHasKey("classes", $classes);
        $this->assertArrayHasKey("id", $classes["classes"][0]);
        $this->assertArrayHasKey("mask", $classes["classes"][0]);
        $this->assertArrayHasKey("powerType", $classes["classes"][0]);
        $this->assertArrayHasKey("name", $classes["classes"][0]);
    }

    function testGetPerks()
    {
        $api = $this->client->getGuildPerksApi();

        $perks = $api->getPerks();

        $this->assertArrayHasKey("perks", $perks);
        $this->assertArrayHasKey("guildLevel", $perks["perks"][0]);
        $this->assertArrayHasKey("spell", $perks["perks"][0]);
        $this->assertTrue(is_array($perks["perks"][0]["spell"]));
    }

    function testGetRewards()
    {
        $api = $this->client->getGuildRewardsApi();

        $rewards = $api->getRewards();

        $this->assertArrayHasKey("rewards", $rewards);
        $this->assertArrayHasKey("minGuildLevel", $rewards["rewards"][0]);
        $this->assertArrayHasKey("minGuildRepLevel", $rewards["rewards"][0]);
    }

    function testGetItem()
    {
        $api = $this->client->getItemsApi();

        $item = $api->getItem(12345);

        $this->assertEquals($item["id"], 12345);
        $this->assertArrayHasKey("id", $item);
        $this->assertArrayHasKey("description", $item);
        $this->assertArrayHasKey("name", $item);
        $this->assertArrayHasKey("icon", $item);
        $this->assertArrayHasKey("stackable", $item);
        $this->assertArrayHasKey("itemBind", $item);
        $this->assertArrayHasKey("bonusStats", $item);
        $this->assertArrayHasKey("buyPrice", $item);
        $this->assertArrayHasKey("itemClass", $item);
        $this->assertArrayHasKey("containerSlots", $item);
        $this->assertArrayHasKey("inventoryType", $item);
        $this->assertArrayHasKey("equippable", $item);
        $this->assertArrayHasKey("itemLevel", $item);
        $this->assertArrayHasKey("maxCount", $item);
        $this->assertArrayHasKey("maxDurability", $item);
        $this->assertArrayHasKey("minFactionId", $item);
        $this->assertArrayHasKey("minReputation", $item);
        $this->assertArrayHasKey("quality", $item);
        $this->assertArrayHasKey("sellPrice", $item);
        $this->assertArrayHasKey("requiredSkill", $item);
        $this->assertArrayHasKey("requiredLevel", $item);
        $this->assertArrayHasKey("requiredSkillRank", $item);
        $this->assertArrayHasKey("itemSource", $item);
        $this->assertArrayHasKey("baseArmor", $item);
        $this->assertArrayHasKey("hasSockets", $item);
        $this->assertArrayHasKey("isAuctionable", $item);
        $this->assertArrayHasKey("armor", $item);
    }

    function testGetItemClass
    ()
    {
        $api = $this->client->getItemClassesApi();

        $classes = $api->getItemClasses();

        $this->assertArrayHasKey("classes", $classes);
        $this->assertArrayHasKey("class", $classes["classes"][0]);
        $this->assertArrayHasKey("name", $classes["classes"][0]);
    }

    function testGetRaces()
    {
        $api = $this->client->getRacesApi();

        $races = $api->getRaces();

        $this->assertArrayHasKey("races", $races);
        $this->assertArrayHasKey("id", $races["races"][0]);
        $this->assertArrayHasKey("mask", $races["races"][0]);
        $this->assertArrayHasKey("side", $races["races"][0]);
        $this->assertArrayHasKey("name", $races["races"][0]);
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
