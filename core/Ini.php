<?php

function getDirectoryFromDir($dir) {
    $dir_array = array();
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (is_dir($dir . '/' . $file)) {
                    $dir_array[] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $dir_array;
}
$include_path = BASE_PATH .'/core';
$include_path .=PATH_SEPARATOR . BASE_PATH. "/core/filters";
$include_path .=PATH_SEPARATOR . BASE_PATH. "/core/cache";
$include_path .=PATH_SEPARATOR . BASE_PATH. "/core/helpers";
$include_path .=PATH_SEPARATOR . BASE_PATH. "/core/db";
$include_path .=PATH_SEPARATOR . BASE_PATH. "/core/db/drivers";
$include_path .=PATH_SEPARATOR . BASE_PATH. "/app/controllers";
$include_path .=PATH_SEPARATOR . BASE_PATH. "/app/models";
$include_path .=PATH_SEPARATOR . BASE_PATH. "/app/views";
 
//echo $include_path .'<br>';
set_include_path(get_include_path(). PATH_SEPARATOR. $include_path);
//set_include_path(get_include_path() . PATH_SEPARATOR . "core/filters");
//set_include_path(get_include_path() . PATH_SEPARATOR . "core/cache");
//set_include_path(get_include_path() . PATH_SEPARATOR . "core/helpers");
//set_include_path(get_include_path() . PATH_SEPARATOR . "core/lib");
//set_include_path(get_include_path() . PATH_SEPARATOR . "app/controllers");
//set_include_path(get_include_path() . PATH_SEPARATOR . "app/models");
//set_include_path(get_include_path() . PATH_SEPARATOR . "app/views");

//echo get_include_path();
//set_include_path � Sets the include_path configuration option
spl_autoload_register(function ($object) {
    #$object = ucwords($object);
    if(strtolower(substr($object,0,7)) ==='smarty_'){
        $object = strtolower($object);
    }
    require_once("{$object}.php");
    
    #include 'classes/' . $class . '.class.php';
});
include_once SYS_PATH . '/Common.php';
require_once SYS_PATH . '/I18n.php';
require_once SYS_PATH . '/helpers/url_helper.php';
require_once SYS_PATH . '/helpers/i18n_helper.php';
//set module paths
$dir = "modules";
$dir_array = getDirectoryFromDir($dir);

foreach ($dir_array as $dir) {
    set_include_path(get_include_path() . PATH_SEPARATOR . "modules" . "/" . $dir . "/controllers");
    set_include_path(get_include_path() . PATH_SEPARATOR . "modules" . "/" . $dir . "/models");
    set_include_path(get_include_path() . PATH_SEPARATOR . "modules" . "/" . $dir . "/views");
}

//set time zone
date_default_timezone_set(Config::getTimezone());
