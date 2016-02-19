<?php
include_once('../../../MasterPages/overhead.php');	
require_once 'src/autoload.php';
 
$fb = new Facebook\Facebook([
	'app_id' => FACEBOOK_APPID,
	'app_secret' => FACEBOOK_SECRET,
	'default_graph_version' => 'v2.5',
	'cookie' => true,
]);
	
$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
  if (isset($accessToken)) {
		// Logged in!
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
		// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken( $_SESSION['facebook_access_token'] );
		$_SESSION['facebook_access_token_long_term'] = $longLivedAccessToken;
		if(isset( $_SESSION['facebook_access_token_long_term'] ) && isset( $_SESSION['facebook_access_token'] )){
			header('Location: extract.php?redirect_on_login='.$_GET['redirect_on_login']);
		}
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  header('Location: ui.php?t=ERROR&e='.urlencode($e->getMessage()));
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  header('Location: ui.php?t=ERROR&e='.urlencode($e->getMessage()));
  exit;
}	
?>