<?php
header("Content-Type: application/json");
include_once("../../includes/php/_db-config.php");
include_once("../../includes/php/_pb_min_functions.php");
include_once("../functions.php");

if(isset($_GET['row_count'])){
	$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 
	$sql = "SELECT product_id FROM pb_post WHERE status='open' ORDER BY product_id DESC";
	$result = $conn->query($sql);
	echo return_graph(array("rows"=>$result->fetch_assoc()['product_id']), 'json');
	$conn->close();
	exit;
}

if(!isset($_GET['filter'])){
	$limit = $_GET['limit'];
	$offset = $_GET['offset'];
}
function pb_table_data($t, $r, $w){
	$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT $r FROM $t WHERE $w";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    return $result->fetch_assoc()[$r];
	}
	$conn->close();	
}
$mainJson=array();
$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_GET['filter'])){
	
	$terms = explode(" ", $_GET['filter']);
	$sql = "SELECT product_id, type, user_id, product_info FROM pb_post WHERE ";
	$i=0;
	foreach ($terms as $each){
		$i++;
		if ($i == 1){
			$sql .= "product_info LIKE '%$each%' ";
		}
		else{
			$sql .= "OR type LIKE '%$each%' ";
			// $sql .= "OR menu LIKE '%$each%' ";
			// $sql .= "OR content LIKE '%$each%' ";
			// $sql .= "OR author LIKE '%$each%' ";
		}
	}
	$sql .= "AND status='open' ORDER BY product_id DESC";
	
	
}else{
	$sql = "SELECT product_id, type, user_id, product_info FROM pb_post WHERE status='open' AND product_id BETWEEN $limit and $offset ORDER BY product_id DESC";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
		    $pData = json_decode($row['product_info']);
			$saveImag=array();
			$saveImag_size=array();
			foreach($pData as $pd){
				$images = explode(',', $pd->images);
				$timeAgo = time_ago(strtotime($pd->timestamp));
				$date = $pd->timestamp;
				foreach($images as $img){ 
					array_push($saveImag, pb_safe_image_structure( pb_table_data('pb_safe_image', 'string', "uid='$img'") ) ); 
					array_push($saveImag_size, pb_safe_image_structure( pb_table_data('pb_safe_image', 'size', "uid='$img'") ) ); 
				}
				$title=$pd->title;
				$desc=$pd->desc;
				$tags=$pd->tags;
				$price=$pd->price;
				$condition=$pd->condition;
			}
			$user_data = json_decode(pb_table_data('pb_users', 'user_data', "user_id='$row[user_id]'"), true);
			$comment = json_decode(get_comments($row['product_id']));
			$imgSize = explode(':', $saveImag_size[0]);
			$entity = array(
				'id' => $row['product_id'],
				'type' => $row['type'],
				'timestamp' => array(
					'date'=>$date,
					'laps'=>$timeAgo
				),
				'user' => array(
					'id' => $row['user_id'],
					'name' => $user_data[0]['name'],
					'username' => $user_data[0]['username'],
					'avatar' => $user_data[0]['avatar'],
				),
				'images' => array(
					'featured'=>$saveImag[0],
					'featured_size' => array(
						'width'=>$imgSize[0],
						'height'=>$imgSize[1]
					),
					'list'=>$saveImag
				),
				'product_info' => array(
					'title'=>$title,
					'desc'=>$desc,
					'tags'=>$tags,
					'price'=>$price,
					'condition'=>$condition,
				),
				'comments' => array(
					'count' => count($comment),
					'comments' => $comment
				)
			);
			array_push($mainJson, $entity);
		}

}
$conn->close();	
echo return_graph($mainJson, 'json');	
?>