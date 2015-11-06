<?php
	if($Global['type']=='product'){
		?>
		<div class="pb-post-foot">
			<div class="row">
				<div class="col-xs-12 text-center">
				  <a href="/product?product_id=<?php print $Global['id']; ?>" class="feed-post-tab-link transition-300">
				    <span class="feed-post-tab"><i class="zmdi zmdi-money-box"></i> View This Item</span>
				  </a>
				</div>
			</div>
		</div>
		<?php
	}
	else if($Global['type']=='discussion'){
		pb_isset(pb_isset_session('user_id'), 
		'<div class="pb-post-foot pb-post-input">
			<div class="row">
				<div class="col-xs-12 pb-va-rule">
				  <form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post">
					  <input type="hidden" name="post_id" value="'.$Global['id'].'" >
					  <input type="text" name="comment" placeholder="Chime in" class="pb-post-input-text">
					  <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>
					  <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">
				  </form>
				</div>
			</div>
		</div>');
	    print pb_recent_comments($Global['id'], 3);
	}
	else if($Global['type']=='question'){
			pb_isset(pb_isset_session('user_id'), 
			'<div class="pb-post-foot pb-post-input">
				<div class="row">
					<div class="col-xs-12 pb-va-rule">
					  <form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post">
						  <input type="hidden" name="post_id" value="'.$Global['id'].'" >
						  <input type="text" name="comment" placeholder="Answer Qestion" class="pb-post-input-text">
						  <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>
						  <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">
					  </form>
					</div>
				</div>
			</div>');
		print pb_recent_comments($Global['id'], 3);
	}
?>

	
	
	
		
		
			
			
			
			
		
		
		