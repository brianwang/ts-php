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
            if (!empty($code)) {
                $code['code'] = htmlentities($code['code'], ENT_COMPAT, "UTF-8");
                //$code['code']= nl2br($code['code']);
                $this->data['url'] = $id;
                $this->data['code'] = $code;
                $this->viewfile = 'viewcode.tpl';
            } else {
                show_404();
            }
        }
    }

    function tag($tag = '') {
        $this->data['codes'] = $this->code_m->getbytag($tag);
        $this->viewfile = 'code.tpl';
    }

    function vote() {
        if (empty($_POST['id'])) {
            $this->output->error(__('Vote Error'));
        } else {
            $value = intval(substr($_POST['value'], 5));
            $this->output->success(array('avg' => $value,
                'number_votes' => 3,
                'dec_avg' => 4), __('vote success'));
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
        $last = '';
        if (array_key_exists('lastupload', $_SESSION)) {
            $last = $_SESSION['lastupload'];
        }
        if ($id == $last) {
            $this->output->json(__('You have submitted!'), '', 500);
        } else {
            $post = $this->input->post();
            $id = PseudoCrypt::createshortid();
            $post['_id'] = $id;
            $post['ip'] = $ip;
            $post['createtime'] = time();
            if (array_key_exists('language', $_POST)) {
                $post['languagecode'] = 62;
                $post['language'] = 'Text';
            } else {
                $lang = $_POST['language'];
                $langs = Memcache::create()->get('langs');
                $post['languagecode'] = $lang;
                $language = $langs['languages'][$lang];
                $post['language'] = substr($language, 0, stripos($language, '('));
            }
            $public = (bool) $_POST['public'];
            if (array_key_exists('isrun', $post) && $post['isrun'] === 'true') {
                $result = ideone::createSubmission($content, $lang, '', true, $public);
                //var_dump($result);
                if (array_key_exists('link', $result)) {
                    $details = ideone::getSubmissionDetails($result['link']);
                    $post['runresult'] = $details;
                    //var_dump($details);
                }
            }
            $this->code_m->save($post);
            $_SESSION['lastupload'] = $id;
            $url = site_url('/code/get/' . $id);
            $this->output->json(array('url' => $url), __('Success'));
        }
    }

}

?>
