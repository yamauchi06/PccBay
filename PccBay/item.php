<?php 
	include_once('MasterPages/overhead.php');
	pb_members_only('login');
	if( isset($_GET['id']) ){ $product_id=$_GET['id']; }else{$product_id='';}
	
	$result = pb_db("SELECT * FROM pb_post Where product_id='$product_id'");
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
		    $product['user_id']      = $row['user_id'];
		    $product['type']      	 = $row['type'];
		    $product['product_info'] = json_decode($row['product_info']);
		    $product['trans_info']   = json_decode($row['trans_info']);
	    }
	    $allowed=true;
	}else{ $allowed=false; }
	
	if($allowed){
		$pi=$product['product_info'][0];
	}else{
		header('HTTP/1.0 404 Not Found');
	    include('404.php');
	    exit();
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
			    <?php $proStatuseClass=''; if(isset(pb_order($product_id)->user_id)){ if( pb_order($product_id)->user_id == $_SESSION['user_id'] ){ $proStatuseClass='hide'; ?>	
				<div class="corner-text-wrapper">
			        <div class="corner-text">
			          <span><?php print pb_order($product_id)->status; ?></span>
			      	</div>
			    </div>	
			    <?php } } ?>
					
					<div class="pb-item-gallery col-md-8">
						<div class="pb-item-box">
							<?php
								if(!empty($pi->images)){
									?>
										<div class="pb-product-gallery">
											<img class="magniflier figure-feature" src="" />
											<div class="figureOptions">
												<ul>
													<?php
													$images = explode(',', $pi->images);
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
									<br />	
									<h5 style="text-align: left;">You may be interested</h5>	
									<?php
									pb_ad(["style"=>"width:130px;margin:0px 5px", "id"=>"paid", "caption"=>false, "type"=>"square"], 1, 'item_gallery');
									pb_ad(["style"=>"width:130px;margin:0px 5px", "id"=>"free", "caption"=>false, "type"=>"square"], 3, 'item_gallery');
								}
							?>
						</div>
					</div>
					
					<div class="pb-item-info col-md-4">
						<div class="pb-item-box">
							<div class="col-md-12">
								<h2 style="margin:0px"><?php print $pi->title; ?></h2>
								<span>From: <b><?php print pb_user('object', $product['user_id'])->name; ?></b></span>
							</div>
							
							<div class="col-md-12">
								
								<div class="pb-full-rule"></div>
								
								<p><?php print $pi->desc; ?></p>

								<a href="<?php echo pb_addtocart($product_id); ?>" class="pb-item-button transition-200 <?php print $proStatuseClass; ?>">
									<span>
										<?php print get_words($pi->title, 3); ?><br />
										<small><?php print pb_price($pi->price); ?></small>
									</span>
								</a>
							</div>

							<div class="pb-post-tags col-md-12">
								<strong>Tags</strong>
								<ul>
									<?php
									foreach (explode(',', $pi->tags) as $index => $category) {
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
								<i class="zmdi zmdi-comment-more"></i>
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
						<h5 style="text-align: left;margin: 0px;padding: 3px">You may be interested</h5>
						<?php 
							pb_ad(["style"=>"width:100%;"], 1, 'sidebar');
							pb_ad(["style"=>"width:100%;", "id"=>"free"], 1, 'sidebar');	
						?>
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