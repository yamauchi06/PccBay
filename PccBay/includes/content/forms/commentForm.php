<div class="oh-section oh-section-half">
	
	<div class="hidden new-post-toggle">
		
		<form method="post" action="/">
         <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>">
			<textarea class="form-control no-resize" rows="3" data-maxtext="2000" name="comment" placeholder="Chime in"></textarea>
			<div style="text-align: right;width: 100%;">
				<input type="submit" class="btn btn-default" name="add_comment" value="Start Talking">
				<a href="#" style="float: left;margin: 5px;">Privacy Policy </a>
			</div>
			
		</form>
		
	</div>
	
</div>