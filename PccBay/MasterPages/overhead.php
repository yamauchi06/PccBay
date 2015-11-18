<?php
	session_name('com_pccbay_user');
	session_start('');
	
	date_default_timezone_set('America/Chicago');
	
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/php/_db-config.php');
	
	include_once($_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.'/includes/php/commonFunctions.php');
?>