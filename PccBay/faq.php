<?php include_once('MasterPages/overhead.php'); ?>
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
				
				<ul class="ul-faq pb-rule-below" data-question="How to login">
					<li class="q">How do I login</li>
					<li class="a">In the upper right corner click [Sign in / Sign up]</li>
				</ul>
				
				<ul class="ul-faq pb-rule-below" data-question="How to add item">
					<li class="q">How do I post an item</li>
					<li class="a">Click the [plus] button along the top of the screen, you will be prompted with slide up model. Here you may add a new item.</li>
				</ul>
				
				
			</div>
		</div>
	</div>
<?php pb_include('/MasterPages/footer.php~col-md-12'); ?>
</body>
</html>