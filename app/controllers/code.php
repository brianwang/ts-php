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
            $code = $this->code_m->get($id);
            $this->data['url'] = $id;
            $this->data['code'] = $code;

            $this->viewfile = 'viewcode.tpl';
        }
    }

    function tag($tag = '') {
        $this->data['codes']=$this->code_m->getbytag($tag);
        $this->viewfile='result.tpl';
    }

    function vote(){
        if(empty($_POST['id'])){
            $this->output->error(__('Vote Error'));
        }
        else{
            $value = intval(substr($_POST['value'],5));
            $this->output->success(array('avg'=>$value,
                'number_votes'=>3,
                'dec_avg'=>4),__('vote success'));
        }
        
    }
    /*
     * 
     * Save your code here
     */

    function save() {
        $title = $_POST['description'];
        $content = $_POST['code'];
        $user = $_POST['guestname'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $id = md5($title . $content . $ip . $user);
        $last = '';
        if (array_key_exists('lastupload', $_SESSION)) {
            $last = $_SESSION['lastupload'];
        }
        if ($id == $last) {
            $this->output->json(__('You have submitted!'), '', 500);
        } else {
            $post = $this->input->post();
            $post['_id'] = $id;
            $post['ip'] = $ip;
            $post['createtime'] = time();
            $this->code_m->save($post);
            $_SESSION['lastupload'] = $id;
            $url = site_url('/code/get/' . $id);
            $this->output->json(array('url' => $url), __('Success'));
        }
    }

}

?>
