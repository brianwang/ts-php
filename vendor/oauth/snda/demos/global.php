<?php
require_once dirname(__FILE__).'/../GrandCloudStorage.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Shanghai');

define('GRAND_CLOUD_HOST', 'http://storage.grandcloud.cn');

define('ACCESS_KEY', 'is6wvc3far60kisio'); // 请在此处输入您的AccessKey
define('ACCESS_SECRET', 'OGZjZGQ2MWRlYjY3OWY1NWY2MmUyYjY0OTI2YmYxYTA='); // 请在此处输入您的AccessSecret


function success($message, $data=null) {
    $dt = date('c');
    
    if ($data === null) {
        echo "[{$dt}] - {$message}\n\n";
    } else {
        echo "[{$dt}] - {$message} => ";
        print_r($data);
        echo "\n";
    }
}

function exception($message, $e) {
    $dt = date('c');
    $space = str_pad('', (strlen("[{$dt}] - ") - strlen("[Errno] - ")));
    
    echo "[{$dt}] - {$message}\n";
    echo "{$space}[Errno] - " . $e->getCode() . "\n";
    echo "{$space}[Error] - " . $e->getMessage() . "\n\n";
}

// 实例化GrandCloudStorage对象	
$storage = new GrandCloudStorage(GRAND_CLOUD_HOST);

// 设定access_key 和 access_secret
$storage->set_key_secret(ACCESS_KEY, ACCESS_SECRET);

