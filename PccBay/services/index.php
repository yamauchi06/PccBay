<?php  include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PCCbay | Services</title>
		<?php pb_include('/MasterPages/head.php'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header.php'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu.php'); ?>
	
	<!-- Begin Content -->
	<div class="container">
		<div class="row">
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="background: no-repeat center url('/images/interior-images/students/concert-2.jpg');background-size:cover;height: 360px;padding: 0px;">
				<div class="pb-grade-lr-blue col-lg-12">
					
					<div class="col-md-5 pb-page-block-highlight">
						<h1>Join Forces Today</h1>
						<p>PCCbay wants campus to know you mean business. Promote your services here!</p>
						<a href="#DiscoverServices" class="pb-page-button">Learn More</a><br/>
						<a href="#" style="color:#ffffff;">Explore Offered Services</a>
					</div>
					
					<div class="col-md-5 pb-page-block-highlight" style="text-align:right;">
						<img src="/images/interior-images/serviceshands.svg" style="opacity:0.5" />
					</div>
					
				</div>
			</div>
			
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block">
				
				<div class="col-md-3 pb-page-block-highlight-icon">
					<i class="zmdi zmdi-scissors icon"></i>
					<h3>Hair Styler</h3>
					<p>Get payed for your chopping, curling, and cutting skills.</p>
					<a href="/services/join" class="pb-page-button">Get Started</a>
				</div>
				
				<div class="col-md-3 pb-page-block-highlight-icon">
					<i class="fa fa-hand-paper-o icon"></i>
					<h3>White Glove</h3>
					<p>We all hate it, But you can do it best, so let them know.</p>
					<a href="/services/join" class="pb-page-button">Get Started</a>
				</div>
				
				<div class="col-md-3 pb-page-block-highlight-icon">
					<i class="zmdi zmdi-book icon"></i>
					<h3>Tutor</h3>
					<p>Good at a particular course? Help those who aren't.</p>
					<a href="/services/join" class="pb-page-button">Get Started</a>
				</div>
				
				<div class="col-md-3 pb-page-block-highlight-icon">
					<i class="fa fa-magic icon"></i>
					<h3>Specialized</h3>
					<p>Provide a your service and<br />get payed.</p>
					<a href="/services/join" class="pb-page-button">Get Started</a>
				</div>
				
			</div>
			
			
			<div class="col-lg-10 col-lg-offset-1 pb-page-block" style="padding-bottom: 20px;">
				<h3 style="text-align: center;" id="DiscoverServices">Discover Services</h3>
				
				<div class="col-md-4">
					<ul class="pb-service-list">
						<li>
							<b>Item One</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Two</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Three</b>
							<br/>
							<p>Some text to tell you about it.</p>
						</li>
						<li>
							<b>Item Four</b>
							<br/>
							<p>Some text to tell you about it.</p>
						</li>
						<li>
							<b>Item Five</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Six</b>
							<br/>
							<p>Some text to tell you about it.</p>
						</li>
					</ul>
				</div>
				
				
				<div class="col-md-4">
					<ul class="pb-service-list">
						<li>
							<b>Item One</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Two</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Three</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Four</b>
							<br/>
							<p>Some text to tell you about it.</p>
						</li>
						<li>
							<b>Item Five</b>
							<br/>
							<p>Some text to tell you about it.</p>
						</li>
						<li>
							<b>Item Six</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
					</ul>
				</div>
				
				<div class="col-md-4">
					<ul class="pb-service-list">
						<li>
							<b>Item One</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Two</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Three</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Four</b>
							<br/>
							<p>Some text to tell you about it. This is text to tell you about it.</p>
						</li>
						<li>
							<b>Item Five</b>
							<br/>
							<p>Some text to tell you about it.</p>
						</li>
						<li>
							<b>Item Six</b>
							<br/>
							<p>Some text to tell you about it.</p>
						</li>
					</ul>
				</div>
				
			</div>
			
		</div>
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
			<div id="invitationCodeBox" class="HiddenFrame">
				<?php pb_include('/includes/content/info/invitationCode.php'); ?>
			</div>
			<div id="feedbackBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/feedback.php'); ?>
			</div>
			<div id="userAccountSettingBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/accountSettings.php'); ?>
			</div>
			<div id="userLogin" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/UserLogin.php'); ?>
			</div>
		</div>
	</div>
<?php pb_include('/MasterPages/footer.php'); ?>
</body>
</html>