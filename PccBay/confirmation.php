<?php
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
		<link rel="stylesheet" href="/includes/fonts/font-awesome-4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/includes/fonts/Material-Design-Iconic-Font/css/material-design-iconic-font.css">
		
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
		
	</header>
	<div class="container-fluid">
		<div class="row">
			<!-- Begin Content -->
			<div class="col-md-12 MainFeed" style="height: 400px">
				<div class="col-md-12 pb-post">
					<div class="pb-post-block">
						<div class="pb-post-head">
							<h3 style="text-align: center;margin-bottom: 40px;">Transaction Confirmation</h3>
							
							<div class="row" style="margin-bottom: 40px;">
								<div class="col-xs-6 pb-va-rule text-center">
								  <a href="#" class="feed-post-tab-link-Cancel transition-300" data-type="competency">
								    <i class="mdi-action-assessment feed-post-tab-icon"></i>
								    <span class="feed-post-tab"><i class="zmdi zmdi-close-circle"></i> Cancel</span>
								  </a>
								</div>
								<div class="col-xs-6 text-center">
								  <a href="#" class="feed-post-tab-link-Accept transition-300" data-type="contribution">
								    <i class="mdi-action-assignment feed-post-tab-icon"></i>
								    <span class="feed-post-tab"><i class="zmdi zmdi-check-circle"></i> Accept</span>
								  </a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<footer class="col-md-12">
		<div style="float: left;">
			<a href="#">Change Log</a> |
			<a href="#">Privacy Policy</a> |
			<a href="#">FAQ's</a>
		</div>
		&copy; Copyright <?php print date('Y'); ?>, PCCbay.com All rights reserved.<br /><em>Secure data is not stored localy</em> 
	</footer>



<script src="/includes/js/bootstrap.min.js"></script>	
<script src="/includes/js/commonScripts.js"></script>
</body>
</html>