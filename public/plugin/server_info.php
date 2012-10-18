<?php

$server_name = $_SERVER['SERVER_NAME'];
$server_port = $_SERVER['SERVER_PORT'];
$index_relative_path = $_SERVER['SCRIPT_NAME'];
//echo $server_root_path;
//$index_path = dirname(dirname(__FILE__));
//echo $index_relative_path;
$vfolder = str_replace('/index.php', '', $index_relative_path);
//echo $vfolder;
$server_host = $server_name. ":" . $server_port . $vfolder;
//echo $server_host;

?>