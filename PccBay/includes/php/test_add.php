<?php
	include('commonFunctions.php');
	
	$tagArr = array();
	
	
	print domain();
	
/*
	function pb_add_tag($tag, $count){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $_POST;
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
			
		$sql = "INSERT INTO pb_tags (tag, count) VALUES ('$tag', '$count')";
		
		if ($conn->query($sql) === TRUE) {
			//print 'done';
		} else {
		    echo "Error updating record: " . $conn->error;
		}
		$conn->close();
	}
	
	
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT * FROM pb_post";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($val = $result->fetch_assoc()) {
		    
		    $product_info = json_decode($val['product_info']);
			foreach($product_info as $entity){
				$val['categories'] = $entity->tags;
			}
			
			$cats = explode(',', $val['categories']);
			if(count($cats) >= 1){
				foreach ($cats as $index => $tag) {
					array_push($tagArr, strtolower($tag));
				}
			}

	    }
	}
	$conn->close();
	
	$counts = array_count_values($tagArr);
	foreach ($counts as $tag => $count) {
		pb_add_tag($tag, $count);
	}
*/
	
	
	
	
?>