<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('__')) {

    function __($text, $data=array(),$lang = NULL) {
        return I18n::create()->get($text, $data,$lang);
    }

}
?>
