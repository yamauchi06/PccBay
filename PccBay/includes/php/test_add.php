<?php
	//header("Content-Type: application/json");
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	date_default_timezone_set('America/Chicago');
	
	include('commonFunctions.php');

/*
	$tk = pb_time("token:new", array( 'expire'=>"+59 seconds", 'key' => '91621871872415724817581275'));
print $tk.'<br />';
*/
	print pb_time("token", array(
		'key' => '91621871872415724817581275',
		'token'=>"TkUrdnQ4QkJPVlN0ZzRVaEVESU5hS0NXUlN0QzV3alJib2R1YmVxSjZoLzAzcFU2ZmpBL2VFUGZ4NVc5QUZpM2UwYVJKNEJnaTdtQTYvZitqdC9PaThoY0drYXdOd2pJZDYrcGtmMi8wSGRWeGcxUGV2VGFPcm5UeENvSzVCQ3JBRndCakZWbG9BdkdyNDhldzU2TnJnPT0"
	));
	
?>