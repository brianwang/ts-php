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
class tag extends Controller {

    function get($id = '') {
        if ($id == '') {
            show_404();
        }
        else{
            $this->tags_m->get($name);
        }
    }

}

?>
