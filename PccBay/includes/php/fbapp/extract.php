<?php
include_once('../../../MasterPages/overhead.php');

$accessTokens = array(
	"short" => $_SESSION['facebook_access_token'],
	"long" => $_SESSION['facebook_access_token_long_term']
);
	
require_once 'src/autoload.php';
 
$fb = new Facebook\Facebook([
	'app_id' => FACEBOOK_APPID,
	'app_secret' => FACEBOOK_SECRET,
	'default_graph_version' => 'v2.5',
	'cookie' => true,
]);

// Sets the default fallback access token so we don't have to pass it to each request
$fb->setDefaultAccessToken( $accessTokens['short'] );

try {
	$response = $fb->get('/me?fields=id,name,first_name,last_name,age_range,link,gender,locale,picture.width(500).height(500),timezone,updated_time,verified,email', 	$accessTokens['short']);
	$user = $response->getGraphUser();
	
	$today = date("m/d/y");
	if($user){
		$user_id = pb_db("SELECT user_id FROM pb_users WHERE user_id = '$user[id]'", true);
		//Create User
		if(empty($user_id)){
			$user_id = $user['id'];
			$username = pb_new_row('pb_users', 'username', $user['first_name'].$user['last_name']);
			
			$contact_info = '[{"resident":"true","building":"","room":"","phone":"","email":"'.$user['email'].'","notify_d":"true","notify_m":"true"}]';
			$user_data = '[{"ID":"'.$user_id.'","username":"'.$username.'","name":"'.$user['first_name'].' '.$user['last_name'].'","avatar":"'.$user['picture']['url'].'","registered":"'.$today.'","permissions":"25","theme":"darkblue","interest":""}]';
			
			$sql = pb_db("INSERT INTO pb_users (user_id, username, num_of_ratings, total_ratings, permissions, id_card_key, contact_info, user_data, steps)
			VALUES ('$user_id', '$username', '0', '0', '25', '', '$contact_info', '$user_data', '')");
			if($sql){
				$_SESSION['user_id'] = $user_id;
				header('Location: '.$_GET['redirect_on_login']);
			}else{
				print 'No sql';
			}
		}else{
			$_SESSION['user_id'] = $user_id->user_id; $user_id=$user_id->user_id;
			
			$contact_info = array();
	  		array_push($contact_info, array(
	  			"resident"  => pb_user()->resident,
	  			"building"  => pb_user()->building,
	  			"room"      => pb_user()->room,
	  			"phone"     => pb_user()->phone,
	  			"email"     => $user['email'],
	  			"notify_d"  => pb_user()->notify_d,
	  			"notify_m"  => pb_user()->notify_m
	  		));
	        $contact_info = json_encode($contact_info);
	        
	        $user_data = array();
	  		array_push($user_data, array(
	  			"ID"          => $user_id,
	  			"username"    => pb_user()->username,
	  			"name"        => $user['first_name'].' '.$user['last_name'],
	  			"avatar"      => $user['picture']['url'],
	  			"registered"  => pb_user()->registered,
	  			"permissions" => pb_user()->permissions,
	  			"theme"       => pb_user()->theme,
	  			"interest"    => pb_user()->interest,
	  		));
	        $user_data = json_encode($user_data);
	        
			pb_db("UPDATE pb_users SET contact_info='$contact_info', user_data='$user_data' WHERE user_id='$user_id'");
			
			header('Location: '.$_GET['redirect_on_login']);
		}
	}else{
		print 'No user';
	}
  
  
  
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
	
?>