<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('cache')) {
    function cache($text) {
        return Memcache::create()->get($text);
    }
}
?>
