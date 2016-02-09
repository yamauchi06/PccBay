<?php  
	include_once('../../../MasterPages/overhead.php');	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | Facebook Ui</title>
		<?php pb_include('/MasterPages/head'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header-plain'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu'); ?>
	
	<!-- Begin Content -->
	<div class="container">
		<div class="row">
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="height: 360px;padding: 0px;">
				<div class="pb-grade-lr-theme col-lg-12">
					
					<div class="col-md-8 pb-page-block-highlight">
						<h1><?php print $_GET['t'] ?></h1>
						<p> <?php print urldecode($_GET['e']); ?></p>
						<a href="/" style="color:#ffffff;text-decoration: underline;">Return Home</a>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>



<?php pb_include('/MasterPages/footer~col-md-12'); ?>
</body>
</html>