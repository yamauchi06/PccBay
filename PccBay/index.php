<?php 
include_once('MasterPages/overhead.php'); 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'). ' | ' . domain('tagline'); ?></title>
		<?php pb_include('/MasterPages/head'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header'); ?>
	</header>
	<?php 
	if(isset($_SESSION['user_id'])){
		pb_include('/MasterPages/MainMenu');
	}	
	?>
	<div class="container-fluid">
		<div class="row">
			<!-- Begin Content -->
			<div class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-9', 'col-md-12') ?> MainFeed">
				<div id="freewall" class="fancy_grid <?php if(!isset($_SESSION['user_id'])){ print 'logging_out';}else{ print 'logging_in';} ?>"></div>
			</div>
			
			<!-- Begin SideBar -->
			<?php
			pb_isset(pb_isset_session('user_id'), 
				'
				<div class="col-md-3 MainSideBar">
					<nav>
						<a href="#" class="transition-300 activeSet" data-obj="side_dashboard">
							<div class="col-md-4">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
						</a>
						<a href="#" class="transition-300" data-obj="side_notifications">
							<div class="col-md-4">
								<i class="zmdi zmdi-notifications"></i>
							</div>
						</a>
						<a href="#" class="transition-300" data-obj="side_account">
							<div class="col-md-4">
								<i class="zmdi zmdi-account-box"></i>
							</div>
						</a>
					</nav>
				', '<div style="display:none">' 
			);	
			?>
			<?php
			if(isset($_SESSION['user_id'])){
				?>
				<div id="side_dashboard" class="pb-sidebar-group activeSet">
					<?php pb_include('/includes/content/pbRightBar/side_dashboard'); ?>
				</div>
				<div id="side_notifications" class="pb-sidebar-group">
					<?php pb_include('/includes/content/pbRightBar/side_notifications'); ?>
				</div>
				<div id="side_account" class="pb-sidebar-group full-width">
					<?php pb_include('/includes/content/pbRightBar/side_account'); ?>
				</div>
				<?php
					
				pb_include('/MasterPages/sticky-menu-bottom'); 
			}	
			?>
					
			</div>
		</div>
	</div>
	
	<!-- Place Hidden Popups and lightbox frames here -->
	<div class="overHeadPullout" style="width: 100%">
		<div class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-9', 'col-md-12') ?>" id="overHead-close">
			<span class="overHead-close col-md-1 col-md-offset-11">X</span>
		</div>
		<div id="pb-j"></div>
		<div id="HiddenFrames" class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-9', 'col-md-12') ?>">
			<?php
			if(isset($_SESSION['user_id'])){
				?>
				<div id="NewProductBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/newProduct'); ?>
				</div>
				<div id="MyCardBox" class="HiddenFrame">
					<?php pb_include('/includes/content/forms/myPCCcard'); ?>
				</div>
				<div id="postViewer" class="HiddenFrame">
					<?php pb_include('/includes/content/forms/postViewer'); ?>
				</div>
				<div id="invitationCodeBox" class="HiddenFrame">
					<?php pb_include('/includes/content/info/invitationCode'); ?>
				</div>
				<div id="feedbackBox" class="HiddenFrame">
					<?php pb_include('/includes/content/forms/feedback'); ?>
				</div>
				<div id="userAccountSettingBox" class="HiddenFrame">
					<?php pb_include('/includes/content/forms/accountSettings'); ?>
				</div>
				<div id="userLogin" class="HiddenFrame">
					<?php pb_include('/includes/content/forms/UserLogin'); ?>
				</div>
				<?php
			}	
			?>
		</div>
	</div>
	

<?php pb_include('/MasterPages/footer~col-md-9'); ?>
<script src="/includes/js/jquery.waypoints.js"></script>
<script src="/includes/js/moment.js"></script>
<script src="/includes/js/_mainFeed.js"></script>
</body>
</html>