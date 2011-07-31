# PHP WowApi ![project status](http://stillmaintained.com/dancannon/PHP-WowApi.png) #

PHP-WowApi is a PHP (>= 5.3) API client for Blizzard's Community Platform API
**Note**: This library is still in development (even though Blizzard have released their own client) and tests will be added soon.

## Main features ##

- Support for Blizzards new JSON API
- Works with the following resources:
    - Character
    - Character Classes
    - Character Races
    - Guild
    - Guild Perks
    - Guild Rewards
    - Realm
    - Items
- Supports application authentication
- Includes a cache to take advantage of LastModified headers
**Note**: Not all APIs are currently active, check the API forums for more info

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

## Use ##

To use the library you must first create an instance of the the Client class. Because this library supports multiple request adaptors you will need to pass the client class an instance of a request adaptor. Currently the only adaptor available is the Curl adaptor.

``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client();
$api->setRequest($request);
```

### Configuration ###

You can also pass an array of options the client class to configure the library. The following options are available however helper methods for most options exist in the Client class.

- protocol (http, https, etc)
- baseUrl
- region
- url
- path
- publicKey
- privateKey

If you wish to change the gaming region you should use the setRegion method as shown below, the following regions are available (us, eu, kr, tw, cn)

``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client($request);
$api->setRequest($request);
$api->setRegion('eu');
```

You can also set the locale, to view the options view the API documentation:

``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client($request);
$api->setRequest($request);
$api->setRegion('eu', 'en_GB');
```

### Caching ###

To reduce the amount of api calls that are made the application uses a cache adaptor to store the last response and deal with the If-Modified-Since and Last-Modified headers as recommended by blizzard. The available cache adaptors are: Apc, Memcache, Redis(Using the Predis lib), Simple(Stores data in an array) and Null(Doesnt cache but is used for testing).. To use the cache adaptor you should use the following code:

``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;
use WowApi\Cache\Apc;

$request = new Curl();
$cache = new Apc();
$api = new Client();
$api->setRequest($request);
$api->setCache($cache);
```

### Authenticating ###

**Note**: Authentication is not yet active, check the API forums for more info

Authenticating your application means that you are able to make more than 3000 API calls a day. To authenticate your application you must first register for a set of public and private keys. You must then call the authenticate method as shown below.

``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client();
$api->setRequest($request);
$api->authenticate('PUBLICKEY', 'PRIVATEKEY');
```

### Using API resources ###

#### Character APIs
``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client();
$api->setRequest($request);
# Fetch character info
$api->getCharacterApi->getCharacter('REALMNAME', 'CHARACTERNAME');
# Fetch optional fields
$api->getCharacterApi->getCharacter('REALMNAME', 'CHARACTERNAME', array('guild', 'stats'));
```

#### Guild APIs
``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client();
$api->setRequest($request);
# Fetch guild info
$api->getGuildApi->getGuild('REALMNAME', 'GUILDNAME');
# Fetch optional fields
$api->getGuildApi->getGuild('REALMNAME', 'GUILDNAME', array('members'));
# Fetch all fields
$api->getGuildApi->getGuild('REALMNAME', 'GUILDNAME', true);
```

#### Realm APIs
``` php
<?php
use WowApi\Client;
use WowApi\Request\Curl;

$request = new Curl();
$api = new Client();
$api->setRequest($request);
# Fetch all realms
$api->getRealmApi->getRealms();
# Fetch multiple realms
$api->getRealmApi->getRealms(array('REALM1', 'REALM2'));
# Fetch a single realms status
$api->getRealmApi->getRealm('REALMNAME'));
```
