<link rel="stylesheet" href="/includes/css/PccBay.css" type="text/css" >
<script src="/includes/js/jquery.js"></script>
<body></body>
<script>
	
$(document).ready(function(){
	$.ajax({
	    url: '/includes/json/feed',
	    dataType: 'json',
	    type: 'GET',
	    error: function(xhr, error){
		    console.debug(xhr); console.debug(error); console.log('Craw URL:', jsonURL);
		},
	    success: function(data) {
		    
			$.each(data, function(i,json) {
				var info = json.product_info[0];
				var sql = "SELECT * FROM pb_users WHERE user_id="+json.user_id;
				$.getJSON( "/includes/json/crawdb.php?get=user_data&sql="+sql, function( user_data ) {
					var feed = '<div class="col-md-4 pb-post grid-item" id="pb_post_'+json.id+'">'+
								'<div class="pb-post-block">'+
									'<div class="pb-post-head">'+
										'<img src="'+user_data[0].avatar+'" class="pb-post-avatar" />'+
										'<div class="pb-post-author">'+
											'<strong><a href="/@'+user_data[0].username+'">'+user_data[0].name+'</a></strong><br />'+
											'<span class="pb-post-timestamp"> <i class="pb-post-timestamp-o">'+info.timestamp+'</i></span>'+
										'</div>'+
										'<div class="pb-post-price">'+info.price+'</div>'+
									'</div>'+
									'<div class="pb-post-content"><h4>'+info.title+'</h4>'+
										'<div class="pb-post-slider flexslider">'+
										  '<ul class="slides">';
										  
										  feed += '</ul>'+
										'</div>'+
										'<p>'+
											//title description
										'</p>'+
										
										'<div class="pb-post-tags">'+
											'<ul>'+
												//tags
											'</ul>'+
										'</div>'+
									'</div>'+
									//footer	
								'</div>'+
							'</div>';
					$('body').prepend(feed);	
				});//end user get
				
			  var sqlimg = "SELECT * FROM pb_safe_image WHERE uid='6809iwA9Ho'";
			  	$.getJSON( "/includes/json/crawdb.php?get=string&sql="+sqlimg, function( image_data ) {
			  		console.log(image_data)
			  	});
				
			});//end each
	    }//end success
	});// end agax
});

	
</script>
				
				
				
				
				
				
				