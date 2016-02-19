<?php
include_once('../../../MasterPages/overhead.php');

require_once 'src/autoload.php';

  
$fb = new Facebook\Facebook(array(
	'app_id' => FACEBOOK_APPID,
	'app_secret' => FACEBOOK_SECRET,
	'default_graph_version' => 'v2.5',
	'cookie' => true,
));

$redirect = 'http://'.$_SERVER["HTTP_HOST"].'/includes/php/fbapp/login-callback.php';
if(isset($_GET['redirect_on_login'])){
	$redirect = $redirect.'?redirect_on_login='.urlencode($_GET['redirect_on_login']);
}

$helper = $fb->getRedirectLoginHelper();
$permissions = array('email', 'public_profile'); // optional
$loginUrl = $helper->getLoginUrl($redirect, $permissions);


if(isset($_GET['ext'])){
	header('Location: '.$loginUrl);
}else{
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}

  
?>