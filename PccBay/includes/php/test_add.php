<?php
header("Content-Type: application/json");	
include_once("commonFunctions.php");


	print pb_json_feed();
	
	
/*
foreach ($json as $key => $val) {
					//print $json[0]->product_info;
				}
*/


?>