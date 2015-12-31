<?php
	$localhost = false;
	$domain = gethostbyname($_SERVER['HTTP_HOST']);
	$whitelist = array(
	    '127.0.0.1',
	    '::1',
	    'localhost'
	);
	if(in_array($domain, $whitelist)){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "PccBay";
		
		$servername_ops = "68.178.143.18";
		$username_ops = "PccBay";
		$password_ops = "Pcc@C0nnect02";
		$dbname_ops = "PccBay";
		
		$docRootEXT = '';
		
		$localhost=true;
	}else{
		$servername = "68.178.143.18";
		$username = "PccBay";
		$password = "Pcc@C0nnect02";
		$dbname = "PccBay";
		
		$servername_ops = "localhost";
		$username_ops = "root";
		$password_ops = "";
		$dbname_ops = "PccBay";
		
		$docRootEXT = '/sites/pccbay_test';
		
		$localhost=false;
	}
	
	define('DB_HOSTNAME', $servername);
	
	define('DB_USERNAME', $username);
	
	define('DB_PASSWORD', $password);
	
	define('DB_NAME', $dbname);
	
	define('OG_APPID', '9827354187582375129873');
	
	define('OG_APPSECRET', '712638715312875');
	
	define('OG_APP', OG_APPID.':'.OG_APPSECRET);
?>