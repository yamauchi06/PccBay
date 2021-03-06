<?php
	header("Content-Type: application/json");	
	include_once("../php/_db-config.php");
	
	function time_ago($ptime){$etime = time() - $ptime;if ($etime < 1){return '0 seconds';}$a = array( 365 * 24 * 60 * 60  =>  'year',30 * 24 * 60 * 60  =>  'month',24 * 60 * 60  =>  'day',60 * 60  =>  'hour',60  =>  'minute',1  =>  'second');$a_plural = array( 'year'   => 'years','month'  => 'months','day'    => 'days','hour'   => 'hours','minute' => 'minutes','second' => 'seconds');foreach ($a as $secs => $str){$d = $etime / $secs;if ($d >= 1){$r = round($d);return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';}}}

	$mainJson = array();
	$query='';if(isset($_GET['q'])){$query=$_GET['q'];}
	$listBy='DESC';if(isset($_GET['l'])){$listBy=$_GET['l'];}
	if(isset($_GET['page'])){
		if($_GET['page']=='products'){ $slq_table = 'pb_post'; $sql = "SELECT * FROM pb_post WHERE type='product'"; }
		if($_GET['page']=='questions'){ $slq_table = 'pb_post'; $sql = "SELECT * FROM pb_post WHERE type='question'";}
		if($_GET['page']=='discussions'){ $slq_table = 'pb_post';  $sql = "SELECT * FROM pb_post WHERE type='discussion'";}
		if($_GET['page']=='comments'){ 
			$slq_table = 'pb_comments';  $sql = "SELECT * FROM pb_comments WHERE post_id='$query' ORDER BY id $listBy";
		}
		if($_GET['page']=='feed'){ $slq_table = 'pb_post';  $sql = "SELECT * FROM pb_post";}
		if($_GET['page']=='tags'){ $slq_table = 'pb_tags';  $sql = "SELECT * FROM pb_tags ORDER BY $query $listBy";}
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
					if(isset($_GET['timeago'])){ $val['date']=time_ago(strtotime($val['date'])); }
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
				
				//pb_safe_image
				if($slq_table=='pb_tags'){
					$entity = array(
						'id' => $val['tag_id'],
						'tag' => $val['tag'],
						'count' => $val['count'],
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