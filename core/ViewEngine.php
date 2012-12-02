<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewEngine
 *
 * @author brian
 */
class ViewEngine {

    protected $tmplengine;

    public function __construct() {
        $tmpl = Config::get('tmplEngine');
        if ($tmpl != '') {
            $tmpl = $tmpl . 'TE';
            $this->tmplengine = new $tmpl();
        }
    }

    public static function create() {
        static $inst = NULL;
        if ($inst == NULL)
            $inst = new ViewEngine();
        return $inst;
    }

    public function render($filename,$data) {
        ob_start();
        if ($this->tmplengine != NULL) {
            $this->tmplengine->render($filename,$data);
        } else {
            include $filename;
        }
        ob_flush();
    }
    
    public function display($filename,$data){
        if ($this->tmplengine != NULL) {
           return    $this->tmplengine->display($filename,$data);
        }
    }

}

?>
