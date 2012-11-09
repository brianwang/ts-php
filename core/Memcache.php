<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Memcache
 *
 * @author brian
 */
class Memcache implements Cache {

    protected $config;
    protected $mc;

    //put your code here
    public function __construct() {
        include Config::create()->load('cache');
        $this->config = $cache;
        $this->mc = new Memcached();
        foreach ($this->config['server'] as $s) {
            $this->mc->addServer($s['host'], $s['port']);
        }
    }

    public static function create() {
        static $inst=NULL;
        if ($inst == NULL)
            $inst = new Memcache();
        return $inst;
    }

    public function get($name) {
        return $this->mc->get($name);
    }

    public function save($name, $value, $ttl = NULL) {
        $this->mc->set($name, $value, $ttl);
    }
    
    public function delete($key){
        $this->mc->delete($key);
    }

}

?>
