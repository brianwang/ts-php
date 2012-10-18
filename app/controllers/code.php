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
class code extends Controller {

    //put your code here

    function get($id = NULL) {
        if ($id == NULL) {
            $this->output->show404();
        } else {
            $this->code_m->get($id);
        }
    }

    /*
     * 
     * Save your code here
     */

    function save() {
        $title = $_POST['description'];
        $content = $_POST['code'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $id = md5($title . $content . $ip);
        $last = $_SESSION['lastupload'];
        //if last upload is same with the current.
        if ($id == $last) {
            $this->output->json(__('You have submitted!'));
        } else {
            $post = $this->input->post();
            $post['_id'] = $id;
            $this->code_m->save($post);
            $_SESSION['lastupload'] = $id;
        }
    }

}

?>
