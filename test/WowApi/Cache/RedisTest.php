<?php

use WowApi\Cache\Redis;

class RedisTest extends AbstractCacheTest
{
    protected function setUp()
    {
        parent::setUp();

        //TODO: Check that predis is being detected properly
        if (!class_exists('Predis\Client')) {
            $this->markTestSkipped('Predis is not installed');
        }
    }

    /**
     * @todo Implement testWrite().
     */
    public function testWrite()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRead().
     */
    public function testRead()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    function getCacheAdaptor()
    {
        return new Redis(new Predis\Client);
    }
}
?>
