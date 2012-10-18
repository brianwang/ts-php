<?php

class Config {

    var $ini_array = array();

    function __construct() {

        $filepath = dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.ini";
        if (!file_exists($filepath)) {
            die('Your config file is not exist!');
        } else {
            $this->ini_array = parse_ini_file("config.ini", true);
        }
    }

    static function create() {
        static $inst = null;
        if ($inst == null)
            $inst = new Config();
        return $inst;
    }

    public static function get($name) {
        return Config::create()->ini_array[$name];
    }

    public static function DB() {
        $db_array = Config::create()->ini_array['DB'];
        return $db_array;
    }
   public static function Mongo($name) {
        $db_array =Config::create()->ini_array['Mongo'];
        return $db_array[$name];
    }
    public static function getTimezone() {
        $tz_array = Config::create()->ini_array['Time_Zone'];
        return $tz_array['timezone'];
    }

    public static function getAuthenticationConfig() {
        $au_array = Config::create()->ini_array['Authentication'];
        return $au_array;
    }

    public static function getMVCKeyword() {
        $mvc_array = Config::create()->ini_array['MVC_Keyword'];
        return $mvc_array;
    }

}

?>
