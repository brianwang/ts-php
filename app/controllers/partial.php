<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of partial
 *
 * @author brian
 */
class partial extends Controller {
    //put your code here
    function code($page){
        $this->data['codes'] =$this->code_m->get_all(PAGESIZE,$page);
        $this->data['curpage'] = $page;
        $this->viewfile = 'partial/code-tmpl.tpl';
    }
}

?>
