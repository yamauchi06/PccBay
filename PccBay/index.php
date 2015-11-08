<?php include_once($_SERVER['DOCUMENT_ROOT'].'/MasterPages/overhead.php'); ?>
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
	<?php 
	if(isset($_SESSION['user_id'])){
		pb_include('/MasterPages/MainMenu.php');
	}	
	?>
	<div class="container-fluid">
		<div class="row">
			<!-- Begin Content -->
			<div class="<?php pb_isset(pb_isset_session('user_id'), 'col-md-9', 'col-md-12') ?> MainFeed">
				<div id="freewall"></div>
			</div>
			
			<!-- Begin SideBar -->
			<?php
			pb_isset(pb_isset_session('user_id'), 
				'
				<div class="col-md-3 MainSideBar">
					<nav>
						<a href="#" class="transition-300 activeSet" data-obj="side_dashboard">
							<div class="col-md-4">
								<i class="zmdi zmdi-view-dashboard"></i>
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
				<div id="side_dashboard" class="pb-sidebar-group activeSet">
					<?php pb_include('/includes/content/pbRightBar/side_dashboard.php'); ?>
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
			<div id="postViewer" class="HiddenFrame">
				<?php pb_include('/includes/content/forms/postViewer.php'); ?>
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

<script>
function pb_infinite_feed(min, max){
	<?php
		$Jurl='';
		if(isset($_GET['username'])){ 
			$user_data = json_decode(pb_user_data(substr($_GET['username'],1), 'user_data'), true);
			foreach($user_data as $data){ $pb_user['user_id']=$data['ID']; }
			$Jurl='&q='.$pb_user['user_id']; 
		}
	?>
	//$('.MainFeed').append('<p id="freewall_loading" style="text-align:center">loading...</p>');
	var Jurl='/graph/feed?accessToken=rootbypass_9827354187582375129873<?php print $Jurl; ?>&range='+min+'-'+max;
	var html='';
	$.ajax({
	    url: Jurl,
	    dataType: 'json',
	    type: 'GET',
	    error: function(xhr, error){ console.debug(xhr); console.debug(error); console.log('Craw URL:', jsonURL); },
	    success: function(data) {
		    var TopTitle='';
		    var BottomText='';
		    var tags='';
		    var foot='';
		    var comm='';
			$.each( data, function( key, json ) { 
				if(json.type =='product'){ 
					var Phead = '<span class="themeColor">$ '+json.product_info[0].price+'</span>';
					TopTitle = '<h4>'+json.product_info[0].title+'</h4>';BottomText='';
				}
				else if(json.type =='question'){
					var Phead =  '<i class="zmdi zmdi-pin-help themeColor" style="font-size:30px"></i>';
					TopTitle='';
					BottomText='<strong>'+json.product_info[0].title+'</strong> <br />'+json.product_info[0].desc+'';
					Phead += '<sub>'+json.comments.count+'</sub>';
				}
				else if(json.type =='discussion'){
					var Phead =  '<i class="zmdi zmdi-comment-text-alt themeColor" style="font-size:30px"></i>';
					TopTitle='';BottomText='<strong>'+json.product_info[0].title+'</strong> <br />'+json.product_info[0].desc+'';
				}
				if(json.images[0]){
					var img='<img src="'+json.images[0]+'" class="pb-post-product lazy">';
				}else{img=''}
				
				$.each( json.product_info[0].tags.split(','), function(k,tag) { 
					tags +='<li><a href="/s/'+tag+'">'+tag+'</a></li>';
				});
				
				$.each( json.comments.comments, function(i,comment) { 
					comm+='<div class="col-md-12 pb-post pb-comment-inline">'+
				    	'<div class="pb-post-block">'+
				            '<div class="pb-post-head-noB">'+
				                '<img class="pb-post-avatar" src="'+comment.user.avatar+'">'+
				                '<div class="pb-post-author">'+
				                   	'<strong><a href="/@'+comment.user.username+'">'+comment.user.name+'</a></strong><br>'+
				                    '<span class="pb-post-timestamp"><i class="pb-post-timestamp-o">'+comment.timestamp.laps+'</i></span>'+
				                '</div>'+
				            '</div>'+
				            '<div class="pb-post-content">'+comment.comment+
				            '</div>'+
				        '</div>'+
				   ' </div>';
				});
				
				if(json.type=='product'){
					foot = '<div class="pb-post-foot">'+
						'<div class="row">'+
							'<div class="col-xs-12 text-center">'+
							 ' <a href="/item?id='+json.id+'" class="feed-post-tab-link transition-300">'+
							    '<span class="feed-post-tab"><i class="zmdi zmdi-money-box"></i> View This Item</span>'+
							 '</a>'+
							'</div>'+
						'</div>'+
					'</div>';
				}
				else if(json.type=='discussion'){
					<?php if(isset($_SESSION['user_id'])){  ?>
					foot = comm+'<div class="pb-post-foot pb-post-input">'+
						'<div class="row">'+
							'<div class="col-xs-12 pb-va-rule">'+
							 ' <form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post" autocomplete="off">'+
								 ' <input type="hidden" name="post_id" value="'+json.id+'" >'+
								 ' <input type="text" name="comment" placeholder="Chime in" class="pb-post-input-text">'+
								 ' <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>'+
								 ' <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">'+
							  '</form>'+
							'</div>'+
						'</div>'+
					'</div>';
					<?php }else{ ?> foot=comm; <?php } ?>
				}

				else if(json.type=='question'){
					<?php if(isset($_SESSION['user_id'])){  ?>
					foot = comm+'<div class="pb-post-foot pb-post-input">'+
						'<div class="row">'+
							'<div class="col-xs-12 pb-va-rule">'+
							  '<form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post" autocomplete="off">'+
								 ' <input type="hidden" name="post_id" value="'+json.id+'" >'+
								  '<input type="text" name="comment" placeholder="Answer Qestion" class="pb-post-input-text">'+
								 ' <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>'+
								 ' <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">'+
							  '</form>'+
							'</div>'+
						'</div>'+
					'</div>';
					<?php }else{ ?> foot=comm; <?php } ?>
				}

				
				 html+='<div class="<?php if(!isset($_SESSION['user_id'])){print 'col-md-3';}else{print 'col-md-4';} ?> pb-post grid-item" id="pb_post_'+json.id+'">'+
							'<div class="pb-post-block">'+
								'<div class="pb-post-head">'+
									'<img src="'+json.user.avatar+'" class="pb-post-avatar" />'+
									'<div class="pb-post-author">'+
										'<strong><a href="/@'+json.user.username+'">'+json.user.name+'</a></strong><br />'+
										'<span class="pb-post-timestamp"> <i class="pb-post-timestamp-o">'+
										''+json.timestamp.laps+''+
										'</i></span>'+
									'</div>'+
									'<div class="pb-post-price">'+Phead+'</div>'+
								'</div>'+
								'<div class="pb-post-content">'+TopTitle+

									'<div class="pb-post-slider flexslider">'+
									 ' <ul class="slides">'+
										'<li>'+
											'<a href="/item?id='+json.id+'">'+img+'</a>'+								  
										'</li>'+
									 ' </ul>'+
									'</div>'+
									'<p>'+BottomText+'</p>'+
									
									'<div class="pb-post-tags">'+
										'<ul>'+tags+'</ul>'+
									'</div>'+
								'</div>'+foot+
							'</div>'+
						'</div>';
						tags='';
						comm="";
			});
			//$('#freewall_loading').remove();
		    $('#freewall').append(html);
			ini_grid();
		}//end success
	});// end agax
}
$(document).ready(function(){
	var min=1;
	var max=12;
	var scrollINterval=max;
	pb_infinite_feed(min, max);
	$(window).scroll(function() {
	   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	      min=min+scrollINterval;
	      max=max+scrollINterval;
	      pb_infinite_feed(min, max);
	   }
	});
});
</script>
<?php pb_include('/MasterPages/footer.php'); ?>

</body>
</html>