<?php
	session_name('com_pccbay_user');
	session_start('');
	include_once('includes/php/commonFunctions.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PCCbay | The eBay for PCC</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="pragma" content="no-cache" />
		<!-- Icon Base-->
		<link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
		<link rel="manifest" href="/images/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#e67e22">
		<!-- Latest compiled and minified -->
		<link rel="stylesheet" href="/includes/css/bootstrap.min.css">
		<link rel="stylesheet" href="/includes/css/bootstrap-tagsinput.css">
		<link rel="stylesheet" href="/includes/fonts/font-awesome-4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/includes/fonts/Material-Design-Iconic-Font/css/material-design-iconic-font.css">
		<link rel="stylesheet" href="/includes/plugins/flexslider/flexslider.css">
		<link rel="stylesheet" href="/includes/css/overHead.css">
		<link rel="stylesheet" href="/includes/css/bootstrap-slider.css">
		<link rel="stylesheet" href="/includes/css/awesome-bootstrap-checkbox.css">
		<link rel="stylesheet" href="/includes/plugins/dropzone/dropzone.css" type="text/css" />
		<link rel="stylesheet" href="/includes/plugins/nstSlider/jquery.nstSlider.min.css" type="text/css" />
		
		<!-- Main Styles and jQuery -->
		<link rel="stylesheet" href="/includes/css/PccBay.css">
		<script src="/includes/js/jquery.js"></script>
	</head>	
<body>
	<header>		
		<div class="row">
		
		<div class="col-md-3">
			<a href="/"><img src="/images/favicon/pccBay-logo.svg" height="40px" alt="PccBay" /></a>
		</div>	
			<div class="col-md-2 col-md-offset-3" id="headerBtns">
			<?php 
				if(isset($_SESSION['userLogged'])){ 
					?>
					<a href="#" class="transition-300" id="MyCardbtn" data-overHead="#MyCardBox"><i class="zmdi zmdi-card"></i></a>
					<a href="#" id="NewProductbtn" class="transition-300" data-overHead="#NewProductBox"><i class="zmdi zmdi-plus-square"></i></a>			
					<?php
				}else{ 
					print '<a href="/?sessionSet=userLogged&value=JoshFerguson" class="transition-300" id="LogOnBtn"><i class="zmdi zmdi-sign-in"></i></a>';
				} 
			?>
			</div>
		
		<div class="col-md-4">
		    <div class="input-group MainSearchBox transition-300">
		      <input type="text" class="form-control" placeholder="Search PCCbay">
		      <span class="input-group-btn">
		        <button class="btn" type="button"> <span class="glyphicon glyphicon-search"></span> </button>
		      </span>
		    </div>
		</div>
		
		
		  
		</div>
		
	</header>
	<div class="container-fluid">
		<div class="row">
			<!-- Begin Content -->
			<div class="col-md-<?php if(isset($_SESSION['userLogged'])){ print '9'; }else{ print '12'; } ?> MainFeed">
				<div id="freewall">
					<?php pb_feed(); ?>
				</div>
			</div>
			<!-- Begin SideBar -->
			<?php
			if(isset($_SESSION['userLogged'])){
				?>
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
					
					<div id="side_dashboard" class="pb-sidebar-group activeSet">
						<?php include('includes/content/pbRightBar/side_dashboard.php'); ?>
					</div>
					<div id="side_notifications" class="pb-sidebar-group">
						<?php include('includes/content/pbRightBar/side_notifications.php'); ?>
					</div>
					<div id="side_account" class="pb-sidebar-group full-width">
						<?php include('includes/content/pbRightBar/side_account.php'); ?>
					</div>
					
				</div>
				<?php
			}	
			?>
		</div>
	</div>
	
	
	<div class="pb-sticky-side">
		<a href="#" class="pb-sticky-btn feedback">
			<i class="zmdi zmdi-assignment-check"></i>
		</a>
		<a href="http://s.pccbay.com/Xt5y22i" class="pb-sticky-btn">
			<i class="zmdi zmdi-card-giftcard"></i>
		</a>
	</div>
	
	<footer class="col-md-<?php if(isset($_SESSION['userLogged'])){ print '9'; }else{ print '12'; } ?>">
		<div style="float: left;">
			<a href="#">Change Log</a> |
			<a href="#">Privacy Policy</a> |
			<a href="#">FAQ's</a>
		</div>
		&copy; Copyright <?php print date('Y'); ?>, PCCbay.com All rights reserved.<br /><em>Secure data is not stored localy</em> 
	</footer>

<!-- Place Hidden Popups and lightbox frames here -->
<div class="overHeadPullout">
	<span class="overHead-close">X</span>
	<div id="pb-j"></div>
	<div id="HiddenFrames">
		<div id="NewProductBox" class="HiddenFrame">
			<?php include('includes/content/forms/newProduct.php'); ?>
		</div>
		<div id="MyCardBox" class="HiddenFrame">
			<?php include('includes/content/forms/myPCCcard.php'); ?>
		</div>
		<div id="accSettingsBox" class="HiddenFrame">
			<?php include('includes/content/forms/accountSettings.php'); ?>
		</div>
		<div id="postViewer" class="HiddenFrame">
			<?php include('includes/content/forms/postViewer.php'); ?>
		</div>
	</div>
</div>



<script src="/includes/js/bootstrap.min.js"></script>
<script src="/includes/js/bootstrap-tagsinput.min.js"></script>
<script src="/includes/plugins/flexslider/jquery.flexslider-min.js"></script>
<script src="/includes/plugins/freewall/freewall.js"></script>
<script src="/includes/js/overHead.js"></script>
<script src="/includes/js/lazyload.js"></script>
<script src="/includes/js/bootstrap-slider.js"></script>
<script src="/includes/plugins/dropzone/dropzone.js"></script>	
<script src="/includes/js/autosize.js"></script>	
<script src="/includes/plugins/nstSlider/jquery.nstSlider.min.js"></script>	
<script src="/includes/js/_commonScripts.js"></script>
</body>
</html>