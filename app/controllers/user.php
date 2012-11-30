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
                $user = $user[0];
                if (isset($user['status'])
                        && $user['status'] == 'validated') {
                    $user['password'] = Encrypt::aes256_decode($user['password']);
                    if (isset($post['password']) &&
                            $post['password'] == $user['password']) {
                        $_SESSION['user'] = $user;
                        $_SESSION['uid'] = $user['_id'];
                        redirect('/');
                    } else {
                        $this->output->error('login error');
                    }
                } else {
                    $this->output->error('not validate error');
                }
            } else {
                $this->register();
            }
        }
    }

    function save() {
        if (!isset($_POST['email'])
                || !isset($_POST['password'])
                || !isset($_POST['c_password'])) {
            show_404();
        } else {
            $user = $this->users_m->get_by(array('email' => $_POST['email']));
            if (!empty($user)) {
                $user = $user[0];
                $user['password'] = Encrypt::aes256_encode($_POST['password']);
                $this->users_m->save($user);
                $this->viewfile = 'reset.tpl';
            }
            else{
                show_error('your account is not exists!');
            }
        }
    }

    function logout() {
        session_destroy();
        redirect("/");
    }

    function forgetpassword() {
        $this->viewfile = 'forgetpassword.tpl';
    }

    function resetpassword() {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $emailencrpyt = base64_encode(Encrypt::aes256_encode($email));
            $content = site_url('/pages/resetpassword/?email=' . $emailencrpyt);
            $this->viewfile = 'restpassword.tpl';
            EMail::sendmail('wangxydlut@gmail.com', $email, '', '', 'Welcome to codesgist.com, please reset your password', $content, '');
        }
    }

    function validate() {
        if (!isset($_GET['vcode'])) {
            show_error('You can\'t validate your email.');
        } else {
            $validatecode = base64_decode($_GET['vcode']);
            $uid = Encrypt::aes256_decode($validatecode);
            $user = $this->users_m->get($uid);
            if (!empty($user)) {
                if (!isset($user['status']) ||
                        $user['status'] != 'validated') {
                    $user['status'] = 'validated';
                    $_SESSION['user'] = $user;
                    $_SESSION['uid'] = $uid;
                    $this->users_m->save($user);
                }
                $this->viewfile = "validatesuccess.tpl";
            } else {
                show_error(__('user not exists error'));
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
            $uid = $this->users_m->save($user);
            $validatecode = base64_encode(Encrypt::aes256_encode($uid));
            $content = site_url('/user/validate/?vcode=' . $validatecode);
            EMail::sendmail('wangxydlut@gmail.com', $email, '', '', 'Welcome to codesgist.com, please confirm your email address', $content, '');
            $this->data['email'] = substr($email, stripos($email, '@') ? stripos($email, '@') : 0);
            $this->viewfile = 'registersuccess.tpl';
        } else {
            $this->output->error('You don\'t have email and password');
        }
    }

}

?>
