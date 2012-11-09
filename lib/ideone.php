<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ideone
 *
 * @author brian
 */
class ideone {

    //put your code here
    public static function create() {
        static $inst = NULL;
        if ($inst == NULL)
            $inst = new ideone();
        return $inst;
    }

    public function callmethod($method = '', $params = array()) {
        if ($method == '') {
            die('you can\' call no method name');
        } else {
            try {
                array_splice($params, 0, 0, array('brianwang', 'ideonepublic'));
                $client = @new SoapClient('http://ideone.com/api/1/service.wsdl');
                $result = call_user_func_array(array($client, $method), $params);
                if (defined(DEBUG)) {
                    var_dump($result);
                }
                return $result;
            } catch (SoapFault $E) {
                echo $E->faultstring;
            }
        }
    }

    public static function getlanguages() {
        $result = ideone::create()->callmethod(
                'getLanguages');
        return $result;
    }

    public static function createSubmission($sourcecode = '', 
            $language, 
            $input, $run = FALSE, $private = false) {
        $result = ideone::create()->callmethod(
                'createSubmission', array($sourcecode, $language, $input, $run, $private));
        $err = $result['error'];
        if ($err == 'OK') {
            return $result;
        } else {
            die($err);
        }
    }

    /**
     * status specifies stage of program's execution. It's values should be interpreted in 
      the following way:
      Value Meaning
      < 0 waiting for compilation – the paste awaits
      execution in the queue
      0 done – the program has finished
      1 compilation – the program is being
      compiled
      3 running – the program is being executed

     * @param type $linkid
     * @return type 
     */
    public static function getSubmissionStatus($linkid) {
        $result = ideone::create()->callmethod(
                'getSubmissionStatus', array($linkid));
        return ideone::create()->checkerror($result);
    }

    public function checkerror($result) {
        if (array_key_exists('error', $result)) {
            $err = $result['error'];
            if ($err < 0) {
                $this->output->error('waiting for compilation');
            } else if ($err == 0) {
                return $result;
            } else if ($err == 1) {
                $this->output->error('compilation');
            } else if ($err == 3) {
                $this->output->error('running');
            }
        }
    }

    public static function getSubmissionDetails($link, $withSource = true, $withInput = true, $withOutput = true, $withStderr = true, $withCmpinfo = true) {
        $result = ideone::create()->callmethod(
                'getSubmissionDetails', array($link, $withSource,
            $withInput, $withOutput, $withStderr, $withCmpinfo));
        return ideone::create()->checkerror($result);
    }

}

?>
