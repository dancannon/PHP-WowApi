<?php
namespace WowApi\Cache;

use WowApi\Cache\AbstractCache;
use WowApi\Exception\Exception;

/**
 * File cache adapter. Encodes and saves as JSON. Uses
 * a cache buffer to minimize reads and writes from file.
 *
 * @package PHP-WowAPI
 * @author  Chris Brand <webmaster@cainsvault.com>
 */
class File extends AbstractCache
{
    /**
     * @var array
     */
    protected $cache;

    /**
     * @var array
     */
    protected $buffer = array();

    /**
     * Create new instance.
     *
     * - store = path to file store
     *
     * @param array $options ParameterBag
     */
    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->cache = $this->_init();

        // Register a shutdown function to flush to file
        register_shutdown_function(array($this, 'flush'));
    }

    /**
     * Load cache from file. If file doesn't exist, create it and
     * apply the correct mask.
     *
     * @return array
     */
    private function _init()
    {
        $path = $this->options->get('store');

        if (file_exists($path))
        {
            if ($temp = json_decode(file_get_contents($path), true))
            {
                return $temp;
            }
        }
        else
        {
            touch($path);
            chmod($path, 0777);
        }

        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function write($key, $data) {
        $this->buffer[$key] = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function read($key) {
        return isset($this->buffer[$key]) ? $this->buffer[$key] : $this->cache[$key];
    }

    /**
     * Flush the buffer to file.
     *
     * @return boolean
     */
    public function flush()
    {
        $this->buffer = array_merge($this->cache, $this->buffer);

        return file_put_contents($this->options->get('store'), json_encode($this->buffer));
    }
}
