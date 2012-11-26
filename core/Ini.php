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

function getFilesFromDir($dir) {
    $dir_array = array();
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (is_file($dir . '/' . $file)) {
                    $dir_array[] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $dir_array;
}


$include_path = BASE_PATH . '/core';
$include_path .=PATH_SEPARATOR . BASE_PATH . "/core/filters";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/core/cache";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/core/helpers";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/core/db";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/core/lib";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/core/db/drivers";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/app/controllers";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/app/models";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/app/views";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/lib/filters";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/lib/helpers";
$include_path .=PATH_SEPARATOR . BASE_PATH . "/lib";
set_include_path(get_include_path() . PATH_SEPARATOR . $include_path);
//set module paths
$dir = "modules";
$dir_array = getDirectoryFromDir($dir);

foreach ($dir_array as $dir) {
    set_include_path(get_include_path() . PATH_SEPARATOR . "modules" . "/" . $dir . "/controllers");
    set_include_path(get_include_path() . PATH_SEPARATOR . "modules" . "/" . $dir . "/models");
    set_include_path(get_include_path() . PATH_SEPARATOR . "modules" . "/" . $dir . "/views");
}

/*
 * autoload function 
 */
spl_autoload_register(function ($object) {
            #$object = ucwords($object);
            //fix for smarty
            if (strtolower(substr($object, 0, 7)) === 'smarty_') {
                $object = strtolower($object);
            }
            require_once("{$object}.php");
        });
include_once SYS_PATH . '/Common.php';
require_once SYS_PATH . '/I18n.php';
$dir_array = getFilesFromDir(SYS_PATH . '/helpers');
foreach ($dir_array as $dir) {
    require_once SYS_PATH . '/helpers/' . $dir;
}
//require_once SYS_PATH . '/helpers/url_helper.php';
//require_once SYS_PATH . '/helpers/cache_helper.php';
//require_once SYS_PATH . '/helpers/output_helper.php';
//require_once SYS_PATH . '/helpers/i18n_helper.php';

//set time zone
date_default_timezone_set(Config::getTimezone());
