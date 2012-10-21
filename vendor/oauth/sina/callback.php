<p><?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
                var_dump($token);
	} catch (OAuthException $e) {
            echo $e;
	}
}

if ($token) {
	$_SESSION['token'] = $token;
	setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
?></p>
授权完成,
<a href="weibolist.php">进入你的微博列表页面</a><br />
<a href="fensi.php">获得所有粉丝</a><br />
<?php
} else {
?>
授权失败。
<?php
}
?>
