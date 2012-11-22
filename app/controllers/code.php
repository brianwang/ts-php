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
                $code['url'] = site_url('/code/get/') . $id;
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

//create new comment
    function comment($id = NULL) {
        if ($id == NULL
                || $this->input->ispost()) {
            show_404();
        } else {
            $code = $this->code_m->get($id);
            if (empty($code)) {
                show_404();
            } else {
                $post = $this->input->post();
                if (!isset($code['comments'])) {
                    $code['comments'] = array();
                }
                if (isset($post['comments'])) {
                    $creator = isset($post['uid']) ? $_SESSION['uid'] : $post['uid'];
                    array_push($code['comments'], array(
                        'id' => Uuid::v4(),
                        'comment' => $post['comment'],
                        'create_time' => time(),
                        'creator' => $creator,
                        'update_time' => time(), 'updator' => $creator
                            )
                    );
                    $this->code_m->save($code);
                    $this->output->success(__('sucess'));
                }
            }
        }
    }

    //update comment
    function updatecomment() {
        if ($this->input->ispost()) {
            $post = $this->input->post();
            if (isset($post['id']) && isset($post['cid'])) {
                $code = $this->code_m->get($post['id']);
                if (empty($code)) {
                    show_404();
                } else {
                    $updator = isset($post['uid']) ? $_SESSION['uid'] : $post['uid'];
                    foreach ($code['comments'] as &$comment) {
                        if (isset($post['cid']))
                            if ($comment['id'] == $post['cid']) {
                                $comment['comment'] = $post['comment'];
                                $comment['update_time'] = time();
                                $comment['updator'] = $updator;
                                break;
                            }
                    }
                    $this->code_m->save($code);
                    $this->output->success(__('update comment success'));
                }
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    function vote() {
        if (empty($_POST['id'])) {
            $this->output->error(__('Vote Error'));
        } else {
            $value = substr($_POST['value'], 5);
            $this->output->success(
                    array('avg' => $value,
                'number_votes' => $value,
                'dec_avg' => 4), __('vote success'));
        }
    }

    /*
     * 
     * Save your code here
     */

    function save() {
        if (isset($_POST['description']) &&
                isset($_POST['code']) && isset($_POST['language'])) {
            $title = $_POST['description'];
            $content = ltrim($_POST['code']);
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
                $post['code'] = ltrim($post['code']);
                $post['createtime'] = time();
                if (!array_key_exists('language', $_POST)) {
                    $post['languagecode'] = 62;
                    $post['language'] = 'Text';
                } else {
                    $lang = $_POST['language'];
                    $langs = Memcache::create()->get('langs');
                    $post['languagecode'] = $lang;
                    $language = $langs[$lang];
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
        } else {
            show_404();
        }
    }

}

?>
