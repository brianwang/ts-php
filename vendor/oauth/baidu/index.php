<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require('Baidu.php');
//new BaiduCookieStore('API_KEY') 这个是存储access token的类，采用COOKIE方式存储
//括号中的API_KEY这个是存储数据时的key(键)值。可以换成其他的
//例如：new BaiduCookieStore('BAIDU_OAUTH20')
//$baidu = new Baidu('API_KEY', 'SECRET_KEY', new BaiduCookieStore('API_KEY'));
//采用MEMCACHE方式存储
//需要安装memcache，并且需要PHP扩展支持memcache
//$baidu = new Baidu('API_KEY', 'SECRET_KEY', new BaiduMemcachedStore('API_KEY'));
 
//采用SESSION方式存储，一台服务器可以考虑。
$baidu = new Baidu('GaTUPbTGzKPRL8DrZbjmptKP', 'Yi0GC8YFI0HkSOlpaWReDR5lzuTCZPyp', 
        new BaiduSessionStore('GaTUPbTGzKPRL8DrZbjmptKP'));
//构造授权地址直接调用方法getLoginUrl()，回调地址默认是当前地址。
$url = $baidu->getLoginUrl(array('response_type' => 'code',
    'redirect_uri' => 'http://lo/liboauth/baidu/callback.php'));
//$token = $baidu->getAccessToken(); 
//echo $token;
//echo $url;
?>

    <a href="<?php echo $url;?>"><img src="baidu.gif" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a>
