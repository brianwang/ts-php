<?php

class Config {

    var $ini_array = array();

    function __construct() {
        $configfile = CONFIG_PATH . '/config.ini';
        if (file_exists($configfile)) {
            $this->ini_array = parse_ini_file($configfile, true);
        } else {
            $filepath = dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.ini";
            if (!file_exists($filepath)) {
                die('Your config file is not exist!');
            } else {
                $this->ini_array = parse_ini_file($filepath, true);
            }
        }
    }

    static function create() {
        static $inst = null;
        if ($inst == null)
            $inst = new Config();
        return $inst;
    }

    public function load($configname) {
        $file = CONFIG_PATH . DIRECTORY_SEPARATOR . $configname . '.php';
        if (defined('CONFIG_PATH') && file_exists($file)) {
            return $file;
        } else {
            die('Your config file' . $file . ' is not exists');
        }
    }

    public static function get($name) {
        if (isset(Config::create()->ini_array[$name])) {
            return Config::create()->ini_array[$name];
        } else {
            die('Your key ' . $name . ' is not in config.ini file');
        }
    }

    public static function DB() {
        $db_array = Config::get('DB');
        return $db_array;
    }

    public static function Mongo($name) {
        $db_array = Config::get('Mongo');
        return $db_array[$name];
    }

    public static function getTimezone() {
        $tz_array = Config::get('Time_Zone');
        return $tz_array['timezone'];
    }

    public static function getAuthenticationConfig() {
        $au_array = Config::get('Authentication');
        return $au_array;
    }

    public static function getMVCKeyword() {
        $mvc_array = Config::get('MVC_Keyword');
        return $mvc_array;
    }

}

?>
