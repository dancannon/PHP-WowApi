<?php

use WowApi\Client;

class ClientTest extends PHPUnit_Framework_TestCase {
    /**
     * @var \WowApi\Client
     */
    protected $object;

    protected function setUp() {
    }

    protected function tearDown() {
    }

    function testApis() {
        $this->assertInstanceOf('\WowApi\Api\Character', Shared::Client()->getCharacterApi());
        $this->assertInstanceOf('\WowApi\Api\Classes', Shared::Client()->getClassesApi());
        $this->assertInstanceOf('\WowApi\Api\Guild', Shared::Client()->getGuildApi());
        $this->assertInstanceOf('\WowApi\Api\GuildPerks', Shared::Client()->getGuildPerksApi());
        $this->assertInstanceOf('\WowApi\Api\GuildRewards', Shared::Client()->getGuildRewardsApi());
        $this->assertInstanceOf('\WowApi\Api\Items', Shared::Client()->getItemsApi());
        $this->assertInstanceOf('\WowApi\Api\Races', Shared::Client()->getRacesApi());
        $this->assertInstanceOf('\WowApi\Api\Realm', Shared::Client()->getRealmApi());
    }

    function testValidApplicationAuthentication()
    {
        $client = Shared::Client();
        $client->authenticate(PUBLIC_KEY, PRIVATE_KEY);
        $result = $client->api('realm/status');
        $this->assertNotEquals(false, $result);
    }

    /**
     * @expectedException        WowApi\Exception\ApiException
     * @expectedExceptionMessage Invalid Application
     */
    function testInvalidApplicationAuthentication()
    {
        $client = Shared::Client();
        $client->authenticate('InvalidPublicKey', 'InvalidPrivateKey');
        $result = $client->api('realm/status');
        $this->assertEquals(false, $result);
    }

    function testRegionsAndLocales()
    {
        $client = Shared::Client();
        $client->setRegion('us');
        $this->assertEquals($client->options->get('region'), 'us');
        $this->assertEquals($client->options->get('locale'), 'en_US');

        $client = Shared::Client();
        $client->setRegion('us', 'es_MX');
        $this->assertEquals($client->options->get('region'), 'us');
        $this->assertEquals($client->options->get('locale'), 'es_MX');

        $client = Shared::Client();
        $client->setRegion('eu', 'en_GB');
        $this->assertEquals($client->options->get('region'), 'eu');
        $this->assertEquals($client->options->get('locale'), 'en_GB');

        $client = Shared::Client();
        $client->setRegion('cn');
        $this->assertEquals($client->options->get('region'), 'cn');
        $this->assertEquals($client->options->get('locale'), 'zh_CN');
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The region `doesntexist` is not supported.
     */
    function testInvalidRegion()
    {
        $client = Shared::Client();
        $client->setRegion('doesntExist');
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The locale `doesntExist` for region `us` is not supported.
     */
    function testInvalidLocale()
    {
        $client = Shared::Client();
        $client->setRegion('us', 'doesntExist');
    }
}

?>
