<?php

class Response {

    protected $finaloutput;

    public function json($result, $message = '', $status = 200) {
        set_status_header($status);
        if (Request::create()->is_ajax()) {
            header('Content-Type:application/json');
            $d = array('result' => $result, 
                'code' => $status, 
                'message' => $message);
            $this->set_content(json_encode($d));
        } else {
            echo $result;
        }
    }

    public function success($result, $message) {
        $this->json($result, $message, 200);
    }

    public function set_content($content) {
        $this->finaloutput = $content;
    }

    public function append_content($content) {
        $this->finaloutput .=$content;
    }

    public function render() {
        ob_start();
        echo $this->finaloutput;
        ob_end_flush();
    }

    public function show404() {
        set_status_header(404);
    }

    public function show_error($error) {
        set_status_header(505);
        echo $error;
    }

}