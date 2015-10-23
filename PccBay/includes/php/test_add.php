<?php
header("Content-Type: application/json");	
include_once("commonFunctions.php");


	$product_info = array();
		array_push($product_info, array(
<<<<<<< Updated upstream
			'timestamp'=>'mm/dd/yyyy',
			'title'=>'test Item',
			'desc'=>'this is cool',
			'tags'=>'["tag1","tag2","tag3","tag4","tag5"]',
			'price'=>'$1.00'
=======
			"timestamp" => "".date("F j, Y, g:i a")."",
			"title"     => "".$_POST['product_title']."",
			"desc"      => "".$_POST['product_desc']."",
			"tags"      => "".$_POST['product_tags']."",
			"price"     => "".$_POST['product_price']."",
			"condition" => "".$_POST['condition'].""
>>>>>>> Stashed changes
		));
		
   $product_info = json_encode($product_info);
   
   $trans_info = array();
      array_push($trans_info, array(
         "completed" => 0,
         "method"    => 0,
         "sold_to"   => 0,
         "date_sold" => 0
      ));
		
	$trans_info = json_encode($trans_info);
	
	print_r($product_info);


?>