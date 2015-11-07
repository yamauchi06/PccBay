<?php
//PB_POST
if($_GET['page']=='feed'){ 
	$slq_table = 'pb_post';  
	if(!empty($query)){
		$sql = "SELECT * FROM pb_post WHERE product_id='$query'";
	}else{
		$sql = "SELECT * FROM pb_post";
	}
}

else if($_GET['page']=='products'){ 
	$slq_table = 'pb_post'; 
	if(!empty($query)){
		$sql = "SELECT * FROM pb_post WHERE type='product' AND product_id='$query'";
	}else{
		$sql = "SELECT * FROM pb_post WHERE type='product'";
	}
}

else if($_GET['page']=='questions'){ 
	$slq_table = 'pb_post'; 
	if(!empty($query)){
		$sql = "SELECT * FROM pb_post WHERE type='question' AND product_id='$query'";
	}else{
		$sql = "SELECT * FROM pb_post WHERE type='question'";
	}
}

else if($_GET['page']=='discussions'){ 
	$slq_table = 'pb_post';  
	if(!empty($query)){
		$sql = "SELECT * FROM pb_post WHERE type='discussion' AND product_id='$query'";
	}else{
		$sql = "SELECT * FROM pb_post WHERE type='discussion'";
	}
}
//PB_POST

else if($_GET['page']=='comments'){ 
	$slq_table = 'pb_comments';  
	if(!empty($query)){
		$sql = "SELECT * FROM pb_comments WHERE post_id='$query' ORDER BY id $listBy";
	}else{
		$sql = "SELECT * FROM pb_comments ORDER BY id $listBy";
	}
}

else if($_GET['page']=='tags'){ 
	$slq_table = 'pb_tags';  
	if(empty($query)){$query='tag_id';$listBy='ASC';}
	$sql = "SELECT * FROM pb_tags ORDER BY $query $listBy";
}

else if($_GET['page']=='users'){ 
	$slq_table = 'pb_users'; 
	if(empty($query)){
		$sql = "SELECT * FROM pb_users";
	}else{
		$sql = "SELECT * FROM pb_users WHERE user_id='$query'";
	}
}

else if($_GET['page']=='images'){ 
	$slq_table = 'pb_safe_image';
	if(!empty($query)){
		$sql = "SELECT * FROM pb_safe_image WHERE uid='$query'"; 
	}else{
		$sql = "SELECT * FROM pb_safe_image"; 
	}
}

else if($_GET['page']=='notify'){ 
	$slq_table = 'pb_notify';
	if(!empty($query)){
		$sql = "SELECT * FROM pb_notify WHERE 
		(notify_to='$query' OR item='$query')"; 
	}else{
		$sql = "SELECT * FROM pb_notify"; 
	}
}	
?>