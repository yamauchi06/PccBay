<?php
//pb_product
if($slq_table=='pb_post'){
	$pData = json_decode($val['product_info']);
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
	$user_data = json_decode(pb_user_data($val['user_id'], 'user_data'), true);
	foreach($user_data as $data){ $author=$data['name'];$user=$data['username'];$avatar=$data['avatar']; }
	$comment = json_decode(get_comments($val['product_id']));
	$imgSize = explode(':', $saveImag_size[0]);
	$entity = array(
		'id' => $val['product_id'],
		'type' => $val['type'],
		'timestamp' => array(
			'date'=>$date,
			'laps'=>$timeAgo
		),
		'user' => array(
			'id' => $val['user_id'],
			'name' => $author,
			'username' => $user,
			'avatar' => $avatar,
		),
		'images' => array(
			'featured'=>$saveImag[0],
			'featured_width'=>$imgSize[0],
			'featured_height'=>$imgSize[1],
			'list'=>$saveImag
		),
		'product_info' => array(
			'title'=>$title,
			'desc'=>$desc,
			'tags'=>$tags,
			'price'=>$price,
			'condition'=>$condition,
		),
		'trans_info' => json_decode($val['trans_info']),
		'comments' => array(
			'count' => count($comment),
			'comments' => $comment
		),
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


//pb_comments
if($slq_table=='pb_comments'){
	$user_data = json_decode(pb_user_data($val['author'], 'user_data'), true);
	if(!empty($user_data)){
		foreach($user_data as $data){ $author=$data['name']; $user=$data['username']; $avatar=$data['avatar']; }
	}else{
		$val['status'] = 'deleted';
	}
	if(isset($_GET['timeago'])){ $val['date']=time_ago(strtotime($val['date'])); }
	$entity = array(
		'id' => $val['id'],
		'post_id' => $val['post_id'],
		'date' => $val['date'],
		'author' => $val['author'],
		'user' => array(
			'name' => $author,
			'username' => $user,
			'avatar' => $avatar
		),
		'status' => $val['status'],
		'comment' => $val['comment'],
	);
	array_push($mainJson, $entity);
}
// end pb_comments


//pb_users
if($slq_table=='pb_users'){
	if(isset($_GET['timeago'])){ $val['date']=time_ago(strtotime($val['date'])); }
	$entity = array(
		'user_id' => $val['user_id'],
		'username' => $val['username'],
		'num_of_ratings' => $val['num_of_ratings'],
		'total_ratings' => $val['total_ratings'],
		'permissions' => $val['permissions'],
		'id_card_key' => $val['id_card_key'],
		'contact_info' => json_decode($val['contact_info']),
		'user_data' => json_decode($val['user_data']),
	);
	array_push($mainJson, $entity);
}
// end pb_users


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


//pb_notify
if($slq_table=='pb_notify'){
	$entity = array(
		'id' => $val['id'],
		'to' => $val['notify_to'],
		'from' => $val['notify_from'],
		'item' => $val['item'],
		'item' => $val['item'],
		'intro' => $val['intro'],
		'content' => $val['content'],
		'link' => $val['link'],
		'date' => $val['date'],
		'seen' => $val['seen'],
	);
	array_push($mainJson, $entity);
}
// end pb_notify



//pb_notify
if($slq_table=='pb_search'){
	$entity = array(
		'id' => $val['tag_id'],
		'title' => $val['tag']
	);
	array_push($mainJson, $entity);
}
// end pb_notify	
?>