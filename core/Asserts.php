<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asserts
 *
 * @author brian
 */
class Asserts {

//put your code here
    var $css = array();
    var $js = array();
    var $controllers = array();

    public function __construct() {
        
    }

    public static function create() {
        static $inst = NULL;
        if ($inst == NULL)
            $inst = new Asserts();
        return $inst;
    }

    public static function addcss($path) {
        Asserts::add('css', $path);
    }

    public static function addjs($path) {
        Asserts::add('js', $path);
    }

    public static function add($type = '', $path = '') {
        if ($type == '') {
            die('your assert type is null');
        } else if ($path == '') {
            die('your asset path is NULL');
        } else {
            $id = md5($path);
            Asserts::create()->{$type}[$id] = $path;
        }
    }

    public static function remove($type = '', $path = '') {
        if ($type == '') {
            die('your assert type is null');
        } else if ($path == '') {
            die('your asset path is NULL');
        } else {
            $id = md5($path);
            unset(Asserts::create()->{$type}[$id]);
        }
    }

}

?>
