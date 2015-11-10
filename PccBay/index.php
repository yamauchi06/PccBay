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
				<div id="freewall">
				    <?php pb_include('/MasterPages/post-temp.php'); ?>
				</div>
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
	

<script src="/includes/plugins/lazyLoad/jquery.lazyjson.js"></script>
<?php pb_include('/MasterPages/footer.php'); ?>
<script>
var iniTimer;
var iniTimerInterval = 200;
function ini_add_comments(post_id, el){
	comm='';
	$.ajax({
	    url: 'http://pccbay.localhost/graph/comments?accessToken=<?php print pb_graph_token('9827354187582375129873'); ?>&timeago=true&q='+post_id,
	    dataType: 'json',
	    type: 'GET',
	    error: function(xhr, error){
		    console.debug(xhr); console.debug(error); console.log('Craw URL:', jsonURL);
		},
	    success: function(data) {
		    $.each( data, function( key, comment ) { 
			     comm+='<div class="col-md-12 pb-post pb-comment-inline">'+
			    	'<div class="pb-post-block">'+
			            '<div class="pb-post-head-noB">'+
			                '<img class="pb-post-avatar" src="'+comment.user.avatar+'">'+
			                '<div class="pb-post-author">'+
			                   	'<strong><a href="/@'+comment.user.username+'">'+comment.user.name+'</a></strong><br>'+
			                    '<span class="pb-post-timestamp"><i class="pb-post-timestamp-o">'+comment.date+'</i></span>'+
			                '</div>'+
			            '</div>'+
			            '<div class="pb-post-content">'+comment.comment+
			            '</div>'+
			        '</div>'+
			   ' </div>';
			});//end each
			$(el).before(comm);
			comm='';
			clearTimeout(iniTimer);
			iniTimer = setTimeout(ini_grid, iniTimerInterval);
	    }//end success
	});// end agax
}	
function ini_grid_ext(JsonURI){
	var gridItems = $('.grid-item');
	var count = gridItems.length;
	gridItems.each(function(){
		var post = $(this);
		var pID = post.find('.pb-post-foot-fill').attr('data-post-id');
		var pIfo = post.find('.pbPPHead');
		var pHead_type = pIfo.attr('data-type');
		var pHead_price = pIfo.attr('data-price');
		var alreadyRan = pIfo.attr('data-done');
		var comments_count = pIfo.attr('data-comment-count');
		var comm='',foot='';
		var randID = Math.floor(Math.random() * 100000);
		if(alreadyRan=='false'){
			pIfo.attr('data-done', 'true');
			if(pHead_type=='product'){ 
				if(!pHead_price){ pHead_price='Free'; }
				post.find('.pb_Pdesc').remove();
				post.find('.pbPPHead').html('<span class="themeColor">$ '+pHead_price+'</span>');
				foot = '<div class="pb-post-foot" id="comment_'+randID+'">'+
							'<div class="row">'+
								'<div class="col-xs-12 text-center">'+
								 ' <a href="/item?id='+pID+'" class="feed-post-tab-link transition-300">'+
								    '<span class="feed-post-tab"><i class="zmdi zmdi-chevron-right"></i> More about this</span>'+
								 '</a>'+
								'</div>'+
							'</div>'+
						'</div>';
			}if(pHead_type=='question'){ 
				post.find('.pbPPHead').html('<i class="zmdi zmdi-pin-help themeColor" style="font-size:30px"></i><sub>'+comments_count+'</sub>');
				<?php if(isset($_SESSION['user_id'])){  ?>
				foot = comm+'<div class="pb-post-foot pb-post-input" id="comment_'+randID+'">'+
					'<div class="row">'+
						'<div class="col-xs-12 pb-va-rule">'+
						  '<form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post" autocomplete="off">'+
							 ' <input type="hidden" name="post_id" value="'+pID+'" >'+
							  '<input type="text" name="comment" placeholder="Write a comment" class="pb-post-input-text">'+
							 ' <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>'+
							 ' <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">'+
						  '</form>'+
						'</div>'+
					'</div>'+
				'</div>';
				<?php }else{ ?> foot=comm; <?php } ?>
				ini_add_comments(pID, '#comment_'+randID );
			}if(pHead_type=='discussion'){ 
				post.find('.pbPPHead').html('<i class="zmdi zmdi-comment-text-alt themeColor" style="font-size:30px"></i>');
				<?php if(isset($_SESSION['user_id'])){  ?>
				foot = comm+'<div class="pb-post-foot pb-post-input" id="comment_'+randID+'">'+
					'<div class="row">'+
						'<div class="col-xs-12 pb-va-rule">'+
						 ' <form action="/includes/php/async.php?function=pb_add_comment&redirect=[current]" method="post" autocomplete="off">'+
							 ' <input type="hidden" name="post_id" value="'+pID+'" >'+
							 ' <input type="text" name="comment" placeholder="Write a comment" class="pb-post-input-text">'+
							 ' <div class="pb-post-send-icon"><i class="zmdi zmdi-mail-send"></i></div>'+
							 ' <input type="submit" value="Go" name="add_comment" class="pb-post-input-submit">'+
						  '</form>'+
						'</div>'+
					'</div>'+
				'</div>';
				<?php }else{ ?> foot=comm; <?php } ?>
			}
			
			var img = post.find('.pb-post-product').attr('src');
			if(!img){ post.find('.pb-post-product').remove(); }
			
			var tagsHTML = post.find('.pb-post-tags').attr('data-tags');
			if(tagsHTML.length>0){
				tagsHTML=tagsHTML.split(',');
				post.find('.pb-post-tags ul').empty();
				$.each( tagsHTML, function( key, tag ) { 
					post.find('.pb-post-tags ul').append('<li><a href="/s/'+tag+'">'+tag+'</a></li>'); 
				});
			}
			
			post.find('.pb-post-foot-fill').append(foot);
		}
	});
}	
$(document).ready(function(){
	var JsonURI = 'http://pccbay.localhost/graph/feed?accessToken=<?php print pb_graph_token('9827354187582375129873'); ?>&loop=5';
	$( 'div#freewall' ).lazyjson({
	    api: {
	        uri: JsonURI
	    },
	    afterLoad: function (res) {
		    clearTimeout(iniTimer);
		    ini_grid_ext(JsonURI);
		    ini_grid();
	    },
	   pagination: {
			active: true,
			pages: 1,
			count: 20,
			lazyLoad: true
		},
		loaderImg: null,
		//loader: '<div id="lj-loader" style="text-align:center;padding:20px;"></div>',
		noResults: '<div id="lj-noresponse" style="text-align:center;padding:20px;"></div>',
		noResultsText: 'No More Post',
	});
});

</script>
</body>
</html>