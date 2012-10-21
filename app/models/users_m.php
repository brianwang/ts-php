<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of code
 *
 * @author brian
 */
class users_m extends ExtModel {
    protected $modelname ='user';
    public function onlinecount(){
        $users = Memcache::create()->get('onlineusers');
        return count(explode(',', $users));
    }
}

?>
