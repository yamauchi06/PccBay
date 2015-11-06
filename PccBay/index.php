<?php include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PCCbay | The eBay for PCC</title>
		<?php pb_include('/MasterPages/head.php'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header.php'); ?>
	</header>
	<?php 
	if(isset($_SESSION['user_id'])){
		pb_include('/MasterPages/MainMenu.php');
	}	
	?>
	<div class="container-fluid">
		<div class="row">
			<!-- Begin Content -->
			<div class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-9', 'col-md-12') ?> MainFeed">
				<div id="freewall">
					<?php pb_feed(1); ?>
				</div>
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
				<div id="side_dashboard" class="pb-sidebar-group activeSet">
					<?php pb_include('/includes/content/pbRightBar/side_dashboard.php'); ?>
				</div>
				<div id="side_notifications" class="pb-sidebar-group">
					<?php pb_include('/includes/content/pbRightBar/side_notifications.php'); ?>
				</div>
				<div id="side_account" class="pb-sidebar-group full-width">
					<?php pb_include('/includes/content/pbRightBar/side_account.php'); ?>
				</div>
					
			</div>
		</div>
	</div>
	
	<!-- Sticky side buttons -->
	<div class="pb-sticky-side <?php pb_isset(pb_isset_session('user_id'), '', 'hide') ?>">
		<a href="#" class="pb-sticky-btn feedback" data-overHead="#feedbackBox">
			<i class="zmdi zmdi-assignment-check"></i>
		</a>
		<a class="pb-sticky-btn" data-overHead="#invitationCodeBox">
			<i class="zmdi zmdi-card-giftcard"></i>
		</a>
	</div>
	

	<!-- Place Hidden Popups and lightbox frames here -->
	<div class="overHeadPullout" style="width: 100%">
		<div class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-9', 'col-md-12') ?>" id="overHead-close">
			<span class="overHead-close col-md-1 col-md-offset-11">X</span>
		</div>
		<div id="pb-j"></div>
		<div id="HiddenFrames" class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-9', 'col-md-12') ?>">
			<div id="NewProductBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/newProduct.php'); ?>
			</div>
			<div id="MyCardBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/myPCCcard.php'); ?>
			</div>
			<div id="postViewer" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/postViewer.php'); ?>
			</div>
			<div id="invitationCodeBox" class="HiddenFrame">
				<?php pb_include('/includes/content/info/invitationCode.php'); ?>
			</div>
			<div id="feedbackBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/feedback.php'); ?>
			</div>
			<div id="userAccountSettingBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/accountSettings.php'); ?>
			</div>
			<div id="userLoginBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/UserLogin.php'); ?>
			</div>
		</div>
	</div>


<?php pb_include('/MasterPages/footer.php'); ?>
</body>
</html>