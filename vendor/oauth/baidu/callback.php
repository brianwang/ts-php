<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include_once( 'Baidu.php' );
$baidu = new Baidu('GaTUPbTGzKPRL8DrZbjmptKP', 'Yi0GC8YFI0HkSOlpaWReDR5lzuTCZPyp', 
        new BaiduSessionStore('GaTUPbTGzKPRL8DrZbjmptKP'));
//$code = $_GET['code'];
//$accesstoken = $baidu->getAccessTokenByAuthorizationCode($code,'userprofile.php');
//if($accesstoken!= null){
//$_SESSION['token'] = $accesstoken;
$userprofile=$baidu->api('passport/users/getInfo', array('fields' => 'userid,username,sex,birthday'));
var_dump($userprofile);

?></p>
授权完成,
<a href="userprofile.php">进入你的微博列表页面</a><br />
<?php //}else{ 授权失败?>

<?php //}?>