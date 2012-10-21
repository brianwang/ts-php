<?php

class Router {

    private $controller;
    private $action;
    private $moduleName;
    private $params;
    private $controllerName;
    private $segments = array();
    private $uri;
    private $key_val_pairs;
    private $qstring_keys = array();

    function __construct() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $keys = array_keys($_GET); //get URL after '?'
        } else {
            $keys = array_keys($_POST); //get form variables
        }
        $this->uri = $this->_detect_uri();
        $configpath = Config::get('config_path');
        $routefile = BASE_PATH . DIRECTORY_SEPARATOR . $configpath . DIRECTORY_SEPARATOR . 'router.php';
        if (file_exists($routefile)) {
            //Get the router array;
            include $routefile;
        } else {
            die(__('You config file is not exists'));
        }
        /*
         * from top to end matching
         */
        foreach ($router as $key => $value) {
            //format url
            $key = str_replace('/', "\/", $key);
            $result = preg_match('/' . $key . '/', $this->uri, $match);
            //var_dump($result);
            //var_dump($this->uri);
            if (preg_match('/' . $key . '/', $this->uri, $match) == 1) {
                for ($i = 0; $i < count($match); $i++) {
                    $value = str_replace("$" . $i, $match[$i], $value);
                }
                $this->uri = $value;
                break;
            }
        }

        if ($this->uri == '/') {
            $this->controller = Config::get('default_controller');
            $this->action = Config::get('default_action');
        } else {
            $this->segments = explode('/', $this->uri);
            $this->controller = $this->segments[0];
            $this->action = empty($this->segments[1]) ? 'index' : $this->segments[1];
            if (sizeof($this->segments) > 2) {
                $this->params = array_slice($this->segments, 2);
            }
        }
    }

// --------------------------------------------------------------------

    /**
     * Detects the URI
     *
     * This function will detect the URI automatically and fix the query string
     * if necessary.
     *
     * @access	private
     * @return	string
     */
    private function _detect_uri() {
        if (!isset($_SERVER['REQUEST_URI']) OR !isset($_SERVER['SCRIPT_NAME'])) {
            return '';
        }

        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
        } elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
            $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
        }

        // This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
        // URI is found, and also fixes the QUERY_STRING server var and $_GET array.
        if (strncmp($uri, '?/', 2) === 0) {
            $uri = substr($uri, 2);
        }
        $parts = preg_split('#\?#i', $uri, 2);
        $uri = $parts[0];
        if (isset($parts[1])) {
            $_SERVER['QUERY_STRING'] = $parts[1];
            parse_str($_SERVER['QUERY_STRING'], $_GET);
        } else {
            $_SERVER['QUERY_STRING'] = '';
            $_GET = array();
        }

        if ($uri == '/' || empty($uri)) {
            return '/';
        }

        $uri = parse_url($uri, PHP_URL_PATH);

        // Do some final cleaning of the URI and return it
        return str_replace(array('//', '../'), '/', trim($uri, '/'));
    }

    function __construct_set_vars($action, $controller, $moduleName, $params) {
        $this->action = $action;
        $this->controller = $controller;
        $this->moduleName = $moduleName;
        $this->params = $params;
    }

    public function getModuleName() {
        return $this->moduleName;
    }

    public function getAction() {
        return $this->action;
    }

    public function getController() {
        return $this->controller;
    }

    public function getParams() {
        if ($this->params == NULL)
            $this->params = array();
        return $this->params;
    }

    /**
     * @param field_type $params
     */
    public function setParams($params) {
        $this->params = $params;
    }

    /**
     * @param field_type $controllerName
     */
    public function setControllerName($controllerName) {
        $this->controllerName = $controllerName;
    }

}

?>
