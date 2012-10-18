<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('__')) {
    function __($text,$lang=NULL) {
        if($text !='')
        return I18n::create()->get ($text,$lang);
    }
}
?>
