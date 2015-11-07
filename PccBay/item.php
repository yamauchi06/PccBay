<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); 
	if( isset($_GET['id']) ){ $product_id=$_GET['id']; }else{$product_id='';}
	if( !isset($_SESSION['user_id']) || empty($product_id) ){ header('Location: /#userLogin'); }
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT * FROM pb_post Where product_id='$product_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
		    $product['user_id']      = $row['user_id'];
		    $product['type']      	 = $row['type'];
		    $product['product_info'] = json_decode($row['product_info']);
		    $product['trans_info']   = json_decode($row['trans_info']);
	    }
	    $allowed=true;
	}else{
		$allowed=false;
	}
	$conn->close();
	if($allowed){
		foreach($product['product_info'] as $data){
			$product['timestamp']   = $data->timestamp;
			$product['title']       = htmlspecialchars_decode($data->title);
			$product['description'] = htmlspecialchars_decode($data->desc);
			$product['tags']        = $data->tags;
			$product['price']       = $data->price;
			$product['condition']   = $data->condition;
			$product['images']      = $data->images;
		}
		
		$user_data = json_decode(pb_user_data($product['user_id'], 'user_data'), true);
		foreach($user_data as $data){
			$pb_user['name']=$data['name'];
			$pb_user['avatar']=$data['avatar'];
			$pb_user['registered']=date("F d, Y", strtotime($data['registered']));
			$pb_user['theme']=$data['theme'];
		}
	}else{
		header('HTTP/1.0 404 Not Found');
	    include('404.php');
	    exit();
	}	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PCCbay | The eBay for PCC</title>
		<?php pb_include('/MasterPages/head.php'); ?>
	</head>	
<body>
	<header>		
		<?php pb_include('/MasterPages/header.php'); ?>
	</header>
	<?php pb_include('/MasterPages/MainMenu.php'); ?>
	
	<div class="container-fluid">
		<div class="row">
			
			<!-- Begin Content -->
			<div class="col-md-9 MainFeed">

				<?php
					if(!empty($product['images'])){
						?>
						<div class="col-md-5">
							<div class="pb-product-gallery">
								<div class="figure-feature"></div>
								<div class="figureOptions">
									<ul>
										<?php
											$images = explode(',', $product['images']);
											if(count($images) <= 1){
												$hidImages = 'hide';
											}else{$hidImages='';}
											foreach($images as $image){
												print '<li class="'.$hidImages.'">';
												pb_safe_image(
													$image, 
													'image-lazy', ' class="lazy figureOp"',
													'false'
												);
												print '</li>';
											} 
										?>
									</ul>
								</div>
							</div>
						</div>
						
						<div class="col-md-7">
						<?php
					}else{
						print '<div class="col-md-12">';
					}	
				?>
					
					<div class="col-md-12">
						<h2 style="margin:0px"><?php print $product['title']; ?></h2>
						<span>From: <b><?php print $pb_user['name']; ?></b></span>
					</div>
					
					<div class="col-md-12">
						<h4><span style="font-size: 13px">Price:</span> <span style="color:#c0392b">$<?php print $product['price']; ?></span></h4>
						<p><?php print $product['description']; ?></p>
					</div>

				</div>
				
				<div class="pb-post-tags col-md-12">
					<div class="col-md-offset-5 col-md-7">
						<strong>Tags</strong>
						<ul>
							<?php
							foreach (explode(',', $product['tags']) as $index => $category) {
								print '<li><a href="/s/'.str_replace(' ', '+', $category).'">'.ucwords($category).'</a></li>';
							}
							?>
						</ul>
					</div>
				</div>
				
			</div>
			
			<!-- Begin SideBar -->
			<?php
			pb_isset(pb_isset_session('user_id'), 
				'
				<div class="col-md-3 MainSideBar">
					<nav>
						<a href="#" class="transition-300 activeSet" data-obj="side_shopping">
							<div class="col-md-4">
								<i class="zmdi zmdi-shopping-cart"></i>
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
				<div id="side_shopping" class="pb-sidebar-group activeSet">
					<div class="side_shopping">
						<form action="" method="post">
							<input type="hidden" name="product_id" value="<?php print $product_id; ?>">
							<button class="pb-addtocart themeBG">Get This</button>
						</form>
						
						<!-- Begin Comments -->
						<form class="pb-comment-form" id="ProductComments">
							<div class="pb-comment-area">
								<input type="hidden" name="id" value="<?php print $product_id; ?>">
								<textarea name="comment" placeholder="Leave a comment" class="fixedHeight autosize"></textarea>
								<div class="pb-comment-area-lower">
									<input type="file" name="file" />
									<input type="submit" name="add_comment" value="Comment">
								</div>
							</div>
						</form>
						<div id="product_comemnts" data-form="#ProductComments" data-id="<?php print $product_id; ?>"><!-- Comments go here --></div>
						<!-- End Comments -->
					</div>
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
	<div class="pb-sticky-side <?php pb_isset(pb_isset_session('user_id'), '', 'hide') ?>">
		<a href="#" class="pb-sticky-btn feedback" data-overHead="#feedbackBox">
			<i class="zmdi zmdi-assignment-check"></i>
		</a>
		<a class="pb-sticky-btn" data-overHead="#invitationCodeBox">
			<i class="zmdi zmdi-card-giftcard"></i>
		</a>
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

<script src="/includes/js/pb-product-slider.js"></script>
<script src="/includes/js/pb-comments.js"></script>
<?php pb_include('/MasterPages/footer.php'); ?>
<script>
$( window ).resize(function() {
	if( $(window).width() < 992 ){
		$('.side_shopping').appendTo('.MainFeed');
	}else{
		$('.side_shopping').appendTo('#side_shopping');
	}
});	
$(document).ready(function(){
	
	$('#product_comemnts').pbcomments({
		uploads: false,
		form: true
	});
	
	var ffHeight = $('.figure-feature').width(); 
	$('.pb-product-gallery').find('.figure-feature').css({
		'background': 'no-repeat center top url('+$('.pb-product-gallery').find('img:eq(0)').attr('src')+')',
		'background-size': 'contain',
		height: ffHeight
	});
	$('body').on('click', '.figureOp', function(){
		$('.pb-product-gallery').find('.figure-feature').css({
			'background': 'no-repeat center top url('+$(this).attr('src')+')',
			'background-size': 'contain',
			height: ffHeight
		});
	});
});
</script>
</body>
</html>