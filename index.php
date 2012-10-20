<?php
define('BASE_PATH' ,dirname(__FILE__));
define('BASEPATH' ,BASE_PATH);
define('CONFIG_PATH' ,BASE_PATH . '/config');
define('APP_PATH' ,BASE_PATH.'/app');
define('LANG_PATH' ,BASE_PATH.'/lang');
define('SYS_PATH' ,BASE_PATH.'/core');
define('TMP_PATH' ,BASE_PATH.'/tmp');
define('VENDOR_PATH' ,BASE_PATH.'/vendor');
define('PUBLIC_PATH',BASE_PATH.'/public');
include("core/Ini.php");
session_start();
$router = Loader::load("Router");
$filter= new Filter($router);
$filter->input();
Dispatcher::dispatch($router);
$filter->output();

?>