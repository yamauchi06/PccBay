<?php
	header("Content-Type: application/json");
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	include('commonFunctions.php');

	$user_feed=pb_switch( json_decode( pb_og('feed', $_SESSION['user_id']) ) );
	foreach($user_feed as $post){
		print $post->type;
	}
	
?>