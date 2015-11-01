<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); 
	if( isset($_GET['product_id']) ){ $product_id=$_GET['product_id']; }else{$product_id='';}
	if( !isset($_SESSION['user_id']) || empty($product_id) ){ header('Location: /'); }
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
	}
	$conn->close();
	foreach($product['product_info'] as $data){
		$product['timestamp']  = $data->timestamp;
		$product['title']      = $data->title;
		$product['description'] = $data->desc;
		$product['tags']       = $data->tags;
		$product['price']      = $data->price;
		$product['condition']  = $data->condition;
		$product['images']     = $data->images;
	}
	
	$user_data = json_decode(pb_user_data($product['user_id'], 'user_data'), true);
	foreach($user_data as $data){
		$pb_user['name']=$data['name'];
		$pb_user['avatar']=$data['avatar'];
		$pb_user['registered']=date("F d, Y", strtotime($data['registered']));
		$pb_user['theme']=$data['theme'];
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

				<div class="col-md-5">
					<div class="pb-product-gallery">
						<img src="" class="figure" />
						<ul>
							<?php
								$images = explode(',', $product['images']);
								foreach($images as $image){
									print '<li>';
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
				
				<div class="col-md-7">
					
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
								print '<li><a href="/'.$product['type'].'/#'.str_replace(' ', '+', $category).'">'.ucwords($category).'</a></li>';
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
						
						<form action="" method="post">
							<div class="pb-comment-area">
								<input type="hidden" name="post_id" value="<?php print $product_id; ?>">
								<textarea name="comment" placeholder="Leave a comment" class="fixedHeight autosize"></textarea>
								<div class="pb-comment-area-lower">
									<input type="submit" name="add_comment" value="Comment">
								</div>
							</div>
						</form>
						<div id="product_comemnts"><!-- Comments go here --></div>
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
			<div id="userLoginBox" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/UserLogin.php'); ?>
			</div>
		</div>
	</div>

<script src="/includes/js/pb-product-slider.js"></script>
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
	$('.pb-product-gallery').find('img:eq(0)').attr('src', $('.pb-product-gallery').find('img:eq(1)').attr('src'));
	$('body').on('click', '.figureOp', function(){
		$('.pb-product-gallery').find('img:eq(0)').attr('src', $(this).attr('src'));
	});
	
	$('body').on('click', '.pb-comment-area', function(event){
		event.stopPropagation();
		var commenter = $(this).find('textarea');
		commenter.removeClass('fixedHeight').attr('pos', 'open').next('.pb-comment-area-lower').show(200);
	});
	$('body').on('click', function(){
		var commenter = $('.pb-comment-area textarea');
		if( commenter.attr('pos')=='open' ){
			commenter.addClass('fixedHeight').attr('pos', 'closed').next('.pb-comment-area-lower').hide(400);
		}
	});
	
	$('body').on('click', '[name="add_comment"]', function(event){
		event.preventDefault();
		var textarea=$('.pb-comment-area textarea')
		var comment = textarea.val().replace(/'/, '&#39;').replace(/"/, '&#34;').replace(/&/, '&#38;').replace(/\?/, '&#63;');
		alert(comment)
		$.ajax({
		  type: "POST",
		  url: '/includes/php/async.php?function=pb_add_comment',
		  data: "comment="+comment+'&post_id=<?php print $product_id; ?>',
			success: function(data, textStatus, jqXHR)
		    {
			    textarea.val('');
			    $('body').trigger('click');
		        loadedComments();
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
				alert('error')
				console.log(jqXHR, textStatus, errorThrown);
		    }
		});
	});
});
$(window).ready(function(){
	loadedComments();
});

function loadedComments(){
	$.ajax({
	    url: '/includes/json/comments?q=<?php print $product_id; ?>&timeago=true',
	    dataType: 'json',
	    type: 'GET',
	    error: function(xhr, error){
		    console.debug(xhr); console.debug(error); console.log('Craw URL:', jsonURL);
		},
	    success: function(data) {
		    $('#product_comemnts').empty();
			$.each(data, function(i,json) {
				var sql = "SELECT * FROM pb_users WHERE user_id="+json.author;
				$.getJSON( "/includes/json/crawdb.php?get=user_data&sql="+sql, function( user_data ) {
					$('#product_comemnts').append(
					'<div class="col-md-12 pb-post pb-comment">'+
				    	'<div class="pb-post-block">'+
				            '<div class="pb-post-head">'+
				            	'<div class="pb-menu-icon"><i class="zmdi zmdi-chevron-down"></i></div>'+
				                '<img class="pb-post-avatar" src="'+user_data[0].avatar+'">'+
				                '<div class="pb-post-author">'+
				                   ' <strong><a href="/@'+user_data[0].username+'">'+user_data[0].name+'</a></strong><br>'+
				                    '<span class="pb-post-timestamp"><i class="pb-post-timestamp-o">'+data[i].date+'</i></span>'+
				                '</div>'+
				            '</div>'+
				            '<div class="pb-post-content">'+
								''+data[i].comment+''+
				            '</div>'+
				        '</div>'+
				   ' </div>'
				   );	
				});//end user get
			});//end each
	    }//end success
	});// end agax
}
</script>
</body>
</html>