<?php
//PB_POST
if($_GET['page']=='feed'){ 
	if(isset($_GET['html'])){
		$slq_table = 'pb_post_html'; 
	}else{ $slq_table = 'pb_post'; } 
	if(!empty($query)){
		if(isset($_GET['search'])){
			
			$terms = explode(" ", $query);
			$sql = "SELECT * FROM pb_post WHERE ";
			$i=0;
			foreach ($terms as $each){
				$i++;
				if ($i == 1){
					$sql .= "product_info LIKE '%$each%' ";
				}
				else{
					$sql .= "OR type LIKE '%$each%' ";
					// $query .= "OR menu LIKE '%$each%' ";
					// $query .= "OR content LIKE '%$each%' ";
					// $query .= "OR author LIKE '%$each%' ";
				}
			}
			$sql .= "AND status='open' ORDER BY product_id $listBy";
			
		}else{
			$sql = "SELECT * FROM pb_post WHERE (product_id='$query' OR user_id='$query') AND status='open'  ORDER BY product_id $listBy";
		}
	}
	else if(isset($_GET['range'])){
		$r=explode('-', $_GET['range']);
		$low=$r[0];$high=$r[1];
		$sql = "SELECT * FROM pb_post WHERE product_id BETWEEN $low and $high AND (type='question' OR type='product')  AND status='open' ORDER BY product_id $listBy";
	}
	else{
		$sql = "SELECT * FROM pb_post WHERE (type='question' OR type='product') AND status='open' ORDER BY product_id $listBy";
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
		$sql = "SELECT * FROM pb_comments WHERE (post_id='$query' OR author='$query') ORDER BY id $listBy";
	}else{
		$sql = "SELECT * FROM pb_comments ORDER BY id $listBy";
	}
}

else if($_GET['page']=='tags'){ 
	$slq_table = 'pb_tags'; 
	$listBy='ASC'; 
	if(empty($query)){
		$query='tag_id';$listBy='ASC';
		$sql = "SELECT * FROM pb_tags ORDER BY tag_id $listBy";
	}else{
		$sql = "SELECT * FROM pb_tags WHERE (tag='$query' OR tag_id='$query') ORDER BY tag_id $listBy";
	}
}

else if($_GET['page']=='users'){ 
	$slq_table = 'pb_users'; 
	if(empty($query)){
		$sql = "SELECT * FROM pb_users";
	}else{
		$sql = "SELECT * FROM pb_users WHERE (user_id='$query' OR username='$query' OR id_card_key='$query')";
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

else if($_GET['page']=='search'){ 
	$slq_table = 'pb_search';
	$sql =  "SELECT * ".
	        "FROM pb_post, pb_tags ".
	        "WHERE (pb_post.product_id LIKE '$query' OR pb_tags.tag = '$query') ";
}	
?>