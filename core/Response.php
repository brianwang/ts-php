<?php

class Response {
    protected $finaloutput;
    public function json($body) {
        if (Request::create()->is_ajax()) {
            header('Content-Type:application/json');
            $this->set_content(json_encode($body));
        }
    }

    public function set_content($content) {
        $this->finaloutput = $content;
    }
    public function append_content($content){
        $this->finaloutput .=$content;
    }
    
    public function render(){
        ob_start();
        echo $this->finaloutput;
        ob_end_flush();
    }
    
    public function show404(){
        header('');
        
    }
    
     public function show_error($error){
         echo $error;
    }
}