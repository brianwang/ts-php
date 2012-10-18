<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pages
 *
 * @author brian
 */
class pages extends Controller {
    //put your code here
    
    function index(){
        $this->viewfile='index.tpl';
        //$this->view->render('index.php');
    }
    function code(){
        $this->viewfile='code.tpl';
    }
    function api(){
        $this->viewfile='api.tpl';
    }
     function help(){
        $this->viewfile='help.tpl';
    }
}

?>
