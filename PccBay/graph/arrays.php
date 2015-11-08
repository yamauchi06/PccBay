<?php
//pb_product
if($slq_table=='pb_post'){
	$pData = json_decode($val['product_info']);
	$saveImag=array();
	foreach($pData as $pd){
		$images = explode(',', $pd->images);
		$timeAgo = time_ago(strtotime($pd->timestamp));
		$date = $pd->timestamp;
		foreach($images as $img){
			array_push($saveImag, pb_table_data('pb_safe_image', 'string', "uid='$img'"));
		}
	}
	$user_data = json_decode(pb_user_data($val['user_id'], 'user_data'), true);
	foreach($user_data as $data){ $author=$data['name'];$user=$data['username'];$avatar=$data['avatar']; }
	$comment = json_decode(get_comments($val['product_id']));
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
		'images' => $saveImag,
		'product_info' => json_decode($val['product_info']),
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




//pb_product
if($slq_table=='pb_post_html'){
	$json = json_decode(file_get_contents('http://pccbay.localhost/graph/feed?accessToken=rootbypass_9827354187582375129873&q='.$val['product_id']));
?>
<div class="col-md-4 pb-post grid-item" id="pb_post_<?php print $json[0]->id; ?>">
	<div class="pb-post-block">
		<div class="pb-post-head">
			<img src="<?php print $json[0]->user->avatar; ?>" class="pb-post-avatar" />
			<div class="pb-post-author">
				<strong><a href="/@<?php print $json[0]->user->username; ?>"><?php print $json[0]->user->name; ?></a></strong><br />
				<span class="pb-post-timestamp"> <i class="pb-post-timestamp-o">
				<?php  print $json[0]->timestamp->laps; ?>
				</i></span>
			</div>
			<div class="pb-post-price">
				<?php 
					if($json[0]->type =='product'){ 
						print '<span class="themeColor">$ '.$json[0]->product_info[0]->price.'</span>';
					}
					else if($json[0]->type =='question'){
						print '<i class="zmdi zmdi-pin-help themeColor" style="font-size:30px"></i>';
						print '<sub>'. pb_comment_count($json[0]->id).'</sub>';
					}
					else if($json[0]->type =='discussion'){
						print '<i class="zmdi zmdi-comment-text-alt themeColor" style="font-size:30px"></i>';
					}
				?>
			</div>
		</div>
		<div class="pb-post-content">
			<?php
				print pb_if(
					$json[0]->type =='product',
					'<h4>'.htmlspecialchars_decode($json[0]->product_info[0]->title).'</h4>'
				);	
			?>
			<div class="pb-post-slider flexslider">
			  <ul class="slides">
				<li>
					<a href="/item?id=<?php print $json[0]->id; ?>">
						<img src="<?php print $json[0]->images[0]; ?>" class="pb-post-product lazy">
					</a>								  
				</li>
			  </ul>
			</div>
			<p>
				<?php
				print pb_if(
					$val['type']=='question' || $val['type']=='discussion',
					'<strong>'.htmlspecialchars_decode($json[0]->product_info[0]->title).'</strong> <br />'.htmlspecialchars_decode($json[0]->product_info[0]->desc).''
				);	
				?>
			</p>
			
			<div class="pb-post-tags">
				<ul>
					<?php
					$cats = explode(',', $json[0]->product_info[0]->tags);
					if(count($cats) >= 1){
						foreach ($cats as $index => $category) {
							print '<li><a href="/s/'.str_replace(' ', '+', $category).'">'.ucwords($category).'</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div>
		<?php 
			if($json[0]->type=='product'){
				?>
				<div class="pb-post-foot">
					<div class="row">
						<div class="col-xs-12 text-center">
						  <a href="/item?id=<?php print $val['product_id']; ?>" class="feed-post-tab-link transition-300">
						    <span class="feed-post-tab"><i class="zmdi zmdi-money-box"></i> View This Item</span>
						  </a>
						</div>
					</div>
				</div>
				<?php
			}
			else if($json[0]->type=='discussion'){
				print pb_recent_comments($json[0]->id, 3, 'ASC');
				pb_isset(pb_isset_session('user_id'), 
				'<div class="pb-post-foot pb-post-input">
					<div class="row">
						<div class="col-xs-12 pb-va-rule">
						  <form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post" autocomplete="off">
							  <input type="hidden" name="post_id" value="'.$json[0]->id.'" >
							  <input type="text" name="comment" placeholder="Chime in" class="pb-post-input-text">
							  <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>
							  <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">
						  </form>
						</div>
					</div>
				</div>');
			}
			else if($json[0]->type=='question'){
				print pb_recent_comments($json[0]->id, 3, 'ASC');
				pb_isset(pb_isset_session('user_id'), 
				'<div class="pb-post-foot pb-post-input">
					<div class="row">
						<div class="col-xs-12 pb-va-rule">
						  <form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post" autocomplete="off">
							  <input type="hidden" name="post_id" value="'.$json[0]->id.'" >
							  <input type="text" name="comment" placeholder="Answer Qestion" class="pb-post-input-text">
							  <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>
							  <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">
						  </form>
						</div>
					</div>
				</div>');
			}	
		?>
	</div>
</div>
<?php
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
?>