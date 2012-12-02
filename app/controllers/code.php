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

    function search() {
        if (isset($_GET['query'])) {
            $result = $this->code_m->search( $_GET['query'], array(), array('code', 'description'));
            $re = array();
            foreach($result as $r) {
                array_push($re,$r['description']);
            }
            $this->output->success(array('options' => $re));
        }
    }

    function script($id = '') {
        if ($id == '') {
            echo 'Not found from codesgist.com';
        } else {
            $this->data['c'] = $this->code_m->get($id);
            $content = $this->ve->display('partial/code-content.tpl', $this->data);
            $order = array("\r\n", "\n", "\r");
            $replace = '';
            $content = str_replace($order, $replace, $content);
            $content = str_replace("'", "\\'", $content);
            echo 'document.write(\'' . $content . '\');';
        }
    }

    function tag($tag = '') {
        $this->data['codes'] = $this->code_m->getbytag($tag);
        $this->viewfile = 'code.tpl';
    }

//create new comment
    function comment() {
        if (!isset($_POST['id']) || !$this->input->is_post()) {
            show_404();
        } else {
            $id = $_POST['id'];
            $code = $this->code_m->get($id);
            if (empty($code)) {
                show_404();
            } else {
                $post = $this->input->post();
                if (!isset($code['comments'])) {
                    $code['comments'] = array();
                }
                if (isset($post['comment'])) {
                    if (isset($post['uid'])) {
                        $creator = $post['uid'];
                    } else if (isset($_SESSION['uid'])) {
                        $creator = $_SESSION['uid'];
                    } else {
                        $creator = 'guest-' . $_SERVER['REMOTE_ADDR'];
                    }
                    array_push($code['comments'], array(
                        'id' => Uuid::v4(),
                        'comment' => $post['comment'],
                        'create_time' => time(),
                        'creator' => $creator,
                        'update_time' => time(), 'updator' => $creator
                            )
                    );
                    $this->code_m->save($code);
                }
                redirect(site_url('/code/get/' . $id));
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
            if (isset($_POST['id'])) {
                $code = $this->code_m->get($_POST['id']);
                if (!isset($code['votes'])) {
                    $code['votes'] = array();
                }
                if (isset($_SESSION['uid'])) {
                    $user = $_SESSION['uid'];
                } else {
                    $user = 'guest';
                }
                $data = array('uid' => $user, 'value' => $value);
                array_push($code['votes'], $data);
                $sum = 0.0;
                $count = 0;
                foreach ($code['votes'] as $v) {
                    $count++;
                    $sum += $v['value'];
                }
                $avg = number_format($sum / $count, 2);
                $code['avgvalue'] = $avg;
                $this->code_m->save($code);
            }
            $this->output->success(
                    array('avg' => $avg,
                'number_votes' => $count)
                    //'dec_avg' => 4)
                    , __('vote success'));
        }
    }

    function savecode($id = '') {
        if ($id == '' || !isset($_POST['code'])) {
            show_404();
        } else {
            $code = $this->code_m->get($id);
            if (!empty($code)) {
                $code['code'] = $_POST['code'];
                $this->code_m->save($code);
                redirect(site_url('/code/get/' . $id));
            } else {
                show_404();
            }
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
