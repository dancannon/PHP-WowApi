<?php
namespace WowApi\Api;

class Auction extends AbstractApi
{
    public function getAuctions($realm)
    {
        $index = $this->getAuctionIndex($realm);

        if($index) {
            return $this->getAuctionDump($index['url']);
        }

        return false;
    }

    public function getAuctionDump($url)
    {
        return $this->getRequest()->send($url);
    }

    public function getAuctionIndex($realm)
    {
        $indexFile = $this->get($this->generatePath('auction/data/:realm', array(
            'realm' => $realm,
        )));

        if(isset($indexFile['files']) && isset($indexFile['files'][0])) {
            return $indexFile['files'][0];
        }

        return false;
    }
}
