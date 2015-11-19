<?php  include_once('../MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | Services</title>
		<?php pb_include('/MasterPages/head'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header-plain'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu'); ?>
	<!-- Begin Content -->
	<div class="container">
		<div class="row"><br />
			<div class="col-md-12 MainFeed">
				<div id="freewall">
				<?php pb_db("SELECT * FROM pb_services ORDER BY id DESC", function($row){ ?>
					<div class="col-md-5 pb-post grid-item grid-noWall" id="template-freewall">
						<div class="pb-post-block">
							<div class="pb-post-head">
								<div class="pb-collage">
									<?php
									if(!empty($row['logo'])){
										print '<div class="pb-mask-half"style="background-image:url('.pb_safe_image_return($row['logo'], 'base64').');height:160px;"></div>';
										if(!empty(explode(',', $row['portfolio'])[0])){
											?>
											<div class="pb-mask-half">
												<div class="pb-mask" style="background-image:url(<? if(empty(explode(',', $row['portfolio'])[1])){ pb_safe_image($row['cover'], 'base64'); }else{ pb_safe_image(explode(',', $row['portfolio'])[1], 'base64'); } ?>);height:80px;"></div>
												<div class="pb-mask" style="background-image:url(<? pb_safe_image(explode(',', $row['portfolio'])[0], 'base64'); ?>);height:80px;border-top: 3px #ffffff solid;"></div>
											</div>
											<?php
										}else{
											?>
											<div class="pb-mask-half"style="background-image:url(<? pb_safe_image($row['cover'], 'base64'); ?>);height:160px;"></div>
											<?php
										}
									}else{
										print '<div class="pb-mask" style="background-image:url(/images/interior-images/mapPhone.jpg);height:160px;"></div>';
									}	
									?>
								</div>
							</div>
							<div class="pb-post-content">
								<div style="padding: 10px">
									<div class="pb-post-author" style="font-size: 24px;line-height: 24px">
										<strong><a href="/services/<? print $row['service_id']; ?>"><? print $row['title']; ?></a></strong>
										<small><? print $row['category']; ?></small>
										<div class="pb-stars" data-stars="<? print $row['ratings']; ?>"></div>
									</div>
									<div class="pb_Pdesc"><p><? print $row['bio']; ?></p></div>
								</div>
								<div style="margin-top: -8px">
									<div class="col-md-2">
										<h4>Reviews</h4>
									</div>
									<div class="col-md-2  col-lg-offset-9" style="float: none;">
										<a href="#">
											<button class="action" style="float:none;"><span class="label">Write a review</span></button>
										</a>
									</div>
									<?php print pb_recent_comments($row['service_id'], 5, 'DESC', ''); ?>
								</div>
							</div>
						</div>
					</div>
				<?php }); ?>
				</div>
			</div>
		</div>
	</div>
<?php pb_include('/MasterPages/footer~col-md-12'); ?>
<script>	
$(document).ready(function(){ ini_grid(); });	
</script>
</body>
</html>