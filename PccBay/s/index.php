<?php  include_once('../MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | Services</title>
		<?php pb_include('/MasterPages/head'); ?>
		<style>
		.pb-main-search{
			width: 90%;
			margin: 0px auto;
			position: relative;
		}
		.pb-main-search	.pb-main-search-wrapper{
			width: 100%;
			position: relative;
		}
		.pb-main-search	.pb-main-search-wrapper input[type="text"]{
			width: 100%;
			height: 35px;
			border: 2px #e6e9ed solid;
			font-size: 18px;
			padding: 0px 40px 0px 10px;
			color: #c1c6cb;
		}
		.pb-main-search	.pb-main-search-wrapper input[type="text"]:active,
		.pb-main-search	.pb-main-search-wrapper input[type="text"]:focus,
		.pb-main-search	.pb-main-search-wrapper input[type="text"]:active:focus{
			outline: none;
			border-color:#c1c6cb;
			color: #8a8e91;
		}
		.pb-main-search	.pb-main-search-wrapper .pb-main-search-submit{
			position: absolute;
			right: 0px;
			top: 0px;
		}
		.pb-main-search	.pb-main-search-wrapper .pb-main-search-submit input[type="submit"]{
			height: 25px;
			width: 40px;
			z-index: 99;
			cursor: pointer;
			position: absolute;
			right: 0px;
			top: 5px;
			border: 0px;
			background: transparent;
			border-left: 1px #e6e9ed solid;
		}
		.pb-main-search	.pb-main-search-wrapper .pb-main-search-submit input[type="submit"]:hover ~ i{
			color: #8a8e91;
		}
		.pb-main-search	.pb-main-search-wrapper .pb-main-search-submit i{
			position: absolute;
			right: 9px;
			top: 3px;
			font-size: 30px;
			z-index: 9;
			color: #c1c6cb;
		}
		
		.pb-main-search-result{
			width: 100%;
			border-bottom: 1px #e6e9ed solid;
			min-height: 40px;
			margin-top: 10px;
		}
		.pb-main-search-result h4{
			padding: 0px;
			margin: 2px;
			text-transform: capitalize;
		}
		</style>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header-plain'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu'); ?>
	
	<!-- Begin Content -->
	<div class="container match-window-height">
		<div class="row">
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="padding-bottom:20px;min-height:50px;">
				<br />				
				<form class="pb-main-search" autocomplete="off">
					<div class="pb-main-search-wrapper">
						<input type="hidden" name="" />
						<input type="text"   name="q" placeholder="Search <?php print domain('title'); ?>" />
						<div class="pb-main-search-submit">
							<input type="submit" name="s" value="" />
							<i class="zmdi zmdi-search"></i>
						</div>
					</div>
					<div class="pb-main-search-results"></div>
				</form>
	
			</div>
			
		</div>
	</div>



<?php pb_include('/MasterPages/footer~col-md-12'); ?>
</body>
</html>