<?php  include_once('../MasterPages/overhead.php'); $today = date("Y-m-d");  ?>
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
				<?php pb_db("SELECT * FROM pb_services WHERE expires > '$today' AND status = 'open' ORDER BY UNIX_TIMESTAMP(expires) DESC", function($row){ ?>
					<div class="col-md-5 pb-post grid-item grid-noWall" id="<?php print $row['service_id']; ?>">
						<div class="pb-post-block">
							<?php pb_collage(pb_collage_build($row), 160, 'print', '<div class="pb-post-head">{{collage}}</div>'); ?>
							<div class="pb-post-content">
								<div style="padding: 10px">
									<div class="pb-post-author" style="font-size: 24px;line-height: 24px">
										<strong><a href="/services/list#<?php print $row['service_id']; ?>"><span class="md-gt-title"><?php print $row['title']; ?></span></a></strong>
										<small><?php print $row['category']; ?></small>
										<div class="pb-stars" data-stars="<? print $row['ratings']; ?>" data-post-text="<?php print pb_comment_count($row['service_id']); ?>"></div>
									</div>
									<div class="pb_Pdesc"><p><?php print $row['bio']; ?></p></div>
								</div>
								<div style="margin-top: -8px">
									<div class="col-md-2">
										<h4>Reviews</h4>
									</div>
									<div class="col-md-2  col-lg-offset-9" style="float:none;">
										<button class="action" style="float:none;" data-toggle="modal" data-target="#reviewModal" data-service-modal="<?php print $row['service_id']; ?>"><span class="label">Write a review</span></button>
									</div>
									<div style="margin-top: -3px">
										<?php print pb_recent_comments($row['service_id'], 5, 'DESC', '<small style="padding-left:20px">No reviews</small>'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }); ?>
				</div>
			</div>
		</div>
	</div>
	
<!-- Modal -->
<form action="" method="post">
<div id="reviewModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        
	        <input type="hidden" name="post_id" value="">
	        How was your service with us?
	        <textarea cols="4" class="form-control bordered-input no-resize autosize" id="myrev" style="min-height: 60px" name="comment"></textarea>
	        <br />
	        <div class="row">
				<div class="col-md-2" style="margin-left:7px;">
					<span>Rate us</span>
				</div>
				<div class="col-md-3">
					<div style="margin-left: -10px;" class="nstSlider" data-range_min="-100" data-range_max="100" data-cur_min="50" data-cur_max="0">
						<div class="highlightPanel"></div>
						<div class="bar"></div>
						<div class="leftGrip"></div>
						<input type="hidden" name="ratings" />
					</div>
				</div>
			</div>
	        
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="action" name="add_reveiw" style="float:none;"> 
        	<span class="label">Submit review</span>
        </button>
      </div>
    </div>

  </div>
</div>	
</form>
<script>
$('[data-service-modal]').on('click', function(){
	var service_id = $(this).data('service-modal');
	var title = $(this).closest('[data-service-ref]').find('.md-gt-title').text();
	$('.modal-title').text('Write a review on: '+title);
	$('#myrev').val('');
	$('[name="post_id"]').val(service_id);
});	
$(document).ready(function(){
	if(window.location.hash) {
		highlighBlock(window.location.hash, 'class', 'pb-post-flash', 'pb-post-flash', 200);
	}
});
</script>
<!-- Modal -->

<?php pb_include('/MasterPages/footer~col-md-12'); ?>
<script>	
$(document).ready(function(){ ini_grid(); });	
</script>
</body>
</html>