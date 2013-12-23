<?php

use WowApi\Cache\File;

class FileTest extends AbstractCacheTest
{
    protected function setUp()
    {
        parent::setUp();
    }

    function getCacheAdaptor()
    {
        return new File(array('store' => sys_get_temp_dir() . "/Store.cache"));
    }
}
?>
