<?php
	header("Content-Type: application/json");
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	include('commonFunctions.php');

	$user=pb_db("SELECT * FROM pb_users WHERE username='JoshFerguson'", true);
	print_r($user);
	
?>