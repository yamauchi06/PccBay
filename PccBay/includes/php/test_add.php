<?php
	header("Content-Type: application/json");
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	include('commonFunctions.php');

	
	print pb_reactivate_post('17');
	
?>