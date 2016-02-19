<?php
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	//Set Default Timezone
	date_default_timezone_set('America/Chicago');
	
	//Chrome Etention
	if(isset($_GET['ChromeExtention'])){
		session_destroy();
		session_name('com_pccbay_user_chrome_extention');
		session_start('');
		define('CHROME_APP', true);
	}else{ define('CHROME_APP', false); }
	
	//Check if in Sandbox
	if($_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['HTTP_HOST']=='pccbay.localhost'){
		define('DOCUMENT_ROOT_EXT', '/');
		define('FACEBOOK_APPID', '930171573718284');
		define('FACEBOOK_SECRET', '79c1b4d6a1da00d97247ee74294a4b03');
	}
	else if($_SERVER['HTTP_HOST']=='test.pccbay.com'){
		define('DOCUMENT_ROOT_EXT', '/sites/pccbay_test');
		define('FACEBOOK_APPID', '880654705336638');
		define('FACEBOOK_SECRET', 'e0f24d02ced5ae98077123f06ca04ace');
	}
	else{
		define('DOCUMENT_ROOT_EXT', '/sites/pccbay');
		define('FACEBOOK_APPID', '880654705336638');
		define('FACEBOOK_SECRET', 'e0f24d02ced5ae98077123f06ca04ace');
	}
	
	//Process Images
	if(isset($_GET['safe_image'])){ include('i.php'); exit; }
	
	//Begin the inludes
	include_once($_SERVER['DOCUMENT_ROOT'].DOCUMENT_ROOT_EXT.'/includes/php/commonFunctions.php');	
	
	//Day Code
	define('DAY_LOAD_CODE', md5(date('MdY')).sha1(date('MdY')));
	
	//Set Page Load Code
	define('PAGE_LOAD_CODE', rand_str('mixed', 20));
?>