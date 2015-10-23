<?php
header('Content-Type: application/json');	
include_once('commonFunctions.php');


	$product_info = array();
	
		array_push($product_info, array(
			'timestamp'=>'mm/dd/yyyy',
			'title'=>'test Item',
			'desc'=>'this is cool',
			'tags'=>'["tag1","tag2","tag3","tag4","tag5"]',
			'price'=>'$1.00'
		));
		
		$product_info = json_encode($product_info);
	
	print_r($product_info);


?>