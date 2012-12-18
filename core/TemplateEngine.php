<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TemplateEngine
 *
 * @author brian
 */
abstract class TemplateEngine {
    //put your code here
    abstract function display($tmpl='',$data=array());
    abstract function render($tmpl='',$data=array());
}

?>
