<?php

/**
 * Description of AuthFilter
 *
 * @author brian
 */
class CacheFilter implements IFilter {

    protected $cache = array('langs');

    public function input() {
        foreach ($this->cache as $c) {
            $v = Memcache::create()->get($c);
            if (empty($v)) {
                Memcache::create()->save($c, array('Text','C++', 'JAVA', 'C#', 'Assembly'), 60);
            }
        }
    }

    public function output() {
        //echo 'Auth end';
    }

}

?>
