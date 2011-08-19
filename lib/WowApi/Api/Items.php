<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Items extends AbstractApi
{
    public function getItem($itemId)
    {
        $item = $this->get($this->generatePath('item/:itemId', array(
            'itemId' => (int)$itemId)
        ));

        return $item;
    }

    public function getItemClasses()
    {
        return $this->get('data/item/classes');
    }

}
