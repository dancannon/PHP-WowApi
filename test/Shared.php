<?php

require 'Keys.php';

use WowApi\Request\Curl;

class Shared
{
    public static $keys = array(
        'public'  => PUBLIC_KEY,
        'private' => PRIVATE_KEY,
    );

    public static $characters = array(
        array(

        ),
    );

    public static $guilds = array(
        array(

        ),
    );

    public static $realms = array();

    /**
     * @static
     * @return WowApi\Client
     */
    public static function Client() {
        $client = new \WowApi\Client();
        $client->setRegion('us');
        $client->setRequest(new Curl($client));
        return $client;
    }

    public static function getKeys() {
    }
}
