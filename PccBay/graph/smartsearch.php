<?php
	$mainJson=array();
	$mainJson_ordered=array();
	
	//Set Query
	if(isset($_GET['q'])){
		$slq_table = "true";
		$query=urldecode($_GET['q']);
	}else{
		array_push($mainJson, 'Query not defined'); }
		
	//Run Query	
	if(!empty($slq_table)){
		
			//pb_post
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT * FROM pb_post WHERE status='open' LIMIT 200";
			$result = $conn->query($sql);
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
			$conn->close();
			
			//pb_users
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT * FROM pb_users";
			$result = $conn->query($sql);
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
			$conn->close();
			
			
			//pb_tags
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT * FROM pb_tags LIMIT 200";
			$result = $conn->query($sql);
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
			$conn->close();
			
			
			//pb_tags
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
			$sql="SELECT * FROM pb_services LIMIT 200";
			$result = $conn->query($sql);
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
		    $sorts[$key]  = $row['data']['category'];
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