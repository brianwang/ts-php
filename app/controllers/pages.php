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

    function index() {
        $count = $this->code_m->count();
        $usercount = $this->users_m->count();
        $useronline = $this->users_m->onlinecount();
        $this->data['codecount'] = $count;
        $this->data['usercount'] = $usercount;
        $this->data['useronline'] = $useronline;
        $this->data['codes'] = $this->code_m->getlatest();
        $this->data['tags'] = $this->code_m->gettags();
        $this->data['greatcodes'] = $this->code_m->getgreat();
        $this->data['langs'] = Memcache::create()->get('langs');
        $this->viewfile = 'index.tpl';
    }

    function code() {
        $this->data['codes'] =$this->code_m->get_all();
        $this->viewfile = 'code.tpl';
    }

    function api() {
        $this->viewfile = 'api.tpl';
    }

    function help() {
        $this->viewfile = 'help.tpl';
    }

}

?>
