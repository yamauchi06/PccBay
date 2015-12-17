<?php
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	//Chrome Etention
	if(isset($_GET['ChromeExtention'])){
		session_destroy();
		session_name('com_pccbay_user_chrome_extention');
		session_start('');
		define('CHROME_APP', true);
	}else{ define('CHROME_APP', false); }
		
	
	//Set Default Timezone
	date_default_timezone_set('America/Chicago');
	
	/* Localhost :: pccbay.localhost */ 
		define('DOCUMENT_ROOT_EXT', '/');
		
	/* Test :: test.pccbay.com */ 
		//define('DOCUMENT_ROOT_EXT', '/sites/pccbay_test');
		
	/* Live :: wwww.pccbay.com */ 
		//define('DOCUMENT_ROOT_EXT', '/sites/pccbay');
	
	//Begin the inludes
	include_once($_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.'/includes/php/commonFunctions.php');
	
?>