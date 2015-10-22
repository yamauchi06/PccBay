<?php
header('Content-Type: application/json');	
include_once('commonFunctions.php');


	$product_info = array();
		array_push($product_info, array('timestamp'=>'10/21/2015'));
		
		$product_info = json_encode($product_info);
	
	print_r($product_info);


?>