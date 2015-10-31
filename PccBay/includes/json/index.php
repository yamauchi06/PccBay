<?php
	header("Content-Type: application/json");	
	include_once("../php/_db-config.php");

	$mainJson = array();
	$query='';if(isset($_GET['q'])){$query=$_GET['q'];}
	if(isset($_GET['page'])){
		if($_GET['page']=='products'){ $slq_table = 'pb_post'; $sql = "SELECT * FROM pb_post WHERE type='product'"; }
		if($_GET['page']=='questions'){ $slq_table = 'pb_post'; $sql = "SELECT * FROM pb_post WHERE type='question'";}
		if($_GET['page']=='discussions'){ $slq_table = 'pb_post';  $sql = "SELECT * FROM pb_post WHERE type='discussion'";}
		if($_GET['page']=='comments'){ $slq_table = 'pb_comments';  $sql = "SELECT * FROM pb_comments WHERE post_id='$query' ORDER BY id DESC";}
		if($_GET['page']=='feed'){ $slq_table = 'pb_post';  $sql = "SELECT * FROM pb_post";}
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
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    while($val = $result->fetch_assoc()) {
				
				//pb_product
				if($slq_table=='pb_post'){
					$entity = array(
						'id' => $val['product_id'],
						'type' => $val['type'],
						'user_id' => $val['user_id'],
						'product_info' => json_decode($val['product_info']),
						'trans_info' => json_decode($val['trans_info']),
						'status' => $val['status']
					);
					array_push($mainJson, $entity);
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
					array_push($mainJson, $entity);
				}
				// end pb_safe_image
				
				
				//pb_safe_image
				if($slq_table=='pb_comments'){
					$entity = array(
						'id' => $val['id'],
						'post_id' => $val['post_id'],
						'date' => $val['date'],
						'author' => $val['author'],
						'status' => $val['status'],
						'comment' => $val['comment'],
					);
					array_push($mainJson, $entity);
				}
				// end pb_safe_image
				
		    }
		}
		$conn->close();
		if(empty($mainJson)){
			print json_encode('No query results');
		}else{
			print json_encode($mainJson, JSON_PRETTY_PRINT);
		}
		
		
	}else{
		print json_encode('No data table selected');
	}
?>