<?php

use WowApi\Cache\Apc;

class ApcTest extends AbstractCacheTest
{
    protected function setUp()
    {
        parent::setUp();

        if (!class_exists('apc_store')) {
            $this->markTestSkipped('APC is not installed');
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
        return new Apc();
    }
}
?>
