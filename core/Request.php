<?php

class Request {
    
    protected $get;
    protected $post;
    public function __construct() {
        $this->get= $_GET;
        $this->post =$_POST;
    }
    
    public function get(){
        return $this->get;
    }
    public function post(){
       return $this->post;
    }
    public static function create(){
        static $inst=NULL;
        if($inst == NULL)
            $inst = new Request ();
        return $inst;
    }
    public function is_ajax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

}