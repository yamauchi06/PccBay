<?php 
	include_once('MasterPages/overhead.php');
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
	function price(){
		global $product;
		if(empty($product['price'])){
			return 'No set price';
		}else{
			return '$'.$product['price'];
		}
	}	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php print domain('title'); ?> | The eBay for PCC</title>
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
				
				
				<div class="pb-item col-md-12">
					
					<div class="pb-item-gallery col-md-8">
						<div class="pb-item-box">
							<?php
								if(!empty($product['images'])){
									?>
										<div class="pb-product-gallery">
											<img class="magniflier figure-feature" src="" />
											<div class="figureOptions">
												<ul>
													<?php
													$images = explode(',', $product['images']);
													if(count($images) <= 1){
														$hidImages = 'hide';
													}else{$hidImages='';}
													foreach($images as $image){
														print '<li class="'.$hidImages.'" style="background: no-repeat center center url('.pb_safe_image_return($image, 
															'url', ' class="lazy figureOp"',
															'false'
														).');background-size:contain" data-tumb="'.pb_safe_image_return($image, 
															'url', ' class="lazy figureOp"',
															'false'
														).'"></li>';
													} 
													?>
												</ul>
											</div>
										</div>
									<?php
								}
							?>
						</div>
					</div>
					
					<div class="pb-item-info col-md-4">
						<div class="pb-item-box">
							<div class="col-md-12">
								<h2 style="margin:0px"><?php print $product['title']; ?></h2>
								<span>From: <b><?php print $pb_user['name']; ?></b></span>
							</div>
							
							<div class="col-md-12">
								
								<div class="pb-full-rule"></div>
								
								<p><?php print $product['description']; ?></p>

								<a href="<?php echo pb_addtocart($product_id); ?>" class="pb-item-button transition-200">
									<span>
										<?php print get_words($product['title'], 3); ?><br />
										<small><?php print price(); ?></small>
									</span>
								</a>
							</div>
							
							
							
							
							<div class="pb-post-tags col-md-12">
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
				
				<!-- Sticky menu -->
				<?php pb_include('/MasterPages/sticky-menu-bottom'); ?>
					
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

<script src="http://thecodeplayer.com/uploads/js/prefixfree.js" type="text/javascript"></script>

<script src="/includes/js/pb-product-slider.js"></script>
<script src="/includes/js/pb-comments.js"></script>
<?php pb_include('/MasterPages/footer.php'); ?>
<script>
var moveComments=function(){
	if( $(window).width() < 992 ){
		$('.side_shopping').appendTo('.MainFeed');
	}else{
		$('.side_shopping').appendTo('#side_shopping');
	}
}	
$( window ).resize(function() {
	moveComments();
});	
$(document).ready(function(){
	moveComments();
	if( $(window).width() > 992 ){ magniflier(); }
	$('#product_comemnts').pbcomments({
		uploads: true,
		form: true
	});
	var ffHeight = 400; 
	var imgurl = $('.pb-product-gallery').find('li:eq(0)').attr('data-tumb');
	$('.pb-product-gallery').find('.figure-feature').attr('src', imgurl);
	
	$('.pb-product-gallery').find('li:eq(0)').addClass('active');
	$('body').on('click', '.figureOptions li', function(){
		$('.figureOptions li').removeClass('active');
		$(this).addClass('active');
		$('.pb-product-gallery').find('.figure-feature').attr('src', $(this).attr('data-tumb'));
	});
});


</script>
</body>
</html>