<?php
	if($Global['type']=='product'){
		?>
		<div class="pb-post-foot">
			<div class="row">
				<div class="col-xs-12 text-center">
				  <a href="/product?product_id=<?php print $Global['id']; ?>" class="feed-post-tab-link transition-300">
				    <span class="feed-post-tab"><i class="zmdi zmdi-money-box"></i> View Product</span>
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

	
	
	
		
		
			
			
			
			
		
		
		