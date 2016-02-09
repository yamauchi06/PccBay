<?php
include_once('../../../MasterPages/overhead.php');

require_once 'src/autoload.php';

  
$fb = new Facebook\Facebook([
	'app_id' => '880654705336638',
	'app_secret' => 'e0f24d02ced5ae98077123f06ca04ace',
	'default_graph_version' => 'v2.5',
]);

$redirect = 'http://'.$_SERVER["HTTP_HOST"].'/includes/php/fbapp/login-callback.php';
if(isset($_GET['redirect_on_login'])){
	$redirect = $redirect.'?redirect_on_login='.urlencode($_GET['redirect_on_login']);
}

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'public_profile']; // optional
$loginUrl = $helper->getLoginUrl($redirect, $permissions);


if(isset($_GET['ext'])){
	header('Location: '.$loginUrl);
}else{
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}

  
?>