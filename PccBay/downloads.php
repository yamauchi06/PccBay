<?php include_once('MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | Downloads</title>
		<?php pb_include('/MasterPages/head.php'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header-plain.php'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu.php'); ?>
	
	<!-- Begin Content -->
	<div class="container">
		<div class="row">
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="background: no-repeat center url('/images/interior-images/students/siteOnPhones.jpg');background-size:cover;height: 360px;padding: 0px;">
					
					<div class="col-md-5 pb-page-block-highlight themeColor" style="max-width: 480px;background:rgba(255,255,255,0.90)">
						<h1>Available to Download</h1>
						<p>Download the <?php print domain('title'); ?> mobile app on your iPhone or Android device.</p>
						
						<a href="#" class="pb-page-button pb-page-button-theme">
							<span><i class="zmdi zmdi-apple"></i> App Store</span>
						</a>
						<a href="#" class="pb-page-button pb-page-button-theme">
							<span><i class="zmdi zmdi-google-play"></i> Google Play</span>
						</a>
					</div>
					
			</div>
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="background: no-repeat center url('/images/interior-images/students/chromeBG.jpg');background-size:cover;height: 360px;padding: 0px;">
					
					<div class="col-md-5 pb-page-block-highlight themeColor" style="max-width: 480px;background:rgba(255,255,255,0.90)">
						<h1>Google Chrome</h1>
						<p>Download the <?php print domain('title'); ?> Google Chrome Extension. Notifications, messages, and purchase details.</p>
						
						<a href="#" class="pb-page-button pb-page-button-theme">
							<span><i class="zmdi zmdi-google"></i> Chrome Extension</span>
						</a>
					</div>
					
			</div>
		</div>
	</div>
<?php pb_include('/MasterPages/footer.php~col-md-12'); ?>
</body>
</html>