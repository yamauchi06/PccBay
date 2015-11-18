<?php  include_once('../MasterPages/overhead.php'); ?>
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
			<?php pb_db("SELECT * FROM pb_services", function($row){ ?>
				<div class="col-md-6 pb-post grid-item grid-noWall" id="template-freewall">
					<div class="pb-post-block">
						<div class="pb-post-head">
							<img src="<?php pb_safe_image($row['logo'], 'base64'); ?>" class="pb-post-avatar" />
							<div class="pb-post-author">
								<strong><a href="/<?php print $row['title']; ?>"><?php print $row['title']; ?></a></strong><br />
							</div>
						</div>
						<div class="pb-post-content" style="padding: 10px;">
							<div class="pb_Pdesc"><p><?php print $row['bio']; ?></p></div>
						</div>
					</div>
				</div>
			<?php }); ?>
		</div>
	</div>
<?php pb_include('/MasterPages/footer~col-md-12'); ?>
</body>
</html>