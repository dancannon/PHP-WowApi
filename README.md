# PHP WowApi [![deprecated](http://badges.github.io/stability-badges/dist/deprecated.svg)](http://github.com/badges/stability-badges)


PHP-WowApi is a PHP (>= 5.3) API client for Blizzard's Community Platform API

**Note**: This library is no longer in development.

## Main features ##

- Support for Blizzards new JSON API
- Works with the following resources:
    - Achievements
    - Arena and Rated Battleground Leaderboard
    - Auction House
    - Challenge Mode Leaderboard
    - Character
    - Character Classes
    - Character Races
    - Guild
    - Guild Perks
    - Guild Rewards
    - Items
    - Quests
    - Realm
- Supports application authentication
- Includes a cache to take advantage of LastModified headers
**Note**: Not all APIs are currently active, check the API forums for more info

## Requirements ##

* Curl Extension
* JSON encode/decode Extension

## Installing ##

PHP-WowApi uses the autoloading features of PHP and works with most of the major frameworks. To load the library manually you can use the following code, you will need to change the base path depending on where you store the library:

``` php
<?php
//Path relative to this file
spl_autoload_register(function($class) {
    //Path relative to this file
    $dir = __DIR__ .'/lib/';
    $file = $dir . strtr($class, '\\', '/') . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
});
```

## How To Use ##

To use the library you must first create an instance of the the Client class. Because this library supports multiple request adaptors you will need to pass the client class an instance of a request adaptor. Currently the only adaptor available is the Curl adaptor.

When using in a loop or long running program, be sure to unset both $api and $request after you are done with them and before using them for another character, or memory usage will continue to increase.

``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client();
$api->setRequest($request);
```

* [APIs](https://github.com/dancannon/PHP-WowApi/wiki/APIs)
* [Examples](https://github.com/dancannon/PHP-WowApi/wiki/Examples)
* [Authentication](https://github.com/dancannon/PHP-WowApi/wiki/Authentication)
* [Caching](https://github.com/dancannon/PHP-WowApi/wiki/Caching)
* [Testing](https://github.com/dancannon/PHP-WowApi/wiki/Testing)

## Contributing ##
Before submitting a PR please ensure that all the tests still pass.

## Special Thanks ##

A special thanks goes out to the following contributing developers:

* [chaud](https://github.com/chaud)
* [simondlr](https://github.com/simondlr)


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/dancannon/php-wowapi/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

