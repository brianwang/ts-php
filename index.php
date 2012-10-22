<?php

define('BASE_PATH', dirname(__FILE__));
define('BASEPATH', BASE_PATH);
define('APP_PATH', BASE_PATH . '/app');
define('LANG_PATH', BASE_PATH . '/lang');
define('SYS_PATH', BASE_PATH . '/core');
define('TMP_PATH', BASE_PATH . '/tmp');
define('VENDOR_PATH', BASE_PATH . '/vendor');
define('PUBLIC_PATH', BASE_PATH . '/public');
include("core/Ini.php");
$config = Config::get('config_path');
if ($config != NULL) {
    define('CONFIG_PATH', BASE_PATH . DIRECTORY_SEPARATOR . $config);
} else {
    define('CONFIG_PATH', BASE_PATH . '/config');
}
session_start();
$userid = session_id();
$users = Memcache::create()->get('onlineusers');
if (empty($users)) {
    $users = $userid . ',';
} else {
    if (strstr($users, $userid) == FALSE) {
        $users .=$userid . ',';
    }
}
Memcache::create()->save('onlineusers', $users);
$router = Loader::load("Router");
$filter = new Filter($router);
$filter->input();
Dispatcher::dispatch($router);
$filter->output();
?>