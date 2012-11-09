<?php

/**
 * Description of AuthFilter
 *
 * @author brian
 */
class Ext_CacheFilter extends CacheFilter {

    protected $cache = array('langs');

    public function input() {
        foreach ($this->cache as $c) {
            $v = Memcache::create()->get($c);
            if (empty($v)) {
                $langs = ideone::getlanguages();
                if(!empty($langs))
                    $langs = $langs['languages'];
                Memcache::create()->save($c, $langs, 6000);
            }
        }
    }


}

?>
