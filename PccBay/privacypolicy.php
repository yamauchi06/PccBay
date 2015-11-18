<?php  include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | Privacy Policy</title>
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
			<div class="col-lg-10 col-lg-offset-1 pb-page-block">
				<?php pb_include('/includes/content/info/privacypolicy'); ?>
			</div>
		</div>
	</div>
<?php pb_include('/MasterPages/footer.php~col-md-12'); ?>
</body>
</html>