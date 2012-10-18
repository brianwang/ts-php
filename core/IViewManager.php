<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author brian
 */
interface IViewManager {
    //put your code here
    function getviewpath($name);
    function render($name, $data);
    function getviews();
    function setviewpath($name,$path);
    function getpath($path);
    function setpath($path);
}

?>
