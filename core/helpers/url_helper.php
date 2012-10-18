<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('base_url')) {
    function base_url() {
        return "http://" .$_SERVER['HTTP_HOST'] . rtrim($_SERVER['SCRIPT_NAME'], '/');
    }

}

if (!function_exists('site_url')) {
    function site_url($n) {
        return "http://" .$_SERVER['HTTP_HOST'] .$_SERVER['SCRIPT_NAME'] .$n;
    }

}
if (!function_exists('assert_url')) {
    function assert_url($n) {
        $pos=strrpos($_SERVER['SCRIPT_NAME'],'/');
        $baseurl = substr($_SERVER['SCRIPT_NAME'],0,$pos);
        return "http://" . $_SERVER['HTTP_HOST']  .$baseurl .'/public'.$n;
    }

}
?>
