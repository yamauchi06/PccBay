<?php
	//header("Content-Type: application/json");
	//Start User Session
	session_name('com_pccbay_user');
	session_start('');
	
	date_default_timezone_set('America/Chicago');
	
	include('commonFunctions.php');

	print pb_is_image('http://pccbay.localhost/?safe_image=2015_26_10:d15bddd1c93a813bf605e17acdbbfa36Z5iPPwi06S.jpg:U1dSVXNlMFJEa2t1Wmp0M3BFQ1ZZNmMvbEs1cEY0blFjeGNQQzZ3ZTR3Yz0=&day_code=dmJYUnU4OXlnaXozMXpvRGE0SWF4UlJWdE4zZFZySGxkdUpDc0ducnZZSmE3Y0lMbHJSSy9QSUpKRXdGS0I4cDN5ZURvWFVkTlBqODVvUThITmEzejUvNFdKOVAzVlhmdWZWZTJIS2RZY1ROZVQrZXpSbXdUaVRyY1JBa084SzI0c1E1YXU4SUZqQUZsQmNIeFM5ZDFRPT0');
?>