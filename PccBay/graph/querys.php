<?php
//PB_POST
if($_GET['page']=='feed'){ 
	$slq_table = 'pb_post';  
	$sql = "SELECT * FROM pb_post";
}

if($_GET['page']=='products'){ 
	$slq_table = 'pb_post'; 
	$sql = "SELECT * FROM pb_post WHERE type='product'"; 
}

if($_GET['page']=='questions'){ 
	$slq_table = 'pb_post'; 
	$sql = "SELECT * FROM pb_post WHERE type='question'";
}

if($_GET['page']=='discussions'){ 
	$slq_table = 'pb_post';  
	$sql = "SELECT * FROM pb_post WHERE type='discussion'";
}
//PB_POST

if($_GET['page']=='comments'){ 
	$slq_table = 'pb_comments';  
	$sql = "SELECT * FROM pb_comments WHERE post_id='$query' ORDER BY id $listBy";
}

if($_GET['page']=='tags'){ 
	$slq_table = 'pb_tags';  
	if(empty($query)){$query='tag_id';$listBy='ASC';}
	$sql = "SELECT * FROM pb_tags ORDER BY $query $listBy";
}

if($_GET['page']=='users'){ 
	$slq_table = 'pb_users'; 
	if(empty($query)){
		$sql = "SELECT * FROM pb_users";
	}else{
		$sql = "SELECT * FROM pb_users WHERE user_id='$query'";
	}
}

if($_GET['page']=='images'){ 
	$slq_table = 'pb_safe_image';
	$sql = "SELECT * FROM pb_safe_image"; 
}	
?>