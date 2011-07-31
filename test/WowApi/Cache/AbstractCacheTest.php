<?php

abstract class AbstractCacheTest extends PHPUnit_Framework_TestCase
{
    public function testSetCachedResponse()
    {
        $cache = $this->getCacheAdaptor();
        $data = array('status' => 'nok', 'reason' => 'Test');

        $cache->setCachedResponse('/test/cache', array(), json_encode($data));
        $cachedData = $cache->getCachedResponse('/test/cache', array());

        $this->assertNotEquals(false, $cachedData);
        $this->assertEquals($data, json_decode($cachedData, true));
    }

    /**
     * @abstract
     * @return \WowApi\Cache\CacheInterface
     */
    abstract function getCacheAdaptor();
}
?>
