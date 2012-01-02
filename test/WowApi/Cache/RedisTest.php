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

    function getCacheAdaptor()
    {
        return new Redis(new Predis\Client());
    }
}

?>
