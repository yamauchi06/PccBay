<?php
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
if($slq_table=='pb_users'){
	if(isset($_GET['timeago'])){ $val['date']=time_ago(strtotime($val['date'])); }
	$entity = array(
		'user_id' => $val['user_id'],
		'num_of_ratings' => $val['num_of_ratings'],
		'total_ratings' => $val['total_ratings'],
		'permissions' => $val['permissions'],
		'id_card_key' => $val['id_card_key'],
		'contact_info' => json_decode($val['contact_info']),
		'user_data' => json_decode($val['user_data']),
	);
	array_push($mainJson, $entity);
}
// end pb_safe_image


//pb_tags
if($slq_table=='pb_tags'){
	$entity = array(
		'id' => $val['tag_id'],
		'tag' => $val['tag'],
		'count' => $val['count'],
	);
	array_push($mainJson, $entity);
}
// end pb_tags	
?>