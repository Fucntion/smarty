<?php

/**
 * Simple Cache class
 * API Documentation: https://github.com/cosenary/Simple-PHP-Cache
 *
 * @author Christian Metz
 * @since 22.12.2011
 * @copyright Christian Metz - MetzWeb Networks
 * @version 1.6
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 */
class Cache {

    /**
     * The path to the cache file folder
     *
     * @var string
     */
    private $_cachepath = 'cache/';

    /**
     * The name of the default cache file
     *
     * @var string
     */
    private $_cachename = 'default';

    /**
     * The cache file extension
     *
     * @var string
     */
    private $_extension = '.cache';

    /**
     * Default constructor
     *
     * @param string|array [optional] $config
     * @return void
     */
    public function __construct($conf = null) {
        global $config;
        $conf = $conf ? $conf : $config;
        if (true === isset($conf)) {
            if (is_string($conf)) {
                $this->set_cache($conf);
            } else if (is_array($conf)) {
                $this->set_cache($conf['cache_name']);
                $this->set_cache_path($conf['cache_path']);
                $this->set_extension($conf['cache_extension']);
            }
        }
    }

    /**
     * Check whether data accociated with a key
     *
     * @param string $key
     * @return boolean
     */
    public function cached($key) {
        if (false != $this->_load_cache()) {
            $cachedData = $this->_load_cache();
            return isset($cachedData[$key]['data']);
        }
    }

    /**
     * Store data in the cache
     *
     * @param string $key
     * @param mixed $data
     * @param integer [optional] $expiration
     * @return object
     */
    public function set($key, $data, $expiration = 0) {
        $storeData = array(
            'time' => time(),
            'expire' => $expiration,
            'data' => serialize($data)
        );
        $dataArray = $this->_load_cache();
        if (true === is_array($dataArray)) {
            $dataArray[$key] = $storeData;
        } else {
            $dataArray = array($key => $storeData);
        }
        $cacheData = json_encode($dataArray);
        file_put_contents($this->get_cache_dir(), $cacheData);
        return $this;
    }

    /**
     * Retrieve cached data by its key
     *
     * @param string $key
     * @param boolean [optional] $timestamp
     * @return string
     */
    public function get($key, $timestamp = false) {
        $cachedData = $this->_load_cache();
        $type = (false === $timestamp) ? 'data' : 'time';
        if (!isset($cachedData[$key][$type])) {
            return null;
        }
        return unserialize($cachedData[$key][$type]);
    }

    /**
     * Retrieve all cached data
     *
     * @param boolean [optional] $meta
     * @return array
     */
    public function get_all($meta = false) {
        if ($meta === false) {
            $results = array();
            $cachedData = $this->_load_cache();
            if ($cachedData) {
                foreach ($cachedData as $k => $v) {
                    $results[$k] = unserialize($v['data']);
                }
            }
            return $results;
        } else {
            return $this->_load_cache();
        }
    }

    /**
     * Erase cached entry by its key
     *
     * @param string $key
     * @return object
     */
    public function erase($key) {
        $cacheData = $this->_load_cache();
        if (true === is_array($cacheData)) {
            if (true === isset($cacheData[$key])) {
                unset($cacheData[$key]);
                $cacheData = json_encode($cacheData);
                file_put_contents($this->get_cache_dir(), $cacheData);
            } else {
                throw new Exception("Error: erase() - Key '{$key}' not found.");
            }
        }
        return $this;
    }

    /**
     * Erase all expired entries
     *
     * @return integer
     */
    public function erase_expired() {
        $cacheData = $this->_load_cache();
        if (true === is_array($cacheData)) {
            $counter = 0;
            foreach ($cacheData as $key => $entry) {
                if (true === $this->_check_expired($entry['time'], $entry['expire'])) {
                    unset($cacheData[$key]);
                    $counter++;
                }
            }
            if ($counter > 0) {
                $cacheData = json_encode($cacheData);
                file_put_contents($this->get_cache_dir(), $cacheData);
            }
            return $counter;
        }
    }

    /**
     * Erase all cached entries
     *
     * @return object
     */
    public function erase_all() {
        $cacheDir = $this->get_cache_dir();
        if (true === file_exists($cacheDir)) {
            $cacheFile = fopen($cacheDir, 'w');
            fclose($cacheFile);
        }
        return $this;
    }

    /**
     * Load appointed cache
     *
     * @return mixed
     */
    private function _load_cache() {
        if (true === file_exists($this->get_cache_dir())) {
            $file = file_get_contents($this->get_cache_dir());
            return json_decode($file, true);
        } else {
            return false;
        }
    }

    /**
     * Get the cache directory path
     *
     * @return string
     */
    public function get_cache_dir() {
        if (true === $this->_check_cache_dir()) {
            $filename = $this->get_cache();
            $filename = preg_replace('/[^0-9a-z\.\_\-]/i', '', strtolower($filename));
            return $this->get_cache_path() . $this->_get_hash($filename) . $this->get_extension();
        }
    }

    /**
     * Get the filename hash
     *
     * @return string
     */
    private function _get_hash($filename) {
        return sha1($filename);
    }

    /**
     * Check whether a timestamp is still in the duration
     *
     * @param integer $timestamp
     * @param integer $expiration
     * @return boolean
     */
    private function _check_expired($timestamp, $expiration) {
        $result = false;
        if ($expiration !== 0) {
            $timeDiff = time() - $timestamp;
            $result = ($timeDiff > $expiration) ? true : false;
        }
        return $result;
    }

    /**
     * Check if a writable cache directory exists and if not create a new one
     *
     * @return boolean
     */
    private function _check_cache_dir() {
        if (!is_dir($this->get_cache_path()) && !mkdir($this->get_cache_path(), 0775, true)) {
            throw new Exception('Unable to create cache directory ' . $this->get_cache_path());
        } elseif (!is_readable($this->get_cache_path()) || !is_writable($this->get_cache_path())) {
            if (!chmod($this->get_cache_path(), 0775)) {
                throw new Exception($this->get_cache_path() . ' must be readable and writeable');
            }
        }
        return true;
    }

    /**
     * Cache path Setter
     *
     * @param string $path
     * @return object
     */
    public function set_cache_path($path) {
        $this->_cachepath = $path;
        return $this;
    }

    /**
     * Cache path Getter
     *
     * @return string
     */
    public function get_cache_path() {
        return $this->_cachepath;
    }

    /**
     * Cache name Setter
     *
     * @param string $name
     * @return object
     */
    public function set_cache($name) {
        $this->_cachename = $name;
        return $this;
    }

    /**
     * Cache name Getter
     *
     * @return void
     */
    public function get_cache() {
        return $this->_cachename;
    }

    /**
     * Cache file extension Setter
     *
     * @param string $ext
     * @return object
     */
    public function set_extension($ext) {
        $this->_extension = $ext;
        return $this;
    }

    /**
     * Cache file extension Getter
     *
     * @return string
     */
    public function get_extension() {
        return $this->_extension;
    }

}
