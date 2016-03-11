<?php
	$mainJson=array();
	$mainJson_ordered=array();
	
	function masterOrder($type){
		$key = array_search(strtolower($type), array(
			//Order that results will be posted.
			//All must be lowercase
			"user", 
			"product", 
			"question", 
			"service", 
			"faq", 
			"tag"
		));
		return $key;
	}
	
	//Set Query
	if(isset($_GET['q'])){
		$slq_table = "true";
		$query=urldecode($_GET['q']);
	}else{
		array_push($mainJson, 'Query not defined'); }
		
	//Run Query	
	if(!empty($slq_table)){
			
			//pb_post
			$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT product_id, type, status, product_info FROM pb_post WHERE product_info LIKE '%$query%' LIMIT 200";
			$result = $conn->query($sql);
			if(is_object($result)){
				if ($result->num_rows > 0) {
				    while($val = $result->fetch_assoc()) {
					    $info='';
					    $title='';
					    foreach(json_decode($val['product_info']) as $data){
						    $info .= $data->title;
						    $info .= str_replace(',', '', $data->tags);
						    //$info .= ' '.strip_tags($data->desc);
						    $title = $data->title;
						    $images = explode(',', $data->images)[0];
					    }
					    $img=pb_table_data('pb_safe_image', 'string', "uid='$images'");
						$entity = array(
							'id' => $val['product_id'],
							'type' => strtolower($val['type']),
							'title' => $title,
							'image' => $img,
							'info' => strtolower($info),
							'small' => '',
							'status' => strtolower($val['status'])
						);
						array_push($mainJson, $entity);
				    }
				}
			}
			$conn->close();

			//pb_users
			$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT user_data, user_id FROM pb_users WHERE (username LIKE '%$query%' OR user_data LIKE '%$query%')";
			$result = $conn->query($sql);
			if(is_object($result)){
				if ($result->num_rows > 0) {
				    while($val = $result->fetch_assoc()) {
					    $info='';
					    $title='';
					    foreach(json_decode($val['user_data']) as $data){
						    $info .= $data->username;
						    $info .= ' '.$data->name;
						    $title=$data->name;
						    $images = $data->avatar;
					    }
						$entity = array(
							'id' => $val['user_id'],
							'type' => 'user',
							'title' => $title,
							'image' => $images,
							'info' => strtolower($info),
							'small' => '',
							'status' => 'open'
						);
						array_push($mainJson, $entity);
				    }
				}
			}
			$conn->close();
			
			
			//pb_tags
			$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT tag_id, tag FROM pb_tags WHERE tag LIKE '%$query%' LIMIT 200";
			$result = $conn->query($sql);
			if(is_object($result)){
				if ($result->num_rows > 0) {
				    while($val = $result->fetch_assoc()) {
						$entity = array(
							'id' => $val['tag_id'],
							'type' => 'tag',
							'info' => strtolower($val['tag']),
							'small' => '',
							'title' => strtolower($val['tag']),
							'image' => '',
							'status' => 'open'
						);
						array_push($mainJson, $entity);
				    }
				}
			}
			$conn->close();
			
			
			//pb_services
			$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT service_id, title, category, ratings, logo FROM pb_services WHERE (category LIKE '%$query%' OR title LIKE '%$query%' OR bio LIKE '%$query%') LIMIT 200";
			$result = $conn->query($sql);
			if(is_object($result)){
				if ($result->num_rows > 0) {
				    while($val = $result->fetch_assoc()) {
					    $img=pb_table_data('pb_safe_image', 'string', "uid='$val[logo]'");
						$entity = array(
							'id' => $val['service_id'],
							'type' => 'service',
							'title' => strtolower($val['title']),
							'info' => strtolower($val['category']),
							'small' => strtolower($val['category'].'<div class="pb-stars-search" data-stars="'.$val['ratings'].'"></div>'),
							'image' => $img
						);
						array_push($mainJson, $entity);
				    }
				}
			}
			$conn->close();
			
			
			//pb_faq
			$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT id, question FROM pb_faq WHERE question LIKE '%$query%' LIMIT 200";
			$result = $conn->query($sql);
			if(is_object($result)){
				if ($result->num_rows > 0) {
				    while($val = $result->fetch_assoc()) {
						$entity = array(
							'id' => $val['id'],
							'type' => "FAQ",
							'title' => strtolower($val['question']),
							'info' => '',
							'small' => '',
							'image' => ''
						);
						array_push($mainJson, $entity);
				    }
				}
			}
			$conn->close();
			
			

		foreach($mainJson as $item){
			$enter='false';
			$query_peice = explode(' ', $query);
			foreach($query_peice as $peice){
				if(strpos($item['type'],$peice) !== false){ $enter='true'; }
				if(strpos($item['info'],$peice) !== false){ $enter='true'; }
				if(strpos($item['title'],$peice) !== false){ $enter='true'; }
			}
			//add to results
			if($enter=='true'){ 
				array_push(
					$mainJson_ordered,  array( 
						'value' => $item['title'], 
						'data' => array( 
							'order' => masterOrder($item['type']), 
							'category' => $item['type'],
							'small' => $item['small'],
							'image' => $item['image'],  
							'id' => $item['id']						
						) 
					) 
				); 
			}
		}
		
		foreach ($mainJson_ordered as $key => $row) {
		    // replace 0 with the field's index/key
		    $sorts[$key]  = $row['data']['order'];
		}
		array_multisort($sorts, SORT_ASC, $mainJson_ordered);
		
		$jsonResponce=array(
			'query' => 'Unit', 
			'suggestions' => $mainJson_ordered
		);
		

		
		
		if( empty($jsonResponce) ){
			print return_graph('No query results', 'text', 'throw'); 
		}else{
			print return_graph($jsonResponce, 'json');
		}
	}else{
		print return_graph('No data table selected', 'text', 'throw'); }
?>
