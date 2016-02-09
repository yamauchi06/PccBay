<?php  
if(pb_user()->resident=='true'){
	$home = pb_user()->building.': '.pb_user()->room;
}else{
	$home = 'Town';
}
?>
<div class="pb-page-divider">
	<a href="#" data-overHead="#userAccountSettingBox" id="accSettings" class="pb-flat-btn"><i class="zmdi zmdi-settings-square"></i></a>
</div>
<div class="pb-center">
	<img src="<?php print pb_user()->avatar; ?>">
</div>
<div class="text-center">
	<h3 class="pb-rule-below">
		<?php print pb_user()->name; ?><br />
<!-- 		<span style="font-size: 14px;" class="pb-theme-black"><?php print $pb_user['registered']; ?></span> -->
	</h3>
	
	<?php
		print '<strong><i class="zmdi zmdi-home"></i> '.$home.'</strong><br />'.pb_user()->phone.'<br />'.pb_user()->email.'';	
	?>
	<hr />
</div>


<div class="pb-sidebar-overflow" style="padding-bottom: 20px;">
	<?php
	$user_feed=pb_switch( json_decode( pb_og('feed', pb_user()->user_id) ) );
	if(!is_array($user_feed)){
		foreach($user_feed as $post){
			if($post->status=='open' || $post->status==1){
				if($post->type=='product'){
					?>
					<a href="/item?id=<?php print $post->id; ?>">
					<div class="col-md-12 pb-post pb-rule-below-thick">
						<div class="pb-post-block">
							<div class="pb-post-content">
								<?php
								if(!empty( $post->images->featured )){
									print '<img src="'.$post->images->featured.'" class="pb-post-product lazy">';
								}	
								?>
								<div style="position: absolute;bottom: 0px;left: 0px;width: 100%;padding: 15px;color: #000000">
									 <?php print $post->timestamp->laps; ?>
								</div>
							</div>
							</a>
						</div>
					</div>
					<?php
				}
			}
		}
	}
	?>
</div>

