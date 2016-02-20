<?php
	header("Content-Type: application/json");
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	date_default_timezone_set('America/Chicago');
	
	include('commonFunctions.php');

	print_r( pb_user() )
?>