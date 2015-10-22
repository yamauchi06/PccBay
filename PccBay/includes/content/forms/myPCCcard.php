<div class="oh-section oh-section-half">
	
	<h3 class="pb-rule-below">My PCC Card</h3>

	<?php
	if(isset($_pccCard)){
		?>
		<h4>Current Balance: <span class="pb-theme-green">$32.16</span></h4>
		<a href="#" class="transition-300">
	    	<span class="feed-post-tab"><i class="zmdi zmdi-plus"></i> Put money on card</span>
		</a>
		<?
	}else{
		?>
		<h4>You currently have not set up a PCC card</h4>
		<form class="pb-rule-above-thick" method="post">
			<span>Login to begin using your PCC Card</span>
		
			<input class="form-control" rows="3" type="text" placeholder="Student ID" maxlength="6">
		
			<input class="form-control" rows="3" type="password" placeholder="Student Password" maxlength="8">
			
			<div style="text-align: right;width: 100%;" class="pb-rule-above">
				<input type="submit" class="btn btn-default" value="Link it!">
				<a href="#" style="float: left;margin: 5px;">Privacy Policy </a>
			</div>
	
		</form>
		<?
	}
	?>
	
</div>
