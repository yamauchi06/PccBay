<?php
	header("Content-Type: application/json");
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	include('commonFunctions.php');
	//print pb_og('comments', '10');
	
	//print pb_is_allowed('50');
	
	print pb_user()->utid;
?>