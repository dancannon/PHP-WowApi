<?php
namespace WowApi\Api;

use WowApi\Utilities;

class ItemClasses extends AbstractApi
{
    public function getItemClasses()
    {
        $item = $this->get($this->generatePath('data/item/classes'));

        return $item;
    }
}
