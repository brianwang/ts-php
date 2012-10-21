<?php

require_once dirname(__FILE__) . '/View.php';

class Controller {
    protected $ve;
    protected $viewfile="";
    protected $router;
    protected $data = array();
    /*
     * @Response
     */
    protected $output;
    protected $input;

    // Default model and views according to the controller's name
    function __construct() {
        $this->input = Request::create();
        $this->output = new Response();
        $this->ve = ViewEngine::create();
    }

    public function __get($name) {
        $obj = Loader::load($name);
        return $obj;
    }

    function output() {
        if ($this->viewfile == '') {
            $this->viewfile = $this->router->getController() . '_' . $this->router->getAction() . '.php';
        }
        if (file_exists(APP_PATH . '/views/'.$this->viewfile)) {
            $this->ve->render($this->viewfile, $this->data);
        }
        $this->output->render();
    }

    function setRouter($router) {
        $this->router = $router;
    }

}

?>
