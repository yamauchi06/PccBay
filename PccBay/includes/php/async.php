<?php
	session_name('com_pccbay_user');
	session_start('');
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/php/commonFunctions.php');
	$_GET['function']($_SESSION['user_id']);
	
	
	
	if(isset($_GET['redirect'])){
		$redirect = $_GET['redirect'];
		if($redirect=='[current]'){
			$redirect=$_SERVER["HTTP_REFERER"];
		}
		header('Location: '.$redirect);
	}
?>