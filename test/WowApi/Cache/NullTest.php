<?php

use WowApi\Cache\Null;

class NullTest extends AbstractCacheTest
{
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

    public function testSetCachedResponse()
    {
        $cache = $this->getCacheAdaptor();
        $data = array('status' => 'nok', 'reason' => 'Test');

        $cache->setCachedResponse('/test/cache', array(), json_encode($data));
        $cachedData = $cache->getCachedResponse('/test/cache', array());

        $this->assertEquals(false, $cachedData);
    }

    function getCacheAdaptor()
    {
        return new Null();
    }
}
?>
