<?php
	session_name('com_pccbay_user');session_start('');
	include_once('includes/php/commonFunctions.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PCCbay | The eBay for PCC</title>
		<?php pb_include('/head.php'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/header.php'); ?>
	</header>
	<div class="container-fluid">
		<div class="row">
			<!-- Begin Content -->
			<div class="<?php sessionSet('userLogged', 'col-md-9', 'col-md-12') ?> MainFeed">
				<div id="freewall">
					<?php pb_feed(1); ?>
				</div>
			</div>
			
			<!-- Begin SideBar -->
			<?php
			sessionSet('userLogged', 
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
	<div class="pb-sticky-side <?php sessionSet('userLogged', '', 'hide') ?>">
		<a href="#" class="pb-sticky-btn feedback">
			<i class="zmdi zmdi-assignment-check"></i>
		</a>
		<a class="pb-sticky-btn" data-overHead="#invitationCodeBox">
			<i class="zmdi zmdi-card-giftcard"></i>
		</a>
	</div>
	

	<!-- Place Hidden Popups and lightbox frames here -->
	<div class="overHeadPullout">
		<span class="overHead-close">X</span>
		<div id="pb-j"></div>
		<div id="HiddenFrames">
			<div id="NewProductBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/newProduct.php'); ?>
			</div>
			<div id="MyCardBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/myPCCcard.php'); ?>
			</div>
			<div id="accSettingsBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/accountSettings.php'); ?>
			</div>
			<div id="postViewer" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/postViewer.php'); ?>
			</div>
			<div id="invitationCodeBox" class="HiddenFrame">
				<?php pb_include('/includes/content/info/invitationCode.php'); ?>
			</div>
		</div>
	</div>


<?php pb_include('/footer.php'); ?>
</body>
</html>