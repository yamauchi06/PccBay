<?php
	if($Global['type']=='product'){
		?>
		<div class="pb-post-foot">
			<div class="row">
				<div class="col-xs-6 pb-va-rule text-center">
				  <a href="#" class="feed-post-tab-link transition-300">
				    <span class="feed-post-tab"><i class="zmdi zmdi-comment-outline"></i> Comment</span>
				  </a>
				</div>
				<div class="col-xs-6 text-center">
				  <a href="#" class="feed-post-tab-link transition-300">
				    <span class="feed-post-tab"><i class="zmdi zmdi-money-box"></i> Get this</span>
				  </a>
				</div>
			</div>
		</div>
		<?php
	}
	else if($Global['type']=='discussion'){
		?>
		<div class="pb-post-foot pb-post-input">
			<div class="row">
				<div class="col-xs-12 pb-va-rule">
				  <form action="/" method="post">
					  <input type="text" name="discussion_comment" placeholder="Chime in" class="pb-post-input-text">
				  </form>
				</div>
			</div>
		</div>
		<?php
	}
	else if($Global['type']=='question'){
		?>
		<div class="pb-post-foot pb-post-input">
			<div class="row">
				<div class="col-xs-12 pb-va-rule">
				  <form action="/" method="post">
					  <input type="text" name="question_comment" placeholder="Answer Qestion" class="pb-post-input-text">
				  </form>
				</div>
			</div>
		</div>
		<?php
	}
?>

	
	
	
		
		
			
			
			
			
		
		
		