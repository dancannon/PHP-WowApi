<?php
namespace WowApi\Cache;

use WowApi\ParameterBag;

abstract class AbstractCache implements CacheInterface
{
    public $options = null;

    public function __construct($options)
    {
        $this->options = new ParameterBag($options);
    }

    public function getCachedResponse($path, $parameters)
    {
        return $this->read("wowapi:cache" . $this->getHash($path, $parameters));
    }

    public function setCachedResponse($path, $parameters, $response)
    {
        $this->write("wowapi:cache" . $this->getHash($path, $parameters), $response);
    }

    protected function getHash($path, $parameters)
    {
        return md5($path . json_encode($parameters));
    }
}
