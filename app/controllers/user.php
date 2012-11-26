<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author brian
 */
class user extends Controller {

    //put your code here
    function login() {
        $post = $this->input->post();
        if (isset($post['email'])) {
            $user = $this->users_m->get_by(array('email' => $post['email']));
            //means we have it.
            if (!empty($user)) {
                if (isset($user['validated'])
                        && $user['status'] == 'validated') {
                    if (isset($post['password']) &&
                            $post['password'] == $user['password']) {
                        $this->output->success('login success');
                    } else {
                        $this->output->error('login error');
                    }
                } else {
                    $this->output->error('login error');
                }
            } else {
                $this->register();
            }
        }
    }

    public function register() {
        $post = $this->input->post();
        if (isset($post['email']) && isset($post['password'])) {
            $email = $post['email'];
            $password = $post['password'];
            $password = Encrypt::aes256_encode($password);
            $user = array('email' => $email, 'password' => $password);
            EMail::sendmail('wangxydlut@gmail.com','wangxydlut@gmail.com', '','', 'Test', 'test','');
            $this->users_m->save($user);
        }
        else{
            $this->output->error('You don\'t have email and password');
        }
    }

}

?>
