<?php
	session_name('com_pccbay_user');
	session_start('');
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/php/commonFunctions.php');
	if(isset($_GET['params'])){
		$ps=explode(',', $_GET['params']);
		$_GET['function']($ps[0], $ps[1]);
	}else{
		$_GET['function']($_SESSION['user_id']);
	}
	
	
	
	if(isset($_GET['redirect'])){
		$redirect = $_GET['redirect'];
		if($redirect=='[current]'){
			$redirect=$_SERVER["HTTP_REFERER"];
		}
		header('Location: '.$redirect);
	}
?>