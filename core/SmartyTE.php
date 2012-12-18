<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmartyTE
 *
 * @author brian
 */
class SmartyTE extends TemplateEngine {

    protected $smarty;

    function __construct() {
        define('SMARTY_DIR', dirname(__FILE__) . '/../vendor/smarty/');
        set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_DIR);
        set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_DIR . 'plugins');
        set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_DIR . 'sysplugins');

        //ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . SMARTY_DIR);
        require_once(SMARTY_DIR . 'SmartyBC.class.php');
        $this->smarty = new Smarty();
        $this->smarty->caching = 0;
        $this->smarty->force_compile = true;
        $this->smarty->setTemplateDir(APP_PATH . '/views');
        $this->smarty->setCompileDir(TMP_PATH . '/templates_c/');
        $this->smarty->setCacheDir(TMP_PATH . '/cache/');
    }

    public function render($filename='', $data = array()) {
        $this->smarty->assign($data);
        $this->smarty->display($filename);
    }

    public function display($filename='', $data = array()) {
        $this->smarty->assign($data);
        return $this->smarty->fetch($filename);
    }

}

?>
