<?php

use WowApi\Cache\Simple;

class SimpleTest extends AbstractCacheTest
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

    function getCacheAdaptor()
    {
        return new Simple();
    }
}
?>
