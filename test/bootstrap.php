<?php

error_reporting(E_ALL | E_STRICT);

spl_autoload_register(function($class)
{
    $file = __DIR__ . '/../lib/' . strtr($class, '\\', '/') . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    } else {
        return false;
    }
});

require __DIR__ . '/Shared.php';
//Uncomment if you wish to test the Redis cache adaptor
