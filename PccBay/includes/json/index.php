<?php
	header("Content-Type: application/json");	
	include_once("../php/_db-config.php");

	$mainJson = array();
	
	if(isset($_GET['page'])){
		if($_GET['page']=='products'){ $slq_table = 'pb_post'; }
		if($_GET['page']=='questions'){ $slq_table = 'pb_questions'; }
		if($_GET['page']=='topics'){ $slq_table = 'pb_topics'; }
		if($_GET['page']=='users'){ $slq_table = 'pb_users'; }
		if($_GET['page']=='images'){ $slq_table = 'pb_safe_image'; }
	}else{
		array_push($mainJson, 'Query not defined');
	}

	
	if(!empty($slq_table)){
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM $slq_table";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    while($val = $result->fetch_assoc()) {
			    
			    //pb_product
				if($slq_table=='pb_product'){
					$entity = array(
						'id' => $val['product_id'],
						'author_id' => $val['user_id'],
						'product_info' => json_decode($val['product_info']),
						'trans_info' => json_decode($val['trans_info']),
						'status' => $val['status']
					);
				}
				// end pb_product
				
				 //pb_safe_image
				if($slq_table=='pb_safe_image'){
					$entity = array(
						'id' => $val['id'],
						'uid' => $val['uid'],
						'size' => $val['size'],
						'type' => $val['type'],
						'date' => $val['date'],
						'author' => $val['author'],
						'file' => $val['file'],
						'path' => $val['string'],
					);
				}
				// end pb_safe_image
				
				
				array_push($mainJson, $entity);
		    }
		}
		$conn->close();
	}

	print json_encode($mainJson, JSON_PRETTY_PRINT);
?>