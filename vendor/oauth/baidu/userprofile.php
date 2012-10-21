<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once( 'Baidu.php' );
$baidu = new Baidu('GaTUPbTGzKPRL8DrZbjmptKP', 'Yi0GC8YFI0HkSOlpaWReDR5lzuTCZPyp', 
        new BaiduSessionStore('GaTUPbTGzKPRL8DrZbjmptKP'));
//$token = $_SESSION['token'];
//例如：获取用户的个人资料
$userprofile=$baidu->api('passport/users/getInfo', array('fields' => 'userid,username,sex,birthday'));
var_dump($userprofile);
?>
